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
    <link rel="stylesheet" href="css/style-3-2-1-1.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/app.js"></script>
    <script src="js/formulario.js"></script>
    <link rel="website icon" href="logo-img/logo-panther.png">
    <title>PcGlobal</title>
</head>
<body>
    <div class="home-wrapper">
        <header>
            <div>                
                <nav class="container-fluid navbar navbar-expand-sm justify-content-between">
                    <ul class="navbar-nav">
                        <a href="#home" class="fw-bold princ">INICIO</a>
                        <a href="#servicios" class="fw-bold princ">SERVICIOS</a>
                        <a href="#portafolio" class="fw-bold princ">TIENDA</a>
                        <a href="#contacto" class= "fw-bold princ">COMENTARIOS</a>
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
                        <a class="mx-auto" target="_blank" href="https://www.twitter.com"><i class="bi bi-twitter"></i> </a>
                        <a class="mx-auto" target="_blank" href="https://www.instagram.com/pcglobal9/"> <i  class="bi bi-instagram"></i></a>
                        <div class="dropdown dpdn-2">
                            <a role="button" class="bg-transparent border-0 fs-5 border-white border-start border-1 ms-4 text-white" data-bs-toggle="dropdown" href="#"><i class="mx-4 bi bi-person-circle"></i></a>
                            <ol class="dropdown-menu dropdown-menu-end mx-2">
                                <li class="dropdown-header">Login & Register</li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a class="dropdown-item" href="Login-register/index.php" class="fw-bold">Iniciar Sesión</a></li>
                                <li class="dropdown-item"><a class="dropdown-item" href="pagina_constr/index.php" class="fw-bold">Crear Cuenta</a></li>
                            </ol>
                        </div>
                    </div>
                </nav>
            </div> 
        </header>
    </div>
        <section id="home">
            <div id="intro" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button data-bs-target="#intro" data-bs-slide-to="0" class="active"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="1"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="2"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="3"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="4"></button>
                </div>

                <div class="carousel-inner d-flex align-content-md-centers">
                    <div class="carousel-item active">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-1.jpg" height="557" class="d-block w-100">
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-2.jpg" height="557" class="d-block w-100">
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-3.jpg" height="557" class="d-block w-100">
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-4.jpg" height="557" class="d-block w-100">
                    </div>
                    
                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-5.jpg" height="557" class="d-block w-100">
                    </div>
                </div>

                <button class="carousel-control-prev" data-bs-target="#intro" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" data-bs-target="#intro" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div> 
        </section>
    </div> 

    <section id="servicios">
        <div class="container mb-3">
            <h2 class="fw-bold">SERVICIOS</h2>
            <div class="row align-items-center g-0">
                <div class="col-sm-4 mx-auto card text-center mb-4" style="width: 290px;">
                    <img class="card-img" src="images/Dweb.jpg" alt="Web Design" height="165px" width="290px">
                    <div class="card-body">
                        <h5 class="card-text">Mantenimiento</h5>
                        <p class="card-text">Somos expertos en mantenimiento. Nuestro equipo es por mucho el mejor. Hacemos el mejor mantenimiento y al mejor precio.</p>
                        <a href="componentes/mantenimiento/Mantenimiento.php" class="btn btn-outline-primary">Más detalles</a>
                    </div>
                </div>

                <div class="col-sm-4 mx-auto card text-center mb-4" style="width: 290px;">
                    <img class="card-img" src="images/Assembly.jpg" alt="Web Design" height="165px" width="290px">
                    <div class="card-body">
                        <h5 class="card-text">Ensamblaje</h5>
                        <p class="card-text">Somos expertos en el ensablaje de las computadoras, con garantía de 2 años de cada pieza, (Incluye instalación del Sistema Operativo)</p>
                        <a href="componentes/Ensamblaje/Ensamblaje.php" class="btn btn-outline-primary">Más detalles</a>
                    </div>
                </div>

                <div class="col-sm-4 mx-auto card text-center" style="width: 290px;">
                    <img class="card-img" src="images/overclock.jpg" alt="Web Design" height="165px" width="290px">
                    <div class="card-body">
                        <h5 class="card-text">Overclokcing Seguro</h5>
                        <p class="card-text">Somos expertos en el Overclokcing Seguro. Subimos las frecuencias de sus componentes (De manera segura), para así ganar más velocidad y establidad en su PC.</p>
                        <a href="componentes/Overclokcing Seguro/Overclokcing Seguro.php" class="btn btn-outline-primary">Más detalles</a>
                    </div>
                </div>

            </div>    
        </div>
    </section>
    <section class="border-top border-2 border-dark" id="portafolio">
        <div class="container">
            <div class="d-flex align-items-around flex-wrap text-center">
                <div class="container fw-bold">
                    <h2 class="fw-bold my-3">TIENDA</h2>
                </div>

                <div class="col box">
                    <a href="componentes/Tarjetas Graficas.php"><img src="images/Portafolio/Tarjeta Gráfica.jpg" alt="Iconos Redondos" height="240px" width="360px"></a>
                    <h3>
                        <a class="fs-4 my-5" href="componentes/Tarjetas Graficas.php" class="mt-4">Tarjetas Gráficas</a>
                    </h3>
                </div>

                <div class="col box">
                    <a href="componentes/Procesadores.php"><img src="images/Portafolio/procesador.jpg" alt="Iconos Redondos"  height="240px" width="360px"></a>
                    <h3> 
                     <a class="fs-4" href="componentes/Procesadores.php">Procesadores</a>
                    </h3>
                </div>

                <div class="col box">
                    <a href="componentes/Almacenamiento.php"><img src="images/Portafolio/Almacenamiento.jpg" alt="Iconos Redondos"  height="240px"   width="360px"></a>
                    <h3><a class="fs-4" href="componentes/Almacenamiento.php">Almacenamiento</a></h3>      
                </div>

                <div class="col box">
                    <a href="componentes/Ram.php"><img src="images/Portafolio/Ram.png" alt="Iconos Redondos"  height="240pxpx" width="360px"></a>
                    <h3><a class="fs-4" href="componentes/Ram.php">Ram</a></h3>         
                </div>

                <div class="col box">
                    <a href="componentes/Monitores.php"><img src="images/Portafolio/Monitores.jpg" alt="Iconos Redondos"  height="240pxpx" width="360px"></a>
                    <h3><a class="fs-4" href="componentes/Monitores.php">Monitores</a></h3>          
                </div>

                <div class="col box">
                    <a href="componentes/Tarjeta Madre.php"><img src="images/Portafolio/mother-board.jpg" alt="Iconos Redondos" height="240pxpx" width="360px"></a>
                    <h3><a class="fs-4" href="componentes/Tarjeta Madre.php">Tarjetas Madre</a></h3>          
                </div>
                <div class="col box">
                    <a href="componentes/Cases.php"><img src="images/Portafolio/cases.jpg" alt="Iconos Redondos" height="240px" width="360px"></a>
                    <h3><a class="fs-4" href="componentes/Cases.php">Cases</a></h3>          
                </div>
                <div class="col box">
                    <a href="componentes/Perifericos.php"><img src="images/Portafolio/Perifericos.jpg" alt="Iconos Redondos" height="240px" width="360px"></a>
                    <h3><a class="fs-4" href="componentes/Perifericos.php">Periféricos</a></h3>          
                </div>
                <div class="col box">
                    <a href="componentes/Fuentes de poder.php"><img src="images/Portafolio/Fuente de poder.jpg" alt="Iconos Redondos" height="240pxpx" width="360px"></a>
                    <h3><a class="fs-4" href="componentes/Fuentes de poder.php">Fuentes de poder</a></h3>          
                </div>
        </div>
    </div>

    
    <section id="contacto">
        <div class="my-5">
        <h2 class="fw-bold my-4">COMENTARIOS</h2>
            <p class="text-center">¿Quieres dejarnos un comentario? <br> Ya sea, una petición, queja,   sugerencia, reclamo, o incluso unas felicitaciones. Háznoslo saber.</p>
            <form action="https://formsubmit.co/pgloc77@gmail.com" method="POST" class="formulario">
                <!-- Grupo: Nombre Completo -->
                <div class="formulario__grupo">
                    <input type="hidden" name="_captcha" value="false">
                    <input type="hidden" name="_next" value="http://localhost:3000/index.php">
                    <input type="hidden" name="_subject" value="¡Nuevo Mensaje!">
                    <label for="nombre" class="formulario__label">Nombre</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="name"  placeholder="Nombre" required>
                        <i class="formulario__validacion-estado bi bi-x-circle-fill"></i>
                    </div>
                    <p class="formulario__input-error">El nombre solo puede contener letras, minúsuculas,   mayúsculas y acentos.</p>
                </div>

                <!-- Grupo: Correo -->
                <div class="formulario__grupo">
                    <label for="correo" class="formulario__label">Correo Electrónico</label>
                    <div class="formulario__grupo-input">
                        <input type="email" class="formulario__input" name="email"     placeholder="correo@correo.com" required>
                        <i class="formulario__validacion-estado bi bi-x-circle-fill"></i>
                    </div>
                    <p class="formulario__input-error">El correo solo puede contener letras, números, puntos,guiones y guión bajo.</p>
                </div>

                <!-- Grupo: Motivo -->
                <div class="formulario__grupo">
                    <label for="motivo" class="formulario__label">Mensaje</label>
                    <div class="formulario__grupo-textarea">
                        <textarea class="formulario__textarea" name="mensaje" required></textarea>
                        <i class="formulario__validacion-estado bi bi-x-circle-fill"></i>
                    </div>
                    <p class="formulario__input-error">El mensaje debe tener un contenido mínimo de 20 palabras.    </p>
                </div>

                <!-- Grupo: Términos y Condiciones -->
                <div class="formulario__grupo-terminos">
                <input class="rounded" type="checkbox" name="aceptar" required> Acepto los <a class="text-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">términos y condiciones.</a>
                </div>

                <div class="formulario__mensaje">
                    <p><i class="bi bi-exclamation-triangle-fill"></i> <b>Error:</b> Por favor rellene el formulario correctamente.</p>
                </div>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button type="submit" class="formulario__btn">Enviar</button>
                    <p class="formulario__mensaje-exito">
                        ¡Formulario obtenido exitosamente!
                    </p>
                </div>
            </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4  fw-bold" id="exampleModalLabel">Terminos y condiciones</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
        <h1 class="fs-6 fw-bold">Propietario de la página web, la oferta y el enlace de los Términos.</h1>

        Esta página web es propiedad y está operado por . Estos Términos establecen los términos y condiciones bajo los cuales tu puedes usar nuestra página web y servicios ofrecidos por nosotros. Esta página web ofrece a los visitantes compra de computadores y componentes entre ell (tarjetas ram,tarjetas madre,procesadores etc). Al acceder o usar la página web de nuestro servicio, usted aprueba que haya leído, entendido y aceptado estar sujeto a estos Términos
        
        <h1 class="fs-6 fw-bold">Cuáles son los requisitos para crear una cuenta.</h1>
        
        Para usar nuestro página web y / o recibir nuestros servicios, debe ser mayor de edad y poseer la autoridad legal, el derecho y la libertad para participar en estos Términos como un acuerdo vinculante. No tienes permitido utilizar esta página web y / o recibir servicios si hacerlo está prohibido en tu país o en virtud de cualquier ley o regulación aplicable a tu caso.
        
        <h1 class="fs-6 fw-bold">Términos comerciales ofrecidos a los clientes.</h1>
        
        Al comprar un artículo, aceptas que: (I) eres responsable de leer el listado completo del artículo antes de comprometerte a comprarlo: (II) celebras un contrato legalmente vinculante para comprar un artículo cuando te comprometed a comprar un artículo y completar el proceso de check-out.
        
         Los precios que cobramos por usar nuestros servicios / para nuestros productos se enumeran en la página web. Nos reservamos el derecho de cambiar nuestros precios para los productos que se muestran en cualquier momento y de corregir los errores de precios que pueden ocurrir inadvertidamente. Información adicional sobre precios e impuestos sobre las ventas está disponible en la página de pagos. 
        
        "La tarifa por los servicios y cualquier otro cargo que pueda incurrir en relación con tu uso del servicio, como los impuestos y las posibles tarifas de transacción, se cobrarán mensualmente a tu método de pago.
        
        <h1 class="fs-6 fw-bold">politica de reembolso.</h1>
        
        Solo reemplazamos los artículos si están defectuosos o dañados. Si necesitas cambiarlo por el mismo artículo, envíanos un email a (Agrega dirección de correo electrónico relevante) y envía tu artículo a: (Dirección relevante).
        
        <h1 class="fs-6 fw-bold">Posesión de propiedad intelectual, derechos de autor y logos.</h1>
        
        El Servicio y todos los materiales incluidos o transferidos, incluyendo, sin limitación, software, imágenes, texto, gráficos, logotipos, patentes, marcas registradas, marcas de servicio, derechos de autor, fotografías, audio, videos, música y todos los Derechos de Propiedad Intelectual relacionados con ellos, son la propiedad exclusiva de [Nombre del propietario de la página web]. Salvo que se indique explícitamente en este documento, no se considerará que nada en estos Términos crea una licencia en o bajo ninguno de dichos Derechos de Propiedad Intelectual, y tu aceptas no vender, licenciar, alquilar, modificar, distribuir, copiar, reproducir, transmitir, exhibir públicamente, realizar públicamente, publicar, adaptar, editar o crear trabajos derivados de los mismos. 
        
        <h1 class="fs-6 fw-bold">Limitación de responsabilidad.</h1>
        
        En la máxima medida permitida por la ley aplicable, en ningún caso el [propietario de la página web] será responsable por daños indirectos, punitivos, incidentales, especiales, consecuentes o ejemplares, incluidos, entre otros, daños por pérdida de beneficios, buena voluntad, uso, datos. u otras pérdidas intangibles, que surjan de o estén relacionadas con el uso o la imposibilidad de utilizar el servicio. 
        
        En la máxima medida permitida por la ley aplicable, [el propietario la página web] no asume responsabilidad alguna por (I) errores, errores o inexactitudes de contenido; (II) lesiones personales o daños a la propiedad, de cualquier naturaleza que sean, como resultado de tu acceso o uso de nuestro servicio; y (III) cualquier acceso no autorizado o uso de nuestros servidores seguros y / o toda la información personal almacenada en los mismos.
        Derecho a cambiar y modificar los Términos.
        
        <h1 class="fs-6 fw-bold">Emails de promociones y contenido.</h1>
        
        Acepta recibir de vez en cuando nuestros mensajes y materiales de promoción, por correo postal, correo electrónico o cualquier otro formulario de contacto que nos proporciones (incluido tu número de teléfono para llamadas o mensajes de texto). Si no deseas recibir dichos materiales o avisos de promociones, simplemente avísanos en cualquier momento.
        
        <h1 class="fs-6 fw-bold">Preferencia de ley y resolución de disputas.</h1>
        
        Estos Términos, los derechos y recursos provistos aquí, y todos y cada uno de los reclamos y disputas relacionados con este y / o los servicios, se regirán, interpretarán y aplicarán en todos los aspectos única y exclusivamente de conformidad con las leyes sustantivas internas de [ Nombre del país / estado], sin respeto a sus principios de conflicto de leyes. Todos los reclamos y disputas se presentarán y usted acepta que sean decididos exclusivamente por un tribunal de jurisdicción competente ubicada en [Nombre de la ciudad de los tribunales]. La aplicación de la Convención de Contratos de las Naciones Unidas para la Venta Internacional de Bienes queda expresamente excluida.
        
        <h1 class="fs-6 fw-bold">Atención al cliente e información de contacto.</h1>
        
        Se espera que los términos tengan información de contacto que permita a los usuarios y clientes recibir servicios de atención al cliente y corresponder con las páginas web y sus operadores.
        
        <h1 class="fs-6 fw-bold">Disposiciones recomendadas para sitios web con comunidades de usuarios.</h1>
        
        Si tu página web incluye una comunidad de usuarios, recomendamos que los Términos de la página aclaren que todos los usuarios que se unen a una comunidad tienen un perfil público visible para los visitantes de la página y que su actividad pública (como sus publicaciones o comentarios) será visible a otros visitantes del sitio web.
      </p>
      </div>
    </div>
  </div>
</div>
    </section>
    <iframe class="mt-4" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1988.2989721749705!2d-74.05879632918939!3d4.665551278628364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sunilago!5e0!3m2!1ses!2sco!4v1677883140666!5m2!1ses!2sco" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <footer style="background-color:whitesmoke;">
    @ 2022  <strong> PC Globlal </strong>Todos los Derechos Reservados
    </footer>
</body>
</html>