<?php

namespace Addons\TopicDemo\MeEdu\Dao;

use App\Services\Other\Models\SearchRecord;
use Illuminate\Support\Facades\Log;

class SearchDao implements SearchDaoInterface
{
    public function find(string $type, int $id): array
    {
        $data = SearchRecord::query()->where('resource_type', $type)->where('resource_id', $id)->first();
        return $data ? $data->toArray() : [];
    }

    public function store(string $type, int $id, string $title, string $thumb, int $charge, string $shortDesc, string $content): void
    {
        SearchRecord::create([
            'resource_type' => $type,
            'resource_id' => $id,
            'title' => $title,
            'thumb' => $thumb,
            'charge' => $charge,
            'short_desc' => $shortDesc,
            'desc' => $content,
        ]);
    }

    public function update(string $type, int $id, string $title, string $thumb, int $charge, string $shortDesc, string $content): void
    {
        SearchRecord::query()
            ->where('resource_type', $type)
            ->where('resource_id', $id)
            ->update([
                'title' => $title,
                'thumb' => $thumb,
                'charge' => $charge,
                'short_desc' => $shortDesc,
                'desc' => $content,
            ]);
    }

    public function destroy(string $type, int $id): void
    {
        SearchRecord::query()
            ->where('resource_type', $type)
            ->where('resource_id', $id)
            ->delete();
    }


}