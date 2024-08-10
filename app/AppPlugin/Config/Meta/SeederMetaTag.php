<?php

namespace App\AppPlugin\Config\Meta;
use Illuminate\Database\Seeder;

class SeederMetaTag extends Seeder {

    public function run(): void {
        SeedDbFile('config_meta_tag.sql');
        SeedDbFile('config_meta_tag_translations.sql');
    }
}
