<?php
include('conexion.php'); // Conectar a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grupo'])) {
    $id_grup = $_POST['grupo'];

    // Recorrer los datos enviados para actualizar cada horario
    foreach ($_POST as $key => $value) {
        if ($key !== "grupo" && !empty($value)) {
            list($dia, $id_horario) = explode("_", $key);

            // Actualizar la materia en la base de datos
            $sql_update = "UPDATE horarios SET id_materia = '$value' WHERE id = '$id_horario'";

            if (!$conexion->query($sql_update)) {
                die("Error al actualizar el horario: " . $conexion->error);
            }
        }
    }

    echo "✅ Horario actualizado correctamente.";
    echo "<a href='adm_horarios.php?id_grup=$id_grup'>Volver al horario</a>";

    $conexion->close();
} else {
    echo "⚠ No se han recibido datos para actualizar.";
}
?>
