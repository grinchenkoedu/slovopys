<?php
/**
 * Front page
 * 
 * @package slovopys_wp
 * @copyright (c) 2017, Yevhen Matasar <matasar.ei@gmail.com>
 */
get_header();
$categories = get_categories();
?>

<div class="container page-main" id="page_content">
    <?php foreach ($categories as $cat) : ?>
        <?php if (get_field('show_on_main_page', "category_{$cat->term_id}") && $cat->count): ?>
            <a class="category-title" href="/category/<?php echo $cat->slug ?>/"><?php echo $cat->name ?></a>
            <?php $children = get_categories(['parent' => $cat->term_id]); ?>
            <?php if ($children): ?>
                <div class="row">
                    <?php foreach ($children as $child): ?>
                        <?php if ($child->count): ?>
                            <div class="col-md-4 thumbnail-item">
                                <a class="category-thumbnail" href="/category/<?php echo $child->slug; ?>/">
                                    <?php $image = get_field('thumbnail', "category_{$child->term_id}"); ?>
                                    <?php if ($image): ?>
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