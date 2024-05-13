<?php
// Iniciamos  sesión
session_start();

// Es la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "Proyecto_Final");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}else
//echo "<h1>Se conecto a la base</h1> ";

// Verificamos si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_SESSION['id_usuario'])&& isset($_POST['confirmar_compra'])) {
    // El usuario ha iniciado sesión, usamos $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuario'];

    // Obtenemos el ID del producto que se va a agregar al carrito
    $id_producto = $_POST['id_producto'];


          $sql_agregar = "INSERT INTO historial_de_compras(id_compra, usuario, producto_h) VALUES (NULL,'$id_usuario','$id_producto')";

          if ($conexion->query($sql_agregar) === TRUE) {
              echo "Producto eliminado al carrito exitosamente.";
              header("Location:  ../html/compra_exitosa.html");          
            } else {
              echo "Error al eliminar producto del carrito: " . $conexion->error;
          } 

          $sql_borrar = "DELETE FROM carrito_de_compras WHERE usuario='$id_usuario'";

          if ($conexion->query($sql_borrar) === TRUE) {
            echo "Producto eliminado al carrito exitosamente.";
            header("Location:   . ../html/compra_exitosa.htmll");          
          } else {
            echo "Error al eliminar producto del carrito: " . $conexion->error;
         } 

         // Consulta SQL para obtener la información del producto
                $sql_PROD = "SELECT * FROM Productos WHERE id_producto = $id_producto";

                // Ejecutamos la consulta
                $result = $conexion->query($sql_PROD);

                // Mostramos los detalles del producto
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $c_almacen=$row['cantidad_almacen'];
                } else {
                    echo "No se encontró el producto.";
                }
         $c_almacen=$c_almacen-1;
         $sql_alterar = "UPDATE Productos SET cantidad_almacen = '$c_almacen' WHERE Productos.id_producto = '$id_producto'";
          
          if ($conexion->query($sql_alterar) === TRUE) {
            echo "Producto alterado en almacen.";
            header("Location:   ../html/compra_exitosa.html");          
          } else {
            echo "Error al eliminar producto del almacen: " . $conexion->error;
        } 


} else {
    // Si el usuario no ha iniciado sesión, se redirige a la página de inicio o se muestra un mensaje de error
    header("Location: ../sesion_inicio.html");
    exit();
}

// Cerrar la conexión
$conexion->close();

?>