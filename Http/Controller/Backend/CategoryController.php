<?php

namespace Addons\TopicDemo\Http\Controller\Backend;

use Addons\TopicDemo\Http\Request\Backend\CategoryRequest;
use Addons\TopicDemo\Models\Category;
use Addons\TopicDemo\Models\Topic;
use App\Http\Controllers\Backend\Api\V1\BaseController;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

    public function index(Request $request)
    {
        $categories = Category::query()
            ->withCount(['topics'])
            ->orderBy('sort')
            ->paginate($request->input('size', 10));

        return $this->successData([
            'data' => $categories->items(),
            'total' => $categories->total(),
        ]);
    }

    public function create()
    {
        return $this->successData();
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->filldata();
        Category::create($data);
        return $this->success();
    }

    public function edit($id)
    {
        $category = Category::query()->where('id', $id)->firstOrFail();
        return $this->successData($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::query()->where('id', $id)->firstOrFail();
        $data = $request->filldata();
        $category->fill($data)->save();
        return $this->success();
    }

    public function destroy($id)
    {
        if (Topic::query()->where('category_id', $id)->exists()) {
            return $this->error('该分类下存在文章无法删除');
        }
        Category::query()->where('id', $id)->delete();
        return $this->success();
    }

}