<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar - Eliminar</title>
  <link rel="stylesheet" href="../css/actualizar-eliminar.css">
</head>


<body>
  <main class="maincontent">
    <h1>ELIMINAR - ACTUALIZAR - NBA</h1>
    <?php
    if (isset($_POST['btnBorrar'])) {
      require_once "../db/conexion.php";
      try {
        //? COMPROBAMOS SI SE HA PULSADO EL BOTON BORRAR:
        // require_once "db/conexion.php";
        $codigo = $_POST['codigo'];
        // echo $codigo;

        $conn = conexion();
        $sql = "DELETE FROM `jugadores` WHERE `codigo` =?";

        $resultado = $conn->prepare($sql);
        $resultado->bind_param("i", $codigo);
        $resultado->execute();
        if ($resultado) {
          echo "Registro $codigo eliminado correctamente";
        } else {
          echo "No se ha podido eliminar el registro";
        }
        // Cerrar conexiones
        $resultado->close();
        $conn->close();
      } catch (Exception $e) {
        die("!Error: " . $e->getMessage() . " - con el código:" . $e->getCode());
      } finally {
        // $conn = null; // finaliza la conexion;
      }
    }

    //TODO: &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //? COMPROBAMOS SI SE HA PULSADO EL BOTON ACTUALIZAR:


    if (isset($_POST['actualiza'])) {
      require_once "../db/conexion.php";
      try {
        $conn = conexion();

        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $procedencia = $_POST['procedencia'];
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $posicion = $_POST['posicion'];
        $equipo = $_POST['equipo'];

        echo $codigo . "<br>";
        echo $nombre . "<br>";
        echo $procedencia . "<br>";
        echo $altura . "<br>";
        echo $peso . "<br>";
        echo $posicion . "<br>";
        echo $equipo . "<br>";

        /* $sql = "UPDATE `jugadores` SET codigo = ?, Nombre = ?, Procedencia = ?, Altura = ?, Peso = ?, Posicion = ?,Nombre_equipo = ? WHERE codigo = ?"; */


        $consulta = "UPDATE `jugadores` SET `codigo`= ?,`Nombre`= ?,`Procedencia`= ? ,`Altura`= ?,`Peso`= ?,`Posicion`= ?,`Nombre_equipo`= ?";

        // $sentencia = $conn->prepare($sql);
        $sentencia = $conn->prepare($consulta);
        $sentencia->bind_param("isssiss", $codigo, $nombre, $procedencia, $altura, $peso, $posicion, $equipo);
        $sentencia->execute();
        if ($sentencia) {
          echo "bien";
        } else {
          echo "mal";
        }

        // Cerrar conexiones
        // $resultado->close();
        // $conn->close();
      } catch (Exception $e) {
        die("!Error: " . $e->getMessage() . " - con el código:" . $e->getCode());
      }
    } else {
      echo "no actualiza.";
    }

    //? GENERAMOS EL FORMULARIO CON LOS DATOS A MODIFICAR

    if (isset($_POST['btnActualizar'])) {
      require_once "../db/conexion.php";

      try {
        $conn = conexion();
        //* MUESTRO LA TABLA CON LOS DATOS A EDITAR:
        $id = $_POST['codigo'];
        $sql = "SELECT * FROM jugadores WHERE codigo = ?";
        $sentencia = $conn->prepare($sql);
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $jugador = $resultado->fetch_assoc();
        if ($jugador) {
    ?>
          <form action="" method="POST" class="insertar_reg" id="formulario">
            <label for="">
              <!-- Codigo: -->
              <input type="hidden" name="codigo" value="<?php echo $jugador['codigo']; ?>">
            </label>
            <label for="">
              Nombre:
              <input type="text" name="nombre" value="<?php echo $jugador['Nombre']; ?>">
            </label>
            <label for="">
              Procedencia:
              <input type="text" name="procedencia" value="<?php echo $jugador['Procedencia']; ?>">
            </label>
            <label for="">
              Altura:
              <input type="text" name="altura" value="<?php echo $jugador['Altura']; ?>">
            </label>
            <label for="">
              Peso:
              <input type="text" name="peso" value="<?php echo $jugador['Peso']; ?>">
            </label>
            <label for="">
              Posición:
              <input type="text" name="posicion" value="<?php echo $jugador['Posicion']; ?>">
            </label>
            <label for="">
              Nombre de equipo:
              <input type="text" name="equipo" value="<?php echo $jugador['Nombre_equipo']; ?>">
            </label>
            <div class="botones">
              <input type="submit" name="actualiza" classs="btnActualizar" value="ACTUALIZAR">
            </div>
          </form>
    <?php

        } else {
          echo "mal";
        }

        // Cerrar conexiones
        $resultado->close();
        $conn->close();
      } catch (Exception $e) {
        die("!Error: " . $e->getMessage() . " - con el código:" . $e->getCode());
      } finally {
        $conn = null; // finaliza la conexion;
      }
    }
    ?>
  </main>
</body>

</html>