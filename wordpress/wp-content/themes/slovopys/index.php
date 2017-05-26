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
    <div class="col-lg-2 sidenav sidenav-md-full">
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
    <div class="col-lg-10">
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
        
                <div class="related">
                    <?php $related = [get_previous_post(), get_next_post()]; ?>
                    <?php foreach ($related as $post): ?>
                        <?php if ($post): ?>
                            <div class="related-post">
                                <?php if (has_post_thumbnail($post)): ?>
                                    <a class="related-post-image" href="<?php echo get_permalink($post) ?>">
                                        <?php echo get_the_post_thumbnail($post, 'thumbnail'); ?>
                                    </a>
                                <?php else: ?>
                                    <?php $post_category = sowp_get_post_category($post); ?>
                                    <a class="related-post-category" href="/category/<?php echo $post_category->slug; ?>">
                                        <?php echo $post_category->name; ?>
                                    </a>
                                <?php endif; ?>
                                <a class="related-post-title" href="<?php echo get_permalink($post) ?>">
                                    <?php echo $post->post_title; ?>
                                </a>
                                <div class="related-post-excerpt"><?php echo wp_trim_words($post->post_content, 30); ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>