<?php
// Verificamos si se recibió el ID del producto a dar de baja
if(isset($_POST['id_producto'])) {
    // Obtenenemos el ID del producto para dar de baja
    $id_producto = $_POST['id_producto'];
    
    // Es la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Proyecto_Final";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificamos la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para poder dar de baja un producto 
    $sql = "DELETE FROM Productos WHERE id_producto='$id_producto';    ";
    
    if ($conn->query($sql) === TRUE) {
        echo "Producto con ID $id_producto dado de baja exitosamente.";
        header("Location: ../Admin/alt_ba_producto.php");   
    } else {
        echo "Error al dar de baja el producto: " . $conn->error;
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // En dado caso de no recibió el ID del producto, mostrar un mensaje de error
    echo "Error: No se proporcionó el ID del producto.";
}
?>