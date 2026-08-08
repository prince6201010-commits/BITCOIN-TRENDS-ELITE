<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Bitcoin_Trend_Elite
 */
?>

<div class="col-span-full py-16 text-center space-y-4">
  <div class="w-16 h-16 rounded-full bg-primary/10 border border-primary/30 flex items-center justify-center mx-auto text-primary">
    <span class="material-symbols-outlined text-3xl">article</span>
  </div>
  <h3 class="font-display text-2xl font-bold text-on-surface"><?php esc_html_e( 'No Dispatches Found', 'bitcoin-trend-elite' ); ?></h3>
  <p class="font-body text-sm text-on-surface-variant max-w-md mx-auto opacity-70">
    <?php if ( is_search() ) : ?>
      <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'bitcoin-trend-elite' ); ?>
    <?php else : ?>
      <?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'bitcoin-trend-elite' ); ?>
    <?php endif; ?>
  </p>
</div>
