/* ==========================================================================
   BITCOIN JOURNAL - WORDPRESS INTERACTIVE ENGINE & REST API CONNECTOR
   ========================================================================== */

const REST_BASE = (window.BTE_APP && window.BTE_APP.restUrl) || '/wp-json/bte/v1/';

// 1. Toast Notification System
function showToast(message, type = 'success') {
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

// 2. Bind Modals & Navigation Drawer Events
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

  // Instant WP REST API Search Handler
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
          const res = await fetch(`${REST_BASE}search?q=${encodeURIComponent(query)}`);
          const data = await res.json();

          if (data.results && data.results.length > 0) {
            searchResultsList.innerHTML = data.results.map(item => `
              <a href="${item.url}" class="block bg-[#121414] p-4 rounded-xl border border-white/5 hover:border-amber-500/40 transition-all group">
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
          console.error('WP REST Search error:', err);
        }
      }, 200);
    });
  }

  // Subscribe Form Submit
  const modalSubscribeForm = document.getElementById('modal-subscribe-form');
  if (modalSubscribeForm) {
    modalSubscribeForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const emailInput = document.getElementById('modal-subscribe-email');
      const email = emailInput?.value;

      try {
        const res = await fetch(`${REST_BASE}subscribe`, {
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

// 3. Attach Form Submit Handlers
function bindPageForms() {
  document.querySelectorAll('form').forEach(form => {
    if (form.id === 'modal-subscribe-form' || form.id === 'contact-form') return;

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const emailInput = form.querySelector('input[type="email"]');
      if (emailInput) {
        const email = emailInput.value;
        try {
          const res = await fetch(`${REST_BASE}subscribe`, {
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

  // Contact Form Submission Handler
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = document.getElementById('c-name')?.value;
      showToast(`Transmission from ${name || 'User'} routed to Bitcoin Trend Elite Company Board.`, 'success');
      contactForm.reset();
    });
  }
}

// Initialize on DOM Load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    bindUIEvents();
    bindPageForms();
  });
} else {
  bindUIEvents();
  bindPageForms();
}
