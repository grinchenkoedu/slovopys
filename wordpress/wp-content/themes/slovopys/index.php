<?php
/**
 * Post page
 * 
 * @package slovopys_wp
 * @copyright (c) 2017, Yevhen Matasar <matasar.ei@gmail.com>
 */
get_header();

$categories = get_the_category();
$category = $categories[count($categories) - 1];
$parent = $category->parent ? get_category($category->parent): null;
?>
<div class="container with-sidebar" id="page_content">
    <div class="col-md-3 col-lg-2 sidenav">
        <nav>
            <ul>
                <?php foreach (sowp_get_categories($category, $parent) as $cat): ?>
                    <li>
                        <a href="/category/<?php echo $cat->slug; ?>/" <?php if ($cat->term_id == $category->term_id): ?>class="active"<?php endif; ?>>
                            <?php echo $cat->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <div class="col-md-9 col-lg-10">
        <?php if (have_posts()) : ?>
            <nav class="breadcrumbs">
                <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title"><?php bloginfo() ;?></span></a>
                </div>
                <?php foreach($categories as $cat): ?>
                    <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="/category/<?php echo $cat->slug; ?>" itemprop="url"><span itemprop="title">
                            <?php echo $cat->name ;?></span></a>
                    </div>
                <?php endforeach; ?>
                <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title"><?php the_title(); ?></span>
                </div>
            </nav>
        
            <?php while (have_posts()) : the_post(); ?>
                <article class="blog">
                    <h1><?php the_title(); ?></h1>
                    <?php 
                        $show_thumb = get_field('content_show_thumbnail'); 
                        $has_images = preg_match("/\<img(?!.*class=.*emoji)/", get_the_content());
                    ?>
                    <?php if ($show_thumb === 'show' || ((!$show_thumb || $show_thumb === 'auto') && !$has_images)): ?>
                        <?php the_post_thumbnail('medium_large'); ?>
                    <?php endif; ?>
                    
                    <?php if (get_field('youtube_uniq')): ?>
                        <div class="video-wrapper">
                            <iframe src="https://www.youtube.com/embed/<?php the_field('youtube_uniq'); ?>?rel=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
                    
                    <?php the_content(); ?>
                </article>
        
                <?php $prev = get_previous_post(); $next = get_next_post(); ?>
                <?php if ($prev || $next): ?>
                    <div class="related">
                        <?php if ($next): ?>
                        <div class="related-post">
                            <a class="related-post-title" href="#">
                                <?php echo $next->post_title; ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>