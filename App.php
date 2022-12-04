<?php

namespace Addons\TopicDemo;

use App\Models\AdministratorPermission;
use Illuminate\Support\Facades\Artisan;

class App
{
    const PERMISSIONS = [
        [
            'group' => '图文分类',
            'children' => [
                [
                    'display_name' => '列表',
                    'slug' => 'demo-topic.category.index',
                    'method' => 'GET',
                    'url' => 'addons/TopicDemo/category/index',
                ],
                [
                    'display_name' => '创建',
                    'slug' => 'demo-topic.category.create',
                    'method' => 'GET|POST',
                    'url' => 'addons/TopicDemo/category/create',
                ],
                [
                    'display_name' => '编辑',
                    'slug' => 'demo-topic.category.edit',
                    'method' => 'GET|PUT',
                    'url' => 'addons/TopicDemo/category/\d+',
                ],
                [
                    'display_name' => '删除',
                    'slug' => 'demo-topic.category.destroy',
                    'method' => 'DELETE',
                    'url' => 'addons/TopicDemo/category/\d+',
                ],
            ],
        ],
        [
            'group' => '图文',
            'children' => [
                [
                    'display_name' => '列表',
                    'slug' => 'demo-topic.topic.index',
                    'method' => 'GET',
                    'url' => 'addons/TopicDemo/topic/index',
                ],
                [
                    'display_name' => '创建',
                    'slug' => 'demo-topic.topic.create',
                    'method' => 'GET|POST',
                    'url' => 'addons/TopicDemo/topic/create',
                ],
                [
                    'display_name' => '编辑',
                    'slug' => 'demo-topic.topic.edit',
                    'method' => 'GET|PUT',
                    'url' => 'addons/TopicDemo/topic/\d+',
                ],
                [
                    'display_name' => '删除',
                    'slug' => 'demo-topic.topic.destroy',
                    'method' => 'DELETE',
                    'url' => 'addons/TopicDemo/topic/\d+',
                ],
            ],
        ],
    ];

    public static function install()
    {
        Artisan::call(
            'migrate',
            [
                '--path' => base_path('/addons/TopicDemo/database/migrations'),
                '--realpath' => true,
                '--force' => true,
            ]
        );

        self::installPermission();
    }

    public static function uninstall()
    {
        self::uninstallPermission();
    }

    public static function upgrade()
    {
        Artisan::call(
            'migrate',
            [
                '--path' => base_path('/addons/TopicDemo/database/migrations'),
                '--realpath' => true,
                '--force' => true,
            ]
        );

        self::installPermission();
    }

    protected static function uninstallPermission()
    {
        $slugArr = [];
        foreach (self::PERMISSIONS as $groupItem) {
            $slugArr = array_merge($slugArr, array_column($groupItem['children'], 'slug'));
        }
        AdministratorPermission::query()
            ->whereIn('slug', $slugArr)
            ->delete();
    }

    protected static function installPermission()
    {
        foreach (self::PERMISSIONS as $groupItem) {
            $groupName = $groupItem['group'];
            foreach ($groupItem['children'] as $permissionItem) {
                //检测权限是否存在
                $permission = AdministratorPermission::query()
                    ->where('slug', $permissionItem['slug'])
                    ->first();

                $data = array_merge($permissionItem, [
                    'display_name' => $groupName . '-' . $permissionItem['display_name'],
                    'group_name' => '图文演示',
                    'description' => '',
                ]);

                if ($permission) {
                    $permission->fill($data)->save();
                } else {
                    AdministratorPermission::create($data);
                }
            }
        }
    }

}