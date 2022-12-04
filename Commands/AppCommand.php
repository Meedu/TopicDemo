<?php

namespace Addons\TopicDemo\Commands;

use Addons\TopicDemo\App;
use Illuminate\Console\Command;

class AppCommand extends Command
{

    protected $signature = 'TopicDemo {action}';

    protected $description = '';

    public function handle()
    {
        $action = $this->argument('action');
        $method = 'action' . ucfirst($action);
        $this->{$method}();
    }

    protected function actionInstall()
    {
        App::install();
    }

    protected function actionUninstall()
    {
        App::uninstall();
    }

    protected function actionUpgrade()
    {
        App::upgrade();
    }

}