<?php
/**
 * Template Name: Volunteer
 */
get_header();
?>

<section class="page-hero">
    <div class="container">
        <?php ab_breadcrumbs(); ?>
        <h1>Volunteer for Aaron</h1>
        <p>Join hundreds of supporters across Florida's 6th District who are making a difference.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container volunteer-content">
        <div class="volunteer-info">
            <h2>Why Volunteer?</h2>
            <p>Campaigns are won on the ground — by real people having real conversations with their neighbors. When you volunteer for Aaron Baker's campaign, you become part of a grassroots movement that puts people before politics.</p>
            <p>Whether you have a few hours a week or a few hours a month, there's a meaningful way for you to contribute. Every door knocked, every call made, and every conversation had brings us one step closer to winning.</p>

            <h2 style="margin-top: 32px;">Ways to Help</h2>
            <ul class="volunteer-roles">
                <li>
                    <div class="role-icon">🚪</div>
                    <div>
                        <strong>Door-to-Door Canvassing</strong>
                        <p>Talk to voters in your neighborhood about Aaron's platform and why he's the right choice for FL-6.</p>
                    </div>
                </li>
                <li>
                    <div class="role-icon">📞</div>
                    <div>
                        <strong>Phone Banking</strong>
                        <p>Make calls from home to registered voters, share Aaron's message, and identify supporters.</p>
                    </div>
                </li>
                <li>
                    <div class="role-icon">🎉</div>
                    <div>
                        <strong>Event Support</strong>
                        <p>Help organize and run campaign events, rallies, and community meet-and-greets.</p>
                    </div>
                </li>
                <li>
                    <div class="role-icon">📱</div>
                    <div>
                        <strong>Social Media</strong>
                        <p>Amplify Aaron's message online by sharing content, creating posts, and engaging with supporters.</p>
                    </div>
                </li>
                <li>
                    <div class="role-icon">💰</div>
                    <div>
                        <strong>Fundraising</strong>
                        <p>Help organize fundraising events or reach out to potential donors in your network.</p>
                    </div>
                </li>
            </ul>
        </div>

        <div>
            <div style="background: var(--off-white); border-radius: var(--radius-lg); padding: 36px;">
                <h3 style="margin-bottom: 8px;">Sign Up to Volunteer</h3>
                <p style="color: var(--text-mid); margin-bottom: 24px; font-size: 0.95rem;">Fill out the form below and we'll reach out with opportunities that match your interests and availability.</p>

                <form id="volunteerForm">
                    <div class="form-group">
                        <label for="vol-name">Full Name *</label>
                        <input type="text" id="vol-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="vol-email">Email Address *</label>
                        <input type="email" id="vol-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="vol-phone">Phone Number</label>
                        <input type="tel" id="vol-phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="vol-zip">Zip Code *</label>
                        <input type="text" id="vol-zip" name="zip" required maxlength="10">
                    </div>
                    <div class="form-group">
                        <label>Areas of Interest</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="areas[]" value="canvassing"> Door-to-Door Canvassing</label>
                            <label><input type="checkbox" name="areas[]" value="phone-banking"> Phone Banking</label>
                            <label><input type="checkbox" name="areas[]" value="events"> Event Support</label>
                            <label><input type="checkbox" name="areas[]" value="social-media"> Social Media</label>
                            <label><input type="checkbox" name="areas[]" value="fundraising"> Fundraising</label>
                            <label><input type="checkbox" name="areas[]" value="other"> Other</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vol-availability">Availability</label>
                        <select id="vol-availability" name="availability">
                            <option value="">Select your availability</option>
                            <option value="weekdays">Weekdays</option>
                            <option value="weekends">Weekends</option>
                            <option value="evenings">Evenings</option>
                            <option value="flexible">Flexible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn--primary btn--block">Join the Team</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
