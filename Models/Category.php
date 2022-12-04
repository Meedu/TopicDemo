<?php

namespace Addons\TopicDemo\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'demo_topic_categories';

    protected $fillable = [
        'name', 'sort',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class, 'category_id');
    }

}