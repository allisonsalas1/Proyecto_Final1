<?php
// Iniciamos sesión
session_start();

// Es la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Proyecto_Final");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
//echo "<h1>SE CONECTO</h1>";

// Verificamos si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_SESSION['id_usuario'])&& isset($_POST['agregar_al_carrito'])) {
    // El usuario inicio sesión, usamos $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuario'];

    // Obtenemos el ID del producto que se va a agregar al carrito
    $id_producto = $_POST['id_producto'];
    
         $sql = "INSERT INTO carrito_de_compras (id_carrito, usuario, producto_compra) VALUES (NULL, '$id_usuario', '$id_producto')";
  
          if ($conexion->query($sql) === TRUE) {
              echo "Producto agregado al carrito exitosamente.";
              header("Location: ../carrito_compras/carrito.php");          
            } else {
              echo "Error al agregar producto al carrito: " . $conexion->error;
          } 
} else {
    // El usuario no ha iniciado sesión, se redirige a la página de inicio o se muestra un mensaje de error
    header("Location: ../sesion_inicio.html");
    exit();
}

// Cerrar la conexión
$conexion->close();


?>