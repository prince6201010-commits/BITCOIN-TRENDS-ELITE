<?php
/**
 * Front Page Template for Bitcoin Trend Elite Theme
 *
 * @package Bitcoin_Trend_Elite
 */

get_header();
?>

<main>
  <!-- Frame Scroll Animation Hero Section (210 Frames Engine) -->
  <section id="scroll-animation-section" class="relative">
    <div class="sticky-canvas-container">
      <canvas id="hero-canvas"></canvas>
      <div class="canvas-overlay-vignette"></div>

      <!-- Canvas Hero Text Overlay -->
      <div class="canvas-hero-text">
        <span class="font-mono text-xs text-primary tracking-[0.4em] uppercase block mb-4 animate-fadeInUp">Volume 01 — Issue IV</span>
        <h1 class="font-display text-4xl sm:text-6xl md:text-8xl text-on-surface leading-tight mb-6 font-bold tracking-tight">
          The Cultural Evolution <br/>of <span class="text-gradient-gold italic">Bitcoin</span>
        </h1>
        <p class="font-body text-base md:text-xl text-on-surface-variant max-w-2xl mx-auto font-light leading-relaxed mb-8">
          Exploring the intersection of Austrian economics, cypherpunk philosophy, and the global shift toward sovereign digital assets.
        </p>
        <div>
          <a href="#dispatches" class="group inline-flex items-center space-x-4 text-primary hover:text-white transition-colors duration-300">
            <span class="font-mono text-xs uppercase tracking-widest font-bold">Enter the Sanctuary</span>
            <div class="w-12 h-[1px] bg-primary group-hover:w-20 transition-all duration-300"></div>
          </a>
        </div>
      </div>

      <!-- Side Slogans -->
      <div id="side-quote-left" class="side-scroll-quote absolute left-6 lg:left-12 top-1/2 -translate-y-1/2 max-w-xs xl:max-w-sm hidden lg:block pointer-events-none z-30">
        <p class="font-display text-lg text-on-surface/90 italic leading-relaxed">
          "Fix the money, fix the world. Absolute scarcity in a digital realm."
        </p>
        <span class="font-mono text-[10px] text-primary uppercase tracking-widest block mt-2 font-bold">— Cypherpunk Ethos</span>
      </div>

      <div id="side-quote-right" class="side-scroll-quote absolute right-6 lg:right-12 top-1/2 -translate-y-1/2 max-w-xs xl:max-w-sm hidden lg:block pointer-events-none z-30 text-right">
        <p class="font-display text-lg text-on-surface/90 italic leading-relaxed">
          "Don't trust. Verify. 256 bits of mathematical truth."
        </p>
        <span class="font-mono text-[10px] text-primary uppercase tracking-widest block mt-2 font-bold">— Nakamoto Consensus</span>
      </div>

      <!-- Floating Minimal HUD Scrubber -->
      <div class="minimal-hud">
        <span class="font-mono text-xs text-primary uppercase font-bold tracking-wider">SCROLL</span>
        <div class="hud-scrubber-track-bg">
          <div id="scrubber-fill" class="hud-scrubber-track-fill"></div>
        </div>
        <div class="hud-frame-display">
          FRAME <span id="hud-frame-num">001</span> / 210
        </div>
      </div>

    </div>
  </section>

  <!-- Live Bitcoin Network Stats Bar -->
  <section id="stats-bar" class="w-full bg-[#161818] border-y border-outline-variant/30 py-6 relative z-20">
    <div class="max-w-screen-2xl mx-auto px-6 md:px-16 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <div class="space-y-1 border-r border-outline-variant/20 last:border-0">
        <span class="font-mono text-[10px] uppercase text-on-surface-variant/60 tracking-widest">Block Height</span>
        <p data-stat="block-height" class="font-mono text-lg font-bold text-primary">841,234</p>
      </div>
      <div class="space-y-1 border-r border-outline-variant/20 last:border-0">
        <span class="font-mono text-[10px] uppercase text-on-surface-variant/60 tracking-widest">Global Hashrate</span>
        <p class="font-mono text-lg font-bold text-on-surface">652.4 EH/s</p>
      </div>
      <div class="space-y-1 border-r border-outline-variant/20 last:border-0">
        <span class="font-mono text-[10px] uppercase text-on-surface-variant/60 tracking-widest">Mempool Fee</span>
        <p class="font-mono text-lg font-bold text-on-surface">14 sat/vB</p>
      </div>
      <div class="space-y-1">
        <span class="font-mono text-[10px] uppercase text-on-surface-variant/60 tracking-widest">Halving Epoch</span>
        <p class="font-mono text-lg font-bold text-primary">April 2028</p>
      </div>
    </div>
  </section>

  <!-- Curated Theory & Featured Dispatches Section -->
  <section id="dispatches" class="bg-surface py-24 relative z-20">
    <div class="max-w-screen-2xl mx-auto px-6 md:px-16 space-y-16">
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 border-b border-outline-variant/20 pb-8">
        <div>
          <span class="font-mono text-xs text-primary uppercase tracking-[0.3em] font-bold block mb-2">Curated Publications</span>
          <h2 class="font-display text-4xl md:text-5xl font-bold text-on-surface">Featured Dispatches</h2>
        </div>
        <p class="font-body text-base text-on-surface-variant max-w-md opacity-80">
          In-depth monetary theory, cryptographic sovereignty, and economic philosophy published by leading fellows.
        </p>
      </div>

      <!-- WordPress Query for Featured / Main Posts -->
      <div class="space-y-12">
        <?php
        $featured_query = new WP_Query( array(
	        'post_type'      => 'post',
	        'post_status'    => 'publish',
	        'posts_per_page' => 3,
        ) );

        if ( $featured_query->have_posts() ) :
	        while ( $featured_query->have_posts() ) : $featured_query->the_post();
		        $categories = get_the_category();
		        $cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Bitcoin';
		        $image_url  = bte_get_featured_image_url( get_the_ID(), 'bte-card' );
		        $read_time  = bte_get_read_time( get_the_ID() );
		        $post_date  = get_the_date( 'M j, Y' );
		        ?>
            <article class="blog-card-alternating group">
              <div class="blog-card-img-col">
                <div class="blog-card-img-wrapper">
                  <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>" />
                </div>
              </div>
              <div class="blog-card-text-col space-y-4">
                <div class="flex items-center gap-3 font-mono text-xs">
                  <span class="bg-primary/10 border border-primary/30 px-3 py-1 text-primary font-bold uppercase tracking-wider rounded-md">
                    <?php echo esc_html( $cat_name ); ?>
                  </span>
                  <span class="text-on-surface-variant opacity-60">• <?php echo esc_html( $read_time ); ?></span>
                  <span class="text-on-surface-variant opacity-60">• <?php echo esc_html( $post_date ); ?></span>
                </div>

                <h3 class="font-display text-2xl md:text-4xl font-bold text-on-surface group-hover:text-primary transition-colors leading-tight">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <p class="font-body text-base text-on-surface-variant opacity-80 leading-relaxed">
                  <?php echo esc_html( get_the_excerpt() ); ?>
                </p>

                <div>
                  <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 font-mono text-xs uppercase text-primary font-bold tracking-widest hover:underline">
                    <span>Read Full Dispatch</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                  </a>
                </div>
              </div>
            </article>
		        <?php
	        endwhile;
	        wp_reset_postdata();
        else :
	        get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
      </div>

    </div>
  </section>

  <!-- Latest Dispatches Grid Section -->
  <section class="bg-surface-container-low py-20 border-t border-b border-outline-variant/20 relative z-20">
    <div class="max-w-screen-2xl mx-auto px-6 md:px-16">
      
      <div class="flex justify-between items-end mb-12">
        <div>
          <span class="font-mono text-xs text-primary uppercase tracking-widest block mb-1">Latest Dispatches</span>
          <h2 class="font-display text-3xl md:text-4xl font-bold text-on-surface">Fresh Perspectives</h2>
        </div>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url( '/#dispatches' ) ); ?>" class="font-mono text-xs text-primary hover:underline font-bold">Explore All Archives →</a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
        $latest_query = new WP_Query( array(
	        'post_type'      => 'post',
	        'post_status'    => 'publish',
	        'posts_per_page' => 4,
	        'offset'         => 3,
        ) );

        if ( $latest_query->have_posts() ) :
	        while ( $latest_query->have_posts() ) : $latest_query->the_post();
		        get_template_part( 'template-parts/content', 'card' );
	        endwhile;
	        wp_reset_postdata();
        else :
	        // Fallback: query without offset if offset returns empty
	        $fallback_query = new WP_Query( array(
		        'post_type'      => 'post',
		        'post_status'    => 'publish',
		        'posts_per_page' => 4,
	        ) );
	        while ( $fallback_query->have_posts() ) : $fallback_query->the_post();
		        get_template_part( 'template-parts/content', 'card' );
	        endwhile;
	        wp_reset_postdata();
        endif;
        ?>
      </div>

    </div>
  </section>

  <!-- Editorial Circle / Newsletter Section -->
  <section class="py-24 bg-surface relative z-20 overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 text-center space-y-8 relative">
      <div class="w-16 h-16 rounded-full bg-primary/10 border border-primary/30 flex items-center justify-center mx-auto text-primary mb-4">
        <span class="material-symbols-outlined text-3xl">mail</span>
      </div>
      
      <span class="font-mono text-xs text-primary uppercase tracking-[0.4em] font-bold block">Editorial Circle</span>
      <h2 class="font-display text-4xl md:text-6xl font-bold text-on-surface">Weekly Dispatches Direct to Your Inbox</h2>
      <p class="font-body text-base md:text-lg text-on-surface-variant">Weekly insights on the macro, micro, and cultural shifts of the Bitcoin era. No noise, just signal.</p>
      
      <form class="flex flex-col sm:flex-row gap-4 pt-6 max-w-xl mx-auto">
        <input class="flex-grow bg-surface-container-low border border-outline-variant/50 focus:border-primary text-on-surface placeholder:text-on-surface-variant/50 font-mono text-xs px-4 h-14 rounded-xl outline-none transition-all" placeholder="Your electronic mail address" type="email" required />
        <button class="bg-gradient-to-r from-amber-500 to-orange-500 text-black px-8 h-14 rounded-xl font-mono text-xs uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all font-bold shrink-0 shadow-lg shadow-orange-500/20" type="submit">
          Subscribe
        </button>
      </form>
    </div>
  </section>

</main>

<?php
get_footer();
