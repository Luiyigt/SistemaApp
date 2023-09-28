
<script type="text/javascript" src="../js/usuarios.js?rev=<?php echo time();?>"></script>
   <div class="row">
        <div class="col-md-12">
          <div class="tile" style="border-radius: 5px;padding: 10px;">
           <div class="tile-body">
              <ul class="nav nav-pills flex-column mail-nav">
                <li class="nav-item active">
                  <i class="fa fa-home fa-lg"></i> / Usuarios
                  
              
                </li>
              </ul>
            </div>
           
          </div>
        </div>
      </div>

<div class="row" >
 <div class="col-md-12">
  <div class="tile" style="border-top: 3px solid #0720b7;border-radius: 5px;">

    <div class="row invoice-info">
      <div class="col-sm-4">
       <a class="btn btn-primary icon-btn btn-sm" onclick="AbrirModarRegistroUsuario();"><i class="fa fa-plus-circle " aria-hidden="true" style="color: white;"></i>&nbsp;<strong style="color: white;" >Nuevo Registro</strong></a>
     </div>
     <div class="col-sm-4">
       <h5 class="" style="text-align: center;"><strong>Gestión de Usuarios - <?php echo date("Y"); ?></strong></h5>
     </div>
     <div class="col-sm-4">
     <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar"  style="border-radius: 5px;">
        <span class="input-group-addon"></span>
      </div>
   </div>
 </div>

 <table id="tabla_usuario" class="display responsive nowrap table table-sm" style="width:100%">
  <thead>
    <tr>
      <th>Id</th>
      <th>N°</th>
      <th>Nombre y Apellido</th>
      <th>Usuario</th>
      <th>Rol Usuario</th>
      <th>Estdo</th>
      <th>Acci&oacute;n</th>

    </tr>
  </thead>
  <tfoot>
    <tr>
      
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>


</div>
</div>
</div>





<div class="modal fade" id="modal_editarRegister" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <div class="icon-container" style="margin-top:5px">
          <i class="fa fa-pencil-square" style="font-size: 20px"  aria-hidden="true"></i>&nbsp;  
        </div>
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row invoice-info">

         <div class="col-lg-6">
          <div class="form-group">
            <label class="col-form-label" for="inputDefault"><strong> Nombres</strong></label>
            <input class="" id="Idusuario" type="text" hidden>
            <input class="form-control form-control-sm" id="nombreusuario" type="text">
          </div>
          <div class="form-group">
            <label class="col-form-label" for="inputDefault"><strong> Apellidos</strong></label>
            <input class="form-control form-control-sm" id="apellidoususario" type="text">
          </div>
          <div class="form-group">
            <label class="col-form-label" for="inputDefault"><strong> Usuario</strong></label>
            <input class="form-control form-control-sm" id="ususriologin" type="text">
          </div>

        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="col-form-label" for="inputDefault"><strong> Contraseña</strong></label>
            <input class="form-control form-control-sm" id="contraseñaprimero" type="password">
          </div>
          <div class="form-group">
            <label class="col-form-label" for="inputDefault"><strong> Repite contraseña</strong></label>
            <input class="form-control form-control-sm" id="segundacontraseña" type="password">
          </div>
          <div class="form-group">
            <label for="exampleSelect1"><strong> Rol ususario</label>
              <select class="form-control" id="ususarioSelectdrol">
                <option value="">---seleccione---</option>
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                <option value="EMPLEADO">EMPLEADO</option>
                <option value="TRABAJADOR">TRABAJADOR</option>
                <option value="NOMBRADO">Practicante</option>
              </select>
            </div>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary btn-sm" id="btnregister" onclick="RegistrarUsuario()">Guardar</button>
      </div>

    </div>
  </div>
</div>



<script type="text/javascript">
 $(document).ready(function() {

Listar_Usuarios();
      
    });
    </script>