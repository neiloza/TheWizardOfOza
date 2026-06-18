<?php get_header(); ?>

<section class="page-hero">
    <div class="container">
        <h1>Page Not Found</h1>
        <p>The page you're looking for doesn't exist or has been moved.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 600px; text-align: center;">
        <div style="font-size: 6rem; font-weight: 800; color: var(--red); opacity: 0.15; line-height: 1;">404</div>
        <p style="margin: 24px 0 32px; color: var(--text-mid); font-size: 1.1rem;">
            Let's get you back on track. You can return to the homepage or explore the links below.
        </p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Go Home</a>
            <a href="<?php echo esc_url( home_url( '/issues/' ) ); ?>" class="btn btn--outline">View Issues</a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline">Contact Us</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
