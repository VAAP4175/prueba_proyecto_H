<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="menu_adm.css">
   <link rel="stylesheet" href="prueba.css">
</head>
<body>
<header>
<h2>Editar horario Docentes</h2>
</header>
<aside class="sidebar">
    <ul class="menu">
    <li class="active" onclick="window.location.href='inicio_adm.php'"><i>🏠</i>Inicio</li>
      <li onclick="window.location.href='adm_usuarios.php'"><i>👤</i>Usuarios</li>
      <li onclick="window.location.href='adm_grupos.php'"><i>📜</i>Grupos</li>
      <li onclick="window.location.href='adm_horarios.php'"><i>📄</i>Horarios</li>
      <li onclick="window.location.href='index.php'"><i>🔙</i>Salir</li>
      <button type="button" onclick="window.location.href='registro_H.php'">Alumnos</button> <br><br>
    </ul>

</aside>
<main>
  <form action="registro_H.php" method="POST">
    <label for="grupo">Selecciona el grupo:</label>
    <select name="grupo">
        <?php
        include('conexion.php');
        $resultado = $conexion->query("SELECT id_grup, grado, carrera, grupo, turno FROM grupos");
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value='{$fila['id_grup']}'>
                    {$fila['grado']} - {$fila['carrera']} - {$fila['grupo']} ({$fila['turno']})
                  </option>";
        }
        ?>
    </select>

    <table border="1">
        <thead>
            <tr>
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $horas = [
                "07:00 - 07:50",
                "07:50 - 08:40",
                "08:40 - 09:30",
                "09:50 - 10:40",
                "10:40 - 11:30",
                "11:30 - 12:20",
                "12:20 - 13:10"
            ];

            $dias = ["lunes", "martes", "miercoles", "jueves", "viernes"];

            foreach ($horas as $index => $hora) {
                echo "<tr><td>$hora</td>";

                foreach ($dias as $dia) {
                    echo "<td><select name='{$dia}{$index}'>";
                    
                    $materias = $conexion->query("SELECT id_materia, nombre FROM informatica");
                    while ($materia = $materias->fetch_assoc()) {
                        echo "<option value='{$materia['id_materia']}'>{$materia['nombre']}</option>";
                    }

                    echo "</select></td>";
                }

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <button type="submit">Guardar Horario</button>
</form>
<form action="buscar_H.php" method="post">
  <label for="grupo">Selecciona el grupo:</label>
    <select name="grupo">
        <?php
        include('conexion.php');
        $resultado = $conexion->query("SELECT id_grup, grado, carrera, grupo, turno FROM grupos");
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value='{$fila['id_grup']}'>
                    {$fila['grado']} - {$fila['carrera']} - {$fila['grupo']} ({$fila['turno']})
                  </option>";
        }
        ?>
    </select>
    <button type="submit" name="buscar">Buscar</button>
</form>
</main>
<footer>UICSLP © 2025 </footer>
</body>
</html>