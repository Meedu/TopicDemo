<?php

namespace Addons\TopicDemo;

use Addons\TopicDemo\Commands\AppCommand;
use Addons\TopicDemo\Event\TopicCreatedEvent;
use Addons\TopicDemo\Event\TopicDestroyEvent;
use Addons\TopicDemo\Event\TopicUpdatedEvent;
use Addons\TopicDemo\MeEdu\Init;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
{

    protected $events = [
        TopicCreatedEvent::class => [
            'Addons\TopicDemo\Listener\TopicCreatedEvent\SearchSyncListener',
        ],
        TopicUpdatedEvent::class => [
            'Addons\TopicDemo\Listener\TopicUpdatedEvent\SearchSyncListener',
        ],
        TopicDestroyEvent::class => [
            'Addons\TopicDemo\Listener\TopicDestroyEvent\SearchSyncListener',
        ],
    ];

    public function boot()
    {
        Init::register();

        $this->commands([
            AppCommand::class,
        ]);

        $this->loadRoutesFrom(__DIR__ . '/routes/backend.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        foreach ($this->events as $eventName => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($eventName, $listener);
            }
        }
    }

}