<?php

namespace Addons\TopicDemo\MeEdu\Service;

interface SearchServiceInterface
{

    public function createOrUpdateSync(int $id, string $title, string $content): void;

    public function destroy(int $id): void;

}