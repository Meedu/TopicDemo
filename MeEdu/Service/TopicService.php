<?php

namespace Addons\TopicDemo\MeEdu\Service;

use Addons\TopicDemo\MeEdu\Dao\TopicDaoInterface;

class TopicService implements TopicServiceInterface
{

    protected $topicDao;

    public function __construct(TopicDaoInterface $topicDao)
    {
        $this->topicDao = $topicDao;
    }

    public function paginate(int $page, int $size, array $params, array $fields, array $with, array $withCount): array
    {
        return $this->topicDao->paginate($page, $size, $params, $fields, $with, $withCount);
    }

    public function topicFindById(int $id, array $params, array $fields): array
    {
        return $this->topicDao->topicFindById($id, $params, $fields);
    }

    public function categories(): array
    {
        return $this->topicDao->categories();
    }


}