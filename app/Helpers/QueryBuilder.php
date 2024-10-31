<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class QueryBuilder {
    protected $table;
    protected $tableTrans;
    protected $tableTransForeign;
    protected $locale;
    protected $tableCategory;
    protected $tableCategoryTrans;
    protected $tableCategoryPivot;
    protected $tableBrand;
    protected $tableBrandTrans;
    protected $dataSend;


    public function __construct($config,$dataSend) {
        $this->locale = dataTableDefLang();
        $this->table = $config['DbPost'];
        $this->tableTrans = $config['DbPostTrans'];
        $this->tableTransForeign = $config['DbPostForeignId'];
        $this->tableCategory = $config['DbCategory'];
        $this->tableCategoryTrans = $config['DbCategoryTrans'];
        $this->tableCategoryPivot = $config['DbCategoryPivot'];
        $this->tableBrand = $config['DbBrand'];
        $this->tableBrandTrans = $config['DbBrandTrans'];

        $this->dataSend = $dataSend;
    }

    // إعداد الاستعلام الأساسي
    public function initQuery() {
        $query = DB::table($this->table);
        return $query;
    }


    // دالة فلترة العرض
    public function applyPageViewFilter($data,$pageView) {
        if ($pageView == 'SoftDelete') {
            $data->whereNotNull("$this->table.deleted_at");
        } elseif ($pageView == 'Archived') {
            $data->whereNull("$this->table.deleted_at")->where("$this->table.is_archived", true);
        } else {
            $data->whereNull("$this->table.deleted_at")->where("$this->table.is_archived", false);
        }
        return $data;
    }

//    // دالة الفلترة العامة
//    protected function ProductQueryFilter($data, $session, $table, $table_trans, $table_category) {
//        // فلترة العلامة التجارية
//        if (isset($session['brand_id']) && $session['brand_id'] != null) {
//            $data->where("$table.brand_id", $session['brand_id']);
//        }
//
//        // فلترة المجموعات
//        if (isset($session['category_ids']) && !empty($session['category_ids'])) {
//            $data->whereIn("$table_category.id", $session['category_ids']);
//        }
//
//        return $data;
//    }

    // دالة الانضمام
    protected function applyJoins($data, $table, $table_trans, $table_trans_foreign, $table_category, $table_category_trans, $table_category_pivot, $table_brand, $table_brand_trans, $table_brand_trans_foreign) {
        $data->leftJoin($table_trans, function ($join) use ($table, $table_trans, $table_trans_foreign) {
            $join->on("$table.id", '=', "$table_trans.$table_trans_foreign")
                ->where("$table_trans.locale", '=', $this->locale);
        });

        $data->leftJoin($table_category_pivot, "$table.id", '=', "$table_category_pivot.$table_trans_foreign")
            ->leftJoin($table_category, "$table_category_pivot.category_id", '=', "$table_category.id")
            ->leftJoin($table_category_trans, function ($join) use ($table_category, $table_category_trans) {
                $join->on("$table_category.id", '=', "$table_category_trans.category_id")
                    ->where("$table_category_trans.locale", '=', $this->locale);
            });

        $data->leftJoin($table_brand, "$table.brand_id", '=', "$table_brand.id")
            ->leftJoin($table_brand_trans, function ($join) use ($table_brand, $table_brand_trans, $table_brand_trans_foreign) {
                $join->on("$table_brand.id", '=', "$table_brand_trans.$table_brand_trans_foreign")
                    ->where("$table_brand_trans.locale", '=', $this->locale);
            });

        return $data;
    }

//    // دالة تحديد الأعمدة
//    protected function applySelects($data, $table, $table_trans, $table_category, $table_category_trans, $table_brand, $table_brand_trans) {
//        $data->select(
//            "$table.id as id",
//            DB::raw("MAX($table.is_active) as is_active"),
//            DB::raw("MAX($table.deleted_at) as deleted_at"),
//            DB::raw("MAX($table.price) as price"),
//            DB::raw("MAX($table.regular_price) as regular_price"),
//            DB::raw("MAX($table.is_active) as isActive"),
//            DB::raw("MAX($table.photo_thum_1) as photo"),
//            DB::raw("MAX($table_trans.name) as name"),
//            DB::raw("MAX($table_trans.slug) as slug")
//        );
//
//        $data->addSelect(
//            DB::raw("GROUP_CONCAT(CONCAT($table_category.id, ':', $table_category_trans.name)) as category_names"),
//            DB::raw("MAX($table.brand_id) as brand_id"),
//            DB::raw("MAX($table_brand_trans.name) as brand_name"),
//            DB::raw("COUNT(children.id) as children_count") // احتساب عدد الأبناء
//        );
//
//        return $data;
//    }
//

}
