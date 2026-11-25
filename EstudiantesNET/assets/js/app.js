/* ============================================================
   EstudiantesNET · Interacciones de la plantilla
   Sin lógica de negocio ni datos reales.
   ============================================================ */

(function () {
  "use strict";

  /* Versión de la plantilla. Se usa para invalidar caché de HTML, CSS y JS
     mientras el diseño está en desarrollo. */
  const BUILD = "20261124-16";

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
  }

  function closeSidebar() {
    const side = document.getElementById("sidebar");
    const overlay = document.getElementById("mobile-overlay");
    const button = document.getElementById("mobile-menu-btn");
    if (!side || !overlay) return;
    side.classList.remove("is-open");
    overlay.classList.remove("is-open");
    if (button) button.setAttribute("aria-expanded", "false");
    document.body.classList.remove("modal-open");
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
    lastFocused = document.activeElement;
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
    ensureOverlay();
    initShellEvents();
    initGroups();
    initState();
    initTabs();
    initModals();
    initFlipCards();
    initDemoActions();
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
