<?php
/**
 * Template Name: About
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>About Aaron Baker</h1>
        <p>A working-class conservative from Florida's 6th District who believes in people before politics.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container about-content">
        <div class="about-text">
            <h2>Personal Background</h2>
            <p>Aaron Baker was born in Lakeland, Florida in 1980 and now lives in Sorrento — right in the heart of Florida's 6th Congressional District. He's not a career politician or an establishment-backed candidate. He's a neighbor who has watched disconnected leadership fail the very communities it's meant to serve.</p>

            <p>As a contractor by trade, Aaron understands the challenges working families face every day — rising costs, crumbling infrastructure, and a government that too often prioritizes everything except its own citizens.</p>

            <h2>Why He's Running</h2>
            <p>The turning point came just before Hurricane Milton made landfall. Sitting at home, Aaron found himself asking a question that changed everything: <em>"How can an average citizen truly make a difference?"</em></p>

            <p>That question ignited a sense of purpose. Aaron reconnected with acquaintances in Pennsylvania and dedicated time on the ground with Scott Presler's Early Vote Action before November 5th. That experience reaffirmed a powerful truth: anyone, regardless of their background, has the ability to step up and create meaningful change.</p>

            <p>Aaron is running because he believes a congressman should represent the district he lives in. He's the only Republican candidate who calls FL-6 home — and he's committed to being accessible, accountable, and present every single day.</p>

            <h2>Community Involvement</h2>
            <p>Aaron doesn't just talk about showing up — he does it. From supporting early voting efforts to attending local events across Volusia, Flagler, St. Johns, Putnam, Marion, and Lake Counties, Aaron has dedicated himself to understanding the needs of every community in the district.</p>

            <p>He's worked on multiple campaigns and has built relationships with leaders at the local, state, and federal level. Aaron is a supporter of a federally balanced budget, constitutional rights, and putting Americans first in every policy decision.</p>

            <h2>His Vision</h2>
            <p>Aaron believes in an America First agenda that prioritizes:</p>
            <ul class="policy-list">
                <li>Taking care of every American before the rest of the world</li>
                <li>Protecting constitutional rights — especially the 1st and 2nd Amendments</li>
                <li>Addressing local infrastructure needs like flooding, beach erosion, and transportation</li>
                <li>Supporting law enforcement with legislation like the Lifesaving Gear for Police Act</li>
                <li>Working toward a federally balanced budget to fight inflation</li>
                <li>Empowering parents in education decisions</li>
            </ul>
        </div>

        <div class="about-sidebar">
            <div class="about-photo">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'about-photo' ); ?>
                <?php else : ?>
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--navy);color:white;font-family:var(--font-heading);font-size:3rem;">Aaron Baker</div>
                <?php endif; ?>
            </div>

            <div class="pull-quote">
                <p>How can an average citizen truly make a difference? That question ignited a sense of purpose — and led me to run for Congress.</p>
                <cite>— Aaron Baker</cite>
            </div>

            <div style="margin-top: 24px; padding: 24px; background: var(--off-white); border-radius: var(--radius-lg);">
                <h4 style="margin-bottom: 12px;">Quick Facts</h4>
                <p style="font-size: 0.92rem; color: var(--text-mid); margin-bottom: 8px;">🏠 <strong>Lives in:</strong> Sorrento, FL</p>
                <p style="font-size: 0.92rem; color: var(--text-mid); margin-bottom: 8px;">🎂 <strong>Born:</strong> Lakeland, FL (1980)</p>
                <p style="font-size: 0.92rem; color: var(--text-mid); margin-bottom: 8px;">🇺🇸 <strong>Party:</strong> Republican</p>
                <p style="font-size: 0.92rem; color: var(--text-mid); margin-bottom: 8px;">🏗️ <strong>Career:</strong> Contractor</p>
                <p style="font-size: 0.92rem; color: var(--text-mid);">🗳️ <strong>Running for:</strong> FL-6 U.S. Congress</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
