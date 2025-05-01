<?php

use App\Http\Controllers\Admin\PropiedadesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\CitaGroupController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PropiedadesController as ControllersPropiedadesController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',  [ClientController::class, 'index'])->name('welcome');

Auth::routes();

Route::group(['middleware' => ['checkRole:Admin,Agente']], function () {
    Route::prefix('admin')->group(function() {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        ///Propiedades
        Route::get('/propiedades', [PropiedadesController::class, 'index'])->name('adm.index.propiedades');
        Route::get('/propiedades/form', [PropiedadesController::class, 'create'])->name('adm.create.propiedades');
        Route::post('/propiedades/agregar_nuevo', [PropiedadesController::class, 'store'])->name('adm.propiedades.agregar_nuevo');
        Route::get('/propiedades/propietario/show/{id}', [PropiedadesController::class, 'show'])->name('adm.propiedades.show');
        Route::get('/propiedades/subir_imagenes/{id?}', [PropiedadesController::class, 'pagina_subir_imagenes'])->name('adm.subir.imagenes');
        Route::post('/propiedades/propietario/store', [PropiedadesController::class, 'propietario_agregar'])->name('adm.propiedades.propietario.store');
        Route::post('/propiedades/tipo/store', [PropiedadesController::class, 'tipo_agregar'])->name('adm.propiedades.tipo.store');
        Route::post('/propiedades/ventatipo/store', [PropiedadesController::class, 'venta_tipo_agregar'])->name('adm.propiedades.ventatipo.store');
        Route::get('/propiedades/editar/{id}', [PropiedadesController::class, 'edit'])->name('adm.propiedades.editar');
        Route::post('/propiedades/editar_existente/{id?}', [PropiedadesController::class, 'update'])->name('adm.propiedades.editar_existente');
        Route::delete('/propiedades/{id}/delete', [PropiedadesController::class, 'destroy'])->name('adm.propiedades.destroy');
        Route::get('/propiedades/citas/{id?}', [PropiedadesController::class, 'citas'])->name('adm.propiedades.citas');
        ///Imagenes
        Route::post('/propiedades/imagen/store', [ImageController::class, 'store'])->name('adm.propiedades.imagenes.store');
        Route::delete('/propiedades/imagen/destroy/{id}', [ImageController::class, 'destroy'])->name('adm.propiedades.imagenes.destroy');
        Route::post('/guardar-hotspot', [ImageController::class, 'storeHotspot'])->name('guardar.hotspot');
        ///Propietarios
        Route::get('/propietarios/lista/ajax', [PropietarioController::class, 'ajax_propietarios'])->name('adm.propietarios.ajax.index');
        Route::get('/propiedades/usuario/{id?}', [PropietarioController::class, 'propiedadesPropietario'])->name('adm.propiedades.usuario');
        Route::get('/propietarios/lista', [PropietarioController::class, 'index'])->name('adm.propietarios.index');
        Route::get('/propietarios/create', [PropietarioController::class, 'create'])->name('adm.propietarios.create');
        Route::post('/propietarios/store', [PropietarioController::class, 'store'])->name('adm.propietarios.store');
        Route::get('/propietarios/{id?}/edit', [PropietarioController::class, 'edit'])->name('adm.propietarios.edit');
        Route::put('/propietarios/update/{id}', [PropietarioController::class, 'update'])->name('adm.propietarios.update');
        /// Usuarios
        Route::get('/usuarios/administracion', [UserController::class, 'index'])->name('adm.usuarios.index');
        Route::get('/usuarios/admin/ajax', [UserController::class, 'ajax_usuarios'])->name('adm.usuarios.ajax');
        Route::get('/usuarios/create', [UserController::class, 'create'])->name('adm.usuarios.create');
        Route::post('/usuarios/store', [UserController::class, 'store'])->name('adm.usuarios.store');
        Route::get('/usuarios/{id?}/edit', [UserController::class, 'edit'])->name('adm.usuarios.edit');
        Route::put('/usuarios/update/{id}', [UserController::class, 'update'])->name('adm.usuarios.update');
        Route::post('/users/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggle.status');
        /// Roles Y permisos
        Route::get('/roles', [UserController::class, 'indexRoles'])->name('adm.roles.index');
        Route::post('/roles/asignar-permisos', [UserController::class, 'asignarPermisos'])->name('roles.asignar.permisos');
        ///Citas Group
        Route::get('/citas/group', [CitaGroupController::class, 'index'])->name('adm.citas.group.index');
        Route::get('/citas/group/ajax/propiedad/{id}', [CitaGroupController::class, 'ajax_citas_group_propiedad'])->name('adm.citas.group.ajax.propiedad');
        Route::get('/citas/group/ajax', [CitaGroupController::class, 'ajax_citas_group'])->name('adm.citas.group.ajax');
        Route::get('/citas/horarios/ajax', [CitaGroupController::class, 'obtenerHorarios'])->name('obtenerHorarios');
        Route::get('/citas/group/create/{id}', [CitaGroupController::class, 'create'])->name('adm.citas.group.create');
        Route::post('/citas/group/store', [CitaGroupController::class, 'store'])->name('adm.citas.group.store');
        Route::get('/citas/group/{id?}/show', [CitaGroupController::class, 'show'])->name('adm.citas.group.show');
        Route::get('/citas/group/{id?}/edit', [CitaGroupController::class, 'edit'])->name('adm.citas.group.edit');
        Route::put('/citas/group/update/{id}', [CitaGroupController::class, 'update'])->name('adm.citas.group.update');
        Route::put('/citas/group/update/status/{id}', [CitaGroupController::class, 'citaStatusUpdate'])->name('adm.citas.group.status');
        /// Servicios
        Route::get('/servicios/lista', [ServicioController::class, 'index'])->name('adm.servicios.index');
        Route::get('/servicios/group/ajax', [ServicioController::class, 'ajax_servicios_group'])->name('adm.servicios.group.ajax');
        Route::get('/servicios/agregar/{id?}', [ServicioController::class, 'create'])->name('adm.servicios.agregar');
        Route::get('/servicios/show/{id}', [ServicioController::class, 'show'])->name('adm.servicios.show');
        Route::get('/servicios/editar/{id?}', [ServicioController::class, 'edit'])->name('adm.servicios.editar');
        Route::put('/servicios/editar_existente/{id}', [ServicioController::class, 'update'])->name('adm.servicios.editar_existente');
        Route::post('/servicios/agregar_nuevo', [ServicioController::class, 'store'])->name('adm.servicios.agregar_nuevo');
        Route::post('/servicios/agregar_imagen', [ServicioController::class, 'store_imagen_servicio'])->name('adm.servicios.agregar_imagen');
        Route::get('/servicios/delete_imagen/{id}', [ServicioController::class, 'delete_imagen_servicio'])->name('adm.servicios.delete_imagen');
        /// Graficos
        Route::get('/grafico_clientes/datos', [EncuestaController::class, 'obtenerDatosGrafico'])->name('grafico_clientes_datos');
        Route::get('/citas/encuesta/graficas/{id}', [EncuestaController::class, 'admin_cita_encuesta_graficas'])->name('adm.citas.encuesta.graficas');
        Route::get('/grafico-top-propiedades', [EncuestaController::class, 'obtenerTopPropiedades'])->name('grafico.top.propiedades');
        /// Reportes 
        Route::get('/reportes/citas', [HomeController::class, 'indexReportesPage'])->name('adm.reportes.citas');
        Route::post('/reportes/citas/generar', [HomeController::class, 'generarReporte'])->name('adm.reportes.citas.generar');
        Route::get('reportes/citas/excel', [HomeController::class, 'exportExcel'])->name('adm.reportes.citas.excel');
        /// backups
        Route::get('/admin/copias-de-seguridad', [BackupController::class, 'pageCopiasSeguridad'])->name('admin.page.packups');
        Route::post('/backups/run', [BackupController::class, 'runBackup'])->name('backup.run');
        Route::get('/backups/download/{file}', [BackupController::class, 'downloadBackup'])->name('backup.download');
        Route::get('/backup/delete/{name}', [BackupController::class, 'deleteBackup'])->name('backup.delete');
        
        //Citas
        //Route::get('/citas/lista', [CitaController::class, 'index_admin'])->name('adm.citas.index');
        //Route::get('/citas/usuario/{id?}', [CitaController::class, 'index_admin_user'])->name('adm.citas.usuarios');
        //Route::get('/citas/create', [CitaController::class, 'create'])->name('adm.citas.create');
        //Route::post('/citas/store', [CitaController::class, 'store'])->name('adm.citas.store');
        //Route::get('/citas/{id?}/edit', [CitaController::class, 'edit'])->name('adm.citas.edit');
        //Route::put('/citas/update/{id}', [CitaController::class, 'update_admin'])->name('adm.citas.update');
        //Route::post('/citas/encuesta', [CitaController::class, 'admin_cita_encuesta'])->name('adm.citas.encuesta');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ControllersUserController::class, 'profilePage'])->name('perfil');
    Route::put('/user/update/{id}', [ControllersUserController::class, 'update'])->name('user.update');
    Route::post('/user/change-password/{id}', [ControllersUserController::class, 'changePassword'])->name('user.changePassword');
    Route::get('/propiedades/buscar', [ControllersPropiedadesController::class, 'buscar'])->name('propiedades.buscar');

    Route::get('/usuario/citas/ver/{id?}', [CitaController::class, 'index'])->name('usuario.citas.index');
    Route::get('/usuario/cita/programar/{id}', [CitaController::class, 'storeCita'])->name('programar.cita');

    Route::get('/usuario', [CitaController::class, 'usuario'])->name('usuario.index');
    Route::get('/usuario/servicios', [CitaController::class, 'servicios'])->name('usuario.servicios.index');
    Route::get('/usuario/servicios/{id}', [CitaController::class, 'serviciosPorPropiedad'])->name('usuario.servicios.index.propiedad');
    Route::post('/usuario/servicios/solicitud/store/', [ServicioController::class, 'solicitar_servicio'])->name('citas.servicios.solicitud.store');
    Route::post('/usuario/servicios/store', [ServicioController::class, 'store_cliente'])->name('citas.servicios.cliente.store');
    Route::get('/usuario/servicios/{id}/detalle', [CitaController::class, 'detalleServicioCliente'])->name('usuario.servicios.detalle');

    Route::get('/usuario/citas/todos', [CitaController::class, 'all_citas_user'])->name('all.citas.user');
    Route::post('/usuario/citas/agregar_nuevo', [CitaController::class, 'store'])->name('usuario.citas.agregar_nuevo');

    Route::get('/usuario/citas/encuesta/{citaId?}/{propId?}', [CitaController::class, 'encuesta'])->name('usuario.citas.encuesta');
    Route::post('/usuario/citas/encuesta_respuesta', [CitaController::class, 'storeRespuestas'])->name('usuario.citas.encuesta_respuesta');
});

Route::get('propieades', [ControllersPropiedadesController::class, 'index'])->name('home.propiedades');
Route::get('/propiedades/detalle/{id}', [ControllersPropiedadesController::class, 'show'])->name('propiedades.detalle');
Route::get('nosotros', [ClientController::class, 'pageNosotros'])->name('home.nosotros');


Route::get('/denegado', function () {
    return  view('web.denegado');
})->name('unauthorized');