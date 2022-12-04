<?php

namespace Addons\TopicDemo\MeEdu\Service;

use Addons\TopicDemo\Constants\Constant;
use Addons\TopicDemo\MeEdu\Dao\SearchDaoInterface;
use Illuminate\Support\Facades\Log;

class SearchService implements SearchServiceInterface
{
    protected $searchDao;

    public function __construct(SearchDaoInterface $searchDao)
    {
        $this->searchDao = $searchDao;
    }

    public function createOrUpdateSync(int $id, string $title, string $content): void
    {
        if ($this->searchDao->find(Constant::SEARCH_RESOURCE_TYPE, $id)) {
            Log::info(__METHOD__, compact('id', 'title', 'content'));
            $this->searchDao->update(
                Constant::SEARCH_RESOURCE_TYPE,
                $id,
                $title,
                '',
                0,
                '',
                $content
            );
            return;
        }
        $this->searchDao->store(
            Constant::SEARCH_RESOURCE_TYPE,
            $id,
            $title,
            '',
            0,
            '',
            $content
        );
    }

    public function destroy(int $id): void
    {
        $this->searchDao->destroy(Constant::SEARCH_RESOURCE_TYPE, $id);
    }

}