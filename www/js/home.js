var app = angular.module('myApp', ['ngDialog'])
  .filter('capital', function() {
    return function(input, all) {
      var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
      return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  })
.filter('sumar', function() {
        return function(data, key) {
            if (typeof(data) === 'undefined' || typeof(key) === 'undefined') {
                return 0;
            }
 
            var sum = 0;
            for (var i = data.length - 1; i >= 0; i--) {
                sum += parseInt(data[i][key]);
            }
 
            return sum;
        };
    })

  .filter('date', function($filter)
{
 return function(input)
 {
  if(input == null){ return ""; } 
 
  var _date = $filter('date')(new Date(input), 'dd MMM YYYY');
 
  return _date.toUpperCase();

 };
})
  ;

app.controller('myCtrl', function($scope, $http, ngDialog) {

    $scope.cargar = function() {
        $http.post("/listadoctb")
            .then(function(response) {
                $scope.listado = response.data;
            });
    }


    $scope.orderByMe = function(x) {
        $scope.myOrderBy = x;
    }

    $scope.sumarCampo = function(datos, campo){
        var total = 0;
        for (var i = 0; i < datos.length; i++) {
            total = total + (datos[i][campo]*1);
        }
        return total;
    }

    $scope.descargarexcel = function(datos) {
        /*nombre dni nacimiento  domicilio   localidad   provincia   suscripcion_id  fecha_alta  estado  nro plan    valor_cuota nominal pagado  x100
*/      //nombre, dni, nacimiento, domicilio, localidad, provincia, nro, plan, valor_cuota
        alasql('SELECT * INTO XLSX("informe.xlsx",{headers:true}) FROM ?',[datos]);
        
    }


    $scope.editar = function(indice) {
        $scope.i = indice;
        ngDialog.open({ template: 'editarCliente',
                        controller: 'myCtrl',
                            scope: $scope});
    }

    $scope.grabar = function(){
        $http({
          method: 'post',
          url: 'grabarCliente',
          data: {cliente:$scope.total[$scope.i]}
        }).then(function successCallback(response) {
            alert('Respuesta: ' + response.data);
          }, function errorCallback(response) {
            alert('Error al enviar: ' + response.data);
          });
        ngDialog.close();
    }

    $scope.cerrar = function(){
        ngDialog.close();
    }

    $scope.ventana = function() {
        var html = angular.element(editarsocio).html();
        ngDialog.open({ template: html, plain : true });
    }
});