<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CategoryEcommerce;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Department;
use App\Models\Role;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WhoSubmitted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu()
    {
        return view('admin.menu');
    }

    public function index()
    {
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3) {
        $admin      = User::orderBy('name', 'ASC')->paginate(10);
        $department = Department::all();
        $role = Roles::all();
        return view('admin.index')
            ->with('department', $department)
            ->with('admin', $admin)
            ->with('role', $role);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchUsers(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $admin = User::Where('id','like',"%".$cari."%")
    ->orWhere('name','like',"%".$cari."%")
    ->orWhere('email','like',"%".$cari."%")
    ->orWhereHas('roles', function($q) use($cari){
         $q->where('name','like',"%".$cari."%");
    })
    ->orWhere('department','like',"%".$cari."%")
    ->orWhere('location','like',"%".$cari."%")
    ->paginate(10);
    $department = Department::all();
    $role = Roles::all();

    return view('admin.index')
    ->with('department',$department)
    ->with('role',$role)
    ->with('admin',$admin);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3) {
        return view('admin.create');
        } else {
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
        if ($check->role_id == 1 || $check->role_id == 3) {
            $this->validate($request, [
                "name" => 'required',
                "email" => 'required',
                "password" => 'required|min:8',
                "role" => 'required',
            ]);
            $data2 = $request->all();

            try {
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->is_fast_track = $request->is_fast_track;
                $data->save();
                $data->assignRole($request->role);

                // Kalau user baru rolenya user dia tambahin who submit
                if ($request->role == 'user') {
                    $exists = WhoSubmitted::where('name', $request->name)->exists();

                    if (!$exists) {
                        WhoSubmitted::create([
                            'name' => $request->name,
                        ]);
                    }
                }

            } catch (\Exception $err) {
            dd($err);
            }

        return redirect()->route('admin.index')->with('success', 'Task Created Successfully!');
        }else {
            return redirect()->route('dashboard');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = User::find($id);
        // dd($admin);
        return view('admin.show')
            ->with('admin', $admin);
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
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3) {
            $this->validate($request, [
                "name" => 'required',
                "email" => 'required',
            ]);
            $data2 = $request->all();

            $data = User::find($id);
            $data->name = $request->name ?  $request->name : $data->name;
            $data->email = $request->email ? $request->email : $data->email;
            $data->password = $request->password ? Hash::make($request->password) : $data->password;
            $data->department = $request->department ? $request->department : $data->department;
            $data->location = $request->location ? $request->location : $data->location;
            $data->is_fast_track = $request->is_fast_track ? $request->is_fast_track : $data->is_fast_track;
            $data->save();
            if($request->role){
                $data->roles()->detach();
                $data->assignRole($request->role);
            }


            return redirect()->route('admin.index')->with('success', 'Task Created Successfully!');

        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Auth::user();
        if ($check->role_id == 1 || $check->role_id == 3)  {
            $item = User::find($id);
            $item->delete();
            return redirect('/admin');
        }else {
            return redirect()->route('dashboard');
        }
    }


    public function suppliers_Api(){
        try {
            $supplier_company = CategoryPT::get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->nama,
                    'supp_type' => 'Company'
                ];
            })->toArray();
            
            $supplier_person = CategoryPP::get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->nama,
                    'supp_type' => 'Private Person'
                ];
            })->toArray();
            
            $supplier_ecommerce = CategoryEcommerce::get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->nama,
                    'supp_type' => 'Ecommerce'
                ];
            })->toArray();
    
            $data = array_merge($supplier_company,$supplier_person,$supplier_ecommerce);
    
            return response()->json([
                'status' => 'success get suppliers',
                'data' => $data
            ],200);
        } catch (\Exception $except) {
            return response()->json([
                'status' => 'Something wong',
                'err' => $except
            ],500);
        }
    
    }
}
