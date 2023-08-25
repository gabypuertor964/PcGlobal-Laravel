<?php include("../db.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" href="../../logo-img/logo-panther.png">
    <link rel="stylesheet" href="../css/style.css">
    <title>CRUD</title>
        <nav class="flex h-20 text-white items-center">
            <div class="ms-9 flex gap-3">
                <a href="../index.php" class="hover:text-stone-300 font-bold text-lg">Inicio</a>
                <a href="index.php" class="hover:text-stone-300 font-bold text-lg">Empleados</a>
                <a href="../CRUD_articulos/index.php" class="hover:text-stone-300 font-bold text-lg">Artículos</a>
                <a href="../CRUD_proveedores/index.php" class="hover:text-stone-300 font-bold text-lg">Proveedores</a>
            </div>
            <div class="flex justify-end w-full gap-2 me-8">
                <i class="bi bi-person"></i>
                <p class="font-medium me-2"><?php echo $_SESSION['username']?></p>
                <a href="../php/cerrar_sesion.php" class="hover:text-stone-300"><i class="hover:text-stone-300 bi bi-door-open"></i></a>
            </div>
        </nav>
</head>
<body>