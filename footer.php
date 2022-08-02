</div>
    <footer>
    <?php
wp_nav_menu([
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto'
    ])
    ?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4" style="background-color:  <?= get_theme_mod('footer_background'); ?>!important">
  
  <a class="navbar-brand" href="#">
	<?php bloginfo('name') ?>
	<p class="footer-copyright">&copy;
	<?php
	echo date_i18n(
	_x( 'Y', 'copyright date format', 'montheme' )
	);
	?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
</p><!-- .footer-copyright -->
</a>

    </footer>
    <?php wp_footer() ?>
</body>
</html>