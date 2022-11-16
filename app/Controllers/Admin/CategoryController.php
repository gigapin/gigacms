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

use Src\CSRFToken;
use Src\Controller;
use App\Models\Category;
use Src\Auth;
use Src\Session\Session;

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
	private object $category;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->category = new Category('categories');
	}

	/**
	 * Set rules for validation data.
	 *
	 * @return array|null
	 */
	private function validation(): ?array
	{
		$errors = $this->request()->validate([
			'category_name' => [
				'required' => true,
				'max' => 30,
			]
		]);

		return $errors;
	}

	/**
	 * Display a listing of the resources.	
	 *
	 * @return mixed
	 */
	public function index(): mixed
	{
		return view('categories/index', [
			'categories' => $this->category->findAll(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return mixed
	 */
	public function create(): mixed
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
	 * @return mixed
	 */
	public function store(): mixed
	{
		if ($this->validation()) {
			Session::remove('data-form');
      Session::set('data-form', $this->request()->all());
			return redirect('categories/create');
		} else {
			Session::remove('data-form');
      Session::remove('errors');
		}

		$this->category->insert([
			'user_id' => Auth::id(),
			'category_name' => $this->post('category_name'),
			'category_slug' => slug($this->post('category_name')),
			'category_description' => $this->post('category_description') !== '' ? $this->post('category_description') : null,
			'category_status' => $this->post('category_status'),
			'created_at' => setDate(),
			'updated_at' => setDate()
		]);

		Session::setFlashMessage('FLASH_SUCCESS', 'Category created successfully');

		return redirect('categories');
	}

	/**
	 * Display form for editing the specified resource. 
	 *
	 * @param string $slug
	 * @return mixed
	 * @throws Exception
	 */
	public function edit(string $slug): mixed
	{
		
		$categoryId = $this->category->findWhere('category_slug', $slug);
		
		try {
			if(! $categoryId) {
				throw new \Exception('Category not found');
			}

			return view('categories/edit', [
				'category' => $this->category->findWhereAnd('category_name', $slug, 'user_id', Auth::id()),
				'token' => CSRFToken::token(),
				'categories' => $this->category->findAll(),
				
			]);
		} catch(\Exception $exc) {
			printf("%s", $exc->getMessage());
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function update(int $id): mixed
	{
		$updatedId = $this->category->findById($id);
		
		if ($this->validation()) {
			Session::remove('data-form');
      Session::set('data-form', $this->request()->all());
			return redirect("categories/edit/$updatedId->category_slug");
		} else {
			Session::remove('data-form');
      Session::remove('errors');
		}

		$data = [
			'category_name' => $this->post('category_name'),
			'category_slug' => slug($this->post('category_name')),
			'category_description' => $this->post('category_description'),
			'category_status' => $this->post('category_status'),
			'updated_at' => setDate()
		];

		$this->category->update($id, $data);
		Session::setFlashMessage('FLASH_SUCCESS', 'Category updated successfully');

		return redirect('categories');
	}

	/**
	 * Delete the specified resource.
	 *
	 * @param integer $id
	 * @return mixed
	 * @throws Exception
	 */
	public function delete(int $id): mixed
	{
		try{
			if(! $this->category->findById($id)) {
				throw new \Exception('Category not found');
			}
			$this->category->delete($id);

			return redirect('categories');
		} catch(\Exception $exc) {
			printf("%s", $exc->getMessage());
		}
	}
}