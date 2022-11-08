<?php
/*
 * This file is part of the GiGaCMS package.
 *
 * (c) Giuseppe Galari <gigaprog@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Controllers\Admin;

use Src\Auth;
use Exception;
use Src\CSRFToken;
use Src\Controller;
use App\Models\Post;
use Src\Http\Redirect;
use App\Models\Comment;
use App\Models\Category;
use Src\Session\Session;
use App\Actions\MediaAction;
use App\Actions\CategoryPostAction;
use App\Actions\MetaDataAction;

/**
 * 
 * @package GiGaCMS\Posts
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class PostController extends Controller
{
  /** @var object */
  private object $post, $category, $categoryPost, $media, $comment, $metadata;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->post = new Post('posts');
    $this->category = new Category('categories');
    $this->categoryPost = new CategoryPostAction();
    $this->media = new MediaAction();
    $this->comment = new Comment('comments');
    $this->metadata = new MetaDataAction();
  }

  /**
   * Display a listing of the resource.
   * 
   * @return mixed
   */
  public function index(): mixed
  {
    $posts = $this->post->findAll();
    if (!Session::has('user')) {
      return redirect('login');
    }

    return view('posts/index', [
      'posts' => $posts,
      'token' => CSRFToken::token(),
      'username' => $this->post->users(),
      'images' => $this->media->getAll()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   * 
   * @return mixed
   */
  public function create(): mixed
  {
    return view('posts/create', [
      'token' => CSRFToken::token(),
      'categories' => $this->category->findAll(),
      'posts' => $this->post->findAll(),
      'old' => Session::get('data-form')
    ]);
  }

  /**
   * Rules for validation data
   * 
   * @access private
   * @return array
   */
  private function validate(): mixed
  {
    $errors = $this->request()->validate([
      'post_title' => [
        'required' => true,
        'max' => 50,
        'title'
      ],
      'post_content' => [
        'required' => true
      ],
      'post_date' => [
        'now'
      ],
      'post_status' => [
        'required' => true
      ],
      'comment_status' => [
        'required' => true
      ]
    ]);
    
    return $errors;
  }

  /**
   * Sessions about validation data
   * 
   * @access private
   * @return mixed
   */
  private function storingSession(): mixed
  {
    if ($this->validate() !== null) {
      Session::remove('data-form');
      Session::set('data-form', $this->request()->all());
      return Redirect::to('posts/create');
    } elseif (Session::has('data-form')) {
        Session::remove('data-form');
        Session::remove('errors');
    } else {
      return null;
    }
  }

  /**
   * Update sessions for validation data.
   *
   * @param object $updatePost
   * @return mixed
   */
  private function updateSession(object $updatePost): mixed
  {
    if ($this->validate() !== null) {
      return redirect('posts/edit/' . $updatePost->post_name);
    } elseif (Session::has('errors')) {
      Session::remove('errors');
    } else {
      return null;
    }
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @return mixed
   */
  public function store(): mixed
  {
    $this->storingSession();

    $guid = $this->request()->site() . "/" . slug($this->post('post_title'));
    $this->post->insert([
      'user_id' => Auth::id(),
      'post_date' => $this->post('post_date') !== '' ? $this->post('post_date') : null,
      'post_title' => $this->post('post_title'),
      'post_content' => $this->post('post_content'),
      'post_excerpt' => $this->post('post_excerpt') !== "" ? $this->post('post_excerpt') : null,
      'post_status' => $this->post('post_status'),
      'comment_status' => $this->post('comment_status'),
      'post_password' => $this->post('post_password') !== '' ? password_hash($this->post('post_password'), PASSWORD_DEFAULT) : null,
      'post_access' => $this->post('post_access'),
      'post_name' => slug($this->post('post_title')),
      'post_parent' => $this->post('post_parent') !== '' ? $this->post('post_parent') : null,
      'guid' => $guid,
      'deleted_at' => null,
      'created_at' => setDate(),
      'updated_at' => setDate(),
    ]);

    $postSaved = $this->post->findWhere('post_title', $this->post('post_title'));

    // Insert featured image
    $this->media->insertFile($postSaved->id);
    // Insert metadata
    $this->metadata->insertMetaData($postSaved);
    // Links the category with the post
    $this->categoryPost->insertCategoryPost($postSaved);

    Session::setFlashMessage('FLASH_SUCCESS', 'Post created successfully');

    return redirect('posts');
  }

  /**
   * Display the specified resource.
   *
   * @param string $slug
   * @return mixed
   * @throws Exception
   */
  public function show(string $slug): mixed
  {
    $post = $this->post->findWhere('post_name', $slug);
    $category = '';
    foreach ($this->categoryPost->getCategory() as $cat) {
      if ($cat->post_id === $post->id) {
        $category = $cat->category_name;
      }
    }

    try {
      if (! $post) {
        return throw new \Exception('Post not found');
      }
    } catch (\Exception $exc) {
      printf("%s", $exc->getMessage());
    }

    return view('posts/show', [
      'post' => $post,
      'users' => $this->post->user($post->id),
      'category' => $category,
      'comments' => $this->comment->findAllWhere('post_id', $post->id)
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param string $slug
   * @return mixed
   * @throws Exception
   */
  public function edit(string $slug): mixed
  {
    $post = $this->post->findWhereAnd('post_name', $slug, 'user_id', Auth::id());

    try {
      if (!$post) {
        throw new Exception('Post not found');
      }

      return view('posts/edit', [
        'post' => $post,
        'token' => CSRFToken::token(),
        'categories' => $this->category->findAll(),
        'postCategory' => $this->categoryPost->getPost($post->id),
        'posts' => $this->post->findAll(),
        'media' => $this->media->getWhere('post_id', $post->id),
        'metadata' => $this->metadata->getMetadataWhere($post->id)
      ]);
    } catch (Exception $exc) {
      printf("%s", $exc->getMessage());
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param int $id
   * @return mixed
   */
  public function update(int $id): mixed
  {
    $updatePost = $this->post->findById($id);
    $this->updateSession($updatePost);

    $guid = $this->request()->site() . "/" . slug($this->post('post_title'));
    $data = [
      'user_id' => Auth::id(),
      'post_date' => $this->post('post_date') !== '' ? $this->post('post_date') : null,
      'post_title' => $this->post('post_title'),
      'post_content' => $this->post('post_content'),
      'post_excerpt' => $this->post('post_excerpt') !== '' ? $this->post('post_excerpt') : null,
      'post_status' => $this->post('post_status'),
      'comment_status' => $this->post('comment_status'),
      'post_password' => $this->post('post_password') !== '' ? password_hash($this->post('post_password'), PASSWORD_DEFAULT) : null,
      'post_access' => $this->post('post_access'),
      'post_name' => slug($this->post('post_title')),
      'post_parent' => $this->post('post_parent') !== '' ? $this->post('post_parent') : null,
      'guid' => $guid,
      'deleted_at' => null,
      'updated_at' => setDate(),
    ];

    $this->post->update($id, $data);
    $postId = $this->post->findById($id);

    $this->media->updateFile($postId->id);

    $this->categoryPost->updateCategoryPost($postId);

    $this->metadata->updateMetaData($postId);
  
    Session::setFlashMessage('FLASH_SUCCESS', 'Post updated successfully');

    Redirect::to('posts/edit/' . $postId->post_name);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return mixed
   * @throws Exception
   */
  public function delete(int $id): mixed
  {
    $post = $this->post->findById($id);
    try {
      if (! $post) {
        throw new Exception('Post not found');
      }

      $this->categoryPost->delete($this->categoryPost->findWhere('post_id', $id)->id);
      $this->post->delete($id);

      return Redirect::to('posts');
    } catch (Exception $exc) {
      printf("%s", $exc->getMessage());
    }
  }
}
