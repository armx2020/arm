<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rinvex\Country\Loader;
use morphos\Russian\GeographicalNamesInflection;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countryLoader = new Loader();
        $countries = $countryLoader->countries(true, 'ru');

        foreach ($countries as $code => $country) {
            if (isset($country->getTranslations()['rus'])) {
                DB::table('countries')->updateOrInsert(
                    ['name_ru' => $country->getTranslations()['rus']['common']],
                    [
                        'name_ru_locative' => 'в ' . $this->name_ru_locative($country->getTranslations()['rus']['common']),
                        'name_en' => $country->getName(),
                        'code' => $code,
                    ]
                );
            }
        }
    }

    private function name_ru_locative($name)
    {
        return GeographicalNamesInflection::getCase($name, 'locative');
    }
}
