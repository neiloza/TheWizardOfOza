<?php get_header(); ?>

<?php
$date_parts = ab_format_event_date( get_the_ID() );
$time       = get_post_meta( get_the_ID(), '_event_time', true );
$end_time   = get_post_meta( get_the_ID(), '_event_end_time', true );
$location   = get_post_meta( get_the_ID(), '_event_location', true );
$address    = get_post_meta( get_the_ID(), '_event_address', true );
$rsvp_url   = get_post_meta( get_the_ID(), '_event_rsvp_url', true );
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1><?php the_title(); ?></h1>
        <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 16px; color: rgba(255,255,255,0.8);">
            <span>📅 <?php echo esc_html( $date_parts['day_name'] . ', ' . $date_parts['full'] ); ?></span>
            <?php if ( $time ) : ?>
                <span>🕐 <?php echo esc_html( date( 'g:i A', strtotime( $time ) ) ); ?><?php echo $end_time ? ' – ' . esc_html( date( 'g:i A', strtotime( $end_time ) ) ) : ''; ?></span>
            <?php endif; ?>
            <?php if ( $location ) : ?>
                <span>📍 <?php echo esc_html( $location ); ?></span>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 800px;">
        <?php if ( has_post_thumbnail() ) : ?>
            <div style="margin-bottom: 32px; border-radius: var(--radius-lg); overflow: hidden;">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <?php if ( $address ) : ?>
            <div style="margin-top: 32px; padding: 24px; background: var(--off-white); border-radius: var(--radius-lg);">
                <h4 style="margin-bottom: 8px;">📍 Location</h4>
                <p style="color: var(--text-mid);">
                    <?php echo esc_html( $location ); ?><br>
                    <?php echo esc_html( $address ); ?>
                </p>
                <a href="https://maps.google.com/?q=<?php echo urlencode( $address ); ?>" target="_blank" rel="noopener" class="btn btn--outline btn--sm" style="margin-top: 12px;">Get Directions</a>
            </div>
        <?php endif; ?>

        <?php if ( $rsvp_url ) : ?>
            <div style="margin-top: 32px; text-align: center;">
                <a href="<?php echo esc_url( $rsvp_url ); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener">RSVP for This Event</a>
            </div>
        <?php endif; ?>

        <div style="margin-top: 40px; text-align: center;">
            <a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="btn btn--outline">← Back to All Events</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
