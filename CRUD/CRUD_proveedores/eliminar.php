<?php

include("../includes/header4.php");

if(isset($_GET['id'])){
    try {
        $id = $_GET['id'];
        $query = "DELETE FROM proveedores WHERE provCodigo = $id";
        $result = mysqli_query($conn, $query);
        
        $_SESSION['message'] = "Proveedor eliminado correctamente";
        $_SESSION['message_type']  = 'danger';
        header ("location: index.php");
        exit();
    } catch (Exception $e) { ?>
        <div class="flex mx-6 my-6 border-2 rounded-md">
            <h1 class="me-2 font-bold text-slate-700 p-3">Error:</h1><?php echo $e->getMessage(), "\n"; ?>
        </div>
    <?php }
} ?>
