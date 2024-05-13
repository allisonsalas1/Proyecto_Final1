<?php
// Verificamos si se recibieron los datos del producto actualizado
if(isset($_POST['id_producto'], $_POST['nombre'], $_POST['descripcion'], $_POST['fotos'], $_POST['precio'], $_POST['cantidad_almacen'], $_POST['fabricante'], $_POST['origen'])) {
    // Obtenemos los datos del producto actualizado
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fotos = $_POST['fotos'];
    $precio = $_POST['precio'];
    $c_almacen = $_POST['cantidad_almacen'];
    $fabricante = $_POST['fabricante'];
    $origen = $_POST['origen'];
    
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
    
    // Actualizamos los datos del producto en la base de datos
    $sql = "UPDATE Productos SET nombre='$nombre', descripcion='$descripcion', fotos='$fotos', precio='$precio', cantidad_almacen='$c_almacen', fabricante='$fabricante', origen='$origen' WHERE id_producto = $id_producto";
    
    if ($conn->query($sql) === TRUE) {
        echo "Datos del producto con ID $id_producto actualizados exitosamente.";
        header("Location: ../Admin/index_admin.php");       

    } else {
        echo "Error al actualizar los datos del producto: " . $conn->error;
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Es para que en dado caso de no recibir todos los datos del prodcuto actualizado, muestra un mensaje de error
    echo "Error: No se recibieron todos los datos del producto actualizado.";
}
?>