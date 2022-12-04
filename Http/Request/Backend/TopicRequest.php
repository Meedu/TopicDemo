<?php

namespace Addons\TopicDemo\Http\Request\Backend;

use App\Http\Requests\Backend\BaseRequest;
use Carbon\Carbon;

class TopicRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'category_id' => 'required',
            'title' => 'required|max:140',
            'content' => 'required',
            'published_at' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => '请选择分类',
            'title.required' => '请输入标题',
            'title.max' => '标题长度不能超过140个字符',
            'content.required' => '请输入内容',
            'published_at.required' => '请选择上架时间',
        ];
    }

    public function filldata()
    {
        return [
            'category_id' => (int)$this->input('category_id'),
            'title' => $this->input('title'),
            'content' => $this->input('content'),
            'published_at' => Carbon::parse($this->input('published_at'))->toDateTimeLocalString(),
        ];
    }

}