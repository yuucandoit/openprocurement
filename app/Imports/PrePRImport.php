<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Pre_pr;
use Illuminate\Support\Facades\Auth;
use App\Models\PartItem_Pre_pr;

class PrePRImport implements  ToModel, WithHeadingRow
{

    private $project;
    private $due_date;

    public function __construct($project, $due_date)
    {
        $this->project = $project;
        $this->due_date = $due_date;
    }

    public function model(array $row)
    {
        // dd($this->due_date);
        // dd($row);

        $existProject = Pre_pr::where('project_id',$this->project)->first();
        if($existProject){
            $qty = $row['qty'];
            $buffer =  $row['buffer'];
            $total = $qty + $buffer;

            $data1 = array(
                'child_item'        => $row['part_name'],
                'desc'              => $row['desc'],
                'link'              => $row['link'],
                'qty'               => $qty ?? 0 ,
                'buffer'            => $buffer ?? 0,
                'total'             => $total,
                'creator_id'        => null,
                'creator_name'      => null,
            );
            $record = PartItem_Pre_pr::firstOrNew(['pre_pr_id' => $existProject->id, 'child_item' => $row['part_name']]);

            // Set creator fields only if the record is new
            if (!$record->exists) {
                $record->creator_id = Auth::user()->id;
                $record->creator_name = Auth::user()->name;
            }

            // Update other fields
            $record->desc = $data1['desc'];
            $record->link = $data1['link'];
            $record->qty = $qty ?? 0;
            $record->buffer = $buffer ?? 0;
            $record->total = $total;

            // Save the record
            $record->save();
        } else {
            $pre_pr = Pre_pr::create([
                'user_id' =>  Auth::user()->id,
                'project_id' => $this->project,
                'due_date'=> $this->due_date
            ]);

            $qty = $row['qty'];
            $buffer =  $row['buffer'];
            $total = $qty + $buffer;

            $data2 = array(
                'pre_pr_id'         => $pre_pr->id,
                'child_item'        => $row['part_name'],
                'desc'              => $row['desc'],
                'link'              => $row['link'],
                'qty'               => $qty ?? 0 ,
                'buffer'            => $buffer ?? 0,
                'total'             => $total,
                'creator_id'        => Auth::user()->id,
                'creator_name'      => Auth::user()->name,
            );
            PartItem_Pre_pr::create($data2);
        }
    }

    // public function collection(Collection $collection)
    // {
    //     foreach($collection as $c)
    //     {
    //         // dd($c);
    //     }
    //     dd($collection['Part Name']);
    // }
}
