<?php

namespace DaninozCms\Repositories\Categories;

use DaninozCms\Models\Category;

class CategoriesEloquentRepository implements CategoriesRepositoryInterface
{
    /**
     * @var \DaninozCms\Models\Category
     */
    protected $categories;

    /**
     * @param Category $categories
     */
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return mixed|\StdClass
     */
    public function getAllWithPagination($page = 1, $perPage = 10)
    {
        $result = new \StdClass;
        $result->page = $page;
        $result->perPage = $perPage;
        $result->totalItems = 0;
        $result->data = array();

        $categories = $this->categories
            ->skip($perPage * ($page - 1))->take($perPage)
            ->get();

        $result->data = $categories->toArray();
        $result->totalItems = $categories->count();

        return $result;
    }

    /**
     * @return mixed|void
     */
    public function getAll()
    {
        $result = new \StdClass;
        $result->data = array();

        $categories = $this->categories
            ->all();

        $result->data = $categories->toArray();
    }

    /**
     * @param $attribute
     * @param $value
     * @return boolean
     */
    public function existsByAttribute($attribute, $value)
    {
        $category = $this->categories->where($attribute, $value)->first();

        if (empty($category)) {
            return false;
        }

        return true;
    }

    /**
     * @param $attribute
     * @param $value
     * @return boolean
     */
    public function getByAttribute($attribute, $value)
    {
        $category = $this->categories->where($attribute, $value)->first();

        if (empty($category)) {
            return null;
        }

        return $category->toArray();
    }

    /**
     * @param $input
     * @return mixed|void
     */
    public function create($input)
    {
        $category = $this->categories->newInstance();
        $category->name = $input['name'];
        $category->save();
    }

    /**
     * @param $id
     * @param $input
     * @return mixed|void
     */
    public function update($id, $input)
    {
        $category = $this->categories->findOrFail($id);
        $category->name = $input['name'];
        $category->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostsCount($id)
    {
        return $this->categories->find($id)->posts->count();
    }

    /**
     * @param $id
     * @return mixed|void
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->categories->find($id)->delete();
    }

}