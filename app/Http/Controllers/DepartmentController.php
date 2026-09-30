<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Department::paginate(10);
            return view('dataDepartment.index')
            ->with('data',$data);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function getPermittedPurposes($departmentId)
    {
        $department = Department::find($departmentId);

        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }

        // Ambil permitted_purposes
        $permittedPurposes = json_decode($department->permitted_purposes, true);;

        return response()->json($permittedPurposes);
    }

    public function SearchDepartment(Request $request)
    {
    $cari = $request->cari;
    //dd($cari);
    $data = Department::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->paginate(10);

    return view('dataDepartment.index')
    ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $purposes = ['Project','Office','Workshop','Inventory','RND','Travel'];
            return view('dataDepartment.create')
            ->with('purposes', $purposes);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
        //validasi formnya
        $this->validate($request,[
            'name' => 'required',
            'permitted_purposes' => 'required|array',
        ]);

       Department::create([
            "name"      => $request->name,
            "permitted_purposes"  => json_encode($request->purposes),
        ]);

        return redirect("department/")->with('success', 'Created Successfully!');
        }else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department, $id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
        $data = Department::find($id);
        $selectedPurposes = $data->permitted_purposes ? json_decode($data->permitted_purposes, true) : [];
        $purposes = ['Project','Office','Workshop','Inventory','RND','Travel'];
        return view('dataDepartment.edit')
        ->with('data', $data)
        ->with('selectedPurposes',$selectedPurposes)
        ->with('purposes',$purposes);
        }else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Department::find($id);
            $tes = Department::where("id", $id)->update([
                "name" => $request->name,
                "permitted_purposes"  => json_encode($request->purposes),
            ]);
            return redirect("department/")->with('success', 'Updated Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department, $id)
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $data = Department::find($id);
            $data->delete();
            return redirect("department/")->with('success', 'Deleted Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
