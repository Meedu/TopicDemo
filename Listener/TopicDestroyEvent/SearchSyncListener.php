<?php

namespace Addons\TopicDemo\Listener\TopicDestroyEvent;

use Addons\TopicDemo\Event\TopicDestroyEvent;
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

    public function handle(TopicDestroyEvent $event)
    {
        $this->searchService->destroy($event->id);
    }

}