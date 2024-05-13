<?php
// Verificamos si se recibió el ID del producto 
if(isset($_POST['id_producto'])) {
    // Obtenemos el ID del producto 
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
    
    // Consulta SQL para obtener los datos del producto con el ID que se ingreso
    $sql = "SELECT * FROM Productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Muestra el formulario para editar los datos del producto
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../Prosuctos/css/styles.css" rel="stylesheet"/>
            <title>Cambiar Producto</title>
        </head>
        <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
    text-align: center;
}

form {
    margin-bottom: 20px;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
select {
    width: 70%; 
    padding: 8px; 
    margin-bottom: 10px; 
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"],
.btn-secondary {
    width: 50%; 
    padding: 8px; 
    background-color: #ff5555; 
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover,
.btn-secondary:hover {
    background-color: #ff3333; 
}

        </style>
        <body>
            <h2>Cambiar Producto</h2>
            <form action="actualizar.php" method="POST">
                 <label for="nombre">Id_producto seleccionado:</label>
                <input type="text" name="id_producto" value="<?php echo $id_producto; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>"><br>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $row['descripcion']; ?></textarea><br>
                <label for="fotos">Fotos:</label>
                <input type="text" id="fotos" name="fotos" value="<?php echo $row['fotos']; ?>"><br>
                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" value="<?php echo $row['precio']; ?>"><br>
                <label for="cantidad_almacen">Cantidad en Almacén:</label>
                <input type="text" id="cantidad_almacen" name="cantidad_almacen" value="<?php echo $row['cantidad_almacen']; ?>"><br>
                <label for="fabricante">Fabricante:</label>
                <input type="text" id="fabricante" name="fabricante" value="<?php echo $row['fabricante']; ?>"><br>
                <label for="origen">Origen:</label>
                <input type="text" id="origen" name="origen" value="<?php echo $row['origen']; ?>"><br>
                <button type="submit">Actualizar</button>
                <br><a href="../Admin/index_admin.php" class="btn btn-outline-dark">Regresar</a>

            </form>
        </body>
        </html>
        <?php
    } else {
        // Si no se encontró el producto con el ID que se dio, mostrar un mensaje de error
        echo "No se encontró ningún producto con el ID $id_producto.";
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibió el ID del producto, mostrar un mensaje de error
    echo "Error: No se proporcionó el ID del producto.";
}
?>