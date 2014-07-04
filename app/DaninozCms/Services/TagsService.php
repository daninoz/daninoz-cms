<?php

namespace DaninozCms\Services;

use DaninozCms\Exceptions\DeleteException;
use DaninozCms\Repositories\Tags\TagsRepositoryInterface;
use Illuminate\Pagination\Environment as Paginator;
use DaninozCms\Validators\Tag as Validator;

class TagsService
{
    /**
     * @var \DaninozCms\Repositories\Tags\TagsRepositoryInterface
     */
    protected $tagsRepository;

    /**
     * @var \Illuminate\Pagination\Environment
     */
    protected $paginator;

    /**
     * @var \DaninozCms\Validators\Tag
     */
    protected $validator;

    /**
     * @param TagsRepositoryInterface $tagsRepository
     * @param \Illuminate\Pagination\Environment $paginator
     * @param \DaninozCms\Validators\Tag $validator
     */
    public function __construct(TagsRepositoryInterface $tagsRepository, Paginator $paginator, Validator $validator)
    {
        $this->tagsRepository = $tagsRepository;
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
        $tags = $this->tagsRepository->getAllWithPagination($page, $perPage);
        $result = $this->paginator->make($tags->data, $tags->totalItems, $tags->perPage);

        return $result;
    }

    public function getById($id)
    {
        $tag = $this->tagsRepository->getById($id);

        return $tag;
    }

    /**
     * @param $input
     * @throws \DaninozCms\Exceptions\ValidationException
     */
    public function create($input)
    {
        $this->validator->validate($input, 'create');

        $this->tagsRepository->create(['name' => $input['name']]);
    }

    /**
     * @param $id
     * @param $input
     * @throws \DaninozCms\Exceptions\ValidationException
     */
    public function update($id, $input)
    {
        $this->validator->validate($input, 'update', $id);

        $this->tagsRepository->update($id, ['name' => $input['name']]);
    }

    /**
     * @param $id
     * @throws \DaninozCms\Exceptions\DeleteException
     */
    public function delete($id)
    {
        if ($this->tagsRepository->getPostsCount($id) > 0) {
            throw new DeleteException('mensaje');
        }

        $this->tagsRepository->delete($id);
    }
}