<?php require "../db/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INSERTAR CRUD - NBA</title>
  <link rel="stylesheet" href="../css/insertar.css">
</head>

<body>
  <?php
  if (isset($_POST['btnEnviar'])) {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $procedencia = $_POST['procedencia'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $posicion = $_POST['posicion'];
    $equipo = $_POST['equipo'];

    $conn = conexion();
    $sql_insert = "INSERT INTO jugadores (codigo,Nombre,Procedencia,Altura,Peso,Posicion,Nombre_equipo) VALUES (?,?,?,?,?,?,?)";

    $resultados = mysqli_prepare($conn, $sql_insert);

    $asocia = mysqli_stmt_bind_param($resultados, "isssiss", $codigo, $nombre, $procedencia, $altura, $peso, $posicion, $equipo) ? "verdadero" : "falso";
    echo $asocia . "<br>";

    $ejecutar = mysqli_stmt_execute($resultados) ? "verdadero" : "falso";
    echo $ejecutar . "<br>";

    if ($ejecutar == false) {
      echo "Error la ejecutar las consultas";
    } else {
      echo "se ha añadido correctamente los datos";
      mysqli_stmt_close($resultados);
      header("Location: ../index.php?insert=correcto");
    }
    mysqli_close(($conn));
  }
  ?>

  <main class="maincontent">
    <h1>INSERTAR DATOS - NBA</h1>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" id="formulario">
      <label for="">
        CÓDIGO:
        <input type="text" name="codigo" id="codigo">
      </label>
      <label for="">
        NOMBRE:
        <input type="text" name="nombre">
      </label>
      <label for="">
        PORCEDENCIA:
        <input type="text" name="procedencia">
      </label>
      <label for="">
        ALTURA:
        <input type="text" name="altura">
      </label>
      <label for="">
        PESO:
        <input type="text" name="peso">
      </label>
      <label for="">
        POSICIÓN:
        <select name="posicion" class="selectiId">
          <option value="vacio">Elige posición:</option>
          <?php
          $conn = conexion();
          $pos = "SELECT DISTINCT(Posicion) FROM `jugadores`";
          $resPos = mysqli_query($conn, $pos);
          if ($resPos) {
            while ($fila = mysqli_fetch_array($resPos, MYSQLI_ASSOC)) {
              echo "<option value='" . $fila['Posicion'] . "'>" . $fila['Posicion'] . "</option>";
            }
          }
          ?>
        </select>
      </label>
      <label for="">
        EQUIPO:
        <select name="equipo" class="selectiId">
          <option value="vacio">Elige equipo:</option>
          <?php
          $conn = conexion();
          $pos = "SELECT DISTINCT(Nombre_equipo) FROM `jugadores`";
          $resPos = mysqli_query($conn, $pos);
          if ($resPos) {
            while ($fila = mysqli_fetch_array($resPos, MYSQLI_ASSOC)) {
              echo "<option value='" . $fila['Nombre_equipo'] . "'>" . $fila['Nombre_equipo'] . "</option>";
            }
          }
          ?>
        </select>
      </label>
      <div class="botonesInsert">
        <input type="submit" name="btnEnviar" value="AGREGAR" />
        <input type="reset" name="btnReinicio" value="BORRAR" />
      </div>
    </form>
  </main>
</body>

</html>