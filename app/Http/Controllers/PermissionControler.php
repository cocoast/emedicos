<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionControler extends Controller
{
    public function __construct()
    {

        $this->middleware('can:permiso.index')->only('index');
        $this->middleware('can:permiso.edit')->only('edit', 'update');
        $this->middleware('can:permiso.create')->only('create', 'store');
        $this->middleware('can:permiso.destroy')->only('destroy');
        $this->middleware('can:permiso.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos=Permission::all();
        return view('permiso.index')->with('permisos',$permisos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permiso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    if(Permission::where('name',$request->get('nombre'))->count()==0){
        Permission::create(['name' => $request->get('nombre')]);
        return redirect ('/permiso')->with('message', 'El Permiso ' . $request->get('nombre') . ' a sido Ingresado')->with('status', 'alert alert-success');
    }else
        return redirect ('/permiso')->with('message', 'El Permiso ' . $request->get('nombre') . ' ya se encontraba creado')->with('status', 'alert alert-danger');
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
        $permiso=Permission::find($id);
        return view('permiso.edit')->with('permiso',$permiso);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso=Permission::find($id);
        $permiso->delete();
        return redirect('/permiso')->with('message', 'El Permiso ya no existe')->with('status', 'alert alert-danger');;
    }
}
