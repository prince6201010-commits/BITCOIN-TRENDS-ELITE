<?php
/**
 * Category Archive Template for Bitcoin Trend Elite Theme
 *
 * @package Bitcoin_Trend_Elite
 */

get_header();

$current_cat  = get_queried_object();
$current_slug = is_category() ? $current_cat->slug : 'ALL';
$current_name = is_category() ? $current_cat->name : 'All Dispatches';
$all_categories = get_categories( array( 'hide_empty' => false ) );
?>

<main class="pt-28 pb-24 max-w-screen-2xl mx-auto px-6 md:px-16 flex-grow">
  <!-- Header Banner -->
  <div class="space-y-4 mb-12 border-b border-outline-variant/20 pb-8">
    <span class="font-mono text-xs uppercase tracking-[0.3em] text-primary font-bold">Curated Index</span>
    <h1 class="font-display text-4xl md:text-6xl font-bold text-on-surface">
      <?php if ( is_category() ) : ?>
        <?php single_cat_title(); ?> Archives
      <?php else : ?>
        The Editorial Archives
      <?php endif; ?>
    </h1>
    <p class="font-body text-lg text-on-surface-variant max-w-3xl font-light">
      Explore publications categorized by Austrian economics, cypherpunk philosophy, technological advancements, and sovereign culture.
    </p>
  </div>

  <!-- Category Filter Bar & Live Search -->
  <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-12">
    <!-- Filter Pills -->
    <div class="flex flex-wrap items-center gap-3 md:gap-4" id="category-pills">
      <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url( '/#dispatches' ) ); ?>" 
        class="<?php echo ! is_category() ? 'cat-pill-active' : 'cat-pill-inactive'; ?> px-7 py-3.5 md:px-9 md:py-4 rounded-2xl font-mono text-sm md:text-base uppercase tracking-wider font-bold transition-all duration-300 shadow-xl inline-block">
        All Dispatches
      </a>

      <?php foreach ( $all_categories as $cat ) : ?>
        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" 
          class="<?php echo ( is_category() && $current_cat->term_id === $cat->term_id ) ? 'cat-pill-active' : 'cat-pill-inactive'; ?> px-7 py-3.5 md:px-9 md:py-4 rounded-2xl font-mono text-sm md:text-base uppercase tracking-wider font-bold transition-all duration-300 shadow-xl inline-block">
          <?php echo esc_html( $cat->name ); ?>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Search Input -->
    <div class="relative w-full lg:w-80">
      <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant/60 text-lg">search</span>
      <input id="cat-search-input" type="text" placeholder="Search archives..." class="w-full bg-surface-container-low border border-outline-variant/40 rounded-full pl-10 pr-4 py-2 text-xs font-mono text-on-surface focus:border-primary outline-none transition-all"/>
    </div>
  </div>

  <!-- Grid Container -->
  <div id="category-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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

  <!-- Pagination -->
  <div class="mt-16 flex justify-center font-mono text-xs">
    <?php
    the_posts_pagination( array(
	    'mid_size'  => 2,
	    'prev_text' => __( '← Previous', 'bitcoin-trend-elite' ),
	    'next_text' => __( 'Next →', 'bitcoin-trend-elite' ),
	    'class'     => 'flex space-x-2',
    ) );
    ?>
  </div>
</main>

<?php
get_footer();
