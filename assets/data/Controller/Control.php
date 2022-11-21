<?php
	require_once '../Model/Model.php';
    //require_once '../../Model/controlescolar/materiasModel.php';
    //$matsM = new Materias();
    /*if(!isset($_SESSION['usuario'])){
        $_POST['action'] = 'no_session';
    }*/
    
    switch($_POST['action']){
        case 'ImprmirRutas':
            unset($_POST['action']);
            $Rutas = consultaRutas();
            echo json_encode($Rutas);
            break;

        case 'RegistrarUsuario':
            $nombre = $_POST['nombre'];
            $Apellidop = $_POST['Apellidop'];
            $Apellidom = $_POST['Apellidom'];
            $num = $_POST['Numero'];
            $Usuario = $_POST['User'];
            $Pass = $_POST['Password'];

            unset($_POST['action']);
            unset($_POST['nombre']);
            unset($_POST['Apellidop']);
            unset($_POST['Apellidom']);
            unset($_POST['Numero']);
            unset($_POST['User']);
            unset($_POST['Password']);

            $Usuario = InsertaUsuario($nombre,$Apellidop,$Apellidom,$num,$Usuario,$Pass);
            echo json_encode($Usuario);
            break;

        case 'InicioSesion':
            unset($_POST['action']);
            $Usuario = $_POST['usuario'];
            $Pass = $_POST['password'];
            $Login =InicioSesion($Usuario,$Pass);
            echo json_encode($Login);
            break;
        
        case 'consultaPuntos':
            unset($_POST['action']);
            $idRuta = $_POST['idR'];
            unset($_POST['idR']);
            $Puntos = consultaPuntos($idRuta);
            echo json_encode($Puntos);
            break;

        case 'InsertaNuevaRuta':
            unset($_POST['action']);
            $idUser = $_POST['IdUser'];
            $nombreRuta = $_POST['nombreRuta'];
            $DescripcionRuta = $_POST['DescripcionRutas'];
            unset($_POST['IdUser']);
            unset($_POST['nombreRuta']);
            unset($_POST['DescripcionRutas']);
            $RutaNueva = InsertaNuevaRuta($idUser,$nombreRuta,$DescripcionRuta);
            echo json_encode($RutaNueva);
            break;

        case 'consultaRutasUsuario':
            unset($_POST['action']);
            $idUser = $_POST['idUsuario'];
            unset($_POST['idUsuario']);
            $RutasUsuario = consultaRutasUsuario($idUser);
            echo json_encode($RutasUsuario);
            break;
        
        case 'ActualizarRuta':
            unset($_POST['action']);
            //Le cambiamos para que aplique en el form
            $idRuta = $_POST['IdRutaEditar'];
            $nombreRuta = $_POST['nombreRutaEditar'];
            $DescripcionRuta = $_POST['DescripcionRutasEditar'];
            unset($_POST['IdUserEditar']);
            unset($_POST['nombreRutaEditar']);
            unset($_POST['DescripcionRutasEditar']);
            $RutaActualizada = ActualizarRuta($idRuta,$nombreRuta,$DescripcionRuta);
            echo json_encode($RutaActualizada);
            break;
        
        case 'InsertaPunto':
            $idRuta = $_POST['IdRutaPunto'];
            $nombrePunto = $_POST['nombrePunto'];
            $DescripcionPunto = $_POST['DescripcionPunto'];
            unset($_POST['IdRutaPunto']);
            unset($_POST['nombrePunto']);
            unset($_POST['DescripcionPunto']);
            $PuntoNuevo = InsertaPunto($idRuta,$nombrePunto,$DescripcionPunto);
            echo json_encode($PuntoNuevo);
            break;

        case 'EliminarRuta':
            unset($_POST['action']);

            $PuntosRuta = $_POST['idR'];
            EliminarPuntos($PuntosRuta);

            $RutaEl = $_POST['idR'];
            unset($_POST['idR']);
            $Rutas = EliminarRuta($RutaEl);
            echo json_encode($Rutas);
            break;

        case 'EliminarPunto':
            unset($_POST['action']);
            $PuntoEl = $_POST['idP'];
            unset($_POST['idP']);
            $PuntoElim = EliminarPunto($PuntoEl);
            echo json_encode($PuntoElim);
            break;
        
        case 'ConsultaInfoPunto':
            unset($_POST['action']);
            $PuntoCon = $_POST['idP'];
            unset($_POST['idP']);
            $PuntoRespuesta = ConsultaInfoPunto($PuntoCon);
            echo json_encode($PuntoRespuesta);
            break;

        case 'ActualizarPunto':
            unset($_POST['action']);
            $PuntoAct = $_POST['puntoEditar'];
            $PuntoNombre = $_POST['puntoEditarNombre'];
            $PuntoDescripcion = $_POST['DescripcionpuntoEditar'];

            unset($_POST['puntoEditar']);
            $PuntoRespuesta = ActualizarPunto($PuntoAct,$PuntoNombre,$PuntoDescripcion);
            echo json_encode($PuntoRespuesta);
            break;

        case 'Comentarios':
            unset($_POST['action']);
            $RutaComen = $_POST['idR'];
            unset($_POST['idR']);
            $RutaRespuestaCom = Comentarios($RutaComen,1);
            echo json_encode($RutaRespuestaCom);
            break;
        
        case 'ComentariosPunto':
            unset($_POST['action']);
            $PuntoComen = $_POST['idP'];
            unset($_POST['idP']);
            $PuntoRespuestaCom = Comentarios($PuntoComen,0);
            echo json_encode($PuntoRespuestaCom);
            break;

        case 'InsertaNuevoComentarioRuta':
            unset($_POST['action']);
            $idRuta = $_POST['idRuta'];
            $ComentarioRuta = $_POST['ComentariodRuta'];

            unset($_POST['idRuta']);
            unset($_POST['ComentariodRuta']);
            $PuntoRespuestaCom = InsertaNuevoComentarioRuta($idRuta,$ComentarioRuta);
            echo json_encode($PuntoRespuestaCom);
            break;

        case 'InsertaNuevoComentarioPunto':
            unset($_POST['action']);
            $idPunto = $_POST['idPunto'];
            $ComentarioPunto = $_POST['ComentarioPunto'];

            unset($_POST['idPunto']);
            unset($_POST['ComentarioPunto']);
            $PuntoRespuestaCome = InsertaNuevoComentarioPunto($idPunto,$ComentarioPunto);
            echo json_encode($PuntoRespuestaCome);
            break;

    }

?>