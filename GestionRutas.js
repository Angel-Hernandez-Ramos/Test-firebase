
function CreandoTablaNuevaRuta(idUser){
    $.ajax({
        url: 'assets/data/Controller/assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'consultaRutasUsuario',
            idUsuario: idUser
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#datatableRutasUser").DataTable().clear();
                for(c in pr){
                    $("#datatableRutasUser").DataTable().row.add([
                        pr[c].nombre,
                        pr[c].descripcion,
                        `<button type="button" class="btn btn-primary" onclick="EditarRuta(${pr[c].id_ruta},'${pr[c].nombre}','${pr[c].descripcion}')">Editar Ruta</button>`
                       ]);
                }
                $("#datatableRutasUser").DataTable().draw();
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
}

function EditarRuta(idRuta,nombre,descripcion){
    console.log("Vamos A EDITAR");
    $("#IdRutaPunto").val(idRuta);
    $("#IdRutaEditar").val(idRuta);
    $("#nombreRutaEditar").val(nombre);
    $("#DescripcionRutasEditar").val(descripcion);
    $("#MyModalEditar").modal("show");
    tRutasEditar = $("#datatablePuntosEditar").DataTable({
        responsive: true,
        Processing: true,
        ServerSide: true,
        'language':{
            'sLengthMenu': 'Mostrar _MENU_ registros',
            'sInfo': 'Mostrando registro del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
            'sSearch': 'Buscar:',
            'sLoadingRecords': 'Cargando',
            'oPaginate':{
                'sFirst': 'Primero',
                'sLast': 'Último',
                'sNext': 'Siguiente',
                'sPrevious': 'Anterior'
            }
        },
        'bDestroy': true,
        'iDisplayLength': 10,
        'order':[
            [0,'asc']
        ],
    });
    llenadoTablaEditar(idRuta);
}

function llenadoTablaEditar(idRuta){
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'consultaPuntos',
            idR: idRuta
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#datatablePuntosEditar").DataTable().clear();
                for(c in pr){
                    $("#datatablePuntosEditar").DataTable().row.add([
                        pr[c].nombre,
                        pr[c].descripcion,
                        `<button type="button" class="btn btn-primary" onclick="EliminarPunto(${pr[c].id_punto})">Eliminar Punto</button> <button type="button" class="btn btn-primary" onclick="EditarPunto(${pr[c].id_punto})">Editar Punto</button>`
                       ]);
                }
                $("#datatablePuntosEditar").DataTable().draw();
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });    
}


function EditarPunto(idPunto){
    $("#ModalEditarPunto").modal("show");
    $("#MyModalEditar").modal("hide");

    $("#puntoEditar").val(idPunto);
    
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'ConsultaInfoPunto',
            idP: idPunto
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#DescripcionpuntoEditar").val(pr.descripcion);
                $("#puntoEditarNombre").val(pr.nombre);
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
}

$("#formulario-puntoEditar").on('submit',function(e){
    e.preventDefault();
    fData = new FormData(this);
    fData.append('action', 'ActualizarPunto');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                if(pr!=false){
                    let timerInterval
                    Swal.fire({
                    title: 'Punto Editado Correctamente',
                    html: 'Guardando informacion',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                        $("#ModalEditarPunto").modal("hide");
                        //$("#MyModalEditar").modal("show");

                        idRuta = $("#IdRutaEditar").val(idPunto);
                        llenadoTablaEditar(idRuta);
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer');
                        //Aqui despues de que fue exitosa
                        
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se ha podido actualizar el Punto!',
                        footer: '<h3>Intenta cambiar la informacion</h3>'
                      });
                }
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
});

$(document).ready(()=>{
   console.log("Hello");
   tRutas = $("#datatableRutasUser").DataTable({
    responsive: true,
    Processing: true,
    ServerSide: true,
    'language':{
        'sLengthMenu': 'Mostrar _MENU_ registros',
        'sInfo': 'Mostrando registro del _START_ al _END_ de un total de _TOTAL_ registros',
        'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
        'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
        'sSearch': 'Buscar:',
        'sLoadingRecords': 'Cargando',
        'oPaginate':{
            'sFirst': 'Primero',
            'sLast': 'Último',
            'sNext': 'Siguiente',
            'sPrevious': 'Anterior'
        }
    },
    'bDestroy': true,
    'iDisplayLength': 10,
    'order':[
        [0,'asc']
    ],
    });
    Usuario = $("#IdUser").val();
    var name =  "<%= Session['data']['id_usuario'] %>";  
    console.log(name);
    CreandoTablaNuevaRuta(Usuario);
});

$("#Formulario-logIn").on('submit',function(e){
    e.preventDefault();
    fData = new FormData(this);
    fData.append('action', 'InicioSesion');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                if(pr!=false){
                    if(pr.tipo == 1){
                        console.log(pr);
                        window.location.replace('indexUser.php?Session='+pr['id_usuario']);
                    }else{
                        console.log(pr);
                        window.location.replace('indexAdmin.php?Session='+pr['id_usuario']);
                    }
                    //pr.submit();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Usuario o Contraseña no validos!',
                        footer: '<h3>Intenta cambiar la informacion</h3>'
                      });
                }
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
});

$("#formulario-rutaEditar").on('submit',function(e){
    
    e.preventDefault();
    idUsuario = $("#IdUserEditar").val();
    fData = new FormData(this);
    fData.append('action', 'ActualizarRuta');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Ruta Editada Correctamente',
                    html: 'Guardando informacion',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                        CreandoTablaNuevaRuta(idUsuario);
                        $("#MyModalEditar").modal("hide");
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer');
                        //Aqui despues de que fue exitosa
                        
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al actualizar la informacion',
                        footer: '<h3>No se han detectado cambios</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                console.log(data);
            }
        }
    });

});

$("#formulario-rutas").on('submit',function(e){
    e.preventDefault();
    //Declaracion de Datatable
    tRutas = $("#datatableRutas").DataTable({
        responsive: true,
        Processing: true,
        ServerSide: true,
        'language':{
            'sLengthMenu': 'Mostrar _MENU_ registros',
            'sInfo': 'Mostrando registro del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
            'sSearch': 'Buscar:',
            'sLoadingRecords': 'Cargando',
            'oPaginate':{
                'sFirst': 'Primero',
                'sLast': 'Último',
                'sNext': 'Siguiente',
                'sPrevious': 'Anterior'
            }
        },
        'bDestroy': true,
        'iDisplayLength': 10,
        'order':[
            [0,'asc']
        ],
    });

    fData = new FormData(this);
    fData.append('action', 'ImprmirRutas');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#datatableRutas").DataTable().clear();
                for(c in pr){
                    $("#datatableRutas").DataTable().row.add([
                        pr[c].nombre,
                        pr[c].descripcion,
                        `<button type="button" class="btn btn-primary" onclick="VerPuntosId(${pr[c].id_ruta})">Ver Puntos</button> <button type="button" class="btn btn-primary" onclick="Comentar(${pr[c].id_ruta})">Comentarios</button>`
                       ]);
                }
                $("#datatableRutas").DataTable().draw();
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
});


function Comentar(idRuta){
    $("#MyModalComentariosRuta").modal("show");
    $("#idRuta").val(idRuta);
    idRuta
    tComentarios = $("#datatableComentariosRuta").DataTable({
        responsive: true,
        Processing: true,
        ServerSide: true,
        'language':{
            'sLengthMenu': 'Mostrar _MENU_ registros',
            'sInfo': 'Mostrando registro del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
            'sSearch': 'Buscar:',
            'sLoadingRecords': 'Cargando',
            'oPaginate':{
                'sFirst': 'Primero',
                'sLast': 'Último',
                'sNext': 'Siguiente',
                'sPrevious': 'Anterior'
            }
        },
        'bDestroy': true,
        'iDisplayLength': 10,
        'order':[
            [0,'asc']
        ],
    });
    CargarComentariosR(idRuta);
}

function CargarComentariosR(idRuta){
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'Comentarios',
            idR: idRuta
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#datatableComentariosRuta").DataTable().clear();
                for(c in pr){
                    $("#datatableComentariosRuta").DataTable().row.add([
                        pr[c].comentario
                       ]);
                }
                $("#datatableComentariosRuta").DataTable().draw();
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
}

function ComentariosPunto(idPunto){
    $("#MyModalComentariosPunto").modal("show");
    $("#idPunto").val(idPunto);
    tComentariosPunto = $("#datatableComentariosPunto").DataTable({
        responsive: true,
        Processing: true,
        ServerSide: true,
        'language':{
            'sLengthMenu': 'Mostrar _MENU_ registros',
            'sInfo': 'Mostrando registro del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
            'sSearch': 'Buscar:',
            'sLoadingRecords': 'Cargando',
            'oPaginate':{
                'sFirst': 'Primero',
                'sLast': 'Último',
                'sNext': 'Siguiente',
                'sPrevious': 'Anterior'
            }
        },
        'bDestroy': true,
        'iDisplayLength': 10,
        'order':[
            [0,'asc']
        ],
    });
    CargarComentariosP(idPunto);

}

function CargarComentariosP(idPunto){
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'ComentariosPunto',
            idP: idPunto
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#datatableComentariosPunto").DataTable().clear();
                for(c in pr){
                    $("#datatableComentariosPunto").DataTable().row.add([
                        pr[c].comentario
                       ]);
                }
                $("#datatableComentariosPunto").DataTable().draw();
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
}

function VerPuntosId(idRuta){
    $("#MyModal1").modal("show");
    tRutas = $("#datatablePuntos").DataTable({
        responsive: true,
        Processing: true,
        ServerSide: true,
        'language':{
            'sLengthMenu': 'Mostrar _MENU_ registros',
            'sInfo': 'Mostrando registro del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
            'sSearch': 'Buscar:',
            'sLoadingRecords': 'Cargando',
            'oPaginate':{
                'sFirst': 'Primero',
                'sLast': 'Último',
                'sNext': 'Siguiente',
                'sPrevious': 'Anterior'
            }
        },
        'bDestroy': true,
        'iDisplayLength': 10,
        'order':[
            [0,'asc']
        ],
    });

    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'consultaPuntos',
            idR: idRuta
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#datatablePuntos").DataTable().clear();
                for(c in pr){
                    $("#datatablePuntos").DataTable().row.add([
                        pr[c].nombre,
                        pr[c].descripcion,
                        `<button type="button" class="btn btn-primary" onclick="ComentariosPunto(${pr[c].id_punto})">Comentarios</button>`
                       ]);
                }
                $("#datatablePuntos").DataTable().draw();
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });

}

$("#formulario-Eliminar-rutas").on('submit',function(e){
    e.preventDefault();
    //Declaracion de Datatable
    tRutas = $("#datatableRutasEliminar").DataTable({
        responsive: true,
        Processing: true,
        ServerSide: true,
        'language':{
            'sLengthMenu': 'Mostrar _MENU_ registros',
            'sInfo': 'Mostrando registro del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
            'sSearch': 'Buscar:',
            'sLoadingRecords': 'Cargando',
            'oPaginate':{
                'sFirst': 'Primero',
                'sLast': 'Último',
                'sNext': 'Siguiente',
                'sPrevious': 'Anterior'
            }
        },
        'bDestroy': true,
        'iDisplayLength': 10,
        'order':[
            [0,'asc']
        ],
    });

    fData = new FormData(this);
    fData.append('action', 'ImprmirRutas');
    console.log(fData);
    Cargar_Tabla_Eliminar(fData);
});

function Cargar_Tabla_Eliminar(fData){
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                $("#datatableRutasEliminar").DataTable().clear();
                for(c in pr){
                    $("#datatableRutasEliminar").DataTable().row.add([
                        pr[c].nombre,
                        pr[c].descripcion,
                        `<button type="button" class="btn btn-primary" onclick="EliminarRuta(${pr[c].id_ruta})">Eliminar Ruta</button>`
                       ]);
                }
                $("#datatableRutasEliminar").DataTable().draw();
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
}

function EliminarRuta(idRuta){
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'EliminarRuta',
            idR: idRuta
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Ruta eliminada exitosamente!',
                    html: 'Guardando informacion',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        //$("#formulario-usuario")[0].reset();
                        //$("#formulario-usuario").reset();
                        fData = new FormData();
                        fData.append('action', 'ImprmirRutas');
                        console.log(fData);
                        Cargar_Tabla_Eliminar(fData);
                        
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error, no se pudo eliminar la ruta!',
                        footer: '<h3>Intenta elegir otro</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
}

function EliminarPunto(idPunto){
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: {
            action: 'EliminarPunto',
            idP: idPunto
        },
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Punto eliminado exitosamente!',
                    html: 'Guardando informacion',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        //$("#formulario-usuario")[0].reset();
                        //$("#formulario-usuario").reset();
                        /*fData = new FormData();
                        fData.append('action', 'ImprmirRutas');
                        console.log(fData);
                        Cargar_Tabla_Eliminar(fData);*/
                        
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error, no se pudo eliminar la ruta!',
                        footer: '<h3>Intenta elegir otro</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                //console.log(data);
            }
        }
    });
}


$("#formulario-usuario").on('submit',function(e){
    e.preventDefault();
    fData = new FormData(this);
    fData.append('action', 'RegistrarUsuario');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Registro Exitoso!',
                    html: 'Guardando informacion',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        $("#formulario-usuario")[0].reset();
                        //$("#formulario-usuario").reset();
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ya existe un usuario con ese nombre!',
                        footer: '<h3>Intenta elegir otro</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                console.log(data);
            }
        }
    });
});



$("#formulario-punto-nuevo").on('submit',function(e){
    Usuario = $("#IdUserPunto").val();
    Ruta = $("#IdRutaEditar").val();
    //$("#IdRutaPunto").val('Ruta');
    
    e.preventDefault();
    fData = new FormData(this);
    fData.append('action', 'InsertaPunto');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Registro de punto Exitoso!',
                    html: 'Guardando informacion',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        $("#formulario-punto-nuevo")[0].reset();
                        llenadoTablaEditar(Ruta);
                        //CreandoTablaNuevaRuta(Usuario);
                        //$("#formulario-usuario").reset();
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al registrar punto!',
                        footer: '<h3>Intenta cambiar la informacion</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                console.log(data);
            }
        }
    });
});

$("#formulario-rutaNueva").on('submit',function(e){
    Usuario = $("#IdUser").val();
    e.preventDefault();
    fData = new FormData(this);
    fData.append('action', 'InsertaNuevaRuta');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Registro Exitoso!',
                    html: 'Guardando informacion',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        $("#formulario-rutaNueva")[0].reset();
                        CreandoTablaNuevaRuta(Usuario);
                        //$("#formulario-usuario").reset();
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al registrar punto!',
                        footer: '<h3>Intenta cambiar la informacion</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                console.log(data);
            }
        }
    });
});


$("#formularioComentarioRuta").on('submit',function(e){
    idRuta = $("#idRuta").val();

    e.preventDefault();
    fData = new FormData(this);
    fData.append('action', 'InsertaNuevoComentarioRuta');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Comentario Exitoso!',
                    html: 'Guardando informacion de la Ruta',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer');
                        CargarComentariosR(idRuta);
                        $("#ComentariodRuta").val("");
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al Comentar Ruta!',
                        footer: '<h3>Intenta cambiar la informacion</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                console.log(data);
            }
        }
    });
});

$("#formularioComentarioPunto").on('submit',function(e){
    idPunto = $("#idPunto").val();

    e.preventDefault();
    fData = new FormData(this);
    fData.append('action', 'InsertaNuevoComentarioPunto');
    console.log(fData);
    $.ajax({
        url: 'assets/data/Controller/Control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData: false,
        success : function(data){
            try{
                pr = JSON.parse(data);
                console.log(pr);
                if(pr==1){
                    let timerInterval
                    Swal.fire({
                    title: 'Comentario Exitoso!',
                    html: 'Guardando informacion del Punto',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer');
                        CargarComentariosP(idPunto);
                        $("#ComentarioPunto").val("");
                    }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al Comentar Punto!',
                        footer: '<h3>Intenta cambiar la informacion</h3>'
                      })
                }
    
            }catch(e){
                console.log(e);
                console.log(data);
            }
        }
    });
});

function CerrarSesion(){
    window.location.replace("index.html");
}