@extends ('cabecera')

@section ('content')

<style>
@media screen and (min-width: 1040px) {
    html {
        background-image: url("img/fondocubo4.png");
        background-repeat: repeat;
        background-size: 320px;
    }
}

.caja {
	padding: 8px;
}
.logo {
	left: 30%; right: 30%;
	position: fixed;
	bottom: 2px;
}
.cabeza {
	background: #b2b0bf;
    width: 100%;
    
    padding-left: 10px;
   	color: white;
	text-shadow: 0 1px 2px rgba(0, 0, 0, .6);

}
.grupo input {
	width: 90%;
	padding-left: 3px;
}
.login {
	background: #e9e7f4;
	letter-spacing: 2px;
}
</style>

<body class="sombra">

<noscript>
    Necesita activar Javascript para usar éste sitio
</noscript>

<div class="grupo titulo total base-tabla medio">

	<div class="caja total" align="center">
	Empresa X - ADMINISTRACION
	</div>
</div>
		

<div class="grupo">
	<div class="caja total" align="center">
		<?php Formatos::titulo(Empresa::find(1)->nombre_int) ?>
		<img src="img/titulo.png">
	</div>
</div>

<div class="grupo sombra base-90 movil-65 tablet-40 redondear login">
	<form action="entrar" method="post" onsubmit="$('#loading').show();$('#mensaje').hide();">
	<div class="caja total titulo" align="center">
		Inicio de sesión
	</div>
	<br>
	<div class="caja total" align="center" id="loading" style="display:none">
        <img src="img/ajax-cargando.gif"> <br>
        <span class="bg-danger">Accediendo...</span>
        <br>
	</div>	

	@if(Session::has('flash_message'))
		<div class="caja total" id="mensaje" align="center">
          <img src="img/alert.png"> <br>
		  <span class="bg-danger">{{ Session::get('flash_message') }}</span>
		  <br>
		</div>	
	@endif
	<div class="caja base-20" align="center">
		Usuario
	</div>
	<div class="caja base-80" align="center">
		<input type="text"
		 id="email" name="email"
		  placeholder="Usuario"
		  class="redondear">
	</div>
	<div class="caja base-20" align="center">
		Clave
	</div>
	<div class="caja base-80" align="center">
	   	<input type="password"
	   	id="clave" name="clave"
	   	placeholder="Clave"
	   	class="redondear">
	</div>
	<div class="caja total" align="center">
	  	<button type="submit">Entrar</button>
	</div>

	</form>

</div>	

@if(isset($error404))
	<script>
		alert($error404);
	</script>
@endif