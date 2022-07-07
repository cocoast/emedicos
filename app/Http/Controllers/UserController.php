<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\Dependence;
use App\Models\Ssalud;
use App\Models\CentroSalud;
use App\Models\ServicioClinico;


class UserController extends Controller
{
     public function __construct(){
        $this->middleware('can:user.index')->only('index');
        $this->middleware('can:user.edit')->only('edit','update');
        $this->middleware('can:user.create')->only('create','store');
        $this->middleware('can:user.destroy')->only('destroy');
        $this->middleware('can:user.show')->only('show');
        $this->middleware('can:user.destroy')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $users=User::all();
         return view('user.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $roles=Role::all();
     return view ('user.create')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =new User;
       $user->name=$request->get('nombre');
       $user->email=$request->get('mail');
       $user->password=Hash::make($request->get('password'));
       $user->save();
       $user->assignRole($request->get('rol'));
       return redirect('/user');

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
        $roles=Role::all();
        $user=User::find($id);
        $role=Role::find(1);
       

       return view('user.edit')->with('user',$user)->with('roles',$roles);
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
         $user=User::find($id);
         $user->name=$request->get('nombre');
         if($request->get('rol')!="Seleccione Rol"){
            $rol=Role::find($request->get('rol'));     
            $user->assignRole($rol->name);
        }
        $user->save();
       return redirect ('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $datos=explode('-',$id);

        $idrol=$datos[0];
        $iduser=$datos[1];
        $user=User::find($iduser);
        $rol=Role::find($idrol);
        $user->removeRole($rol->name);
        return redirect('/user');

        
       
    }
     public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
    public function GoDependencia($id){
        $user=User::find($id);

        $servicios=Ssalud::all();
        $centros=CentroSalud::all();
        $unidades=ServicioClinico::all();
        return view('user.dependencia')->with('user',$user)->with('centros',$centros)->with('servicios',$servicios)->with('unidades',$unidades);
    }
    public function Dependencia(Request $request, $id){
        $user=User::find($id);

        $servicio="";
        $centro="";
        $unidad="";
        if(explode('-',$request->get('dependencia'))[0]=='servicio'){
            $ide=explode('-',$request->get('dependencia'))[1];
            $servicio=Ssalud::find($ide);
            if(!$user->Dependence)
                $dependencia=new Dependence;
                else
                    $dependencia=Dependence::find($user->Dependence->id);
            $dependencia->user=$user->id;
            $dependencia->dependencetable_id=$servicio->id;
            $dependencia->dependencetable_type=$servicio->getMorphClass();
            $dependencia->save();
            return redirect ('/user');
        }
         if(explode('-',$request->get('dependencia'))[0]=='unidad'){
            $ide=explode('-',$request->get('dependencia'))[1];
            $servicio=ServicioClinico::find($ide);
            if(!$user->Dependence)
                $dependencia=new Dependence;
                else
                    $dependencia=Dependence::find($user->Dependence->id);
            $dependencia->user=$user->id;
            $dependencia->dependencetable_id=$servicio->id;
            $dependencia->dependencetable_type=$servicio->getMorphClass();
            $dependencia->save();
            return redirect ('/user');
        }
         if(explode('-',$request->get('dependencia'))[0]=='centro'){
            $ide=explode('-',$request->get('dependencia'))[1];
            $centro=CentroSalud::find($ide);
            //dd($ide);
            if(!$user->Dependence)
                $dependencia=new Dependence;
                else
                    $dependencia=Dependence::find($user->Dependence->id);
            $dependencia->user=$user->id;
            $dependencia->dependencetable_id=$centro->id;
            $dependencia->dependencetable_type=$centro->getMorphClass();
            $dependencia->save();
            return redirect ('/user');
        }
        

    }
}
