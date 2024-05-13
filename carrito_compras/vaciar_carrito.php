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
if(isset($_SESSION['id_usuario'])&& isset($_POST['vaciar_carrito'])) {
    // El usuario ha iniciado sesión, usamos $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuario'];

    // se elimica productos del carrito y queda vacio 


          $sql = "DELETE FROM carrito_de_compras WHERE usuario='$id_usuario'";
          

          if ($conexion->query($sql) === TRUE) {
              echo "Producto eliminado del carrito exitosamente.";
              header("Location: ../carrito_compras/carrito.php");          
            } else {
              echo "Error al eliminar producto del carrito: " . $conexion->error;
          } 
} else {
    // Si el usuario no ha iniciado sesión, se redirige a la página de inicio o muestra un mensaje de error
    header("Location: ../sesion_inicio.html");
    exit();
}

// Cerrar la conexión
$conexion->close();

?>