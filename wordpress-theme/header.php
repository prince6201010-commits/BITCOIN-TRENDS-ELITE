<?php
/**
 * Header Template for Bitcoin Trend Elite Theme
 *
 * @package Bitcoin_Trend_Elite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="dark">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-surface text-on-surface font-body selection:bg-primary selection:text-black min-h-screen flex flex-col' ); ?>>
  <?php wp_body_open(); ?>
  <div class="grain"></div>

  <!-- Glassmorphic Header Navigation -->
  <header id="main-header" class="glass-header fixed top-0 w-full z-50 py-4 transition-all duration-300">
    <div class="flex justify-between items-center px-6 md:px-16 max-w-screen-2xl mx-auto">
      
      <!-- Logo Branding -->
      <a class="font-display text-xl md:text-2xl font-bold text-primary tracking-tighter flex items-center gap-3" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> Home">
        <?php if ( has_custom_logo() ) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-9 md:h-11 w-auto object-contain" />
        <?php endif; ?>
      </a>

      <!-- Desktop Navigation Menu -->
      <nav class="hidden md:flex items-center space-x-10" aria-label="Main Navigation">
        <?php
        if ( has_nav_menu( 'primary' ) ) {
	        wp_nav_menu( array(
		        'theme_location' => 'primary',
		        'container'      => false,
		        'menu_class'     => 'flex items-center space-x-10',
		        'fallback_cb'    => false,
		        'depth'          => 1,
	        ) );
        } else {
	        // Fallback default navigation links
	        ?>
          <a class="font-mono text-xs uppercase tracking-wider <?php echo is_front_page() ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors'; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
          <a class="font-mono text-xs uppercase tracking-wider <?php echo is_home() || is_archive() || is_single() ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors'; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url( '/#dispatches' ) ); ?>">Blogs</a>
          <a class="font-mono text-xs uppercase tracking-wider <?php echo is_page( 'about' ) ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors'; ?>" href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a>
	        <?php
        }
        ?>
      </nav>

      <!-- Header Action Buttons -->
      <div class="flex items-center space-x-4 md:space-x-6">
        <button class="search-btn text-on-surface-variant hover:text-primary transition-all p-2 rounded-full hover:bg-white/5" aria-label="Search dispatches">
          <span class="material-symbols-outlined text-2xl">search</span>
        </button>

        <!-- Mobile Drawer Toggle -->
        <button class="mobile-toggle-btn md:hidden text-on-surface-variant hover:text-primary p-2" aria-label="Toggle Navigation">
          <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
      </div>

    </div>
  </header>
