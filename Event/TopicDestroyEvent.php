<?php

namespace Addons\TopicDemo\Event;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TopicDestroyEvent
{
    use Dispatchable, SerializesModels;

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}