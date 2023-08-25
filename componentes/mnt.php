<?php include("php/db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../css/style-3-2-1-1.css">
    <link rel="stylesheet" href="../../../css/normalize.css">
    <link rel="stylesheet" href="css/componentes2.css">
    <script src="js/app.js"></script>
    <script src="js/formulario.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="website icon" href="../logo-img/logo-panther.png">
    <title>Monitores</title>
    
</head>
<body>
    <div class="home-wrapper" >
        <header>
                        
                <nav class="container-fluid navbar navbar-expand-sm justify-content-between">
                    <ul class="navbar-nav">
                        <a href="../#home" class="fw-bold">HOME</a>
                        <a href="../#servicios" class="fw-bold">SERVICIOS</a>
                        <a href="../#portafolio" class="fw-bold">TIENDA</a>
                        <a href="../#contacto" class= "fw-bold">COMENTARIOS</a>                        
                    </ul>
                <div class="dropdown justify-content-between">
                    <button class="border-0 bg-transparent"><a href="../../../#home"><i class="bi bi-house fs-4 text-white ms-auto"></i></a></button>
                    <button class="border-0 bg-transparent" data-bs-toggle="dropdown"><i class="bi bi-list fs-2 text-white"></i></button>
                    <ol class="dropdown-menu">
                        <li class="dropdown-header">Menú</li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><a class="dropdown-item" href="../../../#servicios" class="fw-bold">SERVICIOS</a></li>
                        <li class="dropdown-item"><a class="dropdown-item" href="../../../#portafolio" class="fw-bold">TIENDA</a></li>
                        <li class="dropdown-item"><a class="dropdown-item" href="../../../#contacto" class="fw-bold">COMENTARIOS</a></li>
                    </ol>
                </div>
                    <div class="social me-3">
                        <a class="mx-auto" target="_blank" href="https://www.facebook.com/profile.php?  id=100087015408684"> <i class="bi bi-facebook"></i></i> </a>
                        <a class="mx-auto" target="_blank" href="https://www.twitter.com"> <i class="bi     bi-twitter"></i> </a>
                        <a class="mx-auto" target="_blank" href="https://www.instagram.com/pcglobal9/"> <i  class="bi bi-instagram"></i></a>
                        <div class="dropdown dpdn-2">
                            <a role="button" class="bg-transparent border-0 fs-5 border-white border-start border-1 ms-4 text-white" data-bs-toggle="dropdown" href="#"><i class="mx-4 bi bi-person-circle"></i></a>
                            <ol class="dropdown-menu dropdown-menu-end mx-2">
                                <li class="dropdown-header">Login & Register</li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a class="dropdown-item" href="Login-register/index.php" class="fw-bold">Iniciar Sesión</a></li>
                                <li class="dropdown-item"><a class="dropdown-item" href="../pagina_constr/index.php" class="fw-bold">Crear Cuenta</a></li>
                            </ol>
                        </div>
                    </div>
                </nav>
            
        </header>
    </div>

    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM articulos INNER JOIN marcas ON marcas.idMarca = articulos.idMarca INNER JOIN stock ON stock.artCodigo = articulos.artCodigo INNER JOIN categorias ON categorias.idCategoria = articulos.idCategoria WHERE articulos.artCodigo = $id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
        } ?>
    <div class="w-full grid grid-cols-1 mx-auto sm:grid-cols-2 inline-block flex flex-col flex-1 my-5 items-center">
            <div class="flex flex-col mx-auto text-center my-3 border-b-2 sm:border-r-2 sm:border-b-0 border-slate-900">
                <h1 class="mar"><?php echo $row['nomMarca'];?></h1>
                <p class="mt-2 mb-3 text-xl font-medium"><?php echo $row['artNombre']; ?></p>
                <img class="p-3 mx-auto rounded-lg" src="<?php echo $row['artImagen'] ?>" alt="">
            </div>
            <div class="flex flex-col justify-start mx-3">
                <div class="text-white mb-3 text-lg font-bold"><a class="p-2 rounded-md" href="Monitores.php"><i class="bi bi-arrow-left"></i> Volver</a></div>
                <div>
                    <h2><b>Cantidad:</b> <?php echo $row['cantStock']?> unidad(es)</h2>
                    <p><b>Tipo:</b> <?php echo $row['nomCategoria']?></p>
                </div>
                <p class="mt-8"><b>Especifícaciones:</b><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta saepe quia dolore ipsa dolores architecto blanditiis! Dolores, nam! Animi fugit fugiat corrupti dicta ex, vel ipsum! Labore laborum necessitatibus iusto eveniet fugiat molestiae reiciendis! Assumenda excepturi autem ipsa a repellat eius repudiandae nesciunt consequatur voluptas enim officiis voluptatem doloremque quaerat saepe dolores placeat in impedit voluptates, aliquam aperiam eaque modi debitis! Odio repellat, ipsam exercitationem nesciunt facilis facere nobis voluptatibus iure dolore praesentium. Iusto blanditiis voluptatibus eos, aperiam voluptates maxime facere ab ullam doloribus omnis fugit nobis reiciendis. Vero eum eligendi expedita dolore repellendus commodi quae? Iste est numquam neque.</p>
                <a href="#" class="mt-4 px-3 py-2 text-white rounded-md w-full text-center">Comprar</a>
                <a href="#" class="outline_ mt-4 px-3 py-2 rounded-md w-full text-center">Añadir al carrito <i class="bi bi-cart4"></i></a>
            </div>
    </div>
</body>
</html>
