<?php

namespace Database\Seeders;

use App\AppCore\AdminRole\Seeder\PermissionSeeder;
use App\AppCore\AdminRole\Seeder\AdminUserSeeder;
use App\AppCore\AdminRole\Seeder\RoleSeeder;
use App\AppCore\AdminRole\Seeder\UsersTableSeeder;
use App\AppCore\Menu\AdminMenuSeeder;
use App\AppPlugin\Product\Seeder\ProductSeeder;
use App\Http\Traits\Files\AppSettingFileTraits;
use App\Http\Traits\Files\CrmServiceFileTraits;
use App\Http\Traits\Files\CustomersFileTraits;
use App\Http\Traits\Files\DataFileTraits;
use App\Http\Traits\Files\PeriodicalsFileTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder {

    public function run(): void {

        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminMenuSeeder::class);

        AppSettingFileTraits::LoadSeeder();
        DataFileTraits::LoadSeeder();

        CustomersFileTraits::LoadSeeder();
        PeriodicalsFileTraits::LoadSeeder();
        CrmServiceFileTraits::LoadSeeder();

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $this->call(ProductSeeder::class);
        }

        $this->call(ModelSeeder::class);


    }
}
