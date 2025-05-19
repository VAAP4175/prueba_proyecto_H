<?php
include('conexion.php');

if (!empty($_GET['carrera'])) {
    $carrera = $_GET['carrera'];

    $sql_grupos = "SELECT id_grup, grupo, turno, carrera FROM grupos WHERE grado = '$carrera'";
    $resultado_grupos = $conexion->query($sql_grupos);

    if ($resultado_grupos->num_rows > 0) {
        echo "<h2>Grupos de $carrera</h2>";
        echo "<ul>";

        while ($grupo = $resultado_grupos->fetch_assoc()) {
            echo "<li>
                    <a href='ver_horario_grupo.php?id_grup={$grupo['id_grup']}'>
                        {$grupo['carrera']} {$grupo['grupo']} - Turno {$grupo['turno']}
                    </a>
                  </li>";
        }

        echo "</ul>";
    } else {
        echo "⚠ No hay grupos registrados para esta carrera.";
    }

    $conexion->close();
} else {
    echo "⚠ No se ha seleccionado una carrera.";
}
?>
