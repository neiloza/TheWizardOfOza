<?php
/**
 * Template Name: District
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Florida's 6th Congressional District</h1>
        <p>Aaron's home — and the community he's fighting to represent in Congress.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="district-map">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'hero-large' ); ?>
            <?php else : ?>
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--navy-light);color:rgba(255,255,255,0.5);font-family:var(--font-heading);font-size:1.5rem;">
                    Florida's 6th Congressional District Map<br>
                    <span style="font-size:0.9rem;font-family:var(--font-body);">(Upload a district map image as this page's Featured Image)</span>
                </div>
            <?php endif; ?>
        </div>

        <div style="max-width: 800px;">
            <h2>About the District</h2>
            <p style="color: var(--text-mid); margin-bottom: 16px;">Florida's 6th Congressional District stretches across Northeast and Central Florida, encompassing diverse communities — from coastal resort towns to rural agricultural areas. With a Cook Partisan Voter Index of R+14, it's a solidly conservative district that deserves a representative who actually lives here and understands its unique challenges.</p>

            <p style="color: var(--text-mid); margin-bottom: 32px;">The district's poverty rate of 14.6% — three and a half percent higher than the national average — underscores the need for leadership that prioritizes local economic concerns. From flooding issues in Volusia County to the proposed Belvedere fuel terminal relocation near Ormond Beach and beach erosion along the coast, FL-6 has specific infrastructure needs that require a congressman who's present and engaged.</p>
        </div>

        <h2 style="margin-top: 40px; margin-bottom: 16px;">Counties in FL-6</h2>
        <div class="counties-grid">
            <div class="county-card">Volusia County</div>
            <div class="county-card">Flagler County</div>
            <div class="county-card">St. Johns County (part)</div>
            <div class="county-card">Putnam County</div>
            <div class="county-card">Marion County (part)</div>
            <div class="county-card">Lake County (part)</div>
        </div>

        <div style="margin-top: 48px; max-width: 800px;">
            <h2>Key Local Issues</h2>

            <div style="display: grid; gap: 20px; margin-top: 24px;">
                <div style="padding: 24px; border: 1px solid var(--border-light); border-radius: var(--radius-lg);">
                    <h4>🌊 Flooding & Stormwater Management</h4>
                    <p style="color: var(--text-mid); font-size: 0.95rem; margin-top: 8px;">Volusia County and surrounding areas face significant flooding concerns that require federal infrastructure investment and coordination with state and local officials.</p>
                </div>
                <div style="padding: 24px; border: 1px solid var(--border-light); border-radius: var(--radius-lg);">
                    <h4>🏖️ Beach Erosion</h4>
                    <p style="color: var(--text-mid); font-size: 0.95rem; margin-top: 8px;">Coastal communities along FL-6's Atlantic shoreline are losing beach at an alarming rate. Federal beach renourishment funding is critical to protecting property values and tourism.</p>
                </div>
                <div style="padding: 24px; border: 1px solid var(--border-light); border-radius: var(--radius-lg);">
                    <h4>⛽ Belvedere Fuel Terminal</h4>
                    <p style="color: var(--text-mid); font-size: 0.95rem; margin-top: 8px;">Working with local and state officials to relocate the proposed fuel terminal to a more appropriate location that protects Ormond Beach residents.</p>
                </div>
                <div style="padding: 24px; border: 1px solid var(--border-light); border-radius: var(--radius-lg);">
                    <h4>🐟 Red Snapper Fishing</h4>
                    <p style="color: var(--text-mid); font-size: 0.95rem; margin-top: 8px;">The federal government's restrictive regulations on Atlantic red snapper fishing days unfairly impact Florida anglers. This should be managed at the state level.</p>
                </div>
                <div style="padding: 24px; border: 1px solid var(--border-light); border-radius: var(--radius-lg);">
                    <h4>🛣️ Infrastructure & Growth</h4>
                    <p style="color: var(--text-mid); font-size: 0.95rem; margin-top: 8px;">Marion County faces growing road infrastructure challenges. The district needs a congressman who works with local officials to secure federal funding for critical projects.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
