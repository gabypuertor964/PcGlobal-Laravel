<?php

include("db.php");

$name = $conn->real_escape_string($_POST['name']);
$password = $conn->real_escape_string(md5($_POST['password']));

$sql = "SELECT * FROM usuarios WHERE usuNombre = '$name' and usuContrasena = '$password' ";
$result = mysqli_query($conn,$sql);


if(isset($_POST['submit'])){
    if(!empty($result) and mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $name;
        header("location: ../index.php");
    }else{
        $_SESSION['mensaje'] = "Contraseña o usuario incorrectos";
        $_SESSION['tipo_mensaje'] = "danger";
        header("location: ../login.php");
    }
}

?>