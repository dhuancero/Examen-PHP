<?php require "./db/conexion.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD NBA</title>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/nav.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./js/main.js" defer></script>
</head>

<body>
  <main class="content">
    <h1>CRUD NBA</h1>
    <div class="verPag">
      <form action="" method="GET" class="selectForm">
        <span>Elige el número de registros para ver:</span>
        <select name="selectNum" class="selectNum">
          <option value="all"> Selecciona: </option>
          <option value="5">5</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <div class="btnSelectNum">
          <input type="submit" value="SELECCIONA" name="btnSelectNum">
        </div>
      </form>
    </div>
    <?php if (isset($_GET['insert'])) { ?>
      <div class="correcto" id="cuadro">
        REGISTROS AÑADIDOS CORRECTAMENTE
      </div>
    <?php } ?>

    <ul class="titulo">
      <li>CÓDIGO</li>
      <li>NOMBRE</li>
      <li>PROCEDENCIA</li>
      <li>ALTURA</li>
      <li>PESO</li>
      <li>POSICIÓN</li>
      <li>NOMBRE DE EQUIPO</li>
      <form action="./pages/insertar.php" method="POST" class="insertForm">
        <div class="botonesInsert">
          <input type="submit" name="btnInsertar" value="INSERTAR">
        </div>
      </form>
    </ul>
    <?php

    $conn = conexion();
    // require "pages/paginacion.php";
    $sql_consulta = "SELECT * FROM `jugadores` WHERE Posicion = 'C' OR Posicion = 'C-F' OR Posicion = 'F-C' ";
    $res_consulta = mysqli_query($conn, $sql_consulta);
    $num_resul = mysqli_num_rows($res_consulta);
    // echo $num_resul . "<br>";


    empty($_GET['selectNum']) ? $selectNum =  $num_resul : ($_GET['selectNum'] == "all" ? $selectNum =  $num_resul : $selectNum = $_GET['selectNum']);

    $total_pagina = ceil($num_resul / $selectNum);

    // echo "Número de registros: " . $num_resul . " <br> ";
    // echo "Numero de paginas: " . $total_pagina . " <br> ";

    empty($_GET['page']) ? $pagina = 1 :  $pagina = $_GET['page'];
    // echo "te devuelve pagina : " . $pagina . " <br> ";

    $pagInicial = ($pagina - 1) * $selectNum;
    // echo "Pagina inicia ahora: " . $pagInicial . " <br> ";

    $sql = "SELECT * FROM `jugadores` WHERE Posicion LIKE '%C%' ORDER BY codigo ASC LIMIT $pagInicial, $selectNum";
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
    require "pages/nav.php";
    ?>
  </main>
</body>

</html>