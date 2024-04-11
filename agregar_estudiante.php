<?php

include 'db_conexion.php';

// Agregar estudiante
if (isset($_POST['add_student'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $curso_id = $_POST['curso_id'];

    $sql = "INSERT INTO estudiantes (nombre, edad, curso_id) VALUES ('$nombre', '$edad', '$curso_id')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Estudiante agregado exitosamente');</script>";
        // Redireccionar a estudiantes.php después de agregar el estudiante
        header("Location: estudiantes.php");
        exit();
    } else {
        echo "<script>alert('Error al agregar estudiante: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Estudiante</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Agregar Estudiante</h2>
        <form method="post" action="">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="number" name="edad" placeholder="Edad" required>
            <select name="curso_id" required>
                <option value="" disabled selected>Seleccionar Curso</option>
                <?php
                // Obtener la lista de cursos
                $sql = "SELECT * FROM cursos";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                }
                ?>
            </select>
            <button type="submit" name="add_student" class="add-button">Agregar Estudiante</button>
        </form>
    </div>
</body>
</html>
