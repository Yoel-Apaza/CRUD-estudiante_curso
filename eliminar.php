<?php
include 'db_conexion.php';

// Eliminar estudiante
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM estudiantes WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Estudiante eliminado exitosamente');</script>";
        // Redirigir de vuelta a estudiantes.php después de eliminar el estudiante
        header("Location: estudiantes.php");
        exit();
    } else {
        echo "<script>alert('Error al eliminar estudiante: " . $conn->error . "');</script>";
    }
}
?>
