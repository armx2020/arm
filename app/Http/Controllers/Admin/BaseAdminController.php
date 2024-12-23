<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

abstract class BaseAdminController extends Controller
{
    protected $menu = [];

    public function __construct()
    {
        $this->menu = [
            [
                'name' => 'Моя страница',
                'route' => 'dashboard',
                'routeIs' => 'dashboard',
                'sub' => []
            ],
            [
                'name' => 'Главная',
                'route' => 'admin.dashboard',
                'routeIs' => 'admin.dashboard',
                'sub' => []
            ],
            [
                'name' => 'Пользователи',
                'route' => 'admin.user.index',
                'routeIs' => 'admin.user.*',
                'sub' => []
            ],
            [
                'name' => 'Сущности',
                'route' => 'admin.entity.index',
                'routeIs' => 'admin.entity.*',
                'sub' => []
            ],
            [
                'name' => 'Предложения',
                'route' => 'admin.offer.index',
                'routeIs' => 'admin.offer.*',
                'sub' => []
            ],
            [
                'name' => 'Работа',
                'route' => 'admin.work.index',
                'routeIs' => 'admin.work.*',
                'sub' => []
            ],
            [
                'name' => 'Прочее',
                'route' => '',
                'sub' => [
                    [
                        'name' => 'Категории',
                        'route' => 'admin.category.index'
                    ],
                    [
                        'name' => 'Типы',
                        'route' => 'admin.type.index'
                    ],
                ]
            ]
        ];
    }
}
