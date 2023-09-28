


////////////////////////////////////////////
///SECCION DE PAGOS HORAS EXTRA//////////////
/////////////////////////////////////////

var tablehertra; 
function PagosHorasExtraPersonal(){

	  tablehertra=$('#tabla_extras_horas').DataTable({
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
	    "pageLength": 10,
	    "destroy": true,
	    "async": false,
	    "processing": true,
	    "ajax": {
	      "url": "../Controller/pago/ControllerGetHorasExtra.php",
	      type: 'POST'
	    },
	    "columns": [
	    { "data": null,"render": function (data, type, row, meta) {return meta.row + 1; }},
	    { "data": "idepersona"},
	     {"data": null, "render": function (data, type, row) {return row.Nombre + ' ' + row.Apellidos;}},
	     { "data": "Dni"},
	    { "data": "Salario"},
	    { "data": "hextra"},
	    { "data": "total"},
	    { "data": "fechainicio"},
	    { "data": "fechafin"},
	   
	    {
	      "data": "stadohoral",
	      render: function(data, type, row) {
	        if (data == 'Pendiente') {
	          return "<span class='badge badge-pill badge-warning'>" + data + "</span>";
	        } else {
	          return "<span class='badge badge-pill badge-primary'>" + data + "</span>";
	        }
	      }
	    } ,{
	      "defaultContent": "<button  class='pagarextra btn btn-primary btn-sm' title='Pagar'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"

	    }],
	    "language": idioma_espanol,
	    select: true
	  });
	  document.getElementById("tabla_extras_horas_filter").style.display = "none";
	  $('input.global_filter').on('keyup click', function() {
	    filterGlobal();
	  });
	  tablehertra.column( 1 ).visible( false );
	}
function filterGlobal() {
	  $('#tabla_extras_horas').DataTable().search($('#global_filter').val(), ).draw();
}


var totalAcumulado = 0; // Variable global para almacenar el total acumulado
var filasSeleccionadas = []; // Array global para almacenar los códigos de las filas seleccionadas

$('#tabla_extras_horas').on('click', '.pagarextra', function() {
	  var data = tablehertra.row($(this).parents('tr')).data();

	  if (tablehertra.row(this).child.isShown()) {
	    var data = tablehertra.row(this).data();
	  }
	  var idpersona= data.idepersona;
	  filasSeleccionadas = [];
	  totalAcumulado = 0;

	   $("#modapagoshoraextra").modal({
	      backdrop: 'static',
	        keyboard: false
	    })

	   
	   // document.querySelector('#fromIncripts').reset();
	   //Subiendo al vista datos//
	    $("#idempleadoextrapago").val(idpersona);
	    $("#tbody_tabla_detall_pagos").html('');
	    $('#total_acumulado').text('');

	    ExtraerHorasExtraEmpleado(idpersona) ;
	    $('#modapagoshoraextra').modal('show');
	 
	});

function ExtraerHorasExtraEmpleado(idpersona) {
	$.ajax({
	    url:'../Controller/pago/ControllerExtraerHorasPersonao.php',
	     type:'POST',
	           data:{idpersona:idpersona}
	      }).done(function(resultado){
	      	
	        var data = JSON.parse(resultado);
           
	      	var html ="";
	        if(data.length > 0) { 
	          $.each(data, function(i, item) {
	            html += "<tr id='"+item.idhextra+"' style='cursor: pointer;' onclick='seleccionarFila(this)'>";  
	            html += "<td>" + (i + Number(1)) + "</td>";
	            html += "<td hidden>"+item.idhextra+"</td>";
	            html += "<td>" + item.fecharegistro + "</td>";
	            html += "<td>" + item.hextra + "</td>";
	            html += "<td>" + item.total + "</td>";
	            html += "<td>" + item.year + "</td>";
	            html += "</tr>";
	           });

	           $("#tbody_tabla_detall_pagos").append(html)
	          } else {
	  
	         }
	 });

}


function seleccionarFila(row) {

	  var montototal = $(row).find('td:eq(4)').text();
	  var valorMontototal = parseFloat(montototal);

	  if ($(row).hasClass('fila-seleccionada')) {
	    $(row).removeClass('fila-seleccionada');
	    totalAcumulado -= valorMontototal;
	    var index = filasSeleccionadas.indexOf(row.id);
	    if (index > -1) {
	      filasSeleccionadas.splice(index, 1);
	    }
	  } else {
	    $(row).addClass('fila-seleccionada');
	    totalAcumulado += valorMontototal;
	    filasSeleccionadas.push(row.id);
	  }

	  $('#total_acumulado').text(totalAcumulado.toFixed(2));


	}



function capturarCodigosSeleccionados() {
  var rowselectd = [];
  var idpersona =$("#idempleadoextrapago").val();

  for (var i = 0; i < filasSeleccionadas.length; i++) {
    var codigo = filasSeleccionadas[i];
    var fila = $('#' + codigo);
    var idextra = fila.find('td:eq(1)').text();
    var fecha = fila.find('td:eq(2)').text();
    var horastotal = fila.find('td:eq(3)').text();
    var montototal = fila.find('td:eq(4)').text();

    rowselectd.push({
      idextra: idextra,
      fecha:fecha,
      horastotal: horastotal,
      montototal: montototal
    });
  }


  if(rowselectd?.length>0){

    $.ajax({
	    url:'../Controller/pago/ControllerRegiterPagos.php',
	     type:'POST',
	           data:{idpersona:idpersona,rowselectd:JSON.stringify(rowselectd)}
	      }).done(function(resultado){
	      	
	        if (resultado >= 1) {
	           	  $('#modapagoshoraextra').modal('hide');
	           	  tablehertra.ajax.reload();
	        	 Swal.fire({icon: 'success',title: 'Éxito !!',text: 'Valores recibidos y procesados correctamente',showConfirmButton: false,timer: 1500})
	         
	          }else{
	          	return Swal.fire("Mensaje de error", "No se pudo completar el registro:"+resultado, "error");  
	          }
	 });

  }else {
   return Swal.fire("Mensaje de advertencia", "Campos no pueden ser ceros ni estar en blanco,almenos selecciona uno.", "warning"); 
   } 
}


//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////SECCION DE REPORTES////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////


var tlb_pagos;
function listar_Reporte_Horas_Extra(){
  var fechaInicio=$("#FechaInicio").val();
  var fechaFin=$("#FechaFin").val();

  tlb_pagos=$('#tabla_reporte_hextras').DataTable({
	    "ordering": false,
	    "bLengthChange": false,
	    "scrollCollapse": true,
	    "searching": {
	      "regex": true
	    },
	     "responsive": true,
        dom: 'Bfrtilp',
         buttons:[{
                extend:    'copy',
                text:      '<i class="fa  fa-copy"></i> ',
                 title: 'REPORTE DE PAGOS Hrs. EXTRA - 2023',
                titleAttr: 'Exportar a copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                 title: 'REPORTE DE PAGOS Hrs. EXTRA - 2023 ',
                titleAttr: 'Exportar a Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-text" aria-hidden="true"></i>',
                 title: 'REPORTE DE PAGOS Hrs. EXTRA - 2023',
                titleAttr: 'Exportar a PDF'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                 title: 'REPORTE DE PAGOS Hrs. EXTRA - 2023 ',
                titleAttr: 'Imprimir'
            }],
	    "lengthMenu": [
	    [10, 20, 50, 100, -1],
	    [10, 20, 50, 100, "All"]
	    ],
	    "pageLength": 10,
	    "destroy": true,
	    "async": false,
	    "processing": true,
	    "ajax": {
	      "url": "../Controller/hextra/controllerGetReporteHorasExtra.php",
	      type: 'POST',
	      data:{fechaInicio:fechaInicio,fechaFin:fechaFin}
	    },
	    "columns": [
	    { "data": null, "render": function (data, type, row, meta) { return meta.row + 1;  }},
	    { "data": "idpersona"},
	    {"data": null, "render": function (data, type, row) {return row.Nombre + ' ' + row.Apellidos;}},
	    { "data": "Dni"},
	    { "data": "fechainicio"},
	    { "data": "fechafin"},
	    { "data": "horas"},
	    { "data": "monto"},
	    { "data": "datecreated"},
	    {
	      "data": "stated",
	      render: function(data, type, row) {
	        if (data == 'Pagado') {
	          return "<span class='badge badge-pill badge-primary'>" + data + "</span>";
	        } else {
	          return "<span class='badge badge-pill badge-warning'>" + data + "</span>";
	        }
	      }
	    }
	    ,{
	      "defaultContent": "<button   class='vizualizar btn btn-secondary btn-sm'><i class='fa fa-eye' title='Vizualizar'></i></button>"

	    }],
	    "language": idioma_espanol,
	    select: true
	  });
	  document.getElementById("tabla_reporte_hextras_filter").style.display = "none";
	  $('input.global_filter').on('keyup click', function() {
	    filterGlobalReportPagos();
	  });
	  tlb_pagos.column( 1 ).visible( false );
	  $('#btn-place').html(tlb_pagos.buttons().container());

}

function filterGlobalReportPagos(){
 $('#tabla_reporte_hextras').DataTable().search($('#global_filter').val(), ).draw();

}



//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////SECCION DE REPORTES INVIVIDUALES////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////



$('#tabla_reporte_hextras').on('click', '.vizualizar', function() {

	  var data = tlb_pagos.row($(this).parents('tr')).data();

	  if (tlb_pagos.row(this).child.isShown()) {
	    var data = tlb_pagos.row(this).data();
	  }
	  var idepersona= data.idpersona;
	 
	   $("#modalreporteshoraextra").modal({
	      backdrop: 'static',
	        keyboard: false
	    })

	   ShowPagos_Horas_EXtra_Empleado(idepersona);
	    $('#modalreporteshoraextra').modal('show');
	 
	});


function ShowPagos_Horas_EXtra_Empleado(idepersona){

 var showtable =$('#tabla_show_pagos').DataTable({
	    "ordering": false,
	    "bLengthChange": false,
	    "scrollCollapse": true,
	    "searching": {
	      "regex": true
	    },
	     "responsive": true,
        dom: 'Bfrtilp',
         buttons:[
                
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                 title: 'REGIST. PAGOS Hrs. EXTRA - 2023 ',
                titleAttr: 'Exportar a Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-text" aria-hidden="true"></i>',
                 title: 'REGIST. PAGOS Hrs. EXTRA - 2023',
                titleAttr: 'Exportar a PDF'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                 title: 'REGIST. PAGOS Hrs. EXTRA - 2023 ',
                titleAttr: 'Imprimir'
            }],
	    "lengthMenu": [
	    [10, 20, 50, 100, -1],
	    [10, 20, 50, 100, "All"]
	    ],
	    "pageLength": 10,
	    "destroy": true,
	    "async": false,
	    "processing": true,
	    "ajax": {
	      "url": "../Controller/pago/ControllerShowGetPagosPersona.php",
	      type: 'POST',
	      data:{idepersona:idepersona}
	    },
	    "columns": [
	     { "data": null, "render": function (data, type, row, meta) {
        return meta.row + 1; // Agrega el número de registro
        }},
	     { "data": "fechas"},
	    { "data": "horas"},
	    { "data": "monto"},
	    { "data": "descripcion"},	   
	    {
	      "data": "stated",
	      render: function(data, type, row) {
	        if (data == 'Pagado') {
	          return "<span class='badge badge-pill badge-warning'>" + data + "</span>";
	        } else {
	          return "<span class='badge badge-pill badge-primary'>" + data + "</span>";
	        }
	      }
	    }
        ],
	    "language": idioma_espanol,
	    select: true
	  });
	  document.getElementById("tabla_show_pagos_filter").style.display = "none";
	  $('input.global_filter').on('keyup click', function() {
	    
	  });
}


