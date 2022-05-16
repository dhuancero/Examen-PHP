<?php
function conexion()
{
  $db = "nba";

  $conn = mysqli_connect("localhost", "david", "1234");
  if (!$conn) {

    die("<p class='fallo'>Fallo de conexión: " . mysqli_connect_error() . "</p>");
  } else {
    mysqli_select_db($conn, $db) or die("<p class='fallo'>No se ha encontrado la base de datos</p>");
    return $conn;
  }
}
