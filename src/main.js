/* ==========================================================================
   PURE ULTRA-SMOOTH FRAME SCROLL ANIMATION ENGINE
   ========================================================================== */

const TOTAL_FRAMES = 210;
const images = [];
let loadedCount = 0;
let isSectionVisible = true;

// State management
let currentFrame = 1;
let targetFrame = 1;
const easeFactor = 0.12; // Inertia multiplier

// DOM Elements
let canvas = null;
let ctx = null;
let hudFrameNum = null;
let scrubberFill = null;
let animSection = null;
let mainNav = null;

function getFrameUrl(index) {
  const padded = String(index).padStart(3, '0');
  return `/public/frames/ezgif-frame-${padded}.jpg`;
}

function preloadFrames() {
  for (let i = 1; i <= TOTAL_FRAMES; i++) {
    const img = new Image();
    img.src = getFrameUrl(i);
    img.onload = () => {
      loadedCount++;
      if (i === 1 && canvas && ctx) {
        renderFrame(1);
      }
    };
    img.onerror = () => {
      loadedCount++;
    };
    images.push(img);
  }
}

function resizeCanvas() {
  if (!canvas || !ctx) return;
  const dpr = Math.min(window.devicePixelRatio || 1, 2);
  canvas.width = window.innerWidth * dpr;
  canvas.height = window.innerHeight * dpr;
  ctx.scale(dpr, dpr);
}

function drawImageCover(img) {
  if (!img || !img.complete || img.naturalWidth === 0 || !ctx) return;

  const w = window.innerWidth;
  const h = window.innerHeight;
  const imgRatio = img.naturalWidth / img.naturalHeight;
  const screenRatio = w / h;

  let drawW, drawH, offsetX, offsetY;

  if (screenRatio > imgRatio) {
    drawW = w;
    drawH = w / imgRatio;
    offsetX = 0;
    offsetY = (h - drawH) / 2;
  } else {
    drawW = h * imgRatio;
    drawH = h;
    offsetX = (w - drawW) / 2;
    offsetY = 0;
  }

  ctx.clearRect(0, 0, w, h);
  ctx.drawImage(img, offsetX, offsetY, drawW, drawH);
}

function renderFrame(frameIndex) {
  const idx = Math.max(1, Math.min(TOTAL_FRAMES, Math.round(frameIndex)));
  const img = images[idx - 1];
  if (img && img.complete) {
    drawImageCover(img);
  }
}

function startAnimationLoop() {
  function loop() {
    if (isSectionVisible) {
      let scrollRatio = 0;
      if (animSection) {
        const rect = animSection.getBoundingClientRect();
        const scrollableRange = rect.height - window.innerHeight;

        if (scrollableRange > 0) {
          const scrolledDistance = Math.max(0, -rect.top);
          scrollRatio = Math.max(0, Math.min(1, scrolledDistance / scrollableRange));
          targetFrame = 1 + scrollRatio * (TOTAL_FRAMES - 1);
        }
      } else {
        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
        if (maxScroll > 0) {
          scrollRatio = Math.max(0, Math.min(1, window.scrollY / maxScroll));
          targetFrame = 1 + scrollRatio * (TOTAL_FRAMES - 1);
        }
      }

      // Subtle side quotes fade out smoothly as visitor scrolls to 40% (0.4)
      const sideQuotes = document.querySelectorAll('.side-scroll-quote');
      if (sideQuotes.length > 0) {
        const quoteOpacity = Math.max(0, Math.min(1, (0.4 - scrollRatio) / 0.4));
        const scale = 0.95 + quoteOpacity * 0.05;
        sideQuotes.forEach(el => {
          el.style.opacity = quoteOpacity.toFixed(3);
          el.style.transform = `translateY(-50%) scale(${scale.toFixed(3)})`;
          if (quoteOpacity <= 0.005) {
            el.style.visibility = 'hidden';
          } else {
            el.style.visibility = 'visible';
          }
        });
      }

      // Lerp (Linear Interpolation) for liquid motion
      const diff = targetFrame - currentFrame;
      if (Math.abs(diff) > 0.001) {
        currentFrame += diff * easeFactor;
        renderFrame(currentFrame);
        updateHUD(currentFrame);
      }
    }

    requestAnimationFrame(loop);
  }

  requestAnimationFrame(loop);
}

function updateHUD(frame) {
  const rounded = Math.round(frame);
  const padded = String(rounded).padStart(3, '0');
  
  if (hudFrameNum) hudFrameNum.textContent = padded;

  const pct = ((rounded - 1) / (TOTAL_FRAMES - 1)) * 100;
  if (scrubberFill) scrubberFill.style.width = `${pct}%`;
}

function initEngine() {
  canvas = document.getElementById('hero-canvas');
  if (!canvas) return; // Exit gracefully if not on canvas page

  ctx = canvas.getContext('2d', { alpha: false });
  hudFrameNum = document.getElementById('hud-frame-num');
  scrubberFill = document.getElementById('scrubber-fill');
  animSection = document.getElementById('scroll-animation-section');
  mainNav = document.getElementById('main-nav') || document.getElementById('main-header');

  // Pause lerp loop when section is outside viewport for performance
  if (animSection && 'IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        isSectionVisible = entry.isIntersecting;
      });
    }, { threshold: 0.01 });
    observer.observe(animSection);
  }

  resizeCanvas();
  preloadFrames();
  startAnimationLoop();

  window.addEventListener('resize', () => {
    resizeCanvas();
    renderFrame(Math.round(currentFrame));
  });
}

// Navbar dynamic transparent styling on scroll
window.addEventListener('scroll', () => {
  if (!mainNav) {
    mainNav = document.getElementById('main-nav') || document.getElementById('main-header');
  }
  if (mainNav) {
    if (window.scrollY > 80) {
      mainNav.classList.add('scrolled');
    } else {
      mainNav.classList.remove('scrolled');
    }
  }
});

// Smooth anchor scrolling
document.addEventListener('click', (e) => {
  const target = e.target.closest('a[href^="#"]');
  if (target) {
    const targetId = target.getAttribute('href');
    if (targetId && targetId !== '#') {
      const el = document.querySelector(targetId);
      if (el) {
        e.preventDefault();
        el.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }
});

// Initialize on DOM load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initEngine);
} else {
  initEngine();
}
