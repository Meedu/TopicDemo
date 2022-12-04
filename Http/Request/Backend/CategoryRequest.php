<?php

namespace Addons\TopicDemo\Http\Request\Backend;

use App\Http\Requests\Backend\BaseRequest;

class CategoryRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入分类名',
            'name.max' => '分类名长度不能超过20个字符',
        ];
    }

    public function filldata()
    {
        return [
            'name' => $this->input('name'),
            'sort' => (int)$this->input('sort'),
        ];
    }

}