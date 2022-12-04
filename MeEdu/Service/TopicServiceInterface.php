<?php

namespace Addons\TopicDemo\MeEdu\Service;

interface TopicServiceInterface
{

    public function paginate(int $page, int $size, array $params, array $fields, array $with, array $withCount): array;

    public function topicFindById(int $id, array $params, array $fields): array;

    public function categories(): array;
}