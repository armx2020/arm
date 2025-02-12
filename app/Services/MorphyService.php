<?php

namespace App\Services;

use App\Libraries\NameCase\NCLNameCaseRu;
use Illuminate\Database\Eloquent\Collection;

class MorphyService
{
    public $nameCase;

    public function __construct()
    {
        $this->nameCase = new NCLNameCaseRu();
    }

    public function setDative($region)
    {
        $region->chunk(50, function (Collection $regions) {

            foreach ($regions as $region) {
                if ($region->id !== 1) {
                    $region->update([
                        $region->name_dat = $this->nameCase->q($region->name)[5]
                    ]);
                }
            }
        });
    }

    public function to_prepositional($str)
    {
        if (in_array(substr($str, -1), ['и', 'о', 'е', 'ё', 'э'])) return $str;
        if (in_array(substr($str, -3), ['ово', 'ево', 'ино', 'ыно'])) return $str;

        $custom_cities = [
            'Москва' => 'в Москве',
            'Ростов-на-Дону' => 'в Ростове-на-Дону',
            'Ростов-на-дону' => 'в Ростове-на-Дону',
            'Калач-на-Дону' => 'в Калаче-на-Дону',
            'Железногорск (Красноярский край)' => 'в Железногорске',
            'Железногорск (Курская область)' => 'в Железногорске',
            'не выбрано' => 'не выбрано'
        ];

        if (isset($custom_cities[$str])) return $custom_cities[$str];

        if (substr_count($str, ' ') > 0) {
            $str = mb_strstr($str, ' ', true);
        }

        $replace = array();
        $replace['2'][] = array('ия', 'ии');
        $replace['2'][] = array('ия', 'ии');
        $replace['2'][] = array('ий', 'ом');
        $replace['2'][] = array('ый', 'ом');
        $replace['2'][] = array('ое', 'ом');
        $replace['2'][] = array('ая', 'ой');
        $replace['2'][] = array('ль', 'ле');
        $replace['1'][] = array('а', 'е');
        $replace['1'][] = array('о', 'е');
        $replace['1'][] = array('и', 'ах');
        $replace['1'][] = array('ы', 'ах');
        $replace['1'][] = array('ь', 'и');

        foreach ($replace as $length => $replacement) {
            $str_length = mb_strlen($str, 'UTF-8');
            $find = mb_substr($str, $str_length - $length, $str_length, 'UTF-8');
            foreach ($replacement as $try) {
                if ($find == $try[0]) {
                    $str = mb_substr($str, 0, $str_length - $length, 'UTF-8');
                    $str .= $try['1'];
                    return 'в ' . $str;
                }
            }
        }
        if ($find == 'е') {
            return 'в ' . $str;
        } else {
            return 'в ' . $str . 'е';
        }
    }
}
