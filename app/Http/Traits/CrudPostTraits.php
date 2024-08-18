<?php

namespace App\Http\Traits;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

trait CrudPostTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostIndex() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = $this->model::onlyTrashed()->count();


        return view('admin.mainView.post.index')->with([
            'pageData' => $pageData,
            'categoryId' => 0,
        ]);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostListCategory($categoryId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        return view('admin.mainView.post.index')->with([
            'pageData' => $pageData,
            'categoryId' => $categoryId,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostDataTable(Request $request) {
        if ($request->ajax()) {
            $rowData = self::postIndexQuery($this->config, 0);
            return self::PostColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostDataTableCategory(Request $request, $categoryId) {
        if ($request->ajax()) {
            $rowData = self::postIndexQuery($this->config, $categoryId);
            return self::PostColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function postIndexQuery($config, $categoryId) {

        $table = $config['DbPost'];
        $table_trans = $config['DbPostTrans'];
        $table_trans_foreign = $config['DbPostForeignId'];
        $locale = dataTableDefLang();
        $groups_table = $config['DbCategory'];
        $group_trans_table = $config['DbCategoryTrans'];
        $group_pivot_table = $config['DbCategoryPivot'];
        $PrefixRole = $config['PrefixRole'];

        $data = DB::table($table)->whereNull("$table.deleted_at");

        if ($categoryId != 0) {
            $data->where("$groups_table.id", '=', $categoryId);
        }

        $teamleader = Auth::user()->can($PrefixRole . '_teamleader');
        if (!$teamleader) {
            $data->where("$table.user_id", Auth::user()->id);
        }

        $data->leftJoin($table_trans, function ($join) use ($table, $table_trans, $table_trans_foreign, $locale) {
            $join->on("$table.id", '=', "$table_trans.$table_trans_foreign")
                ->where("$table_trans.locale", '=', $locale);
        })
            ->leftJoin("users", "$table.user_id", '=', 'users.id')
            ->leftJoin($group_pivot_table, "$table.id", '=', "$group_pivot_table.$table_trans_foreign")
            ->leftJoin($groups_table, "$group_pivot_table.category_id", '=', "$groups_table.id")
            ->leftJoin($group_trans_table, function ($join) use ($groups_table, $group_trans_table, $locale) {
                $join->on("$groups_table.id", '=', "$group_trans_table.category_id")
                    ->where("$group_trans_table.locale", '=', $locale);
            })
            ->select(
                "$table.id as id",
                DB::raw("MAX($table.published_at) as published_at"),
                DB::raw("MAX($table.is_active) as isActive"),
                DB::raw("MAX($table.photo_thum_1) as photo"),
                DB::raw("MAX($table_trans.name) as name"),
                DB::raw("MAX($table_trans.slug) as slug"),
                DB::raw("MAX(users.name) as user_name"),
//                DB::raw("GROUP_CONCAT($group_trans_table.name) as category_names") // جمع أسماء المجموعات المترجمة
                DB::raw("GROUP_CONCAT(CONCAT($groups_table.id, ':', $group_trans_table.name)) as category_names")
            )
            ->groupBy("$table.id");


        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('published_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->published_at)),
                    'timestamp' => strtotime($row->published_at)
                ];
            })
            ->editColumn('CategoryName', function ($row) {
                return view('datatable.but')->with(['btype' => 'CategoryName', 'row' => $row])->render();
            })
            ->editColumn('UserName', function ($row) {
                return $row->user_name;
            })
            ->editColumn('photo', function ($row) {
                return TablePhoto($row, 'photo');
            })
            ->editColumn('isActive', function ($row) {
                return is_active($row->isActive);
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'photo', 'isActive', 'name', 'CategoryName']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostCreate(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Categories = [];
        $selCat = [];
        $tags = [];
        $selTags = [];

        if (IsConfig($this->config, 'TableCategory')) {
            $Categories = $this->modelCategory::all();
        }

        if (IsConfig($this->config, 'TableTags')) {
            if(old('tag_id')){
                $selTags = old('tag_id') ;
                $tags = $this->modelTags::query()->whereIn('id',$selTags)->get();
            }
        }

        $rowData = $this->model::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();

        return view('admin.mainView.post.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $tags = [];
        $Categories = [];
        $selCat = [];

        $teamleader = Auth::user()->can($this->config['PrefixRole'] . '_teamleader');

        try {
            if (!$teamleader) {
                $rowData = $this->model::defAdmin()->where('id', $id)->where('user_id', Auth::user()->id)->with('categories')->firstOrFail();
            } else {
                $rowData = $this->model::defAdmin()->where('id', $id)->firstOrFail();
            }
        } catch (\Exception $e) {
           abort(410);
        }

        if (IsConfig($this->config, 'TableCategory')) {
            $Categories = $this->modelCategory::all();
            $selCat = $rowData->categories()->pluck('category_id')->toArray();
        }

        $LangAdd = self::getAddLangForEdit($rowData);
        if (IsConfig($this->config, 'TableTags')) {
            $selTags = $rowData->tags()->pluck('tag_id')->toArray();
            $tags = $this->modelTags::query()->whereIn('id', $selTags)->get();
        }

        return view('admin.mainView.post.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TraitsPostStoreUpdate($request, $id) {
        $saveData = $this->model::findOrNew($id);
        $categories = $request->input('categories');
        $tags = $request->input('tag_id');
        $user_id = Auth::user()->id;

        $saveData->is_active = intval((bool)$request->input('is_active'));
        $saveData->updated_at = getCurrentTime();
        $saveData->youtube = $request->input('youtube');

        if (IsConfig($this->config, 'postPublishedDate')) {
            $saveData->published_at = SaveDateFormat($request, 'published_at');
        }

        if ($request->input('form_type') == 'Add') {
            $saveData->user_id = $user_id;
        }

        $saveData->save();

//        if (IsConfig($this->config, 'TableReview') and $request->input('form_type') == 'Edit') {
//            $blogReview = $this->modelReview;
//            $blogReview->user_id = $user_id;
//            $blogReview->blog_id = $saveData->id;
//            $blogReview->updated_at = now();
//            $blogReview->save();
//        }

        if (IsConfig($this->config, 'TableCategory')) {
            $saveData->categories()->sync($categories);
        }

        if (IsConfig($this->config, 'TableTags')) {
            $saveData->tags()->sync($tags);
        }

        self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'ar.name');

        $addLang = json_decode($request->add_lang);
        foreach ($addLang as $key => $lang) {
            $ForeignId = $this->DbPostForeignId;
            $saveTranslation = $this->translation->where($ForeignId, $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->$ForeignId = $saveData->id;
            $saveTranslation->youtube_title = $request->input($key . '.youtube_title');
            $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
            $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
            $saveTranslation->save();
        }

        try {
            DB::transaction(function () use ($request, $saveData) {


            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostSoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";

        return view('admin.mainView.post.index_soft_deletes')->with([
            'pageData' => $pageData,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostDataTableSoftDeletes(Request $request) {
        if ($request->ajax()) {
            $rowData = self::postIndexSoftDeletesQuery($this->config);
            return self::PostSoftDeletesColumns($rowData)->make(true);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function postIndexSoftDeletesQuery($config) {
        $table = $config['DbPost'];
        $table_trans = $config['DbPostTrans'];
        $table_trans_foreign = $config['DbPostForeignId'];
        $locale = dataTableDefLang();
        $data = DB::table($table)
            ->where("$table.deleted_at", '!=', null)
            ->leftJoin($table_trans, function ($join) use ($table, $table_trans, $table_trans_foreign, $locale) {
                $join->on("$table.id", '=', "$table_trans.$table_trans_foreign")
                    ->where("$table_trans.locale", '=', $locale);
            })
            ->select(
                "$table.id as id",
                DB::raw("MAX($table.deleted_at) as deleted_at"),
                DB::raw("MAX($table_trans.name) as name"),
            )->groupBy("$table.id");

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostSoftDeletesColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('deleted_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->deleted_at)),
                    'timestamp' => strtotime($row->deleted_at)
                ];
            })
            ->editColumn('Restore', function ($row) {
                return view('datatable.but')->with(['btype' => 'Restore', 'row' => $row])->render();
            })
            ->editColumn('ForceDelete', function ($row) {
                return view('datatable.but')->with(['btype' => 'ForceDelete', 'row' => $row])->render();
            })
            ->rawColumns(['Restore', "ForceDelete"]);
    }

}
