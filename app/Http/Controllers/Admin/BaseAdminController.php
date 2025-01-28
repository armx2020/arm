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
                'name' => 'ЛК',
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
                'route' => '',
                'routeIs' => 'admin.entity.*',
                'sub' => [
                    [
                        'name' => 'Сущности',
                        'route' => 'admin.entity.index',
                        'routeIs' => 'admin.entity.*',
                    ],
                    [
                        'name' => 'Сводка',
                        'route' => 'admin.entity.report',
                        'routeIs' => 'admin.entity.report.*',
                    ],
                ]
            ],








            [
                'name' => 'Товары',
                'route' => 'admin.offer.index',
                'routeIs' => 'admin.offer.*',
                'sub' => []
            ],
            [
                'name' => 'Категории',
                'route' => 'admin.category.index',
                'routeIs' => 'admin.category.*',
                'sub' => []
            ],
            [
                'name' => 'Направления',
                'route' => 'admin.category-entity.index',
                'routeIs' => 'admin.category-entity.*',
                'sub' => []
            ],
            [
                'name' => 'Импорт',
                'route' => '',
                'sub' => [
                    [
                        'name' => 'церкви',
                        'route' => 'admin.import.church',
                        'routeIs' => 'admin.import.church.*',
                    ],
                    [
                        'name' => 'сущности',
                        'route' => 'admin.import.entity',
                        'routeIs' => 'admin.import.entity.*',
                    ],
                    [
                        'name' => 'адвокаты',
                        'route' => 'admin.import.lawyer',
                        'routeIs' => 'admin.import.lawyer.*',
                    ],
                ]
            ],
            [
                'name' => 'Типы',
                'route' => 'admin.type.index',
                'routeIs' => 'admin.type.*',
                'sub' => []
            ],


        ];
    }
}
