<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Inmobiliaria - Rosario')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1"-->
    
    <link rel="shortcut icon" href="favicon.png" />
    
    <?php //seleccionar tema
      $ini = parse_ini_file("../app/config/temajs.ini");
      $sel = $ini['seleccion'];
      $tema = $ini[$sel];
    ?>
    
    {{ HTML::style("/css/temas/$tema/jquery-ui.min.css", array('media' => 'screen')) }}
    {{ HTML::style("/css/temas/$tema/theme.css", array('media' => 'screen')) }}
    
    <link rel="stylesheet" href="tema/css/estilos.css">


    {{ Cargar::stylesheet(array(
                          '/css/bootstrap.min.css',
                          '/css/bootstrap-theme.min.css',
                          '/css/ngDialog.min.css',
                          '/css/ngDialog-theme-default.css',
                          '/css/global.css'
                          )) 
    }}

    {{ Cargar::javascript(array(
                                '/js/alasql.min.js',
                                '/js/xlsx.core.min.js',
                                '/js/angular.min.js',
                                '/js/ngDialog.min.js',
                                '/js/home.js',
                                '/js/jquery-1.11.2.min.js',
                                '/js/bootstrap.min.js',
                                '/js/jquery-ui.min.js',
                                '/js/global.js'
                                ))
    }}

  </head>
  <body>
  
        @yield('content')
  
  </body>
</html>