<?php

use DaninozCms\Exceptions\DeleteException;
use DaninozCms\Exceptions\ValidationException;
use DaninozCms\Services\CategoriesService;
use Symfony\Component\HttpFoundation\Response;

class AdminCategoriesController extends \BaseController
{
    /**
     * @var DaninozCms\Services\CategoriesService
     */
    protected $categoriesService;

    /**
     * @param CategoriesService $categoriesService
     */
    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		try {
            $categories = $this->categoriesService->getAllWithPagination();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return View::make('admin.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
            $this->categoriesService->create(Input::all());
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->getErrors())->withInput();
        }

        return Redirect::route('admin.categories.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $category = $this->categoriesService->getById($id);

        return View::make('admin.categories.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        try {
            $this->categoriesService->update($id, Input::all());
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->getErrors())->withInput();
        }

        return Redirect::route('admin.categories.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try {
            $this->categoriesService->delete($id);
        } catch (DeleteException $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }

        return Redirect::route('admin.categories.index');
	}

}