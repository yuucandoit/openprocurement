<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\ReferensiNamaProject;

class ProjectCode implements FromCollection
{
    public function collection()
    {
        return ReferensiNamaProject::all();
    }

}
