<?php

namespace Addons\TopicDemo\MeEdu\Dao;

use Addons\TopicDemo\Models\Category;
use Addons\TopicDemo\Models\Topic;

class TopicDao implements TopicDaoInterface
{
    public function categories(): array
    {
        return Category::query()->select(['id', 'name', 'sort'])->orderBy('sort')->get()->toArray();
    }

    public function paginate(int $page, int $size, array $params, array $fields, array $with, array $withCount): array
    {
        $data = Topic::query()
            ->select($fields)
            ->with($with)
            ->withCount($withCount)
            ->when($params, function ($query) use ($params) {
                if (isset($params['gte_published_at'])) {
                    $query->where('published_at', '>=', $params['gte_published_at']);
                }
                if (isset($params['lte_published_at'])) {
                    $query->where('published_at', '<=', $params['lte_published_at']);
                }
                if (isset($params['category_id'])) {
                    $query->where('category_id', $params['category_id']);
                }
            })
            ->orderByDesc('id')
            ->paginate($size, ['*'], 'page', $page);

        return [
            'data' => $data->items(),
            'total' => $data->total(),
        ];
    }

    public function topicFindById(int $id, array $params, array $fields): array
    {
        $topic = Topic::query()
            ->select($fields)
            ->when($params, function ($query) use ($params) {
                if (isset($params['gte_published_at'])) {
                    $query->where('published_at', '>=', $params['gte_published_at']);
                }
                if (isset($params['lte_published_at'])) {
                    $query->where('published_at', '<=', $params['lte_published_at']);
                }
                if (isset($params['category_id'])) {
                    $query->where('category_id', $params['category_id']);
                }
            })
            ->where('id', $id)
            ->first();

        return $topic ? $topic->toArray() : [];
    }


}