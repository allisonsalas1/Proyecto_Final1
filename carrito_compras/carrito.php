<?php
// Iniciamos la sesión
session_start();

// Verificamos si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_SESSION['id_usuario'])) {
    // El usuario ha iniciado sesión, usamos $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuario'];
} else {
    // El usuario no ha iniciado sesión, lo redirigimos a la pagina de incio o mostramos un mensaje de error
    header("Location: ../sesion_inicio.html");
    exit();
}
 
// Es la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Proyecto_Final");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los productos en el carrito del usuario 
$sql = "SELECT Productos.*, carrito_de_compras.* FROM carrito_de_compras 
        INNER JOIN Productos ON carrito_de_compras.producto_compra = Productos.id_producto 
        WHERE carrito_de_compras.usuario = $id_usuario";
// Ejecuta la consulta
$result = $conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Shop Item</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../Productos/css/styles.css" rel="stylesheet"/>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../Inicio/inicio.php">Rakun Fitness Equipment</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../Inicio/index.html">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Sobre nosotros</a></li>
                    </ul>
                    <form class="d-flex" action="../html/sesion_inicio.html">
                        <button class="btn btn-outline-dark" type="submit">
                            Cerrar sesion
                            <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                        </button>
                    </form>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
<div class="container px-4 px-lg-5 my-5">
    <h1 class="display-5 fw-bolder">Carrito de Compras</h1>
    <div class="table-responsive">
    <table class="table table-bordered">
            <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Verificamos si hay productos en el carrito
            if ($result->num_rows > 0) {
                // checamos los productos que se encuentran en el carrito y se muestran en la tabla
                while($row = $result->fetch_assoc()) {
                    $nombre_producto = $row['nombre'];
                    $precio_producto = $row['precio'];
                    $imagen_producto = $row['fotos'];
                    $id_producto=$row['id_producto'];

                    // Mostramos cada producto en la tabla
                    ?>
                    <tr>
                        <td><img src="../Crossfit/<?php echo $imagen_producto; ?>" alt="Imagen del producto" style="max-width: 100px;"></td>
                        <td><?php echo $nombre_producto; ?></td>
                        <td><span>&#36;<?php echo $precio_producto; ?></span></td>
                        <td>
                            <form method="post" action="./eliminar_p.php">
                                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                                <button class="btn btn-outline-danger" type="submit" name="eliminar_producto" >Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                // Nos dice que no hay productos en el carrito
                echo "<tr><td colspan='4'>No hay productos en el carrito</td></tr>";
            }
            // Cerrar la conexión
            $conexion->close();
            ?>
            </tbody>
        </table>
        <form method="post" action="./vaciar_carrito.php">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <button class="btn btn-outline-danger" type="submit" name="vaciar_carrito" >Vaciar carrito</button>
        </form>
        <br>
        <form method="post" action="./pedido_exitoso.php">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <button type="submit" name="confirmar_compra" class="btn btn-success">Comprar productos</button>
            </form>
    </div>
</div>
</body>
</html>