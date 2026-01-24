/**
 * Frontend JavaScript
 *
 * Main JavaScript file for the theme frontend.
 */

// Import WordPress dependencies if needed
// import domReady from '@wordpress/dom-ready';

/**
 * Initialize theme functionality when DOM is ready
 */
document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initSmoothScroll();
  initLazyLoading();
  initDaisyUI();
});

/**
 * Mobile menu toggle functionality
 */
function initMobileMenu() {
  const menuToggle = document.querySelector('[data-menu-toggle]');
  const mobileMenu = document.querySelector('[data-mobile-menu]');

  if (!menuToggle || !mobileMenu) {
    return;
  }

  menuToggle.addEventListener('click', () => {
    const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
    menuToggle.setAttribute('aria-expanded', !isExpanded);
    mobileMenu.classList.toggle('hidden');

    // Toggle body scroll
    document.body.classList.toggle('overflow-hidden', !isExpanded);
  });

  // Close menu on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
      menuToggle.setAttribute('aria-expanded', 'false');
      mobileMenu.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      menuToggle.focus();
    }
  });
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');

      // Skip if it's just "#" or empty
      if (targetId === '#' || !targetId) {
        return;
      }

      const targetElement = document.querySelector(targetId);

      if (targetElement) {
        e.preventDefault();
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start',
        });

        // Update URL without jumping
        history.pushState(null, null, targetId);

        // Set focus for accessibility
        targetElement.setAttribute('tabindex', '-1');
        targetElement.focus({ preventScroll: true });
      }
    });
  });
}

/**
 * Lazy loading enhancement for images
 * Note: Modern browsers support native lazy loading, this adds fallback behavior
 */
function initLazyLoading() {
  // Check if native lazy loading is supported
  if ('loading' in HTMLImageElement.prototype) {
    // Native lazy loading is supported
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach((img) => {
      // Ensure data-src is applied if present
      if (img.dataset.src) {
        img.src = img.dataset.src;
      }
    });
  } else {
    // Fallback for older browsers using Intersection Observer
    const images = document.querySelectorAll('img[loading="lazy"]');

    if ('IntersectionObserver' in window) {
      const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const img = entry.target;
            if (img.dataset.src) {
              img.src = img.dataset.src;
            }
            img.removeAttribute('loading');
            observer.unobserve(img);
          }
        });
      });

      images.forEach((img) => imageObserver.observe(img));
    } else {
      // Final fallback: just load all images
      images.forEach((img) => {
        if (img.dataset.src) {
          img.src = img.dataset.src;
        }
      });
    }
  }
}

/**
 * Utility: Debounce function for performance
 *
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @return {Function} Debounced function
 */
export function debounce(func, wait = 100) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

/**
 * Utility: Throttle function for performance
 *
 * @param {Function} func - Function to throttle
 * @param {number} limit - Limit in milliseconds
 * @return {Function} Throttled function
 */
export function throttle(func, limit = 100) {
  let inThrottle;
  return function executedFunction(...args) {
    if (!inThrottle) {
      func(...args);
      inThrottle = true;
      setTimeout(() => {
        inThrottle = false;
      }, limit);
    }
  };
}

/* ==========================================================================
   daisyUI Helpers
   ========================================================================== */

/**
 * Initialize daisyUI interactive components
 */
function initDaisyUI() {
  initModals();
  initDropdowns();
  initDrawers();
  initThemeToggle();
}

/**
 * Modal helpers using native <dialog> element
 *
 * Usage:
 * <button onclick="window.openModal('my-modal')">Open</button>
 * <dialog id="my-modal" class="modal">
 *   <div class="modal-box">
 *     <h3>Title</h3>
 *     <p>Content</p>
 *     <div class="modal-action">
 *       <button onclick="window.closeModal('my-modal')" class="btn">Close</button>
 *     </div>
 *   </div>
 *   <form method="dialog" class="modal-backdrop">
 *     <button>close</button>
 *   </form>
 * </dialog>
 */
function initModals() {
  // Global modal open function
  window.openModal = (id) => {
    const modal = document.getElementById(id);
    if (modal && modal.tagName === 'DIALOG') {
      modal.showModal();
    }
  };

  // Global modal close function
  window.closeModal = (id) => {
    const modal = document.getElementById(id);
    if (modal && modal.tagName === 'DIALOG') {
      modal.close();
    }
  };

  // Close modal on escape key (native dialog behavior, but ensure cleanup)
  document.querySelectorAll('dialog.modal').forEach((modal) => {
    modal.addEventListener('close', () => {
      // Any cleanup needed when modal closes
      document.body.classList.remove('overflow-hidden');
    });

    modal.addEventListener('cancel', (e) => {
      // Handle escape key
      document.body.classList.remove('overflow-hidden');
    });
  });
}

/**
 * Dropdown enhancement - close on outside click
 *
 * Usage:
 * <div class="dropdown" data-dropdown>
 *   <label tabindex="0" class="btn m-1">Click</label>
 *   <ul tabindex="0" class="dropdown-content menu">
 *     <li><a>Item 1</a></li>
 *   </ul>
 * </div>
 */
function initDropdowns() {
  // Close dropdowns when clicking outside
  document.addEventListener('click', (e) => {
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach((dropdown) => {
      if (!dropdown.contains(e.target)) {
        // Remove focus to close the dropdown
        const focusable = dropdown.querySelector('[tabindex]');
        if (focusable && document.activeElement === focusable) {
          focusable.blur();
        }
      }
    });
  });

  // Close dropdowns on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      const activeDropdown = document.activeElement?.closest('.dropdown');
      if (activeDropdown) {
        document.activeElement.blur();
      }
    }
  });
}

/**
 * Drawer helpers for mobile navigation
 *
 * Usage:
 * <div class="drawer">
 *   <input id="my-drawer" type="checkbox" class="drawer-toggle" />
 *   <div class="drawer-content">
 *     <label for="my-drawer" class="btn btn-primary drawer-button">Open</label>
 *   </div>
 *   <div class="drawer-side">
 *     <label for="my-drawer" class="drawer-overlay"></label>
 *     <ul class="menu">...</ul>
 *   </div>
 * </div>
 */
function initDrawers() {
  // Global drawer toggle functions
  window.openDrawer = (id) => {
    const toggle = document.getElementById(id);
    if (toggle && toggle.type === 'checkbox') {
      toggle.checked = true;
    }
  };

  window.closeDrawer = (id) => {
    const toggle = document.getElementById(id);
    if (toggle && toggle.type === 'checkbox') {
      toggle.checked = false;
    }
  };

  window.toggleDrawer = (id) => {
    const toggle = document.getElementById(id);
    if (toggle && toggle.type === 'checkbox') {
      toggle.checked = !toggle.checked;
    }
  };

  // Close drawer on escape key
  document.querySelectorAll('.drawer-toggle').forEach((toggle) => {
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && toggle.checked) {
        toggle.checked = false;
      }
    });
  });
}

/**
 * Theme toggle (light/dark mode)
 *
 * Usage:
 * <button onclick="window.toggleTheme()" class="btn">Toggle Theme</button>
 *
 * Or with a swap component:
 * <label class="swap swap-rotate">
 *   <input type="checkbox" data-theme-toggle />
 *   <svg class="swap-on ...">sun icon</svg>
 *   <svg class="swap-off ...">moon icon</svg>
 * </label>
 */
function initThemeToggle() {
  // Check for saved theme preference or default to system preference
  const savedTheme = localStorage.getItem('theme');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initialTheme = savedTheme || (systemPrefersDark ? 'dark' : 'light');

  // Apply initial theme
  document.documentElement.setAttribute('data-theme', initialTheme);

  // Global theme toggle function
  window.toggleTheme = () => {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);

    // Update any theme toggle checkboxes
    document.querySelectorAll('[data-theme-toggle]').forEach((toggle) => {
      toggle.checked = newTheme === 'dark';
    });
  };

  // Global set theme function
  window.setTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
  };

  // Initialize theme toggle checkboxes
  document.querySelectorAll('[data-theme-toggle]').forEach((toggle) => {
    toggle.checked = initialTheme === 'dark';
    toggle.addEventListener('change', () => {
      window.toggleTheme();
    });
  });

  // Listen for system theme changes
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
      document.documentElement.setAttribute('data-theme', e.matches ? 'dark' : 'light');
    }
  });
}
