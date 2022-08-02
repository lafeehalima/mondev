 <div class="card">
      <?php the_post_thumbnail('post-thumbnail',['class'=> 'card-img-top img-fluid','alt'=>'']) ?>
     <div class="card-body">
          <h6 class="card-title"><?php the_title() ?></h6>
          <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
          <ul>
          <?php
          the_terms(get_the_ID(), 'coach','<li>', '</li><li>', '</li>');
          ?>
          </ul>
         
         <a href="<?php the_permalink() ?>" class="card-link">Voir plus</a>
     </div>
 </div>