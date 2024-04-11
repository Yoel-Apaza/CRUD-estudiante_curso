<?php
include 'db_conexion.php';

// Obtener el ID del estudiante de la URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID de estudiante no especificado.";
    exit();
}

// Obtener la información del estudiante de la base de datos
$sql = "SELECT * FROM estudiantes WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Estudiante no encontrado.";
    exit();
}

// Actualizar estudiante
if (isset($_POST['update_student'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $curso_id = $_POST['curso_id'];

    $sql = "UPDATE estudiantes SET nombre='$nombre', edad='$edad', curso_id='$curso_id' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Información del estudiante actualizada exitosamente');</script>";
        // Redireccionar a estudiantes.php después de actualizar el estudiante
        header("Location: estudiantes.php");
        exit();
    } else {
        echo "<script>alert('Error al actualizar información del estudiante: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Editar Estudiante</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>" required>
            <input type="number" name="edad" placeholder="Edad" value="<?php echo $row['edad']; ?>" required>
            <select name="curso_id" required>
                <option value="" disabled>Seleccionar Curso</option>
                <?php
                // Obtener la lista de cursos
                $sql = "SELECT * FROM cursos";
                $result = $conn->query($sql);
                while($curso = $result->fetch_assoc()) {
                    $selected = ($curso['id'] == $row['curso_id']) ? "selected" : "";
                    echo "<option value='".$curso['id']."' $selected>".$curso['nombre']."</option>";
                }
                ?>
            </select>
            <button type="submit" name="update_student" class="update-button">Actualizar Estudiante</button>
        </form>
    </div>
</body>
</html>
