<?php

namespace Addons\TopicDemo\MeEdu\Dao;

interface TopicDaoInterface
{

    public function categories(): array;

    public function paginate(int $page, int $size, array $params, array $fields, array $with, array $withCount): array;

    public function topicFindById(int $id, array $params, array $fields): array;

}