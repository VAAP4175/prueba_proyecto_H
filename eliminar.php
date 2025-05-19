<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estilo eliminar</title>
    <link rel="stylesheet" href="tabla.css">
    <link rel="stylesheet" href="menu_adm.css">
</head>
<body>
<header>
<h2>Lista de usuarios</h2>
</header>

<aside class="sidebar">

    <div class="logo">
      <img src="imgPH/logo2.png" alt="Logo UICSLP">
    </div>
    <ul class="menu">
    <li class="active" onclick="window.location.href='inicio_adm.php'"><i>🏠</i>Inicio</li>
      <li onclick="window.location.href='adm_usuarios.php'"><i>👤</i>Usuarios</li>
      <li onclick="window.location.href='adm_grupos.php'"><i>📜</i>Grupos</li>
      <li onclick="window.location.href='adm_horarios.php'"><i>📄</i>Horarios</li>
      <li onclick="window.location.href='index.php'"><i>🔙</i>Salir</li>
    </ul>

</aside>
<div class="contenedor">
<button class="button btn-orange-large">
<?php
include('conexion.php');
//verificar si se ha enviado el parametro "id" a travez de URL
if (isset($_GET['id'])) {
    $id=$_GET['id'];

    //Preparar el comando para eliminar el registro almacenado en el sql
    $sql="DELETE FROM usuarios WHERE id=$id";

    if ($conexion->query($sql)==TRUE) {
        echo"Usuario eliminado:<a href=adm_usuarios.php><br>Regresar</a>";
    }else{
        echo"Error al aliminar el usuario:".$conexion->error;
    }
    }else{
        echo"No se proporciono ningun id para eliminar.";
    }
    $conexion->close();
?> 

</button>  
</div>
<footer>UICSLP © 2025 </footer>
</body>
</html>