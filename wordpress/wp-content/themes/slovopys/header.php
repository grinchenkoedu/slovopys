<!DOCTYPE html>
<!--
@author hc
@since 3 трав. 2017
--> 
<html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#4C2741">
        
        <?php $template_uri = get_stylesheet_directory_uri(); ?>
        <link rel="icon" href="<?php echo $template_uri ?>/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $template_uri; ?>/img/favicon/favicon-16x16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $template_uri; ?>/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $template_uri; ?>/img/favicon/favicon-96x96.png">
        <link rel="manifest" href="<?php echo $template_uri ?>/manifest.json">
        
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $template_uri; ?>/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $template_uri; ?>/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $template_uri; ?>/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $template_uri; ?>/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $template_uri; ?>/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $template_uri; ?>/img/favicon/apple-icon-180x180.png">
        
        <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
        <?php wp_head(); ?>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <a href="/" class="logo"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="logo-big">
                            <div class="slogan">
                                Українська - сучасно і своєчасно!
                                <a href="http://kubg.edu.ua">Проект Університету Грінченка</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 hidden-sm hidden-xs">
                        <div class="grinchenko"></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container menu-main" id="menu_main">
            <nav>
                <?php wp_nav_menu([
                    'theme_location' => 'header-menu', 
                    'container' => 'ul',
                    'menu_id' => 'main_menu'
                ]); ?>
            </nav>
        </div>
        <div id="#content">
