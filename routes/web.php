<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::view('/', 'auth.login');
Route::view('/login', 'auth.login');
Route::get('/cerrar', 'HomeController@cerrar');
Route::view('/registrar', 'auth.register');
Route::view('/plantilla', 'forms.plantilla.layoutBasico');
Route::view('/api', 'API.prueba');
Route::view('/ucv', 'forms.prueba');
//Redireccion de Login
Route::get('/userReg', 'Auth\LoginController@usuarioRegistrado');


Route::get('/ofuscar', 'MaestroController@ofuscar');
Route::get('/ofuscar2', 'MaestroController@ofuscar2');

Route::view('/inicio', 'inicio');
Route::view('/otro', 'forms.plantilla.mntBasico');
Route::get('/pppoe', 'MaestroController@pppoe');
Route::view('/hotspot2', 'hotspot.index');

//API SOCIAL LOGIN
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::view('/logeofb', 'forms.pruebas.loginfb');
Route::post('/hotspot', 'Auth\SocialAuthController@hotspot');
Route::post('/hotspot/validar', 'HotspotController@validar');
Route::get('auth2/{provider}', 'SocialAuthController@redirectToProvider')->name('social2.auth');
Route::get('auth2/{provider}/callback', 'SocialAuthController@handleProviderCallback');

//Plantillas Hotspot
Route::post('/hotspot/login', 'Auth\SocialAuthController@login');
Route::post('/hotspot/status', 'Auth\SocialAuthController@status');
Route::post('/hotspot/logout', 'Auth\SocialAuthController@logout');
Route::view('/hotspot/publicidad', 'hotspot.publicidad');
Route::post('/hotspot/registro', 'RegistroController@index');
Route::post('/addRegistro', 'RegistroController@addRegistro');

//Prueba Post
Route::get('/post', 'PostController@index');
Route::post('/post/grabar', 'PostController@store');
Route::get('ajaxRequest', 'PostController@ajaxRequest');
Route::post('ajaxRequestt', 'PostController@ajaxRequestPost');
Route::get('carbon', 'PostController@prueba');
Route::get('mk', 'MaestroController@prueba');
Route::view('/basico', 'forms.plantilla.mntBasico');
Route::view('/basico2', 'forms.plantilla.lstBasico');
Route::view('/vuejs', 'forms.pruebas.vuejs');

Route::view('/format', 'forms.pruebas.format');

//-------Lavaravel API para Instagram using AUth0--------
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    //Router
    Route::get('/router', 'RouterController@index');
    Route::post('/grabar-router', 'RouterController@store');
    Route::post('router/actualizar', 'RouterController@update');
    Route::view('/nuevo-router', 'forms.router.mntRouter');
    Route::get('/eliminar-router/{idrouter}', 'RouterController@destroy');
    Route::get('/mostrar-router/{id}', 'RouterController@show');

    //Queues
    Route::get('/queues', 'QueuesController@index');
    Route::get('/queues/nuevo', 'QueuesController@create');
    Route::post('/queues/grabar', 'QueuesController@store');

    //Equipos
    Route::get('/equipos', 'EquiposController@index');
    Route::get('/equipos/nuevo', 'EquiposController@create');
    Route::post('/equipos/grabar', 'EquiposController@store');
    Route::get('/equipos/mostrar/{id}', 'EquiposController@show');
    Route::post('/equipos/actualizar', 'EquiposController@update');
    Route::get('/equipos/eliminar/{id}', 'EquiposController@destroy');
    //zonas 
	Route::get('/zonas','ZonasController@index');	
	Route::get('/zonas/nuevo','ZonasController@create');
	Route::post('zonas/grabar','ZonasController@store'); 
	Route::post('/zonas/actualizar','ZonasController@update');
	Route::get('/zonas/mostrar/{id}','ZonasController@show');
	Route::get('/zonas/eliminar/{id}','ZonasController@destroy');
	Route::get('/zonas/habilitar/{id}','ZonasController@habilitar');
    Route::get('/zonas/desabilitar/{id}','ZonasController@desabilitar');
    //tickets 
	

    //-----Clientes-----------
    Route::get('/clientes', 'ClientesController@index');
    Route::get('/clientes/nuevo', 'ClientesController@create');
    Route::post('/clientes/grabar', 'ClientesController@store');
    Route::get('/clientes/mostrar/{id}', 'ClientesController@show');
    Route::post('/clientes/actualizar', 'ClientesController@update');
    Route::get('/clientes/eliminar/{id}', 'ClientesController@destroy');
    Route::get('/cliente', 'ClientesController@cliente');
    //Servicios
    Route::get('/cliente/{id}', 'ClientesController@cliente');
    Route::post('/cliente/servicios', 'ClientesController@storeServicio');
    Route::get('/servicio/nuevo/{idcliente}', 'ServicioController@create');
    Route::post('/servicio/grabar', 'ServicioController@store');
    Route::get('/servicio/mostrar/{id}', 'ServicioController@show');
    Route::post('/servicio/actualizar', 'ServicioController@update');
    Route::post('/servicio/perfil', 'MaestroController@getPerfil');
    Route::get('/servicio/eliminar/{id}', 'ServicioController@destroy');
    //Notificaciones
    Route::post('/notificaciones/actualizar', 'ServicioController@updateNotificaciones');
    //Herramientas
    Route::get('/clientes/herramientas', 'ClientesController@showHerramientas');
    //Comprobante
    Route::post('/comprobante/cliente/guardar', 'ComprobanteController@storeCliente');
    //----FIN Clientes---------

    //Empresa
    Route::get('/empresa', 'EmpresaController@index');
    Route::get('/empresa/nuevo', 'EmpresaController@create');
    Route::post('/empresa/grabar', 'EmpresaController@store');
    Route::get('/empresa/mostrar/{id}', 'EmpresaController@show');
    Route::post('/empresa/actualizar', 'EmpresaController@update');
    Route::get('/empresa/eliminar/{id}', 'EmpresaController@destroy');
    Route::post('/empresa/verificarID','EmpresaController@verificarID');

    //Tipo de Acceso
    Route::get('/tipo-de-acceso', 'MaestroController@indexTipoAcceso');
    Route::get('/tipo/mostrar/{id}', 'MaestroController@showTipoAcceso');
    Route::post('/tipo/grabar', 'MaestroController@storeTipoAcceso');
    Route::post('/tipo/actualizar', 'MaestroController@updateTipoAcceso');
    Route::post('/tipo/eliminar', 'MaestroController@destroyTipoAcceso');
    Route::post('/tipo/actualizar/estado', 'MaestroController@updateEstadoTipoAcceso');

    //Perfiles(planes de internet)
    Route::get('/perfiles', 'PerfilesController@index');
    Route::post('/perfil/grabar', 'PerfilesController@store');
    Route::post('/perfil/actualizar', 'PerfilesController@update');
    Route::post('/perfil/eliminar', 'PerfilesController@destroy');
    Route::post('/perfil/desabilitar', 'PerfilesController@disabled');
    Route::post('/perfil/habilitar', 'PerfilesController@habilitar');
    //Hotspot
    Route::post('/hotspot/perfil', 'PerfilesController@getPerfil');
    Route::post('/perfil/hotspot/grabar', 'PerfilesController@storeHotspot');
    Route::post('/perfil/hotspot/actualizar', 'PerfilesController@updateHotspot');
    Route::post('/guardarImportPerfil','PerfilesController@guardarImportPerfil');
    //Importar y Exportar Perfiles de Internet
    Route::post('/exportPerfil','PerfilesController@exportPerfil');
    Route::post('/importPerfil','PerfilesController@importPerfil');
    //PPPoE
    Route::post('/perfil/pppoe', 'PerfilesController@getPerfilPPPoE');
    Route::post('/perfil/pppoe/grabar', 'PerfilesController@storePPPoE');
    Route::post('/perfil/pppoe/actualizar', 'PerfilesController@updatePPPoE');

    //Usuarios
    Route::get('/usuarios', 'UsuarioController@index');
    Route::get('/usuario/nuevo', 'UsuarioController@create');
    Route::post('/usuario/grabar', 'UsuarioController@store');
    Route::get('/usuario/mostrarTrabajadores/{id}', 'UsuarioController@showTrabajadores');
    Route::get('/usuario/mostrar/{id}', 'UsuarioController@show'); 

    Route::post('/usuario/actualizar', 'UsuarioController@update');
    Route::get('/usuario/eliminar/{id}', 'UsuarioController@destroy');
    Route::post('/usuario/desabilitar', 'UsuarioController@disabled');
    Route::post('/usuario/habilitar', 'UsuarioController@habilitar');
    Route::post('/usuario/updContra','UsuarioController@updContra');
    Route::post('usuario/verificarID','UsuarioController@verificarID');
    Route::post('usuario/verificarUsuario','UsuarioController@verificarUsuario');

    //--------------------HOTSPOT------------------------
    //Redes Sociales
    Route::get('/social', 'SocialController@index');
    Route::post('/social/actualizar', 'SocialController@update');
    //Metodo para obtener las Conexiones de usuarios en el Hotspot
    Route::get('/conexiones', 'HotspotController@conexiones');
    Route::get('/desconectar/{id}/{idrouter}', 'HotspotController@desconectar');
    //---Usuarios Hotspot---
    Route::get('/hotspot/usuarios', 'Clientes2Controller@index');
    Route::get('/hotspot/usuario/{id}', 'Clientes2Controller@show');
    Route::get('/hotspot/usuario/eliminar/{id}','Clientes2Controller@destroy');
    Route::post('/cliente/habilitar','Clientes2Controller@habilitar');
    Route::post('/cliente/desabilitar','Clientes2Controller@disabled');

    //Carrusel
    Route::get('/carrusel', 'CarruselController@index');
    Route::get('/carrusel/nuevo', 'CarruselController@create');
    Route::post('/carrusel/grabar', 'CarruselController@store');
    Route::post('/carrusel/eliminar', 'CarruselController@destroy');
    Route::post('/carrusel/actualizar', 'CarruselController@update');
    Route::get('/carrusel/mostrar/{id}', 'CarruselController@show');
    Route::post('/carrusel/desabilitar', 'CarruselController@disabled');
    Route::post('/carrusel/habilitar', 'CarruselController@habilitar');

    //Plantillas Hotspot
    //Página de Bienvenida
    Route::get('/hotspot/bienvenida', 'HotspotController@mntBienvenida');
    Route::get('/hotspot/pagina-bienvenida', 'HotspotController@bienvenida');
    Route::post('/addBienvenida', 'HotspotController@addBienvenida');
    Route::post('/addParametrosBienvenida', 'HotspotController@addParametrosBienvenida');
    //Página de cierre
    Route::get('/hotspot/logout', 'HotspotController@mntLogout');
    Route::get('/hotspot/pagina-cerrar-sesion', 'HotspotController@logout');
    Route::post('/addLogout', 'HotspotController@addLogout');
    Route::post('/addParametrosLogout', 'HotspotController@addParametrosLogout');
    //Página de Publicidad
    Route::get('/hotspot/lstPublicidad', 'HotspotController@lstPublicidad');
    Route::get('/hotspot/mntPublicidad', 'HotspotController@mntPublicidad');
    Route::get('/hotspot/pagina-publicidad', 'HotspotController@publicidad');
    Route::get('/hotspot/publicidad/nuevo', 'HotspotController@create');
    //Página de Inicio
    Route::get('/hotspot/pagina-inicio', 'HotspotController@inicio');

    //MAESTROS
    Route::post('/ip/pool', 'MaestroController@getPoolIp'); //Retorna el POOL de IPs del Mikrotik
    Route::post('/getMarca', 'MaestroController@getMarca'); //Retorna registro de marcas con relacion al idgrupo
    Route::post('/getTipoAcceso', 'MaestroController@getTipoAcceso'); //Retorna lista de tipos de acceso (HOTSPOT, PPPoE, QUEUES)
    Route::post('/getModelo', 'MaestroController@getModelo'); //Retorna registro de modelo de equipos segun idmarca

    //Parametros
    Route::get('/parametros-generales','ParametrosController@generales');
    Route::post('/parametros/updGenerales','ParametrosController@updGenerales');

    //Helpers
    Route::view('/colores', 'forms.helpers.colores');
    Route::view('/iconos', 'forms.helpers.iconos');

    //Campañas
    Route::get('/campana', 'CampanaController@index')->name('campana');
 // Route::get('/selectEmails', 'CampanaController@selectMultipleEmails');
    Route::post('/mails/enviarCampana', 'CampanaController@enviarCampana');
 // Route::get('/mails/prueba', 'CampanaController@prueba');
    //Correos
    Route::get('/correo', 'MailController@index');
    Route::get('/selectEmails', 'MailController@selectMultipleEmails');
    Route::post('/correo/enviarMensaje', 'MailController@enviarMensaje');
    Route::get('/outbox', 'MailController@obtenerMensajesSalida');
	Route::get('/outbox/{id}', 'MailController@detalleSalida');
    //OFUSCAR CODIGO
    Route::get('/ofuscar', 'CampanaController@vistaOfuscarCodigo');
    Route::post('/ofuscar/resultado', 'CampanaController@ofuscarCodigo');
    


    //Monitor
    Route::get('/monitor','HomeController@monitor');
    Route::post('/getInterfaces','HomeController@getInterfaces');

    //Tickets
    Route::get('/tickets/registrar','TicketsController@registrar'); 
    Route::post('/tickets/validar','TicketsController@validar');
    Route::post('/tickets/store','TicketsController@store'); 

     //TicketsAsignados
     Route::get('/tickets/Asignar','TicketsAsignadosController@asignarTickets');	
     Route::get('/tickets/Asignados/nuevo','TicketsAsignadosController@create');
     Route::post('/tickets/Asignados/grabar','TicketsAsignadosController@store');
     Route::post('/tickets/Asignados/grabarDetalle','TicketsAsignadosController@storeDetallePerfil');
     Route::get('/tickets/Asignados/mostrar/{id}','TicketsAsignadosController@show'); 
     Route::get('/tickets/Asignados/AsignarTrabajador/{idUsuario}/{idTicket}','TicketsAsignadosController@asignarTrabajador');
     Route::post('/tickets/Asignados/grabarTrabajador','TicketsAsignadosController@asignarTrabajadorDetalle');
     Route::post('/tickets/Asignados/contarTicketsvendedor','TicketsAsignadosController@ticketsPorPersona');
     Route::post('/tickets/Asignados/contarTipoTicketsvendedor','TicketsAsignadosController@TipoTicketsPorPersona');
     Route::post('/tickets/Asignados/contarTicketsvendedor2','TicketsAsignadosController@ticketsPorPersona2');
 
     Route::get('/tickets/Asignados/eliminar/{id}','TicketsAsignadosController@destroy');
     Route::get('/tickets/Asignados/habilitar/{id}','TicketsAsignadosController@habilitar');
     Route::get('/tickets/Asignados/desabilitar/{id}','TicketsAsignadosController@desabilitar');  
     Route::post('/tickets/TiporPerfil/contador','TicketsAsignadosController@contadorPerfilesAsignados');
     Route::get('/tickets/Asignados/historialVentas','TicketsAsignadosController@historialVentas');


    //Gestión de Tickest Vendedor
    Route::get('/tickets/vendedor','TicketsController@vwVendedor');	
     //Ventas
     Route::get('/tickets/registrarVenta','TicketsController@registrarVenta');
    Route::post('/tickets/contarVentaPerfilAsignado','TicketsController@contadorVentasPerfilAsignado');
    Route::post('/tickets/registrarVenta/grabar','TicketsController@storeTicketsVenta');
    Route::get('/tickets/Venta/mostrar/{id}','TicketsController@mostrarVenta');
    Route::post('/tickets/Venta/actualizar','TicketsController@UpdateVenta');
    Route::get('/tickets/Venta/eliminar/{id}','TicketsController@destroy');
    Route::post('/tickets/Venta/ValidarCodigo','TicketsController@ValidarCodigo');

    Route::get('/tickets/historialVentas','TicketsController@historialVentas');


    

    


    



     


    

    
	/* ;
	 
	Route::post('/tickets/Asignados/actualizar','TicketsAsignadosController@update');

	Route::get('/tickets/Asignados/eliminar/{id}','TicketsAsignadosController@destroy');
	Route::get('/tickets/Asignados/habilitar/{id}','TicketsAsignadosController@habilitar');
	Route::get('/tickets/Asignados/desabilitar/{id}','TicketsAsignadosController@desabilitar'); */

});

Route::view('/prueba', 'forms.plantilla.mntBasico');
