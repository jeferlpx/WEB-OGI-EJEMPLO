/**
 * PORTAL OGI — UNALM: JAVASCRIPT MODULAR PRINCIPAL
 */

document.addEventListener('DOMContentLoaded', () => {
  initTheme();
  initStickyHeader();
  initMobileMenu();
  initAgreementSearch();
});

/**
 * Gestión de Modo Oscuro / Claro con persistencia y preferencia de sistema
 */
function initTheme() {
  const themeToggleBtns = document.querySelectorAll('.theme-toggle');
  const storedTheme = localStorage.getItem('ogi_theme');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

  // Aplicar tema inicial
  if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }

  // Evento toggle
  themeToggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      document.documentElement.classList.add('theme-transition');
      const isDark = document.documentElement.classList.toggle('dark');
      localStorage.setItem('ogi_theme', isDark ? 'dark' : 'light');

      setTimeout(() => {
        document.documentElement.classList.remove('theme-transition');
      }, 300);
    });
  });
}

/**
 * Header Sticky y Header con Superposición con transición suave al hacer scroll
 */
function initStickyHeader() {
  const header = document.querySelector('.header-sticky');
  const overlayWrapper = document.querySelector('.header-overlay-wrapper');
  if (!header && !overlayWrapper) return;

  const handleScroll = () => {
    const isScrolled = window.scrollY > 30;
    if (header) {
      if (isScrolled) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    }
    if (overlayWrapper) {
      if (isScrolled) {
        overlayWrapper.classList.add('is-scrolled');
      } else {
        overlayWrapper.classList.remove('is-scrolled');
      }
    }
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll(); // Chequeo inicial
}

/**
 * Menú Móvil accesible con teclado y foco
 */
function initMobileMenu() {
  const toggleBtn = document.getElementById('mobile-menu-toggle');
  const closeBtn = document.getElementById('mobile-menu-close');
  const drawer = document.getElementById('mobile-menu-drawer');
  const backdrop = document.getElementById('mobile-menu-backdrop');

  if (!toggleBtn || !drawer) return;

  const openMenu = () => {
    drawer.classList.remove('translate-x-full');
    backdrop?.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    toggleBtn.setAttribute('aria-expanded', 'true');
    closeBtn?.focus();
  };

  const closeMenu = () => {
    drawer.classList.add('translate-x-full');
    backdrop?.classList.add('hidden');
    document.body.style.overflow = '';
    toggleBtn.setAttribute('aria-expanded', 'false');
    toggleBtn.focus();
  };

  toggleBtn.addEventListener('click', openMenu);
  closeBtn?.addEventListener('click', closeMenu);
  backdrop?.addEventListener('click', closeMenu);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !drawer.classList.contains('translate-x-full')) {
      closeMenu();
    }
  });
}

/**
 * Búsqueda y filtrado interactivo en tiempo real para directorio de convenios
 */
function initAgreementSearch() {
  const searchInput = document.getElementById('agreement-search-input');
  const countrySelect = document.getElementById('agreement-country-select');
  const typeSelect = document.getElementById('agreement-type-select');
  const statusSelect = document.getElementById('agreement-status-select');
  const rows = document.querySelectorAll('.agreement-row');
  const emptyState = document.getElementById('agreements-empty-state');
  const counterSpan = document.getElementById('agreements-visible-count');

  if (!searchInput && !countrySelect && !rows.length) return;

  function filterRows() {
    const query = (searchInput?.value || '').toLowerCase().trim();
    const country = (countrySelect?.value || '').toLowerCase();
    const type = (typeSelect?.value || '').toLowerCase();
    const status = (statusSelect?.value || '').toLowerCase();

    let visibleCount = 0;

    rows.forEach(row => {
      const text = (row.getAttribute('data-search') || row.textContent).toLowerCase();
      const rowCountry = (row.getAttribute('data-country') || '').toLowerCase();
      const rowType = (row.getAttribute('data-type') || '').toLowerCase();
      const rowStatus = (row.getAttribute('data-status') || '').toLowerCase();

      const matchesQuery = !query || text.includes(query);
      const matchesCountry = !country || rowCountry === country;
      const matchesType = !type || rowType === type;
      const matchesStatus = !status || rowStatus === status;

      if (matchesQuery && matchesCountry && matchesType && matchesStatus) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    if (counterSpan) {
      counterSpan.textContent = visibleCount;
    }

    if (emptyState) {
      emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  }

  searchInput?.addEventListener('input', filterRows);
  countrySelect?.addEventListener('change', filterRows);
  typeSelect?.addEventListener('change', filterRows);
  statusSelect?.addEventListener('change', filterRows);

  const resetBtn = document.getElementById('agreement-reset-filters');
  resetBtn?.addEventListener('click', () => {
    if (searchInput) searchInput.value = '';
    if (countrySelect) countrySelect.value = '';
    if (typeSelect) typeSelect.value = '';
    if (statusSelect) statusSelect.value = '';
    filterRows();
  });
}
