
var editando=false;
function AbrirModarRegistroUsuario(){
       editando=false;
	   $("#modal_editarRegister").modal({
	      backdrop: 'static',
	        keyboard: false
	    })
	   $("#tituloModal").text('Nuevo Usuario');
	   // document.querySelector('#fromIncripts').reset();
	    $('#modal_editarRegister').modal('show');
}

function RegistrarUsuario(){
	var idususario = $("#Idusuario").val();
	var nombreusuario = $("#nombreusuario").val();
    var apellidos =$("#apellidoususario").val();
     var usuario =$("#ususriologin").val().toUpperCase();
    var passwordprimero = $("#contraseñaprimero").val();
    var passworsegundo = $("#segundacontraseña").val();
    var roluser = $("#ususarioSelectdrol").val();
    
    if(editando){
     
     if (nombreusuario.length == 0 || apellidos.length == 0 ||  usuario.length == 0 || roluser.length==0) { 
      return Swal.fire("Mensaje de adnertencia", "llene todo los campos, son obligatorios.", "warning");      
    }

    }else {
    if (nombreusuario.length == 0 || apellidos.length == 0 ||  usuario.length == 0 || passwordprimero.length == 0 || passworsegundo.length == 0 || roluser.length==0) { 
      return Swal.fire("Mensaje de adnertencia", "llene todo los campos, son obligatorios.", "warning");      
    }

    if (passwordprimero != passworsegundo) {
       return Swal.fire("Mensaje de adnertencia", "Las contraseñas no son iguales !.", "warning");      
    }
        
    }

    
    $.ajax({
        
        url: editando === false ? '../Controller/Usuario/ControllerRegisterUser.php':'../Controller/Usuario/ControllerUpdateUsuario.php',
        type: 'POST',
        data: {idususario:idususario,nombreusuario: nombreusuario,apellidos:apellidos,usuario: usuario, passwordprimero:passwordprimero,roluser:roluser
        }
    }).done(function(resp) {
     MessengerRequest(resp);
       
    }).fail(function(jqXHR, textStatus, errorThrown) {
  if (jqXHR.status === 403) {
   
    return Swal.fire("Mensaje de error", "No Autorizado"+jqXHR.url+",Iniciar Sessión.", "error");
  } else {
    
    return Swal.fire("Mensaje de error", errorThrown, "error");
  }
});
}

function MessengerRequest(Request){
	var request = JSON.parse(Request);
	if(request.data==1){




     Swal.fire({icon: 'success',title: 'Éxito !!',text: ''+request.msg,showConfirmButton: false,timer: 1500})
      tableuser.ajax.reload();
      ClearFromRegisterEdt();
       $('#modal_editarRegister').modal('hide');
	}
	if(request.data==100){
	
    return Swal.fire("Mensaje de adnertencia", ""+request.msg, "warning");	
	}
	if(request.data==0){
		return Swal.fire("Mensaje de error", "No se pudo completar el registro."+request.msg, "error");  
	}
}

$('#tabla_usuario').on('click', '.activar', function() {
    var data = tableuser.row($(this).parents('tr')).data();
    

    if (tableuser.row(this).child.isShown()) {
        var data = tableuser.row(this).data();
    }
    Swal.fire({
        title: 'Esta seguro de activar al usuario?',
        text: "Una vez hecho esto el usuario  tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0720b7',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.idususario, 'Activo');
        }
    }) 

})

$('#tabla_usuario').on('click', '.desactivar', function() {
    var data = tableuser.row($(this).parents('tr')).data();
    // alert(data.usu_id);
    if (tableuser.row(this).child.isShown()) {
        var data = tableuser.row(this).data();
    }
    Swal.fire({
        title: 'Esta seguro de desactivar al usuario?',
        text: "Una vez hecho esto el usuario no tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0720b7',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.idususario, 'Inactivo');
        }
    })
})


function Modificar_Estatus(idusuario, estatus) {
    
    $.ajax({
        "url": "../Controller/Usuario/ControllerStateChange.php",
        type: 'POST',
        data: {
            idusuario: idusuario,
            estatus: estatus
        }
    }).done(function(resp) {
       MessengerRequest(resp)
    })
}

function ClearFromRegisterEdt(){
	$("#Idusuario").val('');
	$("#nombreusuario").val('');
    $("#apellidoususario").val('');
    $("#ususriologin").val('');
    $("#contraseñaprimero").val('');
    $("#segundacontraseña").val('');
    $('#ususarioSelectdrol').val(1).trigger('change');
}

$('#tabla_usuario').on('click', '.editar', function() {
    var data = tableuser.row($(this).parents('tr')).data();
    // alert(data.usu_id);
    if (tableuser.row(this).child.isShown()) {
        var data = tableuser.row(this).data();
    }

     $.ajax({
        "url": "../Controller/Usuario/ControllerShowUser.php",
        type: 'POST',
        data: {idususario:data.idususario
        }
    }).done(function(resp) {
       showUserEdit(resp);

    }).fail(function(jqXHR, textStatus, errorThrown) {
  if (jqXHR.status === 403) {
   
    return Swal.fire("Mensaje de error", "No Autorizado"+jqXHR.url+",Iniciar Sessión.", "error");
  } else {
    
    return Swal.fire("Mensaje de error", errorThrown, "error");
  }
});
   
})

function showUserEdit(Request){
 var request = JSON.parse(Request);

 if(request.data.length!= 0 ){
	editando=true;
	 $("#modal_editarRegister").modal({
	      backdrop: 'static',
	        keyboard: false
	    })
	 $("#tituloModal").text('Editar Usuario');
	   
	 $("#Idusuario").val(request.data[0]["idususario"]);
	 $("#nombreusuario").val(request.data[0]["Nombres"]);
	 $("#apellidoususario").val(request.data[0]["Apellidos"]);
	 $("#ususriologin").val(request.data[0]["usuario"]);
	 $("#ususarioSelectdrol").val(request.data[0]["rolusuario"]);
	 $('#modal_editarRegister').modal('show');
}else{
   
    return Swal.fire("Mensaje de error", "No se pudo completar el registro."+request.msg, "error");
}

}

var tableuser;
function Listar_Usuarios(){
   tableuser=$('#tabla_usuario').DataTable({
        "ordering": true,
        "bLengthChange": false,
        "scrollCollapse": true,
        "searching": {
            "regex": true
        },
        "lengthMenu": [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"]
        ],
        "pageLength": 5,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../Controller/Usuario/ControllerGetUsuarios.php",
            type: 'POST'
        },
        "columns": [
          { "data": null,"render": function (data, type, row, meta) {return meta.row + 1; }},
          {"data": "idususario" },
          {"data": null, "render": function (data, type, row) {return row.Nombres + ' ' + row.Apellidos;}},
          {"data": "usuario"},
          {"data": "rolusuario"},
          { "data": "usu_estatus ",
           "render": function (data, type, row) {
            return "<span class='badge badge-pill " + (row.usu_estatus == "Activo" ? "badge-primary" : "badge-warning") + "'>" + row.usu_estatus + "</span>";
          }},
          { "data": "usu_estatus ",
          "render": function (data, type, row) {
           var buttonClass = row.usu_estatus == "Activo" ? "btn-info" : "btn-warning";
           var buttonText = row.usu_estatus == "Activo" ? "desactivar" : "activar";
    
           return `<button type='button' class='editar btn btn-primary btn-sm'><i class='fa fa-edit' title='editar'></i></button>
            &nbsp;<button type='button' class='${buttonText} btn ${buttonClass} btn-sm'><i class='fa fa-eye-slash' aria-hidden='true'></i></button>`;
           }}

        ],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_usuario_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
     tableuser.column(0).visible( false );
}

function filterGlobal() {
    $('#tabla_usuario').DataTable().search($('#global_filter').val(), ).draw();
}


function VerificarUsuario(){
    var usuario = $("#txt_user").val();
    var contrasena = $("#text_paswoed").val();
    if (usuario.length == 0 || contrasena.length == 0 ) {
        return Swal.fire("Mensaje de adnertencia", "Ingesae Contraseña y usuario.", "warning");
    }

    $.ajax({
        url:'../Controller/Usuario/ControllerVerificarUsuario.php',
        type:'POST',
        data:{
            usuario:usuario,
            contrasena:contrasena

        } }).done(function(resp){
         var data= JSON.parse(resp);
          var html='';
         if(data.session==true){
         html +=  "<div class='bs-component'>";
         html +=  "<div class='alert alert-dismissible "+data.tipo+"'>";
         html +=  "<button class='close' type='button' data-dismiss='alert'>×</button>";
         html +=  "<strong>Bienvenido </strong><a class='alert-link'></a>"+data.mensaje+".";
         html +=  "</div>";
         html +=  "</div>";
         $("#mensajelogin").html(html);
          location.reload();
         }else{
        
         html +=  "<div class='bs-component'>";
         html +=  "<div class='alert alert-dismissible "+data.tipo+"'>";
         html +=  "<button class='close' type='button' data-dismiss='alert'>×</button>";
         html +=  "<strong>Oh snap! </strong><a class='alert-link'></a>"+data.mensaje+".";
         html +=  "</div>";
         html +=  "</div>";
         $("#mensajelogin").html(html);
         }
    })
}