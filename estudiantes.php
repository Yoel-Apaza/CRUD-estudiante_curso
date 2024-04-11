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
    } else {
        echo "<script>alert('Error al agregar estudiante: " . $conn->error . "');</script>";
    }
}

// Actualizar estudiante
if (isset($_POST['update_student'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $curso_id = $_POST['curso_id'];

    $sql = "UPDATE estudiantes SET nombre='$nombre', edad='$edad', curso_id='$curso_id' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Información del estudiante actualizada exitosamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar información del estudiante: " . $conn->error . "');</script>";
    }
}

// Eliminar estudiante
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM estudiantes WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Estudiante eliminado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar estudiante: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Estudiantes</h2>
        <div class="student-list">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Curso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // READ - Obtener la lista de estudiantes
                    $sql = "SELECT estudiantes.id, estudiantes.nombre, estudiantes.edad, cursos.nombre as curso_nombre 
                            FROM estudiantes 
                            INNER JOIN cursos ON estudiantes.curso_id = cursos.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['nombre']."</td>";
                            echo "<td>".$row['edad']."</td>";
                            echo "<td>".$row['curso_nombre']."</td>";
                            echo "<td>
                                    <a href='edit.php?id=".$row['id']."' class='edit-button'>Editar</a> | 
                                    <a href='eliminar.php?id=".$row['id']."' onclick='return confirm(\"¿Estás seguro que deseas eliminar este estudiante?\")' class='delete-button'>Eliminar</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay estudiantes registrados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="options">
            <a href="agregar_estudiante.php" class="button">Agregar Estudiante</a>
        </div>
    </div>
</body>
</html>
