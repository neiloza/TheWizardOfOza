<?php
/**
 * Template Name: Newsroom
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Newsroom</h1>
        <p>Press releases, media coverage, and campaign updates.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php
        // Category filter
        $terms = get_terms( array( 'taxonomy' => 'news_category', 'hide_empty' => true ) );
        if ( $terms && ! is_wp_error( $terms ) ) :
        ?>
            <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 32px;">
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn--sm <?php echo ! isset( $_GET['cat'] ) ? 'btn--primary' : 'btn--outline'; ?>">All</a>
                <?php foreach ( $terms as $term ) :
                    $active = ( isset( $_GET['cat'] ) && $_GET['cat'] === $term->slug );
                ?>
                    <a href="<?php echo esc_url( add_query_arg( 'cat', $term->slug, get_permalink() ) ); ?>" class="btn btn--sm <?php echo $active ? 'btn--primary' : 'btn--outline'; ?>"><?php echo esc_html( $term->name ); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="blog-grid">
            <?php
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'paged'          => $paged,
            );

            if ( isset( $_GET['cat'] ) ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'news_category',
                        'field'    => 'slug',
                        'terms'    => sanitize_text_field( $_GET['cat'] ),
                    ),
                );
            }

            $news = new WP_Query( $args );
            if ( $news->have_posts() ) :
                while ( $news->have_posts() ) : $news->the_post();
                    $cats = get_the_terms( get_the_ID(), 'news_category' );
                    $cat_name = $cats ? $cats[0]->name : 'News';
            ?>
                <article class="news-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="news-card-image">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'news-card' ); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="news-card-body">
                        <div class="news-meta">
                            <span class="news-category"><?php echo esc_html( $cat_name ); ?></span>
                            <span class="news-date"><?php echo get_the_date(); ?></span>
                        </div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words( get_the_excerpt(), 25 ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
                    </div>
                </article>
            <?php
                endwhile;
            else :
            ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 24px;">
                    <h3 style="margin-bottom: 12px;">No Posts Yet</h3>
                    <p style="color: var(--text-mid);">Campaign news and press releases will appear here as they're published.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php
        // Pagination
        if ( $news->max_num_pages > 1 ) :
        ?>
            <div class="pagination">
                <?php
                echo paginate_links( array(
                    'total'     => $news->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '←',
                    'next_text' => '→',
                ) );
                ?>
            </div>
        <?php endif;
        wp_reset_postdata();
        ?>

        <!-- Media Inquiries -->
        <div style="margin-top: 60px; padding: 32px; background: var(--off-white); border-radius: var(--radius-lg); text-align: center;">
            <h3 style="margin-bottom: 8px;">Media Inquiries</h3>
            <p style="color: var(--text-mid); margin-bottom: 16px;">Members of the press can reach the campaign at:</p>
            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?>" class="btn btn--outline"><?php echo esc_html( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
