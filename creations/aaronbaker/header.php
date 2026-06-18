<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="mobile-overlay" id="mobileOverlay"></div>

<header class="site-header" id="siteHeader">
    <div class="header-inner">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="logo-text">
                        <span class="logo-name"><?php echo esc_html( get_theme_mod( 'candidate_name', 'Aaron Baker' ) ); ?></span>
                        <span class="logo-tagline"><?php echo esc_html( get_theme_mod( 'campaign_tagline', "For Florida's 6th Congressional District" ) ); ?></span>
                    </div>
                <?php endif; ?>
            </a>
        </div>

        <nav class="main-navigation" id="mainNav" aria-label="Primary Navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => 'ab_fallback_menu',
                'depth'          => 2,
            ) );
            ?>
            <div class="header-donate">
                <a href="<?php echo esc_url( get_theme_mod( 'winred_url', 'https://secure.winred.com/aaron-4-fl/donate-today' ) ); ?>" class="btn btn--primary btn--sm" target="_blank" rel="noopener">Donate</a>
            </div>
        </nav>

        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<main id="main-content">
<?php

/**
 * Fallback menu when no menu is assigned
 */
function ab_fallback_menu() {
    $pages = array(
        'Home'      => home_url( '/' ),
        'About'     => home_url( '/about/' ),
        'Issues'    => home_url( '/issues/' ),
        'Events'    => home_url( '/events/' ),
        'Newsroom'  => home_url( '/newsroom/' ),
        'Volunteer' => home_url( '/volunteer/' ),
        'District'  => home_url( '/district/' ),
        'Contact'   => home_url( '/contact/' ),
    );

    echo '<ul class="nav-menu">';
    foreach ( $pages as $label => $url ) {
        $current = ( untrailingslashit( $url ) === untrailingslashit( get_permalink() ) ) ? ' class="current-menu-item"' : '';
        echo '<li' . $current . '><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}
