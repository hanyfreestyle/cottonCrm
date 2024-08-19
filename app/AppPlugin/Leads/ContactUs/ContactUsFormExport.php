<?php

namespace App\AppPlugin\Leads\ContactUs;

use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ContactUsFormExport implements FromQuery, ShouldAutoSize, WithMapping, WithHeadings, WithColumnFormatting {
  use Exportable;

  protected $request;

  public function __construct($request) {
    $this->request = $request;
  }

  public function query() {

    if(Route::currentRouteName() == 'LeadsFrom.ContactUs.Export') {
      $requestType = '1';
    } elseif(Route::currentRouteName() == 'LeadsFrom.Request.Export') {
      $requestType = '2';
    } elseif(Route::currentRouteName() == 'LeadsFrom.Meeting.Export') {
      $requestType = '3';
    }

    $session = Session::get($this->request->input('formName'));
    $GetData = AdminMainController::FilterQ(ContactUsForm::query()
      ->where('request_type', $requestType), $session, 'created_at|ASC');
    return $GetData;
  }

  public function map($GetData): array {

    $map = [
      $GetData->name,
      $GetData->phone,
      str_replace('+', '00', $GetData->full_number),
      $GetData->countryName->name,
    ];

    if(Route::currentRouteName() == 'LeadsFrom.ContactUs.Export') {
      $map2 = [
        $GetData->subject,
        $GetData->message,
      ];
      $map = array_merge($map, $map2);
    }

    if(Route::currentRouteName() == 'LeadsFrom.Meeting.Export') {
      $map3 = [
        $GetData->getmeetingDate(),
        $GetData->meeting_time,
      ];
      $map = array_merge($map, $map3);
    }

    if(Route::currentRouteName() == 'LeadsFrom.Meeting.Export' or Route::currentRouteName() == 'LeadsFrom.Request.Export') {
      $map4 = [
        $GetData->projectinfo->name ?? '',
        $GetData->listinginfo->name ?? '',
      ];
      $map = array_merge($map, $map4);
    }

    return $map;
  }

  public function headings(): array {
    $headings = [
      __('admin/config/leadForm.t_name'),
      __('admin/config/leadForm.t_phone'),
      __('admin/config/leadForm.t_full_number'),
      __('admin/config/leadForm.t_country'),
    ];

    if(Route::currentRouteName() == 'LeadsFrom.ContactUs.Export') {
      $headings_2 = [
        __('admin/config/leadForm.t_subject'),
        __('admin/config/leadForm.t_message'),
      ];
      $headings = array_merge($headings, $headings_2);
    }

    if(Route::currentRouteName() == 'LeadsFrom.Meeting.Export') {
      $headings_3 = [
        __('admin/config/leadForm.t_meeting_date'),
        __('admin/config/leadForm.t_meeting_time'),
      ];
      $headings = array_merge($headings, $headings_3);
    }

    if(Route::currentRouteName() == 'LeadsFrom.Meeting.Export' or Route::currentRouteName() == 'LeadsFrom.Request.Export') {
      $headings_4 = [
        __('admin/config/leadForm.t_listing_project'),
        __('admin/config/leadForm.t_listing'),
      ];
      $headings = array_merge($headings, $headings_4);
    }

    return $headings;

  }

  public function columnFormats(): array {
    return [
      'A' => NumberFormat::FORMAT_TEXT,
      'B' => NumberFormat::FORMAT_NUMBER,
      'C' => NumberFormat::FORMAT_NUMBER,
      'D' => NumberFormat::FORMAT_TEXT,
    ];

  }

}
