<?php

namespace App\AppPlugin\Data\ConfigData\Seeder;


use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\Area\Models\AreaTranslation;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\City\Models\CityTranslation;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\AppPlugin\Data\Country\Country;
use App\AppPlugin\Data\Country\CountryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ConfigDataSeeder extends Seeder {

    public function run(): void {


        SeedDbFile(ConfigData::class, 'config_data.sql');
        SeedDbFile(ConfigDataTranslation::class, 'config_data_translations.sql');

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            SeedDbFile(Country::class, 'data_countries.sql', false);
            SeedDbFile(CountryTranslation::class, 'data_country_translations.sql', false);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            SeedDbFile(City::class, 'data_city.sql');
            SeedDbFile(CityTranslation::class, 'data_city_translations.sql');
        }


        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            SeedDbFile(Area::class, 'data_area.sql');
            SeedDbFile(AreaTranslation::class, 'data_area_translations.sql');
        }


    }

}
