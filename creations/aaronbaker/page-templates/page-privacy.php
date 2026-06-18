<?php
/**
 * Template Name: Privacy Policy
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Privacy Policy</h1>
        <p>How the Aaron Baker for Congress campaign collects, uses, and protects your information.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="legal-content">
            <p><strong>Last updated:</strong> <?php echo date( 'F j, Y' ); ?></p>

            <h2>Introduction</h2>
            <p>Aaron Baker for Congress ("the Campaign," "we," "us," or "our") is committed to protecting the privacy of our supporters, volunteers, donors, and website visitors. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website aaron4fl6.com and interact with our campaign.</p>

            <h2>Information We Collect</h2>
            <p>We may collect the following types of information:</p>
            <ul>
                <li><strong>Personal Information:</strong> Name, email address, mailing address, phone number, zip code, occupation, and employer name (as required by FEC regulations for contributions over $200).</li>
                <li><strong>Donation Information:</strong> Contribution amounts and payment information processed through secure third-party platforms (WinRed and Anedot).</li>
                <li><strong>Volunteer Information:</strong> Areas of interest, availability, and skills offered through volunteer sign-up forms.</li>
                <li><strong>Usage Data:</strong> IP address, browser type, pages visited, time spent on pages, and other analytical data collected through cookies and similar technologies.</li>
            </ul>

            <h2>How We Use Your Information</h2>
            <p>We use the information we collect to:</p>
            <ul>
                <li>Communicate campaign news, events, and updates via email</li>
                <li>Process and acknowledge donations</li>
                <li>Coordinate volunteer activities</li>
                <li>Respond to inquiries and requests</li>
                <li>Comply with FEC reporting requirements</li>
                <li>Improve our website and campaign outreach</li>
                <li>Analyze website traffic and user behavior</li>
            </ul>

            <h2>FEC Disclosure</h2>
            <p>Federal election law requires political campaigns to report the name, mailing address, occupation, and employer of individuals whose contributions exceed $200 in an election cycle. This information is reported to the Federal Election Commission (FEC) and becomes part of the public record.</p>

            <h2>Third-Party Services</h2>
            <p>We use trusted third-party services to process donations (WinRed and Anedot), send emails, and analyze website performance. These services have their own privacy policies governing the use of your information. We encourage you to review their policies.</p>

            <h2>Cookies</h2>
            <p>Our website uses cookies to improve your browsing experience and analyze site traffic. You can control cookie settings through your browser preferences. Disabling cookies may affect some website functionality.</p>

            <h2>Data Security</h2>
            <p>We implement reasonable security measures to protect your personal information. However, no method of electronic transmission or storage is 100% secure. We cannot guarantee absolute security of your data.</p>

            <h2>Your Rights</h2>
            <p>You may:</p>
            <ul>
                <li>Request access to the personal information we hold about you</li>
                <li>Request correction of inaccurate information</li>
                <li>Request deletion of your information (subject to FEC record-keeping requirements)</li>
                <li>Unsubscribe from campaign emails at any time using the link provided in each email</li>
            </ul>

            <h2>Children's Privacy</h2>
            <p>Our website is not intended for children under 13. We do not knowingly collect personal information from children under 13.</p>

            <h2>Changes to This Policy</h2>
            <p>We may update this Privacy Policy periodically. Changes will be posted on this page with an updated revision date.</p>

            <h2>Contact Us</h2>
            <p>If you have questions about this Privacy Policy, please contact us:</p>
            <ul>
                <li>Email: <a href="mailto:<?php echo esc_attr( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'campaign_email', 'aaron@aaron4fl6.com' ) ); ?></a></li>
                <li>Mail: <?php echo esc_html( get_theme_mod( 'campaign_address', 'P.O. Box 233, Sorrento, Florida 32776' ) ); ?></li>
            </ul>

            <p style="margin-top: 32px; font-style: italic; color: var(--text-light);"><?php echo esc_html( get_theme_mod( 'fec_disclaimer', "Paid for by Aaron Baker, Republican Candidate for Florida's 6th Congressional District." ) ); ?></p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
