<?php

namespace DaninozCms\Services;

use DaninozCms\Exceptions\DeleteException;
use DaninozCms\Repositories\Categories\CategoriesRepositoryInterface;
use Illuminate\Pagination\Environment as Paginator;
use DaninozCms\Validators\Category as Validator;

class CategoriesService
{
    /**
     * @var \DaninozCms\Repositories\Categories\CategoriesRepositoryInterface
     */
    protected $categoriesRepository;

    /**
     * @var \Illuminate\Pagination\Environment
     */
    protected $paginator;

    /**
     * @var \DaninozCms\Validators\Category
     */
    protected $validator;

    /**
     * @param CategoriesRepositoryInterface $categoriesRepository
     * @param \Illuminate\Pagination\Environment $paginator
     * @param \DaninozCms\Validators\Category $validator
     */
    public function __construct(CategoriesRepositoryInterface $categoriesRepository, Paginator $paginator, Validator $validator)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->paginator = $paginator;
        $this->validator = $validator;
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return mixed
     */
    public function getAllWithPagination($page = 1, $perPage = 10)
    {
        $categories = $this->categoriesRepository->getAllWithPagination($page, $perPage);
        $result = $this->paginator->make($categories->data, $categories->totalItems, $categories->perPage);

        return $result;
    }

    public function getById($id)
    {
        $category = $this->categoriesRepository->getById($id);

        return $category;
    }

    /**
     * @param $input
     * @throws \DaninozCms\Exceptions\ValidationException
     */
    public function create($input)
    {
        $this->validator->validate($input, 'create');

        $this->categoriesRepository->create(['name' => $input['name']]);
    }

    /**
     * @param $id
     * @param $input
     * @throws \DaninozCms\Exceptions\ValidationException
     */
    public function update($id, $input)
    {
        $this->validator->validate($input, 'update', $id);

        $this->categoriesRepository->update($id, ['name' => $input['name']]);
    }

    /**
     * @param $id
     * @throws \DaninozCms\Exceptions\DeleteException
     */
    public function delete($id)
    {
        if ($this->categoriesRepository->getPostsCount($id) > 0) {
            throw new DeleteException('mensaje');
        }

        $this->categoriesRepository->delete($id);
    }
}