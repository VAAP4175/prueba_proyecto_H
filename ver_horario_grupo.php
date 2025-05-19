<?php
include('conexion.php');

if (isset($_GET['id_grup'])) {
    $id_grup = $_GET['id_grup'];

    $sql = "SELECT h.hora_inicio, h.hora_fin, h.dia, m.nombre AS materia
            FROM horarios h
            INNER JOIN informatica m ON h.id_materia = m.id_materia
            WHERE h.id_grup = '$id_grup'
            ORDER BY h.hora_inicio, h.dia";

    $resultado = $conexion->query($sql);

    $horario = [];

    while ($fila = $resultado->fetch_assoc()) {
        $hora = "{$fila['hora_inicio']} - {$fila['hora_fin']}";
        $dia = strtolower($fila['dia']);
        $horario[$hora][$dia] = $fila['materia'];
    }

    if (!empty($horario)) {
        echo "<h2>Horario del Grupo</h2>";
        echo "<table border='1'>
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
                <tbody>";

        foreach ($horario as $hora => $dias) {
            echo "<tr>
                    <td>$hora</td>
                    <td>" . ($dias['lunes'] ?? '-') . "</td>
                    <td>" . ($dias['martes'] ?? '-') . "</td>
                    <td>" . ($dias['miercoles'] ?? '-') . "</td>
                    <td>" . ($dias['jueves'] ?? '-') . "</td>
                    <td>" . ($dias['viernes'] ?? '-') . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "⚠ No hay horarios guardados para este grupo.";
    }

    $conexion->close();
} else {
    echo "⚠ No se ha seleccionado un grupo.";
}
?>
