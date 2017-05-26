<?php
/**
 * Front page
 * 
 * @package slovopys_wp
 * @copyright (c) 2017, Yevhen Matasar <matasar.ei@gmail.com>
 */
get_header();
$categories = get_categories();
$latest = get_posts([
    'posts_per_page' => 6,
    'meta_query' => [['key' => '_thumbnail_id']] // thumbnail required.
]);
?>

<div class="container page-main" id="page_content">
    <div class="news-carousel owl-carousel">
        <?php foreach ($latest as $post): ?>
            <div class="news-carousel-item">
                <?php echo get_the_post_thumbnail($post); ?>
                <a class="description" href="<?php echo get_permalink($post) ?>">
                    <div class="title"><?php echo $post->post_title; ?></div>
                    <div class="excerpt"><?php echo wp_trim_words($post->post_content, 20); ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php foreach ($categories as $cat) : ?>
        <?php if (get_field('show_on_main_page', "category_{$cat->term_id}") && $cat->count): ?>
            <a class="category-title" href="/category/<?php echo $cat->slug ?>/"><?php echo $cat->name ?></a>
            <?php $children = get_categories(['parent' => $cat->term_id]); ?>
            <?php if ($children): ?>
                <div class="row">
                    <?php foreach ($children as $child): ?>
                        <?php if ($child->count): ?>
                            <div class="col-md-4 col-sm-6 thumbnail-item">
                                <a class="category-thumbnail" href="/category/<?php echo $child->slug; ?>/">
                                    <?php $image = get_field('thumbnail', "category_{$child->term_id}"); ?>
                                    <?php if ($image): ?>
                                        <?php var_dump($image); ?>
                                        <img src="img/thumbnail.jpg" alt="<?php echo $child->name; ?>">
                                    <?php endif; ?>
                                    <?php if (!get_field('thumnbail_title', "category_{$child->term_id}")): ?>
                                        <div class="thumbnail-text">
                                            <span><?php echo $child->name; ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php get_footer(); ?>