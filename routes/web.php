<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Route::get('/', function () {
    return view('auth.login');
});
//Route::get('/home', function () {
 //   return view('home');
//});
Route::get('home','App\Http\Controllers\DashBoardController@index');

Route::get('convenios/seguimiento',[
    'uses'  =>'App\Http\Controllers\ConveniosController@Seguimiento',
    'as'    =>'convenios.seguimiento'
    ]);
Route::get('convenios/seguimientomemos',[
    'uses'  =>'App\Http\Controllers\ConveniosController@seguimientomemos',
    'as'    =>'convenios.seguimientomemos'
    ]);
Route::get('/planifica/programa/',[
    'uses'  =>'App\Http\Controllers\PlanificaController@programa',
    'as'    =>'planifica.programa'
    ]);
Route::Post('/planifica/programacion',[
    'uses'  =>'App\Http\Controllers\PlanificaController@programacion',
    'as'    =>'planifica.programacion'
    ]);
Route::get('/planifica/listado/',[
    'uses'  =>'App\Http\Controllers\PlanificaController@listado',
    'as'    =>'planifica.listado'
    ]);
Route::get('/planifica/minsal/',[
    'uses'  =>'App\Http\Controllers\PlanificaController@minsal',
    'as'    =>'planifica.minsal'
    ]);
Route::get('/equipo/rtls/{id}',[
    'uses'  =>'App\Http\Controllers\EquipoController@rtls',
    'as'    =>'equipo.rtls'
    ]);

route::resource('marca','App\Http\Controllers\MarcaController');
route::resource('modelo','App\Http\Controllers\ModeloController');
route::resource('familia','App\Http\Controllers\FamiliaController');
route::resource('subfamilia','App\Http\Controllers\SubFamiliaController');
route::resource('clase','App\Http\Controllers\ClaseController');
route::resource('subclase','App\Http\Controllers\SubClaseController');
route::resource('proveedor','App\Http\Controllers\ProveedorController');
route::resource('servicioclinico','App\Http\Controllers\ServicioClinicoController');
route::resource('equipo','App\Http\Controllers\EquipoController');
route::resource('convenio','App\Http\Controllers\ConveniosController');
route::resource('equipoconvenio','App\Http\Controllers\EquiposConveniosController', ['except' => ['create']]);
route::resource('pagos','App\Http\Controllers\PagosController');
route::resource('user','App\Http\Controllers\UserController');
route::resource('role','App\Http\Controllers\RoleController');
route::resource('garantia','App\Http\Controllers\GarantiaController');
route::resource('baja','App\Http\Controllers\BajaController');
route::resource('principal','App\Http\Controllers\DashBoardController');
route::resource('planifica','App\Http\Controllers\PlanificaController');
route::resource('sc','App\Http\Controllers\SolicitudCompraController');
route::resource('producto','App\Http\Controllers\ProductoController');

Route::get('equipoconvenio/{id}/create',[
        'uses'  =>  'App\Http\Controllers\EquiposConveniosController@create',
        'as'    =>  'equipoconvenio.create'
        ]);

Route::get('pagos/{id}/create',[
        'uses'  =>  'App\Http\Controllers\PagosController@store',
        'as'    =>  'pagos.create'
        ]);
// Buscadores 
Route::get('search/proveedor',[
    'uses'  =>  'App\Http\Controllers\ProveedorController@search',
    'as'    =>  'search.proveedor'
    ]);
Route::get('search/marca',[
    'uses'  =>  'App\Http\Controllers\MarcaController@search',
    'as'    =>  'search.marca'
    ]);
Route::get('search/modelo',[
    'uses'  =>  'App\Http\Controllers\ModeloController@search',
    'as'    =>  'search.modelo'
    ]);
Route::get('search/servicio',[
    'uses'  =>  'App\Http\Controllers\ServicioClinicoController@search',
    'as'    =>  'search.servicio'
    ]);
Route::get('search/familia',[
    'uses'  =>  'App\Http\Controllers\FamiliaController@search',
    'as'    =>  'search.familia'
    ]);
Route::get('search/subfamilia',[
    'uses'  =>  'App\Http\Controllers\SubFamiliaController@search',
    'as'    =>  'search.subfamilia'
    ]);
Route::get('search/producto',[
    'uses'  =>  'App\Http\Controllers\ProductoController@search',
    'as'    =>  'search.producto'
    ]);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('servicio-tecnico',function(){
    return view('servicio-tecnico.index');
});
