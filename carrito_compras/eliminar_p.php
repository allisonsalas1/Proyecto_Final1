<?php
// Iniciamos sesión
session_start();

// Es la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Proyecto_Final");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}else
//echo "<h1>Se conecto a la base</h1> ";

// Verificamos si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_SESSION['id_usuario'])&& isset($_POST['eliminar_producto'])) {
    // El usuario ha iniciado sesión, usamos $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuario'];

    // Obtenemos el ID del producto que se va a eliminar del carrito
    $id_producto = $_POST['id_producto'];



          $sql = "DELETE FROM carrito_de_compras WHERE producto_compra='$id_producto'";

          if ($conexion->query($sql) === TRUE) {
              echo "Producto eliminado al carrito exitosamente.";
              header("Location: ../carrito_compras/carrito.php");          
            } else {
              echo "Error al eliminar producto del carrito: " . $conexion->error;
          } 
} else {
    // Si el usuario no ha iniciado sesión, lo redirigimos a la página de inicio o se muestra un mensaje de error
    header("Location: ../sesion_inicio.html");
    exit();
}

// Cerrar la conexión
$conexion->close();

?>