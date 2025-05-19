<?php
include('conexion.php');

// Verificar si se seleccionó un grupo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grupo'])) {
    $id_grup = $_POST['grupo'];

    // Obtener todas las materias para el `<select>`
    $sql_materias = "SELECT id_materia, nombre FROM informatica";
    $resultado_materias = $conexion->query($sql_materias);
    $materias = [];

    while ($fila = $resultado_materias->fetch_assoc()) {
        $materias[$fila['id_materia']] = $fila['nombre'];
    }

    // Consulta para obtener los horarios del grupo seleccionado
    $sql = "SELECT h.id, h.hora_inicio, h.hora_fin, h.dia, m.nombre AS materia
            FROM horarios h
            INNER JOIN informatica m ON h.id_materia = m.id_materia
            WHERE h.id_grup = '$id_grup'
            ORDER BY h.hora_inicio, h.dia";

    $resultado = $conexion->query($sql);
    $horario = [];

    while ($fila = $resultado->fetch_assoc()) {
        $hora = "{$fila['hora_inicio']} - {$fila['hora_fin']}";
        $dia = strtolower($fila['dia']);
        $horario[$hora][$dia] = [
            'materia' => $fila['materia'],
            'id' => $fila['id']
        ];
    }

    // Mostrar los horarios en una tabla con `<select>` para elegir las materias
    if (!empty($horario)) {
        echo "<form action='actualizar_horario_A.php' method='POST'>";
        echo "<input type='hidden' name='grupo' value='$id_grup'>";
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
                    <td>$hora</td>";

            foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes'] as $dia) {
                $materia_actual = $dias[$dia]['materia'] ?? '-';
                $id_horario = $dias[$dia]['id'] ?? '';

                echo "<td>
                        <select name='{$dia}_$id_horario'>";
                
                foreach ($materias as $id_materia => $nombre_materia) {
                    $selected = ($materia_actual == $nombre_materia) ? "selected" : "";
                    echo "<option value='$id_materia' $selected>$nombre_materia</option>";
                }

                echo "</select></td>";
            }

            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "<button type='submit'>Actualizar Horario</button>";
        echo "</form>";
    } else {
        echo "⚠ No hay horarios guardados para este grupo.";
    }

    $conexion->close();
} else {
    echo "⚠ Por favor, selecciona un grupo para ver los horarios.";
}
?>

