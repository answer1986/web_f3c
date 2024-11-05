<div id="apus-mobile-menu" class="apus-offcanvas hidden-lg hidden-md"> 
    <div class="apus-offcanvas-body">
      <img src="http://localhost:8888/wordpress_f3c/wp-content/uploads/2024/10/logo.png" alt="Logo" style="display: block; margin: 0 auto; padding-top: 10px;">

        <div class="offcanvas-head bg-primary">
            <button type="button" class="btn btn-toggle-canvas btn-danger" data-toggle="offcanvas">
                <i class="fa fa-close"></i> 
            </button>
            <strong><?php esc_html_e( 'MENU', 'tumbas' ); ?></strong>
        </div>
        <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>

        <?php
        $header = apply_filters( 'tumbas_get_header_layout', tumbas_get_config('header_type') );
        if ( $header == 'v2' ) {
        ?>

            <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                <?php
                    $args = array(
                        'theme_location' => 'topmenu',
                        'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb' => '',
                        'menu_id' => 'main-mobile-topmenu',
                        'walker' => new Tumbas_Mobile_Menu()
                    );
                    wp_nav_menu($args);
                ?>
            </nav>
        <?php } else { ?>
     
	<?php
wp_nav_menu( array(
  'theme_location' => 'menu-mobil',
  'menu_id'        => 'menu-mobil',
) );
?>




        <?php } ?>

        <?php if ( has_nav_menu( 'my-account' ) ) { ?>
            <h3 class="setting"><i class="fa fa-cog" aria-hidden="true"></i> <?php esc_html_e( 'Setting', 'tumbas' ); ?></h3>
                <?php
                    $args = array(
                        'theme_location'  => 'my-account',
                        'container_class' => '',
                        'menu_class'      => 'menu-topbar'
                    );
                    wp_nav_menu($args);
                ?>
        <?php } ?>
    </div>
</div>

<style>

#menu-mobil ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#menu-mobil li {
  border-bottom: 1px solid #ccc;
  
}
	

#menu-mobil a {
  display: block;
  padding: 10px 5px;
  text-decoration: none;
  color: #333;
}

#menu-mobil ul.sub-menu {
  display: none; /* Oculta los submenús */
  padding-left: 20px; /* Añade un margen para los submenús */
}


#menu-mobil .active > ul.sub-menu {
  display: block; /* Muestra el submenú cuando se hace clic */
}


	.menu-item-container {
    display: flex;
    align-items: center;
    padding-right: 20px;
		    justify-content: space-between;
		    line-height: 26px;
}
	

</style>

<script>
	
document.addEventListener('DOMContentLoaded', function () {
  // Seleccionamos todos los elementos con submenús
  const menuItems = document.querySelectorAll('#menu-mobil .menu-item-has-children');

  menuItems.forEach(function (menuItem) {
    // Creamos el contenedor (div) para el enlace y la flecha
    const containerDiv = document.createElement('div');
    containerDiv.classList.add('menu-item-container'); // Añadimos una clase para estilizar si es necesario

    // Movemos el enlace dentro del contenedor (div)
    const link = menuItem.querySelector('a');
    link.parentNode.insertBefore(containerDiv, link); // Insertamos el div antes del enlace
    containerDiv.appendChild(link); // Movemos el enlace dentro del contenedor

    // Creamos el elemento de la flecha
    const toggleSubmenu = document.createElement('span');
    toggleSubmenu.classList.add('toggle-submenu');
    toggleSubmenu.textContent = '▼'; // Añadimos el símbolo de la flecha

    // Insertamos la flecha dentro del contenedor
    containerDiv.appendChild(toggleSubmenu);

    // Añadimos el evento para mostrar/ocultar el submenú al hacer clic en la flecha
    toggleSubmenu.addEventListener('click', function (e) {
      e.preventDefault(); // Evitamos la acción predeterminada
      menuItem.classList.toggle('active'); // Alternar el estado del submenú

      // Cambiar el símbolo de la flecha según el estado del submenú
      if (menuItem.classList.contains('active')) {
        toggleSubmenu.textContent = '▲'; // Cambia a flecha hacia arriba
      } else {
        toggleSubmenu.textContent = '▼'; // Cambia a flecha hacia abajo
      }
    });
  });
});


document.addEventListener('DOMContentLoaded', function () {
  // Seleccionamos todos los enlaces dentro de los submenús
  const subMenuLinks = document.querySelectorAll('.sub-menu li a');

  // Recorremos todos los enlaces y eliminamos el símbolo "–"
  subMenuLinks.forEach(function (link) {
    link.textContent = link.textContent.replace('– ', ''); // Elimina el símbolo "–"
  });
});
</script>


