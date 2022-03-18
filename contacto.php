<?php 
   require 'includes/app.php';
        
   incluirTemplate('header');
?>

    <main class="contenedor seccion componente-centrado">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
        </picture>

        <h2>Llene el Formulario de contacto</h2>
        <form action="" class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-Mail</label>
                <input type="email" placeholder="Tu E-Mail" id="email">

                <label for="telefono">Telèfono</label>
                <input type="tel" placeholder="Tu Telèfono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea  id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informaciòn de la Propiedad</legend>

                <label for="opciones">Vende o Compra</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccionar --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como Desea ser contactado:</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telèfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si Selecciono Telèfono elegir Fecha y Hs:</p>

                <label for="fecha">Fecha</label>
                <input type="date"  id="fecha">

                <label for="hora">Hora</label>
                <input type="time"  id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

<?php 
   incluirTemplate('footer');
?>