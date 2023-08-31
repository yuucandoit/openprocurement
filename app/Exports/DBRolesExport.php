<?php

namespace App\Exports;

use App\Models\Roles;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DBRolesExport implements FromView
{
    public function view(): View
     {

         $data['roles'] = Roles::all();
         return view('exports.roles', $data);
     }
}
