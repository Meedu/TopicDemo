<?php

namespace Addons\TopicDemo\MeEdu;

use Addons\TopicDemo\MeEdu\Dao\SearchDao;
use Addons\TopicDemo\MeEdu\Dao\SearchDaoInterface;
use Addons\TopicDemo\MeEdu\Dao\TopicDao;
use Addons\TopicDemo\MeEdu\Dao\TopicDaoInterface;
use Addons\TopicDemo\MeEdu\Service\SearchService;
use Addons\TopicDemo\MeEdu\Service\SearchServiceInterface;
use Addons\TopicDemo\MeEdu\Service\TopicService;
use Addons\TopicDemo\MeEdu\Service\TopicServiceInterface;

class Init
{

    const DAO = [
        TopicDaoInterface::class => TopicDao::class,
        SearchDaoInterface::class => SearchDao::class,
    ];

    const SERVICE = [
        TopicServiceInterface::class => TopicService::class,
        SearchServiceInterface::class => SearchService::class,
    ];

    public static function register()
    {
        foreach (self::DAO as $interface => $object) {
            app()->instance($interface, app()->make($object));
        }
        foreach (self::SERVICE as $interface => $object) {
            app()->instance($interface, app()->make($object));
        }
    }

}