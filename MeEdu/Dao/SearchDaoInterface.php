<?php

namespace Addons\TopicDemo\MeEdu\Dao;

interface SearchDaoInterface
{

    public function find(string $type, int $id): array;

    public function store(string $type, int $id, string $title, string $thumb, int $charge, string $shortDesc, string $content): void;

    public function update(string $type, int $id, string $title, string $thumb, int $charge, string $shortDesc, string $content): void;

    public function destroy(string $type, int $id): void;
}