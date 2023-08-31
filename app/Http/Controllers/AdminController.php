<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3) {
        $admin      = User::orderBy('name', 'ASC')->paginate(10);
        $department = Department::all();
        return view('admin.index')
            ->with('department', $department)
            ->with('admin', $admin);
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

    return view('admin.index')
    ->with('department',$department)
    ->with('admin',$admin);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3) {
            $this->validate($request, [
                "name" => 'required',
                "email" => 'required',
                "password" => 'required|min:8'
            ]);
            $data2 = $request->all();
            // dd($data2);
                try {
                if($request->role == "Admin"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('admin');
                }elseif ($request->role == "User") {
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->   email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('user');
                }elseif ($request->role == "Super admin"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('super admin');
                }elseif ($request->role == "Purchasing"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('purchasing');
                }elseif ($request->role == "Finance"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('finance');
                }elseif ($request->role == "Super User"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('super user');
                }elseif ($request->role == "R&D"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('R&D');
                }elseif ($request->role == "Production"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('production');
                }elseif ($request->role == "Support Workshop"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('support workshop');
                }elseif ($request->role == "Project"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('project');
                }elseif ($request->role == "Business Development"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('business development');
                }elseif ($request->role == "Product"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('product');
                }elseif ($request->role == "Tax"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('tax');
                }elseif ($request->role == "Human Resource"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('Human Resource');
                }elseif ($request->role == "GA"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('GA');
                }elseif ($request->role == "Legal"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('legal');
                }elseif ($request->role == "Super Purchase"){
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->department = $request->department;
                $data->location = $request->location;
                $data->save();
                $data->assignRole('super purchase');
                }else {
                    throw new \Exception ('Error BLOG');
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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3) {
            $this->validate($request, [
                "name" => 'required',
                "email" => 'required',
            ]);
            $data2 = $request->all();

            $data = User::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->department = $request->department;
            $data->location = $request->location;
            $data->save();

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
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 1 || $check->role_id == 3)  {
            $item = User::find($id);
            $item->delete();
            return redirect('/admin');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
