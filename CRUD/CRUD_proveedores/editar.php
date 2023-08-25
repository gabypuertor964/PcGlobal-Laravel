<?php include("../includes/header4.php")?>
    <?php
    if (empty($_SESSION['username'])){
        header("location: ../login.php");
        die();
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM proveedores WHERE provCodigo = $id";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $nombre = $row['nomProveedor'];
            $apellido = $row['apeProveedor'];
            $telefono = $row['numProveedor'];
        }
        if(isset($_POST['actualizar'])){

            $id = $_GET['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];

            $query = "UPDATE proveedores SET nomProveedor = '$nombre', apeProveedor = '$apellido', numProveedor = '$telefono' WHERE provCodigo = $id";

            $_SESSION['message'] = "Proveedor actualizado correctamente";
            $_SESSION['message_type']  = 'info';
            mysqli_query($conn, $query);
            header ("location: index.php");
            exit();
        }
    }
    ?>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h1 class="text-center mb-3 fw-bold  fs-4">Actualizar Proveedor</h1>
                <div class="card">
                    <div class="card-body">
                        <form action="editar.php?id=<?php echo $_GET['id']?>" method="POST">
                            <div class="my-3">
                                <label class="form-label fw-bold">Actualizar Nombre</label>
                                <input required class="form-control" placeholder="Actualizar Nombre" type="text" name="nombre" value="<?php echo $nombre; ?>">
                            </div>
                            <div class="my-3">
                                <label class="form-label fw-bold">Actualizar Apellido</label>
                                <input required class="form-control" placeholder="Actualizar Apellido" type="text" name="apellido" value="<?php echo $apellido; ?>">
                            </div>
                            <div class="my-3">
                                <label class="form-label fw-bold">Actualizar Telefono</label>
                                <input required class="form-control" placeholder="Actualizar Telefono" type="text" name="telefono" value="<?php echo $telefono; ?>">
                            </div>
                            <button class="btn btn-success" name="actualizar">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("../includes/footer.php")?>