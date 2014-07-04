<?php

use DaninozCms\Exceptions\DeleteException;
use DaninozCms\Exceptions\ValidationException;
use DaninozCms\Services\TagsService;
use Symfony\Component\HttpFoundation\Response;

class AdminTagsController extends \BaseController
{
    /**
     * @var DaninozCms\Services\TagsService
     */
    protected $tagsService;

    /**
     * @param TagsService $tagsService
     */
    public function __construct(TagsService $tagsService)
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'destroy']]);

        $this->tagsService = $tagsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $tags = $this->tagsService->getAllWithPagination();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return View::make('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $this->tagsService->create(Input::only('name'));
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->getErrors())->withInput();
        }

        return Redirect::route('admin.tags.index')->withSuccessMessage('Tag created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tagsService->getById($id);

        return View::make('admin.tags.edit', compact('tag'));
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
            $this->tagsService->update($id, Input::only('name'));
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->getErrors())->withInput();
        }

        return Redirect::route('admin.tags.index')->withSuccessMessage('Tag Updated');
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
            $this->tagsService->delete($id);
        } catch (DeleteException $e) {
            return Redirect::back()->withErrors($e->getMessage())->withErrorMessage('Can\'t delete a Tag with Posts');
        }

        return Redirect::route('admin.tags.index');
    }

}