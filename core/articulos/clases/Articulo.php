<?php
// Clase articulo
class Articulo {

  // Atributos
  private $conn;

  // Constructor
  public function __construct($conn) {
    $this->conn = $conn;
  }

  // Funcion obtenerDatos

  public function obtenerArticulos() {
    $sql = "SELECT * FROM articulos";
    $resultado = $this->conn->query($sql);

    // Verificamos si hay columnas
    if ($resultado->num_rows > 0) {
      // Creamos un array para almacenar los resultados
      $articulos = array();
      // iteramos los resultados y agregamos al array
      while ($fila = $resultado->fetch_assoc()) {
        $articulos[] = $fila;
      }
      return $articulos;
    } else {
      return array();
    }
  }

  public function buscarArticuloPorNombre($nombre) {
    $sql = "SELECT * FROM articulos WHERE nombre LIKE '%$nombre%'";
    $resultado = $this->conn->query($sql);

    if ($resultado->num_rows > 0) {
      while ($fila = $resultado->fetch_assoc()) {
        $articulos[] = $fila;
      }
      return $articulos;
    } else {
      return "No se encontraron resultados";
    }
  }


}

?>