<?php

namespace App\Services;

use App\Models\City;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Region;
use App\Models\SiteMap;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Sitemap\SitemapGenerator;
use Carbon\Carbon;
use Spatie\Sitemap\Tags\Url;

class SiteMapService
{
    private $entity_types =
    [
        1 => 'company',
        2 => 'group',
        3 => 'place',
        4 => 'community'
    ];

    private $site_map_types =
    [
        'домашняя (общая)'          => 1,
        'домашняя (область)'        => 2,
        'домашняя (город)'          => 3,
        'тип сущности (общая)'      => 4,
        'тип сущности (область)'    => 5,
        'тип сущности (город)'      => 6,
        'категория (общая)'         => 7,
        'категория (область)'       => 8,
        'категория (город)'         => 9,
        'сущность'                  => 10,
    ];

    public function create()
    {
        // Страницы регионов
        $this->pageForRegions();

        // Страницы городов
        $this->pageForCities();

        // Страницы сущности
        $this->pageForEntities();
    }

    public function pageForRegions()
    {
        $entity_types = EntityType::with('categories')->active()->get();

        Region::chunk(50, function (Collection $regions) use ($entity_types) {

            foreach ($regions as $region) {

                $count = null;

                if ($region->id == 1) {
                    $url = 'https://vsearmyane.ru';
                    $name = 'Сообщество армян в России';
                    $description = "Сообщество армян в России";
                    $site_map_type = $this->site_map_types['домашняя (общая)'];
                } else {
                    $url = 'https://vsearmyane.ru'  . '/' . $region->transcription;
                    $name = $region->name;
                    $description = "Сообщество армян в России: {{ strtolower($region->name) }}";
                    $site_map_type = $this->site_map_types['домашняя (область)'];
                }

                SiteMap::updateOrCreate(
                    [
                        'url' => $url
                    ],
                    [
                        'site_map_type_id' => $site_map_type,
                        'name' => $name,
                        'title' => $name,
                        'description' => $description,
                        'quantity_entity' => null,
                        'region_id' => $region->id,
                        'city_id' => null,
                        'entity_type_id' => null,
                        'category_id' => null,
                        'entity_id' => null,
                        'index' => true
                    ]
                );

                // Типы сущностей в регионе
                foreach ($entity_types as $type) {

                    if ($region->id == 1) {
                        $name =  "Сообщество армян в России - " . strtolower($type->name);
                        $description = "Сообщество армян в России - " . strtolower($type->name);
                        $site_map_type = $this->site_map_types['тип сущности (общая)'];
                    } else {
                        $name = $region->name . " - " . strtolower($type->name);
                        $description = $region->name . " - " . strtolower($type->name);
                        $site_map_type = $this->site_map_types['тип сущности (область)'];
                    }

                    $count = Entity::active()
                        ->where('entity_type_id', $type->id)
                        ->where('region_id', $region->id)
                        ->count();

                    SiteMap::updateOrCreate(
                        [
                            'url' => $url . '/' . $type->transcription
                        ],
                        [
                            'site_map_type_id' => $site_map_type,
                            'name' => $name,
                            'title' => $name,
                            'description' => $description,
                            'quantity_entity' => $count,
                            'region_id' => $region->id,
                            'city_id' => null,
                            'entity_type_id' => $type->id,
                            'category_id' => null,
                            'entity_id' => null,
                            'index' => true
                        ]
                    );

                    // Категории сущностей в регионе
                    foreach ($type->categories as $category) {
                        if ($category->activity) {

                            if ($region->id == 1) {
                                $name =  "Сообщество армян в России - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $description = "Сообщество армян в России - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $site_map_type = $this->site_map_types['категория (общая)'];
                            } else {
                                $name = $region->name . " - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $description = $region->name . " - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $site_map_type = $this->site_map_types['категория (область)'];
                            }

                            $count = Entity::active()
                                ->where('entity_type_id', $type->id)
                                ->where('region_id', $region->id)
                                ->count();

                            $count = Entity::active()
                                ->where('entity_type_id', $type->id)
                                ->where('region_id', $region->id)
                                ->where(function (Builder $query) use ($category) {
                                    $query
                                        ->where('category_id', $category->id)
                                        ->orWhereHas('fields', function ($que) use ($category) {
                                            $que->where('category_entity.main_category_id', '=', $category->id);
                                        });
                                })->count();

                            SiteMap::updateOrCreate(
                                [
                                    'url' => $url . '/' . $type->transcription . '/' . $category->transcription
                                ],
                                [
                                    'site_map_type_id' => $site_map_type,
                                    'name' => $name,
                                    'title' => $name,
                                    'description' => $description,
                                    'quantity_entity' => $count,
                                    'region_id' => $region->id,
                                    'city_id' => null,
                                    'entity_type_id' => $type->id,
                                    'category_id' => $category->id,
                                    'entity_id' => null,
                                    'index' => true
                                ]
                            );
                        }
                    }
                }
            }
        });
    }

    public function pageForCities()
    {
        $entity_types = EntityType::with('categories')->active()->get();

        City::chunk(50, function (Collection $cities) use ($entity_types) {

            foreach ($cities as $city) {

                $count = null;

                if ($city->id == 1) {
                    $url = 'https://vsearmyane.ru';
                    $name = 'Сообщество армян в России';
                    $description = "Сообщество армян в России";
                    $site_map_type = $this->site_map_types['домашняя (общая)'];
                } else {
                    $url = 'https://vsearmyane.ru'  . '/' . $city->transcription;
                    $name = $city->name;
                    $description = "Сообщество армян в России: - " . $city->name;
                    $site_map_type = $this->site_map_types['домашняя (город)'];
                }

                SiteMap::updateOrCreate(
                    [
                        'url' => $url
                    ],
                    [
                        'site_map_type_id' => $site_map_type,
                        'name' => $name,
                        'title' => $name,
                        'description' => $description,
                        'quantity_entity' => null,
                        'region_id' => $city->region_id,
                        'city_id' => $city->id,
                        'entity_type_id' => null,
                        'category_id' => null,
                        'entity_id' => null,
                        'index' => true
                    ]
                );

                // Типы сущностей в городе
                foreach ($entity_types as $type) {

                    if ($city->id == 1) {
                        $name =  "Сообщество армян в России - " . strtolower($type->name);
                        $description = "Сообщество армян в России - " . strtolower($type->name);
                        $site_map_type = $this->site_map_types['тип сущности (общая)'];
                    } else {
                        $name = $city->name . " - " . strtolower($type->name);
                        $description = $city->name . " - " . strtolower($type->name);
                        $site_map_type = $this->site_map_types['тип сущности (город)'];
                    }

                    $count = Entity::active()
                        ->where('entity_type_id', $type->id)
                        ->where('city_id', $city->id)
                        ->count();

                    SiteMap::updateOrCreate(
                        [
                            'url' => $url . '/' . $type->transcription
                        ],
                        [
                            'site_map_type_id' => $site_map_type,
                            'name' => $name,
                            'title' => $name,
                            'description' => $description,
                            'quantity_entity' => $count,
                            'region_id' => $city->region_id,
                            'city_id' => $city->id,
                            'entity_type_id' => $type->id,
                            'category_id' => null,
                            'entity_id' => null,
                            'index' => true
                        ]
                    );

                    // Категории сущностей в городе
                    foreach ($type->categories as $category) {
                        if ($category->activity) {

                            if ($city->id == 1) {
                                $name =  "Сообщество армян в России - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $description = "Сообщество армян в России - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $site_map_type = $this->site_map_types['категория (общая)'];
                            } else {
                                $name = $city->name . " - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $description = $city->name . " - " . strtolower($type->name) . " - " . strtolower($category->name);
                                $site_map_type = $this->site_map_types['категория (город)'];
                            }

                            $count = Entity::active()
                                ->where('entity_type_id', $type->id)
                                ->where('city_id', $city->id)
                                ->count();

                            $count = Entity::active()
                                ->where('entity_type_id', $type->id)
                                ->where('city_id', $city->id)
                                ->where(function (Builder $query) use ($category) {
                                    $query
                                        ->where('category_id', $category->id)
                                        ->orWhereHas('fields', function ($que) use ($category) {
                                            $que->where('category_entity.main_category_id', '=', $category->id);
                                        });
                                })->count();

                            SiteMap::updateOrCreate(
                                [
                                    'url' => $url . '/' . $type->transcription . '/' . $category->transcription
                                ],
                                [
                                    'site_map_type_id' => $site_map_type,
                                    'name' => $name,
                                    'title' => $name,
                                    'description' => $description,
                                    'quantity_entity' => $count,
                                    'region_id' => $city->region_id,
                                    'city_id' => $city->id,
                                    'entity_type_id' => $type->id,
                                    'category_id' => $category->id,
                                    'entity_id' => null,
                                    'index' => true
                                ]
                            );
                        }
                    }
                }
            }
        });
    }

    public function pageForEntities()
    {
        Entity::chunk(50, function (Collection $entities) {
            foreach ($entities as $entity) {
                if ($entity->activity) {

                    $type = $this->entity_types[$entity->type->id];

                    SiteMap::updateOrCreate(
                        [
                            'url' => 'https://vsearmyane.ru' . '/' . $type . '/' . $entity->id
                        ],
                        [
                            'site_map_type_id' => 10,
                            'name' => $entity->name,
                            'title' => $entity->type->name  . ' - ' . $entity->name,
                            'description' => $entity->description,
                            'quantity_entity' => null,
                            'region_id' => $entity->region_id,
                            'city_id' => $entity->city_id,
                            'entity_type_id' => $entity->entity_type_id,
                            'category_id' => $entity->category_id,
                            'entity_id' => $entity->id,
                            'index' => true
                        ]
                    );

                    SiteMap::updateOrCreate(
                        [
                            'url' => 'https://vsearmyane.ru' . '/' . $type . '/' . $entity->transcription
                        ],
                        [
                            'site_map_type_id' => 10,
                            'name' => $entity->name,
                            'title' => $entity->type->name  . ' - ' . $entity->name,
                            'description' => $entity->description,
                            'quantity_entity' => null,
                            'region_id' => $entity->region_id,
                            'city_id' => $entity->city_id,
                            'entity_type_id' => $entity->entity_type_id,
                            'category_id' => $entity->category_id,
                            'entity_id' => $entity->id,
                            'index' => true
                        ]
                    );
                }
            }
        });
    }

    public function addFile()
    {
        $path = public_path('sitemap.xml');
        $sitemapGenerat = SitemapGenerator::create(env('APP_URL'))
            ->getSitemap();

        SiteMap::chunk(50, function (Collection $sitemaps) use ($path, $sitemapGenerat) {

            foreach ($sitemaps as $sitemap) {
                $sitemapGenerat->add(Url::create($sitemap->url)
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                        ->setPriority(0.1))
                    ->writeToFile($path);
            }
        });
    }
}
