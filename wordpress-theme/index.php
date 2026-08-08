<?php
/**
 * Main Index Template Fallback for Bitcoin Trend Elite Theme
 *
 * @package Bitcoin_Trend_Elite
 */

get_header();
?>

<main class="pt-28 pb-24 max-w-screen-2xl mx-auto px-6 md:px-16 flex-grow">
  <div class="space-y-4 mb-12 border-b border-outline-variant/20 pb-8">
    <span class="font-mono text-xs uppercase tracking-[0.3em] text-primary font-bold">Journal Archives</span>
    <h1 class="font-display text-4xl md:text-6xl font-bold text-on-surface"><?php single_post_title(); ?></h1>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php
    if ( have_posts() ) :
	    while ( have_posts() ) : the_post();
		    get_template_part( 'template-parts/content', 'card' );
	    endwhile;
    else :
	    get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>
  </div>
</main>

<?php
get_footer();
