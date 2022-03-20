<?php 

    require 'includes/app.php';
    
    incluirTemplate('header', $inicio = true);

    
?>
    <main class="contenedor seccion">
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
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>

            <?php 
                include 'includes/templates/anuncios.php';
            ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un acesor se colocara en contacto a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">
                        <img src="build/img/blog1.jpg" alt="Texto entrada Blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                        <p>
                            Consejos para construir la mejor terraza en el techo de tu casa
                            con los mejores materiales y ahorrando dinero.
                        </p>
                    </a>
                </div><!-- Entrada texto -->
            </article> <!-- Entrada blog -->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">
                        <img src="build/img/blog2.jpg" alt="Texto entrada Blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoracion de tu casa</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                        <p>
                            Maximisa el espacio en tu hogar con esta guía, aprende a combinar muebles y colores
                            para darle vida a tu espacio.
                        </p>
                    </a>
                </div><!-- Entrada texto -->
            </article> <!-- Entrada blog -->
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la Casa
                    que me ofrecieron cumple con todas mis expectativas. 
                </blockquote>
                <p>- NN -</p>
            </div>
        </section>
    </div>

<?php     
   incluirTemplate('footer');
?>