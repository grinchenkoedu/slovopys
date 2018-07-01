<?php
/**
 * Partners page
 * 
 * @package slovopys_wp
 * @copyright (c) 2017, Yevhen Matasar <matasar.ei@gmail.com>
 */
get_header();
$categories = get_categories();
$partners_category = get_category_by_slug('partners');
$partners = get_posts([
    'category' => $partners_category->term_id
]);
?>
<div class="container with-sidebar" id="page_content">
    <div class="col-lg-2 sidenav sidenav-md-full">
        <nav>
            <ul>
                <?php foreach (sowp_get_categories($category, $parent) as $cat): ?>
                    <?php if ($cat->slug !== 'partners'): ?>
                        <li>
                            <a href="/category/<?php echo $cat->slug; ?>/" <?php if ($cat->term_id == $category->term_id): ?>class="active"<?php endif; ?>>
                                <?php echo $cat->name; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <div class="col-lg-10">
        <nav class="breadcrumbs breadcrumbs--slim">
                <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title"><?php bloginfo() ;?></span></a>
                </div>
                <div class="breadcrumbs-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title"><?php the_title(); ?></span>
                </div>
        </nav>
        <h1 class="category-title category-title--slim"><?php echo $partners_category->name; ?></h1>
        <div class="partners-list">
            <?php foreach ($partners as $partner): ?>
                <div class="partners-item row">
                    <div class="partners-item-image col-md-4">
                        <?php echo get_the_post_thumbnail($partner); ?>
                    </div>
                    <div class="partners-item-description col-md-8">
                        <a class="partners-item-title" id="<?php echo $partner->post_name; ?>"><?php echo $partner->post_title; ?></a>
                        <div class="partners-item-text">
                            <?php echo $partner->post_content; ?>
                        </div>
                        <?php $url = get_field('url', $partner->ID); ?>
                        <?php if ($url): ?>
                            <a href="<?php echo $url; ?>" class="resource-url resource-url--partners" target="_blank">Перейти на сайт</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>