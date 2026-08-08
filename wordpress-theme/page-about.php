<?php
/**
 * Template Name: About & Manifesto Page
 *
 * @package Bitcoin_Trend_Elite
 */

get_header();
?>

<main class="pt-28 pb-24 flex-grow">
  <!-- Hero Manifesto Banner -->
  <section class="max-w-screen-2xl mx-auto px-6 md:px-16 mb-20">
    <div class="bg-gradient-to-b from-surface-container to-surface-container-low border border-outline-variant/30 rounded-3xl p-8 md:p-16 relative overflow-hidden shadow-2xl">
      <div class="absolute -top-32 -right-32 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
      <div class="relative z-10 max-w-4xl space-y-6">
        <span class="font-mono text-xs uppercase tracking-[0.3em] text-primary font-bold">Editorial Vision</span>
        <h1 class="font-display text-4xl md:text-7xl font-bold text-on-surface leading-tight tracking-tight">
          A Sanctuary for the Sovereign Individual
        </h1>
        <p class="font-body text-xl md:text-2xl text-on-surface-variant font-light leading-relaxed">
          Bitcoin Journal exists to chronicle the cultural, economic, and philosophical evolution driven by digital absolute scarcity. We operate at the intersection of Austrian economics, cypherpunk code, and human autonomy.
        </p>
      </div>
    </div>
  </section>

  <!-- Core Pillars -->
  <section class="max-w-screen-2xl mx-auto px-6 md:px-16 mb-24">
    <div class="mb-12">
      <span class="font-mono text-xs uppercase tracking-widest text-primary block mb-2 font-bold">Philosophical Foundation</span>
      <h2 class="font-display text-3xl md:text-4xl font-bold text-on-surface">The Three Pillars</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-surface-container/60 border border-outline-variant/30 rounded-2xl p-8 space-y-4 hover:border-primary/40 transition-all shadow-xl">
        <span class="material-symbols-outlined text-primary text-4xl">lock</span>
        <h3 class="font-display text-2xl font-bold text-on-surface">Absolute Scarcity</h3>
        <p class="font-body text-on-surface-variant text-base leading-relaxed opacity-85">
          For the first time in human history, an asset exists with a strictly finite supply enforced by mathematics, defying arbitrary monetary inflation.
        </p>
      </div>

      <div class="bg-surface-container/60 border border-outline-variant/30 rounded-2xl p-8 space-y-4 hover:border-primary/40 transition-all shadow-xl">
        <span class="material-symbols-outlined text-primary text-4xl">vpn_key</span>
        <h3 class="font-display text-2xl font-bold text-on-surface">Cypherpunk Autonomy</h3>
        <p class="font-body text-on-surface-variant text-base leading-relaxed opacity-85">
          Self-custody and cryptographic keys restore sovereign property rights to the individual without reliance on centralized intermediaries.
        </p>
      </div>

      <div class="bg-surface-container/60 border border-outline-variant/30 rounded-2xl p-8 space-y-4 hover:border-primary/40 transition-all shadow-xl">
        <span class="material-symbols-outlined text-primary text-4xl">bolt</span>
        <h3 class="font-display text-2xl font-bold text-on-surface">Proof of Work</h3>
        <p class="font-body text-on-surface-variant text-base leading-relaxed opacity-85">
          Anchored in thermodynamics and real-world energy expenditure, consensus creates unforgeable digital truth across global networks.
        </p>
      </div>
    </div>
  </section>

  <!-- Leadership & Transmission Form -->
  <section class="max-w-screen-2xl mx-auto px-6 md:px-16 grid grid-cols-1 lg:grid-cols-12 gap-12">
    <!-- Board Bio Card -->
    <div class="lg:col-span-5 bg-surface-container border border-outline-variant/30 rounded-3xl p-8 space-y-6 flex flex-col justify-between shadow-xl">
      <div class="space-y-4">
        <span class="font-mono text-xs uppercase tracking-widest text-primary font-bold">Company Board</span>
        <div class="flex items-center gap-4">
          <div class="w-16 h-16 rounded-full border-2 border-primary/40 overflow-hidden shrink-0 bg-[#1e2020] p-1 shadow-lg">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-icon.svg' ); ?>" alt="Bitcoin Trend Elite" class="w-full h-full object-contain"/>
          </div>
          <div>
            <h3 class="font-display text-2xl font-bold text-on-surface">Bitcoin Trend Elite</h3>
            <p class="font-mono text-xs text-on-surface-variant opacity-75">Company Board & Research Fellows</p>
          </div>
        </div>
        <p class="font-body text-on-surface-variant text-sm leading-relaxed pt-4 border-t border-outline-variant/20">
          Dedicated to research across cryptographic permanence, Austrian monetary policy, and open-source decentralized systems.
        </p>
      </div>

      <div class="pt-6 border-t border-outline-variant/20 font-mono text-xs text-on-surface-variant space-y-1">
        <p>Encrypted Dispatch: <a href="mailto:info@bitcointrendelite.com" class="text-primary font-bold hover:underline">info@bitcointrendelite.com</a></p>
        <p>Location: Sovereign Digital Domain</p>
      </div>
    </div>

    <!-- Contact Form -->
    <div id="contact" class="lg:col-span-7 bg-surface-container-low border border-outline-variant/30 rounded-3xl p-8 md:p-10 space-y-6 shadow-xl">
      <div>
        <span class="font-mono text-xs uppercase tracking-widest text-primary font-bold">Inquiries & Transmissions</span>
        <h2 class="font-display text-3xl font-bold text-on-surface mt-1">Transmit to the Company Board</h2>
      </div>

      <form id="contact-form" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-mono text-xs uppercase text-on-surface-variant mb-1" for="c-name">Name *</label>
            <input id="c-name" type="text" required placeholder="Satoshi Nakamoto" class="w-full bg-surface-container border border-outline-variant/40 rounded-xl px-4 py-3 text-xs text-on-surface focus:border-primary outline-none font-mono"/>
          </div>
          <div>
            <label class="block font-mono text-xs uppercase text-on-surface-variant mb-1" for="c-email">Email *</label>
            <input id="c-email" type="email" required placeholder="user@domain.com" class="w-full bg-surface-container border border-outline-variant/40 rounded-xl px-4 py-3 text-xs text-on-surface focus:border-primary outline-none font-mono"/>
          </div>
        </div>

        <div>
          <label class="block font-mono text-xs uppercase text-on-surface-variant mb-1" for="c-subject">Subject</label>
          <input id="c-subject" type="text" placeholder="Company Board Inquiry / Contribution" class="w-full bg-surface-container border border-outline-variant/40 rounded-xl px-4 py-3 text-xs text-on-surface focus:border-primary outline-none font-mono"/>
        </div>

        <div>
          <label class="block font-mono text-xs uppercase text-on-surface-variant mb-1" for="c-message">Message *</label>
          <textarea id="c-message" rows="4" required placeholder="Write your transmission..." class="w-full bg-surface-container border border-outline-variant/40 rounded-xl px-4 py-3 text-sm text-on-surface focus:border-primary outline-none font-body"></textarea>
        </div>

        <button type="submit" class="bg-primary text-black font-mono font-bold text-xs uppercase tracking-wider px-8 py-3.5 rounded-xl hover:brightness-110 active:scale-[0.98] transition-all shadow-md shadow-primary/10 flex items-center gap-2">
          <span>Transmit Message</span>
          <span class="material-symbols-outlined text-sm">send</span>
        </button>
      </form>
    </div>
  </section>
</main>

<?php
get_footer();
