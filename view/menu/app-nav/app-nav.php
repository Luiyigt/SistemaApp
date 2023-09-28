 <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search" onkeyup="SearchVlueSidebar(this)">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <style>
        .dropdown:hover .fa-key {
           color: white;
          }
         

          </style>
        
        <li class="dropdown" id="cave_li" ><a class="app-nav__item" onclick="OpenModalChangePaswoerd()" data-toggle="dropdown" aria-label="Show notifications"><em class="fa fa-sharp fa-solid fa-key fa-lg"></em> </a>
        </li>
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>

          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">No tienes Notificaciones (0).</li>
            
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">

            <p style="text-align: center;margin: 10px" class="app-sidebar__user-designation"><?= $_SESSION['rol']; ?></p>
           <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>-->
            <li><a class="dropdown-item" href="../Controller/Usuario/ControllerSessionActive.php"><i class="fa fa-sign-out fa-lg"></i> Salir</a></li>
          </ul>
        </li>
      </ul>



     <style>
    .modal_password {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }
    
    .modal-content_pass {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
    }
    
    .close {
      color: #aaa;
      
      font-size: 28px;
      font-weight: bold;
       margin-left: auto;
    }
    
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>

<!-- El modal -->
 <div id="modalChangePasswoed" class="modal_password">
    <!-- Contenido del modal -->
    <div class="modal-content_pass">
      <button type="button" class="close" onclick="closeModal()" data-dismiss="modal">&times;</button>
      <div class="modal-body">
        <h5>Cambiar contraseña</h5>
      <form id="fromPasswoed" autocomplete="off" onsubmit="return false" >
                        <div class="form-group row">
                            <label class="control-label col-md-3">Clave Actual</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" id="txt_passActual"  placeholder="Ingrese Clave Actual" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Clave Nueva</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password"  id="text_passNew" placeholder="Clave nueva" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Repita la Clave</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password"  id="text_twopass" placeholder="Repita la clave nueva" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal()"><i class="fa fa-fw fa-lg fa-times-circle"></i>&nbsp;Cerrar</button>
                            <button class="btn btn-primary btn-sm" onclick="Change_password()"><i class="fa fa-fw fa-lg fa-check-circle"></i>&nbsp;Actualizar</button>
                        </div>
                    </form>
        </div>
  </div>



<script type="text/javascript">
  // Obtener el modal y el botón para abrirlo/cerrarlo
var modal = document.getElementById("modalChangePasswoed");
// Función para abrir el modal
function OpenModalChangePaswoerd() {
  modal.style.display = "block";
}
// Función para cerrar el modal
function closeModal() {
  modal.style.display = "none";
}
</script>





 <!-- 
INSERT INTO personas (Nombre, Apellidos, Dni, Telefono, Salario, Correo, Moneda, Sexo, Direccion, Estado, EstadoCuenta, fechaRegisto, Fotopersona, observacion, cvpersona, entrevista, resulentrevista, statedinicio)
VALUES 
('Juan', 'Pérez González', '12345678A', 123456789, 5000.00, 'juan@example.com', 'SOLES', 'Hombre', 'Calle Principal 123', 'Activo', 'Pagado', '2023-07-05 10:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('María', 'Gómez Rodríguez', '98765432B', 987654321, 7000.00, 'maria@example.com', 'SOLES', 'Mujer', 'Avenida Central 456', 'Activo', 'Deuda', '2023-07-05 11:00:00', '', '', '', 'NO', 'Rechazado', 'On'),
('Pedro', 'López Martínez', '56789012C', 567890123, 4000.00, 'pedro@example.com', 'SOLES', 'Hombre', 'Plaza Mayor 789', 'Inactivo', 'Procesando...', '2023-07-05 12:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Ana', 'Martínez González', '34567890D', 345678901, 6000.00, 'ana@example.com', 'SOLES', 'Mujer', 'Calle Secundaria 321', 'Activo', 'Pagado', '2023-07-05 13:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Luis', 'Fernández López', '67890123E', 678901234, 5500.00, 'luis@example.com', 'SOLES', 'Hombre', 'Avenida Principal 987', 'Inactivo', 'Deuda', '2023-07-05 14:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Marcela', 'Hernández Rodríguez', '23456789F', 234567890, 4500.00, 'marcela@example.com', 'SOLES', 'Mujer', 'Calle del Sol 456', 'Activo', 'Pagado', '2023-07-05 15:00:00', '', '', '', 'NO', 'Rechazado', 'On'),
('Carlos', 'Gómez López', '89012345G', 890123456, 4800.00, 'carlos@example.com', 'SOLES', 'Hombre', 'Avenida Central 789', 'Inactivo', 'Procesando...', '2023-07-05 16:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Laura', 'Pérez Martínez', '45678901H', 456789012, 5200.00, 'laura@example.com', 'SOLES', 'Mujer', 'Calle Principal 234', 'Activo', 'Deuda', '2023-07-05 17:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Diego', 'López González', '90123456I', 901234567, 5900.00, 'diego@example.com', 'SOLES', 'Hombre', 'Plaza Mayor 567', 'Inactivo', 'Pagado', '2023-07-05 18:00:00', '', '', '', 'NO', 'Rechazado', 'Off'),
('Sofía', 'Fernández Martínez', '34567890J', 3456789012, 5200.00, 'sofia@example.com', 'SOLES', 'Mujer', 'Avenida Central 890', 'Activo', 'Procesando...', '2023-07-05 19:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Andrés', 'García López', '67890123K', 6789012345, 5100.00, 'andres@example.com', 'SOLES', 'Hombre', 'Calle Principal 345', 'Inactivo', 'Pagado', '2023-07-05 20:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Martha', 'Rodríguez González', '23456789L', 2345678901, 6000.00, 'martha@example.com', 'SOLES', 'Mujer', 'Avenida Principal 678', 'Activo', 'Procesando...', '2023-07-05 21:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Roberto', 'Hernández López', '89012345M', 8901234567, 4700.00, 'roberto@example.com', 'SOLES', 'Hombre', 'Calle Secundaria 901', 'Inactivo', 'Deuda', '2023-07-05 22:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Carolina', 'Gómez Rodríguez', '45678901N', 4567890123, 5300.00, 'carolina@example.com', 'SOLES', 'Mujer', 'Plaza Mayor 123', 'Activo', 'Pagado', '2023-07-05 23:00:00', '', '', '', 'NO', 'Aprobado', 'On'),
('Javier', 'Pérez Martínez', '90123456O', 9012345678, 5900.00, 'javier@example.com', 'SOLES', 'Hombre', 'Avenida Central 456', 'Inactivo', 'Procesando...', '2023-07-05 00:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Lucía', 'López González', '34567890P', 34567890123, 5400.00, 'lucia@example.com', 'SOLES', 'Mujer', 'Calle Principal 789', 'Activo', 'Pagado', '2023-07-05 01:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Gabriel', 'Fernández López', '67890123Q', 67890123456, 5100.00, 'gabriel@example.com', 'SOLES', 'Hombre', 'Avenida Principal 012', 'Inactivo', 'Deuda', '2023-07-05 02:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Valentina', 'García Martínez', '23456789R', 23456789012, 5700.00, 'valentina@example.com', 'SOLES', 'Mujer', 'Calle Secundaria 345', 'Activo', 'Procesando...', '2023-07-05 03:00:00', '', '', '', 'NO', 'Aprobado', 'On'),
('Alejandro', 'Rodríguez González', '89012345S', 89012345678, 6200.00, 'alejandro@example.com', 'SOLES', 'Hombre', 'Plaza Mayor 678', 'Inactivo', 'Pagado', '2023-07-05 04:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Camila', 'Hernández López', '45678901T', 45678901234, 5300.00, 'camila@example.com', 'SOLES', 'Mujer', 'Avenida Central 901', 'Activo', 'Procesando...', '2023-07-05 05:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Daniel', 'Gómez Rodríguez', '90123456U', 90123456789, 4800.00, 'daniel@example.com', 'SOLES', 'Hombre', 'Calle Principal 234', 'Inactivo', 'Deuda', '2023-07-05 06:00:00', '', '', '', 'NO', 'Rechazado', 'Off'),
('Fernanda', 'Pérez Martínez', '34567890V', 34567890123, 5600.00, 'fernanda@example.com', 'SOLES', 'Mujer', 'Avenida Central 567', 'Activo', 'Pagado', '2023-07-05 07:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Isabella', 'Gómez López', '56789012W', 56789012345, 5200.00, 'isabella@example.com', 'SOLES', 'Mujer', 'Calle Principal 678', 'Activo', 'Pagado', '2023-07-06 10:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Miguel', 'Hernández Rodríguez', '90123456X', 90123456789, 5900.00, 'miguel@example.com', 'SOLES', 'Hombre', 'Avenida Central 901', 'Inactivo', 'Deuda', '2023-07-06 11:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Valeria', 'López Martínez', '23456789Y', 23456789012, 5400.00, 'valeria@example.com', 'SOLES', 'Mujer', 'Plaza Mayor 234', 'Activo', 'Procesando...', '2023-07-06 12:00:00', '', '', '', 'NO', 'Aprobado', 'On'),
('Luis', 'García González', '89012345Z', 89012345678, 6100.00, 'luis@example.com', 'SOLES', 'Hombre', 'Calle Secundaria 567', 'Inactivo', 'Pagado', '2023-07-06 13:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Luciana', 'Rodríguez Martínez', '45678901AA', 45678901234, 5300.00, 'luciana@example.com', 'SOLES', 'Mujer', 'Avenida Principal 901', 'Activo', 'Procesando...', '2023-07-06 14:00:00', '', '', '', 'SI', 'Rechazado', 'On'),
('Carlos', 'Hernández López', '90123456BB', 90123456789, 4800.00, 'carlos@example.com', 'SOLES', 'Hombre', 'Calle Principal 234', 'Inactivo', 'Deuda', '2023-07-06 15:00:00', '', '', '', 'NO', 'Aprobado', 'Off'),
('Daniela', 'Gómez Martínez', '34567890CC', 34567890123, 5600.00, 'daniela@example.com', 'SOLES', 'Mujer', 'Avenida Central 567', 'Activo', 'Pagado', '2023-07-06 16:00:00', '', '', '', 'SI', 'Rechazado', 'On'),
('Sebastián', 'Pérez González', '78901234DD', 78901234567, 5300.00, 'sebastian@example.com', 'SOLES', 'Hombre', 'Plaza Mayor 901', 'Inactivo', 'Procesando...', '2023-07-06 17:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Sofía', 'González López', '12345678EE', 12345678901, 5900.00, 'sofia@example.com', 'SOLES', 'Mujer', 'Calle Principal 234', 'Activo', 'Pagado', '2023-07-06 18:00:00', '', '', '', 'NO', 'Aprobado', 'On'),
('Diego', 'Martínez Rodríguez', '56789012FF', 56789012345, 5200.00, 'diego@example.com', 'SOLES', 'Hombre', 'Avenida Principal 567', 'Inactivo', 'Deuda', '2023-07-06 19:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Valentina', 'Hernández Martínez', '90123456GG', 90123456789, 5700.00, 'valentina@example.com', 'SOLES', 'Mujer', 'Calle Secundaria 789', 'Activo', 'Procesando...', '2023-07-06 20:00:00', '', '', '', 'NO', 'Aprobado', 'On'),
('Mateo', 'Gómez López', '23456789HH', 23456789012, 5300.00, 'mateo@example.com', 'SOLES', 'Hombre', 'Plaza Mayor 012', 'Inactivo', 'Pagado', '2023-07-06 21:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Emma', 'Rodríguez Martínez', '89012345II', 89012345678, 4800.00, 'emma@example.com', 'SOLES', 'Mujer', 'Calle Principal 345', 'Activo', 'Procesando...', '2023-07-06 22:00:00', '', '', '', 'NO', 'Rechazado', 'On'),
('Joaquín', 'Hernández González', '45678901JJ', 45678901234, 5500.00, 'joaquin@example.com', 'SOLES', 'Hombre', 'Avenida Central 678', 'Inactivo', 'Deuda', '2023-07-06 23:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Valeria', 'García Martínez', '90123456KK', 90123456789, 5900.00, 'valeria@example.com', 'SOLES', 'Mujer', 'Plaza Mayor 901', 'Activo', 'Pagado', '2023-07-07 00:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Santiago', 'Rodríguez López', '34567890LL', 34567890123, 5200.00, 'santiago@example.com', 'SOLES', 'Hombre', 'Calle Principal 234', 'Inactivo', 'Procesando...', '2023-07-07 01:00:00', '', '', '', 'SI', 'Rechazado', 'Off'),
('Catalina', 'Hernández Martínez', '78901234MM', 78901234567, 5900.00, 'catalina@example.com', 'SOLES', 'Mujer', 'Avenida Principal 567', 'Activo', 'Deuda', '2023-07-07 02:00:00', '', '', '', 'NO', 'Aprobado', 'On'),
('Matías', 'Gómez González', '12345678NN', 12345678901, 5200.00, 'matias@example.com', 'SOLES', 'Hombre', 'Calle Secundaria 789', 'Inactivo', 'Pagado', '2023-07-07 03:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Valentina', 'Martínez López', '56789012OO', 56789012345, 5800.00, 'valentina@example.com', 'SOLES', 'Mujer', 'Plaza Mayor 012', 'Activo', 'Procesando...', '2023-07-07 04:00:00', '', '', '', 'NO', 'Rechazado', 'On'),
('Alejandro', 'Hernández Martínez', '90123456PP', 90123456789, 5400.00, 'alejandro@example.com', 'SOLES', 'Hombre', 'Calle Principal 345', 'Inactivo', 'Deuda', '2023-07-07 05:00:00', '', '', '', 'SI', 'Aprobado', 'Off'),
('Lucía', 'García Rodríguez', '23456789QQ', 23456789012, 5700.00, 'lucia@example.com', 'SOLES', 'Mujer', 'Avenida Central 678', 'Activo', 'Pagado', '2023-07-07 06:00:00', '', '', '', 'SI', 'Aprobado', 'On'),
('Gabriel', 'Rodríguez López', '89012345RR', 89012345678, 5200.00, 'gabriel@example.com', 'SOLES', 'Hombre', 'Plaza Mayor 901', 'Inactivo', 'Procesando...', '2023-07-07 07:00:00', '', '', '', 'SI', 'Rechazado', 'Off');
-->