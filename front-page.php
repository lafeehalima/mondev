<?php get_header() ?>


<?php while(have_posts()): the_post() ?>
  <?php the_content() ?>

  <a href="<?= get_post_type_archive_link('post') ?>">Voir les dernieres actualités</a>
  <?php endwhile; ?>


<?php get_footer() ?>