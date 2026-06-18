<?php
/**
 * Aaron Baker for FL-6 Theme Functions
 *
 * @package Aaron_Baker_Theme
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'AB_THEME_VERSION', '1.0.0' );
define( 'AB_THEME_DIR', get_template_directory() );
define( 'AB_THEME_URI', get_template_directory_uri() );

// ============================================
// THEME SETUP
// ============================================
function ab_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Image sizes
    add_image_size( 'hero-large', 1920, 1080, true );
    add_image_size( 'news-card', 600, 340, true );
    add_image_size( 'about-photo', 800, 1000, true );
    add_image_size( 'gallery-thumb', 400, 300, true );

    // Menus
    register_nav_menus( array(
        'primary'   => __( 'Primary Navigation', 'aaron-baker' ),
        'footer'    => __( 'Footer Navigation', 'aaron-baker' ),
    ) );
}
add_action( 'after_setup_theme', 'ab_theme_setup' );

// ============================================
// ENQUEUE STYLES & SCRIPTS
// ============================================
function ab_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style( 'ab-google-fonts',
        'https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Source+Sans+3:wght@300;400;600;700&display=swap',
        array(), null
    );

    // Main stylesheet
    wp_enqueue_style( 'ab-style', get_stylesheet_uri(), array(), AB_THEME_VERSION );

    // Main JS
    wp_enqueue_script( 'ab-main', AB_THEME_URI . '/js/main.js', array(), AB_THEME_VERSION, true );

    wp_localize_script( 'ab-main', 'abData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'ab_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'ab_enqueue_assets' );

// ============================================
// CUSTOM POST TYPES
// ============================================
function ab_register_post_types() {

    // Events
    register_post_type( 'ab_event', array(
        'labels' => array(
            'name'               => 'Events',
            'singular_name'      => 'Event',
            'add_new_item'       => 'Add New Event',
            'edit_item'          => 'Edit Event',
            'view_item'          => 'View Event',
            'all_items'          => 'All Events',
            'search_items'       => 'Search Events',
            'not_found'          => 'No events found.',
            'menu_name'          => 'Events',
        ),
        'public'            => true,
        'has_archive'       => true,
        'rewrite'           => array( 'slug' => 'events' ),
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'         => 'dashicons-calendar-alt',
        'show_in_rest'      => true,
    ) );

    // Issues / Policy
    register_post_type( 'ab_issue', array(
        'labels' => array(
            'name'               => 'Issues',
            'singular_name'      => 'Issue',
            'add_new_item'       => 'Add New Issue',
            'edit_item'          => 'Edit Issue',
            'view_item'          => 'View Issue',
            'all_items'          => 'All Issues',
            'search_items'       => 'Search Issues',
            'not_found'          => 'No issues found.',
            'menu_name'          => 'Issues',
        ),
        'public'            => true,
        'has_archive'       => true,
        'rewrite'           => array( 'slug' => 'issues' ),
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'         => 'dashicons-clipboard',
        'show_in_rest'      => true,
    ) );

    // News Categories
    register_taxonomy( 'news_category', 'post', array(
        'labels' => array(
            'name'          => 'News Categories',
            'singular_name' => 'News Category',
            'menu_name'     => 'News Categories',
        ),
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'news-category' ),
        'show_in_rest' => true,
    ) );
}
add_action( 'init', 'ab_register_post_types' );

// ============================================
// META BOXES
// ============================================
function ab_add_meta_boxes() {
    // Event details
    add_meta_box( 'ab_event_details', 'Event Details', 'ab_event_details_cb', 'ab_event', 'normal', 'high' );
    // Issue details
    add_meta_box( 'ab_issue_details', 'Issue Details', 'ab_issue_details_cb', 'ab_issue', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ab_add_meta_boxes' );

function ab_event_details_cb( $post ) {
    wp_nonce_field( 'ab_event_meta', 'ab_event_meta_nonce' );
    $event_date     = get_post_meta( $post->ID, '_event_date', true );
    $event_time     = get_post_meta( $post->ID, '_event_time', true );
    $event_end_time = get_post_meta( $post->ID, '_event_end_time', true );
    $event_location = get_post_meta( $post->ID, '_event_location', true );
    $event_address  = get_post_meta( $post->ID, '_event_address', true );
    $event_rsvp_url = get_post_meta( $post->ID, '_event_rsvp_url', true );
    ?>
    <table class="form-table">
        <tr><th><label for="event_date">Date</label></th>
            <td><input type="date" id="event_date" name="event_date" value="<?php echo esc_attr( $event_date ); ?>" class="regular-text"></td></tr>
        <tr><th><label for="event_time">Start Time</label></th>
            <td><input type="time" id="event_time" name="event_time" value="<?php echo esc_attr( $event_time ); ?>" class="regular-text"></td></tr>
        <tr><th><label for="event_end_time">End Time</label></th>
            <td><input type="time" id="event_end_time" name="event_end_time" value="<?php echo esc_attr( $event_end_time ); ?>" class="regular-text"></td></tr>
        <tr><th><label for="event_location">Venue Name</label></th>
            <td><input type="text" id="event_location" name="event_location" value="<?php echo esc_attr( $event_location ); ?>" class="regular-text"></td></tr>
        <tr><th><label for="event_address">Address</label></th>
            <td><input type="text" id="event_address" name="event_address" value="<?php echo esc_attr( $event_address ); ?>" class="regular-text" placeholder="123 Main St, Daytona Beach, FL"></td></tr>
        <tr><th><label for="event_rsvp_url">RSVP URL</label></th>
            <td><input type="url" id="event_rsvp_url" name="event_rsvp_url" value="<?php echo esc_attr( $event_rsvp_url ); ?>" class="regular-text" placeholder="https://..."></td></tr>
    </table>
    <?php
}

function ab_issue_details_cb( $post ) {
    wp_nonce_field( 'ab_issue_meta', 'ab_issue_meta_nonce' );
    $issue_icon      = get_post_meta( $post->ID, '_issue_icon', true );
    $issue_problem   = get_post_meta( $post->ID, '_issue_problem', true );
    $issue_position  = get_post_meta( $post->ID, '_issue_position', true );
    $issue_proposals = get_post_meta( $post->ID, '_issue_proposals', true );
    $issue_order     = get_post_meta( $post->ID, '_issue_order', true );
    ?>
    <table class="form-table">
        <tr><th><label for="issue_icon">Icon (emoji or dashicon)</label></th>
            <td><input type="text" id="issue_icon" name="issue_icon" value="<?php echo esc_attr( $issue_icon ); ?>" class="regular-text" placeholder="💼"></td></tr>
        <tr><th><label for="issue_order">Display Order</label></th>
            <td><input type="number" id="issue_order" name="issue_order" value="<?php echo esc_attr( $issue_order ); ?>" class="small-text" min="0"></td></tr>
        <tr><th><label for="issue_problem">The Problem</label></th>
            <td><textarea id="issue_problem" name="issue_problem" rows="4" class="large-text"><?php echo esc_textarea( $issue_problem ); ?></textarea></td></tr>
        <tr><th><label for="issue_position">Aaron's Position</label></th>
            <td><textarea id="issue_position" name="issue_position" rows="4" class="large-text"><?php echo esc_textarea( $issue_position ); ?></textarea></td></tr>
        <tr><th><label for="issue_proposals">Policy Proposals (one per line)</label></th>
            <td><textarea id="issue_proposals" name="issue_proposals" rows="6" class="large-text" placeholder="One proposal per line"><?php echo esc_textarea( $issue_proposals ); ?></textarea></td></tr>
    </table>
    <?php
}

function ab_save_meta( $post_id ) {
    // Event meta
    if ( isset( $_POST['ab_event_meta_nonce'] ) && wp_verify_nonce( $_POST['ab_event_meta_nonce'], 'ab_event_meta' ) ) {
        $fields = array( 'event_date', 'event_time', 'event_end_time', 'event_location', 'event_address', 'event_rsvp_url' );
        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
    }
    // Issue meta
    if ( isset( $_POST['ab_issue_meta_nonce'] ) && wp_verify_nonce( $_POST['ab_issue_meta_nonce'], 'ab_issue_meta' ) ) {
        $text_fields = array( 'issue_icon', 'issue_order' );
        foreach ( $text_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        $textarea_fields = array( 'issue_problem', 'issue_position', 'issue_proposals' );
        foreach ( $textarea_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, '_' . $field, sanitize_textarea_field( $_POST[ $field ] ) );
            }
        }
    }
}
add_action( 'save_post', 'ab_save_meta' );

// ============================================
// WIDGETS
// ============================================
function ab_widgets_init() {
    register_sidebar( array(
        'name'          => 'Blog Sidebar',
        'id'            => 'sidebar-blog',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Widget Area',
        'id'            => 'sidebar-footer',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'ab_widgets_init' );

// ============================================
// CUSTOMIZER
// ============================================
function ab_customizer( $wp_customize ) {

    // Campaign Info Section
    $wp_customize->add_section( 'ab_campaign_info', array(
        'title'    => 'Campaign Information',
        'priority' => 30,
    ) );

    $campaign_fields = array(
        'candidate_name'    => array( 'Campaign Name', 'Aaron Baker' ),
        'campaign_tagline'  => array( 'Tagline', 'For Florida\'s 6th Congressional District' ),
        'campaign_phone'    => array( 'Phone Number', '' ),
        'campaign_email'    => array( 'Email', 'aaron@aaron4fl6.com' ),
        'campaign_address'  => array( 'Mailing Address', 'P.O. Box 233, Sorrento, Florida 32776' ),
        'fec_disclaimer'    => array( 'FEC Disclaimer', 'Paid for by Aaron Baker, Republican Candidate for Florida\'s 6th Congressional District.' ),
        'winred_url'        => array( 'WinRed Donation URL', 'https://secure.winred.com/aaron-4-fl/donate-today' ),
        'anedot_url'        => array( 'Anedot Donation URL', 'https://secure.anedot.com/aaron-4-fl/donate' ),
    );

    foreach ( $campaign_fields as $id => $data ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $data[1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( $id, array(
            'label'   => $data[0],
            'section' => 'ab_campaign_info',
            'type'    => $id === 'fec_disclaimer' ? 'textarea' : 'text',
        ) );
    }

    // Social Media Section
    $wp_customize->add_section( 'ab_social', array(
        'title'    => 'Social Media Links',
        'priority' => 35,
    ) );

    $socials = array(
        'social_facebook'  => array( 'Facebook URL', '' ),
        'social_twitter'   => array( 'X / Twitter URL', 'https://x.com/Aaron4fl6' ),
        'social_instagram' => array( 'Instagram URL', '' ),
        'social_youtube'   => array( 'YouTube URL', '' ),
    );

    foreach ( $socials as $id => $data ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $data[1],
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( $id, array(
            'label'   => $data[0],
            'section' => 'ab_social',
            'type'    => 'url',
        ) );
    }

    // Homepage Hero Section
    $wp_customize->add_section( 'ab_hero', array(
        'title'    => 'Homepage Hero',
        'priority' => 40,
    ) );

    $hero_fields = array(
        'hero_label'    => array( 'Hero Label', 'Republican for Florida\'s 6th District', 'text' ),
        'hero_headline' => array( 'Hero Headline', 'Fighting for the Families of Florida\'s 6th District', 'text' ),
        'hero_text'     => array( 'Hero Description', 'Born in Lakeland and living in Sorrento — Aaron Baker is the only candidate who calls this district home. An America First conservative fighting for working families, local infrastructure, and accountable leadership.', 'textarea' ),
    );

    foreach ( $hero_fields as $id => $data ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $data[1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( $id, array(
            'label'   => $data[0],
            'section' => 'ab_hero',
            'type'    => $data[2],
        ) );
    }

    // Hero Background Image
    $wp_customize->add_setting( 'hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_bg_image', array(
        'label'   => 'Hero Background Image',
        'section' => 'ab_hero',
    ) ) );
}
add_action( 'customize_register', 'ab_customizer' );

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Get social media links as array
 */
function ab_get_social_links() {
    $platforms = array(
        'facebook'  => array( 'url' => get_theme_mod( 'social_facebook', '' ), 'label' => 'Facebook', 'icon' => 'fb' ),
        'twitter'   => array( 'url' => get_theme_mod( 'social_twitter', 'https://x.com/Aaron4fl6' ), 'label' => 'X / Twitter', 'icon' => 'tw' ),
        'instagram' => array( 'url' => get_theme_mod( 'social_instagram', '' ), 'label' => 'Instagram', 'icon' => 'ig' ),
        'youtube'   => array( 'url' => get_theme_mod( 'social_youtube', '' ), 'label' => 'YouTube', 'icon' => 'yt' ),
    );
    return array_filter( $platforms, function( $p ) { return ! empty( $p['url'] ); } );
}

/**
 * Render social links HTML
 */
function ab_social_links_html( $class = 'social-links' ) {
    $links = ab_get_social_links();
    if ( empty( $links ) ) return;

    $icons = array(
        'facebook'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        'twitter'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        'instagram' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>',
        'youtube'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
    );

    echo '<div class="' . esc_attr( $class ) . '">';
    foreach ( $links as $platform => $data ) {
        echo '<a href="' . esc_url( $data['url'] ) . '" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="' . esc_attr( $data['label'] ) . '">';
        echo $icons[ $platform ] ?? '';
        echo '</a>';
    }
    echo '</div>';
}

/**
 * Get upcoming events
 */
function ab_get_upcoming_events( $count = 3 ) {
    return new WP_Query( array(
        'post_type'      => 'ab_event',
        'posts_per_page' => $count,
        'meta_key'       => '_event_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => '_event_date',
                'value'   => date( 'Y-m-d' ),
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
    ) );
}

/**
 * Format event date parts
 */
function ab_format_event_date( $post_id ) {
    $date = get_post_meta( $post_id, '_event_date', true );
    if ( ! $date ) return array( 'month' => '', 'day' => '', 'full' => '' );
    $timestamp = strtotime( $date );
    return array(
        'month' => date( 'M', $timestamp ),
        'day'   => date( 'j', $timestamp ),
        'full'  => date( 'F j, Y', $timestamp ),
        'day_name' => date( 'l', $timestamp ),
    );
}

/**
 * Breadcrumbs
 */
function ab_breadcrumbs() {
    if ( is_front_page() ) return;

    echo '<div class="breadcrumbs">';
    echo '<a href="' . esc_url( home_url() ) . '">Home</a>';
    echo '<span class="separator">/</span>';

    if ( is_singular( 'ab_issue' ) ) {
        echo '<a href="' . esc_url( get_post_type_archive_link( 'ab_issue' ) ) . '">Issues</a>';
        echo '<span class="separator">/</span>';
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_singular( 'ab_event' ) ) {
        echo '<a href="' . esc_url( get_post_type_archive_link( 'ab_event' ) ) . '">Events</a>';
        echo '<span class="separator">/</span>';
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_singular( 'post' ) ) {
        echo '<a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">Newsroom</a>';
        echo '<span class="separator">/</span>';
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_page() ) {
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_archive() ) {
        echo '<span>' . get_the_archive_title() . '</span>';
    }

    echo '</div>';
}

// ============================================
// SEO — COMPREHENSIVE FL-6 GEO-TARGETED SEO
// ============================================

/**
 * FL-6 District cities and communities for geo-targeted SEO.
 * Counties: Volusia, Flagler, St. Johns (partial), Lake (partial), Putnam, Marion (partial)
 */
function ab_get_district_locations() {
    return array(
        'counties' => array( 'Volusia County', 'Flagler County', 'St. Johns County', 'Lake County', 'Putnam County', 'Marion County' ),
        'major_cities' => array(
            'Palm Coast', 'Ormond Beach', 'Daytona Beach', 'Port Orange',
            'New Smyrna Beach', 'DeLand', 'Deltona', 'Palatka',
        ),
        'cities' => array(
            'Flagler Beach', 'Bunnell', 'Holly Hill', 'South Daytona',
            'Daytona Beach Shores', 'Edgewater', 'Oak Hill', 'Lake Helen',
            'Orange City', 'DeBary', 'Mount Dora', 'Eustis', 'Umatilla',
            'Tavares', 'Sorrento', 'Pierson', 'Ponce Inlet',
        ),
        'communities' => array(
            'Ormond-by-the-Sea', 'Samsula-Spruce Creek', 'De Leon Springs',
            'Flagler Estates', 'Pine Lakes', 'North DeLand', 'West DeLand',
            'Lady Lake', 'Altoona', 'Astor', 'Paisley', 'Seville',
            'St. Augustine Shores', 'Butler Beach', 'Crescent Beach',
            'Lake Kathryn', 'Mount Plymouth', 'Lisbon', 'Pittman',
        ),
    );
}

/**
 * Get the candidate name from customizer.
 */
function ab_seo_candidate_name() {
    return get_theme_mod( 'candidate_name', 'Aaron Baker' );
}

/**
 * Generate page-specific SEO meta description with FL-6 geo targeting.
 */
function ab_get_seo_description() {
    $name      = ab_seo_candidate_name();
    $locations = ab_get_district_locations();
    $cities    = implode( ', ', array_slice( $locations['major_cities'], 0, 5 ) );

    // Front page / Home
    if ( is_front_page() ) {
        return "{$name} is running for U.S. Congress in Florida's 6th Congressional District. An America First Republican fighting for {$cities}, and all FL-6 communities. Join the campaign today.";
    }

    // Page template-specific descriptions
    if ( is_page() ) {
        $template = get_page_template_slug();
        switch ( $template ) {
            case 'page-templates/page-about.php':
                return "Meet {$name}, Republican candidate for Florida's 6th Congressional District. Born in Lakeland, living in Sorrento, FL — fighting for the families of {$cities} and all of FL-6.";

            case 'page-templates/page-issues.php':
                return "{$name}'s policy positions on border security, veterans, education, local infrastructure, and more. America First solutions for Florida's 6th District — {$cities} and beyond.";

            case 'page-templates/page-events.php':
                return "Attend a campaign event with {$name} in Florida's 6th Congressional District. Town halls, meet-and-greets, and rallies in {$cities}, and communities across FL-6.";

            case 'page-templates/page-volunteer.php':
                return "Volunteer for {$name}'s campaign for Congress in Florida's 6th District. Help us win in {$cities} — knock doors, make calls, and spread the America First message.";

            case 'page-templates/page-donate.php':
                return "Support {$name}'s campaign for Florida's 6th Congressional District. Your donation helps bring America First representation to {$cities} and all of FL-6.";

            case 'page-templates/page-newsroom.php':
                return "Latest campaign news, press releases, and media coverage from {$name}'s race for Florida's 6th Congressional District serving {$cities}.";

            case 'page-templates/page-district.php':
                return "Florida's 6th Congressional District includes Volusia, Flagler, St. Johns, Lake, Putnam, and Marion counties — home to {$cities}. {$name} is the only Republican candidate who lives in the district.";

            case 'page-templates/page-contact.php':
                return "Contact {$name}'s campaign for Florida's 6th Congressional District. Reach our team for media inquiries, event requests, or constituent questions. Serving {$cities} and all of FL-6.";

            case 'page-templates/page-privacy.php':
                return "Privacy policy for {$name}'s campaign website for Florida's 6th Congressional District.";
        }
    }

    // Single issue post
    if ( is_singular( 'ab_issue' ) ) {
        $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 20, '' );
        return "{$name} on " . get_the_title() . ": " . wp_strip_all_tags( $excerpt ) . " — Florida's 6th Congressional District.";
    }

    // Single event post
    if ( is_singular( 'ab_event' ) ) {
        $location = get_post_meta( get_the_ID(), '_event_location', true );
        $date_str = get_post_meta( get_the_ID(), '_event_date', true );
        $desc     = get_the_title();
        if ( $location ) $desc .= " at {$location}";
        if ( $date_str ) $desc .= " on " . date( 'F j, Y', strtotime( $date_str ) );
        return $desc . ". {$name} for Florida's 6th Congressional District.";
    }

    // Single blog post
    if ( is_singular( 'post' ) ) {
        $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 25, '' );
        return wp_strip_all_tags( $excerpt ) . " — {$name} for Florida's 6th Congressional District.";
    }

    // Archive / category / tag
    if ( is_archive() ) {
        return "Campaign updates and news from {$name}, Republican candidate for Florida's 6th Congressional District serving {$cities}.";
    }

    // Search results
    if ( is_search() ) {
        return "Search results for \"" . get_search_query() . "\" on {$name}'s campaign website for Florida's 6th Congressional District.";
    }

    // Fallback
    return "{$name} for Congress — Republican candidate for Florida's 6th Congressional District. America First leadership for {$cities} and all FL-6 communities.";
}

/**
 * Generate geo-targeted keywords meta tag.
 */
function ab_get_seo_keywords() {
    $name      = ab_seo_candidate_name();
    $locations = ab_get_district_locations();

    // Base campaign keywords
    $keywords = array(
        $name,
        "{$name} for Congress",
        "{$name} FL-6",
        "Florida 6th Congressional District",
        "FL-6 Republican",
        "Florida 6th District candidate",
        "America First Florida",
        "Republican primary FL-6 2026",
        "Congress Florida District 6",
    );

    // Add all major cities with campaign context
    foreach ( $locations['major_cities'] as $city ) {
        $keywords[] = "{$name} {$city}";
        $keywords[] = "Congress {$city} FL";
        $keywords[] = "Republican {$city}";
    }

    // Add county keywords
    foreach ( $locations['counties'] as $county ) {
        $keywords[] = "{$county} Congress";
        $keywords[] = "{$county} Republican";
    }

    // Add secondary cities
    foreach ( $locations['cities'] as $city ) {
        $keywords[] = "{$name} {$city}";
    }

    // Page-specific keywords
    if ( is_page() ) {
        $template = get_page_template_slug();
        if ( $template === 'page-templates/page-issues.php' || is_singular( 'ab_issue' ) ) {
            $keywords = array_merge( $keywords, array(
                'border security Florida', 'veterans FL-6', 'education Florida',
                'Daytona Beach flooding', 'beach erosion Flagler', 'Belvedere fuel terminal',
                'red snapper Florida', 'infrastructure Volusia County',
            ) );
        }
        if ( $template === 'page-templates/page-district.php' ) {
            // Add all community names for district page
            $keywords = array_merge( $keywords, $locations['communities'] );
        }
    }

    return array_unique( $keywords );
}

/**
 * Custom document title parts with FL-6 branding.
 */
function ab_custom_title_parts( $title ) {
    $name = ab_seo_candidate_name();

    if ( is_front_page() ) {
        $title['title']   = "{$name} for Congress";
        $title['tagline'] = "Florida's 6th Congressional District";
    } elseif ( is_singular( 'ab_issue' ) ) {
        $title['title'] = get_the_title() . " — {$name} for FL-6";
    } elseif ( is_singular( 'ab_event' ) ) {
        $title['title'] = get_the_title() . " — {$name} Campaign Event";
    }

    return $title;
}
add_filter( 'document_title_parts', 'ab_custom_title_parts' );

/**
 * Custom title separator.
 */
function ab_title_separator() {
    return '|';
}
add_filter( 'document_title_separator', 'ab_title_separator' );

/**
 * Output all SEO meta tags in <head>.
 */
function ab_meta_tags() {
    $name        = ab_seo_candidate_name();
    $description = ab_get_seo_description();
    $keywords    = ab_get_seo_keywords();
    $url         = is_singular() ? get_permalink() : home_url( $_SERVER['REQUEST_URI'] );
    $site_name   = get_bloginfo( 'name' ) ?: "{$name} for Congress";
    $og_type     = is_singular( 'post' ) ? 'article' : 'website';
    $og_image    = '';

    if ( is_singular() && has_post_thumbnail() ) {
        $og_image = get_the_post_thumbnail_url( null, 'large' );
    }

    // --- Meta Description ---
    echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";

    // --- Keywords (geo-targeted) ---
    echo '<meta name="keywords" content="' . esc_attr( implode( ', ', array_slice( $keywords, 0, 40 ) ) ) . '">' . "\n";

    // --- Canonical URL ---
    if ( is_singular() ) {
        echo '<link rel="canonical" href="' . esc_url( get_permalink() ) . '">' . "\n";
    } elseif ( is_front_page() ) {
        echo '<link rel="canonical" href="' . esc_url( home_url( '/' ) ) . '">' . "\n";
    }

    // --- Robots ---
    if ( is_search() || is_404() ) {
        echo '<meta name="robots" content="noindex, follow">' . "\n";
    } else {
        echo '<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
    }

    // --- Open Graph ---
    echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
    echo '<meta property="og:locale" content="en_US">' . "\n";
    if ( $og_image ) {
        echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="630">' . "\n";
    }

    // Article-specific OG tags
    if ( is_singular( 'post' ) ) {
        echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . "\n";
        echo '<meta property="article:author" content="' . esc_attr( $name ) . '">' . "\n";
        echo '<meta property="article:section" content="Campaign News">' . "\n";
    }

    // --- Twitter Card ---
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta name="twitter:site" content="@Aaron4fl6">' . "\n";
    echo '<meta name="twitter:creator" content="@Aaron4fl6">' . "\n";
    if ( $og_image ) {
        echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
    }

    // --- Geo Meta Tags (Florida's 6th District) ---
    echo '<meta name="geo.region" content="US-FL">' . "\n";
    echo '<meta name="geo.placename" content="Florida\'s 6th Congressional District">' . "\n";
    echo '<meta name="geo.position" content="29.2108;-81.0228">' . "\n";
    echo '<meta name="ICBM" content="29.2108, -81.0228">' . "\n";
}
add_action( 'wp_head', 'ab_meta_tags', 1 );

/**
 * Output JSON-LD Structured Data (Schema.org).
 */
function ab_schema_jsonld() {
    $name     = ab_seo_candidate_name();
    $email    = get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' );
    $phone    = get_theme_mod( 'campaign_phone', '' );
    $address  = get_theme_mod( 'campaign_address', 'P.O. Box 233, Sorrento, FL 32776' );
    $logo_url = has_custom_logo() ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) : '';
    $locations = ab_get_district_locations();

    // --- Sitewide: Organization (Political Campaign) ---
    $org_schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Organization',
        'name'        => "{$name} for Congress",
        'url'         => home_url( '/' ),
        'description' => "{$name} is a Republican candidate for Florida's 6th Congressional District, serving Palm Coast, Ormond Beach, Daytona Beach, Port Orange, New Smyrna Beach, DeLand, Deltona, and all FL-6 communities.",
        'email'       => $email,
        'address'     => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address,
            'addressLocality' => 'Sorrento',
            'addressRegion'   => 'FL',
            'postalCode'      => '32776',
            'addressCountry'  => 'US',
        ),
        'areaServed'  => array(),
        'sameAs'      => array_filter( array(
            get_theme_mod( 'social_twitter', 'https://x.com/Aaron4fl6' ),
            get_theme_mod( 'social_facebook', '' ),
            get_theme_mod( 'social_instagram', '' ),
            get_theme_mod( 'social_youtube', '' ),
        ) ),
    );

    if ( $phone ) {
        $org_schema['telephone'] = $phone;
    }
    if ( $logo_url ) {
        $org_schema['logo'] = $logo_url;
    }

    // Add areaServed with all FL-6 cities
    $all_cities = array_merge( $locations['major_cities'], $locations['cities'] );
    foreach ( $all_cities as $city ) {
        $org_schema['areaServed'][] = array(
            '@type' => 'City',
            'name'  => $city . ', FL',
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $org_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";

    // --- Person schema for candidate ---
    $person_schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Person',
        'name'        => $name,
        'jobTitle'    => "Republican Candidate for Florida's 6th Congressional District",
        'url'         => home_url( '/about/' ),
        'birthPlace'  => array(
            '@type' => 'Place',
            'name'  => 'Lakeland, Florida',
        ),
        'homeLocation' => array(
            '@type' => 'Place',
            'name'  => 'Sorrento, Florida',
        ),
        'affiliation' => array(
            '@type' => 'PoliticalParty',
            'name'  => 'Republican Party',
        ),
        'knowsAbout'  => array(
            'Border Security', 'Veterans Affairs', 'Education Policy',
            'Local Infrastructure', 'Beach Erosion', 'Flooding Prevention',
            'America First Policy',
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $person_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";

    // --- BreadcrumbList schema ---
    if ( ! is_front_page() ) {
        $breadcrumbs = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array(),
        );

        $breadcrumbs['itemListElement'][] = array(
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => 'Home',
            'item'     => home_url( '/' ),
        );

        if ( is_singular() ) {
            $breadcrumbs['itemListElement'][] = array(
                '@type'    => 'ListItem',
                'position' => 2,
                'name'     => get_the_title(),
                'item'     => get_permalink(),
            );
        } elseif ( is_page() ) {
            $breadcrumbs['itemListElement'][] = array(
                '@type'    => 'ListItem',
                'position' => 2,
                'name'     => get_the_title(),
                'item'     => get_permalink(),
            );
        }

        echo '<script type="application/ld+json">' . wp_json_encode( $breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }

    // --- Event schema for single events ---
    if ( is_singular( 'ab_event' ) ) {
        $event_date     = get_post_meta( get_the_ID(), '_event_date', true );
        $event_time     = get_post_meta( get_the_ID(), '_event_time', true );
        $event_end_time = get_post_meta( get_the_ID(), '_event_end_time', true );
        $event_location = get_post_meta( get_the_ID(), '_event_location', true );
        $event_address  = get_post_meta( get_the_ID(), '_event_address', true );

        $start_datetime = $event_date;
        if ( $event_time ) {
            $start_datetime .= 'T' . date( 'H:i:s', strtotime( $event_time ) );
        }

        $event_schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'PoliticalEvent',
            'name'        => get_the_title(),
            'description' => wp_strip_all_tags( get_the_excerpt() ?: wp_trim_words( get_the_content(), 30 ) ),
            'startDate'   => $start_datetime,
            'url'         => get_permalink(),
            'organizer'   => array(
                '@type' => 'Organization',
                'name'  => "{$name} for Congress",
                'url'   => home_url( '/' ),
            ),
        );

        if ( $event_end_time && $event_date ) {
            $event_schema['endDate'] = $event_date . 'T' . date( 'H:i:s', strtotime( $event_end_time ) );
        }

        if ( $event_location || $event_address ) {
            $event_schema['location'] = array(
                '@type'   => 'Place',
                'name'    => $event_location ?: 'Campaign Event Location',
                'address' => $event_address ?: $event_location,
            );
        }

        if ( has_post_thumbnail() ) {
            $event_schema['image'] = get_the_post_thumbnail_url( null, 'large' );
        }

        echo '<script type="application/ld+json">' . wp_json_encode( $event_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }

    // --- WebSite schema with search action ---
    if ( is_front_page() ) {
        $website_schema = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            'name'            => "{$name} for Congress",
            'url'             => home_url( '/' ),
            'description'     => "Official campaign website for {$name}, Republican candidate for Florida's 6th Congressional District.",
            'potentialAction' => array(
                '@type'       => 'SearchAction',
                'target'      => home_url( '/?s={search_term_string}' ),
                'query-input' => 'required name=search_term_string',
            ),
        );

        echo '<script type="application/ld+json">' . wp_json_encode( $website_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'ab_schema_jsonld', 2 );

/**
 * Generate XML Sitemap hints — add district city landing content to sitemap priority.
 */
function ab_sitemap_post_priority( $priority, $post ) {
    // Boost issue pages and front page in sitemap
    if ( $post->post_type === 'ab_issue' ) {
        return 0.8;
    }
    $template = get_page_template_slug( $post->ID );
    if ( $template === 'page-templates/front-page.php' ) {
        return 1.0;
    }
    if ( in_array( $template, array(
        'page-templates/page-issues.php',
        'page-templates/page-about.php',
        'page-templates/page-district.php',
        'page-templates/page-volunteer.php',
    ) ) ) {
        return 0.9;
    }
    return $priority;
}

/**
 * Add preconnect and dns-prefetch hints for performance SEO.
 */
function ab_resource_hints( $urls, $relation_type ) {
    if ( $relation_type === 'dns-prefetch' ) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'ab_resource_hints', 10, 2 );

/**
 * Disable WordPress default generator meta tag (security + cleaner head).
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

// ============================================
// AJAX HANDLERS (Email Signup / Contact / Volunteer)
// ============================================
function ab_handle_email_signup() {
    check_ajax_referer( 'ab_nonce', 'nonce' );

    $email = sanitize_email( $_POST['email'] ?? '' );
    $name  = sanitize_text_field( $_POST['name'] ?? '' );
    $type  = sanitize_text_field( $_POST['type'] ?? 'newsletter' );

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
    }

    // Store as a custom post (simple approach — can be replaced with Mailchimp/email service integration)
    $post_id = wp_insert_post( array(
        'post_type'   => 'ab_subscriber',
        'post_title'  => $email,
        'post_status' => 'private',
        'post_content' => '',
    ) );

    if ( $post_id ) {
        update_post_meta( $post_id, '_subscriber_name', $name );
        update_post_meta( $post_id, '_subscriber_type', $type );
        update_post_meta( $post_id, '_subscriber_date', current_time( 'mysql' ) );
    }

    // Send notification to campaign
    $campaign_email = get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' );
    $subject = 'New ' . ucfirst( $type ) . ' Signup: ' . $email;
    $message = "New signup from: {$name}\nEmail: {$email}\nType: {$type}\nDate: " . current_time( 'mysql' );
    wp_mail( $campaign_email, $subject, $message );

    wp_send_json_success( array( 'message' => 'Thank you for joining the campaign!' ) );
}
add_action( 'wp_ajax_ab_email_signup', 'ab_handle_email_signup' );
add_action( 'wp_ajax_nopriv_ab_email_signup', 'ab_handle_email_signup' );

function ab_handle_contact_form() {
    check_ajax_referer( 'ab_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $subject = sanitize_text_field( $_POST['subject'] ?? 'General Inquiry' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( ! $name || ! is_email( $email ) || ! $message ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }

    $campaign_email = get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' );
    $email_body = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\n\nMessage:\n{$message}";
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

    wp_mail( $campaign_email, 'Contact Form: ' . $subject, $email_body, $headers );

    wp_send_json_success( array( 'message' => 'Thank you for reaching out. We\'ll get back to you soon.' ) );
}
add_action( 'wp_ajax_ab_contact_form', 'ab_handle_contact_form' );
add_action( 'wp_ajax_nopriv_ab_contact_form', 'ab_handle_contact_form' );

function ab_handle_volunteer_form() {
    check_ajax_referer( 'ab_nonce', 'nonce' );

    $name     = sanitize_text_field( $_POST['name'] ?? '' );
    $email    = sanitize_email( $_POST['email'] ?? '' );
    $phone    = sanitize_text_field( $_POST['phone'] ?? '' );
    $zip      = sanitize_text_field( $_POST['zip'] ?? '' );
    $areas    = array_map( 'sanitize_text_field', $_POST['areas'] ?? array() );

    if ( ! $name || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }

    $campaign_email = get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' );
    $email_body = "New Volunteer Signup!\n\nName: {$name}\nEmail: {$email}\nPhone: {$phone}\nZip: {$zip}\nAreas of Interest: " . implode( ', ', $areas );

    wp_mail( $campaign_email, 'New Volunteer: ' . $name, $email_body );

    wp_send_json_success( array( 'message' => 'Thank you for volunteering! We\'ll be in touch soon.' ) );
}
add_action( 'wp_ajax_ab_volunteer_form', 'ab_handle_volunteer_form' );
add_action( 'wp_ajax_nopriv_ab_volunteer_form', 'ab_handle_volunteer_form' );

// Register subscriber CPT (hidden from admin menu)
function ab_register_subscriber_cpt() {
    register_post_type( 'ab_subscriber', array(
        'labels'       => array( 'name' => 'Subscribers', 'singular_name' => 'Subscriber' ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'supports'     => array( 'title' ),
        'menu_icon'    => 'dashicons-email',
    ) );
}
add_action( 'init', 'ab_register_subscriber_cpt' );

// ============================================
// THEME ACTIVATION — AUTO-CREATE PAGES
// ============================================
function ab_activate_theme() {
    $pages = array(
        'Home'           => array( 'template' => 'page-templates/front-page.php', 'content' => '' ),
        'About'          => array( 'template' => 'page-templates/page-about.php', 'content' => '' ),
        'Issues'         => array( 'template' => 'page-templates/page-issues.php', 'content' => '' ),
        'Events'         => array( 'template' => 'page-templates/page-events.php', 'content' => '' ),
        'Volunteer'      => array( 'template' => 'page-templates/page-volunteer.php', 'content' => '' ),
        'Donate'         => array( 'template' => 'page-templates/page-donate.php', 'content' => '' ),
        'Newsroom'       => array( 'template' => 'page-templates/page-newsroom.php', 'content' => '' ),
        'District'       => array( 'template' => 'page-templates/page-district.php', 'content' => '' ),
        'Contact'        => array( 'template' => 'page-templates/page-contact.php', 'content' => '' ),
        'Privacy Policy' => array( 'template' => 'page-templates/page-privacy.php', 'content' => '' ),
    );

    foreach ( $pages as $title => $data ) {
        $existing = get_page_by_title( $title, OBJECT, 'page' );
        if ( ! $existing ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $title,
                'post_content' => $data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
            if ( $page_id && ! is_wp_error( $page_id ) ) {
                update_post_meta( $page_id, '_wp_page_template', $data['template'] );
            }
        }
    }

    // Set Home as front page
    $home_page = get_page_by_title( 'Home', OBJECT, 'page' );
    if ( $home_page ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_page->ID );
    }

    // Create default news categories
    $categories = array( 'Press Release', 'In the News', 'Op-Ed' );
    foreach ( $categories as $cat ) {
        if ( ! term_exists( $cat, 'news_category' ) ) {
            wp_insert_term( $cat, 'news_category' );
        }
    }

    // Create default issues
    $issues = array(
        array( 'title' => 'Economy & Jobs', 'icon' => '💼', 'excerpt' => 'Restoring economic opportunity and fighting inflation for working families across Florida\'s 6th District.', 'order' => 1 ),
        array( 'title' => 'Immigration', 'icon' => '🛡️', 'excerpt' => 'Securing our borders and enforcing immigration laws to protect American workers and communities.', 'order' => 2 ),
        array( 'title' => 'Education', 'icon' => '📚', 'excerpt' => 'Empowering parents, supporting local schools, and working toward abolishing the Department of Education.', 'order' => 3 ),
        array( 'title' => 'Veterans', 'icon' => '⭐', 'excerpt' => 'Honoring those who served by ensuring they receive the care, benefits, and respect they\'ve earned.', 'order' => 4 ),
        array( 'title' => 'Energy', 'icon' => '⚡', 'excerpt' => 'Achieving energy independence through an all-of-the-above approach that keeps costs low for families.', 'order' => 5 ),
        array( 'title' => 'Crime & Public Safety', 'icon' => '🏛️', 'excerpt' => 'Backing law enforcement, supporting the Lifesaving Gear for Police Act, and keeping communities safe.', 'order' => 6 ),
        array( 'title' => 'Second Amendment', 'icon' => '🇺🇸', 'excerpt' => 'Defending the constitutional right to keep and bear arms against unconstitutional restrictions.', 'order' => 7 ),
        array( 'title' => 'Local Infrastructure', 'icon' => '🌊', 'excerpt' => 'Addressing flooding in Volusia County, beach erosion along the coast, and infrastructure needs across FL-6.', 'order' => 8 ),
    );

    foreach ( $issues as $issue ) {
        $existing = get_page_by_title( $issue['title'], OBJECT, 'ab_issue' );
        if ( ! $existing ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $issue['title'],
                'post_type'    => 'ab_issue',
                'post_status'  => 'publish',
                'post_excerpt' => $issue['excerpt'],
            ) );
            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_issue_icon', $issue['icon'] );
                update_post_meta( $post_id, '_issue_order', $issue['order'] );
            }
        }
    }

    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ab_activate_theme' );

// ============================================
// ADMIN COLUMNS FOR EVENTS
// ============================================
function ab_event_columns( $columns ) {
    $new = array();
    foreach ( $columns as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['event_date']     = 'Event Date';
            $new['event_location'] = 'Location';
        }
    }
    return $new;
}
add_filter( 'manage_ab_event_posts_columns', 'ab_event_columns' );

function ab_event_column_data( $column, $post_id ) {
    if ( $column === 'event_date' ) {
        $date = get_post_meta( $post_id, '_event_date', true );
        echo $date ? date( 'M j, Y', strtotime( $date ) ) : '—';
    }
    if ( $column === 'event_location' ) {
        echo get_post_meta( $post_id, '_event_location', true ) ?: '—';
    }
}
add_action( 'manage_ab_event_posts_custom_column', 'ab_event_column_data', 10, 2 );

// Make event date sortable
function ab_event_sortable_columns( $columns ) {
    $columns['event_date'] = 'event_date';
    return $columns;
}
add_filter( 'manage_edit-ab_event_sortable_columns', 'ab_event_sortable_columns' );
