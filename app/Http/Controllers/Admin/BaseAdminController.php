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
                'name' => 'Компании',
                'route' => 'admin.company.index',
                'routeIs' => 'admin.company.*',
                'sub' => []
            ],
            [
                'name' => 'Группы',
                'route' => 'admin.group.index',
                'routeIs' => 'admin.group.*',
                'sub' => []
            ],
            [
                'name' => 'Предложения',
                'route' => 'admin.offer.index',
                'routeIs' => 'admin.offer.*',
                'sub' => []
            ],
            [
                'name' => 'Резюме',
                'route' => 'admin.resume.index',
                'routeIs' => 'admin.resume.*',
                'sub' => []
            ],
            [
                'name' => 'Вакансии',
                'route' => 'admin.vacancy.index',
                'routeIs' => 'admin.vacancy.*',
                'sub' => []
            ],
            [
                'name' => 'События',
                'route' => 'admin.event.index',
                'routeIs' => 'admin.event.*',
                'sub' => []
            ],
            [
                'name' => 'Новости',
                'route' => 'admin.news.index',
                'routeIs' => 'admin.news.*',
                'sub' => []
            ],
            [
                'name' => 'Проекты',
                'route' => 'admin.project.index',
                'routeIs' => 'admin.project.*',
                'sub' => []
            ],
            [
                'name' => 'Прочее',
                'route' => '',
                'sub' => [
                    [
                        'name' => 'Категории групп',
                        'route' => 'admin.groupCategory.index'
                    ],
                    [
                        'name' => 'Категории предложений',
                        'route' => 'admin.offerCategory.index'
                    ]
                ]
            ]
        ];
    }
}
