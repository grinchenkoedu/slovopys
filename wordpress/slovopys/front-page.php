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
    'numberposts' => 6,
    'post_type' => [['key' => '_thumbnail_id']], // thumbnail required.
    'meta_key' => 'news_main',
    'meta_value' => true
]);
$partners_category = get_category_by_slug('partners');
$partners = get_posts([
    'category' => $partners_category->term_id,
    'meta_key' => 'show_logo',
    'meta_value' => true
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
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $child->name; ?>">
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
    
    <a class="category-title" href="/partners/"><?php echo $partners_category->name; ?></a>
    <div class="partners-carousel owl-carousel">
        <?php foreach ($partners as $partner): ?>
            <a class="partners-carousel-item" href="/partners/#<?php echo $partner->post_name; ?>">
                <?php echo get_the_post_thumbnail($partner); ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="category-link">
        <a href="/partners/" class="resource-url">Сторінка партнерів</a>
    </div>
</div>

<?php get_footer(); ?>