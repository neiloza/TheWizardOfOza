<?php
/**
 * Template Name: Contact
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Contact the Campaign</h1>
        <p>Have a question, concern, or idea? We'd love to hear from you.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container contact-grid">
        <div>
            <h2 style="margin-bottom: 24px;">Get in Touch</h2>

            <div class="contact-info-item">
                <div class="contact-icon">✉️</div>
                <div>
                    <h4>Email</h4>
                    <a href="mailto:<?php echo esc_attr( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?></a>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon">📬</div>
                <div>
                    <h4>Mailing Address</h4>
                    <p><?php echo esc_html( get_theme_mod( 'campaign_address', 'P.O. Box 233, Sorrento, Florida 32776' ) ); ?></p>
                </div>
            </div>

            <?php $phone = get_theme_mod( 'campaign_phone', '' ); if ( $phone ) : ?>
            <div class="contact-info-item">
                <div class="contact-icon">📞</div>
                <div>
                    <h4>Phone</h4>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                </div>
            </div>
            <?php endif; ?>

            <h3 style="margin-top: 32px; margin-bottom: 16px;">Follow the Campaign</h3>
            <?php ab_social_links_html(); ?>

            <div style="margin-top: 40px; padding: 24px; background: var(--off-white); border-radius: var(--radius-lg);">
                <h4 style="margin-bottom: 8px;">Looking to Volunteer?</h4>
                <p style="color: var(--text-mid); font-size: 0.92rem; margin-bottom: 16px;">If you want to get involved with the campaign, head over to our dedicated volunteer page.</p>
                <a href="<?php echo esc_url( home_url( '/volunteer/' ) ); ?>" class="btn btn--primary btn--sm">Volunteer Sign Up</a>
            </div>
        </div>

        <div>
            <div style="background: var(--off-white); border-radius: var(--radius-lg); padding: 36px;">
                <h3 style="margin-bottom: 8px;">Send a Message</h3>
                <p style="color: var(--text-mid); margin-bottom: 24px; font-size: 0.95rem;">For general inquiries, feedback, or questions about the campaign.</p>

                <form id="contactForm">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="contact-name">Full Name *</label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email Address *</label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-subject">Subject</label>
                        <select id="contact-subject" name="subject">
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Policy Question">Policy Question</option>
                            <option value="Media Inquiry">Media Inquiry</option>
                            <option value="Endorsement">Endorsement</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact-message">Message *</label>
                        <textarea id="contact-message" name="message" required placeholder="How can we help?"></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary btn--block">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
