<?php

namespace DaninozCms\Repositories\Categories;

interface CategoriesRepositoryInterface
{
    /**
     * @param int $page
     * @param int $perPage
     * @return mixed
     */
    public function getAllWithPagination($page = 1, $perPage = 10);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $input
     * @return mixed
     */
    public function create($input);

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input);

    /**
     * @param $id
     * @return mixed
     */
    public function getPostsCount($id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

}