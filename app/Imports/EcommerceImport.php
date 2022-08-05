<?php

namespace App\Imports;

use App\Models\CategoryEcommerce;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class EcommerceImport implements ToModel
{

    public function model(array $row)
    {
        return new CategoryEcommerce([
            'nama'      => $row[0],
            'link'      => $row[1],
        ]);
    }
}
