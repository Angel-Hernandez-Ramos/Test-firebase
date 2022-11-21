<?php
    require_once 'Model.php';
    session_start();
    
    if(isset($_GET['Session'])!=0){
        $Session = $_GET['Session'];
        //var_dump($Session);
        $SesionCompleta = consultaUsuarioId($Session);
        $_SESSION['data']=$SesionCompleta;
        $nombre = $_SESSION['data']['nombre'];
        //var_dump($_SESSION['data']['nombre']);
    }else{
        echo "Sesion no iniciada <br>";
        session_destroy();
    }
    //die();
?>
<html lang="EN">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        

        <!-- Sweet Alert -->
        <link href="assets/plugins/sweetalert2/sweetalert2.css" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>    
    <body>
        <div class="container">
            <div class="col-lg-12">
                <div class="container">
                    <h1>
                        <button class='btn btn-primary float-right' onclick="CerrarSesion()">
                            Cerrar Sesión
                        </button>
                    </h1>
                 </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="fa fa-home"></i></span>
                            <span class="d-none d-sm-block"><i class="fa fa-home"></i> Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="fa fa-user"></i></span>
                            <span class="d-none d-sm-block"><i class="fa fa-user"></i>Explorar Rutas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="message-tab" data-toggle="tab" href="#message" role="tab" aria-controls="message" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block"><i class="far fa-envelope"></i> Nueva Ruta</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="fa fa-cog"></i></span>
                            <span class="d-none d-sm-block"><i class="fa fa-cog"></i> Rutas Creadas</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content bg-light">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <!--Datos de quienes somos y a donde vamos-->
                        <h2>Bienvenido de vuelta: <?php echo "$nombre"; ?></h2>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <!--Rutas Registradas-->
                        <div class="container bg-success p-2 text-dark bg-opacity-10">
                            <h3>Verificar Rutas</h3>
                            <form method="POST" id="formulario-rutas" name="formulario-rutas">
                                <button type="submit" class="btn btn-primary">Verificar Rutas</button>
                            </form>
                            <div class="container">
                                <table id="datatableRutas" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Infomacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                        <!--Registrar Usuario-->
                        <div class="main container bg-success p-2 text-dark bg-opacity-10">
                            <form method="POST" id="formulario-rutaNueva" name="formulario-rutaNueva" autocomplete="off">
                                <h4>Registrar Nueva Ruta</h4>
                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                        <label for="IdUser">idUsuario:</label><br>
                                        <input type="text"  class="form-control" name="IdUser" id="IdUser" required value="<?php echo $Session; ?>">
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                        <label for="nombreRuta">Nombre:</label><br>
                                        <input type="text"  class="form-control" name="nombreRuta" id="nombreRuta"  required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                        <div class="form-group">
                                            <label for="DescripcionRutas">Descripción de la Ruta:</label>
                                            <textarea class="form-control" id="DescripcionRutas" name="DescripcionRutas" rows="3" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-2">
                                    <button type="submit" class="btn btn-primary">Añadir ruta</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                        <!--Inisiar Sesion-->
                        <!--<h4>Solo unos pasos más</h4> -->
                        <div class="main container bg-success p-2 text-dark bg-opacity-10">
                            <h4>Tus rutas</h4>
                            <div class="container">
                                <table id="datatableRutasUser" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Infomacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-3 col-md-6 m-t-30">

                <!--  Modal content for the above example -->
                <div class="modal fade bs-example-modal-lg" id="ModalEditarPunto" name="ModalEditarPunto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title m-0" id="myLargeModalLabel1">Puntos Registrados</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="container text-dark bg-opacity-10">
                                    <form method="POST" id="formulario-puntoEditar" name="formulario-puntoEditar" autocomplete="off">
                                        <div class="row mt-2">
                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                                <label for="puntoEditar">id punto:</label><br>
                                                <input type="text"  class="form-control" name="puntoEditar" id="puntoEditar" value="<?php echo $Session; ?>" required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <label for="puntoEditarNombre">Nombre:</label><br>
                                                <input type="text"  class="form-control" name="puntoEditarNombre" id="puntoEditarNombre"  required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <div class="form-group">
                                                    <label for="DescripcionpuntoEditar">Descripción del Punto:</label>
                                                    <textarea class="form-control" id="DescripcionpuntoEditar" name="DescripcionpuntoEditar" rows="3" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                            <button type="submit" class="btn btn-primary">Editar Punto</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
               
                <!--  Modal content for the above example -->
                <div class="modal fade bs-example-modal-lg" id="MyModal1" name="MyModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title m-0" id="myLargeModalLabel0">Puntos Registrados</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <table id="datatablePuntos" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!--  Modal Editar -->
                <div class="modal fade bs-example-modal-lg" id="MyModalEditar" name="MyModalEditar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title m-0" id="myLargeModalLabel2">Editar Ruta</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="	Editar-tab" data-toggle="tab" href="#Editar" role="tab" aria-controls="Editar" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="fa fa-pen"></i></span>
                                        <span class="d-none d-sm-block"><i class="fa fa-pen"></i> Editar</span>
                                        
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="AgregarPuntos-tab" data-toggle="tab" href="#AgregarPuntos" role="tab" aria-controls="AgregarPuntos" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fa fa-bars"></i></span>
                                        <span class="d-none d-sm-block"><i class="fa fa-bars"></i> Crear Nuevo Punto</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content bg-light">
                                <div class="tab-pane fade show active" id="Editar" role="tabpanel" aria-labelledby="Editar-tab">
                                    <!--Datos de quienes somos y a donde vamos-->
                                    <h2>Editar Ruta</h2>
                                    <div class="container bg-success p-2 text-dark bg-opacity-10">
                                    <form method="POST" id="formulario-rutaEditar" name="formulario-rutaEditar" autocomplete="off">
                                        <div class="row mt-2">
                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                                <label for="IdUserEditar">idUsuario:</label><br>
                                                <input type="text"  class="form-control" name="IdUserEditar" id="IdUserEditar" value="<?php echo $Session; ?>" required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                                <label for="IdRutaEditar">idRuta:</label><br>
                                                <input type="text"  class="form-control" name="IdRutaEditar" id="IdRutaEditar" required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <label for="nombreRuta">Nombre:</label><br>
                                                <input type="text"  class="form-control" name="nombreRutaEditar" id="nombreRutaEditar"  required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <div class="form-group">
                                                    <label for="DescripcionRutas">Descripción de la Ruta:</label>
                                                    <textarea class="form-control" id="DescripcionRutasEditar" name="DescripcionRutasEditar" rows="3" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                            <button type="submit" class="btn btn-primary">Editar ruta</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="container bg-success p-2 text-dark bg-opacity-10">
                                    <table id="datatablePuntosEditar" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                <div class="tab-pane fade" id="AgregarPuntos" role="tabpanel" aria-labelledby="profile-tab">
                                    <!--Rutas Registradas-->
                                    <div class="container bg-success p-2 text-dark bg-opacity-10">
                                        <h3>Añadir nuevo punto en la ruta</h3>
                                        <form method="POST" id="formulario-punto-nuevo" name="formulario-punto-nuevo">
                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                                <label for="IdUserPunto">idUsuario:</label><br>
                                                <input type="text"  class="form-control" name="IdUserPunto" id="IdUserPunto" value="<?php echo $Session; ?>" required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                                <label for="IdRutaPunto">idRuta:</label><br>
                                                <input type="text"  class="form-control" name="IdRutaPunto" id="IdRutaPunto" required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <label for="nombrePunto">Nombre del punto:</label><br>
                                                <input type="text"  class="form-control" name="nombrePunto" id="nombrePunto"  required>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <div class="form-group">
                                                    <label for="DescripcionPunto">Descripción del punto:</label>
                                                    <textarea class="form-control" id="DescripcionPunto" name="DescripcionPunto" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Añadir Punto</button>
                                        </form>
                                    </div>
                                </div>
                            </div>                                
                                
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                 <!--  Modal content for the above example -->
                 <div class="modal fade bs-example-modal-lg" id="MyModalComentariosRuta" name="MyModalComentariosRuta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title m-0" id="MyModalComentariosRutas">Comentarios de la Ruta</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="main container bg-success p-2 text-dark bg-opacity-10">
                                    <form method="POST" id="formularioComentarioRuta" name="formularioComentarioRuta" autocomplete="off">
                                        <h4>Nuevo Comentario</h4>
                                        <div class="row mt-2">
                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                                <label for="idRuta">idRuta:</label><br>
                                                <input type="text"  class="form-control" name="idRuta" id="idRuta" required value="<?php echo $Session; ?>">
                                            </div>
        
                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <div class="form-group">
                                                    <label for="ComentariodRuta">Danos tu opinion:</label>
                                                    <textarea class="form-control" id="ComentariodRuta" name="ComentariodRuta" rows="3" required></textarea>
                                                </div>
                                            </div>
        
                                            <div class="col-lg-12 mt-2">
                                            <button type="submit" class="btn btn-primary">Comentar</button>
                                            </div>
        
                                        </div>
                                    </form>
                                </div>

                                <div class="container">
                                    <table id="datatableComentariosRuta" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Comentarios</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!--  Modal content for the above example -->
                <div class="modal fade bs-example-modal-lg" id="MyModalComentariosPunto" name="MyModalComentariosPunto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title m-0" id="MyModalComentariosPuntos">Comentarios del Punto</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="main container bg-success p-2 text-dark bg-opacity-10">
                                    <form method="POST" id="formularioComentarioPunto" name="formularioComentarioPunto" autocomplete="off">
                                        <h4>Nuevo Comentario</h4>
                                        <div class="row mt-2">
                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10"  visibility: hidden>
                                                <label for="idPunto">idPunto:</label><br>
                                                <input type="text"  class="form-control" name="idPunto" id="idPunto" required value="<?php echo $Session; ?>">
                                            </div>
        
                                            <div class="col-lg-12 col-md-12 col-sm-12 m-t-10">
                                                <div class="form-group">
                                                    <label for="ComentarioPunto">Danos tu opinion:</label>
                                                    <textarea class="form-control" id="ComentarioPunto" name="ComentarioPunto" rows="3" required></textarea>
                                                </div>
                                            </div>
        
                                            <div class="col-lg-12 mt-2">
                                            <button type="submit" class="btn btn-primary">Comentar</button>
                                            </div>
        
                                        </div>
                                    </form>
                                </div>
                                <div class="container">
                                    <table id="datatableComentariosPunto" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Comentarios</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </div>
        
        
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/js/app.js"></script>
        
        <!--Muchas funciones con ajax-->
        <script type="text/javascript" src="GestionRutas.js"></script>

        <!-- Sweet-Alert  -->
        <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/pages/sweet-alert.init.js"></script>

        <!-- Required datatable js-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/pages/datatables-sample.init.js"></script>
        
        
    </body>
    <footer>

    </footer>
</html>
