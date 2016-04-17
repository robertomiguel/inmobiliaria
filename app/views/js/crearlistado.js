$(document).ready(function() {
  var lista;

    $('#listado' ).dialog({
      position: { my: 'center', at: 'center', of: window },
      resizable: false,
    modal: true,
      height: 600,
      width: 700,
      autoOpen: false,
      show: {
        effect: 'clip',
        duration: 500
      },
      hide: {
        effect: 'clip',
        duration: 500
      },
    buttons: {
        Cerrar: function() {
          $('#listado').html('');
          $( this ).dialog( "close" );
        },
        'Imprimir': function() {
             imprimirlistado();
             //$('div#contenido').printArea();
            }
    }
    });

  $('.ui-dialog').addClass('sombra');
});

  function agregar(id, marca)
  {
    //$('#seleccion').html('<tr><td>'+$marca+'</td></tr>');

    if (!$('#'+id)[0].checked ){
      quitar(id);
    } else {
      $('#seleccion tr:last').after('<tr id=r'+id+' marca="'+marca+'"><td>'+marca+'</td></tr>');
    }

  }

  function quitar(id)
  {
    $('#r'+id).remove();
  }
  function verlistado()
  {
      genlista();
      $('#listado').dialog('open');
      $('#listado').html('Generando listado...');

      $.post("verlistado",{
        lista: listaid
      },function(data){
            $('#listado').html(data);
            //alert(data);
      });
  }

  function genlista()
  {
        var listaid = "''";
    $("#seleccion tr").each(function() 
      {
          $this = $(this);
          var firstName = "'" + $('#'+$this.get(0).id).text() + "'";//id.replace('r','');
          
          if (listaid=="''")
          {
            listaid = firstName;
          } else {
            listaid = listaid + ', ' + firstName;
          }
          
      });
      lista = listaid;
  }

  function imprimirlistado()
  {
    window.open("/imprimirlistado?lista=" + lista);
  }

function imprimirlistadovendedor(m)
  {
    genlista();

    if (m==0) {
      window.open("/imprimirlistadovendedor?membrete=0&lista=" + lista);
    } else {
      window.open("/imprimirlistadovendedor?membrete=1&lista=" + lista);
    }

  }
