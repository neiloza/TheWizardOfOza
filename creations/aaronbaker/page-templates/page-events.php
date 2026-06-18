<?php
/**
 * Template Name: Events
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Campaign Events</h1>
        <p>Meet Aaron, hear his vision, and join fellow supporters across Florida's 6th District.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <h2 style="margin-bottom: 24px;">Upcoming Events</h2>
        <div class="events-full-list">
            <?php
            $events = ab_get_upcoming_events( 20 );
            if ( $events->have_posts() ) :
                while ( $events->have_posts() ) : $events->the_post();
                    $date_parts = ab_format_event_date( get_the_ID() );
                    $time       = get_post_meta( get_the_ID(), '_event_time', true );
                    $end_time   = get_post_meta( get_the_ID(), '_event_end_time', true );
                    $location   = get_post_meta( get_the_ID(), '_event_location', true );
                    $address    = get_post_meta( get_the_ID(), '_event_address', true );
                    $rsvp_url   = get_post_meta( get_the_ID(), '_event_rsvp_url', true );
            ?>
                <div class="event-full-card">
                    <div class="event-date-block">
                        <span class="event-month"><?php echo esc_html( $date_parts['month'] ); ?></span>
                        <span class="event-day"><?php echo esc_html( $date_parts['day'] ); ?></span>
                    </div>
                    <div class="event-info">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="event-details">
                            <span>📅 <?php echo esc_html( $date_parts['day_name'] . ', ' . $date_parts['full'] ); ?></span>
                            <?php if ( $time ) : ?>
                                <span>🕐 <?php echo esc_html( date( 'g:i A', strtotime( $time ) ) ); ?><?php echo $end_time ? ' – ' . esc_html( date( 'g:i A', strtotime( $end_time ) ) ) : ''; ?></span>
                            <?php endif; ?>
                            <?php if ( $location ) : ?>
                                <span>📍 <?php echo esc_html( $location ); ?><?php echo $address ? ', ' . esc_html( $address ) : ''; ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ( has_excerpt() ) : ?>
                            <p><?php the_excerpt(); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="event-rsvp">
                        <?php if ( $rsvp_url ) : ?>
                            <a href="<?php echo esc_url( $rsvp_url ); ?>" class="btn btn--primary btn--sm" target="_blank" rel="noopener">RSVP</a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm">Details</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div style="text-align: center; padding: 60px 24px; background: var(--off-white); border-radius: var(--radius-lg);">
                    <h3 style="margin-bottom: 12px;">Events Coming Soon</h3>
                    <p style="color: var(--text-mid); max-width: 500px; margin: 0 auto 24px;">We're planning campaign events across the district. Sign up for email updates to be the first to know.</p>
                    <a href="#join" class="btn btn--primary">Get Notified</a>
                </div>
            <?php endif; ?>
        </div>

        <?php
        // Past events
        $past_events = new WP_Query( array(
            'post_type'      => 'ab_event',
            'posts_per_page' => 5,
            'meta_key'       => '_event_date',
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
            'meta_query'     => array(
                array(
                    'key'     => '_event_date',
                    'value'   => date( 'Y-m-d' ),
                    'compare' => '<',
                    'type'    => 'DATE',
                ),
            ),
        ) );
        if ( $past_events->have_posts() ) :
        ?>
            <h2 style="margin-top: 60px; margin-bottom: 24px; color: var(--text-light);">Past Events</h2>
            <div class="events-full-list" style="opacity: 0.7;">
                <?php while ( $past_events->have_posts() ) : $past_events->the_post();
                    $date_parts = ab_format_event_date( get_the_ID() );
                    $location   = get_post_meta( get_the_ID(), '_event_location', true );
                ?>
                    <div class="event-full-card" style="border-color: var(--border-light);">
                        <div class="event-date-block" style="background: var(--text-light);">
                            <span class="event-month"><?php echo esc_html( $date_parts['month'] ); ?></span>
                            <span class="event-day"><?php echo esc_html( $date_parts['day'] ); ?></span>
                        </div>
                        <div class="event-info">
                            <h3><?php the_title(); ?></h3>
                            <div class="event-details">
                                <span>📅 <?php echo esc_html( $date_parts['full'] ); ?></span>
                                <?php if ( $location ) : ?><span>📍 <?php echo esc_html( $location ); ?></span><?php endif; ?>
                            </div>
                        </div>
                        <div class="event-rsvp"><span class="btn btn--sm" style="background:var(--border);color:var(--text-light);cursor:default;">Completed</span></div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>

        <!-- Request Aaron at Your Event -->
        <div class="request-event-form">
            <h2>Request Aaron at Your Event</h2>
            <p>Have a community gathering, town hall, or organization meeting? Invite Aaron to speak.</p>
            <form id="requestEventForm" class="form-grid">
                <div class="form-group">
                    <label for="req-name">Your Name *</label>
                    <input type="text" id="req-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="req-email">Email *</label>
                    <input type="email" id="req-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="req-org">Organization</label>
                    <input type="text" id="req-org" name="organization">
                </div>
                <div class="form-group">
                    <label for="req-date">Preferred Date</label>
                    <input type="date" id="req-date" name="date">
                </div>
                <div class="form-group form-group--full">
                    <label for="req-details">Event Details *</label>
                    <textarea id="req-details" name="message" required placeholder="Tell us about your event — type, expected attendance, location, etc."></textarea>
                </div>
                <div class="form-group form-group--full">
                    <button type="submit" class="btn btn--primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
