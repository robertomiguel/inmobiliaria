@extends ('cabecera')

@section ('content')

{{ Cargar::javascript(array( '/js/portal.js' )) }}
<style>
	.logo {
		max-width: 150px;
	}
	.cabeza {
		color: black;
	}
	@media (min-width: 600px) {
		.cabeza {
			background-image: url('/img/fondo_cabeza.jpg');
			background-repeat: no-repeat;
			width: 80%;
			color: white;
		}
	}
	.vertical-align {
	    display: flex;
	    align-items: center;
	}
	.resultados {
		height: 400px;
	}
	.resultados img {
		height: 300px;
	}

	.ngdialog.ngdialog-theme-default.custom-width-600 .ngdialog-content {
	    width: 600px;
	}

	.ngdialog.ngdialog-theme-default.custom-width-800 .ngdialog-content {
	    width: 800px;
	}

	.ngdialog.ngdialog-theme-default.custom-width-900 .ngdialog-content {
	    width: 900px;
	}

</style>

<div class="container-fluid" ng-app="myApp" ng-controller="myCtrl">
	<div class="row vertical-align">
		<div class="col-md-2 text-center">
			<img src="/img/go_logo.jpg" alt="Gentión On-Line" class="img-responsive logo sombra redondear">
		</div>
		<div class="col-md-10 cabeza textosombra">
			<h2>Inmobiliaria Rosario</h2>
			<h4><span class="glyphicon glyphicon-home"></span> Lima 1422 - 2000 Rosario</h4>
			<h4><span class="glyphicon glyphicon-phone"></span> Tel/Fax: 0341 - 155-833627</h4>
			<h4><span class="glyphicon glyphicon-envelope"></span> email: robertomiguel@outloook.com</h4>
		</div>
	</div>

<br>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Filtro de búsqueda</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Filtro de búsqueda</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
		


			<div class="col-md-2 col-xs-12 col-sm-6">
		      	<span>Quiero</span>
		      	<select ng-model="squiero" name="quiero" id="quiero" class="form-control">
		      		<option value="1">Alquilar</option>	
		      		<option value="2">Comprar</option>
		      	</select>
			</div>


			<div class="col-md-2 col-xs-12 col-sm-6">
		      	<span ng-show="squiero">Tipo de propiedad</span>
		      	<select ng-model="stipo" name="tipo" id="tipo" ng-show="squiero" class="form-control">
		      		<option ng-repeat="t in tipo" value="@{{t.id}}">@{{t.nombre}}</option>
		      	</select>
			</div>

			<div class="col-md-2 col-xs-12 col-sm-6">	
			    <span ng-hide="stipo=='4' || stipo=='5' || !stipo">Dormitorios</span>
			    <select ng-model"shab" name="hab" id="hab" ng-hide="stipo=='4' || stipo=='5' || !stipo" class="form-control">
			    	<option ng-repeat="d in dorm" value="@{{d.id}}">@{{d.nombre}}</option>
			    </select>
			</div>

			<div class="col-md-2 col-xs-12 col-sm-6">	
			    <span ng-show="stipo">Localidad</span>
			    <select ng-model"slocal" name="loc" id="loc" ng-show="stipo" class="form-control">
			    	<option ng-repeat="l in localidad" value="@{{l.id}}">@{{l.nombre}}</option>
			    </select>
			</div>

			<div class="col-md-2 col-xs-12 col-sm-6 vertical-align">
		      	<button ng-show="stipo" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Buscar</button>
			</div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Propiedades</h3>
  </div>
  <div class="panel-body">


	<div class="row resultados">

	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="/img/deptos/edif1.jpg" alt="">
	      <div class="caption">
	        <h3>Mendoza 2100</h3>
	        <p>Alquiler $ 4.800</p>
	        <p>Vista sur, 3 dorm., 2 baños, balcón</p>
	        <p><a href="" ng-click="detalle(1)" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-eye-open"></span> Detalle</a>
	        <a href="" ng-click="consulta(1)" class="btn btn-default derecha" role="button"><span class="glyphicon glyphicon-question-sign"></span> Consultar</a></p>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="/img/deptos/edif2.jpg" alt="">
	      <div class="caption">
	        <h3>Bv Oroño 430</h3>
	        <p>Alquiler $ 6.800</p>
	        <p>2 dorm., 1 baños, balcón terraza, piscina</p>
	        <p><a href="" ng-click="detalle(2)" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-eye-open"></span> Detalle</a>
	        <a href="" ng-click="consulta(2)" class="btn btn-default derecha" role="button"><span class="glyphicon glyphicon-question-sign"></span> Consultar</a></p>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="/img/deptos/edif3.jpg" alt="">
	      <div class="caption">
	        <h3>Anchoris 300</h3>
	        <p>Venta $ consultar.</p>
	        <p>1 dorm., 1 baño, patio, garage</p>
	        <p><a href="" ng-click="detalle(3)" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-eye-open"></span> Detalle</a>
	        <a href="" ng-click="consulta(3)" class="btn btn-default derecha" role="button"><span class="glyphicon glyphicon-question-sign"></span> Consultar</a></p>
	      </div>
	    </div>
	  </div>

	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="/img/deptos/edif4.jpg" alt="">
	      <div class="caption">
	        <h3>9 de Julio 800</h3>
	        <p>Alquiler $ 2.800</p>
	        <p>Monoambiente, 1 baño, placard, luminoso</p>
	        <p><a href="" ng-click="detalle(4)" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-eye-open"></span> Detalle</a>
	        <a href="" ng-click="consulta(4)" class="btn btn-default derecha" role="button"><span class="glyphicon glyphicon-question-sign"></span> Consultar</a></p>
	      </div>
	    </div>

	  </div>

	</div>

    
  </div>
</div>


</div>
@stop