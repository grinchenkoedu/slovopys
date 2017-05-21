<?php
/**
 * Slovopys theme functions
 * 
 * @package slovopys_wp
 * @copyright (c) 2017, Yevhen Matasar <matasar.ei@gmail.com>
 */

/* theme init */
add_action('wp_enqueue_scripts', 'sowp_theme_sns');
add_action('init', 'sowp_theme_init');

/**
 * Register styles and scripts
 */
function sowp_theme_sns() {
    $template_uri = get_stylesheet_directory_uri();
    
    // general styles.
    wp_enqueue_style('bootstrap', "{$template_uri}/css/bootstrap.css");
    wp_enqueue_style('bootstrap-theme', "{$template_uri}/css/bootstrap-theme.css");
    
    // fonts and icons.
    wp_enqueue_style('font-roboto', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;subset=cyrillic,latin');
    
    // custom styles.
    wp_enqueue_style('style', get_stylesheet_uri());
    
    // legacy scripts.
    /*wp_enqueue_script('html5', "{$template_uri}/js/html5.min.js");
    wp_script_add_data('html5', 'conditional', 'lt IE 9');
    wp_enqueue_script('respound', "{$template_uri}/js/respound.min.js");
    wp_script_add_data('respound', 'conditional', 'lt IE 9');*/
    
    // general scripts.
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', "{$template_uri}/js/bootstrap.min.js");
    
    // custom scripts.
    wp_enqueue_script('start', "{$template_uri}/js/start.js", [], false, true); //in footer.
}

/**
 * Check dependencies
 * @param string $message
 */
function sowp_dependencies($message) {
    // false means not installed or not active
    $required = [
        'advanced-custom-fields' => false
    ];
    
    // check installed and active plugins.
    foreach (array_keys(get_plugins()) as $path) {
        $name = preg_replace("/(\/.*)/", "", $path, -1);
        if (array_key_exists($name, $required) && is_plugin_active($path)) {
            $required[$name] = true;
        }
    }
    
    // Show notice about required plugins.
    foreach ($required as $plugin => $active) {
        if (!$active) {
            ?>
                <div class="error notice">
                    <p><?php _e("The {$plugin} plugin is required!", 'profi_realt'); ?></p>
                </div>
            <?php
        }
    }
}

/**
 * 
 * @param type $category
 * @param type $parent
 * @return array
 */
function sowp_get_categories($category, $parent = null) {
    $categories = get_categories(['parent' => $parent ?  $parent->term_id : $category->term_id]);
    if (!$categories) {
        return get_categories();
    }
    return $categories;
}

/**
 * Init theme properties
 */
function sowp_theme_init() {
    add_action('admin_notices', 'sowp_dependencies');
    
    register_nav_menus([
        'header-menu' => __('Header Menu'),
    ]);
    
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(640, 335, true);
}


function sowp_get_first_letters($category) {
    global $wpdb;
    $sql = "SELECT LEFT(tb_post.post_title, 1) AS name
              FROM {$wpdb->posts} AS tb_post
        INNER JOIN {$wpdb->term_relationships} AS tb_term
                ON tb_term.object_id = tb_post.id
             WHERE tb_term.term_taxonomy_id = %s
          GROUP BY name
          ORDER BY name";
    $query = $wpdb->prepare($sql, $category->term_id);
    $items = $wpdb->get_results($query);
    foreach ($items as $item) {
        $item->name = mb_strtolower($item->name);
        $item->href = "/category/{$category->slug}/?letter={$item->name}";
    }
    return $items;
}

/**
 * Filter posts with first letter
 * @global type $wpdb
 * @param string $where
 * @param type $wp_query
 * @return string
 */
function sowp_first_letter_filter($where) {
    global $wpdb;
    
    $letter = filter_input(INPUT_GET, 'letter', FILTER_SANITIZE_STRING);
    if (empty($letter)) {
        return $where;
    }
        
    $where .= " AND {$wpdb->posts}.post_title LIKE '" . esc_sql($wpdb->esc_like($letter)) . "%'";
    return $where;
}
add_filter('posts_where', 'sowp_first_letter_filter');
