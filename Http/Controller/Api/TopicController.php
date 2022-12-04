<?php

namespace Addons\TopicDemo\Http\Controller\Api;

use Addons\TopicDemo\MeEdu\Service\TopicServiceInterface;
use App\Http\Controllers\Api\V2\BaseController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TopicController extends BaseController
{

    public function index(Request $request, TopicServiceInterface $topicService)
    {
        $page = (int)$request->input('page', 1);
        $size = (int)$request->input('size', 10);

        $categoryId = (int)$request->input('category_id');
        $params = ['lte_published_at' => Carbon::now()->toDateTimeLocalString()];
        $categoryId && $params['category_id'] = $categoryId;

        $data = $topicService->paginate(
            $page,
            $size,
            $params,
            ['id', 'title', 'published_at', 'category_id'],
            ['category:id,name'],
            []
        );

        return $this->data($data);
    }

    public function detail(TopicServiceInterface $topicService, $id)
    {
        $id = (int)$id;
        $topic = $topicService->topicFindById($id, [], ['id', 'title', 'content', 'published_at']);
        throw_if(!$topic, ModelNotFoundException::class);

        if (Carbon::parse($topic['published_at'])->gt(Carbon::now())) {
            return $this->error('图文未上架');
        }

        return $this->data($topic);
    }

}