<?php
//--- SI URL NO EXISTE IR AL RAIZ
App::missing(function($exception)
  {return Redirect::to('/');
});

//--- PRUEBA
Route::get('test', function() {   
    return 'test';
});


App::error(function(Exception $exception, $code)
{
      if(Request::ajax() && $code<>500) {
        return Response::make('Su sesión expiró....');
      }
      if ($code==404){
        return Redirect::to('/')->withFlashMessage('Inicie sesión.');
      }
      if ($code==405){
        return 'Su sesión expiró.';
      }
      
    if ( ! Config::get('app.debug')) {
        // Retorna una vista o lo que creas conveniente
      //Log::useFiles(storage_path().'/logs/errores_produccion.log');
      $ip = Request::getClientIp();
      try {
      $nro_persona = Auth::user()->nro_persona;
      } catch (Exception $e) {
      $nro_persona = 'no disponible';
      }
    Log::error("[código:$code][ip:$ip][persona:$nro_persona]\n".$exception->getMessage());

        return 'Servicio no disponible. Intente más tarde.';
    }
});

//--- Ruta por defecto
Route::resource('/', 'inicioControlador');

Route::get('verDetalle', function(){
  return File::get(app_path().'/views/portal/verDetalle.html');
});

Route::post('marcalistado',   'inicioControlador@marcalistado');
Route::post('rubrolistado',   'inicioControlador@rubrolistado');
Route::post('laempresa',      'inicioControlador@laempresa');
Route::post('plan84',         'inicioControlador@plan84');
Route::post('grabarconsulta', 'inicioControlador@grabarconsulta');
Route::get('verconsultas',    'inicioControlador@verconsultas');
Route::post('buscar',         'inicioControlador@buscar');

Route::get('informe',    'suscripcionControlador@informe');
Route::post('clientes',   'agricolaControlador@clientes');
Route::post('listadoctb', 'suscripcionControlador@listado');


Route::post('grabarCliente', function(){
  $cliente = Input::get('cliente','naranja');
  $cliente_id = $cliente['cliente_id'];
  $apellido = $cliente['apellido'];
  $nombre = $cliente['nombre'];
  $dni = $cliente['dni'];
  $dt = new DateTime($cliente['nacimiento']);
  $nacimiento = $dt->format('Y-m-d');
  $domicilio = $cliente['domicilio'];
  $localidad = $cliente['localidad'];
  $provincia = $cliente['provincia'];

  $sql = "
    UPDATE suscriptor SET
          apellido = '$apellido',
          nombre = '$nombre',
          dni = '$dni',
          nacimiento = '$nacimiento',
          domicilio = '$domicilio'
          WHERE id = $cliente_id
  ";
  
  $r = DB::connection('universal')->update($sql);
  if ($r==1){
    return 'ok';
  }
  return 'Error al grabar';
});

Route::get('crearlistado', 'adminControlador@crearlistado');
Route::post('verlistado','adminControlador@verlistadoautos');
Route::get('imprimirlistado', 'adminControlador@imprimirlistado');
Route::get('imprimirlistadovendedor', 'adminControlador@imprimirlistadovendedor');

Route::group(array('before' => 'auth'), function(){
    Route::resource('verplan', 'usuarioControlador@verplan');
    Route::resource('usuario', 'usuarioControlador');
    Route::resource('admin',   'adminControlador@inicio');
/*
    Route::resource('inicio',       'generalControlador@inicio');
    Route::resource('caja',         'cajaControlador@inicio');
    Route::resource('persona',      'personaControlador@inicio');
    Route::resource('cuentaahorro', 'cajaControlador@inicio');
    Route::resource('suscripcion',  'suscripcionControlador@inicio');
    Route::resource('liquidacion',  'liquidacionControlador@inicio');
    Route::resource('proveedor',    'proveedorControlador@inicio');
    Route::resource('consultas',    'consultasControlador@inicio');
    Route::resource('contabilidad', 'consultasControlador@inicio');
    Route::resource('admin',        'adminControlador@inicio');
*/
}); //--------- FIN ADMIN ACCESS

/*
//--------------- RUTAS QUE ACCEDE ADMIN
Route::group(array('before' => 'auth|soyadmin'), function(){
    Route::resource('admin', 'adminControlador@inicio');
}); //--------- FIN ADMIN ACCESS

//--------------- RUTAS QUE ACCEDE SOCIO O SOCIO/COMERCIO
Route::group(array('before' => 'auth|soyusuario'), function(){
    //Route::controller('usuario','usuarioControlador');
    Route::controller('socio','socioControlador');
}); //--------- FIN ADMIN ACCESS

//--------------- RUTAS QUE ACCEDE COMERCIO
Route::group(array('before' => 'auth|soycliente'), function(){
    Route::controller('autorizaciones','comercioControlador');
    Route::post('validar','comercioControlador@validar');
}); //--------- FIN ADMIN ACCESS

//----- RUTAS QUE ACCEDE EL USUARIO POR PRIMERA VEZ PARA CAMBIAR CLAVE O RESETEAR CLAVE
Route::group(array('before' => 'auth'), function(){
    Route::post('cambiarclave','loginControlador@cambiarpass');
    Route::get('cambiarclave', function()
    {
      return View::make('login.cambiarclave')->withFlashMessage('');
    });
}); //--------- FIN ADMIN ACCESS
*/

//listado de prueba
//Route::controller('listado', 'prueba');

//--- Login
Route::post('entrar', 'loginControlador@acceso');
//Route::get('entrar', 'loginControlador@acceso');
Route::get('salir', 'loginControlador@salir');

//--- cargar usuario de prueba
Route::get('verlog/{archivo}', function($archivo)
{ /*
  $clave = '123123';
  $email = 'super@apla.com';
  $nro_persona = 1064;
  $estado = 0; //0=cambiar pass, 1=acceso
  $nivel = 2; //1=usuario, 2=comercio, 3=usuario y comercio, 99=admin

  $insert = DB::insert("insert into hb_usuario
  						 ( nro_persona,    clave,    email,   estado,  nivel) values 
  						 ($nro_persona,	'$clave', '$email',	 $estado, $nivel)
  					  ");

	return 'Insertado: '.$insert; */

return View::make('general.verlog')->with('archivo',$archivo);
});