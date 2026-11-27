/* ============================================================
   EstudiantesNET · Interacciones de la plantilla
   Sin lógica de negocio ni datos reales.
   ============================================================ */

(function () {
  "use strict";

  /* Versión de la plantilla. Se usa para invalidar caché de HTML, CSS y JS
     mientras el diseño está en desarrollo. */
  const BUILD = "20261127-26";

  const PAGES = {
    inicio: { title: "Inicio", subtitle: "Resumen académico y administrativo · Periodo 2026", role: "Estudiante" },
    carnet: { title: "Carnet virtual", subtitle: "Identificación digital del estudiante", role: "Estudiante" },
    alumno: { title: "Información del alumno", subtitle: "Datos personales y familiares de la ficha de matrícula", role: "Acudiente" },
    tareas: { title: "Consulta de tareas", subtitle: "Tareas, guías y recuperaciones del periodo", role: "Estudiante" },
    informe: { title: "Informe académico", subtitle: "Sábana de notas y descripción de la evaluación", role: "Estudiante" },
    logros: { title: "Metas y logros", subtitle: "Logros, acciones e indicadores por asignatura", role: "Estudiante" },
    observador: { title: "Observador del alumno", subtitle: "Anotaciones académicas y de convivencia", role: "Estudiante" },
    circulares: { title: "Circulares y comunicados", subtitle: "Comunicaciones oficiales de la institución", role: "Estudiante" },
    pqrs: { title: "PQRS", subtitle: "Peticiones, quejas, reclamos, sugerencias, felicitaciones y denuncias", role: "Estudiante" },
    bullying: { title: "Denunciar bullying", subtitle: "Canal confidencial de reporte escolar", role: "Estudiante" },
    referidos: { title: "Referidos", subtitle: "Programa de referidos · Año 2026", role: "Estudiante" },
    historia: { title: "Historia clínica", subtitle: "Afiliación, contacto, antecedentes y valoraciones", role: "Acudiente" },
    servicio: { title: "Servicio social", subtitle: "Programas, inscripción y evaluación", role: "Estudiante" },
    traslados: { title: "Traslados de colegio", subtitle: "Solicitud y seguimiento de traslado", role: "Acudiente" },
    cuenta: { title: "Estado de cuenta", subtitle: "Pensiones, pagos y obligaciones · Periodo 2026", role: "Estudiante" },
    matricula: { title: "Proceso de matrícula", subtitle: "Pre-matrícula 2027 · Documentos y firmas", role: "Acudiente" }
  };

  const NAV = [
    {
      label: "Principal",
      items: [
        { page: "inicio", href: "index.html", label: "Inicio", icon: "house" },
        { page: "carnet", href: "carnet.html", label: "Carnet virtual", icon: "identification-card" }
      ]
    },
    {
      label: "Académico",
      items: [
        { page: "alumno", href: "alumno.html", label: "Información del alumno", icon: "user-circle" },
        { page: "tareas", href: "tareas.html", label: "Consulta de tareas", icon: "list-checks" },
        { page: "informe", href: "informe.html", label: "Informe académico", icon: "file-text" },
        { page: "logros", href: "logros.html", label: "Metas y logros", icon: "trophy" },
        { page: "observador", href: "observador.html", label: "Observador del alumno", icon: "notebook" }
      ]
    },
    {
      label: "Comunicación",
      items: [
        { page: "circulares", href: "circulares.html", label: "Circulares", icon: "envelope-simple" },
        { page: "pqrs", href: "pqrs.html", label: "PQRS", icon: "chat-circle-dots" },
        { page: "bullying", href: "bullying.html", label: "Denunciar bullying", icon: "shield-warning" },
        { page: "referidos", href: "referidos.html", label: "Referidos", icon: "users-three" }
      ]
    },
    {
      label: "Bienestar",
      items: [
        { page: "historia", href: "historia-clinica.html", label: "Historia clínica", icon: "heartbeat" },
        { page: "servicio", href: "servicio-social.html", label: "Servicio social", icon: "hand-heart" },
        { page: "traslados", href: "traslados.html", label: "Traslados", icon: "arrows-left-right" }
      ]
    },
    {
      label: "Administración",
      items: [
        { page: "cuenta", href: "cuenta.html", label: "Estado de cuenta", icon: "credit-card" },
        { page: "matricula", href: "matricula.html", label: "Proceso de matrícula", icon: "graduation-cap" }
      ]
    }
  ];

  const currentPage = document.body.dataset.page || "inicio";
  const config = PAGES[currentPage] || PAGES.inicio;

  function icon(name, extra) {
    return '<i class="ph ph-' + name + (extra ? " " + extra : "") + '" aria-hidden="true"></i>';
  }

  function activeGroupIndex() {
    return NAV.findIndex(function (group) {
      return group.items.some(function (item) { return item.page === currentPage; });
    });
  }

  function protoBar() {
    const host = document.getElementById("proto-bar");
    if (!host) return;
    host.className = "proto-bar";
    host.innerHTML =
      '<span class="proto-label">Plantilla · vista de diseño · v' + BUILD + '</span>' +
      '<div class="proto-actions" role="group" aria-label="Estados de la vista">' +
        '<button class="proto-btn is-active" type="button" data-state-btn="normal" aria-pressed="true">Normal</button>' +
        '<button class="proto-btn" type="button" data-state-btn="loading" aria-pressed="false">Cargando</button>' +
        '<button class="proto-btn" type="button" data-state-btn="empty" aria-pressed="false">Vacío</button>' +
        '<button class="proto-btn" type="button" data-state-btn="error" aria-pressed="false">Error</button>' +
      "</div>";
  }

  function sidebar() {
    const host = document.getElementById("sidebar");
    if (!host) return;
    const activeGroup = activeGroupIndex();

    host.className = "sidebar";
    host.setAttribute("aria-label", "Navegación principal");

    let groups = "";
    NAV.forEach(function (group, index) {
      const open = index === activeGroup || index === 0;
      const links = group.items.map(function (item) {
        const active = item.page === currentPage;
        return '<a class="nav-link' + (active ? " is-active" : "") + '" href="' + item.href + '"' +
          (active ? ' aria-current="page"' : "") + ">" +
          icon(item.icon) + "<span>" + item.label + "</span></a>";
      }).join("");

      groups +=
        '<div class="nav-group">' +
          '<button class="nav-group-toggle" type="button" data-group-toggle aria-expanded="' + open + '" aria-controls="nav-group-' + index + '">' +
            "<span>" + group.label + "</span>" + icon("caret-down") +
          "</button>" +
          '<div class="nav-group-list" id="nav-group-' + index + '"' + (open ? "" : " hidden") + ">" + links + "</div>" +
        "</div>";
    });

    host.innerHTML =
      '<div class="sidebar-brand">' +
        '<a class="brand-link" href="index.html" aria-label="EstudiantesNET, ir al inicio">' +
          '<span class="brand-mark">EN</span>' +
          '<span><span class="brand-name">EstudiantesNET</span><span class="brand-sub">Portal del estudiante</span></span>' +
        "</a>" +
        '<button class="sidebar-close" type="button" id="sidebar-close" aria-label="Cerrar menú">' + icon("x") + "</button>" +
      "</div>" +
      '<nav class="sidebar-nav" aria-label="Módulos del portal">' + groups + "</nav>" +
      '<div class="sidebar-footer">' +
        '<button class="nav-link" type="button" data-demo="Sesión finalizada (demostración)">' +
          icon("sign-out") + "<span>Cerrar sesión</span>" +
        "</button>" +
      "</div>";
  }

  function topbar() {
    const host = document.getElementById("topbar");
    if (!host) return;
    host.className = "topbar";
    host.innerHTML =
      '<div class="topbar-left">' +
        '<button class="mobile-menu-btn" type="button" id="mobile-menu-btn" aria-label="Abrir menú" aria-controls="sidebar" aria-expanded="false">' +
          icon("list") +
        "</button>" +
        '<div class="topbar-title"><h1>' + config.title + "</h1><p>" + config.subtitle + "</p></div>" +
      "</div>" +
      '<div class="topbar-right">' +
        '<span class="role-label">' + config.role + "</span>" +
        '<button class="profile-btn" type="button" data-demo="Perfil del usuario (demostración)">' +
          '<span class="avatar">LM</span>' +
          '<span><span class="profile-name">Laura Martínez</span><span class="profile-role">' + config.role + "</span></span>" +
          icon("caret-down") +
        "</button>" +
      "</div>";
  }

  function ensureOverlay() {
    if (document.getElementById("mobile-overlay")) return;
    const overlay = document.createElement("div");
    overlay.id = "mobile-overlay";
    overlay.className = "overlay";
    document.body.appendChild(overlay);
  }

  function openSidebar() {
    const side = document.getElementById("sidebar");
    const overlay = document.getElementById("mobile-overlay");
    const button = document.getElementById("mobile-menu-btn");
    if (!side || !overlay) return;
    side.classList.add("is-open");
    overlay.classList.add("is-open");
    if (button) button.setAttribute("aria-expanded", "true");
    document.body.classList.add("modal-open");
    const closeButton = document.getElementById("sidebar-close");
    if (closeButton) setTimeout(function () { closeButton.focus(); }, 50);
  }

  function closeSidebar() {
    const side = document.getElementById("sidebar");
    const overlay = document.getElementById("mobile-overlay");
    const button = document.getElementById("mobile-menu-btn");
    if (!side || !overlay) return;
    side.classList.remove("is-open");
    overlay.classList.remove("is-open");
    if (button) {
      button.setAttribute("aria-expanded", "false");
      if (side.contains(document.activeElement)) button.focus();
    }
    document.body.classList.remove("modal-open");
  }

  /* ---------- Menú móvil inferior (hoja accesible) ---------- */

  function openMobileNav() {
    const sheet = document.getElementById("mobile-nav-sheet");
    const backdrop = document.getElementById("mobile-nav-backdrop");
    const fab = document.getElementById("mobile-nav-fab");
    if (!sheet || !backdrop || !fab || !sheet.hidden) return;
    closeSidebar();
    sheet.hidden = false;
    backdrop.hidden = false;
    fab.setAttribute("aria-expanded", "true");
    document.body.classList.add("mobile-nav-open");
    const navBody = sheet.querySelector(".mobile-nav-body");
    if (navBody) navBody.scrollTop = 0;
    const activeLink = sheet.querySelector(".mobile-nav-link.is-active");
    if (activeLink) activeLink.scrollIntoView({ block: "nearest" });
    const closeButton = document.getElementById("mobile-nav-close");
    if (closeButton) setTimeout(function () { closeButton.focus(); }, 30);
  }

  function closeMobileNav(restoreFocus) {
    const sheet = document.getElementById("mobile-nav-sheet");
    const backdrop = document.getElementById("mobile-nav-backdrop");
    const fab = document.getElementById("mobile-nav-fab");
    if (!sheet || sheet.hidden) return;
    const hadFocus = sheet.contains(document.activeElement);
    sheet.hidden = true;
    backdrop.hidden = true;
    if (fab) fab.setAttribute("aria-expanded", "false");
    document.body.classList.remove("mobile-nav-open");
    if (restoreFocus !== false && fab && hadFocus && fab.getClientRects().length > 0) {
      fab.focus();
    }
  }

  function mobileNavKeydown(event) {
    const sheet = document.getElementById("mobile-nav-sheet");
    if (!sheet || sheet.hidden) return;
    if (event.key === "Escape") {
      event.preventDefault();
      closeMobileNav();
      return;
    }
    if (event.key !== "Tab") return;
    const focusable = Array.prototype.filter.call(
      sheet.querySelectorAll(
        'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
      ),
      function (element) { return element.offsetParent !== null; }
    );
    if (!focusable.length) return;
    const first = focusable[0];
    const last = focusable[focusable.length - 1];
    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  }

  function mobileNav() {
    if (document.getElementById("mobile-nav-fab")) return;
    if (!document.getElementById("mobile-menu-btn")) return;

    let groupsHtml = "";
    NAV.forEach(function (group, index) {
      const links = group.items.map(function (item) {
        const active = item.page === currentPage;
        return '<a class="mobile-nav-link' + (active ? " is-active" : "") + '" href="' + item.href + '"' +
          (active ? ' aria-current="page"' : "") + " data-mobile-nav-close>" +
          icon(item.icon) + "<span>" + item.label + "</span>" +
          (active ? '<span class="mobile-nav-badge" aria-hidden="true">Actual</span>' : "") +
          "</a>";
      }).join("");
      groupsHtml +=
        '<div class="mobile-nav-group">' +
          '<p class="mobile-nav-group-label" id="mobile-nav-group-' + index + '">' + group.label + "</p>" +
          '<div class="mobile-nav-links" role="group" aria-labelledby="mobile-nav-group-' + index + '">' + links + "</div>" +
        "</div>";
    });

    document.body.insertAdjacentHTML("beforeend",
      '<div class="mobile-nav-backdrop" id="mobile-nav-backdrop" aria-hidden="true" hidden></div>' +
      '<section class="mobile-nav-sheet" id="mobile-nav-sheet" role="dialog" aria-modal="true" aria-labelledby="mobile-nav-title" hidden>' +
        '<div class="mobile-nav-grab" aria-hidden="true"></div>' +
        '<div class="mobile-nav-head">' +
          '<div><h2 class="mobile-nav-title" id="mobile-nav-title">Menú</h2><p class="mobile-nav-sub">Navegación principal</p></div>' +
          '<button class="mobile-nav-close" type="button" id="mobile-nav-close" aria-label="Cerrar menú">' + icon("x") + "</button>" +
        "</div>" +
        '<nav class="mobile-nav-body" aria-label="Módulos del portal">' + groupsHtml + "</nav>" +
        '<div class="mobile-nav-foot">' +
          '<button class="mobile-nav-logout" type="button" data-mobile-nav-close data-demo="Sesión finalizada (demostración)">' +
            icon("sign-out") + "<span>Cerrar sesión</span>" +
          "</button>" +
        "</div>" +
      "</section>" +
      '<button class="mobile-nav-fab" type="button" id="mobile-nav-fab" aria-label="Abrir menú de navegación" aria-controls="mobile-nav-sheet" aria-expanded="false">' +
        icon("list") + "<span>Menú</span>" +
      "</button>"
    );

    const fab = document.getElementById("mobile-nav-fab");
    const backdrop = document.getElementById("mobile-nav-backdrop");
    const sheet = document.getElementById("mobile-nav-sheet");
    const closeButton = document.getElementById("mobile-nav-close");
    if (!fab || !backdrop || !sheet) return;

    fab.addEventListener("click", openMobileNav);
    backdrop.addEventListener("click", closeMobileNav);
    if (closeButton) closeButton.addEventListener("click", closeMobileNav);
    sheet.querySelectorAll("[data-mobile-nav-close]").forEach(function (element) {
      element.addEventListener("click", function () { closeMobileNav(); });
    });
    document.addEventListener("keydown", mobileNavKeydown);

    const media = window.matchMedia("(max-width: 600px)");
    if (media.addEventListener) {
      media.addEventListener("change", function (event) {
        if (event.matches) return;
        const wasOpen = sheet && !sheet.hidden;
        closeMobileNav(false);
        const menuButton = document.getElementById("mobile-menu-btn");
        if (wasOpen && menuButton && menuButton.getClientRects().length) menuButton.focus();
      });
    }
  }

  /* --- Piezas reutilizables de los esqueletos de carga --- */

  function skHead() {
    return '<div class="skeleton-head">' +
      '<div class="skeleton skeleton-eyebrow"></div>' +
      '<div class="skeleton skeleton-title"></div>' +
      '<div class="skeleton skeleton-subtitle"></div>' +
    "</div>";
  }

  function skLines(widths) {
    return widths.map(function (width) {
      return '<div class="skeleton skeleton-line" style="width:' + width + '"></div>';
    }).join("");
  }

  function skStats(count) {
    let items = "";
    for (let i = 0; i < (count || 3); i++) {
      items += '<div class="skeleton-stat"><div class="skeleton skeleton-stat-label"></div><div class="skeleton skeleton-stat-value"></div></div>';
    }
    return '<div class="skeleton-stats">' + items + "</div>";
  }

  function skTable(rows) {
    let out = '<div class="skeleton-table">' +
      '<div class="skeleton skeleton-table-head"></div>';
    for (let i = 0; i < (rows || 4); i++) {
      out += '<div class="skeleton skeleton-table-row"></div>';
    }
    return out + "</div>";
  }

  function skList(items, itemClass) {
    let out = '<div class="skeleton-list">';
    for (let i = 0; i < (items || 4); i++) {
      out += '<div class="skeleton ' + (itemClass || "skeleton-list-item") + '"></div>';
    }
    return out + "</div>";
  }

  function skCards(items, cardClass) {
    let out = '<div class="skeleton-cards">';
    for (let i = 0; i < (items || 3); i++) {
      out += '<div class="skeleton ' + (cardClass || "skeleton-card") + '"></div>';
    }
    return out + "</div>";
  }

  function skForm(fields, options) {
    options = options || {};
    let out = '<div class="skeleton-form">';
    if (options.intro) out += '<div class="skeleton skeleton-line" style="width:72%"></div>';
    for (let i = 0; i < (fields || 3); i++) {
      out += '<div class="skeleton skeleton-field"></div>';
    }
    if (options.textarea) out += '<div class="skeleton skeleton-field-lg"></div>';
    return out + "</div>";
  }

  function skLogro() {
    return '<div class="skeleton-logro">' +
      '<div class="skeleton skeleton-logro-head"></div>' +
      '<div class="skeleton-logro-periods">' +
        '<div class="skeleton skeleton-logro-period"></div>' +
        '<div class="skeleton skeleton-logro-period"></div>' +
        '<div class="skeleton skeleton-logro-period"></div>' +
      "</div>" +
    "</div>";
  }

  function loadingMarkup() {
    const page = document.body.dataset.page || "inicio";
    const skeletons = {
      inicio: skHead() +
        '<div class="skeleton-hero">' + skLines(["72%", "54%", "58%"]) + "</div>" +
        skStats(3) + skTable(4),
      carnet: skHead() +
        '<div class="skeleton-carnet-body">' +
          '<div class="skeleton skeleton-photo"></div>' +
          '<div class="skeleton-carnet-info">' +
            '<div class="skeleton skeleton-name"></div>' +
            '<div class="skeleton-details">' + skLines(["100%", "84%", "92%"]) + "</div>" +
          "</div>" +
        "</div>",
      alumno: skHead() + skForm(3, { intro: true }) + skCards(2, "skeleton-card-md"),
      tareas: skHead() + skTable(4),
      informe: skHead() + skTable(6) + skTable(3),
      logros: skHead() + '<div class="skeleton-logros">' + skLogro() + skLogro() + "</div>",
      observador: skHead() + skTable(5),
      circulares: skHead() + skList(5),
      pqrs: skHead() + skForm(3, { intro: true, textarea: true }),
      bullying: skHead() + skForm(2, { textarea: true }),
      referidos: skHead() + skForm(2) + skCards(2, "skeleton-card-md"),
      servicio: skHead() + skCards(3, "skeleton-card-md"),
      historia: skHead() + skForm(3, { intro: true }) + skCards(2, "skeleton-card-md"),
      cuenta: skHead() + skStats(3) + skTable(6),
      matricula: skHead() + skForm(2) + skTable(3),
      traslados: skHead() + skForm(2) + skTable(3)
    };

    return '<div class="skeleton-view skeleton-' + page + '" role="status" aria-live="polite">' +
      '<span class="sr-only">Cargando información…</span>' +
      (skeletons[page] || skeletons.inicio) +
    "</div>";
  }

  function renderState(state) {
    const host = document.getElementById("state-host");
    const content = document.getElementById("page-content");
    if (!host || !content) return;

    document.body.dataset.state = state;

    if (state === "normal") {
      host.hidden = true;
      host.innerHTML = "";
      content.hidden = false;
      return;
    }

    content.hidden = true;
    host.hidden = false;

    if (state === "loading") {
      host.innerHTML = loadingMarkup();
      return;
    }

    if (state === "empty") {
      host.innerHTML =
        '<div class="empty-state">' +
          '<span class="eyebrow">Sin resultados</span>' +
          "<h3>No hay información para mostrar</h3>" +
          "<p>Esta vista de ejemplo representa el estado vacío de la plantilla. Puedes volver a la vista normal para continuar explorando.</p>" +
          '<button class="btn btn-secondary btn-sm" type="button" data-state-btn="normal">' + icon("arrow-counter-clockwise") + "Volver a la vista normal</button>" +
        "</div>";
      bindStateButtons(host);
      return;
    }

    host.innerHTML =
      '<div class="alert alert-danger" role="alert">' +
        icon("warning-circle") +
        '<div><p class="alert-title">No se pudo cargar la información</p>' +
        '<p class="alert-text">La plantilla muestra aquí el estado de error. Verifica la conexión o intenta nuevamente.</p>' +
        '<div class="alert-actions"><button class="btn btn-secondary btn-sm" type="button" data-state-btn="normal">' + icon("arrow-clockwise") + "Reintentar</button></div></div>" +
      "</div>";
    bindStateButtons(host);
  }

  function bindStateButtons(scope) {
    (scope || document).querySelectorAll("[data-state-btn]").forEach(function (button) {
      if (button.dataset.stateBound === "true") return;
      button.dataset.stateBound = "true";
      button.addEventListener("click", function () {
        renderState(button.dataset.stateBtn);
        document.querySelectorAll(".proto-btn").forEach(function (item) {
          const active = item.dataset.stateBtn === button.dataset.stateBtn;
          item.classList.toggle("is-active", active);
          item.setAttribute("aria-pressed", String(active));
        });
      });
    });
  }

  function initState() {
    document.querySelectorAll(".proto-btn").forEach(function (button) {
      button.addEventListener("click", function () {
        document.querySelectorAll(".proto-btn").forEach(function (item) {
          const active = item === button;
          item.classList.toggle("is-active", active);
          item.setAttribute("aria-pressed", String(active));
        });
        renderState(button.dataset.stateBtn);
      });
    });
    renderState("normal");
  }

  function initTabs() {
    document.querySelectorAll("[data-tabs]").forEach(function (tabs) {
      const buttons = Array.from(tabs.querySelectorAll("[data-tab]"));
      const panels = Array.from(tabs.querySelectorAll("[data-tab-panel]"));
      if (!buttons.length) return;

      function activate(id) {
        buttons.forEach(function (button) {
          const active = button.dataset.tab === id;
          button.setAttribute("aria-selected", String(active));
          button.tabIndex = active ? 0 : -1;
        });
        panels.forEach(function (panel) {
          panel.hidden = panel.dataset.tabPanel !== id;
        });
        refreshVisiblePaginators();
      }

      buttons.forEach(function (button, index) {
        button.addEventListener("click", function () { activate(button.dataset.tab); });
        button.addEventListener("keydown", function (event) {
          if (event.key !== "ArrowLeft" && event.key !== "ArrowRight") return;
          event.preventDefault();
          const next = (index + (event.key === "ArrowRight" ? 1 : -1) + buttons.length) % buttons.length;
          buttons[next].focus();
          activate(buttons[next].dataset.tab);
        });
      });

      const selected = buttons.find(function (button) { return button.getAttribute("aria-selected") === "true"; }) || buttons[0];
      activate(selected.dataset.tab);
    });
  }

  function initGroups() {
    document.querySelectorAll("[data-group-toggle]").forEach(function (button) {
      button.addEventListener("click", function () {
        const targetId = button.getAttribute("aria-controls");
        const target = document.getElementById(targetId);
        if (!target) return;
        const open = button.getAttribute("aria-expanded") === "true";
        button.setAttribute("aria-expanded", String(!open));
        target.hidden = open;
      });
    });
  }

  let lastFocused = null;

  function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    const mobileSheet = document.getElementById("mobile-nav-sheet");
    const sheetWasOpen = mobileSheet && !mobileSheet.hidden;
    closeMobileNav(false);
    lastFocused = sheetWasOpen ? document.getElementById("mobile-nav-fab") : document.activeElement;
    modal.classList.add("is-open");
    document.body.classList.add("modal-open");
    const focusable = modal.querySelector("[autofocus], button, [href], input, select, textarea");
    if (focusable) setTimeout(function () { focusable.focus(); }, 30);
  }

  function closeModal(id) {
    const modal = id ? document.getElementById(id) : document.querySelector(".modal.is-open");
    if (!modal) return;
    modal.classList.remove("is-open");
    if (!document.querySelector(".modal.is-open")) document.body.classList.remove("modal-open");
    if (lastFocused && typeof lastFocused.focus === "function") lastFocused.focus();
  }

  function initModals() {
    document.addEventListener("click", function (event) {
      const opener = event.target.closest("[data-modal-open]");
      if (opener) {
        event.preventDefault();
        openModal(opener.dataset.modalOpen);
        return;
      }
      const closer = event.target.closest("[data-modal-close]");
      if (closer) {
        event.preventDefault();
        closeModal(closer.closest(".modal") ? closer.closest(".modal").id : null);
        return;
      }
      if (event.target.classList.contains("modal")) closeModal(event.target.id);
    });

    document.querySelectorAll("[data-modal-open][role='button']").forEach(function (opener) {
      opener.addEventListener("keydown", function (event) {
        if (event.key === "Enter" || event.key === " " || event.key === "Spacebar") {
          event.preventDefault();
          openModal(opener.dataset.modalOpen);
        }
      });
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") {
        if (document.querySelector(".modal.is-open")) closeModal();
        else closeSidebar();
      }
    });
  }

  function initFlipCards() {
    document.querySelectorAll("[data-flip-card]").forEach(function (card) {
      function flip() {
        const flipped = card.classList.toggle("is-flipped");
        card.setAttribute("aria-pressed", String(flipped));
        const hint = card.parentElement ? card.parentElement.querySelector("[data-flip-hint]") : null;
        if (hint) {
          hint.innerHTML = flipped
            ? '<i class="ph ph-arrow-counter-clockwise" aria-hidden="true"></i> Haz clic en el carnet para volver al frente'
            : '<i class="ph ph-arrows-clockwise" aria-hidden="true"></i> Haz clic en el carnet para girarlo';
        }
      }
      card.addEventListener("click", flip);
      card.addEventListener("keydown", function (event) {
        if (event.key === "Enter" || event.key === " " || event.key === "Spacebar") {
          event.preventDefault();
          flip();
        }
      });
    });
  }

  let toastTimer = null;

  function showToast(message) {
    let toast = document.getElementById("toast");
    if (!toast) {
      toast = document.createElement("div");
      toast.id = "toast";
      toast.className = "toast";
      toast.setAttribute("role", "status");
      toast.setAttribute("aria-live", "polite");
      document.body.appendChild(toast);
    }
    toast.textContent = message || "Acción de demostración";
    toast.classList.add("is-visible");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { toast.classList.remove("is-visible"); }, 3000);
  }

  function initDemoActions() {
    document.addEventListener("click", function (event) {
      const demo = event.target.closest("[data-demo]");
      if (!demo) return;
      if (demo.tagName === "A" && demo.getAttribute("href") === "#") event.preventDefault();
      showToast(demo.dataset.demo || "Acción de demostración");
    });
  }

  /* ---------- Paginación unificada ----------
     Una sola barra fija (siempre accesible) por cada contenedor [data-paginate].
     El marcado de cada vista solo necesita:
       <section data-paginate data-per-page="5" data-page-label="...">
         <tr data-page-item>...</tr>
       </section>
  */

  function getPaginationHost() {
    let host = document.getElementById("pagination-bars");
    if (!host) {
      host = document.createElement("div");
      host.id = "pagination-bars";
      host.className = "pagination-bars";
      document.body.appendChild(host);
    }
    return host;
  }

  function paginatorIsVisible(root) {
    if (!root || root.closest("[hidden]")) return false;
    const style = window.getComputedStyle(root);
    if (style.display === "none" || style.visibility === "hidden") return false;
    return root.getClientRects().length > 0;
  }

  function setupPaginator(root) {
    if (root.__paginateReady) return root;
    root.__paginateReady = true;

    const perPage = Math.max(1, parseInt(root.getAttribute("data-per-page"), 10) || 10);
    const label = root.getAttribute("data-page-label") || "Paginación";
    const host = getPaginationHost();
    let current = 1;

    const bar = document.createElement("div");
    bar.className = "pagination-bar";
    bar.setAttribute("data-page-bar", root.id || label);
    bar.innerHTML =
      '<span class="pagination-summary" data-page-info></span>' +
      '<div class="pagination" role="navigation" aria-label="' + label + '">' +
        '<button class="page-btn" type="button" data-page-prev aria-label="Página anterior"><i class="ph ph-caret-left" aria-hidden="true"></i></button>' +
        '<span class="pagination-numbers" data-page-numbers></span>' +
        '<button class="page-btn" type="button" data-page-next aria-label="Página siguiente"><i class="ph ph-caret-right" aria-hidden="true"></i></button>' +
      '</div>';
    host.appendChild(bar);

    const info = bar.querySelector("[data-page-info]");
    const prev = bar.querySelector("[data-page-prev]");
    const next = bar.querySelector("[data-page-next]");
    const numbers = bar.querySelector("[data-page-numbers]");
    info.setAttribute("aria-live", "polite");

    function getItems() {
      return Array.from(root.querySelectorAll("[data-page-item]"));
    }

    function eligible() {
      return getItems().filter(function (item) {
        return item.getAttribute("data-filtered") !== "true";
      });
    }

    function render() {
      const list = eligible();
      const pages = Math.max(1, Math.ceil(list.length / perPage));
      current = Math.min(Math.max(1, current), pages);
      const start = (current - 1) * perPage;
      const slice = list.slice(start, start + perPage);
      const end = start + slice.length;

      getItems().forEach(function (item) { item.hidden = true; });
      slice.forEach(function (item) { item.hidden = false; });

      info.textContent = list.length
        ? "Mostrando " + (start + 1) + "–" + end + " de " + list.length
        : "Sin resultados";
      prev.disabled = current <= 1;
      next.disabled = current >= pages;

      numbers.innerHTML = "";
      for (let page = 1; page <= pages; page += 1) {
        const button = document.createElement("button");
        button.type = "button";
        button.className = "page-btn" + (page === current ? " is-active" : "");
        button.setAttribute("data-page-btn", String(page));
        button.setAttribute("aria-label", "Página " + page);
        button.textContent = String(page);
        if (page === current) button.setAttribute("aria-current", "page");
        numbers.appendChild(button);
      }

      bar.hidden = !paginatorIsVisible(root);
      const anyVisible = Array.from(host.querySelectorAll(".pagination-bar")).some(function (item) {
        return !item.hidden;
      });
      document.body.classList.toggle("has-pagination", anyVisible);
    }

    function goTo(page) {
      const total = Math.max(1, Math.ceil(eligible().length / perPage));
      current = Math.min(Math.max(1, page), total);
      render();
    }

    bar.addEventListener("click", function (event) {
      const target = event.target.closest("[data-page-btn], [data-page-prev], [data-page-next]");
      if (!target) return;
      if (target.hasAttribute("data-page-prev")) goTo(current - 1);
      else if (target.hasAttribute("data-page-next")) goTo(current + 1);
      else goTo(parseInt(target.getAttribute("data-page-btn"), 10) || 1);
    });

    root.__paginateGoTo = goTo;
    root.__paginateRender = render;
    root.__paginateRefresh = function () { goTo(1); };
    render();
    return root;
  }

  function refreshVisiblePaginators() {
    document.querySelectorAll("[data-paginate]").forEach(function (root) {
      if (root.__paginateRender) root.__paginateRender();
    });
  }

  function initPagination(scope) {
    (scope || document).querySelectorAll("[data-paginate]").forEach(setupPaginator);
  }

  /* ---------- Adaptación móvil de tablas y bloques desplazables ----------
     Las tablas de datos se convierten en tarjetas con etiquetas en pantallas
     pequeñas. Las tablas matriciales (sábana de notas) conservan su estructura
     y se desplazan horizontalmente con la primera columna fija. */

  function enhanceResponsiveTables() {
    document.querySelectorAll(".data-table").forEach(function (table) {
      const mode = table.getAttribute("data-mobile") ||
        (document.body.dataset.page === "informe" ? "scroll" : "cards");
      table.setAttribute("data-mobile", mode);

      const headers = Array.from(table.querySelectorAll("thead th")).map(function (th) {
        return (th.textContent || "").trim();
      });

      table.querySelectorAll("tbody tr").forEach(function (row) {
        let column = 0;
        row.querySelectorAll("td").forEach(function (cell) {
          const label = headers[column];
          if (label && !cell.hasAttribute("data-label")) cell.setAttribute("data-label", label);
          column += parseInt(cell.getAttribute("colspan") || "1", 10);
        });
      });

      table.querySelectorAll("tfoot tr").forEach(function (row) {
        let column = 0;
        row.querySelectorAll("td").forEach(function (cell) {
          const span = parseInt(cell.getAttribute("colspan") || "1", 10);
          const label = headers[column];
          if (span === 1 && label && !cell.hasAttribute("data-label")) {
            cell.setAttribute("data-label", label);
          }
          column += span;
        });
      });

      if (mode === "scroll") {
        const wrap = table.closest(".table-wrap");
        if (wrap) wrap.classList.add("is-scrollable");
      }
    });
  }

  function addScrollHints() {
    const hinted = new Set();

    document.querySelectorAll('.data-table[data-mobile="scroll"]').forEach(function (table) {
      const wrap = table.closest(".table-wrap");
      if (!wrap) return;
      const scope = wrap.closest(".tab-panel") || wrap.closest("section") || wrap.parentElement;
      if (!scope || hinted.has(scope)) return;
      if (scope.querySelector(".scroll-hint")) {
        hinted.add(scope);
        return;
      }
      hinted.add(scope);
      const hint = document.createElement("p");
      hint.className = "scroll-hint";
      hint.innerHTML = icon("arrows-horizontal") + "<span>Desliza para ver todas las columnas</span>";
      wrap.parentElement.insertBefore(hint, wrap);
    });

    const periods = document.querySelector(".logro-periods");
    if (periods && periods.parentElement && !periods.parentElement.querySelector(".scroll-hint")) {
      const hint = document.createElement("p");
      hint.className = "scroll-hint";
      hint.innerHTML = icon("arrows-horizontal") + "<span>Desliza para ver todos los periodos</span>";
      periods.parentElement.insertBefore(hint, periods);
    }
  }

  function initShellEvents() {
    const openButton = document.getElementById("mobile-menu-btn");
    const closeButton = document.getElementById("sidebar-close");
    const overlay = document.getElementById("mobile-overlay");
    if (openButton) openButton.addEventListener("click", openSidebar);
    if (closeButton) closeButton.addEventListener("click", closeSidebar);
    if (overlay) overlay.addEventListener("click", closeSidebar);
    document.querySelectorAll(".sidebar .nav-link").forEach(function (link) {
      link.addEventListener("click", closeSidebar);
    });

    document.addEventListener("keydown", function (event) {
      if (event.key !== "Tab") return;
      const side = document.getElementById("sidebar");
      if (!side || !side.classList.contains("is-open")) return;
      const focusable = side.querySelectorAll(
        'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
      );
      if (!focusable.length) return;
      const first = focusable[0];
      const last = focusable[focusable.length - 1];
      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    });
  }

  function ensureBuild() {
    if (document.documentElement.getAttribute("data-build") === BUILD) return true;
    const url = new URL(window.location.href);
    if (url.searchParams.get("v") === BUILD) return true;
    url.searchParams.set("v", BUILD);
    window.location.replace(url.href);
    return false;
  }

  function bustLinks() {
    document.querySelectorAll("a[href]").forEach(function (link) {
      const href = link.getAttribute("href");
      if (!href || href.charAt(0) === "#") return;
      if (/^(https?:|mailto:|tel:|javascript:)/i.test(href)) return;
      if (!/\.html(\?|#|$)/i.test(href)) return;
      if (/[?&]v=/.test(href)) return;
      const url = new URL(href, window.location.href);
      url.searchParams.set("v", BUILD);
      link.setAttribute("href", url.pathname + url.search + url.hash);
    });
  }

  function init() {
    if (!ensureBuild()) return;
    protoBar();
    sidebar();
    topbar();
    mobileNav();
    ensureOverlay();
    initShellEvents();
    initGroups();
    initState();
    initTabs();
    initModals();
    initFlipCards();
    initDemoActions();
    enhanceResponsiveTables();
    addScrollHints();
    initPagination();
    bustLinks();
    document.documentElement.classList.add("js-ready");
  }

  window.EstuNET = {
    openModal: openModal,
    closeModal: closeModal,
    showToast: showToast,
    setState: renderState,
    initPagination: initPagination,
    refreshPagination: function (root) {
      if (!root) { initPagination(); return; }
      if (!root.__paginateReady) setupPaginator(root);
      if (root.__paginateRefresh) root.__paginateRefresh();
    }
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
