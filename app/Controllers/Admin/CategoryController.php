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

use Exception;
use Src\Auth;
use Src\CSRFToken;
use Src\Controller;
use Src\Http\Request;
use App\Models\Category;
use Src\Session\Session;
use Src\Validation\ValidateRequest;
use Src\View;

/**
 * @package GiGaCMS/Category
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class CategoryController extends Controller
{
	/**
	 * @access private
	 * @var object
	 */
	private Category $category;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->category = new Category('categories');
	}

  /**
   * @throws Exception
   */
  private function getData(): array
  {
		return [
			'user_id' => Auth::id(),
			'category_name' => $this->post('category_name'),
			'category_slug' => slug($this->post('category_name')),
			'category_description' => $this->post('category_description'),
			'category_status' => $this->post('category_status'),
			'updated_at' => setDate()
		];
	}

	/**
	 * Set rules for validation data.
	 *
	 * @return array|null
	 */
	private function setValidation(): ?array
	{
		return [
			'category_name' => [
				'required' => true,
				'max' => 30,
			]
		];
	}

	/**
	 * Display a listing of the resources.	
	 *
	 * @return View
   */
	public function index(): View
  {
		return view('categories/index', [
			'categories' => $this->category->findAll(),
		]);
	}

  /**
   * Show the form for creating a new resource.
   *
   * @return View
   * @throws Exception
   */
	public function create(): View
  {
		return view('categories/create', [
			'token' => CSRFToken::token(),
			'old' => Session::get('data-form'),
			'categories' => $this->category->findAllWhere('user_id', Auth::id())
		]);
	}

  /**
   * Store a newly created resource in storing.
   *
   * @return void
   * @throws Exception
   */
	public function store(): void
  {
		if (! is_null(Request::validate($this->setValidation()))) {
			ValidateRequest::storingSession($this->setValidation(), 'categories/create');
		}
		ValidateRequest::unsetSession();

		$this->category->insert($this->getData());

		Session::setFlashMessage('FLASH_SUCCESS', 'Category created successfully');

		redirect('categories');
	}

	/**
	 * Display form for editing the specified resource. 
	 *
	 * @param string $slug
	 * @return int|View
   * @throws Exception
	 */
	public function edit(string $slug): int|View
  {
		$categoryId = $this->category->findWhere('category_slug', $slug);
		
		try {
			if(! $categoryId) {
				throw new Exception('Category not found');
			}

			return view('categories/edit', [
				'category' => $this->category
            ->findWhereAnd('category_slug', $slug, 'user_id', Auth::id()),
				'token' => CSRFToken::token(),
				'categories' => $this->category->findAll(),
				
			]);
		} catch(Exception $exc) {
			return printf("%s", $exc->getMessage());
		}
	}

  /**
   * Update the specified resource in storage.
   *
   * @param integer $id
   * @return void
   * @throws Exception
   */
	public function update(int $id): void
  {
		$updatedId = $this->category->findById($id);
		if (! is_null(Request::validate($this->setValidation()))) {
			ValidateRequest::storingSession(
        $this->setValidation(), 'categories/edit/' . $updatedId->category_slug
      );
		}
		ValidateRequest::unsetSession();
		
		$this->category->update($id, $this->getData());
		$updatedCategory = $this->category->findById($id);
		Session::setFlashMessage('FLASH_SUCCESS', 'Category updated successfully');

		redirect('categories/edit/' . $updatedCategory->category_slug);
	}

  /**
   * Delete the specified resource.
   *
   * @param integer $id
   * @return void
   */
	public function delete(int $id): void
  {
		try{
			if(! $this->category->findById($id)) {
				throw new Exception('Category not found');
			}
			$this->category->delete($id);

			redirect('categories');
		} catch(Exception $exc) {
			printf("%s", $exc->getMessage());
		}
	}
}