<!DOCTYPE html>
<!--
@author hc
@since 3 трав. 2017
--> 
<html>
    <head>
        <title>Slovopys project</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#4C2741">
        <meta charset="<?php bloginfo('charset'); ?>" />
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
