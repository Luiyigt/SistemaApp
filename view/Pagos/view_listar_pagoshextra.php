
<script type="text/javascript" src="../js/pagoextra.js?rev=<?php echo time();?>"></script>
  <div class="row">
        <div class="col-md-12">
          <div class="tile" style="border-radius: 5px;padding: 10px;">
           <div class="tile-body">
              <ul class="nav nav-pills flex-column mail-nav">
                <li class="nav-item active">
                  <i class="fa fa-home fa-lg"></i> / Pagos horas extra
                  
                  
              
                </li>
              </ul>
            </div>
           
          </div>
        </div>
      </div>

<div class="row" id="section_tabale">
 <div class="col-md-12">
  <div class="tile" style="border-top: 3px solid #0720b7;border-radius: 5px;">
   <div class="row invoice-info">
     
     <div class="col-sm-6">
       <h5 class="" ><strong>Pagos de horas extra - <?php echo date("Y"); ?></strong></h5>
     </div>
     <div class="col-sm-6">
     <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar"  style="border-radius: 5px;">
        <span class="input-group-addon"></span>
      </div>
   </div>
 </div>

 <table id="tabla_extras_horas" class="display responsive nowrap table table-sm" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Nombre y Apellido</th>
                        <th>Dni</th>
                        <th>Salario</th>
                        <th>T. Horas(h)</th>
                        <th>T. Monto($/.)</th>
                        <th>F. Desde</th>
                        <th>F. Hasta</th>
                        <th>Estado</th>
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




<style type="text/css">
  .fila-seleccionada {
  background-color: #e6f7ff; /* Color de fondo para la fila seleccionada */
  font-weight: bold; /* Texto en negrita para la fila seleccionada */
}

</style>


 <div class="modal fade" id="modapagoshoraextra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Pagos horas extra Personal <?php echo date("Y"); ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        

            <div class="bs-component">
              <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Bien!</strong>  Seleccione la fila que desea pagar.  <a class="alert-link" href="#">Informativo.</a>.
              </div>
            </div>

           <input type="text" name="" id="idempleadoextrapago" hidden>
          
            <table class="table table-sm" id="tabla_detall_pagos">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Fecha</th>
                  <th>Cant. Horas</th>
                  <th>Monto($)</th>
                  <th>Año</th>
                  
                </tr>
              </thead>
              <tbody>
               <tbody id="tbody_tabla_detall_pagos"></tbody>
               <tr>
                    <td class="text-info"><strong>Total: </strong></td>
                    <td ></td>
                    <td ></td>
                    <td  id="total_acumulado">0</td>
                  </tr>
            </table>
         
          </div>
          
           <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-primary" id="btnregister" onclick="capturarCodigosSeleccionados()">Registro</button>
          </div>
       
      </div>
    </div>
  </div>
  </div>

  


<script type="text/javascript">
 $(document).ready(function() {
   PagosHorasExtraPersonal();  
    });

function capturarValor(checkbox) {
      if (checkbox.checked) {
        var valor = checkbox.value;
        console.log("Valor capturado:", valor);
      }
    }



    </script>