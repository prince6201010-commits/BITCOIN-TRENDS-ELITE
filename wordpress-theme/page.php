<?php
/**
 * Generic Page Template for Bitcoin Trend Elite Theme
 *
 * @package Bitcoin_Trend_Elite
 */

get_header();
?>

<main class="pt-28 pb-24 max-w-4xl mx-auto px-6 md:px-12 flex-grow">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="space-y-4 mb-12 border-b border-outline-variant/20 pb-8">
      <h1 class="font-display text-4xl md:text-6xl font-bold text-on-surface"><?php the_title(); ?></h1>
    </div>

    <div class="prose prose-invert max-w-none text-on-surface-variant font-body text-base md:text-lg leading-relaxed space-y-6">
      <?php the_content(); ?>
    </div>
  <?php endwhile; ?>
</main>

<?php
get_footer();
