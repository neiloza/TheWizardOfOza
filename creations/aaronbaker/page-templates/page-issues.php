<?php
/**
 * Template Name: Issues
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Where Aaron Stands</h1>
        <p>Clear positions on the issues that matter most to the families of Florida's 6th District.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="issues-full-grid">
            <?php
            $issues = new WP_Query( array(
                'post_type'      => 'ab_issue',
                'posts_per_page' => -1,
                'meta_key'       => '_issue_order',
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC',
            ) );
            if ( $issues->have_posts() ) :
                while ( $issues->have_posts() ) : $issues->the_post();
                    $icon = get_post_meta( get_the_ID(), '_issue_icon', true ) ?: '📋';
            ?>
                <a href="<?php the_permalink(); ?>" class="issue-full-card">
                    <div class="issue-icon-lg"><?php echo esc_html( $icon ); ?></div>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Donate CTA -->
<section class="donate-section section-padding">
    <div class="container text-center">
        <h2 style="color: var(--white);">Stand With Aaron on the Issues</h2>
        <p style="color: rgba(255,255,255,0.8); max-width: 500px; margin: 0 auto 28px;">Your support helps spread Aaron's message across Florida's 6th District.</p>
        <div class="btn-group" style="justify-content: center;">
            <a href="<?php echo esc_url( get_theme_mod( 'winred_url', 'https://secure.winred.com/aaron-4-fl/donate-today' ) ); ?>" class="btn btn--outline-white btn--lg" target="_blank" rel="noopener">Donate Now</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
