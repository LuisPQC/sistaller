<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome'); // o tu vista principal
});
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/buscar-trabajo', [App\Http\Controllers\TrabajoController::class, 'redirigirPorCodigo']);
Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('auth');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//rutas para configuraciones
Route::get('/admin/configuraciones', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('admin.configuracion.index')->middleware('auth');
Route::get('/admin/configuraciones/create', [App\Http\Controllers\ConfiguracionController::class, 'create'])->name('admin.configuracion.create')->middleware('auth');
Route::post('/admin/configuraciones/create', [App\Http\Controllers\ConfiguracionController::class, 'store'])->name('admin.configuracion.store')->middleware('auth');
Route::get('/admin/configuraciones/{id}', [App\Http\Controllers\ConfiguracionController::class, 'show'])->name('admin.configuracion.show')->middleware('auth');
Route::get('/admin/configuraciones/{id}/edit', [App\Http\Controllers\ConfiguracionController::class, 'edit'])->name('admin.configuracion.edit')->middleware('auth');
Route::put('/admin/configuraciones/{id}', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('admin.configuracion.update')->middleware('auth');
Route::delete('/admin/configuraciones/{id}', [App\Http\Controllers\ConfiguracionController::class, 'destroy'])->name('admin.configuracion.destroy')->middleware('auth');

//rutas para roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('admin.roles.show')->middleware('auth');
Route::get('/admin/roles/{id}/asignar', [App\Http\Controllers\RoleController::class, 'asignar_roles'])->name('admin.roles.asignar_roles')->middleware('auth');
Route::put('/admin/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'update_asignar'])->name('admin.roles.update_asignar')->middleware('auth');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

//rutas para usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');
//ruta para cotizaciones
Route::get('/admin/cotizaciones', [App\Http\Controllers\CotizacionController::class, 'index'])->name('admin.cotizaciones.index')->middleware('auth');
Route::get('/admin/cotizaciones/create', [App\Http\Controllers\CotizacionController::class, 'create'])->name('admin.cotizaciones.create')->middleware('auth');
Route::post('/admin/cotizaciones/create', [App\Http\Controllers\CotizacionController::class, 'store'])->name('admin.cotizaciones.store')->middleware('auth');
Route::get('/admin/cotizaciones/{id}', [App\Http\Controllers\CotizacionController::class, 'show'])->name('admin.cotizaciones.show')->middleware('auth');
Route::get('/admin/cotizaciones/{id}/edit', [App\Http\Controllers\CotizacionController::class, 'edit'])->name('admin.cotizaciones.edit')->middleware('auth');
Route::put('/admin/cotizaciones/{id}', [App\Http\Controllers\CotizacionController::class, 'update'])->name('admin.cotizaciones.update')->middleware('auth');
Route::delete('/admin/cotizaciones/{id}', [App\Http\Controllers\CotizacionController::class, 'destroy'])->name('admin.cotizaciones.destroy')->middleware('auth');
//ruta para clientes
Route::get('/admin/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth');
Route::get('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth');
Route::post('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth');
Route::get('/admin/clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth');
Route::get('/admin/clientes/{cliente}/edit', [App\Http\Controllers\ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth');
Route::put('/admin/clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'update'])->name('admin.clientes.update')->middleware('auth');
Route::delete('/admin/clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth');
//ruta para vehiculos
Route::get('/admin/vehiculos', [App\Http\Controllers\VehiculoController::class, 'index'])->name('admin.vehiculos.index')->middleware('auth');
Route::get('/admin/vehiculos/create', [App\Http\Controllers\VehiculoController::class, 'create'])->name('admin.vehiculos.create')->middleware('auth');
Route::post('/admin/vehiculos/create', [App\Http\Controllers\VehiculoController::class, 'store'])->name('admin.vehiculos.store')->middleware('auth');
Route::get('/admin/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculoController::class, 'show'])->name('admin.vehiculos.show')->middleware('auth');
Route::get('/admin/vehiculos/{vehiculo}/edit', [App\Http\Controllers\VehiculoController::class, 'edit'])->name('admin.vehiculos.edit')->middleware('auth');
Route::put('/admin/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculoController::class, 'update'])->name('admin.vehiculos.update')->middleware('auth');
Route::delete('/admin/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculoController::class, 'destroy'])->name('admin.vehiculos.destroy')->middleware('auth');
//ruta para trabajos
Route::get('/admin/trabajos', [App\Http\Controllers\TrabajoController::class, 'index'])->name('admin.trabajos.index')->middleware('auth');
Route::get('/admin/trabajos/create', [App\Http\Controllers\TrabajoController::class, 'create'])->name('admin.trabajos.create')->middleware('auth');
Route::post('/admin/trabajos/create', [App\Http\Controllers\TrabajoController::class, 'store'])->name('admin.trabajos.store')->middleware('auth');
Route::get('/admin/trabajos/{trabajo}', [App\Http\Controllers\TrabajoController::class, 'show'])->name('admin.trabajos.show');
Route::get('/admin/trabajos/{trabajo}/edit', [App\Http\Controllers\TrabajoController::class, 'edit'])->name('admin.trabajos.edit')->middleware('auth');
Route::put('/admin/trabajos/{trabajo}', [App\Http\Controllers\TrabajoController::class, 'update'])->name('admin.trabajos.update')->middleware('auth');
Route::delete('/admin/trabajos/{trabajo}', [App\Http\Controllers\TrabajoController::class, 'destroy'])->name('admin.trabajos.destroy')->middleware('auth');
//ruta para facturas
Route::get('/admin/facturas', [App\Http\Controllers\FacturaController::class, 'index'])->name('admin.facturas.index')->middleware('auth');
Route::get('/admin/facturas/create', [App\Http\Controllers\FacturaController::class, 'create'])->name('admin.facturas.create')->middleware('auth');
Route::post('/admin/facturas/create', [App\Http\Controllers\FacturaController::class, 'store'])->name('admin.facturas.store')->middleware('auth');
Route::get('/admin/facturas/{factura}', [App\Http\Controllers\FacturaController::class, 'show'])->name('admin.facturas.show')->middleware('auth');
Route::get('/admin/facturas/{factura}/edit', [App\Http\Controllers\FacturaController::class, 'edit'])->name('admin.facturas.edit')->middleware('auth');
Route::put('/admin/facturas/{factura}', [App\Http\Controllers\FacturaController::class, 'update'])->name('admin.facturas.update')->middleware('auth');
Route::delete('/admin/facturas/{factura}', [App\Http\Controllers\FacturaController::class, 'destroy'])->name('admin.facturas.destroy')->middleware('auth');
//ruta para pdf´s
// Exportar PDF de una factura
Route::get('facturas/{factura}/pdf', [App\Http\Controllers\FacturaController::class, 'pdf'])->name('admin.facturas.pdf');
// Exportar PDF de un trabajo
Route::get('trabajos/{trabajo}/pdf', [App\Http\Controllers\TrabajoController::class, 'pdf'])->name('admin.trabajos.pdf');
//editar esto
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('archivos/{archivo}/edit', [App\Http\Controllers\ArchivoTrabajoController::class, 'edit'])->name('archivos.edit');
    Route::put('archivos/{archivo}', [App\Http\Controllers\ArchivoTrabajoController::class, 'update'])->name('archivos.update');
});
//ruta
Route::get('/admin/{trabajo}', [App\Http\Controllers\TrabajoController::class, 'muestra'])->name('admin.muestra');


