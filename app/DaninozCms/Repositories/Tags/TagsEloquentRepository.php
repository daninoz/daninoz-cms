<?php

namespace DaninozCms\Repositories\Tags;

use DaninozCms\Models\Tag;

class TagsEloquentRepository implements TagsRepositoryInterface
{
    /**
     * @var \DaninozCms\Models\Tag
     */
    protected $tags;

    /**
     * @param Tag $tags
     */
    public function __construct(Tag $tags)
    {
        $this->tags = $tags;
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

        $tags = $this->tags
            ->skip($perPage * ($page - 1))->take($perPage)
            ->get();

        $result->data = $tags->toArray();
        $result->totalItems = $tags->count();

        return $result;
    }

    /**
     * @return mixed|void
     */
    public function getAll()
    {
        $result = new \StdClass;
        $result->data = array();

        $categories = $this->tags
            ->all();

        $result->data = $categories->toArray();
    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function getById($id)
    {
        $tag = $this->tags->findOrFail($id);

        return $tag->toArray();
    }

    /**
     * @param $input
     * @return mixed|void
     */
    public function create($input)
    {
        $tag = $this->tags->newInstance();
        $tag->name = $input['name'];
        $tag->save();
    }

    /**
     * @param $id
     * @param $input
     * @return mixed|void
     */
    public function update($id, $input)
    {
        $tag = $this->tags->findOrFail($id);
        $tag->name = $input['name'];
        $tag->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostsCount($id)
    {
        return $this->tags->find($id)->posts->count();
    }

    /**
     * @param $id
     * @return mixed|void
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->tags->find($id)->delete();
    }

}