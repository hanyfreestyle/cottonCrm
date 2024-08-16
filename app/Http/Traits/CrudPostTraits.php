<?php

namespace App\Http\Traits;


use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

trait CrudPostTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostIndex() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = $this->model::onlyTrashed()->count();

        $data = self::postIndexQuery($this->config);

        return view('admin.mainView.post.index')->with([
            'pageData' => $pageData,
//            'trees' => $trees,
//            'route' => $route,
//            'id' => $id,
        ]);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostDataTable(Request $request) {
        if ($request->ajax()) {
            $rowData = self::postIndexQuery($this->config);
            return self::PostColumns($rowData)->make(true);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function postIndexQuery($config) {


        $table = $config['DbPost'];
        $table_trans = $config['DbPostTrans'];
        $table_trans_foreign = $config['DbPostCatId'];
//         dd($config);

        $data = DB::table("$table")
            ->where("$table.deleted_at", null)
            ->leftJoin("$table_trans", function ($join) use ($table, $table_trans, $table_trans_foreign) {
                $join->on("$table.id", '=', "$table_trans.$table_trans_foreign");
                $join->where("$table_trans.locale", '=', 'ar');
            })
            ->leftJoin("users", function ($join) use ($table) {
                $join->on("$table.user_id", '=', 'users.id');
            })
            ->select("$table.id as id",
                "$table.published_at as published_at",
                "$table.is_active as isActive",
                "$table.photo_thum_1 as photo",
                "$table_trans.name as name",
                "$table_trans.slug as slug",
                "users.name as user_name",
            );

//        $data->where('blog_post.is_active', $isActive);
//        $teamleader = Auth::user()->can('Blog_teamleader');
//        if (!$teamleader) {
//            $data->where('blog_post.user_id', Auth::user()->id);
//        }

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
            ->rawColumns(['Edit', "Delete", 'photo', 'isActive', 'name']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostCreate() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        if (IsConfig($this->config, 'TableCategory')) {
            $Categories = $this->modelCategory::all();
        } else {
            $Categories = [];
        }

        $rowData = $this->model::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selCat = [];

        if (IsConfig($this->config, 'TableTags')) {
            $tags = $this->modelTags::where('id', '!=', 0)->get();
            $selTags = [];
        } else {
            $tags = [];
            $selTags = [];
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
    public function PostEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        if (IsConfig($this->config, 'TableCategory')) {
            $rowData = $this->model::where('id', $id)->with('categories')->firstOrFail();
            $Categories = $this->modelCategory::all();
            $selCat = $rowData->categories()->pluck('category_id')->toArray();
        } else {
            $rowData = $this->model::where('id', $id)->firstOrFail();
            $Categories = [];
            $selCat = [];
        }

        $LangAdd = self::getAddLangForEdit($rowData);

        if (IsConfig($this->config, 'TableTags')) {
            $selTags = $rowData->tags()->pluck('tag_id')->toArray();
            $tags = $this->modelTags::query()->get();
        } else {
            $tags = [];
            $selTags = [];
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

        try {
            DB::transaction(function () use ($request, $saveData) {
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

                if (IsConfig($this->config, 'TableReview') and $request->input('form_type') == 'Edit') {
                    $blogReview = $this->modelReview;
                    $blogReview->user_id = $user_id;
                    $blogReview->blog_id = $saveData->id;
                    $blogReview->updated_at = now();
                    $blogReview->save();
                }

                if (IsConfig($this->config, 'TableCategory')) {
                    $saveData->categories()->sync($categories);
                }

                if (IsConfig($this->config, 'TableTags')) {
                    $saveData->tags()->sync($tags);
                }

                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'ar.name');

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $CatId = $this->DbPostCatId;
                    $saveTranslation = $this->translation->where($CatId, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->$CatId = $saveData->id;
                    $saveTranslation->youtube_title = $request->input($key . '.youtube_title');
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
                    $saveTranslation->save();
                }

            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function PostSoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $pageData['SubView'] = false;
        View::share('yajraTable', false);
        $rowData = self::getSelectQuery($this->model::onlyTrashed());
        return view('admin.mainView.post.index', compact('pageData', 'rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SubCategory
    public function PostListCategory($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = true;
        $Category = $this->modelCategory::findOrFail($id);
        $rowData = self::getSelectQuery($this->model::def()->whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        }));
        return view('admin.mainView.post.index', compact('pageData', 'rowData'));
    }

}
