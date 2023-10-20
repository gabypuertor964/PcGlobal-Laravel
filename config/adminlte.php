<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    /* Configuracion etiqueta <title></title> */

        # Titulo por defecto (Cuando no se especifique un titulo en una vista)
        'title' => 'PcGlobal',

        # Prefijo: Pcglobal + Title
        'title_prefix' => 'PcGlobal - ',

        # Sufijo: Title + PcGlobal
        'title_postfix' => '',
    //

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    /* Configuracion favicon */

        # Usar favicon individual: public/favicons/favicon.ico
        'use_ico_only' => true,

        # Usar favicon en diferentes resoluciones segun el dispositivo: public/favicons/*
        'use_full_favicon' => false,
    //

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    # Usar google fonts (Requiere conexion a internet)
        'google_fonts' => [
            'allowed' => true,
        ],
    //

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    /* Configuracion Logo Panel */

        # Texto acompañante al Logo (Estructura HTML)
        'logo' => '<b>PcGlobal</b>',

        # Icono Logotipo (Version Pequeña)
        'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',

        # Clases CSS para el Logo (Version Pequeña)
        'logo_img_class' => 'brand-image img-circle elevation-3',

        # Icono Logotipo (Version Grande)
        'logo_img_xl' => null,

        # Clases CSS para el Logo (Version Grande)
        'logo_img_xl_class' => 'brand-image-xs',

        # Texto alternativo en caso que no se muestre el Logo
        'logo_img_alt' => 'Logo PcGlobal',
    //

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    /* Icono Card Vistas de autenticacion */
        'auth_logo' => [
            'enabled' => false,
            'img' => [

                // Ruta de la imagen a mostrar
                'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',

                // Texto alternativo en caso que no se muestre la imagen
                'alt' => 'Auth Logo',

                // Clases CSS para la imagen
                'class' => '',

                // Alto (Height) y Ancho (Width) de la imagen (px)
                'width' => 50,
                'height' => 50,
            ],
        ],
    //

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    /* Animacion pre carga del Dashboard */
        'preloader' => [
            'enabled' => true,
            'img' => [

                // Ruta de la imagen a mostrar
                'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',

                // Texto alternativo en caso que no se muestre la imagen
                'alt' => 'Logo PcGlobal',

                // Animacion a realizar
                'effect' => 'animation__shake',

                // Alto (Height) y Ancho (Width) de la imagen (px)
                'width' => 60,
                'height' => 60,
            ],
        ],
    //

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    /* Configuraciones Menu del usuario */

        // Habilitar Menu del usuario (Boton)
        'usermenu_enabled' => false,

        // Activacion del encabezado del menu de navegacion
        'usermenu_header' => false,

        // Color de la cabecera del menu del usuario
        'usermenu_header_class' => 'bg-primary',

        // Habilitar la visualizacion de la imagen del usuario (Requiere metodo adminlte_image() en el modelo User)
        'usermenu_image' => false,

        // Habilitar la visualizacion de la descripcion del usuario (Requiere metodo adminlte_desc() en el modelo User)
        'usermenu_desc' => false,

        // Habilitar URL perfil del usuario (Requiere metodo adminlte_profile_url() en el modelo User)
        'usermenu_profile_url' => false,
    //

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    /* Configuraciones generales Layouts Admin */

        /*
            null/False -> Barra de navegacion lateral
            True -> Barra de Navegacion superior
        */
        'layout_topnav' => null,

        /*
            Null/False -> Contenido ocupa toda la pantalla
            True -> Contenido se muestra en forma de caja
        */
        'layout_boxed' => null,

        /*
            Null/False -> Elemento no fijo
            True -> Ejemplo es Fijo o siempre visible

            Nota:
                Sidebar: Barra de navegacion lateral
                Navbar: Barra de navegacion superior
                Footer: Pie de pagina
            --
        */
        'layout_fixed_sidebar' => true,
        'layout_fixed_navbar' => true,
        'layout_fixed_footer' => null,

        //Activar o desactivar modo oscuro en el Panel
        'layout_dark_mode' => false,
    //

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    /* Clases Formularios de Autenticacion */

        //Clases CSS Adicionadas a la estructura card de Bootstrap
        'classes_auth_card' => 'card-outline card-primary',

        //Clases CSS Adicionales Aplicadas al encabezado de la card de Bootstrap
        'classes_auth_header' => '',

        //Clases CSS Adicionales Aplicadas al cuerpo de la card de Bootstrap
        'classes_auth_body' => '',

        //Clases CSS Adicionales Aplicadas al pie de pagina de la card de Bootstrap
        'classes_auth_footer' => '',

        //Clases CSS Adicionales Aplicadas al icono de autenticacion de la card de Bootstrap
        'classes_auth_icon' => '',

        //Clases CSS Adicionales Aplicadas al boton submit del formulario de autenticacion de Bootstrap
        'classes_auth_btn' => 'btn-flat btn-primary',
    //

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    /* Clases Panel de Administracion */

        //Clases CSS Adicionales aplicadas a la etiqueta Body
        'classes_body' => '',

        //Clases CSS Adicionales aplicadas al area de la marca (Logo y Nombre)
        'classes_brand' => '',

        //Clases CSS Adicionales aplicadas al texto o nombre de la empresa
        'classes_brand_text' => '',

        //Clases CSS Adicionales aplicadas al contenedor del contenido principal
        'classes_content_wrapper' => '',

        //Clases CSS Adicionales aplicadas aL encabezado principal
        'classes_content_header' => '',

        //Clases CSS Adicionales aplicadas al contenido principal
        'classes_content' => '',

        //Clases CSS Adicionales aplicadas a la barra de lateral
        'classes_sidebar' => 'sidebar-light-primary elevation-4',

        //Clases CSS Adicionales aplicadas a la barra de busqueda del sidebar
        'classes_sidebar_nav' => '',

        //Clases CSS Adicionales aplicadas a la barra de navegacion de la cabecera
        'classes_topnav' => 'navbar-light navbar-light',

        //Clases CSS Adicionales aplicadas a la navegacion de la barra de navegacion superior
        'classes_topnav_nav' => 'navbar-expand',

        //Clases CSS Adicionales aplicadas al contenedor de la batrra de navegacion superior
        'classes_topnav_container' => 'container',
    //

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    # Barra de navegacion Principal

        /*
            Configurar modo de contraccion segun resolucion
        
            Modos:
                1. lg: Activar en resoluciones >=992
                2. md: Activar en resoluciones >=768
                3. xs: Siempre habilitado
                4. null: Desactivado
            --  
        */
        'sidebar_mini' => 'xs',

        # Activar/Desactivar el modo de contraccion automatico
        'sidebar_collapse' => true,

        # Activar/Desactivar Redimension automatica segun el contenido
        'sidebar_collapse_auto_size' => false,

        # Guardar el estado de la barra para la proxuma ejecucion
        'sidebar_collapse_remember' => true,

        # Activar/Desactivar transicion de contraccion cuando se establece el guardado de estado
        'sidebar_collapse_remember_no_transition' => false,

        # Establecer Tema barra lateral
        'sidebar_scrollbar_theme' => 'os-theme-white',

        # Establecer en que momento la barra lateral se oculatara (l: Automatico, s: Siempre visible)
        'sidebar_scrollbar_auto_hide' => 'l',

        # Activar/Desactivar navegacion en forma de acordeon (Solo un select activo a la vez)
        'sidebar_nav_accordion' => true,

        # Velocidad en milisegundo de la animacion de despliegue de los menus desplegables
        'sidebar_nav_animation_speed' => 300,
    //

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    /* 
        Barra Secundaria  

        Usos:
            1. Informacion contextual o detallado
            2. Acceso rapido a herramientas
            3. Widgets o miniaplicaciones
            4. Navegacion secundaria
            5. Personalizacion de la experiencia
        --
    */
        //Activacion barra de navegacion
        'right_sidebar' => false,

        //Icono de accesp
        'right_sidebar_icon' => 'fas fa-cogs',

        //Tema a usar: Dark o Light (Default)
        'right_sidebar_theme' => 'light',

        //Activar Efecto deslizante
        'right_sidebar_slide' => true,

        //Activar Adaptacion del contenido principal (Se mueve a la izquierda)
        'right_sidebar_push' => true,

        /* 
            Estilos de la Barra lateral:

            1. 'os-theme-dark': Este es el tema oscuro predeterminado para la barra de desplazamiento. Proporciona una apariencia oscura y se combina bien con temas oscuros en general.

            2. 'os-theme-light': Este tema ofrece una barra de desplazamiento de apariencia más clara, lo que puede ser adecuado si estás utilizando un tema claro en tu aplicación.

            3. 'os-theme-light-inverse': Similar al tema claro, pero con un aspecto invertido.

            4. 'os-theme-minimal-dark': Un tema minimalista de barra de desplazamiento con un diseño oscuro.

            5. 'os-theme-minimal-light': Un tema minimalista con un diseño claro.

            6. 'os-theme-thick-dark': Este tema proporciona barras de desplazamiento más anchas y se adapta a un aspecto más audaz y oscuro.

            7. 'os-theme-thin': Un tema minimalista con barras de desplazamiento más delgadas.

            8. 'os-theme-lw': Un tema ligero con barras de desplazamiento más estilizadas.
        */
        'right_sidebar_scrollbar_theme' => 'os-theme-dark',

        /*  
            Tipo de ocultamiento en estado de inactividad
            
            l: Automatico 
            s: Siempre visible 
        */
        'right_sidebar_scrollbar_auto_hide' => 'l',
    //

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    /* Definicion de Rutas */

        // Emplear el metodo url:False o el Metodo Route: True para la generacion de las rutas 
        'use_route_url' => true,

        // Nombre de Ruta/URL de redireccion al dashboard
        'dashboard_url' => 'redirect',

        // Nombre de Ruta/URL de cerrado de sesion
        'logout_url' => 'logout',

        // Nombre de Ruta/URL de acceso a la vista de login
        'login_url' => 'login',

        // Nombre de Ruta/URL de acceso a la vista de registro (Clientes)
        'register_url' => 'clientRegister',

        // Nombre de Ruta/URL de acceso a la vista "olvide mi contraseña"
        'password_reset_url' => 'password.request',

        /*
            Nombre de Ruta/URL de acceso a vista de retroalimentacion positiva tras el envio de un correo de recuperacion de contraseña 
            
            Ejemplo: 
                "Se ha enviado un correo electronico con las instrucciones para recuperar su contraseña"
            --

            Nota: En el caso de Fortify que no provee la infraestrucutra para una vista de retroalimentacion al usuario, el valor de 'password_email_url' es la ruta de cambio de contraseña como tal (Donde se solicita el token)
        */
        'password_email_url' => 'password.reset',

        'profile_url' => false,
    //

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    # Habilitar Laravel Mix (Requiere instalacion de paquete)

        //Habilitar Laravel Mix (Antecesor de Vite)
        'enabled_laravel_mix' => false,

        //Ruta de los archivos CSS y JS compilados por Laravel Mix
        'laravel_mix_css_path' => 'css/app.css',
        'laravel_mix_js_path' => 'js/app.js',
    //

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        
        /*
            [
            'text'    => 'Texto Principal',
            'can' => 'permiso',
            'icon'    => 'icono fontawesome',
            'submenu' => [
                [
                    'text' => 'Enlace',
                    'icon'    => 'icono fontawesome',
                    'url'  => 'url/relativa',
                ],
                [
                    'text'    => 'Enlace 2',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Enlace 3',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Enlace 4',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Enlace 5',
                                    'url'  => '#',
                                ]
                            ],
                        ],
                    ],
                ],
            ],         
        */

        /* Opciones Panel Cliente */

            //Modulo PQRS
            [
                'text'    => 'PQRS',
                'can' => 'cliente.read',
                'icon'    => 'nav-icon fas fa-flag',
                'submenu' => [
                    [
                        'text' => 'Mis Reportes',
                        'icon'    => 'nav-icon far fa-fw fa-clipboard',
                        'url'  => '/client/pqrs',
                    ],
                    [
                        'text' => 'Crear una PQRS',
                        'icon'    => 'nav-icon fa-fw fas fa-plus',
                        'url'  => '/client/pqrs/create',
                    ],
                    [
                        'text' => 'Respuestas',
                        'icon'    => 'nav-icon fa-fw fas fa-share',
                        'url'  => '/client/pqrs/responses',
                    ],
                ],
            ],

            //Modulo Facturacion
            [
                'text'    => 'Mis compras',
                'can' => 'cliente.read',
                'icon'    => 'nav-icon fas fa-shopping-bag',
                'submenu' => [
                    [
                        'text' => 'Compras Activas',
                        'icon'    => 'nav-icon fas fa-fw fa-tag',
                        'url'  => '/client/facturation/active',
                    ],
                    [
                        'text' => 'Historial de Compras',
                        'icon'    => 'nav-icon far fa-fw fa-clock',
                        'url'  => '/client/facturation',
                    ]
                ],
            ],

            //Modulo Entregas
            [
                'text'    => 'Mis entregas',
                'can' => 'cliente.read',
                'icon'    => 'nav-icon fas fa-truck',
                'submenu' => [
                    [
                        'text' => 'Entregas Activas',
                        'icon'    => 'nav-icon fas fa-fw fa-tag',
                        'url'  => '/client/delivery/active',
                    ],
                    [
                        'text' => 'Historial de Entregas',
                        'icon'    => 'nav-icon far fa-fw fa-clock',
                        'url'  => '/client/delivery',
                    ]
                ],
            ],
        //

        /* Opciones Panel Administrativo */

            //Modulo PQRS
            [
                'text'    => 'PQRS',
                'can' => 'pqrs.read',
                'icon'    => 'nav-icon fa-fw fas fa-flag',
                'submenu' => [
                    [
                        'text' => 'Historico',
                        'icon' => 'nav-icon far fa-fw fa-clock',
                        'url'  => '/admin/pqrs',
                    ],
                    [
                        'text' => 'Mis respuestas',
                        'icon'    => 'nav-icon fas fa-fw fa-share',
                        'can' => 'pqrs.create',
                        'url'  => '/admin/pqrs/responses',
                    ]
                ],
            ],

            //Modulo Facturacion
            [
                'text'    => 'Facturacion',
                'can' => 'facturation.read',
                'icon'    => 'nav-icon fa-fw fas fa-shopping-cart',
                'submenu' => [
                    [
                        'text' => 'Compras',
                        'icon'    => 'nav-icon fa-fw fas fa-shopping-basket',
                        'submenu' => [
                            [
                                'text' => 'Historico',
                                'icon'    => 'nav-icon far fa-fw fa-clock',
                                'url'  => '/admin/facturation/shopping/',
                            ],
                            [
                                'text' => 'Registrar Compra',
                                'icon' => 'nav-icon fa-fw fas fa-plus',
                                'url'  => '/admin/facturation/shopping/create',
                                'can' => 'facturation.create',
                            ],
                            [
                                'text' => 'Compras Activas',
                                'icon' => 'nav-icon fas fa-fw fa-tag',
                                'url'  => '/admin/facturation/shopping/active',
                            ],
                        ]
                    ],
                    [
                        'text' => 'Ventas',
                        'icon'    => 'nav-icon fa-fw fas fa-receipt',
                        'submenu' => [
                            [
                                'text' => 'Historico',
                                'icon'    => 'nav-icon far fa-fw fa-clock',
                                'url'  => '/admin/facturation/sales',
                            ],
                            [
                                'text' => 'Registrar Venta',
                                'icon' => 'nav-icon fa-fw fas fa-plus',
                                'url'  => '/admin/facturation/sales/create',
                                'can' => 'facturation.create',
                            ]
                        ]
                    ],
                ],
            ],

            //Modulo Inventario
            [
                'text'    => 'Inventario',
                'can' => 'inventory.read',
                'icon'    => 'nav-icon fa-fw fas fa-dolly-flatbed',
                'submenu' => [
                    [
                        'text' => 'Categorias',
                        'icon'    => 'nav-icon fa-fw far fa-copyright',
                        'submenu'=>[
                            [
                                'text' => 'Listado Categorias',
                                'icon'    => 'nav-icon fa-fw fas fa-list',
                                'url'  => '/admin/inventory',
                            ],                        [
                                'text' => 'Crear Categoria',
                                'icon'    => 'nav-icon fa-fw far fa-plus-square',
                                'url'  => '/admin/inventory/create',
                                'can' => 'inventory.create',
                            ]
                        ]
                    ],
                    [
                        'text' => 'Marcas',
                        'icon'    => 'nav-icon fa-fw far fa-registered',
                        'url'  => '',
                        'submenu'=>[ 
                            [
                                'text' => 'Listado Marcas',
                                'icon'    => 'nav-icon fa-fw fas fa-list',
                                'url'  => '/admin/inventory',
                            ],                        [
                                'text' => 'Crear Marca',
                                'icon'    => 'nav-icon fa-fw far fa-plus-square',
                                'url'  => '/admin/inventory/create',
                                'can' => 'facturation.create',
                            ]
                        ]
                    ],
                    [
                        'text' => 'Productos',
                        'icon'    => 'nav-icon fa-fw fas fa-laptop',
                        'url'  => '',
                        'submenu'=>[
                            [
                                'text' => 'Listado Productos',
                                'icon'    => 'nav-icon fa-fw fas fa-list',
                                'url'  => '/admin/inventory',
                            ],                        [
                                'text' => 'Crear Producto',
                                'icon'    => 'nav-icon fa-fw far fa-plus-square',
                                'url'  => '/admin/inventory/create',
                                'can' => 'facturation.create',
                            ]
                        ]
                    ]
                ],
            ],

            //Modulo Entregas
            [
                'text'    => 'Entregas',
                'can' => 'delivery.read',
                'icon'    => 'nav-icon fa-fw fas fa-truck',
                'submenu' => [
                    [
                        'text' => 'Historico',
                        'icon'    => 'nav-icon far fa-fw fa-clock',
                        'url'  => '/admin/delivery',
                    ],
                    [
                        'text' => 'Registrar Entrega',
                        'icon'    => 'nav-icon fa-fw fas fa-plus',
                        'url'  => '/admin/delivery/create',
                        'can' => 'delivery.create',
                    ],
                    [
                        'text' => 'Entregas Activas',
                        'icon'    => 'nav-icon fas fa-fw fa-tag',
                        'url'  => '/admin/delivery/active',
                    ],
                ]
            ],

            //Modulo Gerencia
            [
                'text'    => 'Gerencia',
                'can' => 'gerency.read',
                'icon'    => 'nav-icon fa-fw fas fa-chart-line',
                'submenu' => [
                    [
                        'text' => 'Trabajadores',
                        'icon'    => 'nav-icon fa-fw fas fa-users',
                        'url'  => '/admin/management/users',
                        'submenu' => [
                            [
                                'text' => 'Listado Trabajadores',
                                'icon'    => 'nav-icon fa-fw fas fa-list',
                                'url'  => '/admin/management/users',
                            ],
                            [
                                'text' => 'Registrar Trabajador',
                                'icon'    => 'nav-icon fa-fw far fa-plus-square',
                                'url'  => '/admin/management/users/create',
                            ]
                        ]
                    ]
                ],
            ],
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    # Plugins usados por el Panel
    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    #Configuracion Unico IFrame a usar
        'iframe' => [

            # Configuracion IFrame (n)
            'default_tab' => [

                //Url del contenido
                'url' => null,

                //Titulo del contenido
                'title' => null,
            ],
            'buttons' => [

                // Habilitar boton de cerrar el Iframe actual
                'close' => true,

                // Habilitar boton cerrar todos lo Ifames
                'close_all' => true,

                // Habilitar boton cerrar todos los Iframes excepto el actual
                'close_all_other' => true,

                // Habilitar boton para desplazarse hacia la izquierda si el contenido del Iframe es mas ancho que el Iframe
                'scroll_left' => true,

                // Habilitar boton para desplazarse hacia la derecha si el contenido del Iframe es mas ancho que el Iframe
                'scroll_right' => true,

                // Boton para habilitar el modo pantalla completa
                'fullscreen' => true,
            ],
            'options' => [

                //Tiempo en Milisegundos que se muestra una pantalla de carga al cargar el contenido del Iframe
                'loading_screen' => 1000,

                // Habilitar el mostrado automatico del Iframe al cargar
                'auto_show_new_tab' => true,

                // Representar el titulo del Iframe en la pestaña del navegador
                'use_navbar_items' => true,
            ],
        ],
    //

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    /* 
        Habilitar soporte Livewire (Requiere instalacion de paquete)

        Nota: Livewire es un framework de Laravel que permite crear componentes de interfaz de usuario (UI) dinamicos sin escribir codigo Javascript (Sitios de una sola pagina)
    */
        'livewire' => false,
    //
];
