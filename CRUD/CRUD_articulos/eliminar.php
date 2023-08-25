<?php

include ("../includes/header3.php");

if(empty($_SESSION['username'])){
    header("location: ../login.php");
    die();
}

if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "UPDATE articulos INNER JOIN stock ON articulos.artCodigo = stock.artCodigo SET artEstado='Sin stock', cantStock = '0' WHERE articulos.artCodigo = $id";
        $result = mysqli_query($conn, $query);
        
        $_SESSION['message'] = "Estado del artículo actulizado correctamente";
        $_SESSION['message_type']  = 'danger';
        header ("location: index.php");
        exit();
} ?>

<?php include("../includes/footer.php");?>