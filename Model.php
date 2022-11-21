<?php
 //consultaRutas();
 function consultaRutas(){
     try{
         // Conexión a la base de datos
        $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
        $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Sacar un resultado
        $sql = $connect->prepare('SELECT * FROM rutas;');
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($resultado);
    
        //var_dump($resultado[0]['nombre']);
        $connect = null;
        /*foreach ($resultado as $c) {
            echo $c["nombre"] , "<br>";
        }*/
        return $resultado;
        }catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
            return 0;
        }
    }

    function consultaRutasUsuario($idCreador){
        try{
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
           $sql = $connect->prepare("SELECT * FROM rutas WHERE autor = $idCreador;");
           $sql->execute();
           $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
           //echo json_encode($resultado);
       
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
       }

       
       function InsertaNuevoComentarioRuta($idRuta,$Comentario){
        try{
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
           $sql = $connect->prepare("INSERT INTO comentarios ( tipo,  id_ruta,  comentario) VALUES (0, '$idRuta', '$Comentario');");
           $sql->execute();
           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
       
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
        }

        function InsertaNuevoComentarioPunto($idPunto,$Comentario){
            try{
                // Conexión a la base de datos
               $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
               $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
               // Sacar un resultado
               $sql = $connect->prepare("INSERT INTO comentarios ( tipo,  id_punto,  comentario) VALUES (0, '$idPunto', '$Comentario');");
               $sql->execute();
               $resultado = $sql->rowCount();
               //echo json_encode($resultado);
           
               //var_dump($resultado[0]['nombre']);
               $connect = null;
               /*foreach ($resultado as $c) {
                   echo $c["nombre"] , "<br>";
               }*/
               return $resultado;
               }catch(PDOException $e){
                   //echo "ERROR: " . $e->getMessage();
                   return 0;
               }
            }

 function consultaUsuarios(){
    try{
        // Conexión a la base de datos
       $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
       $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
       // Sacar un resultado
       $sql = $connect->prepare('SELECT id_usuario,nombre FROM usuarios;');
       $sql->execute();
       $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
       //echo json_encode($resultado);
   
       //var_dump($resultado[0]['nombre']);
       $connect = null;
       /*foreach ($resultado as $c) {
           echo $c["nombre"] , "<br>";
       }*/
       return $resultado;
       }catch(PDOException $e){
           echo "ERROR: " . $e->getMessage();
           return 0;
       }
    }

    function consultaUsuarioId($id){
        try{
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
           $sql = $connect->prepare("SELECT * FROM usuarios WHERE id_usuario = $id;");
           $sql->execute();
           $resultado = $sql->fetch(PDO::FETCH_ASSOC);
           //echo json_encode($resultado);
       
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
        }

    function InsertaUsuario($nombre,$Apellidop,$Apellidom,$num,$Usuario,$Pass){
        try{
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
           $sql = $connect->prepare("INSERT INTO usuarios (nombre, apellido_p, apellido_m, numero, tipo, user, password) VALUES ('$nombre', '$Apellidop', '$Apellidom', $num, 1,'$Usuario',$Pass);");
           //$sql->bindParam("data:", $data);
           $sql->execute();
           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
       
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //$e->getMessage();
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
        }

 function consultaPuntos($idRuta){
    try{
        // Conexión a la base de datos
       $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
       $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
       // Sacar un resultado
       $sql = $connect->prepare("SELECT * FROM puntos WHERE id_ruta = $idRuta;");
       $sql->execute();
       $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
       //echo json_encode($resultado);
   
       //var_dump($resultado[0]['nombre']);
       $connect = null;
       /*foreach ($resultado as $c) {
           echo $c["nombre"] , "<br>";
       }*/
       return $resultado;
       }catch(PDOException $e){
           //echo "ERROR: " . $e->getMessage();
           return 0;
       }
    }

function InsertaPunto($idRuta,$Nombre,$Descripcion){
        try{
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
           $sql = $connect->prepare("INSERT INTO puntos (id_ruta, nombre, descripcion) VALUES ($idRuta, '$Nombre', '$Descripcion');");
           $sql->execute();
           $resultado = $sql->rowCount();;
           //echo json_encode($resultado);
       
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }

 function Comentarios($id,$Tipo){
    try{
        //Tipo 1 comentario de ruta
        //Tipo 2 comentario de punto
        // Conexión a la base de datos
       $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
       $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
       // Sacar un resultado
       if($Tipo == 1){
            $sql = $connect->prepare("SELECT id_comentario,comentario,tipo FROM comentarios WHERE id_ruta = $id;");
            $sql->execute();
       }else{
            $sql = $connect->prepare("SELECT id_comentario,comentario,tipo FROM comentarios WHERE id_punto = $id;");
            $sql->execute();
       }  
       $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
       //echo json_encode($resultado);
   
       //var_dump($resultado[0]['nombre']);
       $connect = null;
       /*foreach ($resultado as $c) {
           echo $c["nombre"] , "<br>";
       }*/
       return $resultado;
       }catch(PDOException $e){
           echo "ERROR: " . $e->getMessage();
           return 0;
       }
    }

    function InicioSesion($usuario,$Pass){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
                $sql = $connect->prepare("SELECT * FROM usuarios WHERE user = '$usuario' AND password = $Pass;");
                $sql->execute();

           $resultado = $sql->fetch(PDO::FETCH_ASSOC);
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }

    function InsertaNuevaRuta($usuario, $NombreRuta, $Descripcion){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
                $sql = $connect->prepare("INSERT INTO rutas (nombre, descripcion, autor) VALUES ('$NombreRuta', '$Descripcion', $usuario);");
                $sql->execute();

           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }

    function ActualizarRuta($idRuta,$Nombre,$Descripcion){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
                $sql = $connect->prepare("UPDATE rutas SET nombre = '$Nombre', descripcion = '$Descripcion' WHERE id_ruta = $idRuta;");
                $sql->execute();

           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }

    function ActualizarPunto($idPunto,$Nombre,$Descripcion){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
                $sql = $connect->prepare("UPDATE puntos SET nombre = '$Nombre', descripcion = '$Descripcion' WHERE id_punto = $idPunto;");
                $sql->execute();

           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }
    

    function EliminarRuta($idRuta){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
            $sql = $connect->prepare("DELETE FROM rutas WHERE id_ruta = $idRuta;");
            $sql->execute();

           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }

    function EliminarPunto($idPunto){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
            $sql = $connect->prepare("DELETE FROM puntos WHERE id_punto = $idPunto;");
            $sql->execute();

           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }

    function EliminarPuntos($idRuta){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
            $sql = $connect->prepare("DELETE FROM puntos WHERE id_ruta = $idRuta;");
            $sql->execute();

           $resultado = $sql->rowCount();
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }

    function ConsultaInfoPunto($idPunto){
        try{
            //Tipo 1 comentario de ruta
            //Tipo 2 comentario de punto
            // Conexión a la base de datos
           $connect = new PDO('mysql:host=localhost;dbname=rutas', 'root', '');
           $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
           // Sacar un resultado
            $sql = $connect->prepare("SELECT * FROM puntos WHERE id_punto = $idPunto;");
            $sql->execute();

            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
           //echo json_encode($resultado);
            
           //var_dump($resultado[0]['nombre']);
           $connect = null;
           /*foreach ($resultado as $c) {
               echo $c["nombre"] , "<br>";
           }*/
           return $resultado;
           }catch(PDOException $e){
               //echo "ERROR: " . $e->getMessage();
               return 0;
           }
    }
    
?>
