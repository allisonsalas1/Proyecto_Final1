<?php

// Verificamos si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_POST['id_usuario'])) {
    // El usuario ha iniciado sesión, usamos $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_POST['id_usuario'];
} 
 
// Es la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Proyecto_Final");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los productos en el carrito del usuario que ingreso
$sql = "SELECT Productos.*, historial_de_compras.* FROM historial_de_compras 
        INNER JOIN Productos ON historial_de_compras.producto_h = Productos.id_producto 
        WHERE historial_de_compras.usuario = $id_usuario";
// Ejecuta la consulta
$result = $conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Checar compras</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../Productos/css/styles.css" rel="stylesheet"/>
</head>
<body>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Verificamos si hay productos en el carrito
            if ($result->num_rows > 0) {
                echo "<h2>Historial de compras de $id_usuario</h2>";

                // Checamos los productos en el carrito y se muestran en la tabla
                while($row = $result->fetch_assoc()) {
                    $nombre_producto = $row['nombre'];
                    $precio_producto = $row['precio'];
                    $imagen_producto = $row['fotos'];
                    $id_producto=$row['id_producto'];

                    // Mostramos cada producto en una fila de la tabla
                    ?>
                    <tr>
                        <td><img src="../Crossfit/<?php echo $imagen_producto; ?>" alt="Imagen del producto" style="max-width: 100px;"></td>
                        <td><?php echo $nombre_producto; ?></td>
                        <td><span>&#36;<?php echo $precio_producto; ?></span></td>
                    </tr>
                    <?php
                }
            } else {
                // No hay productos en el carrito
                echo "<tr><td colspan='4'>No hay productos en el carrito</td></tr>";
            }
            // Cerrar la conexión
            $conexion->close();
            ?>
            </tbody>
        </table>
    </div>
</div>
<a href="../Admin/index_admin.php" class="btn btn-outline-dark">Regresar</a>

</body>
</html>