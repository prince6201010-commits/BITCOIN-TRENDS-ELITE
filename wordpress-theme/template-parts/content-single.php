<?php
/**
 * Template part for displaying single post content
 *
 * @package Bitcoin_Trend_Elite
 */

$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Economic Theory';
$read_time  = bte_get_read_time( get_the_ID() );
$post_date  = get_the_date( 'F j, Y' );
$author_id  = get_the_author_meta( 'ID' );
$author_name = get_the_author_meta( 'display_name' );
$author_role = get_the_author_meta( 'description' );
if ( empty( $author_role ) ) {
	$author_role = 'Senior Fellow, Nakamoto Institute';
}
$author_avatar = get_avatar_url( $author_id, array( 'size' => 128 ) );
$featured_img  = bte_get_featured_image_url( get_the_ID(), 'bte-hero' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'relative z-20 bg-surface pt-28 pb-20 flex-grow' ); ?>>
  <div class="max-w-4xl md:max-w-5xl mx-auto px-6 md:px-12">
    
    <!-- Back to Dispatches Button -->
    <a href="<?php echo esc_url( home_url( '/#dispatches' ) ); ?>" class="inline-flex items-center gap-2 font-mono text-xs text-primary hover:underline mb-8 uppercase tracking-wider font-bold">
      <span class="material-symbols-outlined text-sm">arrow_back</span>
      <span>Back to All Dispatches</span>
    </a>

    <!-- Article Header Meta -->
    <div class="mb-6 flex flex-wrap items-center gap-3 font-mono text-xs">
      <span class="bg-primary/10 border border-primary/30 px-3 py-1 text-primary font-bold uppercase tracking-wider rounded-md">
        <?php echo esc_html( $cat_name ); ?>
      </span>
      <span class="text-on-surface-variant opacity-70">• <?php echo esc_html( $read_time ); ?></span>
      <span class="text-on-surface-variant opacity-70">• <?php echo esc_html( $post_date ); ?></span>
    </div>

    <!-- Title -->
    <h1 class="font-display text-3xl sm:text-5xl md:text-6xl font-bold text-on-surface leading-tight mb-8 tracking-tight break-words">
      <?php the_title(); ?>
    </h1>

    <!-- Author Tag & Social Actions -->
    <div class="flex items-center justify-between mb-12 pb-8 border-b border-outline-variant/20 flex-wrap gap-4">
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-full border border-primary/30 overflow-hidden shadow-md shrink-0 bg-surface-container">
          <img class="w-full h-full object-cover" alt="<?php echo esc_attr( $author_name ); ?>" src="<?php echo esc_url( $author_avatar ); ?>"/>
        </div>
        <div>
          <p class="font-mono text-xs text-primary uppercase font-bold tracking-wider"><?php echo esc_html( $author_name ); ?></p>
          <p class="font-body text-xs text-on-surface-variant opacity-70"><?php echo esc_html( $author_role ); ?></p>
        </div>
      </div>

      <div class="flex items-center space-x-3">
        <button id="btn-share" class="p-3 rounded-full bg-surface-container border border-white/10 text-on-surface-variant hover:text-primary hover:border-primary transition-all" title="Share Dispatch" aria-label="Share Dispatch">
          <span class="material-symbols-outlined text-xl">share</span>
        </button>
        <button id="btn-bookmark" class="p-3 rounded-full bg-surface-container border border-white/10 text-on-surface-variant hover:text-primary hover:border-primary transition-all" title="Bookmark Article" aria-label="Bookmark Article">
          <span class="material-symbols-outlined text-xl">bookmark</span>
        </button>
      </div>
    </div>

    <!-- Featured Image -->
    <?php if ( $featured_img ) : ?>
      <div class="mb-12 rounded-3xl overflow-hidden border border-outline-variant/30 shadow-2xl aspect-[16/9]">
        <img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover" />
      </div>
    <?php endif; ?>

    <!-- Article Main Body Content -->
    <div class="prose prose-invert max-w-none text-on-surface-variant font-body text-base md:text-xl leading-relaxed space-y-8 drop-cap">
      <?php the_content(); ?>
    </div>

  </div>
</article>
