<?php get_header() ?>

<?php $coachs = get_terms(['taxonomy' => 'coach']); ?>
<ul class="nav nav-pills my-4">
  <?php foreach($coachs as $coach): ?>
  <li class="nav-item">
    <a href="<?= get_term_link($coach) ?>" class="nav-link <?= is_tax('coach', $coach->term_id) ? 'active' : ''?>"><?= $coach->name ?></a>
    </li>
<?php endforeach; ?>
</ul>


<?php get_footer() ?>