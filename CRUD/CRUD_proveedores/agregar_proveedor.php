<?php include("../includes/header4.php")?>

<?php 
    if (empty($_SESSION['username'])){
        header("location: ../login.php");
        die();
    }
    if(isset($_POST['guardar'])){
 
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    
    $query = "INSERT INTO proveedores(nomProveedor, apeProveedor, numProveedor) VALUES ('$nombre', '$apellido', '$telefono')";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Proveedor agregado Correctamente';
    $_SESSION['message_type']  = 'success';

    header ("location: index.php");
    exit();
}?>

<div class="container mx-auto my-5">
            <h1 class="mb-3 text-center text-2xl font-bold">Agregar Proveedor</h1>
            <div class="card">
                <div class="card-body">
                    <form action="agregar_proveedor.php" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="apellido" class="form-control" placeholder="Apellidos" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="telefono" class="form-control" placeholder="Telefono" required>
                        </div>
                        <div class="flex justify-center">
                            <input type="submit" class="btn bg-emerald-500 hover:bg-emerald-600 w-1/4 text-white text-center" name="guardar" value="Agregar">
                        </div>
                    </form>
                </div>
            </div>
</div>

<?php include("../includes/footer.php")?>