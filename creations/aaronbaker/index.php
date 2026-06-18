<?php get_header(); ?>

<section class="page-hero">
    <div class="container">
        <?php if ( is_home() ) : ?>
            <h1>Newsroom</h1>
            <p>Campaign news, press releases, and media coverage.</p>
        <?php elseif ( is_archive() ) : ?>
            <h1><?php the_archive_title(); ?></h1>
            <?php the_archive_description( '<p>', '</p>' ); ?>
        <?php elseif ( is_search() ) : ?>
            <h1>Search Results for: "<?php echo get_search_query(); ?>"</h1>
        <?php else : ?>
            <h1>Latest News</h1>
        <?php endif; ?>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="blog-grid">
                <?php while ( have_posts() ) : the_post();
                    $cats = get_the_terms( get_the_ID(), 'news_category' );
                    $cat_name = $cats ? $cats[0]->name : 'News';
                ?>
                    <article class="news-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="news-card-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'news-card' ); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="news-card-body">
                            <div class="news-meta">
                                <span class="news-category"><?php echo esc_html( $cat_name ); ?></span>
                                <span class="news-date"><?php echo get_the_date(); ?></span>
                            </div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 25 ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php echo paginate_links( array( 'prev_text' => '←', 'next_text' => '→' ) ); ?>
            </div>
        <?php else : ?>
            <div style="text-align: center; padding: 60px;">
                <h2>Nothing found</h2>
                <p style="color: var(--text-mid); margin-top: 12px;">
                    <?php if ( is_search() ) : ?>
                        No results matched your search. Try different keywords.
                    <?php else : ?>
                        No content has been published yet. Check back soon.
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
