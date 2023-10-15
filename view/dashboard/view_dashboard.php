<script type="text/javascript" src="../js/home.js?rev=<?php echo time();?>"></script>
<div class="row">
    <style>
        .inline-p {
            display: inline-block;
            margin-right: 10px;
        }

        /* Estilo para el contenedor del slider de imágenes */
        .image-slider-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .image-slider {
            display: flex;
            transition: transform 1s linear; /* Ajusta la duración de la transición según tus necesidades */
        }

        /* Estilo para las imágenes dentro del slider */
        .image-slider img {
            width: 100%;
            height: auto;
        }
        .widget-link {
            text-decoration: none;
        }

        .widget-link:hover, .widget-link:focus {
            text-decoration: none;
        }

        .widget-small {
            cursor: pointer;
        }
    </style>

    <div class="col-md-3">
        <!-- Widget Total Personal -->
        <a href="total_personal.php" class="widget-link">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Total Personal</h4>
                    <p class="inline-p">Total:</p>
                    <p class="inline-p" id="TotasPersonadashboard">0</p>
                </div>
            </div>
        </a>
    </div>

    <!-- NUEVOS WIDGETS -->
    <div class="col-md-3">
        <!-- Widget Cumpleañeros -->
        <a href="cumpleaneros.php" class="widget-link">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-birthday-cake fa-3x"></i>
                <div class="info">
                    <h4>Cumpleañeros</h4>
                    <p class="inline-p">Hoy:</p>
                    <p class="inline-p" id="CumpleanerosDashboard">0</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <!-- Widget Empleados Ausentes/Vacaciones -->
        <a href="empleados_ausentes.php" class="widget-link">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-user-times fa-3x"></i>
                <div class="info">
                    <h4>Empleados Ausentes/Vacaciones</h4>
                    <p class="inline-p">Actualmente:</p>
                    <p class="inline-p" id="AusentesDashboard">0</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="image-slider-container">
    <div class="image-slider">
        <img src="../images/goku.jpg" alt="Imagen 1">
        <img src="../images/kurapika.jpg" alt="Imagen 2">
        <img src="../images/gojo2.jpg" alt="Imagen 3">
        <img src="../images/gojo1.jpg" alt="Imagen 4">
        <img src="../images/hxh1.jpg" alt="Imagen 5">
        <img src="../images/dashboard.png" alt="Imagen 6">
        <img src="../images/hxh.jpg" alt="Imagen 7">
        <!-- Repite las imágenes que desees aquí -->
    </div>
</div>
</div>
<script>
    const slider = document.querySelector('.image-slider');
    let currentIndex = 0;

    function nextImage() {
        currentIndex = (currentIndex + 1) % slider.children.length;
        updateSlider();
    }

    function updateSlider() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    setInterval(nextImage, 5000); // Cambia de imagen cada 5 segundos (5000 milisegundos)
</script>
