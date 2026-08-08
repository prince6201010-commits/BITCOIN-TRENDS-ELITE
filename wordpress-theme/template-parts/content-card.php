<?php
/**
 * Template part for displaying blog post cards in grid / list format
 *
 * @package Bitcoin_Trend_Elite
 */

$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Bitcoin';
$image_url  = bte_get_featured_image_url( get_the_ID(), 'bte-card' );
$read_time  = bte_get_read_time( get_the_ID() );
$post_date  = get_the_date( 'M j, Y' );
?>
<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'group block space-y-4' ); ?>>
  <div class="relative aspect-[3/4] overflow-hidden rounded-2xl border border-white/5 shadow-xl bg-surface-container">
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
  </div>
  <div class="space-y-2">
    <span class="font-mono text-[10px] text-primary uppercase font-bold tracking-wider"><?php echo esc_html( $cat_name ); ?></span>
    <h4 class="font-display text-xl font-bold text-on-surface group-hover:text-primary transition-colors leading-snug">
      <?php the_title(); ?>
    </h4>
    <p class="font-body text-sm text-on-surface-variant line-clamp-2 opacity-80">
      <?php echo esc_html( get_the_excerpt() ); ?>
    </p>
    <div class="pt-2 flex items-center space-x-2 font-mono text-[11px] text-on-surface-variant/60">
      <span><?php echo esc_html( $read_time ); ?></span>
      <span>•</span>
      <span><?php echo esc_html( $post_date ); ?></span>
    </div>
  </div>
</a>
