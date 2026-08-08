<?php
/**
 * Footer Template for Bitcoin Trend Elite Theme
 *
 * @package Bitcoin_Trend_Elite
 */
?>
  <!-- Footer Component -->
  <footer class="w-full bg-surface-container-lowest border-t border-outline-variant/20 mt-auto">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 px-6 md:px-16 py-16 max-w-screen-2xl mx-auto">
      
      <!-- Brand & Mission Column -->
      <div class="md:col-span-4 space-y-4">
        <a class="font-display text-2xl text-primary font-bold flex items-center gap-3" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> Home">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-8 w-auto object-contain" />
        </a>
        <p class="font-body text-sm text-on-surface-variant opacity-80 max-w-xs leading-relaxed">
          An immersive platform dedicated to exploring cryptocurrency, blockchain technology, and digital trends.
        </p>
      </div>

      <!-- Navigation Links -->
      <div class="md:col-span-2 space-y-4">
        <h4 class="font-mono text-xs text-on-surface uppercase opacity-50 tracking-wider">Navigation</h4>
        <ul class="space-y-2.5 font-body text-sm text-on-surface-variant">
          <li><a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
          <li><a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/#dispatches' ) ); ?>">Blog Archives</a></li>
          <li><a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/about' ) ); ?>">About & Manifesto</a></li>
        </ul>
      </div>

      <!-- Legal & Access -->
      <div class="md:col-span-2 space-y-4">
        <h4 class="font-mono text-xs text-on-surface uppercase opacity-50 tracking-wider">Legal & Access</h4>
        <ul class="space-y-2.5 font-body text-sm text-on-surface-variant">
          <li><a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/about' ) ); ?>">Company Policy</a></li>
          <li><a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/about' ) ); ?>">Privacy</a></li>
          <li><a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/about#contact' ) ); ?>">Contact</a></li>
        </ul>
      </div>

      <!-- Connect Us -->
      <div class="md:col-span-4 space-y-4">
        <h4 class="font-mono text-xs text-on-surface uppercase opacity-50 tracking-wider">Connect Us</h4>
        <div class="space-y-3">
          <a href="mailto:info@bitcointrendelite.com" class="text-xs font-mono text-primary hover:underline block font-semibold">info@bitcointrendelite.com</a>
          <div class="flex space-x-4">
            <a class="text-on-surface-variant hover:text-red-500 transition-colors p-2 rounded-lg bg-surface-container/50" href="https://youtube.com/@bitcointrendelite" target="_blank" rel="noopener noreferrer" aria-label="Official YouTube Channel">
              <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
            <a class="text-on-surface-variant hover:text-blue-500 transition-colors p-2 rounded-lg bg-surface-container/50" href="https://facebook.com/bitcointrendelite" target="_blank" rel="noopener noreferrer" aria-label="Official Facebook Page">
              <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a class="text-on-surface-variant hover:text-primary transition-colors p-2 rounded-lg bg-surface-container/50" href="https://x.com/bitcointrendelite" target="_blank" rel="noopener noreferrer" aria-label="Official X Profile">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Copyright & Live Block Height -->
      <div class="md:col-span-12 pt-8 border-t border-outline-variant/10 flex flex-col md:flex-row justify-between items-center text-xs font-mono opacity-60 space-y-2 md:space-y-0">
        <p>© <?php echo esc_html( date( 'Y' ) ); ?> Bitcoin Trend Elite. Professional Cryptocurrency & Digital Trends Platform.</p>
        <p data-stat="block-height">Block Height: 841,234</p>
      </div>

    </div>
  </footer>

  <!-- SEARCH MODAL -->
  <div id="search-modal" class="fixed inset-0 z-[9000] hidden items-center justify-center bg-black/85 backdrop-blur-xl p-4 transition-all duration-300" role="dialog" aria-modal="true" aria-label="Search Archives">
    <div class="w-full max-w-2xl bg-[#1e2020] border border-amber-500/30 rounded-2xl p-6 md:p-8 shadow-2xl space-y-6 relative overflow-hidden">
      <button id="close-search-modal" class="absolute top-6 right-6 text-on-surface-variant hover:text-primary transition-colors p-2" aria-label="Close Search Modal">
        <span class="material-symbols-outlined text-2xl">close</span>
      </button>

      <div class="space-y-1">
        <span class="font-mono text-xs text-primary uppercase tracking-widest font-bold">Search Sanctuary</span>
        <h3 class="font-display text-2xl text-on-surface font-bold">Explore Archives & Theory</h3>
      </div>

      <div class="relative">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-2xl">search</span>
        <input id="modal-search-input" type="text" placeholder="Search by title, cypherpunk, economics, or author..." 
          class="w-full bg-[#121414] border border-outline-variant/40 rounded-xl pl-12 pr-4 py-3.5 text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary font-mono text-xs outline-none transition-all" />
      </div>

      <div id="search-results-list" class="max-h-80 overflow-y-auto space-y-3 pr-2 scrollbar-thin">
        <p class="text-xs font-mono text-on-surface-variant/60 text-center py-6">Type a keyword to begin searching the archives...</p>
      </div>
    </div>
  </div>

  <!-- SUBSCRIBE MODAL -->
  <div id="subscribe-modal" class="fixed inset-0 z-[9000] hidden items-center justify-center bg-black/85 backdrop-blur-xl p-4 transition-all duration-300" role="dialog" aria-modal="true" aria-label="Subscribe to Editorial Circle">
    <div class="w-full max-w-lg bg-[#1e2020] border border-amber-500/30 rounded-2xl p-6 md:p-8 shadow-2xl space-y-6 relative overflow-hidden">
      <button id="close-subscribe-modal" class="absolute top-6 right-6 text-on-surface-variant hover:text-primary transition-colors p-2" aria-label="Close Subscribe Modal">
        <span class="material-symbols-outlined text-2xl">close</span>
      </button>

      <div class="space-y-2 text-center">
        <div class="w-12 h-12 rounded-full bg-primary/10 border border-primary/30 flex items-center justify-center mx-auto text-primary">
          <span class="material-symbols-outlined text-2xl">mark_email_unread</span>
        </div>
        <span class="font-mono text-xs text-primary uppercase tracking-widest font-bold block">Editorial Circle</span>
        <h3 class="font-display text-2xl text-on-surface font-bold">Join the Dispatch</h3>
        <p class="font-body text-sm text-on-surface-variant">Weekly analytical dispatches on Bitcoin philosophy, monetary history, and digital sovereignty.</p>
      </div>

      <form id="modal-subscribe-form" class="space-y-4">
        <div>
          <input id="modal-subscribe-email" type="email" required placeholder="ENCRYPTED EMAIL ADDRESS" 
            class="w-full bg-[#121414] border border-outline-variant/40 rounded-xl px-4 py-3.5 text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary font-mono text-xs uppercase tracking-wider outline-none transition-all" />
        </div>
        <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-orange-500 text-black py-3.5 rounded-xl font-mono text-xs uppercase tracking-widest font-bold hover:brightness-110 hover:shadow-lg hover:shadow-orange-500/20 transition-all">
          Authorize Subscription
        </button>
      </form>
    </div>
  </div>

  <!-- MOBILE NAVIGATION DRAWER -->
  <div id="mobile-nav-drawer" class="fixed inset-0 z-[8000] hidden bg-black/90 backdrop-blur-2xl transition-all duration-300 flex-col justify-between p-6">
    <div class="flex justify-between items-center pb-6 border-b border-outline-variant/30">
      <a class="font-display text-xl font-bold text-primary flex items-center gap-3" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> Home">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-9 w-auto object-contain" />
      </a>
      <button id="close-mobile-drawer" class="text-on-surface-variant hover:text-primary p-2" aria-label="Close Navigation Menu">
        <span class="material-symbols-outlined text-3xl">close</span>
      </button>
    </div>

    <nav class="flex flex-col space-y-6 my-auto text-center font-mono text-lg uppercase tracking-widest">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-nav-link text-on-surface hover:text-primary transition-colors py-2">Home</a>
      <a href="<?php echo esc_url( home_url( '/#dispatches' ) ); ?>" class="mobile-nav-link text-on-surface hover:text-primary transition-colors py-2">Blogs</a>
      <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="mobile-nav-link text-on-surface hover:text-primary transition-colors py-2">About</a>
    </nav>

    <div class="pt-6 border-t border-outline-variant/30 text-center space-y-3 font-mono text-xs text-on-surface-variant">
      <button class="subscribe-btn bg-primary text-black w-full py-3 rounded-xl uppercase font-bold tracking-widest mb-2">
        Subscribe to Journal
      </button>
      <p>© <?php echo esc_html( date( 'Y' ) ); ?> Bitcoin Trend Elite. All Rights Reserved.</p>
    </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>
