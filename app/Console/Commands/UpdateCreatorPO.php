<?php

namespace App\Console\Commands;

use App\Models\CategoryPO;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class UpdateCreatorPO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:po';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Creator PO';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $category_po = CategoryPO::get();
        foreach($category_po as $cpo){
            $activity = Activity::where(function($query) use($cpo) {
                        $query->where('subject_type', CategoryPO::class)
                        ->where('event','created')
                        ->where('subject_id',$cpo->id);
                    })->first();
                    
            if($activity){
                $user = User::find($activity->causer_id);
                $data = [
                    'id_po' => $cpo->id,
                    'creator_id' => $user->id,
                    'creator_name' => $user->name
                ];

                $blast = CategoryPO::where('id',$cpo->id)->update([
                    'creator_id' => $user->id,
                    'creator_name' => $user->name,
                ]);

                print_r("PO ".$cpo->id." Updated Successfully ");
            }
        }

    }
}
