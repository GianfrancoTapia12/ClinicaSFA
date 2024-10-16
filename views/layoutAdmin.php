<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link href="/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Wrapper <link rel="stylesheet" href="/build/css/app.css">-->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Aquí puedes incluir el menú lateral con enlaces a secciones administrativas -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Clinica SFA</div>
            </a>
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Verificar si es admin -->
            <?php if (isset($_SESSION['admin'])) { ?>
                <!-- Sección Administrativa -->

                <!-- Nav Item - Ver Citas -->
                <li class="nav-item">
                    <a class="nav-link" href="/admin">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Ver Citas</span>
                    </a>
                </li>

                <!-- Nav Item - Ver Servicios -->
                <li class="nav-item">
                    <a class="nav-link" href="/servicios">
                        <i class="fas fa-concierge-bell"></i>
                        <span>Ver Servicios</span>
                    </a>
                </li>

                <!-- Nav Item - Nuevo Servicio -->
                <li class="nav-item">
                    <a class="nav-link" href="/servicios/crear">
                        <i class="fas fa-plus"></i>
                        <span>Nuevo Servicio</span>
                    </a>
                </li>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="/admin/dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">
            <?php } ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Aquí puedes incluir la barra superior con opciones de administración -->

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Barra superior -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Administrador -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <!-- Aquí se mostrará el nombre del administrador -->
                                    <?php echo $nombre ?? 'Administrador'; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="/sb-admin-2/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php echo $contenido; ?> <!-- Aquí se muestra el contenido dinámico de cada vista -->
                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Wrapper -->

    </div>

    <!-- Scripts de SB Admin 2 -->
    <script src="/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/sb-admin-2/js/sb-admin-2.min.js"></script>
</body>

</html>