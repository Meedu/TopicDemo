<?php

namespace Addons\TopicDemo\Http\Controller\Backend;

use Addons\TopicDemo\Event\TopicCreatedEvent;
use Addons\TopicDemo\Event\TopicDestroyEvent;
use Addons\TopicDemo\Event\TopicUpdatedEvent;
use Addons\TopicDemo\Http\Request\Backend\TopicRequest;
use Addons\TopicDemo\Models\Category;
use Addons\TopicDemo\Models\Topic;
use App\Http\Controllers\Backend\Api\V1\BaseController;
use Illuminate\Http\Request;

class TopicController extends BaseController
{

    public function index(Request $request)
    {
        $keywords = $request->input('keywords');
        $categoryId = (int)$request->input('category_id');

        $topics = Topic::query()
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($keywords, function ($query) use ($keywords) {
                $query->where('title', 'like', '%' . $keywords . '%');
            })
            ->orderByDesc('id')
            ->paginate($request->input('size', 10));

        return $this->successData([
            'data' => $topics->items(),
            'total' => $topics->total(),
        ]);
    }

    public function create()
    {
        $categories = Category::query()->select(['id', 'name', 'sort'])->orderBy('sort')->get();
        return $this->successData([
            'categories' => $categories,
        ]);
    }

    public function store(TopicRequest $request)
    {
        $topic = Topic::create($request->filldata());

        event(new TopicCreatedEvent($topic['id'], $topic['title'], $topic['content']));

        return $this->success();
    }

    public function edit($id)
    {
        $topic = Topic::query()->where('id', $id)->firstOrFail();
        return $this->successData($topic);
    }

    public function update(TopicRequest $request, $id)
    {
        $topic = Topic::query()->where('id', $id)->firstOrFail();
        $data = $request->filldata();
        $topic->fill($data)->save();

        event(new TopicUpdatedEvent($topic['id'], $topic['title'], $topic['content']));

        return $this->success();
    }

    public function destroy($id)
    {
        Topic::query()->where('id', $id)->delete();

        event(new TopicDestroyEvent($id));

        return $this->success();
    }

}