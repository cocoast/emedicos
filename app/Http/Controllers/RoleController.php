<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
 
class RoleController extends Controller
{
      public function __construct(){
        $this->middleware('can:role.index')->only('index');
        $this->middleware('can:role.edit')->only('edit','update');
        $this->middleware('can:role.create')->only('create','store');
        $this->middleware('can:role.destroy')->only('destroy');
        $this->middleware('can:role.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index')->with('roles',Role::all());
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view ('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Role::where('name',$request->get('clase'))->count()==0){
           $role=Role::create(['name' => $request->get('clase')]);
           return redirect('/role')->with('message','Nuevo Role Creado')->with('status','alert alert-success');
        }    
        else
            return redirect('/role')->with('message','Role ya creado')->with('status','alert alert-danger');
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
        $permissions=Permission::all();
        return view ('role.edit')->with('rol',Role::find($id))->with('permissions',$permissions);
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
        //dd($request->permisos);
        $role=Role::find($id);
        $role->syncPermissions($request->permisos);
        return redirect()->route('role.index');
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
