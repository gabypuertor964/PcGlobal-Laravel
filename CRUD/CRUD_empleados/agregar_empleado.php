<?php include("../includes/header2.php");
    if(empty($_SESSION['username'])){
        header("location: ../login.php");
        die();
    }
?>


<?php 
    if(isset($_POST['guardar'])){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $tipoDoc = $_POST["tipoDoc"];
        if($tipoDoc == "CC"){
            $tipoDoc = "CC";
        }else{
            $tipoDoc = "CE";
        }
        $rol = $_POST["rol"];
        if ($rol == "1") {
            $rol = 1;
        } elseif ($rol == "2") {
            $rol = 2;
        }
    }
    
    $rol = $_POST['rol']; 
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipoDoc = $_POST['tipoDoc'];
    $numDoc = $_POST['numDoc'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $query = "INSERT INTO empleados(idRol, nomEmpleado, apeEmpleado, tipoDocEmp, numDocEmp, empEmail, empTelefono) VALUES ('$rol', '$nombre', '$apellido', '$tipoDoc', '$numDoc', '$email', '$tel')";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Empleado Agregado Correctamente';
    $_SESSION['message_type']  = 'success';

    header ("location: index.php");
    exit();
}?>

<div class="container mx-auto my-5">
            <h1 class="mb-3 text-center text-2xl font-bold">Agregar Empleado</h1>
            <div class="card">
                <div class="card-body">
                    <form action="agregar_empleado.php" method="POST">
                        <div class="input-group mb-3">
                            <select class="form-select" name="rol" required>
                                <option selected value="">Selecciona un rol</option>
                                <option value="1">Asesor Comercial</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="apellido" class="form-control" placeholder="Apellidos" required>
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" name="tipoDoc" required>
                                <option selected value="">Selecciona un tipo de documento</option>
                                <option value="CC">CC</option>
                                <option value="CE">CE</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="numDoc" class="form-control" placeholder="Número de Documento" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Correo" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="tel" class="form-control" placeholder="Teléfono" required>
                        </div>
                        <div class="flex justify-center">
                            <input type="submit" class="btn bg-emerald-500 hover:bg-emerald-600 w-1/4 text-white text-center" name="guardar" value="Agregar">
                        </div>
                    </form>
                </div>
            </div>
</div>

<?php include("../includes/footer.php")?>