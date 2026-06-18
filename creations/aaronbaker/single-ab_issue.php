<?php get_header(); ?>

<?php
$icon      = get_post_meta( get_the_ID(), '_issue_icon', true ) ?: '📋';
$problem   = get_post_meta( get_the_ID(), '_issue_problem', true );
$position  = get_post_meta( get_the_ID(), '_issue_position', true );
$proposals = get_post_meta( get_the_ID(), '_issue_proposals', true );
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1><span style="margin-right: 12px;"><?php echo esc_html( $icon ); ?></span><?php the_title(); ?></h1>
        <?php if ( has_excerpt() ) : ?>
            <p><?php the_excerpt(); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="display: grid; grid-template-columns: 1fr 300px; gap: 60px; align-items: start;">
        <div class="issue-single-content">
            <?php if ( $problem ) : ?>
                <div class="issue-section">
                    <h2>The Problem</h2>
                    <?php echo wpautop( esc_html( $problem ) ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $position ) : ?>
                <div class="issue-section">
                    <h2>Aaron's Position</h2>
                    <?php echo wpautop( esc_html( $position ) ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $proposals ) : ?>
                <div class="issue-section">
                    <h2>Policy Proposals</h2>
                    <ul class="policy-list">
                        <?php
                        $items = array_filter( array_map( 'trim', explode( "\n", $proposals ) ) );
                        foreach ( $items as $item ) :
                        ?>
                            <li><?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( get_the_content() ) : ?>
                <div class="issue-section entry-content">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>

            <div style="margin-top: 40px; padding: 28px; background: var(--off-white); border-radius: var(--radius-lg);">
                <h3 style="margin-bottom: 8px;">Support Aaron's Position</h3>
                <p style="color: var(--text-mid); margin-bottom: 16px;">Help spread the message and fund the fight for Florida's 6th District.</p>
                <div class="btn-group">
                    <a href="<?php echo esc_url( get_theme_mod( 'winred_url', 'https://secure.winred.com/aaron-4-fl/donate-today' ) ); ?>" class="btn btn--primary" target="_blank" rel="noopener">Donate Now</a>
                    <a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>" class="btn btn--outline">Volunteer</a>
                </div>
            </div>
        </div>

        <!-- Sidebar: All Issues -->
        <div class="issue-sidebar" style="position: sticky; top: 100px;">
            <h4>All Issues</h4>
            <ul>
                <?php
                $all_issues = new WP_Query( array(
                    'post_type'      => 'ab_issue',
                    'posts_per_page' => -1,
                    'meta_key'       => '_issue_order',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'ASC',
                ) );
                while ( $all_issues->have_posts() ) : $all_issues->the_post();
                    $issue_icon = get_post_meta( get_the_ID(), '_issue_icon', true ) ?: '📋';
                    $is_current = ( get_the_ID() === get_queried_object_id() );
                ?>
                    <li class="<?php echo $is_current ? 'active' : ''; ?>">
                        <a href="<?php the_permalink(); ?>">
                            <span><?php echo esc_html( $issue_icon ); ?></span>
                            <?php the_title(); ?>
                        </a>
                    </li>
                <?php endwhile; wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</section>

<?php get_footer(); ?>
