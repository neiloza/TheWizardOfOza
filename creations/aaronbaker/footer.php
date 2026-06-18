</main><!-- #main-content -->

<!-- CTA / Email Signup Section (show on most pages) -->
<?php if ( ! is_page_template( 'page-templates/page-donate.php' ) && ! is_page_template( 'page-templates/page-privacy.php' ) ) : ?>
<section class="cta-section section-padding">
    <div class="container cta-content">
        <span class="section-label" style="color: var(--gold);">Join the Movement</span>
        <h2>Stand With Aaron</h2>
        <p>Get the latest campaign updates, event invitations, and ways to make a difference in Florida's 6th District.</p>
        <form class="email-form" id="footerSignupForm">
            <input type="email" name="email" placeholder="Enter your email address" required>
            <button type="submit" class="btn btn--primary">Sign Up</button>
        </form>
        <p style="font-size: 0.82rem; margin-top: 12px; color: rgba(255,255,255,0.4);">We respect your privacy. Unsubscribe anytime.</p>
    </div>
</section>
<?php endif; ?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <span class="footer-logo"><?php echo esc_html( get_theme_mod( 'candidate_name', 'Aaron Baker' ) ); ?></span>
                <p>Republican Candidate for Florida's 6th Congressional District. Fighting for working families, local infrastructure, and accountable leadership.</p>
                <?php ab_social_links_html( 'footer-social' ); ?>
            </div>

            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Aaron</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/issues/' ) ); ?>">Issues</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/events/' ) ); ?>">Events</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/newsroom/' ) ); ?>">Newsroom</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/district/' ) ); ?>">Our District</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Get Involved</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>">Volunteer</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/donate/' ) ); ?>">Donate</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="footer-newsletter">
                <h4>Stay Updated</h4>
                <p>Subscribe for campaign news, event reminders, and ways to support our mission.</p>
                <form class="email-form" id="footerNewsletterForm">
                    <input type="email" name="email" placeholder="Your email" required>
                    <button type="submit" class="btn btn--primary btn--sm">Go</button>
                </form>
            </div>
        </div>

        <!-- SEO: District Cities Serving Section -->
        <div class="footer-district-cities">
            <p class="footer-serving-label">Proudly serving the communities of Florida's 6th Congressional District:</p>
            <p class="footer-city-list">
                Palm Coast · Ormond Beach · Daytona Beach · Port Orange · New Smyrna Beach · DeLand · Deltona · Palatka · Flagler Beach · Bunnell · Holly Hill · South Daytona · Daytona Beach Shores · Edgewater · Oak Hill · Orange City · DeBary · Mount Dora · Eustis · Umatilla · Tavares · Sorrento · Ponce Inlet · Pierson · Ormond-by-the-Sea · De Leon Springs · Lady Lake · <a href="<?php echo esc_url( home_url( '/district/' ) ); ?>">and more across Volusia, Flagler, St. Johns, Lake, Putnam &amp; Marion counties</a>
            </p>
        </div>

        <div class="footer-bottom">
            <div class="footer-fec">
                <?php echo esc_html( get_theme_mod( 'fec_disclaimer', "Paid for by Aaron Baker, Republican Candidate for Florida's 6th Congressional District." ) ); ?>
                <br>
                <?php echo esc_html( get_theme_mod( 'campaign_address', 'P.O. Box 233, Sorrento, Florida 32776' ) ); ?>
                 | <a href="mailto:<?php echo esc_attr( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?></a>
            </div>
            <div class="footer-copyright">
                &copy; <?php echo date( 'Y' ); ?> Aaron4FL6. All Rights Reserved.
            </div>
        </div>
    </div>
</footer>

<!-- Email Popup -->
<div class="email-popup-overlay" id="emailPopup">
    <div class="email-popup">
        <button class="popup-close" id="popupClose" aria-label="Close popup">&times;</button>
        <h3>Join the Campaign</h3>
        <p>Stay informed about Aaron's fight for Florida's 6th District. Get news, events, and volunteer opportunities delivered to your inbox.</p>
        <form class="email-form" id="popupSignupForm">
            <input type="email" name="email" placeholder="Your email address" required>
            <button type="submit" class="btn btn--primary">Count Me In</button>
        </form>
    </div>
</div>

<!-- Cookie Consent -->
<div class="cookie-banner" id="cookieBanner">
    <p>We use cookies to improve your experience and analyze site traffic. By continuing to use this site, you agree to our <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>.</p>
    <button class="btn btn--outline-white btn--sm" id="cookieAccept">Accept</button>
</div>

<?php wp_footer(); ?>
</body>
</html>
