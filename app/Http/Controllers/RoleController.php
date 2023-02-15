<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Roles::orderBy('name', 'ASC')->paginate(10);
        return view('admin_role.index')
            ->with('role', $role);
    }

    public function SearchRoles(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $role = Roles::Where('id','like',"%".$cari."%")
     ->orWhere('name','like',"%".$cari."%")
     ->orWhere('email','like',"%".$cari."%")
     ->orWhereHas('roles', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);

     return view('admin.index')
     ->with('role',$role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => 'required',
        ]);

        Roles::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        return redirect()->route('role.index')->with('success', 'Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => 'required',
        ]);

        Roles::where('id',$request->id)->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        return redirect()->route('role.index')->with('success', 'Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
