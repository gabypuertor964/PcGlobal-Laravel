<?php include("includes/header.php") ?>
    <?php
    $query = "SELECT COUNT(*) total FROM articulos WHERE idCategoria = 7";
    $result = mysqli_query($conn, $query); 
    $row = mysqli_fetch_assoc($result); 
    ?>
        <div class="flex mt-5 mb-4 justify-center font-bold text-lg sm:font-normal sm:text-3xl">
        <h1>Tarjetas Gráficas - <?php echo $row['total']?> Resultados <i class="ms-1 bi bi-search text-sm sm:text-xl"></i></h1>
        </div> 
    <div class="my-4 grid grid-cols-1 sm:grid-cols-3  xl:grid-cols-5 text-center mx-16 gap-3">
        <?php
            $query = "CALL PA_consulta_articulos_7();";
            $result = mysqli_query($conn, $query); 

            while ($row = mysqli_fetch_array($result)) { ?>
            <div class="card">
                <img src="<?php echo $row['Imagen']?>" class="card-img-top mt-3" alt="">
                <div class="card-body">
                    <p class="card-title text-lg font-medium border-t-2 border-slate-800 mb-2"><?php echo $row['Nombre']?> </p>
                    <p class="card-text font-normal mb-3">$<?php echo $row['Precio']?> COP</p>
                    <a href="case.php?id=<?php echo $row['id']?>" class="px-4 text-white rounded-md font-medium">Ver Especifíc.</a>
                </div>
            </div>
        <?php }?>
    </div>
    <footer>
        @ 2022<strong> PC Globlal</strong>Todos los Derechos Reservados
    </footer>
</body>
</html>