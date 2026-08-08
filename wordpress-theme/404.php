<?php
/**
 * 404 Not Found Template for Bitcoin Trend Elite Theme
 *
 * @package Bitcoin_Trend_Elite
 */

get_header();
?>

<main class="pt-36 pb-32 max-w-4xl mx-auto px-6 text-center space-y-8 flex-grow">
  <div class="w-20 h-20 rounded-full bg-primary/10 border border-primary/30 flex items-center justify-center mx-auto text-primary">
    <span class="material-symbols-outlined text-4xl">search_off</span>
  </div>

  <span class="font-mono text-xs text-primary uppercase tracking-[0.4em] font-bold block">404 Error — Block Unconfirmed</span>
  <h1 class="font-display text-4xl sm:text-6xl font-bold text-on-surface">Dispatch Not Found in Ledger</h1>
  <p class="font-body text-base md:text-lg text-on-surface-variant max-w-lg mx-auto">
    The requested cryptographic path or article does not exist. Please return to the homepage or explore published archives.
  </p>

  <div>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-3 bg-gradient-to-r from-amber-500 to-orange-500 text-black px-8 py-4 rounded-xl font-mono text-xs uppercase tracking-widest font-bold hover:brightness-110 shadow-lg shadow-orange-500/20 transition-all">
      <span class="material-symbols-outlined text-sm">home</span>
      <span>Return to Sanctuary Home</span>
    </a>
  </div>
</main>

<?php
get_footer();
