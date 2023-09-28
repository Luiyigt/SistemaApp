


function Change_password(){

var passActual = $("#txt_passActual").val();
var passNew = $("#text_passNew").val();
var pasTow = $("#text_twopass").val();

if (passActual?.length==0 || passNew?.length==0 ||pasTow?.length==0) {
 return Swal.fire("Mensaje de advertencia", "No hay nada para registrar.", "warning");
}
if ( passNew != pasTow) {

 return Swal.fire("Mensaje de advertencia","Las Claves  Son Diferentes !!.", "warning");
}

 $.ajax({
    url:'../Controller/Usuario/ControllerChangePasswordController.php',
    type:'POST',
    data:{ passActual:passActual,passNew:passNew}
   
  }).done(function(resultado){
    var resquest = JSON.parse(resultado);
    if (resquest.data>0) {

      if(resquest.data==200){
        $("#txt_passActual").val('');$("#text_passNew").val('');$("#text_twopass").val('');
        var modal = document.getElementById("modalChangePasswoed");
         modal.style.display = "none";
         Swal.fire({icon: 'success',title: 'Éxito !!',text: resquest.msg,showConfirmButton: false,timer: 1900})

      }else{
      return Swal.fire("Mensaje de error",resquest.msg, "error");
      }
 
    }else{
      
      return Swal.fire("Mensaje de error",resquest.msg, "error");
    }
}).fail(function(jqXHR, textStatus, errorThrown) {
  if (jqXHR.status === 403) {
   
    return Swal.fire("Mensaje de error", "No Autorizado"+jqXHR.url+",Iniciar Sessión.", "error");
  } else {
    
    return Swal.fire("Mensaje de error", errorThrown, "error");
  }
});
}


function SearchVlueSidebar(input){

 var searchValue = input.value.toLowerCase();

  // Obtener todos los elementos de la barra lateral que deseas buscar
  var sidebarItems = document.querySelectorAll('.app-menu__item');

  // Iterar sobre los elementos y mostrar/ocultar según el término de búsqueda
  sidebarItems.forEach(function(item) {
    var label = item.querySelector('.app-menu__label');
    if (label && label.textContent.toLowerCase().includes(searchValue)) {
      item.style.display = 'block'; // Mostrar elemento si coincide con el término de búsqueda
    } else {
      item.style.display = 'none'; // Ocultar elemento si no coincide con el término de búsqueda
    }
  });
}


function DashboardSisteme(){

 $.post('../Controller/dashboard/ControllerDashboardInfo.php')
      .done(function(resultado) {
        var response = JSON.parse(resultado);
        if(response.auth){

          $("#TotasPersonadashboard").text(response.personas);
          $("#totaldetrabajadoresdash").text(response.trabajo);
          $("#totaldeadelantosdash").text(response.adelantos);
          $("#totaldehorasextrasdash").text(response.horas);
          

          GraficoBarrasHorasExtra2d(response.hextras);
          GraficoBarrasAdelantos2d(response.dataadelantos);  


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

}

function GraficoBarrasAdelantos2d(data){

       // Obtener el elemento canvas
     var canvas = document.getElementById("barCharadelantos");

      // Obtener el contexto 2D del canvas
      var ctx = canvas.getContext("2d");

      // Crear un array con las etiquetas de los meses
     var labels = data.map(function (dato) {
     // Obtener el año y mes de la fecha
     var [anio, mes] = dato.mes.split("-");
     // Crear un objeto Date con el año y mes
     var fecha = new Date(anio, parseInt(mes) - 1); // Restar 1 al mes ya que los meses en JavaScript van de 0 a 11
     // Obtener el nombre del mes
     var nombreMes = fecha.toLocaleString("es", { month: "long" });

     return nombreMes;
     });

     // Crear un array con los valores de los montos
       var value = data.map(function (dato) {
         return dato.Monto;
       });

     // Crear el objeto de configuración del gráfico
      var config = {
        type: "bar",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Adelantos",
              data: value,
              backgroundColor: "rgba(255, 99, 132, 0.6)",
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
          plugins: {
            tooltip: {
              enabled: true,
              callbacks: {
                label: function (context) {
                  var datasetLabel = "total adelantos s/.";
                  var adelantos = context.parsed.y;
                  return datasetLabel + ": " + adelantos ;
                },
              },
            },
          },
        },

      };

      // Crear y renderizar el gráfico
      var grafico = new Chart(ctx, config);
}


function GraficoBarrasHorasExtra2d(data){

     // Obtener el elemento canvas
          var canvas = document.getElementById("barCharextras");

          // Obtener el contexto 2D del canvas
          var ctx = canvas.getContext("2d");

           // Crear un array con las etiquetas de los meses
        var labels = data.map(function (dato) {
        // Obtener el año y mes de la fecha
        var [anio, mes] = dato.mes.split("-");
        // Crear un objeto Date con el año y mes
        var fecha = new Date(anio, parseInt(mes) - 1); // Restar 1 al mes ya que los meses en JavaScript van de 0 a 11
        // Obtener el nombre del mes
        var nombreMes = fecha.toLocaleString("es", { month: "long" });

        return nombreMes;
      });

      // Crear un array con los valores de las horas extras
      var valores = data.map(function (dato) {
        return dato.valor;
      });

      // Crear el objeto de configuración del gráfico
      var config = {
        type: "bar",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Horas Extras",
              data: valores,
              backgroundColor: "rgba(75, 192, 192, 0.6)",
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
          plugins: {
            tooltip: {
              enabled: true,
              callbacks: {
                label: function (context) {
                  var datasetLabel = "total Horas Extras";
                  var horasExtras = context.parsed.y;
                  var total = data[context.dataIndex].total;

                  return datasetLabel + ": " + horasExtras + " (Total: S/. " + total + ")";
                },
              },
            },
          },
        },
      };

      // Crear y renderizar el gráfico
      var grafico = new Chart(ctx, config);
}
function startImageSlider() {
  var imageSlider = document.querySelector('.image-slider');
  if (imageSlider) {
    setInterval(function () {
      var firstImage = imageSlider.firstElementChild;
      imageSlider.style.transition = 'transform 0.5s ease-in-out';
      imageSlider.style.transform = 'translateX(-100%)';

      setTimeout(function () {
        imageSlider.appendChild(firstImage);
        imageSlider.style.transition = 'none';
        imageSlider.style.transform = 'translateX(0)';
      }, 500); // Ajusta la duración de la transición según tus necesidades
    }, 5000); // Cambia las imágenes cada 5 segundos (5000 milisegundos)
  }
}
$(document).ready(function () {
  DashboardSisteme();
  startImageSlider(); // Inicia el deslizamiento de imágenes
});