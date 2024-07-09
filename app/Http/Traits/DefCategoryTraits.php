<?php

namespace App\Http\Traits;

trait DefCategoryTraits {

    static function LoadCategory() {
        $Cat = [];

        $Cat['gender'] = [
            (object) ['id' => 1, 'name' => __('admin/defCat.gender_1')],
            (object) ['id' => 2, 'name' => __('admin/defCat.gender_2')],
        ];

        return $Cat;
    }


}
