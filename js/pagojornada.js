


var tablehertra; 
function PagosJornadasMensualesPersonal(){

	  tablehertra=$('#tabla_pagos_jornadas').DataTable({
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
	      "url": "../Controller/pagojornada/ControllerGetPersonasOn.php",
	      type: 'POST'
	    },
	    "columns": [
	    { "data": null,"render": function (data, type, row, meta) {return meta.row + 1; }},
	    { "data": "idpersona"},
	     {"data": null, "render": function (data, type, row) {return row.Nombre + ' ' + row.Apellidos;}},
	     { "data": "Dni"},
	    { "data": "Salario"},
	    { "data": "FechaInicio"},
	    { "data": "fechapago"},
	    { "data": "EstadoCuenta",
	      render: function(data, type, row) {
	        if (data == 'Pagado') {
	          return "<span class='badge badge-pill badge-primary'>" + data + "</span>";
	        } 
          if (data == 'Deuda') {
            return "<span class='badge badge-pill badge-danger'>" + data + "</span>";
          }
          if (data == 'Procesando...') {
            return "<span class='badge badge-pill badge-warning'>" + data + "</span>";
          }
	      }
	    } ,{
	      "defaultContent": "<button  class='pagarjornada btn btn-primary btn-sm' title='Pagar'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"+
        "&nbsp;<button  class='Imprimir btn btn-secondary btn-sm' title='imprimir'><i class='fa fa-print' aria-hidden='true'></i></button>"

	    }],
	    "language": idioma_espanol,
	    select: true
	  });
	  document.getElementById("tabla_pagos_jornadas_filter").style.display = "none";
	  $('input.global_filter').on('keyup click', function() {
	    filterGlobal();
	  });
	  tablehertra.column( 1 ).visible( false );
	}
function filterGlobal() {
	  $('#tabla_pagos_jornadas').DataTable().search($('#global_filter').val(), ).draw();
}

$('#tabla_pagos_jornadas').on('click', '.pagarjornada', function() {
	  var data = tablehertra.row($(this).parents('tr')).data();

	  if (tablehertra.row(this).child.isShown()) {
	    var data = tablehertra.row(this).data();
	  }
	  var idpersona= data.idpersona;
    var fecha= data.FechaInicio;
	  

	   $("#modapagosjornadas").modal({
	      backdrop: 'static',
	        keyboard: false
	    })

	    $("#ipersonaspagos").val(idpersona);
      $("#fechadeultimopago").val(fecha);
      $("#htmlpago").html(fecha);
	    $("#tbody_tabla_detall_pagos").html('');
           reseterDtaModal();
          cargarComboMeses();
	    $('#modapagosjornadas').modal('show');
	 
	});

function cargarComboMeses(){
	var mesSelect = document.getElementById('mesSelect');
	 // Cargamos los meses del año desde un array
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    // Creamos las opciones del select a partir del array de meses
    for (var i = 0; i < meses.length; i++) {
      var option = document.createElement('option');
      option.value = meses[i];
      option.text = meses[i];
      mesSelect.appendChild(option);
    }
}




var mesesNumeros = {
  'Enero': '01',
  'Febrero': '02',
  'Marzo': '03',
  'Abril': '04',
  'Mayo': '05',
  'Junio': '06',
  'Julio': '07',
  'Agosto': '08',
  'Septiembre': '09',
  'Octubre': '10',
  'Noviembre': '11',
  'Diciembre': '12'
};


var totalAcumulado = 0;
var yearAjustado;
var cambio=false;
var contador=1;

function AgregarMesSeleccionadoTable() {
  var mesSelect = document.getElementById('mesSelect');
  var montoInput = document.getElementById('montoInput');

  var mesSeleccionado = mesSelect.value;
  var monto = montoInput.value;
  if(!mesSeleccionado){ return;}

//FECHA DEL ULTIMO PAGO///
var fechpagado = $("#fechadeultimopago").val();
if (validarFormatoFecha(fechpagado)) {
  var parts = fechpagado.split('-');
  var day = parseInt(parts[2]);
  var month = mesesNumeros[mesSeleccionado];
  var year = parseInt(parts[0]);
} else {
  // La fecha no tiene el formato esperado, muestra un mensaje de error o realiza alguna acción adicional
  return Swal.fire("Mensaje de error", "La fecha no tiene el formato esperado."+fechpagado, "error");
}


if (month == 12 && mesSeleccionado == "Diciembre"/*&& day >= 31*/) {
  cambio = true;
} else if (yearAjustado == undefined) {
  yearAjustado = year;
}

cambio && month != 12 && (yearAjustado++, cambio = false);
fecha = yearAjustado + '-' + (month.toString().padStart(2, '0')) + '-' + day.toString().padStart(2, '0');




if (validarFormatoFecha(fecha) && validarFormatoFecha(fechpagado)) {
 if (fecha <= fechpagado) {
  return Swal.fire("Mensaje de advertencia", "Las fechas a pagar deben ser mayor a: "+fechpagado+".", "warning");

} else {
  //aqui continua normal
}

}else {
  return Swal.fire("Mensaje de error", "Una o ambas fechas tienen un formato incorrecto."+fechpagado+" <=> "+fecha, "error");

}

  // Verificar si la fecha ya está agregada en la tabla
  var existeFecha = verificarfecha(fecha);
  if (existeFecha) {
   
     return Swal.fire("Mensaje de advertencia", "La fecha: "+fecha+" ya está agregada en la tabla.", "warning");
  }

  if (mesSeleccionado && monto) {
    var html = "";
    html += "<tr>";
    html += "<td>"+contador+"</td>";
    html += "<td>" + mesSeleccionado + "</td>";
    html += "<td>"+ fecha +"</td>";
    html += "<td>1</td>";
    html += "<td>" + monto + "</td>";
    html += "<td><button class='btn btn-sm' onclick='remove(this)'><em class='fa fa-times'></em></button></td>";
    html += "</tr>";
    $('#tbody_tabla_detall_pagos').append(html);

 
        totalAcumulado += parseFloat(monto);
     
      // Obtener el elemento checkbox por su ID
       var checkbox = document.getElementById('adelantos');
      // Verificar si está marcado
       if (checkbox.checked) {
          var adicionaltotal = parseFloat($('#total_adelantos').text());
            totalAcumulado -=adicionaltotal;
            // $('#total_acumulado').text((totalAcumulado - parseFloat(adicionaltotal)).toFixed(2));
         }

           var extra = document.getElementById('horasextras');
        if (extra.checked) {
          var add = parseFloat($('#total_horas_extras').text()); 
           totalAcumulado += add;
       }

       $('#total_acumulado').text((totalAcumulado ).toFixed(2));

       mesSelect.value = "";
       montoInput.value = "";

       contador++; // Incrementar el contador

    // Actualizar el número de filas en la tabla
    var filas = $('#tbody_tabla_detall_pagos tr');
    filas.each(function (index) {
      $(this).find('td:first').text(index + 1);
    });

    
  }
}

function actualizarColunatotal(){
  $('#total_acumulado').text('');
  var totaltemporal = 0;
   // Actualizar el número de filas en la tabla
    var filas = $('#tbody_tabla_detall_pagos tr');
    filas.each(function () {
     var monto = parseFloat($(this).find('td:eq(4)').text());

     if (!isNaN(monto)) {
        totaltemporal += monto;
     }
  
     });


     var adelt = document.getElementById('adelantos');
      // Verificar si está marcado
       if (adelt.checked) {
          var add = parseFloat($('#total_adelantos').text());
             totaltemporal -= add;

       }
        var extra = document.getElementById('horasextras');
        if (extra.checked) {
          var add = parseFloat($('#total_horas_extras').text()); 
           totaltemporal += add;
       }

$('#total_acumulado').text(totaltemporal.toFixed(2));
}


function toggleincluiradelantos(e) {
     Extrae_adelantos_Persona()
      .then((montototal) => {
        MostrarTotalAdelantosPersonal(e, montototal);
        
      })
      .catch((error) => {
        console.error(error);
        // Maneja el error si ocurre
      });//
}

function toggleincluirextras(e) {
     Extrae_Horas_Extras()
      .then((montototal) => {
         MostrarTotalHorasExtrasPersonal(e, montototal);
      })
      .catch((error) => {
        console.error(error);
        // Maneja el error si ocurre
      });//
}


function MostrarTotalHorasExtrasPersonal(e, montototal){
  var totalHorasExtras = document.getElementById('total_horas_extras');
  var totalAcumulado = document.getElementById('total_acumulado');
  var montoHorasExtras = montototal;

  if (e.checked) {

    totalHorasExtras.textContent = montoHorasExtras;
    totalAcumulado.textContent = (parseInt(totalAcumulado.textContent) + montoHorasExtras).toFixed(2);
  } else {

    totalHorasExtras.textContent = '0';
    actualizarColunatotal();
    //totalAcumulado.textContent = parseInt(totalAcumulado.textContent) - montoHorasExtras;
  }
}

function MostrarTotalAdelantosPersonal(e , montototal) {
  var totalAdelantos = document.getElementById('total_adelantos');
  var totalAcumulado = document.getElementById('total_acumulado');
  var montoAdelantos = montototal;

  if (e.checked) {
   
     totalAdelantos.textContent = montoAdelantos;
     totalAcumulado.textContent = (parseInt(totalAcumulado.textContent) - montoAdelantos).toFixed(2);
  } else {
    totalAdelantos.textContent = '0';
    actualizarColunatotal();
    //totalAcumulado.textContent = parseInt(totalAcumulado.textContent) + montoAdelantos;
  }
}



function validarFormatoFecha(fecha) {
  var formatoValido = /^\d{4}-\d{2}-\d{2}$/;
  return formatoValido.test(fecha);
}



function remove(e) {
   var row = e.parentNode.parentNode;
   var monto = parseFloat(row.cells[4].innerHTML);
   row.parentNode.removeChild(row);
   totalAcumulado -= monto;
   /* var adicionaltotal = (parseFloat($('#total_adelantos').text()) || 0) + (parseFloat($('#total_horas_extras').text()) || 0);
  $('#total_acumulado').text((totalAcumulado + parseFloat(adicionaltotal)).toFixed(2));*/

  // Obtener el elemento checkbox por su ID
     
     var adelt = document.getElementById('adelantos');
      // Verificar si está marcado
       if (adelt.checked) {
          var add = parseFloat($('#total_adelantos').text());
             totalAcumulado -= add;

       }
        var extra = document.getElementById('horasextras');
        if (extra.checked) {
          var add = parseFloat($('#total_horas_extras').text()); 
           totalAcumulado += add;
       }

         $('#total_acumulado').text((totalAcumulado).toFixed(2));

  var filas = $('#tbody_tabla_detall_pagos tr');
    filas.each(function (index) {
      $(this).find('td:first').text(index + 1);
    });

}


function verificarfecha(fecha) {
  var filas = document.querySelectorAll('#tbody_tabla_detall_pagos td:nth-child(3)');
  for (var i = 0; i < filas.length; i++) {
    var fechaFila = filas[i].textContent;
    if (fechaFila === fecha) {
      return true; // La fecha ya está agregada en la tabla
    }
  }
  return false; // La fecha no está agregada en la tabla
}



function Registrar_Pagos_mensuales() {

var total= $('#total_acumulado').text();
  
if (total < 0 || total == 0) {
   alert("No hay nada que hacer");
  return;
}

  
// Verificar si los checkboxes están marcados
  var delantos = $('#adelantos').prop('checked');
  var extras = $('#horasextras').prop('checked');
  var idpersona = $('#ipersonaspagos').val();

  // Obtener los datos de la tabla
  var tablaData = [];
  $('#tbody_tabla_detall_pagos tr').each(function() {
    var filaData = {
      mesSeleccionado: $(this).find('td:nth-child(2)').text(),
      fecha: $(this).find('td:nth-child(3)').text(),
      monto: $(this).find('td:nth-child(5)').text()
    };
    tablaData.push(filaData);
  });

  // Verificar si la tablaData tiene datos antes de enviarlos
  if (tablaData.length > 0) {
    // Enviar los datos a través de una solicitud POST
    $.post('../Controller/pagojornada/ControllerRegistrarPagosMensuales.php', { 
      data: tablaData ,delantos:delantos,extras:extras,idpersona:idpersona})
      .done(function(resultado) {
        var response = JSON.parse(resultado);
        if(response.data==1){
           $('#modapagosjornadas').modal('hide');
           
          Swal.fire({icon: 'success',title: 'Éxito !!',text: response.msg,showConfirmButton: false,timer: 1500})
           tablehertra.ajax.reload();
          reseterDtaModal();


        }else{
          Swal.fire("Mensaje de error", "Se produjo un error.", "error");
        }

        // Hacer algo con la respuesta del servidor
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 403) {
          Swal.fire("Mensaje de error", "No Autorizado, Iniciar Sesión.", "error");
        } else {
          Swal.fire("Mensaje de error", errorThrown, "error");
        }
      });
  } else {
    // Mostrar un mensaje de error si no hay datos en la tablaData
    Swal.fire("Mensaje de error", "No hay datos para enviar", "error");
  }
}


function reseterDtaModal(){
  $('#adelantos').prop('checked', false);
  $('#horasextras').prop('checked', false);
  $('#mesSelect').val(0).trigger('change');
   var mesSelect = document.getElementById('mesSelect');
    mesSelect.value = "";


     var totalHorasExtras = document.getElementById('total_horas_extras');
  var totalAcumulado = document.getElementById('total_acumulado');
    totalHorasExtras.textContent = '0';
     totalAcumulado.textContent = '0';
}






function Extrae_Horas_Extras() {
  return new Promise(function(resolve, reject) {
    var idpersona = $('#ipersonaspagos').val();
    $.post('../Controller/pagojornada/ControllerShowTotaCostoExtra.php', { idpersona: idpersona })
      .done(function(resultado) {
        var response = JSON.parse(resultado);
        var montototal = response.data;
        resolve(montototal);
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 403) {
          reject("No Autorizado, Iniciar Sesión.");
        } else {
          reject(errorThrown);
        }
      });
  });
}

function Extrae_adelantos_Persona() {
  return new Promise(function(resolve, reject) {
    var idpersona = $('#ipersonaspagos').val();
    $.post('../Controller/pagojornada/ControllerShowTotalCostoAdelantos.php', { idpersona: idpersona })
      .done(function(resultado) {
        var response = JSON.parse(resultado);
        // Obtener la fecha del servidor y resolver la promesa
        var montototal = response.data;
        resolve(montototal);
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 403) {
          reject("No Autorizado, Iniciar Sesión.");
        } else {
          reject(errorThrown);
        }
      });
  });
}





//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////SECCION DE REPORTES////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

var tablevacationreport
function Listar_report_Pagos_Jornada(){
  var fechainicio = $("#FechaInicio").val();
  var fechafin = $("#FechaFin").val();

  tablevacationreport=$('#table_reporte_jornada').DataTable({
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
                 title: 'REPORTE DE PAGOS EMPLEADOS - 2023',
                titleAttr: 'Exportar a copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                 title: 'REPORTE DE PAGOS EMPLEADOS - 2023 ',
                titleAttr: 'Exportar a Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-text" aria-hidden="true"></i>',
                 title: 'REPORTE DE PAGOS EMPLEADOS - 2023',
                titleAttr: 'Exportar a PDF'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                 title: 'REPORTE DE PAGOS EMPLEADOS - 2023 ',
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
            "url": "../Controller/pagojornada/controllerGetReportPagos.php",
            type: 'POST',
            data:{fechainicio:fechainicio,fechafin:fechafin}
        },
        "columns": [
        { "data": null,"render": function (data, type, row, meta) {return meta.row + 1; }},
        { "data": "idpersona" },
        {"data": null, "render": function (data, type, row) {return row.Nombre + ' ' + row.Apellidos;}},
        { "data": "dni"},
        { "data": "montoP"},
        { "data": "Description" },
        {"data": "fechasPagados"},
        { "data": "fechaoperacion"},
        { "data": "adelantos"}

        ],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("table_reporte_jornada_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
      filterreportvacations();
        
    });
   
    tablevacationreport.column( 1 ).visible( false );
     $('#btn-place').html(tablevacationreport.buttons().container());

}

function filterreportvacations() {
  $('#table_reporte_jornada').DataTable().search($('#global_filter').val(), ).draw();
}


////////////////////////////////////////////////////
////////////////////////////////seccionde imprimi///////////
$('#tabla_pagos_jornadas').on('click', '.Imprimir', function() {
    var data = tablehertra.row($(this).parents('tr')).data();

    if (tablehertra.row(this).child.isShown()) {
      var data = tablehertra.row(this).data();
    }
    var idpersona= data.idpersona;
   
     $("#modapagosimprimir").modal({
        backdrop: 'static',
          keyboard: false
      })

      $("#idpersonaimprimir").val(idpersona);
      comboFechaspagados(idpersona);
      $('#modapagosimprimir').modal('show');
   
  });

function ImprimiReportePago(){
  var idpersona  = $("#idpersonaimprimir").val();
  var date  = $("#fechaimprimir").val();
   if (date.length==0) {
     return Swal.fire("Mensaje de advertencia", "Seleccione una Fecha para imprimir el reporte", "warning");
   }

     window.open("../public/FPDF/plantilla_factura.php?idpersona="+parseInt(idpersona)+"&date="+
      date+ "#zoom=90%","report","scrollbars=NO");

     $('#modapagosimprimir').modal('hide'); 
}


function comboFechaspagados(idpersona){
  $.post('../Controller/pagojornada/ControllerComboDatesPagados.php', { idpersona: idpersona })
      .done(function(resultado) {
        var response = JSON.parse(resultado);

        var response = JSON.parse(resultado);
        if (response) {

// Obtener fechas de operación sin repeticiones
const uniqueDates = Array.from(new Set(response.data.map(item => item.fechaoperacion)));

var cadena = "";
var identi = 'HOY';
var nameCombo = "Hoy";

// Agregar la opción predeterminada
cadena += "<option value='" + identi + "'>" + nameCombo + "</option>";

// Agregar las opciones de fechas
for (var i = 0; i < uniqueDates.length; i++) {
  cadena += "<option value='" + uniqueDates[i] + "'>" + uniqueDates[i] + "</option>";
}

// Asignar las opciones al elemento select
$("#fechaimprimir").html(cadena);

} else {
  
 $("#fechaimprimir").html(cadena);
  // Realizar acciones adicionales en caso de valor nulo o indefinido
}
        
      })
       .fail(function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 403) {
          Swal.fire("Mensaje de error", "No Autorizado, Iniciar Sesión.", "error");
        } else {
          Swal.fire("Mensaje de error", errorThrown, "error");
        }
      });
}


function ActualizarStatePagosbackgroundRunn(){
$.post('../Controller/pagojornada/ControllerbackgroundRunn.php')
      .done(function(resultado) {
        var response = JSON.parse(resultado);
         if (response==1) {
          
        } else {
          
        }
        
      })
       .fail(function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 403) {
          Swal.fire("Mensaje de error", "No Autorizado, Iniciar Sesión.", "error");
        } else {
          Swal.fire("Mensaje de error", errorThrown, "error");
        }
      });

}