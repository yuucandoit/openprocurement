<?php

namespace App\Http\Controllers;

use App\Models\ProjectCodeCreates;
use App\Models\Role;
use App\Models\ReferensiNamaProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectCodeCreatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ( $check->role_id == 18) {
            $list = ProjectCodeCreates::orderBy('created_at','DESC')->paginate(10);
            return view('code_project_admin.index')
            ->with('list',$list);
        }else {
            return redirect()->route('dashboard')->with('error','Not allowed on this page');
        }
    }

    public function cancel($id)
    {
        $list = ProjectCodeCreates::find($id);
        $list->status = 'Cancel';
        $list->save();
        return redirect()->back()->with('message','Success Cancel');
    }

    public function approver()
    {
        $list = ProjectCodeCreates::where('status','Waiting Approval')->orderBy('created_at','DESC')->paginate(10);
        return view('code_project_admin.approval')
        ->with('list',$list);
    }

    public function accept(Request $request, $id)
    {
        $list = ProjectCodeCreates::find($id);
        if($list->roles->name == 'General Manager Business'){
            $list->status = 'Approved';
            $list->approved_at = now();
            ReferensiNamaProject::create([
                "name" => $list->project_code,
            ]);
            $list->save();
            return redirect()->back()->with('message','Success Accept and add new project Code');
        }else {
            return redirect()->route('project-code.approve')->with('error','Not allowed to run this action');
        }
    }

    public function acceptSelect(Request $request)
    {
        $ids = explode(',', $request->ids);
        $list = ProjectCodeCreates::whereIn('id',$ids)->get();
        foreach($list as $l){
            ProjectCodeCreates::where('id',$l->id)->update([
                'status' => 'Approved',
                'approved_at' => now(),
            ]);
            ReferensiNamaProject::create([
                "name" => $l->project_code,
            ]);
        }
        return redirect()->back()->with('message','Success Accept and add new project Code');
    }

    public function reject(Request $request, $id)
    {
        $list = ProjectCodeCreates::find($id);
        if($list->roles->name == 'General Manager Business'){
            $list->status = 'Rejected';
            $list->cancel_at = now();
            $list->notes = $request->notes;
            $list->save();
            return redirect()->back()->with('message','Success Reject');
        }else {
            return redirect()->route('project-code.approve')->with('error','Not allowed to run this action');
        }
    }

    public function rejectSelect(Request $request)
    {
        $ids = explode(',', $request->ids);
        $list = ProjectCodeCreates::whereIn('id',$ids)->update([
            'status' => 'Rejected',
            'cancel_at' => now(),
        ]);
        return redirect()->back()->with('message','Success Reject');
        // }else {
        //     return redirect()->route('project-code.approve')->with('error','Not allowed to run this action');
        // }
    }


    public function create()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 18) {
            return view('code_project_admin.create');
        }else {
            return redirect()->route('project-code.index')->with('error','Not allowed on this page');
        }
    }

    public function store(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ( $check->role_id == 18) {
            $code = ProjectCodeCreates::create([
                'user_id'       => Auth::user()->id,
                'approver_id'   => 19,
                'project_code'  => $request->project_name,
                'status'        => 'Waiting Approval'
            ]);
            return redirect()->route('project-code.index')->with('message','Success Create Data');
        }else {
            return redirect()->route('project-code.index')->with('error','Not allowed to run this action');
        }
    }


    public function show(ProjectCodeCreates $projectCodeCreates)
    {
        //
    }

    public function edit($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 18) {
            $list = ProjectCodeCreates::find($id);
            return view('code_project_admin.edit')
            ->with('list',$list);
        }else {
            return redirect()->route('project-code.index')->with('error','Not allowed on this page');
        }
    }

    public function update(Request $request, $id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ( $check->role_id == 18) {
            $list = ProjectCodeCreates::find($id);
            if($list->status == 'Waiting Approval'){
                $code = ProjectCodeCreates::where('id',$id)->update([
                    'project_code'  => $request->project_name,
                ]);
            }else if ($list->status == 'Approved'){

                $projectCode = ReferensiNamaProject::where('name',$list->project_code)->update([
                    "name" => $request->project_name,
                ]);
                
                $code = ProjectCodeCreates::where('id',$id)->update([
                    'project_code'  => $request->project_name,
                ]);



            }
            return redirect()->route('project-code.index')->with('message','Success Update Data');

        }else {
            return redirect()->route('project-code.index')->with('error','Not allowed to run this action');
        }
    }

    public function destroy(ProjectCodeCreates $projectCodeCreates)
    {
        //
    }
}
