<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ValidaUserMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

//Route::get('/home', function () {
 //   return view('home');
//});
Route::get('licitaciones/', function () {
    return view('licitaciones.index');
});
Route::get('licitaciones/demo', function () {
    return view('licitaciones.demo');
});
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
route::resource('pagos','App\Http\Controllers\PagosController', ['except' => ['create']]);
route::resource('user','App\Http\Controllers\UserController');
route::resource('role','App\Http\Controllers\RoleController');
route::resource('garantia','App\Http\Controllers\GarantiaController');
route::resource('baja','App\Http\Controllers\BajaController');
route::resource('principal','App\Http\Controllers\DashBoardController');
route::resource('planifica','App\Http\Controllers\PlanificaController');
route::resource('sc','App\Http\Controllers\SolicitudCompraController');
route::resource('producto','App\Http\Controllers\ProductoController');
route::resource('traslado','App\Http\Controllers\TrasladoController');
route::resource('establecimiento','App\Http\Controllers\EstablecimientoController');
route::resource('permiso','App\Http\Controllers\PermissionControler');
route::resource('ssalud','App\Http\Controllers\SsaludController');
route::resource('centrosalud','App\Http\Controllers\CentroSaludController');
route::resource('sigfe','App\Http\Controllers\SigfeController');
route::resource('minsalconvenio','App\Http\Controllers\ConvenioMinsalController');
route::resource('minsalfactura','App\Http\Controllers\MinsalFacturaController', ['except' => ['create']]);

Route::get('equipoconvenio/{id}/create',[
        'uses'  =>  'App\Http\Controllers\EquiposConveniosController@create',
        'as'    =>  'equipoconvenio.create'
        ]);
//PAGOS
Route::get('pagos/{id}/create',[
        'uses'  =>  'App\Http\Controllers\PagosController@store',
        'as'    =>  'pagos.create'
        ]);

Route::get('minsalfactura/{id}/create',[
        'uses'  =>  'App\Http\Controllers\MinsalFacturaController@create',
        'as'    =>  'minsalfactura.create'
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
Route::get('search/equipo',[
    'uses'  =>  'App\Http\Controllers\EquipoController@search',
    'as'    =>  'search.equipo'
    ]);
Route::get('search/ssalud',[
    'uses'  =>  'App\Http\Controllers\SsaludController@search',
    'as'    =>  'search.ssalud'
    ]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('servicio-tecnico',function(){
    return view('servicio-tecnico.index');
});
Route::get('traslado/{id}/pdf',[
        'uses'  =>  'App\Http\Controllers\TrasladoController@createPDF',
        'as'    =>  'traslado.pdf'
        ]);
Route::get('traslado/{id}/subir',[
        'uses'  =>  'App\Http\Controllers\TrasladoController@Subir',
        'as'    =>  'traslado.subir'
        ]);
Route::Post('/traslado/archivo',[
    'uses'  =>'App\Http\Controllers\TrasladoController@Archivo',
    'as'    =>'traslado.archivo'
    ]);
Route::get('convenio/{id}/subir',[
        'uses'  =>  'App\Http\Controllers\ConveniosController@Subir',
        'as'    =>  'convenio.subir'
        ]);
Route::Post('/convenio/{id}/archivo',[
    'uses'  =>'App\Http\Controllers\ConveniosController@Archivo',
    'as'    =>'convenio.file'
    ]);
Route::get('pagos/{id}/ficha',[
        'uses'  =>  'App\Http\Controllers\PagosController@Ficha',
        'as'    =>  'pagos.ficha'
        ]);
Route::get('pagos/{id}/pdf',[
        'uses'  =>  'App\Http\Controllers\PagosController@createPDF',
        'as'    =>  'pagos.pdf'
        ]);

Route::Post('/equipo/archivo',[
    'uses'  =>'App\Http\Controllers\EquipoController@Archivo',
    'as'    =>'equipo.archivo'
    ]);
Route::get('equipo/{id}/subir',[
        'uses'  =>  'App\Http\Controllers\EquipoController@Subir',
        'as'    =>  'equipo.subir'
        ]);

Route::get('equipo/{id}/acta',[
        'uses'  =>  'App\Http\Controllers\EquipoController@acta',
        'as'    =>  'equipo.pdf'
        ]);
Route::delete('user/delete/{id}',[
    'uses'  =>'App\Http\Controllers\UserController@delete',
    'as'    =>'user.delete'
]);
Route::get('/user/{id}/dependencia',[
    'uses'  =>'App\Http\Controllers\UserController@GoDependencia',
    'as'    =>'user.dependencia'
]);
Route::Post('/user/{id}/dependencia',[
    'uses'  =>'App\Http\Controllers\UserController@Dependencia',
    'as'    =>'user.checkdependencia'
]);
Route::get('convenio/{id}/baja',[
    'uses'  =>  'App\Http\Controllers\ConveniosController@baja',
    'as'    => 'convenio.baja'
]);
Route::Put('convenio/{id}/darbaja',[
    'uses'  =>  'App\Http\Controllers\ConveniosController@darBaja',
    'as'    => 'convenio.debaja'
]);

