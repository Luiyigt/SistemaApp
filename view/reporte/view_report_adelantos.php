

<script type="text/javascript" src="../js/adelantos.js?rev=<?php echo time();?>"></script>

 <div class="row">
        <div class="col-md-12">
          <div class="tile" style="border-radius: 5px;padding: 10px;">
           <div class="tile-body">
              <ul class="nav nav-pills flex-column mail-nav">
                <li class="nav-item active">
                  <i class="fa fa-home fa-lg"></i> / Reportes Adelantos

              
                </li>
              </ul>
            </div>
           
          </div>
        </div>
      </div>

<div class="row">
 <div class="col-md-12">
  <div class="tile" style="border-top: 3px solid #0720b7;border-radius: 5px;">
       <h5 class="" style="text-align: center;"><strong>Reporte de  Adelantos -  <?php echo date("Y"); ?></strong></h5>

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
    <br><button onclick="Listar_report_adelantos();" class="btn btn-primary btn-sm" type="button" style="font-size: 13px;height: 35px;margin-top: 1px;border-radius: 5px"><i class="fa fa-search"></i></button>
</div>

   <div class="col-sm-3">
      <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar"  style="border-radius: 5px;">
        <span class="input-group-addon"></span>
      </div>
   </div>
 </div>



  <table id="table_reporte_adelantos" class="display responsive nowrap table table-sm" style="width:100%">
    <thead>
                    <tr>
                        <th>N°</th>
                        <th>ID</th>
                        <th>Apellidos y Nombres</th>
                        <th>Dni(Cédula)</th>
                        <th>Salario. Actual</th>
                        <th>Monto adelanto</th>
                        <th>Fecha Operación</th>
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
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
  </table>

</div>
</div>
</div>



<script type="text/javascript">
 $(document).ready(function() {
 
  Listar_report_adelantos();
      
    });
    </script>