<?php
include('conexion.php'); // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_grup = $_POST['grupo'];

    $horas = [
        "07:00:00" => "07:50:00",
        "07:50:00" => "08:40:00",
        "08:40:00" => "09:30:00",
        "09:50:00" => "10:40:00",
        "10:40:00" => "11:30:00",
        "11:30:00" => "12:20:00",
        "12:20:00" => "13:10:00"
    ];
    $dias = ["lunes", "martes", "miercoles", "jueves", "viernes"];

    foreach ($horas as $inicio => $fin) {
        foreach ($dias as $dia) {
            $indice = array_search($inicio, array_keys($horas));
            $id_materia = $_POST[$dia . $indice];

            $sql = "INSERT INTO horarios (id_grup, id_materia, hora_inicio, hora_fin, dia) 
                    VALUES ('$id_grup', '$id_materia', '$inicio', '$fin', '$dia')";

            if (!$conexion->query($sql)) {
                die("Error al guardar el horario: " . $conexion->error);
            }
        }
    }

    echo "✅ Horario guardado correctamente.";
    $conexion->close();
}
?>
