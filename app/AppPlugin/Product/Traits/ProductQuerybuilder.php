<?php

namespace App\AppPlugin\Product\Traits;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

trait ProductQuerybuilder {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductQuery($config, $dataSend, $session) {
        $table = $config['DbPost'];
        $table_trans = $config['DbPostTrans'];
        $table_trans_foreign = $config['DbPostForeignId'];
        $locale = dataTableDefLang();
        $table_category = $config['DbCategory'];
        $table_category_trans = $config['DbCategoryTrans'];
        $table_category_pivot = $config['DbCategoryPivot'];

        $table_brand = $config['DbBrand'];
        $table_brand_trans = $config['DbBrandTrans'];
        $table_brand_trans_foreign = 'brand_id';


        if ($dataSend['PageView'] == 'SoftDelete') {
            $data = DB::table($table)->whereNotNull("$table.deleted_at");
        } elseif ($dataSend['PageView'] == 'Archived') {
            $data = DB::table($table)->whereNull("$table.deleted_at")->where("$table.is_archived", true);
        } else {
            $data = DB::table($table)->whereNull("$table.deleted_at")->where("$table.is_archived", false);
        }

        $data->whereNull("$table.parent_id");
        $data->leftJoin("$table as children", "$table.id", '=', "children.parent_id");


        self::ProductQueryFilter($data, $session, $table, $table_trans, $table_category);


        $data->leftJoin($table_trans, function ($join) use ($table, $table_trans, $table_trans_foreign, $locale) {
            $join->on("$table.id", '=', "$table_trans.$table_trans_foreign")
                ->where("$table_trans.locale", '=', $locale);
        });

        $data->leftJoin($table_category_pivot, "$table.id", '=', "$table_category_pivot.$table_trans_foreign")
            ->leftJoin($table_category, "$table_category_pivot.category_id", '=', "$table_category.id")
            ->leftJoin($table_category_trans, function ($join) use ($table_category, $table_category_trans, $locale) {
                $join->on("$table_category.id", '=', "$table_category_trans.category_id")
                    ->where("$table_category_trans.locale", '=', $locale);
            });

        $data->leftJoin($table_brand, "$table.brand_id", '=', "$table_brand.id")
            ->leftJoin($table_brand_trans, function ($join) use ($table_brand, $table_brand_trans, $table_brand_trans_foreign, $locale) {
                $join->on("$table_brand.id", '=', "$table_brand_trans.$table_brand_trans_foreign")
                    ->where("$table_brand_trans.locale", '=', $locale);
            });


        $data->select(
            "$table.id as id",
            DB::raw("MAX($table.is_active) as is_active"),
            DB::raw("MAX($table.deleted_at) as deleted_at"),
            DB::raw("MAX($table.price) as price"),
            DB::raw("MAX($table.regular_price) as regular_price"),
            DB::raw("MAX($table.is_active) as isActive"),
            DB::raw("MAX($table.photo_thum_1) as photo"),
            DB::raw("MAX($table_trans.name) as name"),
            DB::raw("MAX($table_trans.slug) as slug"),
        );

        $data->addSelect(
            DB::raw("GROUP_CONCAT(CONCAT($table_category.id, ':', $table_category_trans.name)) as category_names")
        );

        $data->addSelect(
            DB::raw("MAX($table.brand_id) as brand_id"),
            DB::raw("MAX($table_brand_trans.name) as brand_name") // إضافة اسم العلامة التجارية
        );

        $data->addSelect(
            DB::raw("COUNT(children.id) as children_count") // احتساب عدد الأبناء
        );


        $data->groupBy("$table.id");

        return $data;

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductQueryFilter($data, $session, $table, $table_trans, $table_category) {

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $data->whereDate("$table.created_at", '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $data->whereDate("$table.created_at", '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if (isset($session['brand_id']) and $session['brand_id'] != null) {
            $data->where("$table.brand_id", $session['brand_id']);
        };

        if (isset($session['on_stock']) and $session['on_stock'] != null) {
            $data->where("$table.on_stock", $session['on_stock']);
        };

        if (isset($session['is_active']) and $session['is_active'] != null) {
            $data->where("$table.is_active", $session['is_active']);
        }

        if (isset($session['price_from']) and $session['price_from'] != null and intval($session['price_from']) > 0) {
            $data->where("$table.price", ">=", $session['price_from']);
        }

        if (isset($session['price_to']) and $session['price_to'] != null and intval($session['price_to']) > 0) {
            $data->where("$table.price", "<=", $session['price_to']);
        }


        if (isset($session['name']) and $session['name'] != null) {
            $data->where("$table_trans.name", 'like', '%' . $session['name'] . '%');
        }

        if (isset($session['type']) and $session['type'] != null) {
            if ($session['type'] == 1) {
                $data->having('children_count', 0);
            } else {
                $data->having('children_count', '>', 0);
            }
        }

        if (isset($session['category_ids']) && is_array($session['category_ids']) && !empty($session['category_ids'])) {
            $data->whereIn("$table_category.id", $session['category_ids']);
        }

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductColumns($data, $dataSend) {

        return DataTables::query($data, $dataSend)
            ->addIndexColumn()
            ->addColumn('photo', function ($row) {
                return TablePhoto($row, 'photo');
            })
            ->editColumn('CategoryName', function ($row) {
                return view('datatable.but')->with(['btype' => 'CategoryName', 'row' => $row])->render();
            })
            ->editColumn('regular_price', function ($row) {
                return number_format($row->regular_price);
            })
            ->editColumn('price', function ($row) {
                return number_format($row->price);
            })
            ->addColumn('isActive', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] != 'SoftDelete') {
                    return is_active($row->is_active);
                }
            })
            ->addColumn('Edit', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] != 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
                }
            })
            ->editColumn('Delete', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] != 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
                }
            })
            ->editColumn('deleted_at', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] == 'SoftDelete') {
                    return [
                        'display' => Carbon::parse($row->deleted_at)->format('Y-m-d'),
                        'timestamp' => Carbon::parse($row->deleted_at)->timestamp
                    ];
                }
            })
            ->addColumn('Restore', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] == 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'Restore', 'row' => $row])->render();
                }
            })
            ->addColumn('ForceDelete', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] == 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'ForceDelete', 'row' => $row])->render();
                }
            })
//            ->addColumn('hany', function ($row) use ($formName) {
//                return $formName;
//            })
            ->rawColumns(["photo", 'CategoryName', 'Edit', "Delete", 'AddLang', "Restore", "ForceDelete", "isActive"]);
    }


}
