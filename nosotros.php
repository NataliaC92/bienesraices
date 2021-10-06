<?php 
   require 'includes/funciones.php';
        
   incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Conoce Sobre Nosotros</h2>
        <div class="nosotros">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="anuncio">
            </picture>
            <div class="contenido-nosotros">
                <span>25 Años de Experiencia</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique expedita dicta consequuntur odit! Culpa architecto molestias blanditiis, vel veniam, exercitationem porro laborum minima inventore nesciunt nobis ea delectus ut tempora?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique expedita dicta consequuntur odit! Culpa architecto molestias blanditiis, vel veniam, exercitationem porro laborum minima inventore nesciunt nobis ea delectus ut tempora?</p>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique expedita dicta consequuntur odit! Culpa architecto molestias blanditiis, vel veniam, exercitationem porro laborum minima inventore nesciunt nobis ea delectus ut tempora?</p>
            </div>
        </div>
        
    </main>
    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id eum non illum placeat adipisci exercitationem cupiditate! Ipsum aliquid amet cupiditate? Asperiores maxime ea optio in porro consectetur corrupti aliquid distinctio.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id eum non illum placeat adipisci exercitationem cupiditate! Ipsum aliquid amet cupiditate? Asperiores maxime ea optio in porro consectetur corrupti aliquid distinctio.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id eum non illum placeat adipisci exercitationem cupiditate! Ipsum aliquid amet cupiditate? Asperiores maxime ea optio in porro consectetur corrupti aliquid distinctio.</p>
            </div>
        </div>
    </section>

<?php     
   incluirTemplate('footer');
?>