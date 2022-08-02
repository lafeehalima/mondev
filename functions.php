<?php

require_once('walker/CommentWalker.php');
require_once('options/apparence.php');
                                    

function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');

    add_image_size('post-thumbnail', 350, 215, true);
}


function montheme_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', ['popper'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', [], false, true);
    if (!is_customize_preview()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
    }
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function montheme_title_separator()
{
    return '|';
}
function montheme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}
function montheme_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}
function montheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">';

    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= 'active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}
function montheme_init()
{
    register_taxonomy('coach', ['video', 'pepite','galerie'],[
        'labels' => [
            'name' => 'Coach',
            'singular_name'     => 'Coach',
            'plural_name'       => 'Coachs',
            'search_items'      => 'Rechercher un coach',
            'all_items'         => 'Tous les coachs',
            'edit_items'        => 'Editer un coach',
            'update_item'       => 'Mettre à jour coach',
            'add_new_item'      => 'Ajouter un nouveau coach',
            'new_item_name'     => 'Ajouter un nouveau coach',
            'menu_name'         => 'Coach',
            'supports' => ['title', 'editor', 'thumbnail','comments'],
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'public' => true,
    ]);
    register_post_type('video', [
        'label' => 'Videos',
        'public' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => ['title', 'editor', 'thumbnail','comments'],
        'show_in_rest' => true,
        'has_archive' => true,
    ]);
    register_post_type('pepite',[
        'label' => 'Pépites',
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-superhero-alt',
        'supports' => ['title', 'editor', 'thumbnail','comments'],
        'show_in_rest' => true,
        'has_archive' => true,
   
        /*'labels' => [
            'name' => 'pepite',
            'singular_name'     => 'pepite',
            'plural_name'       => 'pepites',
            'search_items'      => 'Rechercher une pepite',
            'all_items'         => 'Toutes les pepites',
            'edit_items'        => 'Editer une pepite',
            'update_item'       => 'Mettre à jour pepite',
            'add_new_item'      => 'Ajouter une nouvelle pepite',
            'new_item_name'     => 'Ajouter une nouvelle pepite',
            'menu_name'         => 'Pépite',

        ],*/
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'public' => true,
    ]);
    register_post_type('galerie',[
        'label' => 'Galerie photos',
        'public' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-format-gallery',
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail','comments'],
   

        /*'labels' => [
            'name' => 'photo',
            'singular_name'     => 'photo',
            'plural_name'       => 'photo',
            'search_items'      => 'Rechercher une photo',
            'all_items'         => 'Toutes les photos',
            'edit_items'        => 'Editer une photo',
            'update_item'       => 'Mettre à jour photo',
            'add_new_item'      => 'Ajouter une nouvelle photo',
            'new_item_name'     => 'Ajouter une nouvelle photo',
            'menu_name'         => 'Photo',
            'supports' => ['title', 'editor', 'thumbnail','comments'],

        ],*/
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'public' => true,
    ]);
   
}

add_action('init', 'montheme_init');
add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('document_title_separator', 'montheme_title_separator');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');

add_filter('manage_coach_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'],
        'thumnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date']
    ];
});
 add_filter('comment_form_default_fields', function ($fields){
   $fields['email'] = <<<HTML
   <div class="form-group"><label for="email">Email</label><input class="form-control" name="email" id="email" required></div>
   HTML;
    return $fields;
 });


 function monthemeReadData() {
    $data = wp_cache_get('data', 'montheme');
    if ($data === false){
       
        $data = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'data');
        wp_cache_set('data', $data, 'montheme','60');
    }
    return $data;
 }
  if (isset($_GET['cachetest'])) {
   
  }