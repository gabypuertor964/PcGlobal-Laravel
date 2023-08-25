<?php include("../includes/header3.php");
    if(empty($_SESSION['username'])){
        header("location: ../login.php");
        die();
    }
    $q = "SELECT * FROM categorias";
    $r = mysqli_query($conn , $q);

    $q2 = "SELECT * FROM marcas";
    $r2 = mysqli_query($conn , $q2);
    
    if(isset($_POST['guardar'])){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $categ = $_POST["categ"];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $img = $_POST['img'];
        $marca = $_POST['marca'];
        $cant = $_POST['cant'];
    }
    $categ = $_POST["categ"];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $img = $_POST['img'];
    $marca = $_POST['marca'];
    $cant = $_POST['cant'];

    // Inicia la transacción
    mysqli_begin_transaction($conn);

    try {
        // Insertar datos en la tabla "articulos"
        $query_articulos = "INSERT INTO articulos (artNombre, artPrecio, artImagen, idMarca, idCategoria) VALUES ('$nombre', $precio, '$img', $marca, $categ)";
        $result_articulos = mysqli_query($conn, $query_articulos);

        if (!$result_articulos) {
            throw new Exception("Error en la consulta para insertar en la tabla 'articulos'");
        }

        // Obtener el ID del último registro insertado en la tabla "articulos"
        $articulo_id = mysqli_insert_id($conn);

        // Insertar datos en la tabla "stock" utilizando el ID del artículo
        $query_stock = "INSERT INTO stock (artCodigo, cantStock) VALUES ($articulo_id, $cant)";
        $result_stock = mysqli_query($conn, $query_stock);

        if (!$result_stock) {
            throw new Exception("Error en la consulta para insertar en la tabla 'stock'");
        }

        // Confirmar la transacción si todo se ha realizado correctamente
        mysqli_commit($conn);

        $_SESSION['message'] = 'Artículo agregado correctamente';
        $_SESSION['message_type'] = 'success';

        header("location: index.php");
        exit();
    } catch (Exception $e) {
        // Revertir la transacción si ocurre algún error
        mysqli_rollback($conn);

        die($e->getMessage());
    }
}
?>

<div class="container mx-auto my-5">
            <h1 class="mb-3 text-center text-2xl font-bold ">Agregar Artículo</h1>
            <div class="card">
                <div class="card-body">
                    <form class="grid grid-cols-1 sm:grid-cols-2 gap-x-6" action="agregar_producto.php" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="precio" class="form-control" placeholder="Precio" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="img" class="form-control" placeholder="Imágen" required>
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" name="categ" required>
                                <option selected value="">Selecciona una categoría</option>
                                <?php while ($fila = mysqli_fetch_array($r)) { ?>
                                    <option value="<?php echo $fila['idCategoria']; ?>"><?php echo $fila['nomCategoria']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                        <select class="form-select" name="marca" required>
                                <option selected value="">Selecciona una marca</option>
                                <?php while ($fila2 = mysqli_fetch_array($r2)) { ?>
                                    <option value="<?php echo $fila2['idMarca']; ?>"><?php echo $fila2['nomMarca']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="cant" class="form-control" placeholder="Cantidad" required>
                        </div>
                        <div class="flex justify-center col-span-0 sm:col-span-2">
                            <input type="submit" class="btn bg-emerald-500 hover:bg-emerald-600 w-full font-medium text-white text-center" name="guardar" value="Agregar">
                        </div>
                    </form>
                </div>
            </div>
</div>

<?php include("../includes/footer.php")?>