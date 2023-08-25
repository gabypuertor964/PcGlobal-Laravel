<?php session_start(); 

    if(!empty($_SESSION['username'])){
        header("location:index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" href="../../logo-img/logo-panther.png">
    <title>Login - Admin</title>
</head>
<body>
    <nav class="h-20 text-center">
        <div class="brand"><img src="../logo-img/logo-panther.png"></div>
        <h1 class="text-white font-medium text-2xl -mt-10">Inicia Sesión</h1>
    </nav>
    <div>
    <?php if(isset($_SESSION['mensaje'])){?>
                <div class="mx-auto w-full sm:w-1/2 font-medium text-center alert alert-<?= $_SESSION['tipo_mensaje'];?> alert-dismissible fade show my-5" role="alert">
                   <i class="bi bi-exclamation-triangle"></i> <?= $_SESSION['mensaje'] ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times text-xl"></i></button>
                </div>
            <?php unset($_SESSION['mensaje']); } ?>        
    </div>
    <div class="flex mx-auto my-5 justify-center items-center">
            <form action="php/validar.php" class="flex flex-col mx-6 w-full sm:w-1/3" method="POST">
               <label class="font-medium">Usuario</label>
               <input class="border-2 rounded-md p-2" pattern="[A-Za-z0-9_-]{1,15}" required type="text" name="name">
               <label class="font-medium">Contraseña</label>
               <input class="border-2 rounded-md p-2" required type="password" name="password">
               <input class="submit mt-3 p-2 font-medium" type="submit" name="submit" value="Iniciar Sesión">
            </form>
    </div>
    <div class="text-center sm:mx-auto text-sm font-medium mx-6">
        <p>¿Olvidaste tu usuario o contraseña? Comunícate con nuestros gerentes para ofrecerte ayuda.</p>
    </div>
</body>
</html>