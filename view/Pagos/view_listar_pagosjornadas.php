
<script type="text/javascript" src="../js/pagojornada.js?rev=<?php echo time();?>"></script>
  <div class="row">
        <div class="col-md-12">
          <div class="tile" style="border-radius: 5px;padding: 10px;">
           <div class="tile-body">
              <ul class="nav nav-pills flex-column mail-nav">
                <li class="nav-item active">
                  <i class="fa fa-home fa-lg"></i> / Pagos Jornadas
                  
                  
              
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
       <h5 class="" ><strong>Pagos Jornadas mensuales - <?php echo date("Y"); ?></strong></h5>
     </div>
     <div class="col-sm-6">
     <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar"  style="border-radius: 5px;">
        <span class="input-group-addon"></span>
      </div>
   </div>
 </div>

 <table id="tabla_pagos_jornadas" class="display responsive nowrap table table-sm" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Nombre y Apellido</th>
                        <th>Dni</th>
                        <th>Salario</th>
                        <th>Fecha Últ. Pago</th>
                        <th>Fecha Prox. Pago</th>
                        <th>Estado cuenta</th>       
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
                       
                    </tr>
                </tfoot>
         
                </table>

</div>
</div>
</div>

 <style>
   .container {
      display: flex;
      
    }

    .container input,
    .container select {
      margin-right: 10px;
    }
  </style>


 <div class="modal fade" id="modapagosjornadas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Pagos Jornadas mensuales <?php echo date("Y"); ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 

        <div class="row invoice-info">
             <div class="col-sm-4">

               <div class="container">
                <div class="toggle">
                   <label class="col-form-label" for="inputDefault"><strong>Adelantos</strong></label>
                  <label>
                    <input type="checkbox" id="adelantos" onclick="toggleincluiradelantos(this)" ><span class="button-indecator"></span>
                  </label>
                </div>
                <div class="toggle">
                   <label class="col-form-label" for="inputDefault"><strong>H. Extras</strong></label>
                  <label>
                    <input type="checkbox" id="horasextras" onclick="toggleincluirextras(this)" ><span class="button-indecator"></span>
                  </label>
                </div>
               </div>
            </div>
            <div class="col-sm-4">
             
              <div class="form-group">
                <select class="form-control" id="mesSelect">
                    <option value="">---Seleccione Mes---</option>
                  </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                   
                    <div class="alin_global" style="display: flex;" >
                   <input class="form-control" type="number" id="montoInput" placeholder=" S/. Monto">&nbsp;&nbsp;
                   <a class="btn  btn-secondary btn-sm" style="font-size: 15px;height: 35px;" onclick="AgregarMesSeleccionadoTable()"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                </div>
              </div>
          </div>
          
        </div>
          <div class="bs-component" >Últipo pago realizado :<span class="badge badge-primary" id="htmlpago"></span></div> <br>
         <input type="date" name="" id="fechadeultimopago" hidden >
           <input type="text" name="" id="ipersonaspagos" hidden>

            <table class="table table-sm" id="tabla_detall_pagos">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Mes Seleccionado</th>
                  <th>Fecha</th>
                  <th>Cantida</th>
                  <th>Monto($)</th>
                  <th>Quitar</th>
                </tr>
              </thead>
              <tbody>
               <tbody id="tbody_tabla_detall_pagos"></tbody>
               
                <tr>
                    <td class=""><strong>Total Adelantos: </strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="total_adelantos">0</td>
                </tr>
                <tr>
                    <td class=""><strong>Total Horas Extras: </strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="total_horas_extras">0</td>
                </tr>
                <tr>
                   <td class=""><strong>Total Pagar: </strong></td>
                   <td ></td>
                   <td ></td>
                   <td ></td>
                   <td  id="total_acumulado">0</td>

                </tr>
            </table>
          </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-primary" id="btnregister" onclick="Registrar_Pagos_mensuales()">Registro</button>
          </div>
       
      </div>
    </div>
  </div>
  </div>



   <div class="modal fade" id="modapagosimprimir" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Imprir Pagos realizado <?php echo date("Y"); ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
         <input  id="idpersonaimprimir" type="text" hidden>
          <div class="form-group">
            <label for="exampleSelect1"><strong>Seleccione Fecha</label>

              <select class="form-control" id="fechaimprimir">
               
               
              </select>
            </div>
           
         
          </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-primary" id="btnregister"  onclick="ImprimiReportePago()"><i class="fa fa-print" aria-hidden="true"></i>Imprimir Pagos</button>
          </div>
       
      </div>
    </div>
  </div>
  </div>

  


<script type="text/javascript">
 $(document).ready(function() {
  ActualizarStatePagosbackgroundRunn();
   PagosJornadasMensualesPersonal();  
    });



    </script>