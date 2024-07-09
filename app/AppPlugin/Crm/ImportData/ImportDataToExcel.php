<?php

namespace App\AppPlugin\Crm\ImportData;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportDataToExcel implements ToModel, WithHeadingRow {
    public function model(array $row) {
        return [
            'name' => $row['name'],
            'email' => $row[1],
        ];
    }
}
