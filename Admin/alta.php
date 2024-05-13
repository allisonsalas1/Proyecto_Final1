<?php
// Verificamos si se recibieron los datos del nuevo producto
if(isset($_POST['nombre'], $_POST['descripcion'], $_FILES['fotos']['name'], $_POST['precio'], $_POST['c_almacen'], $_POST['fabricante'], $_POST['origen'])) {
    // Obtenemos los datos del nuevo producto
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fotos = $_FILES['fotos']['name']; 
    $precio = $_POST['precio'];
    $c_almacen = $_POST['c_almacen'];
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
    
    //obtenemos el archivo de fotos desde el path  
    $carpeta_destino = "Crossfit/";
    $ruta_foto = $carpeta_destino . basename($_FILES['fotos']['name']);
    move_uploaded_file($_FILES['fotos']['tmp_name'], $ruta_foto);
    
    // El querry de insert a la tabla de productos
    $sql = "INSERT INTO Productos (id_producto,nombre, descripcion, fotos, precio, cantidad_almacen, fabricante, origen) 
            VALUES (NULL,'$nombre', '$descripcion', '$fotos', '$precio', '$c_almacen', '$fabricante', '$origen')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Producto '$nombre' dado de alta exitosamente.";
        header("Location: ../Admin/alt_ba_producto.php");        
    } else {
        echo "Error al dar de alta el producto: " . $conn->error;
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Es para que en dado caso de no recibir todos los datos del prodcuto actualizado, muestra un mensaje de error
    echo "Error: No se recibieron todos los datos del nuevo producto.";
}
?>