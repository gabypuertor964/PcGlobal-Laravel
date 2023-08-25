<?php include("../includes/header2.php")?>
<?php

if(empty($_SESSION['username'])){
    header("location: ../login.php");
    die();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM empleados WHERE idEmpleado = $id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $name = $row['nomEmpleado'];
        $lastname = $row['apeEmpleado'];
        $tipoDeDoc = $row['tipoDocEmp'];
        $numDoc = $row['numDocEmp'];
        $email = $row['empEmail'];
        $telefono = $row['empTelefono'];
    }
    if(isset($_POST['update'])){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tipoDoc = $_POST["tipoDoc"];
            if($tipoDoc == "CC"){
                $tipoDoc = "CC";
            }else{
                $tipoDoc = "CE";
            }
        }
        $id = $_GET['id'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $tipoDoc = $_POST['tipoDoc'];
        $numDoc = $_POST['numDoc'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];

        $query = "UPDATE empleados SET nomEmpleado = '$name', apeEmpleado = '$lastname', tipoDocEmp = '$tipoDoc', numDocEmp = '$numDoc', empEmail = '$email', empTelefono = '$tel' WHERE idEmpleado = $id";

        $_SESSION['message'] = "Empleado actualizado correctamente";
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
            <h1 class="text-center mb-3 fw-bold  fs-4">Actualizar Empleado</h1>
            <div class="card">
                <div class="card-body">
                    <form action="editar.php?id=<?php echo $_GET['id']?>" method="POST">
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Nombre</label>
                            <input required class="form-control" placeholder="Actualizar Nombre" type="text" name="name" value="<?php echo $name; ?>">
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Apellido</label>
                            <input required class="form-control" placeholder="Actualizar Apellido" type="text" name="lastname" value="<?php echo $lastname; ?>">
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Tipo de Documento</label>
                            <select class="form-select" name="tipoDoc" required>
                                <option selected value="">Selecciona un tipo de documento</option>
                                <option value="CC">CC</option>
                                <option value="CE">CE</option>
                            </select>
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Número de Documento</label>
                            <input required class="form-control" placeholder="Actualizar Número de Documento" type="text" name="numDoc" value="<?php echo $numDoc; ?>">
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Correo</label>
                            <input required class="form-control" placeholder="Actualizar Correo" type="text" name="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Teléfono</label>
                            <input required class="form-control" placeholder="Actualizar Teléfono" type="text" name="tel" value="<?php echo $telefono; ?>">
                        </div>
                        <button class="btn btn-success" name="update">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php")?>