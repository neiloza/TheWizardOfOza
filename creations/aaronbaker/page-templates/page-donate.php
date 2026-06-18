<?php
/**
 * Template Name: Donate
 */
get_header();
$winred_url = get_theme_mod( 'winred_url', 'https://secure.winred.com/aaron-4-fl/donate-today' );
$anedot_url = get_theme_mod( 'anedot_url', 'https://secure.anedot.com/aaron-4-fl/donate' );
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Support the Campaign</h1>
        <p>Your contribution powers a grassroots campaign for real representation in Florida's 6th District.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="donate-page-content">
            <h2>Why Your Donation Matters</h2>
            <p>Aaron Baker's campaign is funded by everyday people — not corporate PACs or special interest groups. Every dollar you contribute goes directly toward:</p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 32px 0; text-align: center;">
                <div style="padding: 24px; background: var(--off-white); border-radius: var(--radius-lg);">
                    <div style="font-size: 2rem; margin-bottom: 8px;">🚪</div>
                    <strong style="display: block; margin-bottom: 4px;">Grassroots Outreach</strong>
                    <p style="font-size: 0.85rem; color: var(--text-mid);">Reaching voters door-to-door across the district</p>
                </div>
                <div style="padding: 24px; background: var(--off-white); border-radius: var(--radius-lg);">
                    <div style="font-size: 2rem; margin-bottom: 8px;">📣</div>
                    <strong style="display: block; margin-bottom: 4px;">Campaign Materials</strong>
                    <p style="font-size: 0.85rem; color: var(--text-mid);">Signs, flyers, digital ads, and voter guides</p>
                </div>
                <div style="padding: 24px; background: var(--off-white); border-radius: var(--radius-lg);">
                    <div style="font-size: 2rem; margin-bottom: 8px;">🎤</div>
                    <strong style="display: block; margin-bottom: 4px;">Community Events</strong>
                    <p style="font-size: 0.85rem; color: var(--text-mid);">Town halls, meet-and-greets, and rallies</p>
                </div>
            </div>

            <div class="donate-options">
                <div class="donate-option">
                    <h3>WinRed</h3>
                    <p>The official Republican fundraising platform. Secure, fast, and widely used by GOP candidates and donors.</p>
                    <a href="<?php echo esc_url( $winred_url ); ?>" class="btn btn--primary btn--lg btn--block" target="_blank" rel="noopener">Donate via WinRed</a>
                </div>
                <div class="donate-option">
                    <h3>Anedot</h3>
                    <p>An alternative donation platform with low processing fees, ensuring more of your contribution reaches the campaign.</p>
                    <a href="<?php echo esc_url( $anedot_url ); ?>" class="btn btn--secondary btn--lg btn--block" target="_blank" rel="noopener">Donate via Anedot</a>
                </div>
            </div>

            <div class="fec-disclaimer">
                <strong>FEC Disclaimer:</strong> Contributions to Aaron Baker for Congress are not tax-deductible. Federal law requires us to use our best efforts to collect and report the name, mailing address, occupation, and name of employer of individuals whose contributions exceed $200 in an election cycle. Contributions from foreign nationals, federal government contractors, corporations, and labor organizations are prohibited.
                <br><br>
                <?php echo esc_html( get_theme_mod( 'fec_disclaimer', "Paid for by Aaron Baker, Republican Candidate for Florida's 6th Congressional District." ) ); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
