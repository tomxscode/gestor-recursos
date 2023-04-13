$(document).ready(function() {
  obtenerArticulos();
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