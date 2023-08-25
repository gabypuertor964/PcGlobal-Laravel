<?php include("includes/header.php"); 

    if(empty($_SESSION['username'])){
        header("location: login.php");
        die();
    }
?>


    <div class="bg-gray-300 mx-12 my-16 rounded-md">
        <div class="p-3">
            <p class="font-medium">¡Hola, <?php echo $_SESSION['username'] ?>!</p>
            <p class="mt-2">Este es el apartado del CRUD de las distintas secciones del sistema.</p>
        </div>
    </div>

<?php include("includes/footer.php"); 
