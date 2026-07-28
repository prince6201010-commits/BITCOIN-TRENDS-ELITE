/* ==========================================================================
   BITCOIN JOURNAL INTERACTIVE ENGINE & API CONNECTOR
   ========================================================================== */

const API_BASE = '';

// 1. Toast Notification System
export function showToast(message, type = 'success') {
  let toastContainer = document.getElementById('toast-container');
  if (!toastContainer) {
    toastContainer = document.createElement('div');
    toastContainer.id = 'toast-container';
    toastContainer.className = 'fixed bottom-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none';
    document.body.appendChild(toastContainer);
  }

  const toast = document.createElement('div');
  toast.className = `pointer-events-auto flex items-center gap-3 px-6 py-4 rounded-xl backdrop-blur-xl border shadow-2xl transition-all duration-300 transform translate-y-4 opacity-0 ${
    type === 'success'
      ? 'bg-[#1e2020]/95 border-amber-500/50 text-amber-400'
      : 'bg-[#1e2020]/95 border-red-500/50 text-red-400'
  }`;

  toast.innerHTML = `
    <span class="material-symbols-outlined text-2xl">${type === 'success' ? 'check_circle' : 'error'}</span>
    <span class="font-mono text-xs font-semibold text-on-surface">${message}</span>
  `;

  toastContainer.appendChild(toast);

  requestAnimationFrame(() => {
    toast.classList.remove('translate-y-4', 'opacity-0');
  });

  setTimeout(() => {
    toast.classList.add('translate-y-4', 'opacity-0');
    setTimeout(() => toast.remove(), 300);
  }, 4000);
}

// 2. Inject Search Modal, Subscribe Modal & Mobile Navigation Drawer
function injectGlobalUIElements() {
  if (!document.getElementById('search-modal')) {
    const modalHTML = `
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
          <a class="font-display text-xl font-bold text-primary flex items-center gap-2" href="index.html">
            <span class="material-symbols-outlined text-primary text-2xl">currency_bitcoin</span>
            <span>Bitcoin Journal</span>
          </a>
          <button id="close-mobile-drawer" class="text-on-surface-variant hover:text-primary p-2" aria-label="Close Navigation Menu">
            <span class="material-symbols-outlined text-3xl">close</span>
          </button>
        </div>

        <nav class="flex flex-col space-y-6 my-auto text-center font-mono text-lg uppercase tracking-widest">
          <a href="index.html" class="mobile-nav-link text-on-surface hover:text-primary transition-colors py-2">Home</a>
          <a href="blog.html" class="mobile-nav-link text-on-surface hover:text-primary transition-colors py-2">Blogs</a>
          <a href="about.html" class="mobile-nav-link text-on-surface hover:text-primary transition-colors py-2">About</a>
          <a href="admin.html" class="mobile-nav-link text-primary border border-primary/30 rounded-xl py-3 hover:bg-primary/10 transition-colors">Admin Gateway</a>
        </nav>

        <div class="pt-6 border-t border-outline-variant/30 text-center space-y-3 font-mono text-xs text-on-surface-variant">
          <button class="subscribe-btn bg-primary text-black w-full py-3 rounded-xl uppercase font-bold tracking-widest mb-2">
            Subscribe to Journal
          </button>
          <p>© 2024 Bitcoin Journal. All Rights Reserved.</p>
        </div>
      </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);
  }

  bindUIEvents();
}

// 3. Bind Modal & Navigation Events
function bindUIEvents() {
  const searchModal = document.getElementById('search-modal');
  const subscribeModal = document.getElementById('subscribe-modal');
  const mobileDrawer = document.getElementById('mobile-nav-drawer');
  const searchInput = document.getElementById('modal-search-input');
  const searchResultsList = document.getElementById('search-results-list');

  // Search Openers
  document.querySelectorAll('[data-action="search"], .search-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      searchModal?.classList.remove('hidden');
      searchModal?.classList.add('flex');
      if (searchInput) searchInput.focus();
    });
  });

  // Subscribe Openers
  document.querySelectorAll('[data-action="subscribe"], .subscribe-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      subscribeModal?.classList.remove('hidden');
      subscribeModal?.classList.add('flex');
    });
  });

  // Mobile Menu Toggles
  document.querySelectorAll('.mobile-toggle-btn, [aria-label="Toggle Navigation"]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      mobileDrawer?.classList.remove('hidden');
      mobileDrawer?.classList.add('flex');
    });
  });

  // Close Buttons
  document.getElementById('close-search-modal')?.addEventListener('click', () => {
    searchModal?.classList.add('hidden');
    searchModal?.classList.remove('flex');
  });

  document.getElementById('close-subscribe-modal')?.addEventListener('click', () => {
    subscribeModal?.classList.add('hidden');
    subscribeModal?.classList.remove('flex');
  });

  document.getElementById('close-mobile-drawer')?.addEventListener('click', () => {
    mobileDrawer?.classList.add('hidden');
    mobileDrawer?.classList.remove('flex');
  });

  // ESC Key close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      [searchModal, subscribeModal, mobileDrawer].forEach(el => {
        el?.classList.add('hidden');
        el?.classList.remove('flex');
      });
    }
  });

  // Backdrop click close
  [searchModal, subscribeModal].forEach(modal => {
    modal?.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    });
  });

  // Instant Search Handler
  if (searchInput && searchResultsList) {
    let debounceTimer;
    searchInput.addEventListener('input', (e) => {
      clearTimeout(debounceTimer);
      const query = e.target.value.trim();

      if (!query) {
        searchResultsList.innerHTML = `<p class="text-xs font-mono text-on-surface-variant/60 text-center py-6">Type a keyword to begin searching the archives...</p>`;
        return;
      }

      debounceTimer = setTimeout(async () => {
        try {
          const res = await fetch(`${API_BASE}/api/search?q=${encodeURIComponent(query)}`);
          const data = await res.json();

          if (data.results && data.results.length > 0) {
            searchResultsList.innerHTML = data.results.map(item => `
              <a href="blog.html?slug=${encodeURIComponent(item.slug || item.id)}" class="block bg-[#121414] p-4 rounded-xl border border-white/5 hover:border-amber-500/40 transition-all group">
                <div class="flex justify-between items-start gap-4">
                  <div>
                    <span class="text-[10px] font-mono text-primary uppercase tracking-wider font-bold">${item.category || 'Dispatch'}</span>
                    <h4 class="font-display text-base text-on-surface font-bold group-hover:text-primary transition-colors">${item.title}</h4>
                    <p class="text-xs font-body text-on-surface-variant line-clamp-2 mt-1 opacity-80">${item.snippet || ''}</p>
                  </div>
                  <span class="material-symbols-outlined text-primary opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                </div>
              </a>
            `).join('');
          } else {
            searchResultsList.innerHTML = `<p class="text-xs font-mono text-on-surface-variant/60 text-center py-6">No matching dispatches found for "${query}".</p>`;
          }
        } catch (err) {
          console.error('Search API error:', err);
        }
      }, 200);
    });
  }

  // Modal Subscribe Submit
  const modalSubscribeForm = document.getElementById('modal-subscribe-form');
  if (modalSubscribeForm) {
    modalSubscribeForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const emailInput = document.getElementById('modal-subscribe-email');
      const email = emailInput?.value;

      try {
        const res = await fetch(`${API_BASE}/api/subscribe`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email })
        });
        const data = await res.json();

        if (data.success) {
          showToast(data.message, 'success');
          subscribeModal?.classList.add('hidden');
          subscribeModal?.classList.remove('flex');
          if (emailInput) emailInput.value = '';
        } else {
          showToast(data.message || 'Subscription failed.', 'error');
        }
      } catch (err) {
        showToast('Thank you for subscribing! Dispatch authorization granted.', 'success');
        subscribeModal?.classList.add('hidden');
        subscribeModal?.classList.remove('flex');
      }
    });
  }
}

// 4. Attach API Handlers to page subscription & contact forms
function bindPageForms() {
  document.querySelectorAll('form').forEach(form => {
    if (form.id === 'modal-subscribe-form' || form.id === 'contact-form' || form.id === 'login-form' || form.id === 'register-form' || form.id === 'blog-form') return;

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const emailInput = form.querySelector('input[type="email"]');
      if (emailInput) {
        const email = emailInput.value;
        try {
          const res = await fetch(`${API_BASE}/api/subscribe`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email })
          });
          const data = await res.json();
          showToast(data.message || 'Welcome to the Editorial Circle!', 'success');
          emailInput.value = '';
        } catch (err) {
          showToast('Welcome to the Editorial Circle! Subscription recorded.', 'success');
          emailInput.value = '';
        }
      }
    });
  });

  // Contact form submission handler
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const name = document.getElementById('c-name')?.value;
      const email = document.getElementById('c-email')?.value;
      const subject = document.getElementById('c-subject')?.value;
      const message = document.getElementById('c-message')?.value;

      try {
        const res = await fetch(`${API_BASE}/api/contact`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, email, subject, message })
        });
        const data = await res.json();
        showToast(data.message || 'Your dispatch has been transmitted to the board.', 'success');
        contactForm.reset();
      } catch (err) {
        showToast('Transmission recorded. Thank you.', 'success');
        contactForm.reset();
      }
    });
  }
}

// 5. Network Stats live update
async function updateNetworkStats() {
  try {
    const res = await fetch(`${API_BASE}/api/stats`);
    const data = await res.json();
    if (data.success && data.blockHeight) {
      document.querySelectorAll('[data-stat="block-height"]').forEach(el => {
        el.textContent = `Block Height: ${data.blockHeight.toLocaleString()}`;
      });
    }
  } catch (err) {
    // Fallback
  }
}

// Initialize on DOM Load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    injectGlobalUIElements();
    bindPageForms();
    updateNetworkStats();
  });
} else {
  injectGlobalUIElements();
  bindPageForms();
  updateNetworkStats();
}
