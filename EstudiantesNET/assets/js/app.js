/* ============================================================
   EstudiantesNET · Interacciones de la plantilla
   Sin lógica de negocio ni datos reales.
   ============================================================ */

(function () {
  "use strict";

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
      '<span class="proto-label">Plantilla · vista de diseño</span>' +
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

  function loadingMarkup() {
    return '<div class="stack" aria-busy="true" aria-label="Cargando información">' +
      '<div class="skeleton skeleton-title" style="margin-top:8px"></div>' +
      '<div class="skeleton skeleton-line" style="width:72%;margin-bottom:12px"></div>' +
      '<div class="grid grid-3 gap-4">' +
        '<div class="skeleton skeleton-block"></div>' +
        '<div class="skeleton skeleton-block"></div>' +
        '<div class="skeleton skeleton-block"></div>' +
      "</div>" +
      '<div class="skeleton skeleton-block" style="height:210px;margin-top:8px"></div>' +
      '<div class="skeleton skeleton-line" style="width:58%"></div>' +
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

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") {
        if (document.querySelector(".modal.is-open")) closeModal();
        else closeSidebar();
      }
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

    document.addEventListener("click", function (event) {
      const pageButton = event.target.closest("[data-page-btn]");
      if (!pageButton || pageButton.disabled) return;
      const group = pageButton.closest(".pagination");
      if (group) {
        group.querySelectorAll(".page-btn").forEach(function (button) {
          button.classList.toggle("is-active", button === pageButton);
        });
      }
      showToast("Página " + (pageButton.dataset.pageBtn || "seleccionada") + " · demostración");
    });
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

  function init() {
    protoBar();
    sidebar();
    topbar();
    ensureOverlay();
    initShellEvents();
    initGroups();
    initState();
    initTabs();
    initModals();
    initDemoActions();
    document.documentElement.classList.add("js-ready");
  }

  window.EstuNET = {
    openModal: openModal,
    closeModal: closeModal,
    showToast: showToast,
    setState: renderState
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
