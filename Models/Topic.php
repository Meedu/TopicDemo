<?php

namespace Addons\TopicDemo\Models;

use Addons\MeeduTopics\Models\TopicCategory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $table = 'demo_topics';

    protected $fillable = [
        'category_id', 'title', 'content', 'published_at',
    ];

    public function category()
    {
        return $this->belongsTo(TopicCategory::class, 'category_id');
    }

}