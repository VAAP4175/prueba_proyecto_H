<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tabla.css">
    <link rel="stylesheet" href="menu_adm.css">
</head>
<!------------------------------------------------->
<body>
<header>
<h2>Lista de usuarios</h2>
</header>

<aside class="sidebar">
    <ul class="menu">
    <li class="active" onclick="window.location.href='inicio_adm.php'"><i>🏠</i>Inicio</li>
      <li onclick="window.location.href='adm_usuarios.php'"><i>👤</i>Usuarios</li>
      <li onclick="window.location.href='adm_grupos.php'"><i>📜</i>Grupos</li>
      <li onclick="window.location.href='adm_horarios.php'"><i>📄</i>Horarios</li>
      <li onclick="window.location.href='index.php'"><i>🔙</i>Salir</li>
    </ul>

</aside>
<main>
<?php
include('conexion.php');
//verificar si se ha enviado el formulario de busqueda
if (isset($_POST['buscar'])) {
    $filtro=$_POST['filtro'];
    $busqueda=$_POST['buscar'];

    //Usamos sentencia preparada para evitar inyeccion SQL
    $sql="SELECT*FROM usuarios WHERE $filtro LIKE ?";// LIKE busca el registro
    $stmt=$conexion->prepare($sql);
    $param="%$busqueda%";
    $stmt->bind_param("s",$param);
    $stmt->execute();
    $result=$stmt->get_result();
}else{
//si  no hay busqueda, mostramos todos los empleados
    $sql="SELECT*FROM usuarios";
    $result=$conexion->query($sql);
}

if ($result->num_rows > 0) {
    echo"<table border='1'>
    <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Cargo</th>
     <th colspan='3'>Acciones</th>
    </tr>";

    while($row=$result->fetch_assoc()){
        echo" <tr>
        <td>".$row['id']."</td>
        <td>".$row['nombre']."</td>
        <td>".$row['correo']."</td>
        <td>".$row['cargo']."</td>
         <td><a href='eliminar.php?id=".$row['id']."'>Eliminar</a>
        <td><a href='actualizar.php?id=".$row['id']."'>Actualizar</a>
        <td><a href='adm_usuarios.php'>Regresar</a>
        </tr>";
    }
    echo"<table>";
    echo"<a href='adm_usuarios.php'>Regresar</a>";
}else{
    echo"0 resultados";
}

$conexion->close();
?>
</main>
<footer>UICSLP © 2025 </footer>
</body>
</html>