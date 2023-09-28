<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../images/luis.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['username']; ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['rol']; ?></p>
        </div>
      </div>

 <ul class="app-menu">
   <style>
        .app-menu__item:hover .app-menu__icon,.app-menu__label,.treeview-indicator {
           color: white;
           cursor: pointer;
          }

          </style>
        <li>
          <a class="app-menu__item active" onclick="cargar_contenido('Contenido_principal','../view/dashboard/view_dashboard.php')">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Dashboard</span>
             <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
        </li>
         <li>
          <a class="app-menu__item " onclick="cargar_contenido('Contenido_principal','../view/usuario/view_listar_usuarios.php');toggleActiveClass(this)">
            <i class="app-menu__icon fa fa fa-user"></i>
            <span class="app-menu__label">Usuarios</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>

        </li>
         <li>
          <a class="app-menu__item " onclick="cargar_contenido('Contenido_principal','../view/personal/view_listar_personal.php');toggleActiveClass(this)">
            <i class="app-menu__icon fa fa-users"></i>
            <span class="app-menu__label">Personal</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
        </li>
         <li>
          <a class="app-menu__item" onclick="cargar_contenido('Contenido_principal','../view/jornadas/view_listar_inicio.php') ;toggleActiveClass(this)" >
            <i class="app-menu__icon fa fa-briefcase"></i>
            <span class="app-menu__label">Aprobacion de Personal</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
        </li>
         <li class="treeview">

    
           
      
        </li>
         <li>
         
        </li>
         <li>
        
        </li>
          <li>
          <a class="app-menu__item " onclick="cargar_contenido('Contenido_principal','../view/vacaciones/view_lista_personas.php');toggleActiveClass(this)">
            <i class="app-menu__icon fa fa-child"></i>
            <span class="app-menu__label">Vacaciones</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
        </li>
         <li>
          <a class="app-menu__item " onclick="cargar_contenido('Contenido_principal','../view/asistencia/view_listar_persona.php');toggleActiveClass(this)">
            <i class="app-menu__icon fa fa-check-square-o"></i>
            <span class="app-menu__label">Asistencia</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a class="app-menu__item"  onclick="toggleActiveClass(this)" data-toggle="treeview">
            <i class="app-menu__icon fa fa-file-pdf-o"></i>
            <span class="app-menu__label">Reportes</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            </li>
            <li><a class="treeview-item" onclick="cargar_contenido('Contenido_principal','../view/reporte/view_report_asistencia.php')"><i class="icon fa fa-circle-o"></i>Asistencia</a>
            </li>
            <li><a class="treeview-item" onclick="cargar_contenido('Contenido_principal','../view/reporte/view_report_vacaciones.php')"><i class="icon fa fa-circle-o"></i>Vacaciones</a>
            </li>
          </ul>
        </li>
        
      </ul>