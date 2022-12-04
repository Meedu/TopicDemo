<?php

namespace Addons\TopicDemo\Listener\TopicCreatedEvent;

use Addons\TopicDemo\Event\TopicCreatedEvent;
use Addons\TopicDemo\MeEdu\Service\SearchServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SearchSyncListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $searchService;

    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;
    }

    public function handle(TopicCreatedEvent $event)
    {
        $this->searchService->createOrUpdateSync($event->id, $event->data['title'], $event->data['desc']);
    }

}