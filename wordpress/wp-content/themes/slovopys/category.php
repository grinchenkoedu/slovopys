<?php
/**
 * Category page
 * 
 * @package slovopys_wp
 * @copyright (c) 2017, Yevhen Matasar <matasar.ei@gmail.com>
 */
get_header(); 

global $wp_query;

$category = get_queried_object();
$parent = $category->parent ? get_category($category->parent): null;
$categories = sowp_get_categories($category, $parent);
?>

<div class="container with-sidebar content-category" id="page_content">
    <div class="col-md-3 col-lg-2 sidenav">
        <nav>
            <ul>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <?php if ($cat->term_id == $category->term_id): ?>
                            <span><?php echo $cat->name; ?></span>
                        <?php else: ?>
                            <a href="/category/<?php echo $cat->slug; ?>/">
                                <?php echo $cat->name; ?>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <div class="col-md-9 col-lg-10">
        <nav class="breadcrumbs">
            <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                <a href="/" itemprop="url"><span itemprop="title"><?php bloginfo() ;?></span></a>
            </div>
            <?php if ($parent): ?>
                <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/category/<?php echo $parent->slug; ?>" itemprop="url">
                        <span itemprop="title"><?php echo $parent->name ;?></span></a>
                </div>
            <?php endif; ?>
            <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                <span itemprop="title"><?php echo $category->name; ?></span>
            </div>
        </nav>
        
        <?php if (get_field('show_alphabet', "category_{$category->term_id}")): ?>
            <nav class="alphabet">
                <ul>
                    <?php foreach(sowp_get_first_letters($category) as $letter): ?>
                        <li><a href="<?php echo $letter->href ?>"><?php echo $letter->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
        
        <div class="blog-items">
        <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
                <div class="blog-item">
                    <a class="blog-title" href="<?php echo get_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                    <?php if (has_post_thumbnail()): ?>
                        <a class="blog-image <?php if (get_field('youtube_uniq')): ?>video-thumbnail<?php endif; ?>" href="<?php echo get_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    <?php elseif(get_field('youtube_uniq')): ?>
                        <div class="video-wrapper">
                            <iframe src="https://www.youtube.com/embed/<?php the_field('youtube_uniq'); ?>?rel=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                        $resource_url = get_field('resource_url'); 
                        $resource_title = get_field('resource_title'); 
                        if ($resource_url): ?>
                        <div class="clearfix"></div>
                        <a href="<?php echo $resource_url; ?>" class="resource-url resource-url--category" target="_blank">
                            <?php echo $resource_title ? $resource_title : $resource_url; ?> &#9754;
                        </a>
                    <?php endif; ?>
                        
                    <div class="blog-description"><?php the_excerpt(); ?></div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </div>
    
        <?php the_posts_pagination([
            'screen_reader_text' => ' ', //__('Posts navigation')
            'mid_size' => 2
        ]); ?>
    
</div>

<?php get_footer(); ?>