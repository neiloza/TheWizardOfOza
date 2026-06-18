<?php
/**
 * Template Name: Homepage
 */
get_header();

$hero_label    = get_theme_mod( 'hero_label', "Republican for Florida's 6th District" );
$hero_headline = get_theme_mod( 'hero_headline', "Fighting for the Families of Florida's 6th District" );
$hero_text     = get_theme_mod( 'hero_text', "Born in Lakeland and living in Sorrento — Aaron Baker is the only candidate who calls this district home. An America First conservative fighting for working families, local infrastructure, and accountable leadership." );
$hero_bg       = get_theme_mod( 'hero_bg_image', '' );
$winred_url    = get_theme_mod( 'winred_url', 'https://secure.winred.com/aaron-4-fl/donate-today' );
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg">
        <?php if ( $hero_bg ) : ?>
            <img src="<?php echo esc_url( $hero_bg ); ?>" alt="" loading="eager">
        <?php endif; ?>
    </div>
    <div class="container hero-content">
        <div class="hero-label"><?php echo esc_html( $hero_label ); ?></div>
        <h1><?php echo wp_kses_post( $hero_headline ); ?></h1>
        <p class="hero-text"><?php echo esc_html( $hero_text ); ?></p>
        <div class="btn-group">
            <a href="#join" class="btn btn--primary btn--lg">Join the Campaign</a>
            <a href="<?php echo esc_url( $winred_url ); ?>" class="btn btn--outline-white btn--lg" target="_blank" rel="noopener">Donate Now</a>
        </div>
    </div>
    <div class="hero-accent"></div>
    <div class="hero-stripe"></div>
</section>

<!-- ISSUES PREVIEW -->
<section class="issues-preview section-padding">
    <div class="container">
        <div class="text-center">
            <span class="section-label">Where Aaron Stands</span>
            <h2 class="section-heading">Issues That Matter to You</h2>
            <div class="divider-line divider-line--centered"></div>
        </div>
        <div class="issues-grid">
            <?php
            $issues = new WP_Query( array(
                'post_type'      => 'ab_issue',
                'posts_per_page' => 4,
                'meta_key'       => '_issue_order',
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC',
            ) );
            if ( $issues->have_posts() ) :
                while ( $issues->have_posts() ) : $issues->the_post();
                    $icon = get_post_meta( get_the_ID(), '_issue_icon', true ) ?: '📋';
            ?>
                <a href="<?php the_permalink(); ?>" class="issue-card">
                    <div class="issue-icon"><?php echo esc_html( $icon ); ?></div>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                    <span class="issue-link">Read More →</span>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback static issues
                $static_issues = array(
                    array( 'icon' => '💼', 'title' => 'Economy & Jobs', 'desc' => 'Restoring economic opportunity and fighting inflation for working families.' ),
                    array( 'icon' => '🛡️', 'title' => 'Immigration', 'desc' => 'Securing our borders and enforcing immigration laws to protect communities.' ),
                    array( 'icon' => '📚', 'title' => 'Education', 'desc' => 'Empowering parents and supporting local schools across the district.' ),
                    array( 'icon' => '🏛️', 'title' => 'Public Safety', 'desc' => 'Backing law enforcement and keeping our communities safe.' ),
                );
                foreach ( $static_issues as $si ) :
            ?>
                <a href="<?php echo esc_url( home_url( '/issues/' ) ); ?>" class="issue-card">
                    <div class="issue-icon"><?php echo esc_html( $si['icon'] ); ?></div>
                    <h3><?php echo esc_html( $si['title'] ); ?></h3>
                    <p><?php echo esc_html( $si['desc'] ); ?></p>
                    <span class="issue-link">Read More →</span>
                </a>
            <?php endforeach;
            endif;
            ?>
        </div>
        <div class="text-center" style="margin-top: 36px;">
            <a href="<?php echo esc_url( home_url( '/issues/' ) ); ?>" class="btn btn--outline">View All Issues</a>
        </div>
    </div>
</section>

<!-- WHY AARON -->
<section class="why-aaron section-padding">
    <div class="container">
        <div class="why-aaron-grid">
            <div class="why-aaron-image">
                <?php
                $about_page = get_page_by_title( 'About' );
                if ( $about_page && has_post_thumbnail( $about_page->ID ) ) :
                    echo get_the_post_thumbnail( $about_page->ID, 'about-photo' );
                else :
                ?>
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--navy);color:white;font-family:var(--font-heading);font-size:2rem;">AB</div>
                <?php endif; ?>
            </div>
            <div>
                <span class="section-label">Why Aaron?</span>
                <h2 class="section-heading">A Neighbor, Not a Politician</h2>
                <div class="divider-line"></div>
                <p class="section-intro" style="margin-bottom: 32px;">Aaron Baker isn't a career politician or an establishment pick — he's a working-class conservative who lives in the district he wants to represent. That's the difference.</p>

                <div class="value-props">
                    <div class="value-prop">
                        <div class="value-prop-number">1</div>
                        <div>
                            <h4>The Only Candidate Who Lives Here</h4>
                            <p>Born in Lakeland and living in Sorrento, Aaron is the only Republican candidate with roots in Florida's 6th District.</p>
                        </div>
                    </div>
                    <div class="value-prop">
                        <div class="value-prop-number">2</div>
                        <div>
                            <h4>America First, Always</h4>
                            <p>Aaron believes in taking care of every American before taking care of the rest of the world — that's not a slogan, it's a governing principle.</p>
                        </div>
                    </div>
                    <div class="value-prop">
                        <div class="value-prop-number">3</div>
                        <div>
                            <h4>Grassroots, Not Establishment</h4>
                            <p>No corporate PAC money. No establishment strings. Aaron's campaign is powered by everyday people who want real representation.</p>
                        </div>
                    </div>
                    <div class="value-prop">
                        <div class="value-prop-number">4</div>
                        <div>
                            <h4>Proven Community Commitment</h4>
                            <p>From working with Scott Presler's Early Vote Action to showing up at every local event, Aaron doesn't just talk — he shows up.</p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 32px;">
                    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn--secondary">Learn More About Aaron</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LATEST NEWS -->
<section class="latest-news section-padding">
    <div class="container">
        <div class="text-center">
            <span class="section-label">Latest Updates</span>
            <h2 class="section-heading">News & Press</h2>
            <div class="divider-line divider-line--centered"></div>
        </div>
        <div class="news-grid">
            <?php
            $news = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
            ) );
            if ( $news->have_posts() ) :
                while ( $news->have_posts() ) : $news->the_post();
                    $cats = get_the_terms( get_the_ID(), 'news_category' );
                    $cat_name = $cats ? $cats[0]->name : 'News';
            ?>
                <article class="news-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="news-card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'news-card' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="news-card-body">
                        <div class="news-meta">
                            <span class="news-category"><?php echo esc_html( $cat_name ); ?></span>
                            <span class="news-date"><?php echo get_the_date(); ?></span>
                        </div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="news-card" style="grid-column: 1 / -1; text-align: center; padding: 60px;">
                    <p style="color: var(--text-mid);">Campaign news and press releases will appear here. Check back soon for the latest updates.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center" style="margin-top: 36px;">
            <a href="<?php echo esc_url( home_url( '/newsroom/' ) ); ?>" class="btn btn--outline">View All News</a>
        </div>
    </div>
</section>

<!-- EVENTS PREVIEW -->
<section class="events-preview section-padding">
    <div class="container">
        <div class="text-center">
            <span class="section-label">On the Trail</span>
            <h2 class="section-heading">Upcoming Events</h2>
            <div class="divider-line divider-line--centered"></div>
        </div>
        <div class="events-list">
            <?php
            $events = ab_get_upcoming_events( 3 );
            if ( $events->have_posts() ) :
                while ( $events->have_posts() ) : $events->the_post();
                    $date_parts = ab_format_event_date( get_the_ID() );
                    $time       = get_post_meta( get_the_ID(), '_event_time', true );
                    $location   = get_post_meta( get_the_ID(), '_event_location', true );
                    $rsvp_url   = get_post_meta( get_the_ID(), '_event_rsvp_url', true );
            ?>
                <div class="event-item">
                    <div class="event-date-block">
                        <span class="event-month"><?php echo esc_html( $date_parts['month'] ); ?></span>
                        <span class="event-day"><?php echo esc_html( $date_parts['day'] ); ?></span>
                    </div>
                    <div class="event-info">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="event-details">
                            <?php if ( $time ) : ?>
                                <span>🕐 <?php echo esc_html( date( 'g:i A', strtotime( $time ) ) ); ?></span>
                            <?php endif; ?>
                            <?php if ( $location ) : ?>
                                <span>📍 <?php echo esc_html( $location ); ?></span>
                            <?php endif; ?>
                        </div>
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
                <div style="text-align: center; padding: 40px; color: var(--text-mid);">
                    <p>New events are being planned. Check back soon or sign up for email updates to get notified.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center" style="margin-top: 36px;">
            <a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="btn btn--outline">View All Events</a>
        </div>
    </div>
</section>

<!-- DONATE BANNER -->
<section class="donate-section section-padding" id="donate">
    <div class="container">
        <div class="donate-content" style="max-width: 600px;">
            <span class="section-label" style="color: var(--white);">Support the Campaign</span>
            <h2>Every Dollar Fuels the Fight</h2>
            <p>Your contribution goes directly toward grassroots outreach, local events, and the resources needed to win Florida's 6th District. Aaron's campaign is powered by people — not PACs.</p>
            <div class="donate-buttons">
                <a href="<?php echo esc_url( get_theme_mod( 'winred_url', 'https://secure.winred.com/aaron-4-fl/donate-today' ) ); ?>" class="btn btn--outline-white btn--lg" target="_blank" rel="noopener">Donate via WinRed</a>
                <a href="<?php echo esc_url( get_theme_mod( 'anedot_url', 'https://secure.anedot.com/aaron-4-fl/donate' ) ); ?>" class="btn btn--gold btn--lg" target="_blank" rel="noopener">Donate via Anedot</a>
            </div>
        </div>
    </div>
</section>

<!-- VOLUNTEER SIGNUP -->
<section class="section-padding bg-off-white" id="join">
    <div class="container text-center">
        <span class="section-label">Get Involved</span>
        <h2 class="section-heading">Join the Campaign</h2>
        <div class="divider-line divider-line--centered"></div>
        <p class="section-intro section-intro--centered" style="margin-bottom: 36px;">Whether you can knock on doors, make phone calls, or simply spread the word — your involvement makes the difference between winning and losing.</p>
        <div class="btn-group" style="justify-content: center;">
            <a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>" class="btn btn--primary btn--lg">Become a Volunteer</a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">Contact the Campaign</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
