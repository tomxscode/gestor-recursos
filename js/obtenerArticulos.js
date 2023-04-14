$(document).ready(function() {
  obtenerArticulos();
})

const 
  btnBuscar = document.getElementById("buscar"),
  inputBuscar = document.getElementById("buscarArticulo")
  ;

btnBuscar.addEventListener('click', function() {
  buscarArticulo(inputBuscar.textContent);
})

function obtenerArticulos() {
  $.ajax({
    url: "../core/articulos/obtener_articulos.php",
    type: "GET",
    dataType: "json",
    success: function(data) {
      console.log(data);
      // Si se obtuvieron resultados
      for (var i = 0; i < data.length; i++) {
        var articulo = data[i];
        var html = "<li><h2>" + articulo.nombre + "</h2></li>";
        $("#lista-articulos").append(html);
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error al obtener los archivos: " + textStatus + " - " + errorThrown);
    }
  }) 
}

$('#buscar').on('click', function() {
  var nombre = $('#buscarArticulo').val();
  $.ajax({
    url: '../core/articulos/buscar_por_nombre.php',
    type: 'POST',
    dataType: 'json',
    data: {nombre:nombre},
    success: function(response) {
      $("#lista-articulos").html('');
      if (response.length > 0) {
        $.each(response, function(index, articulo) {
          var html = '<li><h2>' + articulo.nombre + '</li></h2>';
          $('#lista-articulos').append(html);
        });
      } else {
        $('#lista-articulos').html('No hay registros');
      }
    },
    error: function(xhr, status, error) {
      console.log('Error al obtener los archivos: ' + status);
    }
  })
})