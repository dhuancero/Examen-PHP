<?php
$num_datos = $selectNum;

$sql_consulta = "SELECT * FROM `jugadores` WHERE Posicion = 'C' OR Posicion = 'C-F' OR Posicion = 'F-C' ";
$res_consulta = mysqli_query($conn, $sql_consulta);

$num_resul = mysqli_num_rows($res_consulta);
echo $num_resul;

$total_pagina = ceil($num_resul / $num_datos);

echo "Número de registros: " . $num_resul . " <br> ";
echo "Numero de paginas: " . $total_pagina . " <br> ";

if (empty($_GET['page'])) {
  $pagina = 1;
} else {
  $pagina = $_GET['page'];
}

echo "te devuelve pagina : " . $pagina . " <br> ";
$pagInicial = ($pagina - 1) * $num_datos;
echo "Pagina inicia ahora: " . $pagInicial . " <br> ";
$sql = "SELECT * FROM `jugadores` WHERE Posicion LIKE '%C%' ORDER BY codigo ASC LIMIT $pagInicial, $num_datos";
$resultado = mysqli_query($conn, $sql);
if ($resultado) {
  while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
?>
    <ul class="lista">
      <li><?php echo $fila['codigo'] ?></li>
      <li><?php echo $fila['Nombre'] ?> </li>
      <li><?php echo $fila['Procedencia'] ?> </li>
      <li><?php echo $fila['Altura'] ?> </li>
      <li><?php echo $fila['Peso'] ?> </li>
      <li><?php echo $fila['Posicion'] ?> </li>
      <li><?php echo $fila['Nombre_equipo'] ?> </li>
      <form action="pages/eliminar-actualizar.php" method="POST" class="editForm">
        <div class="botones">
          <input type="hidden" name="codigo" value="<?php echo $fila['codigo'] ?>">
          <input type="submit" name="btnBorrar" value="BORRAR">
          <input type="submit" name="btnActualizar" value="ACTUALIZAR">
        </div>
      </form>
    </ul>
<?php
  }
} else {
  echo "<p class='fallo'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
}
