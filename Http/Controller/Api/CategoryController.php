<?php

namespace Addons\TopicDemo\Http\Controller\Api;

use Addons\TopicDemo\MeEdu\Service\TopicServiceInterface;
use App\Http\Controllers\Api\V2\BaseController;

class CategoryController extends BaseController
{

    public function all(TopicServiceInterface $topicService)
    {
        $data = $topicService->categories();
        return $this->data($data);
    }

}