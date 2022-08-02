<?php get_header() ?>

<h1><?= esc_html(get_queried_object()->name) ?></h1>
<p>
    <?= esc_html(get_queried_object()->description) ?>
</p>

<?php $coachs = get_terms(['taxonomy' => 'coach']); ?>
<?php if (is_array($coachs)): ?>
<ul class="nav nav-pills my-4">
  <?php foreach($coachs as $coach): ?>
  <li class="nav-item">
    <a href="<?= get_term_link($coach) ?>" class="nav-link <?= is_tax('coach', $coach->term_id) ? 'active' : ''?>"><?= $coach->name ?></a>
    </li>
<?php endforeach; ?>
</ul>
<?php endif ?>

<?php if (have_posts()): ?>
    <div class="row">
    
    <?php while(have_posts()): the_post(); ?>
    <div class="col-sm-4">
         <?php get_template_part('parts/card','post'); ?>
</div>
      <?php endwhile ?>
</div>

  <?php montheme_pagination() ?>
  
      <?= paginate_links(); ?>
      
      
      
    <?php else: ?>
         <h1>Pas d'articles</h1>
        <?php endif; ?>

    <?php get_footer() ?>