<?php

include("../includes/header2.php");  

if(empty($_SESSION['username'])){
    header("location: ../login.php");
    die();
}

if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "UPDATE empleados SET empEstado = 'Almacenado' WHERE idEmpleado = $id";
        $result = mysqli_query($conn, $query);
        
        $_SESSION['message'] = "Estado del empleado actualizado correctamente";
        $_SESSION['message_type']  = 'danger';
        header ("location: index.php");
        exit();
} ?>

<?php include("../includes/footer.php");?>