<?php

namespace App\AppPlugin\Crm\Periodicals;

use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\AppPlugin\Crm\Periodicals\Request\DashboardRequest;
use App\AppPlugin\Crm\Periodicals\Request\PeriodicalsAddReleaseRequest;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookDashboardController extends AdminMainController {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function Dashboard(Request $request, $id = null) {
        $releaseFilter = null;
        if ($id) {
            $releaseFilter = PeriodicalsRelease::query()
                ->where('id', intval($id))
                ->first();
        }

        $Periodicals = Periodicals::query()->get();

        $mostTags = BooksTags::query()->withCount('notes')->orderBy('notes_count', 'desc')->take(5)->get();


        $book = $Periodicals->count();
        $release = PeriodicalsRelease::query()->count();
        $tags = BooksTags::query()->count();
        $notes = PeriodicalsNotes::query()->count();
        $card = [];
        $card['bookCount'] = $book;
        $card['releaseCount'] = $release;
        $card['tagsCount'] = $tags;
        $card['notesCount'] = $notes;


        $PeriodicalsNotes = PeriodicalsNotes::query()->get()->groupBy('periodicals_id')->sortDesc()->take(5);
        $PeriodicalsNotesRelease = [];
        foreach ($PeriodicalsNotes as $key => $value) {
            array_push($PeriodicalsNotesRelease, (object)array(
                'id' => $key,
                'name' => PeriodicalsRelease::query()->where('id', $key)->first()->printReleaseName(),
                'count' => count($value)
            ));
        }
        $PeriodicalsNotesRelease = collect($PeriodicalsNotesRelease);


        return view('AppPlugin.BookPeriodicals.dashbord.index')->with([
            'card' => $card,
            'Periodicals' => $Periodicals,
            'id' => $id,
            'releaseFilter' => $releaseFilter,
            'mostTags' => $mostTags,
            'PeriodicalsNotesRelease' => $PeriodicalsNotesRelease,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function DashboardAddNew(Request $request) {

        $periodicals_id = intval($request->input('periodicals_id'));
        $year = $request->input('year');
        $month = $request->input('month');
        $number = $request->input('number');

        $Periodicals = Periodicals::query()->where('id', $periodicals_id)->firstOrFail();

        $countRelease =  PeriodicalsRelease::query()
            ->where('periodicals_id',$periodicals_id)
            ->where('year',$year)
            ->where('month',$month)
            ->where('number',$number)
            ->get();

        if(count($countRelease) == 0){
            $saveData = new PeriodicalsRelease();
            $saveData->periodicals_id = $request->input('periodicals_id');
            $saveData->year = $request->input('year');
            $saveData->month = $request->input('month');
            $saveData->number = $request->input('number');
            $saveData->save();
            return redirect()->route('admin.Periodicals.Notes.create',$saveData->id);
        }else{
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function DashboardFilter(DashboardRequest $request) {
        $releaseFilter = self::ReleaseFilterQ(PeriodicalsRelease::query(), $request);
        if ($releaseFilter->count() == 1) {
            $sel = $releaseFilter->first();
            $par = $sel->id . "?p=" . $sel->periodicals_id . "&y=" . $sel->year . "&m=" . $sel->month . "&n=" . $sel->number;
            return redirect()->route('admin.Dashboard.selRelease', $par);
        } else {
            $par = "no?p=" . $request->periodicals_id . "&y=" . $request->year . "&m=" . $request->month . "&n=" . $request->number;
            return redirect()->route('admin.Dashboard.selRelease', $par);
        }
    }


    static function ReleaseFilterQ($query, $request) {
        $query->where('periodicals_id', intval($request->input('periodicals_id')));
        $query->where('year', intval($request->input('year')));
        $query->where('month', intval($request->input('month')));
        if ($request->input('number')) {
            $query->where('number', intval($request->input('number')));
        }
        return $query;
    }


}
