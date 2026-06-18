<?php get_header(); ?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1><?php the_title(); ?></h1>
    </div>
</section>

<section class="section-padding">
    <div class="container single-post-content">
        <div class="post-meta">
            <?php
            $cats = get_the_terms( get_the_ID(), 'news_category' );
            if ( $cats ) : ?>
                <span class="news-category"><?php echo esc_html( $cats[0]->name ); ?></span>
            <?php endif; ?>
            <span class="news-date"><?php echo get_the_date( 'F j, Y' ); ?></span>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <div style="margin-bottom: 32px; border-radius: var(--radius-lg); overflow: hidden;">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <!-- Share -->
        <div style="margin-top: 40px; padding: 24px; background: var(--off-white); border-radius: var(--radius-lg); display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
            <strong style="font-family: var(--font-accent); font-size: 0.82rem; letter-spacing: 1.5px; text-transform: uppercase;">Share:</strong>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener" class="btn btn--sm btn--outline">Facebook</a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener" class="btn btn--sm btn--outline">X / Twitter</a>
            <a href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&body=<?php echo urlencode( get_permalink() ); ?>" class="btn btn--sm btn--outline">Email</a>
        </div>

        <!-- Post Navigation -->
        <?php
        $prev = get_previous_post();
        $next = get_next_post();
        if ( $prev || $next ) :
        ?>
        <div class="post-navigation">
            <div>
                <?php if ( $prev ) : ?>
                    <a href="<?php echo get_permalink( $prev ); ?>">
                        <span class="nav-label">← Previous</span>
                        <?php echo esc_html( $prev->post_title ); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="next-post">
                <?php if ( $next ) : ?>
                    <a href="<?php echo get_permalink( $next ); ?>">
                        <span class="nav-label">Next →</span>
                        <?php echo esc_html( $next->post_title ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
