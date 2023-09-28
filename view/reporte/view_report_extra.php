

<script type="text/javascript" src="../js/pagoextra.js?rev=<?php echo time();?>"></script>

 <div class="row">
        <div class="col-md-12">
          <div class="tile" style="border-radius: 5px;padding: 10px;">
           <div class="tile-body">
              <ul class="nav nav-pills flex-column mail-nav">
                <li class="nav-item active">
                  <i class="fa fa-home fa-lg"></i> / Reportes pagos hora extra

              
                </li>
              </ul>
            </div>
           
          </div>
        </div>
      </div>
<div class="row">
 <div class="col-md-12">
  <div class="tile" style="border-top: 3px solid #0720b7;border-radius: 5px;">
       <h5 class="" style="text-align: center;"><strong>Reporte  pagos Horas Extras -  <?php echo date("Y"); ?></strong></h5>

    <div class="row invoice-info">
      <div class="col-sm-3">
       <div class="clasbtn_exportar">
        <div class="input-group" id="btn-place"></div>
      </div>
     </div>
     <div class="col-sm-3">
      <div class="form-group">
       <input class="form-control form-control" type="Date" id="FechaInicio"   >
      </div>
      
     </div>
    <div class="col-sm-3" style="display: flex;">
    <input class="form-control form-control" type="Date" id="FechaFin">&nbsp;
    <br><button onclick="listar_Reporte_Horas_Extra();" class="btn btn-primary btn-sm" type="button" style="font-size: 13px;height: 35px;margin-top: 1px;border-radius: 5px"><i class="fa fa-search"></i></button>
</div>

   <div class="col-sm-3">
      <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar"  style="border-radius: 5px;">
        <span class="input-group-addon"></span>
      </div>
   </div>
 </div>



  <table id="tabla_reporte_hextras" class="display responsive nowrap table table-sm" style="width:100%">
    <thead>
                    <tr>
                        <th>N°</th>
                        <th>ID</th>
                        <th>Apellidos y Nombres</th>
                        <th>Empresa</th>
                        <th>F. Desde</th>
                        <th>F. Hasta</th>
                        <th>T. Horas(ext)</th>
                        <th>T .Monto</th>
                        <th>F. Operación</th>
                        <th>Estado</th>
                        <th>Ver.</th>
                      
                        
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

<!--modalreporteshoraextra-->
 <div class="modal fade" id="modalreporteshoraextra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Reporte de pagos - (CGL-CRM) <?php echo date("Y"); ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
           
           <table id="tabla_show_pagos" class="display responsive nowrap" style="width:100%">
            <thead>
                    <tr>
                        <th>N°</th>
                        <th>Fechas</th>
                        <th>Horas</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Estado</th>
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
                    </tr>
                </tfoot>
              </table>
         
          </div>
          
           <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           
          </div>
       
      </div>
    </div>
  </div>





<script type="text/javascript">
 $(document).ready(function() {
 
  listar_Reporte_Horas_Extra();
      
    });
    </script>