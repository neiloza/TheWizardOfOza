<?php get_header(); ?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1><?php the_title(); ?></h1>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 800px;">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div style="margin-bottom: 32px; border-radius: var(--radius-lg); overflow: hidden;">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
