<?php

namespace Addons\TopicDemo\Event;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TopicUpdatedEvent
{
    use Dispatchable, SerializesModels;

    public $id;

    public $data = [];

    public function __construct($courseId, $title, $desc)
    {
        $this->id = $courseId;
        $this->data = [
            'title' => $title,
            'desc' => $desc,
        ];
    }

}