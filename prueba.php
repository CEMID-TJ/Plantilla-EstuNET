<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wireframe UX/UI - Portal Estudiante</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        accent: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            600: '#1d4ed8', // Contraste > 4.5:1 con blanco
                            700: '#1e40af',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Estilos base para foco accesible WCAG AA */
        *:focus-visible {
            outline: 3px solid #1d4ed8;
            outline-offset: 2px;
        }
        /* Estilo visual de contenedor wireframe */
        .wire-slot {
            background-image: repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 8px,
                rgba(148, 163, 184, 0.06) 8px,
                rgba(148, 163, 184, 0.06) 16px
            );
        }

        /* Sidebar: ancho compacto en escritorio y modo rail colapsado */
        #sidebarNav nav {
            scrollbar-width: none;
            -ms-overflow-style: none;
            overscroll-behavior: contain;
        }
        #sidebarNav nav::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }
        @media (min-width: 1024px) {
            #sidebarNav {
                width: 18rem;
                transition: width 200ms ease, transform 200ms ease;
            }
            #sidebarNav.is-collapsed {
                width: 4.5rem;
            }
            #sidebarNav.is-collapsed .sidebar-brand {
                display: none;
            }
            #sidebarNav.is-collapsed .sidebar-brand-block {
                justify-content: center;
                padding: 0.75rem;
            }
            #sidebarNav.is-collapsed .sidebar-brand-text,
            #sidebarNav.is-collapsed .sidebar-group-toggle,
            #sidebarNav.is-collapsed .nav-label,
            #sidebarNav.is-collapsed .nav-count {
                display: none;
            }
            /* En modo rail se muestran todos los iconos aunque el grupo esté cerrado */
            #sidebarNav.is-collapsed .sidebar-group-list {
                display: block;
            }
            #sidebarNav.is-collapsed nav {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            #sidebarNav.is-collapsed nav > .sidebar-group + .sidebar-group {
                border-top: 1px solid #e2e8f0;
                padding-top: 0.75rem;
            }
            #sidebarNav.is-collapsed .nav-link,
            #sidebarNav.is-collapsed #sidebarToggle,
            #sidebarNav.is-collapsed .sidebar-logout {
                justify-content: center;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            #sidebarNav.is-collapsed .sidebar-rail-hint {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-white text-slate-900 font-sans text-base leading-relaxed antialiased">

    <!-- BARRA DE CONTROL DE PROTOTIPO (Para probar estados de Nielsen: Normal, Carga, Vacío, Error) -->
    <div class="bg-slate-900 text-white px-4 py-3 border-b border-slate-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-end">
            <div class="grid grid-cols-2 sm:flex sm:flex-wrap items-center gap-2 w-full sm:w-auto" role="group" aria-label="Selector de estado de pantalla">
                <button onclick="setSystemState('normal')" id="btn-state-normal" class="state-btn min-h-[36px] px-3 py-1 rounded-lg text-xs font-semibold bg-accent-600 text-white transition">
                    1. Vista Normal
                </button>
                <button onclick="setSystemState('loading')" id="btn-state-loading" class="state-btn min-h-[36px] px-3 py-1 rounded-lg text-xs font-semibold bg-slate-800 text-slate-300 hover:bg-slate-700 transition">
                    2. Estado Carga
                </button>
                <button onclick="setSystemState('empty')" id="btn-state-empty" class="state-btn min-h-[36px] px-3 py-1 rounded-lg text-xs font-semibold bg-slate-800 text-slate-300 hover:bg-slate-700 transition">
                    3. Estado Vacío
                </button>
                <button onclick="setSystemState('error')" id="btn-state-error" class="state-btn min-h-[36px] px-3 py-1 rounded-lg text-xs font-semibold bg-slate-800 text-slate-300 hover:bg-slate-700 transition">
                    4. Estado Error
                </button>
            </div>
        </div>
    </div>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Overlay móvil -->
        <div id="mobileOverlay" onclick="closeMobileNav()" class="fixed inset-0 bg-slate-900/50 z-[60] hidden lg:hidden" aria-hidden="true"></div>

        <!-- NAVEGACIÓN LATERAL (Agrupación por proximidad y similitud - Ley de Gestalt) -->
        <aside id="sidebarNav" aria-label="Menú principal" class="fixed lg:sticky lg:top-[61px] lg:h-[calc(100vh-61px)] inset-y-0 left-0 z-[70] lg:z-40 w-72 bg-white border-r border-slate-200 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-200">

            <!-- Bloque Marca -->
            <div class="sidebar-brand-block px-4 py-3.5 border-b border-slate-200 flex items-center justify-between gap-2">
                <div class="sidebar-brand flex items-center gap-2.5 min-w-0">
                    <div class="sidebar-brand-logo w-9 h-9 rounded-md border border-dashed border-slate-400 bg-slate-50 flex items-center justify-center text-[10px] font-mono text-slate-600 shrink-0">
                        [Logo]
                    </div>
                    <div class="sidebar-brand-text text-[13px] font-semibold text-slate-800 min-w-0 leading-tight">
                        [Institución]
                    </div>
                </div>
                <div class="flex items-center gap-0.5 shrink-0">
                    <button onclick="toggleSidebar()" id="sidebarToggle" aria-expanded="true" aria-controls="sidebarNav" aria-label="Contraer menú" title="Contraer menú" class="hidden lg:flex min-w-[44px] min-h-[44px] items-center justify-center rounded-md text-slate-500 hover:bg-slate-100 hover:text-slate-700">
                        <i id="sidebarToggleIcon" class="ph ph-list text-lg" aria-hidden="true"></i>
                        <span id="sidebarToggleLabel" class="sr-only">Contraer menú</span>
                    </button>
                    <button onclick="toggleMobileNav()" id="mobileNavClose" aria-label="Cerrar menú de navegación" class="lg:hidden min-w-[44px] min-h-[44px] flex items-center justify-center rounded-md text-slate-700 hover:bg-slate-100">
                        <i class="ph ph-x text-lg" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <!-- Lista de Navegación (Áreas táctiles >= 44px) -->
            <nav class="flex-1 overflow-y-auto px-3 py-3 space-y-4">
                <!-- Grupo 1 -->
                <div class="sidebar-group">
                    <button type="button" onclick="toggleSidebarGroup(this)" aria-expanded="true" aria-controls="grupo-principal" class="sidebar-group-toggle w-full min-h-[36px] px-2 flex items-center justify-between gap-2 rounded-md text-slate-500 hover:text-slate-800">
                        <span class="sidebar-group-title text-[11px] font-bold uppercase tracking-wider">[Principal]</span>
                        <i class="ph ph-caret-down sidebar-caret text-xs transition-transform" aria-hidden="true"></i>
                    </button>
                    <ul id="grupo-principal" class="sidebar-group-list space-y-0.5 mt-0.5">
                        <li>
                            <button onclick="selectNav(this, '[Inicio]', 'inicio')" data-view="inicio" aria-current="page" aria-label="[Enlace: Inicio]" title="[Enlace: Inicio]" class="nav-link w-full min-h-[44px] px-2.5 py-1.5 rounded-md bg-slate-100 text-accent-700 font-semibold text-[13px] flex items-center gap-2.5 text-left">
                                <i class="ph ph-house text-base shrink-0" aria-hidden="true"></i>
                                <span class="nav-label">[Inicio]</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Grupo 2: Académico -->
                <div class="sidebar-group">
                    <button type="button" onclick="toggleSidebarGroup(this)" aria-expanded="true" aria-controls="grupo-academico" class="sidebar-group-toggle w-full min-h-[36px] px-2 flex items-center justify-between gap-2 rounded-md text-slate-500 hover:text-slate-800">
                        <span class="sidebar-group-title text-[11px] font-bold uppercase tracking-wider">[Gestión académica]</span>
                        <i class="ph ph-caret-down sidebar-caret text-xs transition-transform" aria-hidden="true"></i>
                    </button>
                    <ul id="grupo-academico" class="sidebar-group-list space-y-0.5 mt-0.5">
                        <li>
                            <button onclick="selectNav(this, '[Información del alumno]', 'alumno')" data-view="alumno" aria-label="[Enlace: Información del alumno]" title="[Enlace: Información del alumno]" class="nav-link w-full min-h-[44px] px-2.5 py-1.5 rounded-md text-slate-700 hover:bg-slate-50 font-medium text-[13px] flex items-center gap-2.5 text-left">
                                <i class="ph ph-identification-card text-base shrink-0" aria-hidden="true"></i>
                                <span class="nav-label">[Información del alumno]</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="selectNav(this, '[Consulta de tareas]', 'tareas')" data-view="tareas" aria-label="[Enlace: Consulta de tareas]" title="[Enlace: Consulta de tareas]" class="nav-link w-full min-h-[44px] px-2.5 py-1.5 rounded-md text-slate-700 hover:bg-slate-50 font-medium text-[13px] flex items-center justify-between gap-2 text-left">
                                <span class="flex items-center gap-2.5 min-w-0">
                                    <i class="ph ph-list-checks text-base shrink-0" aria-hidden="true"></i>
                                    <span class="nav-label">[Consulta de tareas]</span>
                                </span>
                                <span id="navTareasCount" class="nav-count px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 text-[11px] font-mono">42</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="selectNav(this, '[Informe académico]', 'informe')" data-view="informe" aria-label="[Enlace: Informe académico]" title="[Enlace: Informe académico]" class="nav-link w-full min-h-[44px] px-2.5 py-1.5 rounded-md text-slate-700 hover:bg-slate-50 font-medium text-[13px] flex items-center gap-2.5 text-left">
                                <i class="ph ph-file-text text-base shrink-0" aria-hidden="true"></i>
                                <span class="nav-label">[Informe académico]</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="selectNav(this, '[Metas y logros]', 'logros')" data-view="logros" aria-label="[Enlace: Metas, logros e indicadores]" title="[Enlace: Metas, logros e indicadores]" class="nav-link w-full min-h-[44px] px-2.5 py-1.5 rounded-md text-slate-700 hover:bg-slate-50 font-medium text-[13px] flex items-center gap-2.5 text-left">
                                <i class="ph ph-trophy text-base shrink-0" aria-hidden="true"></i>
                                <span class="nav-label">[Metas y logros]</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Grupo 3: Administrativo -->
                <div class="sidebar-group">
                    <button type="button" onclick="toggleSidebarGroup(this)" aria-expanded="true" aria-controls="grupo-servicios" class="sidebar-group-toggle w-full min-h-[36px] px-2 flex items-center justify-between gap-2 rounded-md text-slate-500 hover:text-slate-800">
                        <span class="sidebar-group-title text-[11px] font-bold uppercase tracking-wider">[Servicios y pagos]</span>
                        <i class="ph ph-caret-down sidebar-caret text-xs transition-transform" aria-hidden="true"></i>
                    </button>
                    <ul id="grupo-servicios" class="sidebar-group-list space-y-0.5 mt-0.5">
                        <li>
                            <button onclick="selectNav(this, '[Cuenta y pagos]', 'estado-cuenta')" data-view="estado-cuenta" aria-label="[Enlace: Cuenta y pagos]" title="[Enlace: Cuenta y pagos]" class="nav-link w-full min-h-[44px] px-2.5 py-1.5 rounded-md text-slate-700 hover:bg-slate-50 font-medium text-[13px] flex items-center gap-2.5 text-left">
                                <i class="ph ph-credit-card text-base shrink-0" aria-hidden="true"></i>
                                <span class="nav-label">[Cuenta y pagos]</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Pie de navegación: acción secundaria -->
            <div class="px-3 py-3 border-t border-slate-200">
                <button onclick="announceFeedback('[Acción secundaria: Cerrar sesión del usuario]')" aria-label="[Cerrar sesión]" title="[Cerrar sesión]" class="sidebar-logout w-full min-h-[44px] px-3 py-2 rounded-md text-slate-700 hover:bg-slate-50 text-[13px] font-medium flex items-center justify-center gap-2 transition">
                    <i class="ph ph-sign-out text-base shrink-0" aria-hidden="true"></i>
                    <span class="nav-label">[Cerrar sesión]</span>
                </button>
            </div>
        </aside>

        <!-- ÁREA PRINCIPAL -->
        <div class="flex-1 flex flex-col min-w-0 w-full">

            <!-- ENCABEZADO SUPERIOR -->
            <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-4 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <button onclick="toggleMobileNav()" id="mobileNavToggle" aria-expanded="false" aria-controls="sidebarNav" aria-label="Abrir menú de navegación" class="lg:hidden min-w-[44px] min-h-[44px] flex items-center justify-center rounded-lg border border-slate-300 text-slate-800 hover:bg-slate-100">
                        <i class="ph ph-list text-xl" aria-hidden="true"></i>
                    </button>
                    <div>
                        <h1 id="headerTitle" class="text-lg sm:text-xl font-bold text-slate-900">
                            Inicio
                        </h1>
                        <p id="headerSubtitle" class="text-sm text-slate-600">
                            Periodo académico [AAAA] · [Sede educativa]
                        </p>
                    </div>
                </div>

                <!-- Contenedor de Sesión de Usuario -->
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 px-1 text-sm text-slate-600">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600" aria-hidden="true"></span>
                        <span id="roleChipText">[Rol: Estudiante]</span>
                    </div>
                    <button onclick="announceFeedback('[Desplegar opciones de cuenta]')" aria-label="Opciones de perfil de usuario" class="min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 flex items-center gap-2 text-sm font-medium text-slate-800">
                        <span class="w-7 h-7 rounded-full bg-slate-200 border border-slate-400 flex items-center justify-center text-xs font-mono">[Img]</span>
                        <span class="hidden md:inline">[Nombre del estudiante]</span>
                        <i class="ph ph-caret-down text-base" aria-hidden="true"></i>
                    </button>
                </div>
            </header>

            <!-- CONTENIDO PRINCIPAL (Cuadrícula consistente de 12 columnas, espaciado 24px / 32px) -->
            <main id="mainContent" class="flex-1 bg-white p-4 sm:p-6 lg:p-8 max-w-[1600px] w-full mx-auto overflow-x-hidden">

                <!-- ============================================================
                     VISTA: INICIO
                     ============================================================ -->
                <div id="view-inicio" class="space-y-8">

                <!-- ESTADO DE ERROR GLOBAL (Oculto por defecto, visible en modo Error) -->
                <div id="state-error-banner" role="alert" class="hidden border-l-4 border-red-600 bg-red-50 px-5 py-5 text-red-900 space-y-3">
                    <div class="flex items-start gap-3">
                        <i class="ph-fill ph-warning-circle text-2xl text-red-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                        <div class="space-y-1">
                            <h2 class="font-bold text-base">[Título de error: No se pudo cargar la información]</h2>
                            <p class="text-sm text-red-800">[Descripción clara del problema y cómo corregirlo: Ej. Verifica tu conexión a internet e intenta recargar los datos.]</p>
                        </div>
                    </div>
                    <div class="pl-9">
                        <button onclick="setSystemState('normal')" class="min-h-[44px] px-4 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white font-semibold text-sm inline-flex items-center gap-2">
                            <i class="ph ph-arrow-clockwise text-lg" aria-hidden="true"></i>
                            <span>[Reintentar carga]</span>
                        </button>
                    </div>
                </div>

                <!-- ESTADO DE CARGA (Skeleton Wireframe - Visible en modo Carga) -->
                <div id="state-loading-view" aria-busy="true" aria-label="Cargando contenido" class="hidden space-y-8">
                    <div class="py-3 text-sm text-slate-600 flex items-center gap-3">
                        <i class="ph ph-spinner animate-spin text-xl text-accent-600" aria-hidden="true"></i>
                        <span>[Mensaje de estado: Cargando información del estudiante...]</span>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 py-4">
                        <div class="lg:col-span-8 space-y-4">
                            <div class="h-7 w-56 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-56 rounded bg-slate-100 animate-pulse"></div>
                        </div>
                        <div class="lg:col-span-4 space-y-4">
                            <div class="h-7 w-40 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-56 rounded bg-slate-100 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- VISTA NORMAL (Jerarquía clara: Ficha + Acción Principal Carnet + Listado) -->
                <div id="state-normal-view" class="space-y-0">

                    <!-- Identidad y carnet -->
                    <section aria-labelledby="heading-student-info" class="py-8 border-b border-slate-200">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                            <div class="lg:col-span-8 space-y-6">
                                <div class="flex flex-wrap items-start justify-between gap-4">
                                    <div>
                                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Estudiante</p>
                                        <h2 id="heading-student-info" class="text-xl font-bold text-slate-900 mt-0.5">
                                            [Encabezado: Información del estudiante]
                                        </h2>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600" aria-hidden="true"></span>
                                        [Estado: Activo]
                                    </span>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                    <div class="w-16 h-16 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] font-mono text-slate-600 shrink-0">
                                        [Foto]
                                    </div>
                                    <div class="space-y-0.5">
                                        <p class="text-lg font-bold text-slate-900">[Nombre completo del estudiante]</p>
                                        <p class="text-sm text-slate-600">[Nombre de la sede educativa]</p>
                                    </div>
                                </div>

                                <dl class="grid grid-cols-1 sm:grid-cols-3 gap-x-8 gap-y-5">
                                    <div class="border-t border-slate-200 pt-3">
                                        <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">[Etiqueta: Código]</dt>
                                        <dd class="mt-1 text-base font-bold text-slate-900">[Número de código]</dd>
                                    </div>
                                    <div class="border-t border-slate-200 pt-3">
                                        <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">[Etiqueta: Grado]</dt>
                                        <dd class="mt-1 text-base font-bold text-slate-900">[Grado y grupo]</dd>
                                    </div>
                                    <div class="border-t border-slate-200 pt-3">
                                        <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">[Etiqueta: Jornada]</dt>
                                        <dd class="mt-1 text-base font-bold text-slate-900">[Tipo de jornada]</dd>
                                    </div>
                                </dl>

                                <div>
                                    <button onclick="announceFeedback('[Navegando a editar datos de contacto]')" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                        [Actualizar datos de contacto]
                                    </button>
                                </div>
                            </div>

                            <div class="lg:col-span-4 border-t lg:border-t-0 lg:border-l border-slate-200 pt-6 lg:pt-0 lg:pl-8 space-y-5">
                                <h2 id="heading-id-card" class="text-xl font-bold text-slate-900">
                                    [Encabezado: Carnet virtual]
                                </h2>

                                <div class="w-40 h-40 rounded-lg border border-dashed border-slate-400 flex flex-col items-center justify-center p-4 text-center">
                                    <span class="text-xs font-mono text-slate-600">[Código QR de identificación]</span>
                                </div>
                                <p class="text-sm text-slate-600">
                                    [Instrucción breve: Presentar código para ingreso institucional]
                                </p>

                                <button onclick="openModal()" class="w-full min-h-[48px] px-5 py-3 rounded-lg bg-accent-700 hover:bg-accent-800 text-white font-semibold text-sm flex items-center justify-center gap-2 transition">
                                    <i class="ph ph-identification-card text-lg" aria-hidden="true"></i>
                                    <span>[Abrir carnet virtual]</span>
                                </button>
                            </div>
                        </div>
                    </section>

                    <!-- Actividad reciente -->
                    <section aria-labelledby="heading-recent-activity" class="py-8">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-5">
                            <div>
                                <h2 id="heading-recent-activity" class="text-xl font-bold text-slate-900">
                                    [Encabezado: Actividad académica reciente]
                                </h2>
                                <p class="text-sm text-slate-600 mt-0.5">
                                    [Descripción: Últimas tareas y comunicados asignados]
                                </p>
                            </div>

                            <div class="w-full md:w-64">
                                <label for="filterSelect" class="block text-xs font-semibold text-slate-700 mb-1">
                                    [Etiqueta: Filtrar por tipo]
                                </label>
                                <select id="filterSelect" onchange="handleFilterChange(this.value)" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                    <option value="all">[Opción: Todos los registros]</option>
                                    <option value="tasks">[Opción: Solo tareas]</option>
                                    <option value="empty">[Simular filtro sin resultados]</option>
                                </select>
                            </div>
                        </div>

                        <div id="activity-list-container" class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-y border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500 bg-slate-50/60">
                                        <th scope="col" class="py-3 px-3">[Columna: Fecha]</th>
                                        <th scope="col" class="py-3 px-3">[Columna: Área / Módulo]</th>
                                        <th scope="col" class="py-3 px-3">[Columna: Descripción]</th>
                                        <th scope="col" class="py-3 px-3">[Columna: Estado]</th>
                                        <th scope="col" class="py-3 px-3 text-right">[Columna: Acción]</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="py-3 px-3 font-mono text-slate-700 whitespace-nowrap">[DD/MM/AAAA]</td>
                                        <td class="py-3 px-3 font-semibold text-slate-900">[Nombre de asignatura]</td>
                                        <td class="py-3 px-3 text-slate-600">[Título o resumen breve de la actividad]</td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500" aria-hidden="true"></span>
                                                [Estado: Pendiente]
                                            </span>
                                        </td>
                                        <td class="py-3 px-3 text-right whitespace-nowrap">
                                            <button onclick="announceFeedback('[Abriendo detalle de actividad]')" class="min-h-[44px] px-1 text-xs font-semibold text-accent-700 hover:underline">
                                                [Ver detalle]
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="py-3 px-3 font-mono text-slate-700 whitespace-nowrap">[DD/MM/AAAA]</td>
                                        <td class="py-3 px-3 font-semibold text-slate-900">[Tipo de comunicado]</td>
                                        <td class="py-3 px-3 text-slate-600">[Asunto del comunicado institucional]</td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600" aria-hidden="true"></span>
                                                [Estado: Completado]
                                            </span>
                                        </td>
                                        <td class="py-3 px-3 text-right whitespace-nowrap">
                                            <button onclick="announceFeedback('[Abriendo comunicado]')" class="min-h-[44px] px-1 text-xs font-semibold text-accent-700 hover:underline">
                                                [Ver detalle]
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- ESTADO VACÍO -->
                        <div id="activity-empty-state" class="hidden py-10 text-center space-y-4">
                            <div class="max-w-md mx-auto space-y-1">
                                <h3 class="text-base font-bold text-slate-900">[Estado vacío: No hay actividades registradas]</h3>
                                <p class="text-sm text-slate-600">[Texto guía: Cuando tus docentes publiquen tareas o circulares, aparecerán en esta sección.]</p>
                            </div>
                            <div>
                                <button onclick="resetFilters()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                    [Restablecer filtros]
                                </button>
                            </div>
                        </div>
                    </section>
                </div>
                </div>
                <!-- /VISTA: INICIO -->

                <!-- ============================================================
                     VISTA: INFORMACIÓN DEL ALUMNO (apartado del padre)
                     Dos contenedores: escolar (angosto) + alumno (ancho)
                     ============================================================ -->
                <div id="view-alumno" class="hidden space-y-8">

                    <!-- ESTADO DE ERROR -->
                    <div id="info-error-banner" role="alert" class="hidden border-l-4 border-red-600 bg-red-50 px-5 py-5 text-red-900 space-y-3">
                        <div class="flex items-start gap-3">
                            <i class="ph-fill ph-warning-circle text-2xl text-red-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                            <div class="space-y-1">
                                <h2 class="font-bold text-base">No se pudo cargar la información del alumno</h2>
                                <p class="text-sm text-red-800">Revisa tu conexión a internet e intenta nuevamente. Si el problema continúa, comunícate con la secretaría académica del colegio.</p>
                            </div>
                        </div>
                        <div class="pl-9">
                            <button onclick="retryInfoLoad()" class="min-h-[44px] px-4 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white font-semibold text-sm inline-flex items-center gap-2">
                                <i class="ph ph-arrow-clockwise text-lg" aria-hidden="true"></i>
                                <span>Reintentar carga</span>
                            </button>
                        </div>
                    </div>

                    <!-- ESTADO DE CARGA -->
                    <div id="info-loading-view" aria-busy="true" aria-label="Cargando información del alumno" class="hidden space-y-6">
                        <div class="py-3 text-sm text-slate-600 flex items-center gap-3">
                            <i class="ph ph-spinner animate-spin text-xl text-accent-600" aria-hidden="true"></i>
                            <span>Cargando información escolar y familiar del estudiante...</span>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                            <!-- Esqueleto columna escolar -->
                            <div class="lg:col-span-4 space-y-4">
                                <div class="h-6 w-2/3 rounded bg-slate-100 animate-pulse"></div>
                                <div class="h-20 rounded bg-slate-100 animate-pulse"></div>
                                <div class="space-y-2">
                                    <div class="h-4 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-4 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-4 w-5/6 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-4 w-4/6 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-4 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-4 w-3/4 rounded bg-slate-100 animate-pulse"></div>
                                </div>
                            </div>
                            <!-- Esqueleto columna alumno -->
                            <div class="lg:col-span-8 space-y-6">
                                <div class="h-6 w-1/2 rounded bg-slate-100 animate-pulse"></div>
                                <div class="flex gap-2">
                                    <div class="h-10 w-32 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-10 w-24 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-10 w-24 rounded bg-slate-100 animate-pulse"></div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                    <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                                    <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- VISTA NORMAL -->
                    <div id="info-normal-view" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                        <!-- COLUMNA ESCOLAR (4 columnas) -->
                        <section aria-labelledby="heading-school-info" class="lg:col-span-4 space-y-6 lg:border-r lg:border-slate-200 lg:pr-8">

                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <h2 id="heading-school-info" class="text-xl font-bold text-slate-900">
                                    Información escolar
                                </h2>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-800 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600" aria-hidden="true"></span>
                                    Matriculado
                                </span>
                            </div>

                            <!-- Identidad compacta -->
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] font-mono text-slate-600 shrink-0">
                                    [Foto]
                                </div>
                                <div class="min-w-0 space-y-0.5">
                                    <p class="font-bold text-slate-900 leading-snug">[Nombre completo del estudiante]</p>
                                    <p class="text-sm text-slate-600">[Grado y grupo] · [Aula]</p>
                                </div>
                            </div>

                            <!-- Datos escolares -->
                            <dl class="divide-y divide-slate-100">
                                <div class="flex items-center justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600">Código</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right font-mono">[Código]</dd>
                                </div>
                                <div class="flex items-center justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600">Grado</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right">[Grado]</dd>
                                </div>
                                <div class="flex items-center justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600">Aula</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right">[Aula]</dd>
                                </div>
                                <div class="flex items-center justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600">Ruta</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right">[Ruta · Zona]</dd>
                                </div>
                                <div class="flex items-center justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600">Año de ingreso</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right">[AAAA]</dd>
                                </div>
                                <div class="flex items-center justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600">Estado inicial</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right">[Estado]</dd>
                                </div>
                                <div class="flex items-center justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600">Fecha de matrícula</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right font-mono">[DD/MM/AAAA]</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4 py-2.5">
                                    <dt class="text-sm text-slate-600 shrink-0">Colegio procede</dt>
                                    <dd class="text-sm font-semibold text-slate-900 text-right break-words">[Institución de procedencia]</dd>
                                </div>
                            </dl>

                            <!-- Observaciones plegables -->
                            <details class="group border-t border-slate-200 pt-3">
                                <summary class="min-h-[44px] cursor-pointer text-sm font-semibold text-slate-800 flex items-center justify-between gap-2">
                                    <span>Observaciones</span>
                                    <i class="ph ph-caret-down text-base transition group-open:rotate-180" aria-hidden="true"></i>
                                </summary>
                                <div class="pt-2 space-y-3 text-sm text-slate-600">
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Matrícula</p>
                                        <p class="mt-0.5">[Observaciones de la matrícula]</p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Generales</p>
                                        <p class="mt-0.5">[Observaciones generales del estudiante]</p>
                                    </div>
                                </div>
                            </details>

                            <button onclick="announceFeedback('[Corrección de datos escolares solicitada]')" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline text-left">
                                Solicitar corrección de datos
                            </button>
                        </section>

                        <!-- COLUMNA ALUMNO (8 columnas) -->
                        <section aria-label="Información del alumno" class="lg:col-span-8 space-y-6">

                            <!-- Pestañas: Estudiante / Mamá / Papá -->
                            <div id="infoTabs" role="tablist" aria-label="Información del alumno" class="flex border-b border-slate-200">
                                <button type="button" id="tab-estudiante" role="tab" aria-selected="true" aria-controls="panel-estudiante" tabindex="0" onclick="selectInfoTab('estudiante')" class="flex-1 sm:flex-none justify-center min-h-[44px] px-3 sm:px-4 text-sm font-semibold text-accent-700 border-b-2 border-accent-600 -mb-px transition">
                                    <span>Estudiante</span>
                                </button>
                                <button type="button" id="tab-mama" role="tab" aria-selected="false" aria-controls="panel-mama" tabindex="-1" onclick="selectInfoTab('mama')" class="flex-1 sm:flex-none justify-center min-h-[44px] px-3 sm:px-4 text-sm font-medium text-slate-600 border-b-2 border-transparent hover:text-slate-900 -mb-px transition">
                                    <span>Mamá</span>
                                </button>
                                <button type="button" id="tab-papa" role="tab" aria-selected="false" aria-controls="panel-papa" tabindex="-1" onclick="selectInfoTab('papa')" class="flex-1 sm:flex-none justify-center min-h-[44px] px-3 sm:px-4 text-sm font-medium text-slate-600 border-b-2 border-transparent hover:text-slate-900 -mb-px transition">
                                    <span>Papá</span>
                                </button>
                            </div>

                            <p class="text-xs text-slate-500">Datos suministrados en matrícula</p>

                            <!-- Panel: Datos del estudiante -->
                            <div id="panel-estudiante" role="tabpanel" aria-labelledby="tab-estudiante" class="space-y-6">
                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Identidad</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Nombre completo</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Nombre completo del estudiante]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Tipo de documento</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Tipo de documento]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Número de identidad</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono break-words">[Número de identidad]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Fecha de nacimiento</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[DD/MM/AAAA]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Sexo</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900">[Sexo]</dd>
                                        </div>
                                    </dl>
                                </section>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Contacto</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Teléfono de residencia</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[Teléfono]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Número de celular</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[Celular]</dd>
                                        </div>
                                    </dl>
                                </section>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Información relacionada al colegio</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Fecha de ingreso</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[DD/MM/AAAA]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Número de hermanos(as)</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900">[Número]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Hermanos(as) en el colegio</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900">[Número]</dd>
                                        </div>
                                    </dl>
                                </section>
                            </div>

                            <!-- Panel: Datos de la mamá -->
                            <div id="panel-mama" role="tabpanel" aria-labelledby="tab-mama" class="hidden space-y-6">
                                <div class="flex flex-wrap items-center gap-3 py-3 border-t border-slate-200">
                                    <div class="w-11 h-11 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center text-[10px] font-mono text-slate-600 shrink-0">[Foto]</div>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-bold text-slate-900 truncate">[Nombre completo de la mamá]</p>
                                        <p class="text-xs text-slate-600">Mamá · [Ocupación actual]</p>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-accent-700 whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-accent-600" aria-hidden="true"></span>
                                        <span>Acudiente principal</span>
                                    </span>
                                </div>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Identidad</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Nombres</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Nombres de la mamá]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Apellidos</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Apellidos de la mamá]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Tipo de documento</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900">[Tipo de documento]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Número de identidad</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono break-words">[Número de identidad]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Fecha de nacimiento</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[DD/MM/AAAA]</dd>
                                        </div>
                                    </dl>
                                </section>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Contacto</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Teléfono de residencia</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[Teléfono]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Número de celular</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[Celular]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Correo</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-all">[correo@ejemplo.com]</dd>
                                        </div>
                                    </dl>
                                </section>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Información laboral</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Profesión</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Profesión]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Empresa</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Empresa donde labora]</dd>
                                        </div>
                                    </dl>
                                </section>
                            </div>

                            <!-- Panel: Datos del papá -->
                            <div id="panel-papa" role="tabpanel" aria-labelledby="tab-papa" class="hidden space-y-6">
                                <div class="flex flex-wrap items-center gap-3 py-3 border-t border-slate-200">
                                    <div class="w-11 h-11 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center text-[10px] font-mono text-slate-600 shrink-0">[Foto]</div>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-bold text-slate-900 truncate">[Nombre completo del papá]</p>
                                        <p class="text-xs text-slate-600">Papá · [Ocupación actual]</p>
                                    </div>
                                </div>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Identidad</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Nombres</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Nombres del papá]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Apellidos</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Apellidos del papá]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Tipo de documento</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900">[Tipo de documento]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Número de identidad</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono break-words">[Número de identidad]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Fecha de nacimiento</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[DD/MM/AAAA]</dd>
                                        </div>
                                    </dl>
                                </section>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Contacto</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Teléfono de residencia</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[Teléfono]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Número de celular</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 font-mono">[Celular]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Correo</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-all">[correo@ejemplo.com]</dd>
                                        </div>
                                    </dl>
                                </section>

                                <section class="space-y-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Información laboral</h3>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Profesión</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Profesión]</dd>
                                        </div>
                                        <div class="border-t border-slate-200 pt-3">
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Empresa</dt>
                                            <dd class="mt-1 text-sm font-semibold text-slate-900 break-words">[Empresa donde labora]</dd>
                                        </div>
                                    </dl>
                                </section>
                            </div>

                            <!-- ESTADO VACÍO (información del familiar no registrada) -->
                            <div id="info-empty-state" class="hidden py-10 text-center space-y-4">
                                <div class="max-w-md mx-auto space-y-1">
                                    <h3 id="info-empty-title" class="text-base font-bold text-slate-900">Sin información registrada</h3>
                                    <p id="info-empty-text" class="text-sm text-slate-600">No hay datos del familiar seleccionado.</p>
                                </div>
                                <div>
                                    <button onclick="announceFeedback('[Solicitud de actualización de datos enviada]')" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                        Solicitar actualización de datos
                                    </button>
                                </div>
                            </div>

                            <p class="text-xs text-slate-500 border-t border-slate-200 pt-4">
                                Última actualización: [DD/MM/AAAA] · Fuente: [Sistema académico]
                            </p>
                        </section>
                    </div>
                </div>
                <!-- /VISTA: INFORMACIÓN DEL ALUMNO -->

                <!-- ============================================================
                     VISTA: CONSULTA DE TAREAS
                     Tabla con filtros desplegables y paginado de 15 registros
                     ============================================================ -->
                <div id="view-tareas" class="hidden space-y-0">

                    <!-- ESTADO DE ERROR -->
                    <div id="tareas-error-banner" role="alert" class="hidden border-l-4 border-red-600 bg-red-50 px-5 py-5 text-red-900 space-y-3">
                        <div class="flex items-start gap-3">
                            <i class="ph-fill ph-warning-circle text-2xl text-red-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                            <div class="space-y-1">
                                <h2 class="font-bold text-base">No se pudieron cargar las tareas</h2>
                                <p class="text-sm text-red-800">Revisa tu conexión a internet e intenta nuevamente. Si el problema continúa, comunícate con la secretaría académica del colegio.</p>
                            </div>
                        </div>
                        <div class="pl-9">
                            <button onclick="retryTareasLoad()" class="min-h-[44px] px-4 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white font-semibold text-sm inline-flex items-center gap-2">
                                <i class="ph ph-arrow-clockwise text-lg" aria-hidden="true"></i>
                                <span>Reintentar carga</span>
                            </button>
                        </div>
                    </div>

                    <!-- FILTROS (siempre visibles) -->
                    <section aria-label="Filtros de tareas" class="py-6 border-b border-slate-200 space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <p class="text-sm text-slate-600">
                                <span id="tareas-contador" class="font-semibold text-slate-900">42</span> tareas encontradas
                            </p>
                            <button onclick="limpiarFiltrosTareas()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                Limpiar filtros
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="filtroAsignatura" class="block text-xs font-semibold text-slate-700 mb-1">Asignatura</label>
                                <select id="filtroAsignatura" onchange="cambiarFiltroTareas()" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                    <option value="all">Todas las asignaturas</option>
                                    <option value="Matemáticas">Matemáticas</option>
                                    <option value="Español">Español</option>
                                    <option value="Ciencias Naturales">Ciencias Naturales</option>
                                    <option value="Ciencias Sociales">Ciencias Sociales</option>
                                    <option value="Inglés">Inglés</option>
                                    <option value="Informática">Informática</option>
                                    <option value="Educación Física">Educación Física</option>
                                    <option value="Artes">Artes</option>
                                </select>
                            </div>
                            <div>
                                <label for="filtroFecha" class="block text-xs font-semibold text-slate-700 mb-1">Fecha</label>
                                <select id="filtroFecha" onchange="cambiarFiltroTareas()" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                    <option value="all">Todas las fechas</option>
                                    <option value="hoy">Hoy</option>
                                    <option value="7dias">Últimos 7 días</option>
                                    <option value="mes">Este mes</option>
                                    <option value="mesAnterior">Mes anterior</option>
                                </select>
                            </div>
                            <div>
                                <label for="filtroTipo" class="block text-xs font-semibold text-slate-700 mb-1">Tipo</label>
                                <select id="filtroTipo" onchange="cambiarFiltroTareas()" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                    <option value="all">Todos los tipos</option>
                                    <option value="TAREA">Tarea</option>
                                    <option value="GUIA-M.TRABAJO">Guía-M. Trabajo</option>
                                    <option value="RECUPERACION">Recuperación</option>
                                    <option value="REQUERIMIEN_OBS">Requerimien_Obs</option>
                                </select>
                            </div>
                        </div>

                        <p id="tareas-filtros-activos" class="text-xs text-slate-500">
                            Sin filtros activos: se muestran todas las tareas.
                        </p>
                    </section>

                    <!-- ESTADO DE CARGA -->
                    <div id="tareas-loading-view" aria-busy="true" aria-label="Cargando tareas" class="hidden py-8 space-y-4">
                        <div class="h-5 w-44 rounded bg-slate-200 animate-pulse"></div>
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                            <i class="ph ph-spinner animate-spin text-lg text-accent-600" aria-hidden="true"></i>
                            <span>Cargando tareas del periodo...</span>
                        </div>
                        <div class="space-y-3 overflow-hidden">
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                        </div>
                    </div>

                    <!-- VISTA NORMAL -->
                    <div id="tareas-normal-view" class="space-y-0">

                        <!-- Región desplazable: cabecera y primera columna fijas -->
                        <div id="tareas-tabla-scroll" role="region" aria-label="Listado de tareas" tabindex="0" class="overflow-auto overscroll-contain lg:max-h-[calc(100vh-23rem)] [scrollbar-gutter:stable] focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-600 focus-visible:ring-inset">
                            <table class="w-full min-w-[920px] text-left border-collapse">
                                <caption class="sr-only">Listado de tareas con fecha de apertura, tipo, materia, título, descripción y fecha de entrega.</caption>
                                <thead class="sticky top-0 z-20 bg-slate-50 border-y border-slate-200">
                                    <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        <th scope="col" class="sticky left-0 z-30 bg-slate-50 w-[112px] py-3 pl-3 pr-2 whitespace-nowrap shadow-[1px_0_0_0_#e2e8f0]">F. apertura</th>
                                        <th scope="col" class="w-[150px] px-3 py-3 whitespace-nowrap">Tipo</th>
                                        <th scope="col" class="w-[150px] px-3 py-3">Materia</th>
                                        <th scope="col" class="w-[210px] px-3 py-3">Título</th>
                                        <th scope="col" class="px-3 py-3">Descripción</th>
                                        <th scope="col" class="w-[112px] px-3 py-3 text-right whitespace-nowrap">F. entrega</th>
                                    </tr>
                                </thead>
                                <tbody id="tareas-tbody" class="divide-y divide-slate-100 text-sm"></tbody>
                            </table>
                        </div>

                        <!-- ESTADO VACÍO (sin registros o sin resultados por filtros) -->
                        <div id="tareas-empty-state" class="hidden py-10 text-center space-y-4">
                            <div class="max-w-md mx-auto space-y-1">
                                <h3 id="tareas-empty-title" class="text-base font-bold text-slate-900">No hay tareas registradas</h3>
                                <p id="tareas-empty-text" class="text-sm text-slate-600">Cuando tus docentes publiquen tareas, guías o recuperaciones, aparecerán en esta sección.</p>
                            </div>
                            <div>
                                <button onclick="limpiarFiltrosTareas()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                    Limpiar filtros
                                </button>
                            </div>
                        </div>

                        <!-- PAGINADO (fijo, fuera del scroll) -->
                        <div id="tareas-paginacion-barra" class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 py-3">
                            <p class="text-sm text-slate-600">
                                Mostrando <span id="tareas-rango" class="font-semibold text-slate-900">1–15</span> de
                                <span id="tareas-total" class="font-semibold text-slate-900">42</span>
                            </p>
                            <nav id="tareas-paginacion" aria-label="Paginación de tareas" class="flex flex-wrap items-center gap-1"></nav>
                        </div>
                    </div>
                </div>
                <!-- /VISTA: CONSULTA DE TAREAS -->

                <!-- ============================================================
                     VISTA: INFORME ACADÉMICO
                     Bloqueo por firmas del observador + estado académico
                     ============================================================ -->
                <div id="view-informe" class="hidden space-y-0">

                    <!-- ESTADO DE ERROR -->
                    <div id="informe-error-banner" role="alert" class="hidden border-l-4 border-red-600 bg-red-50 px-5 py-5 text-red-900 space-y-3">
                        <div class="flex items-start gap-3">
                            <i class="ph-fill ph-warning-circle text-2xl text-red-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                            <div class="space-y-1">
                                <h2 class="font-bold text-base">No se pudo cargar el informe académico</h2>
                                <p class="text-sm text-red-800">Revisa tu conexión a internet e intenta nuevamente. Si el problema continúa, comunícate con la secretaría académica del colegio.</p>
                            </div>
                        </div>
                        <div class="pl-9">
                            <button onclick="retryInformeLoad()" class="min-h-[44px] px-4 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white font-semibold text-sm inline-flex items-center gap-2">
                                <i class="ph ph-arrow-clockwise text-lg" aria-hidden="true"></i>
                                <span>Reintentar carga</span>
                            </button>
                        </div>
                    </div>

                    <!-- ESTADO DE CARGA -->
                    <div id="informe-loading-view" aria-busy="true" aria-label="Cargando informe académico" class="hidden space-y-6">
                        <div class="py-3 space-y-4">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i class="ph ph-spinner animate-spin text-xl text-accent-600" aria-hidden="true"></i>
                                <span>Cargando firmas y estado académico...</span>
                            </div>
                            <div class="h-24 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                        </div>
                        <div class="pt-4 space-y-3">
                            <div class="h-6 w-48 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                            <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                        </div>
                    </div>

                    <!-- VISTA NORMAL -->
                    <div id="informe-normal-view" class="space-y-0">

                        <!-- Banner: firmas al día -->
                        <div id="informe-firmas-ok" tabindex="-1" class="hidden border-l-4 border-emerald-600 bg-emerald-50 px-5 sm:px-6 py-4 text-emerald-950">
                            <div class="flex items-start gap-3">
                                <i class="ph-fill ph-check-circle text-2xl text-emerald-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                                <div class="space-y-1">
                                    <h2 class="font-bold text-base">Firmas al día</h2>
                                    <p class="text-sm text-emerald-900">Oficializaste la firma de todas las anotaciones académicas y de convivencia. Ya puedes consultar tu estado académico.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bloqueo por firmas pendientes -->
                        <section id="informe-gate-pendiente" aria-labelledby="heading-informe-gate" class="border-l-4 border-amber-500 bg-amber-50 px-5 sm:px-6 py-6 space-y-5">
                            <div class="flex items-start gap-3">
                                <i class="ph-fill ph-seal-warning text-2xl text-amber-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                                <div class="min-w-0 flex-1 space-y-1">
                                    <h2 id="heading-informe-gate" tabindex="-1" class="text-lg font-bold text-amber-950">Firma pendiente para consultar el estado académico</h2>
                                    <p class="text-sm text-amber-900">Debes oficializar la firma de todas las anotaciones académicas y de convivencia para poder consultar tu estado académico.</p>
                                </div>
                                <div class="hidden sm:block text-right shrink-0">
                                    <p id="informe-pendientes-total" class="text-3xl font-bold text-amber-900 leading-none">3</p>
                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-amber-800">sin firma</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs font-semibold text-amber-900">
                                <span><span id="informe-count-academicas">2</span> académicas</span>
                                <span class="text-amber-400" aria-hidden="true">·</span>
                                <span><span id="informe-count-convivencia">1</span> de convivencia</span>
                                <span class="text-amber-400" aria-hidden="true">·</span>
                                <span>Periodo [AAAA]</span>
                            </div>

                            <details class="group border-t border-amber-200 pt-2">
                                <summary class="min-h-[44px] cursor-pointer flex items-center justify-between gap-2 text-sm font-semibold text-amber-950">
                                    <span>Ver las <span id="informe-pendientes-total-2">3</span> anotaciones pendientes</span>
                                    <i class="ph ph-caret-down text-base transition group-open:rotate-180" aria-hidden="true"></i>
                                </summary>
                                <ul id="informe-lista-anotaciones" class="divide-y divide-amber-200"></ul>
                            </details>

                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <p class="text-xs text-amber-800">
                                    La firma registra fecha, hora y dirección IP, igual que en el observador del alumno.
                                </p>
                                <button onclick="restablecerDemoFirmas()" class="min-h-[44px] text-xs font-semibold text-amber-900 underline underline-offset-2 hover:text-amber-950">
                                    Restablecer demo
                                </button>
                            </div>
                        </section>

                        <!-- Estado académico -->
                        <section aria-labelledby="heading-estado-academico" class="py-8">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                                <div>
                                    <h2 id="heading-estado-academico" class="text-xl font-bold text-slate-900">Estado académico</h2>
                                    <p class="text-sm text-slate-600 mt-0.5">Sábana de notas por asignatura y periodo.</p>
                                </div>
                                <span id="informe-estado-chip" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-800">
                                    <span id="informe-estado-dot" class="w-1.5 h-1.5 rounded-full bg-amber-500" aria-hidden="true"></span>
                                    <span id="informe-estado-chip-text">Bloqueado</span>
                                </span>
                            </div>

                            <!-- Bloqueado -->
                            <div id="informe-estado-bloqueado" class="py-10 text-center space-y-4">
                                <div class="max-w-md mx-auto space-y-1">
                                    <h3 class="text-base font-bold text-slate-900">Contenido bloqueado</h3>
                                    <p class="text-sm text-slate-600">Firma las anotaciones pendientes para habilitar la consulta del estado académico.</p>
                                </div>
                                <button type="button" disabled aria-describedby="informe-bloqueo-ayuda" class="min-h-[44px] px-4 py-2 rounded-lg bg-slate-100 text-slate-400 font-semibold text-sm inline-flex items-center gap-2 cursor-not-allowed">
                                    <span>Consultar estado académico</span>
                                </button>
                                <p id="informe-bloqueo-ayuda" class="text-xs text-slate-500">Se habilita cuando el contador de firmas pendientes llegue a cero.</p>
                            </div>

                            <!-- Desbloqueado -->
                            <div id="informe-estado-contenido" class="hidden">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 py-5 border-y border-slate-200">
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Promedio general</p>
                                        <p class="mt-1 text-2xl font-bold text-slate-900" id="sabana-promedio">4.3</p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Asignaturas</p>
                                        <p class="mt-1 text-2xl font-bold text-slate-900" id="sabana-materias">8</p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">En desempeño básico</p>
                                        <p class="mt-1 text-2xl font-bold text-amber-700" id="sabana-basico">1</p>
                                    </div>
                                </div>

                                <div class="overflow-x-auto [scrollbar-gutter:stable]">
                                    <table class="w-full min-w-[760px] text-left border-collapse">
                                        <caption class="sr-only">Sábana de notas por asignatura con los periodos 1, 2, 3, promedio y desempeño.</caption>
                                        <thead class="bg-slate-50 border-y border-slate-200">
                                            <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                                <th scope="col" class="sticky left-0 z-10 bg-slate-50 w-[220px] py-3 pl-3 pr-2 shadow-[1px_0_0_0_#e2e8f0]">Asignatura</th>
                                                <th scope="col" class="w-[90px] px-3 py-3 text-center">P1</th>
                                                <th scope="col" class="w-[90px] px-3 py-3 text-center">P2</th>
                                                <th scope="col" class="w-[90px] px-3 py-3 text-center">P3</th>
                                                <th scope="col" class="w-[110px] px-3 py-3 text-center">Promedio</th>
                                                <th scope="col" class="w-[140px] px-3 py-3">Desempeño</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sabana-notas-tbody" class="divide-y divide-slate-100 text-sm"></tbody>
                                    </table>
                                </div>

                                <p class="text-xs text-slate-500 py-4">
                                    Última actualización: [DD/MM/AAAA] · Escala 1.0 a 5.0 · Fuente: [Sistema académico]
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /VISTA: INFORME ACADÉMICO -->

                <!-- ============================================================
                     VISTA: METAS, LOGROS, ACCIONES E INDICADORES
                     ============================================================ -->
                <div id="view-logros" class="hidden space-y-0">

                    <!-- ESTADO DE ERROR -->
                    <div id="logros-error-banner" role="alert" class="hidden border-l-4 border-red-600 bg-red-50 px-5 py-5 text-red-900 space-y-3">
                        <div class="flex items-start gap-3">
                            <i class="ph-fill ph-warning-circle text-2xl text-red-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                            <div class="space-y-1">
                                <h2 class="font-bold text-base">No se pudieron cargar los logros</h2>
                                <p class="text-sm text-red-800">Revisa tu conexión a internet e intenta nuevamente. Si el problema continúa, comunícate con la secretaría académica del colegio.</p>
                            </div>
                        </div>
                        <div class="pl-9">
                            <button onclick="retryLogrosLoad()" class="min-h-[44px] px-4 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white font-semibold text-sm inline-flex items-center gap-2">
                                <i class="ph ph-arrow-clockwise text-lg" aria-hidden="true"></i>
                                <span>Reintentar carga</span>
                            </button>
                        </div>
                    </div>

                    <!-- FILTROS -->
                    <section aria-label="Filtros de logros" class="py-6 border-b border-slate-200 space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <p class="text-sm text-slate-600"><span id="logros-total-contador" class="font-semibold text-slate-900">48</span> logros encontrados</p>
                            <button onclick="limpiarFiltrosLogros()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                Limpiar filtros
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="filtroLogroMateria" class="block text-xs font-semibold text-slate-700 mb-1">Asignatura</label>
                                <select id="filtroLogroMateria" onchange="cambiarFiltroLogros()" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                    <option value="all">Todas las asignaturas</option>
                                    <option value="Matemáticas">Matemáticas</option>
                                    <option value="Español">Español</option>
                                    <option value="Ciencias Naturales">Ciencias Naturales</option>
                                    <option value="Ciencias Sociales">Ciencias Sociales</option>
                                    <option value="Inglés">Inglés</option>
                                    <option value="Informática">Informática</option>
                                    <option value="Educación Física">Educación Física</option>
                                    <option value="Artes">Artes</option>
                                </select>
                            </div>
                            <div>
                                <label for="filtroLogroPeriodo" class="block text-xs font-semibold text-slate-700 mb-1">Periodo</label>
                                <select id="filtroLogroPeriodo" onchange="cambiarFiltroLogros()" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                    <option value="all">Todos los periodos</option>
                                    <option value="1">Periodo 1</option>
                                    <option value="2">Periodo 2</option>
                                    <option value="3">Periodo 3</option>
                                </select>
                            </div>
                            <div>
                                <label for="filtroLogroTexto" class="block text-xs font-semibold text-slate-700 mb-1">Buscar logro o indicador</label>
                                <div class="relative">
                                    <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400 pointer-events-none" aria-hidden="true"></i>
                                    <input id="filtroLogroTexto" type="search" oninput="cambiarFiltroLogros()" placeholder="Ej.: fracciones" class="w-full min-h-[44px] pl-9 pr-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                </div>
                            </div>
                        </div>

                        <p id="logros-filtros-activos" class="text-xs text-slate-500">Sin filtros activos: se muestran todos los logros.</p>
                    </section>

                    <!-- ESTADO DE CARGA -->
                    <div id="logros-loading-view" aria-busy="true" aria-label="Cargando logros" class="hidden py-8 space-y-3">
                        <div class="flex items-center gap-3 text-sm text-slate-600 mb-2">
                            <i class="ph ph-spinner animate-spin text-lg text-accent-600" aria-hidden="true"></i>
                            <span>Cargando logros del periodo...</span>
                        </div>
                        <div class="h-10 rounded bg-slate-100 animate-pulse"></div>
                        <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                        <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                        <div class="h-16 rounded bg-slate-100 animate-pulse"></div>
                    </div>

                    <!-- VISTA NORMAL -->
                    <div id="logros-normal-view" class="space-y-0">

                        <!-- CONTENIDO CON SCROLL ÚNICO (como en Consulta de tareas) -->
<div id="logros-contenido" class="py-6" style="max-height:560px;overflow-y:auto;">
    <div id="logros-listado" class="divide-y divide-slate-200">
        <!-- Items renderizados aquí -->
    </div>
</div>

<!-- PÁGINACION -->
<div id="logros-paginacion" class="py-4 border-t border-slate-200">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <p id="logros-contador" class="text-sm text-slate-600"></p>
        <div class="flex flex-wrap items-center gap-3">
            <span id="logros-pagina-info" class="text-sm text-slate-600"></span>
            <div id="logros-paginacion-botones" class="flex items-center gap-2"></div>
        </div>
    </div>
</div>
<!-- /Contenido de logros -->

                        <!-- ESTADO VACÍO -->
                        <div id="logros-empty-state" class="hidden py-10 text-center space-y-4">
                            <div class="max-w-md mx-auto space-y-1">
                                <h3 id="logros-empty-title" class="text-base font-bold text-slate-900">No hay logros para estos filtros</h3>
                                <p id="logros-empty-text" class="text-sm text-slate-600">Prueba con otra asignatura o periodo, o restablece los filtros para ver todos los logros.</p>
                            </div>
                            <div>
                                <button onclick="limpiarFiltrosLogros()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                    Limpiar filtros
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- /VISTA: METAS, LOGROS, ACCIONES E INDICADORES -->

                <!-- ============================================================
                     VISTA: ESTADO DE CUENTA
                     ============================================================ -->
                <div id="view-estado-cuenta" class="hidden space-y-0">

                    <!-- ESTADO DE ERROR -->
                    <div id="estadoCuenta-error-banner" role="alert" class="hidden border-l-4 border-red-600 bg-red-50 px-5 py-5 text-red-900 space-y-3">
                        <div class="flex items-start gap-3">
                            <i class="ph-fill ph-exclamation-circle text-2xl text-red-700 shrink-0 mt-0.5" aria-hidden="true"></i>
                            <div class="space-y-1">
                                <h2 class="font-bold text-base">No se pudo cargar la cuenta y los pagos</h2>
                                <p class="text-sm text-red-800">Revisa tu conexión a internet e intenta nuevamente. Si el problema continúa, comunícate con la secretaría académica del colegio.</p>
                            </div>
                        </div>
                        <div class="pl-9">
                            <button onclick="retryEstadoCuenta()" class="min-h-[44px] px-4 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white font-semibold text-sm inline-flex items-center gap-2">
                                <i class="ph ph-arrow-clockwise text-lg" aria-hidden="true"></i>
                                <span>Reintentar</span>
                            </button>
                        </div>
                    </div>

                    <!-- ESTADO DE CARGA -->
                    <div id="estadoCuenta-loading-view" aria-busy="true" aria-label="Cargando cuenta y pagos" class="space-y-8">
                        <div class="py-4 space-y-5">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i class="ph ph-spinner animate-spin text-xl text-accent-600" aria-hidden="true"></i>
                                <span>Cargando cuenta y pagos...</span>
                            </div>
                            <div class="h-10 w-56 rounded bg-slate-100 animate-pulse"></div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div class="h-20 rounded bg-slate-100 animate-pulse"></div>
                                <div class="h-20 rounded bg-slate-100 animate-pulse"></div>
                                <div class="h-20 rounded bg-slate-100 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- VISTA NORMAL -->
                    <div id="estadoCuenta-normal-view" class="space-y-4">

                        <!-- Pestañas -->
                        <div id="cuentaTabs" role="tablist" aria-label="Cuenta y pagos" class="flex border-b border-slate-200">
                            <button type="button" id="tab-cuenta-general" role="tab" aria-selected="true" aria-controls="panel-cuenta-general" tabindex="0" onclick="selectCuentaTab('general')" class="flex-1 sm:flex-none justify-center min-h-[44px] px-3 sm:px-4 text-sm font-semibold text-accent-700 border-b-2 border-accent-600 -mb-px transition">
                                <span>Estado de cuenta</span>
                            </button>
                            <button type="button" id="tab-cuenta-servicios" role="tab" aria-selected="false" aria-controls="panel-cuenta-servicios" tabindex="-1" onclick="selectCuentaTab('servicios')" class="flex-1 sm:flex-none justify-center min-h-[44px] px-3 sm:px-4 text-sm font-medium text-slate-600 border-b-2 border-transparent hover:text-slate-900 -mb-px transition">
                                <span>Restaurante y transporte</span>
                            </button>
                        </div>

                        <!-- Panel: Cuenta de estado (clave) -->
                        <div id="panel-cuenta-general" role="tabpanel" aria-labelledby="tab-cuenta-general" class="space-y-0">

                            <!-- ENCABECADO COMPACTO: saldo + estado -->
                            <div class="py-6 border-b border-slate-200">
                                <div class="flex flex-wrap items-end justify-between gap-4">
                                    <div class="space-y-1">
                                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Saldo a la fecha</p>
                                        <p class="text-3xl font-bold text-slate-900" data-cuenta-total="saldo">$0</p>
                                        <div class="flex flex-wrap items-center gap-2 pt-1">
                                            <span id="cuenta-estado-chip" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-800">
                                                <span id="cuenta-estado-icono" class="w-1.5 h-1.5 rounded-full bg-amber-500" aria-hidden="true"></span>
                                                <span id="cuenta-estado-texto">Pendiente de pago</span>
                                            </span>
                                            <span id="cuenta-vencimiento-texto" class="text-xs text-slate-500">Vence el [DD/MM/AAAA]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aviso informativo (visible al abrir la vista) -->
                            <div class="border-l-4 border-amber-400 bg-amber-50/60 px-4 py-3 mt-4">
                                <ul class="list-disc pl-4 space-y-1.5 text-xs text-amber-900">
                                    <li>Los datos publicados en esta página son únicamente de <strong>CARÁCTER INFORMATIVO</strong> y bajo ninguna circunstancia se pueden tomar como certificado. Este proceso debe emitirse directamente por el <strong>DEPARTAMENTO DE CARTERA</strong>.</li>
                                    <li>Recuerde que si hace un pago, éste se verá <strong>REFLEJADO 24 HORAS DESPUÉS DE SER REALIZADO</strong>.</li>
                                    <li>Si realiza el pago de los servicios educativos un día antes de la entrega de boletines, le pedimos el favor de <strong>LLEVAR EL RECIBO CON SELLO CANCELADO</strong> para que le sea entregado el boletín.</li>
                                </ul>
                            </div>

                            <!-- 1. MOVIMIENTOS (tabla principal) -->
                            <section aria-labelledby="heading-causaciones" class="py-6 border-b border-slate-200">
                                <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
                                    <div>
                                        <h2 id="heading-causaciones" class="text-base font-bold text-slate-900">Movimientos</h2>
                                        <p class="text-sm text-slate-600">Mes · tipo · descripción · valor · descuento · pagos · saldo.</p>
                                    </div>
                                    <p class="text-sm text-slate-600"><span id="cuenta-contador" class="font-semibold text-slate-900">0</span> de <span id="cuenta-contador-total" class="font-semibold text-slate-900">0</span> movimientos</p>
                                </div>

                                <!-- Filtros de la cuenta -->
                                <div class="mb-4 flex flex-col sm:flex-row sm:items-end gap-3">
                                    <div class="w-full sm:max-w-xs">
                                        <label for="filtroCuentaTexto" class="block text-xs font-semibold text-slate-700 mb-1">Buscar</label>
                                        <input id="filtroCuentaTexto" type="search" oninput="cambiarFiltroCuenta()" placeholder="Descripción o tipo" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                    </div>
                                    <div class="w-full sm:w-48">
                                        <label for="filtroCuentaEstado" class="block text-xs font-semibold text-slate-700 mb-1">Estado</label>
                                        <select id="filtroCuentaEstado" onchange="cambiarFiltroCuenta()" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm">
                                            <option value="all">Todos</option>
                                            <option value="pagado">Pagado</option>
                                            <option value="pendiente">Pendiente</option>
                                            <option value="proximo">Próximo a vencer</option>
                                            <option value="vencido">Vencido</option>
                                        </select>
                                    </div>
                                    <button type="button" onclick="limpiarFiltrosCuenta()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline sm:ml-auto">
                                        Limpiar filtros
                                    </button>
                                </div>

                                <div id="cuenta-movimientos">
                                    <!-- Tabla escritorio -->
                                    <div class="hidden lg:block overflow-x-auto">
                                        <table class="w-full min-w-[980px] text-left border-collapse">
                                            <caption class="sr-only">Estado de cuenta con mes, tipo, descripción, valor, descuento, pagos y saldo.</caption>
                                            <thead class="bg-slate-50 border-y border-slate-200">
                                                <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                                    <th scope="col" class="w-[110px] px-4 py-3">Mes</th>
                                                    <th scope="col" class="w-[120px] px-4 py-3">Tipo</th>
                                                    <th scope="col" class="px-4 py-3">Descripción</th>
                                                    <th scope="col" class="w-[120px] px-4 py-3 text-right">Valor</th>
                                                    <th scope="col" class="w-[130px] px-4 py-3 text-right">Descuento</th>
                                                    <th scope="col" class="w-[130px] px-4 py-3 text-right">Pagos</th>
                                                    <th scope="col" class="w-[120px] px-4 py-3 text-right">Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cuenta-tbody" class="divide-y divide-slate-100 text-sm"></tbody>
                                        </table>
                                    </div>
                                    <!-- Tarjetas móvil -->
                                    <div id="cuenta-cards" class="lg:hidden divide-y divide-slate-100"></div>
                                </div>

                                <!-- Estado vacío -->
                                <div id="cuenta-causaciones-empty" class="hidden py-10 px-2 text-center space-y-4">
                                    <div class="max-w-md mx-auto space-y-1">
                                        <h3 id="cuenta-empty-titulo" class="text-base font-bold text-slate-900">No hay movimientos registrados</h3>
                                        <p id="cuenta-empty-texto" class="text-sm text-slate-600">Cuando se genere un movimiento para el periodo, aparecerá en esta sección.</p>
                                    </div>
                                    <div id="cuenta-empty-accion" class="hidden">
                                        <button type="button" onclick="limpiarFiltrosCuenta()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">Limpiar filtros</button>
                                    </div>
                                </div>

                                <!-- Convención de estados -->
                                <p class="flex flex-wrap items-center gap-x-4 gap-y-1 border-t border-slate-200 py-3 text-[11px] text-slate-500">
                                    <span class="font-semibold text-slate-600">Convención de colores</span>
                                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600" aria-hidden="true"></span>Pagado</span>
                                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-slate-400" aria-hidden="true"></span>Pendiente</span>
                                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-amber-500" aria-hidden="true"></span>Próximo a vencer</span>
                                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-red-600" aria-hidden="true"></span>Vencido</span>
                                </p>

                                <!-- Totales al pie -->
                                <div class="border-t border-slate-200 py-5">
                                    <dl class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div>
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Total causado</dt>
                                            <dd class="mt-1 text-base font-bold text-slate-900" data-cuenta-total="causado">$0</dd>
                                        </div>
                                        <div>
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Descuentos</dt>
                                            <dd class="mt-1 text-base font-bold text-slate-900" data-cuenta-total="descuentos">$0</dd>
                                        </div>
                                        <div>
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Pagos</dt>
                                            <dd class="mt-1 text-base font-bold text-emerald-800" data-cuenta-total="pagos">$0</dd>
                                        </div>
                                        <div>
                                            <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Saldo a la fecha</dt>
                                            <dd class="mt-1 text-base font-bold text-amber-950" data-cuenta-total="saldo">$0</dd>
                                        </div>
                                    </dl>
                                </div>
                            </section>

                            <!-- 2. RESUMEN DE PAGOS (menú oculto / desplegable) -->
                            <section aria-labelledby="heading-resumen-pagos" class="py-4 border-b border-slate-200">
                                <button type="button" id="btn-toggle-resumen" onclick="toggleResumenPagos()" aria-expanded="false" aria-controls="resumen-pagos-panel" class="w-full min-h-[44px] flex items-center justify-between gap-3 text-left hover:text-accent-700 transition">
                                    <span class="flex flex-wrap items-center gap-2.5">
                                        <span class="text-base font-bold text-slate-900">Resumen de pagos</span>
                                        <span id="resumen-pagos-badge" class="text-xs text-slate-500">(historial de pagos aplicados)</span>
                                    </span>
                                    <i id="resumen-pagos-caret" class="ph ph-caret-down text-lg text-slate-500 transition-transform" aria-hidden="true"></i>
                                </button>
                                <div id="resumen-pagos-panel" class="hidden pt-3">
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left border-collapse">
                                            <caption class="sr-only">Pagos registrados con fecha, entidad y valor.</caption>
                                            <thead class="bg-slate-50 border-y border-slate-200">
                                                <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                                    <th scope="col" class="px-4 py-3 whitespace-nowrap">Fecha</th>
                                                    <th scope="col" class="px-4 py-3">Entidad</th>
                                                    <th scope="col" class="px-4 py-3 text-right">Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cuenta-pagos-tbody" class="divide-y divide-slate-100 text-sm"></tbody>
                                        </table>
                                    </div>
                                    <div id="cuenta-pagos-empty" class="hidden py-8 px-2 text-center space-y-1">
                                        <p class="text-sm font-semibold text-slate-800">No hay pagos registrados</p>
                                        <p class="text-sm text-slate-600">Cuando se aplique un pago, aparecerá en esta tabla.</p>
                                    </div>
                                </div>
                            </section>

                            <!-- 3. ACCIÓN DE PAGO PSE (al final) -->
                            <section aria-labelledby="heading-pago-pse" class="py-6 space-y-4">
                                <div>
                                    <h2 id="heading-pago-pse" class="text-base font-bold text-slate-900">Pago en línea</h2>
                                    <p id="cuenta-acciones-ayuda" class="text-sm text-slate-600">Genera el recibo o el link de pago para el periodo pendiente más próximo.</p>
                                </div>
                                <div class="flex flex-wrap items-center gap-4">
                                    <button type="button" id="btnLinkPago" onclick="abrirModalPago()" class="min-h-[44px] px-5 py-2.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm inline-flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <i class="ph ph-credit-card text-lg" aria-hidden="true"></i>
                                        <span>Link de pago PSE</span>
                                    </button>
                                    <button type="button" onclick="descargarReciboDemo()" class="min-h-[44px] text-sm font-semibold text-accent-700 hover:underline">
                                        Descargar recibo
                                    </button>
                                    <button type="button" id="btnPagarPie" onclick="abrirModalPago()" class="hidden min-h-[44px] px-5 py-2.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm inline-flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <i class="ph ph-credit-card text-lg" aria-hidden="true"></i>
                                        <span>Pagar en línea</span>
                                    </button>
                                </div>
                                <button type="button" onclick="periodosAnterioresDemo()" class="min-h-[44px] text-sm text-slate-600 hover:text-slate-900 underline underline-offset-2">
                                    Ver periodos anteriores
                                </button>
                            </section>

                        </div><!-- /panel-cuenta-general -->

                        <!-- Panel: Restaurante y transporte -->
                        <div id="panel-cuenta-servicios" role="tabpanel" aria-labelledby="tab-cuenta-servicios" class="hidden space-y-0">

                            <!-- Encabezado compacto -->
                            <div class="py-6 border-b border-slate-200">
                                <div class="flex flex-wrap items-end justify-between gap-4">
                                    <div class="space-y-1">
                                        <h2 class="text-xl font-bold text-slate-900">Restaurante y transporte</h2>
                                        <p class="text-sm text-slate-600">Saldo pendiente · <span class="font-bold text-slate-900" data-servicios-total="saldo">$0</span></p>
                                    </div>
                                    <span id="servicios-estado-chip" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-800">
                                        <span id="servicios-estado-icono" class="w-1.5 h-1.5 rounded-full bg-amber-500" aria-hidden="true"></span>
                                        <span id="servicios-estado-texto">Pendiente de pago</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Detalle de servicios (contexto: qué se debe y qué se ha pagado) -->
                            <section aria-labelledby="heading-servicios-causaciones" class="py-6 border-b border-slate-200">
                                <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
                                    <div>
                                        <h2 id="heading-servicios-causaciones" class="text-base font-bold text-slate-900">Detalle de servicios</h2>
                                        <p class="text-sm text-slate-600">Tipo · mes · descripción · valor · pagos.</p>
                                    </div>
                                    <p class="text-sm text-slate-600"><span id="servicios-contador" class="font-semibold text-slate-900">0</span> registros</p>
                                </div>
                                <div id="servicios-tabla-wrap" class="overflow-x-auto">
                                    <table class="w-full min-w-[760px] text-left border-collapse">
                                        <caption class="sr-only">Detalle de servicios de restaurante y transporte con tipo, mes, descripción, valor y pagos.</caption>
                                        <thead class="bg-slate-50 border-y border-slate-200">
                                            <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                                <th scope="col" class="w-[130px] px-4 py-3">Tipo</th>
                                                <th scope="col" class="w-[110px] px-4 py-3">Mes</th>
                                                <th scope="col" class="px-4 py-3">Descripción</th>
                                                <th scope="col" class="w-[120px] px-4 py-3 text-right">Valor</th>
                                                <th scope="col" class="w-[130px] px-4 py-3 text-right">Pagos</th>
                                            </tr>
                                        </thead>
                                        <tbody id="servicios-tbody" class="divide-y divide-slate-100 text-sm"></tbody>
                                    </table>
                                </div>
                                <div id="servicios-empty" class="hidden py-10 px-2 text-center space-y-1">
                                    <p class="text-sm font-semibold text-slate-800">No hay cobros de servicios registrados</p>
                                    <p class="text-sm text-slate-600">Cuando se genere un cobro de restaurante o transporte, aparecerá aquí.</p>
                                </div>
                            </section>

                            <!-- Historial de pagos realizados -->
                            <section aria-labelledby="heading-servicios-historial" class="py-6 border-b border-slate-200">
                                <div class="mb-4">
                                    <h2 id="heading-servicios-historial" class="text-base font-bold text-slate-900">Historial de pagos</h2>
                                    <p class="text-sm text-slate-600">Pagos realizados para restaurante y transporte.</p>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full min-w-[640px] text-left border-collapse">
                                        <caption class="sr-only">Historial de pagos de servicios con fecha, servicio, mes y valor.</caption>
                                        <thead class="bg-slate-50 border-y border-slate-200">
                                            <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                                <th scope="col" class="w-[130px] px-4 py-3">Fecha</th>
                                                <th scope="col" class="w-[130px] px-4 py-3">Servicio</th>
                                                <th scope="col" class="px-4 py-3">Mes</th>
                                                <th scope="col" class="w-[130px] px-4 py-3 text-right">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody id="servicios-pagos-tbody" class="divide-y divide-slate-100 text-sm"></tbody>
                                    </table>
                                </div>
                                <div id="servicios-pagos-empty" class="hidden py-10 px-2 text-center space-y-1">
                                    <p class="text-sm font-semibold text-slate-800">Aún no hay pagos de servicios</p>
                                    <p class="text-sm text-slate-600">Cuando se aplique un pago de restaurante o transporte, aparecerá en este historial.</p>
                                </div>
                            </section>

                            <!-- Aviso discreto (1 línea) -->
                            <p class="text-xs text-slate-500 pt-4">
                                Los pagos se reflejan hasta 24 horas después de ser efectivos. Fuente: [Sistema de servicios complementarios].
                            </p>

                        </div><!-- /panel-cuenta-servicios -->
                    </div>
                </div>
                <!-- /VISTA: ESTADO DE CUENTA -->

            </main>
        </div>
    </div>

    <!-- MODAL ACCESIBLE: CARNET VIRTUAL -->
    <div id="idCardModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60">
        <div class="bg-white rounded-xl max-w-md w-full border border-slate-300 p-6 sm:p-8 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                <h2 id="modalTitle" class="text-lg font-bold text-slate-900">Carnet virtual</h2>
                <button onclick="closeModal()" aria-label="Cerrar carnet virtual" class="min-w-[44px] min-h-[44px] rounded-lg border border-slate-300 flex items-center justify-center text-slate-700 hover:bg-slate-100">
                    <i class="ph ph-x text-xl" aria-hidden="true"></i>
                </button>
            </div>
            <div class="hidden p-6 rounded-xl border-2 border-dashed border-slate-300 wire-slot text-center space-y-4">
                <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 border border-slate-300 flex items-center justify-center text-xs font-mono text-slate-600">
                    [Foto]
                </div>
                <div class="space-y-1">
                    <p class="font-bold text-base text-slate-900">[Nombre completo del estudiante]</p>
                    <p class="text-sm text-slate-700">[Código y grado]</p>
                </div>
                <div class="hidden w-44 h-44 mx-auto rounded-lg bg-white border border-slate-300 flex flex-col items-center justify-center p-3">
                    <i class="ph ph-qr-code text-5xl text-slate-700 mb-1" aria-hidden="true"></i>
                    <span class="text-xs font-mono text-slate-600">[Código QR ampliado]</span>
                </div>
            </div>
            <div class="hidden flex flex-col sm:flex-row gap-3">
                <button onclick="closeModal()" class="w-full min-h-[44px] px-4 py-2.5 rounded-lg bg-accent-600 hover:bg-accent-700 text-white font-semibold text-sm">
                    [Cerrar ventana]
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL ACCESIBLE: FIRMA DE ANOTACIÓN -->
    <div id="firmaModal" role="dialog" aria-modal="true" aria-labelledby="firmaModalTitle" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60">
        <div class="bg-white rounded-xl max-w-lg w-full border border-slate-300 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between gap-4 p-6 sm:p-8 border-b border-slate-200">
                <div>
                    <h2 id="firmaModalTitle" class="text-lg font-bold text-slate-900">Firmar anotación</h2>
                    <p class="text-sm text-slate-600">Observador del alumno · Periodo [AAAA]</p>
                </div>
                <button onclick="cerrarFirmaModal()" aria-label="Cerrar ventana de firma" class="min-w-[44px] min-h-[44px] rounded-lg border border-slate-300 flex items-center justify-center text-slate-700 hover:bg-slate-100 shrink-0">
                    <i class="ph ph-x text-xl" aria-hidden="true"></i>
                </button>
            </div>

            <div class="p-6 sm:p-8 space-y-5">
                <div id="firmaResumen" class="p-4 rounded-lg bg-slate-50 border border-slate-200 space-y-2 text-sm"></div>

                <!-- Paso 1: envío del código -->
                <div id="firmaPaso1" class="space-y-4">
                    <p class="text-sm text-slate-700">Enviaremos un código de confirmación de 4 dígitos a los datos de contacto registrados en el colegio.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">
                        <div class="p-3 rounded-lg border border-slate-200 bg-white">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Correo</p>
                            <p class="mt-0.5 text-sm font-semibold text-slate-900 break-all">[correo@ejemplo.com]</p>
                        </div>
                        <div class="p-3 rounded-lg border border-slate-200 bg-white">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Celular</p>
                            <p class="mt-0.5 text-sm font-semibold text-slate-900 font-mono">[Número de celular]</p>
                        </div>
                    </div>

                    <button type="button" onclick="enviarCodigoFirma()" class="w-full min-h-[44px] px-4 py-2.5 rounded-lg bg-accent-700 hover:bg-accent-800 text-white font-semibold text-sm inline-flex items-center justify-center gap-2">
                        <i class="ph ph-paper-plane-tilt text-lg" aria-hidden="true"></i>
                        <span>Enviar código de confirmación</span>
                    </button>
                </div>

                <!-- Paso 2: código y firma -->
                <div id="firmaPaso2" class="hidden space-y-4">
                    <div class="p-3 rounded-lg bg-emerald-50 border border-emerald-600 text-emerald-900 text-sm flex items-start gap-2">
                        <i class="ph-fill ph-check-circle text-base mt-0.5 shrink-0" aria-hidden="true"></i>
                        <span>Código enviado. Revisa tu correo o mensaje de texto.</span>
                    </div>

                    <div>
                        <label for="firmaCodigo" class="block text-sm font-semibold text-slate-800 mb-1.5">Código de confirmación</label>
                        <input id="firmaCodigo" type="text" inputmode="numeric" maxlength="4" autocomplete="one-time-code" aria-describedby="firmaCodigoAyuda firmaCodigoError" placeholder="____" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-400 bg-white text-slate-900 text-lg font-mono text-center tracking-[0.4em]">
                        <p id="firmaCodigoAyuda" class="mt-1 text-xs text-slate-600">Demo: usa el código <span class="font-mono font-semibold">1234</span>.</p>
                        <p id="firmaCodigoError" role="alert" class="hidden mt-1 text-sm font-semibold text-red-700">El código no coincide. Inténtalo de nuevo.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2">
                        <button type="button" onclick="confirmarFirma()" class="flex-1 min-h-[44px] px-4 py-2.5 rounded-lg bg-accent-700 hover:bg-accent-800 text-white font-semibold text-sm inline-flex items-center justify-center gap-2">
                            <i class="ph ph-signature text-lg" aria-hidden="true"></i>
                            <span>Firmar anotación</span>
                        </button>
                        <button type="button" onclick="cerrarFirmaModal()" class="min-h-[44px] px-4 py-2.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-100 text-slate-800 font-semibold text-sm">
                            Cancelar
                        </button>
                    </div>

                    <button type="button" onclick="enviarCodigoFirma()" class="min-h-[44px] px-1 text-sm font-semibold text-accent-700 underline underline-offset-2 hover:text-accent-800">
                        Reenviar código
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: LINK DE PAGO PSE -->
    <div id="pagoModal" role="dialog" aria-modal="true" aria-labelledby="pagoModalTitle" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60">
        <div class="bg-white rounded-xl max-w-xl w-full border border-slate-300 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between gap-4 p-6 sm:p-8 border-b border-slate-200">
                <div>
                    <h2 id="pagoModalTitle" class="text-lg font-bold text-slate-900">Crear link de pago</h2>
                    <p id="pagoModalSubtitulo" class="text-sm text-slate-600">Pago en línea por PSE · Periodo [AAAA]</p>
                </div>
                <button type="button" onclick="cerrarModalPago()" aria-label="Cerrar ventana de pago" class="min-w-[44px] min-h-[44px] rounded-lg border border-slate-300 flex items-center justify-center text-slate-700 hover:bg-slate-100 shrink-0">
                    <i class="ph ph-x text-xl" aria-hidden="true"></i>
                </button>
            </div>

            <div class="p-6 sm:p-8 space-y-6">
                <div id="pagoModalResumen" class="p-4 rounded-lg bg-slate-50 border border-slate-200 space-y-2"></div>

                <form id="pagoForm" class="space-y-4" onsubmit="event.preventDefault(); continuarPagoDemo();">
                    <p class="text-sm font-semibold text-slate-900">Datos del pagador</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="pagoTipoDoc" class="block text-sm font-semibold text-slate-800 mb-1.5">Tipo de documento</label>
                            <select id="pagoTipoDoc" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-400 bg-white text-slate-900 text-sm">
                                <option value="CC">Cédula de ciudadanía</option>
                                <option value="CE">Cédula de extranjería</option>
                                <option value="TI">Tarjeta de identidad</option>
                                <option value="PA">Pasaporte</option>
                            </select>
                        </div>
                        <div>
                            <label for="pagoDocumento" class="block text-sm font-semibold text-slate-800 mb-1.5">Número de documento</label>
                            <input id="pagoDocumento" type="text" inputmode="numeric" autocomplete="off" placeholder="[Número de documento]" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-400 bg-white text-slate-900 text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="pagoNombres" class="block text-sm font-semibold text-slate-800 mb-1.5">Nombre completo del pagador</label>
                        <input id="pagoNombres" type="text" autocomplete="off" placeholder="[Nombres y apellidos]" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-400 bg-white text-slate-900 text-sm">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="pagoCorreo" class="block text-sm font-semibold text-slate-800 mb-1.5">Correo electrónico</label>
                            <input id="pagoCorreo" type="email" autocomplete="off" placeholder="[correo@ejemplo.com]" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-400 bg-white text-slate-900 text-sm">
                        </div>
                        <div>
                            <label for="pagoCelular" class="block text-sm font-semibold text-slate-800 mb-1.5">Celular de contacto</label>
                            <input id="pagoCelular" type="tel" autocomplete="off" placeholder="[Número de celular]" class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-slate-400 bg-white text-slate-900 text-sm">
                        </div>
                    </div>

                    <label class="flex items-start gap-3 p-3 rounded-lg border border-slate-200 bg-slate-50 cursor-pointer">
                        <input type="checkbox" class="mt-0.5 h-4 w-4 rounded border-slate-400 text-accent-700 focus:ring-2 focus:ring-accent-600" checked>
                        <span class="text-sm text-slate-700">Acepto los términos y condiciones de la pasarela de pagos y el tratamiento de datos personales.</span>
                    </label>

                    <label id="pagoSoloReciboWrap" class="hidden items-start gap-3 p-3 rounded-lg border border-slate-300 bg-slate-50 cursor-pointer">
                        <input type="checkbox" id="pagoSoloRecibo" class="mt-0.5 h-4 w-4 rounded border-slate-400 text-accent-700 focus:ring-2 focus:ring-accent-600" onchange="actualizarBotonPago()">
                        <span class="text-sm text-slate-700">
                            <span class="block font-semibold text-slate-900">Solo generar recibo para pago presencial</span>
                            <span class="block text-xs text-slate-600">Marca esta opción si no deseas pagar por pasarela, sino llevar el recibo al banco.</span>
                        </span>
                    </label>

                    <div class="p-3 rounded-lg bg-amber-50 border border-amber-500 text-amber-900 text-xs flex items-start gap-2">
                        <i class="ph-fill ph-info text-base mt-0.5 shrink-0" aria-hidden="true"></i>
                        <span id="pagoAvisoTexto">Recuerda que el pago se verá reflejado en el estado de cuenta hasta 24 horas después de ser efectivo. Al continuar serás redirigido a la pasarela PSE.</span>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2 pt-1">
                        <button type="submit" class="flex-1 min-h-[44px] px-4 py-2.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm inline-flex items-center justify-center gap-2">
                            <i id="pagoBotonIcono" class="ph ph-arrow-square-out text-lg" aria-hidden="true"></i>
                            <span id="pagoBotonTexto">Continuar al pago</span>
                        </button>
                        <button type="button" onclick="cerrarModalPago()" class="min-h-[44px] px-4 py-2.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-100 text-slate-800 font-semibold text-sm">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- REGIÓN VIVA DE RETROALIMENTACIÓN (WCAG Status Messages) -->
    <div id="liveRegion" aria-live="polite" class="fixed bottom-4 right-4 z-50 hidden">
        <div class="bg-slate-900 text-white px-4 py-3 rounded-lg border border-slate-700 text-sm font-medium flex items-center gap-2">
            <i class="ph ph-info text-lg text-accent-100" aria-hidden="true"></i>
            <span id="liveRegionText"></span>
        </div>
    </div>

    <script>
        // Navegación móvil
        // ===== Navegación móvil accesible (drawer) =====
        let mobileNavOpen = false;
        let mobileNavLastFocus = null;

        function isMobileViewport() { return window.innerWidth < 1024; }

        function mobileNavFocusables() {
            const nav = document.getElementById('sidebarNav');
            return Array.from(nav.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'))
                .filter(function (el) { return !el.disabled && el.offsetParent !== null; });
        }

        function openMobileNav() {
            if (!isMobileViewport()) { return; }
            const nav = document.getElementById('sidebarNav');
            const overlay = document.getElementById('mobileOverlay');
            const toggle = document.getElementById('mobileNavToggle');
            mobileNavLastFocus = document.activeElement;
            mobileNavOpen = true;
            nav.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (toggle) { toggle.setAttribute('aria-expanded', 'true'); }
            nav.setAttribute('role', 'dialog');
            nav.setAttribute('aria-modal', 'true');
            nav.removeAttribute('aria-hidden');
            const closeBtn = document.getElementById('mobileNavClose');
            if (closeBtn) { closeBtn.focus(); }
            document.addEventListener('keydown', mobileNavKeydown);
            announceFeedback('Menú de navegación abierto');
        }

        function closeMobileNav() {
            const nav = document.getElementById('sidebarNav');
            const overlay = document.getElementById('mobileOverlay');
            const toggle = document.getElementById('mobileNavToggle');
            const wasOpen = mobileNavOpen;
            mobileNavOpen = false;
            nav.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
            if (toggle) { toggle.setAttribute('aria-expanded', 'false'); }
            nav.removeAttribute('role');
            nav.removeAttribute('aria-modal');
            if (isMobileViewport()) { nav.setAttribute('aria-hidden', 'true'); }
            document.removeEventListener('keydown', mobileNavKeydown);
            if (wasOpen) {
                if (mobileNavLastFocus && typeof mobileNavLastFocus.focus === 'function') {
                    mobileNavLastFocus.focus();
                } else if (toggle) {
                    toggle.focus();
                }
                announceFeedback('Menú de navegación cerrado');
            }
        }

        function toggleMobileNav() {
            if (mobileNavOpen) { closeMobileNav(); } else { openMobileNav(); }
        }

        function mobileNavKeydown(e) {
            if (e.key === 'Escape') {
                e.preventDefault();
                closeMobileNav();
                return;
            }
            if (e.key === 'Tab') {
                const focusables = mobileNavFocusables();
                if (focusables.length === 0) { return; }
                const first = focusables[0];
                const last = focusables[focusables.length - 1];
                if (e.shiftKey && document.activeElement === first) {
                    e.preventDefault(); last.focus();
                } else if (!e.shiftKey && document.activeElement === last) {
                    e.preventDefault(); first.focus();
                }
            }
        }

        function syncMobileNavForViewport() {
            const nav = document.getElementById('sidebarNav');
            const overlay = document.getElementById('mobileOverlay');
            const toggle = document.getElementById('mobileNavToggle');
            if (!isMobileViewport()) {
                mobileNavOpen = false;
                nav.removeAttribute('role');
                nav.removeAttribute('aria-modal');
                nav.removeAttribute('aria-hidden');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
                document.removeEventListener('keydown', mobileNavKeydown);
                if (toggle) { toggle.setAttribute('aria-expanded', 'false'); }
            } else if (!mobileNavOpen) {
                nav.setAttribute('aria-hidden', 'true');
                nav.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
        window.addEventListener('resize', syncMobileNavForViewport);
        const mobileNavMQ = window.matchMedia('(min-width: 1024px)');
        if (mobileNavMQ.addEventListener) { mobileNavMQ.addEventListener('change', syncMobileNavForViewport); }
        else if (mobileNavMQ.addListener) { mobileNavMQ.addListener(syncMobileNavForViewport); }

        // Pistas de scroll horizontal para tablas en móvil (descubribilidad)
        const tableScrollHintUpdaters = [];
        function refreshTableScrollHints() { tableScrollHintUpdaters.forEach(function (u) { u(); }); }
        function scheduleScrollHintRefresh() {
            refreshTableScrollHints();
            requestAnimationFrame(refreshTableScrollHints);
            setTimeout(refreshTableScrollHints, 120);
        }
        function initTableScrollHints() {
            const regions = document.querySelectorAll('#tareas-tabla-scroll, .overflow-x-auto');
            regions.forEach(function (region) {
                if (!region.querySelector('table')) { return; }
                if (region.dataset.scrollHint) { return; }
                region.dataset.scrollHint = '1';
                const hint = document.createElement('p');
                hint.className = 'table-scroll-hint lg:hidden items-center gap-1.5 text-[11px] text-slate-500 px-1 pb-1.5';
                hint.innerHTML = '<i class="ph ph-arrows-left-right text-xs" aria-hidden="true"></i><span>Desliza horizontalmente para ver todas las columnas</span>';
                hint.style.display = 'none';
                region.parentNode.insertBefore(hint, region);
                const update = function () {
                    const scrollable = region.scrollWidth > region.clientWidth + 4;
                    const atEnd = region.scrollLeft + region.clientWidth >= region.scrollWidth - 8;
                    const show = scrollable && !atEnd && window.innerWidth < 1024;
                    hint.style.display = show ? 'flex' : 'none';
                };
                region.addEventListener('scroll', update, { passive: true });
                window.addEventListener('resize', update);
                tableScrollHintUpdaters.push(update);
                update();
            });
        }

        // Sidebar de escritorio: colapsar a rail de iconos
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarNav');
            const colapsado = sidebar.classList.toggle('is-collapsed');
            const boton = document.getElementById('sidebarToggle');
            const etiqueta = colapsado ? 'Expandir menú' : 'Contraer menú';

            boton.setAttribute('aria-expanded', String(!colapsado));
            boton.setAttribute('aria-label', etiqueta);
            boton.setAttribute('title', etiqueta);
            document.getElementById('sidebarToggleLabel').textContent = etiqueta;
            document.getElementById('sidebarToggleIcon').classList.toggle('rotate-180', colapsado);
        }

        // Grupos del menú: acordeón
        function toggleSidebarGroup(boton) {
            const lista = document.getElementById(boton.getAttribute('aria-controls'));
            const expandido = boton.getAttribute('aria-expanded') === 'true';
            boton.setAttribute('aria-expanded', String(!expandido));
            if (lista) { lista.classList.toggle('hidden', expandido); }
            const caret = boton.querySelector('.sidebar-caret');
            if (caret) { caret.classList.toggle('-rotate-90', expandido); }
        }

        function abrirGrupoDeNav(boton) {
            const grupo = boton.closest('.sidebar-group');
            if (!grupo) { return; }
            const toggle = grupo.querySelector('.sidebar-group-toggle');
            const lista = grupo.querySelector('.sidebar-group-list');
            if (!toggle || !lista) { return; }
            if (toggle.getAttribute('aria-expanded') === 'false') {
                toggle.setAttribute('aria-expanded', 'true');
                lista.classList.remove('hidden');
                const caret = toggle.querySelector('.sidebar-caret');
                if (caret) { caret.classList.remove('-rotate-90'); }
            }
        }

        // Configuración de las vistas del canvas
        const vistaConfig = {
            inicio: {
                titulo: 'Inicio',
                subtitulo: 'Periodo académico [AAAA] · [Sede educativa]',
                rol: '[Rol: Estudiante]'
            },
            alumno: {
                titulo: 'Información del alumno',
                subtitulo: 'Datos escolares y familiares · Periodo académico [AAAA]',
                rol: '[Rol: Acudiente]'
            },
            tareas: {
                titulo: 'Consulta de tareas',
                subtitulo: 'Tareas, guías y recuperaciones · Periodo académico [AAAA]',
                rol: '[Rol: Estudiante]'
            },
            informe: {
                titulo: 'Informe académico',
                subtitulo: 'Firmas del observador y estado académico · Periodo [AAAA]',
                rol: '[Rol: Estudiante]'
            },
            logros: {
                titulo: 'Metas, logros, acciones e indicadores',
                subtitulo: 'Logros por asignatura y periodo · [AAAA]',
                rol: '[Rol: Estudiante]'
            },
            'estado-cuenta': {
                titulo: 'Cuenta y pagos',
                subtitulo: 'Pensiones, servicios y pagos · Periodo académico [AAAA]',
                rol: '[Rol: Estudiante]'
            }
        };
        let vistaActiva = 'inicio';
        let estadoActual = 'normal';

        // Selección de ítem de menú (y cambio de vista)
        function selectNav(btn, label, vista) {
            document.querySelectorAll('.nav-link').forEach(el => {
                el.classList.remove('bg-slate-100', 'text-accent-700', 'font-semibold');
                el.classList.add('text-slate-700', 'font-medium');
                el.removeAttribute('aria-current');
            });
            btn.classList.remove('text-slate-700', 'font-medium');
            btn.classList.add('bg-slate-100', 'text-accent-700', 'font-semibold');
            btn.setAttribute('aria-current', 'page');
            abrirGrupoDeNav(btn);

            if (vista) { showView(vista); }

            announceFeedback(`Navegación cambiada a ${label}`);

            if (window.innerWidth < 1024) {
                closeMobileNav();
            }
        }

        // Alterna entre las vistas del canvas
        function showView(vista) {
            vistaActiva = vista;
            if (typeof syncMobileNavForViewport === 'function') { syncMobileNavForViewport(); }

            document.getElementById('view-inicio').classList.toggle('hidden', vista !== 'inicio');
            document.getElementById('view-alumno').classList.toggle('hidden', vista !== 'alumno');
            document.getElementById('view-tareas').classList.toggle('hidden', vista !== 'tareas');
            document.getElementById('view-informe').classList.toggle('hidden', vista !== 'informe');
            document.getElementById('view-logros').classList.toggle('hidden', vista !== 'logros');
            document.getElementById('view-estado-cuenta').classList.toggle('hidden', vista !== 'estado-cuenta');

            const config = vistaConfig[vista] || vistaConfig.inicio;
            document.getElementById('headerTitle').textContent = config.titulo;
            document.getElementById('headerSubtitle').textContent = config.subtitulo;
            document.getElementById('roleChipText').textContent = config.rol;

            applyState();
            if (typeof scheduleScrollHintRefresh === 'function') { scheduleScrollHintRefresh(); }
        }

        // Controlador de estados del sistema (Normal, Carga, Vacío, Error)
        function setSystemState(state) {
            estadoActual = state;

            // Actualizar botones superiores
            document.querySelectorAll('.state-btn').forEach(b => {
                b.classList.remove('bg-accent-600', 'text-white');
                b.classList.add('bg-slate-800', 'text-slate-300');
            });
            const activeBtn = document.getElementById(`btn-state-${state}`);
            if (activeBtn) {
                activeBtn.classList.remove('bg-slate-800', 'text-slate-300');
                activeBtn.classList.add('bg-accent-600', 'text-white');
            }

            applyState();
        }

        // Aplica el estado seleccionado a la vista que está visible
        function applyState() {
            if (vistaActiva === 'alumno') {
                applyInfoState(estadoActual);
            } else if (vistaActiva === 'tareas') {
                applyTareasState(estadoActual);
            } else if (vistaActiva === 'informe') {
                applyInformeState(estadoActual);
            } else if (vistaActiva === 'logros') {
                applyLogrosState(estadoActual);
            } else if (vistaActiva === 'estado-cuenta') {
                applyEstadoCuentaState(estadoActual);
            } else {
                applyInicioState(estadoActual);
            }
        }

        // Estados de la vista Inicio
        function applyInicioState(state) {
            const errorBanner = document.getElementById('state-error-banner');
            const loadingView = document.getElementById('state-loading-view');
            const normalView = document.getElementById('state-normal-view');
            const listContainer = document.getElementById('activity-list-container');
            const emptyState = document.getElementById('activity-empty-state');

            errorBanner.classList.add('hidden');
            loadingView.classList.add('hidden');
            normalView.classList.add('hidden');

            if (state === 'loading') {
                loadingView.classList.remove('hidden');
            } else if (state === 'error') {
                errorBanner.classList.remove('hidden');
                normalView.classList.remove('hidden');
            } else if (state === 'empty') {
                normalView.classList.remove('hidden');
                listContainer.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                normalView.classList.remove('hidden');
                listContainer.classList.remove('hidden');
                emptyState.classList.add('hidden');
                document.getElementById('filterSelect').value = 'all';
            }
        }

        // Estados de la vista Información del alumno
        const infoTabMeta = {
            estudiante: {
                quien: 'el estudiante',
                titulo: 'Sin datos personales del estudiante',
                texto: 'Aún no hay información personal registrada. Solicita la actualización en la secretaría académica.'
            },
            mama: {
                quien: 'la mamá',
                titulo: 'Sin información registrada de la mamá',
                texto: 'No hay datos de la mamá en la matrícula actual. Puedes solicitar su actualización.'
            },
            papa: {
                quien: 'el papá',
                titulo: 'Sin información registrada del papá',
                texto: 'No hay datos del papá en la matrícula actual. Puedes solicitar su actualización.'
            }
        };
        const infoPanels = { estudiante: 'panel-estudiante', mama: 'panel-mama', papa: 'panel-papa' };
        let tabActiva = 'estudiante';

        function applyInfoState(state) {
            const errorBanner = document.getElementById('info-error-banner');
            const loadingView = document.getElementById('info-loading-view');
            const normalView = document.getElementById('info-normal-view');
            const emptyState = document.getElementById('info-empty-state');

            errorBanner.classList.add('hidden');
            loadingView.classList.add('hidden');
            normalView.classList.add('hidden');
            emptyState.classList.add('hidden');

            if (state === 'loading') {
                loadingView.classList.remove('hidden');
                return;
            }
            if (state === 'error') {
                errorBanner.classList.remove('hidden');
                return;
            }

            normalView.classList.remove('hidden');

            if (state === 'empty') {
                Object.values(infoPanels).forEach(id => document.getElementById(id).classList.add('hidden'));
                const meta = infoTabMeta[tabActiva];
                document.getElementById('info-empty-title').textContent = meta.titulo;
                document.getElementById('info-empty-text').textContent = meta.texto;
                emptyState.classList.remove('hidden');
                return;
            }

            showInfoPanel(tabActiva);
        }

        function showInfoPanel(tab) {
            Object.keys(infoPanels).forEach(clave => {
                const panel = document.getElementById(infoPanels[clave]);
                const btn = document.getElementById('tab-' + clave);
                const activo = clave === tab;

                panel.classList.toggle('hidden', !activo);
                btn.setAttribute('aria-selected', activo ? 'true' : 'false');
                btn.tabIndex = activo ? 0 : -1;

                if (activo) {
                    btn.classList.add('text-accent-700', 'font-semibold', 'border-accent-600');
                    btn.classList.remove('text-slate-600', 'font-medium', 'border-transparent');
                } else {
                    btn.classList.remove('text-accent-700', 'font-semibold', 'border-accent-600');
                    btn.classList.add('text-slate-600', 'font-medium', 'border-transparent');
                }
            });
        }

        function selectInfoTab(tab) {
            if (!infoTabMeta[tab]) { return; }
            tabActiva = tab;
            showInfoPanel(tab);

            if (estadoActual === 'empty') {
                applyInfoState('empty');
            }

            announceFeedback(`Mostrando datos de ${infoTabMeta[tab].quien}`);
        }

        function retryInfoLoad() {
            setSystemState('loading');
            setTimeout(() => setSystemState('normal'), 1200);
        }

        // Navegación con teclado entre pestañas (WCAG)
        (function initInfoTabs() {
            const lista = document.getElementById('infoTabs');
            if (!lista) { return; }
            const tabs = Array.from(lista.querySelectorAll('[role="tab"]'));
            lista.addEventListener('keydown', function (e) {
                const actual = tabs.indexOf(document.activeElement);
                if (actual < 0) { return; }
                let destino = -1;
                if (e.key === 'ArrowRight') { destino = (actual + 1) % tabs.length; }
                else if (e.key === 'ArrowLeft') { destino = (actual - 1 + tabs.length) % tabs.length; }
                else if (e.key === 'Home') { destino = 0; }
                else if (e.key === 'End') { destino = tabs.length - 1; }
                if (destino >= 0) {
                    e.preventDefault();
                    tabs[destino].focus();
                    tabs[destino].click();
                }
            });
        })();

        // ===================== VISTA: CONSULTA DE TAREAS =====================
        const TAREAS_POR_PAGINA = 15;
        const TAREAS_HOY = new Date();
        const TAREAS_TIPO_META = {
            'TAREA': {
                etiqueta: 'Tarea',
                icono: 'ph-clipboard-text',
                clase: 'text-accent-700'
            },
            'GUIA-M.TRABAJO': {
                etiqueta: 'Guía-M. Trabajo',
                icono: 'ph-notebook',
                clase: 'text-violet-700'
            },
            'RECUPERACION': {
                etiqueta: 'Recuperación',
                icono: 'ph-arrow-u-up-left',
                clase: 'text-amber-800'
            },
            'REQUERIMIEN_OBS': {
                etiqueta: 'Requerimien_Obs',
                icono: 'ph-warning-circle',
                clase: 'text-rose-700'
            }
        };
        const TAREAS_FECHA_META = {
            'hoy': 'Hoy',
            '7dias': 'Últimos 7 días',
            'mes': 'Este mes',
            'mesAnterior': 'Mes anterior'
        };
        const TAREAS_MATERIAS = [
            'Matemáticas', 'Español', 'Ciencias Naturales', 'Ciencias Sociales',
            'Inglés', 'Informática', 'Educación Física', 'Artes'
        ];
        const TAREAS_TEMAS = {
            'Matemáticas': ['Taller de fracciones', 'Ecuaciones de primer grado', 'Problemas de proporcionalidad', 'Quiz de geometría', 'Números enteros'],
            'Español': ['Análisis de texto narrativo', 'Texto argumentativo', 'Comprensión lectora', 'Ortografía y acentuación', 'Géneros literarios'],
            'Ciencias Naturales': ['Sistema digestivo', 'Mezclas y soluciones', 'Ciclo del agua', 'La célula y sus partes', 'Energía y movimiento'],
            'Ciencias Sociales': ['Regiones de Colombia', 'Derechos y deberes', 'Época colonial', 'Mapas y relieve', 'Democracia escolar'],
            'Inglés': ['Present simple', 'Vocabulario de la casa', 'Reading comprehension', 'Past tense', 'Daily routines'],
            'Informática': ['Hoja de cálculo', 'Algoritmos básicos', 'Presentaciones digitales', 'Ciudadanía digital', 'Manejo de archivos'],
            'Educación Física': ['Rutina de calentamiento', 'Fundamentos del baloncesto', 'Juegos cooperativos', 'Capacidades físicas', 'Higiene postural'],
            'Artes': ['Collage con material reciclado', 'Dibujo de observación', 'Ritmo y expresión corporal', 'Color y textura', 'Maqueta arquitectónica']
        };
        const TAREAS_DESCRIPCIONES = {
            'TAREA': 'Desarrollar la actividad en el cuaderno y entregarla en la fecha indicada.',
            'GUIA-M.TRABAJO': 'Trabajo guiado por módulos; incluye anexo descargable.',
            'RECUPERACION': 'Actividad de recuperación de logros pendientes del periodo.',
            'REQUERIMIEN_OBS': 'Requerimiento con observaciones del docente para revisión.'
        };
        const TAREAS_PATRON_TIPO = [
            'TAREA', 'TAREA', 'GUIA-M.TRABAJO', 'TAREA', 'RECUPERACION',
            'TAREA', 'GUIA-M.TRABAJO', 'REQUERIMIEN_OBS', 'TAREA', 'GUIA-M.TRABAJO'
        ];

        // Genera fechas relativas a hoy para que los filtros tengan resultados
        function fechaTarea(dias) {
            const d = new Date(TAREAS_HOY.getFullYear(), TAREAS_HOY.getMonth(), TAREAS_HOY.getDate());
            d.setDate(d.getDate() + dias);
            return d;
        }

        function formatoFechaTarea(d) {
            const dia = String(d.getDate()).padStart(2, '0');
            const mes = String(d.getMonth() + 1).padStart(2, '0');
            return `${dia}/${mes}/${d.getFullYear()}`;
        }

        // Datos demo: 42 registros para probar 3 páginas de 15
        const tareasData = Array.from({ length: 42 }, (_, i) => {
            const materia = TAREAS_MATERIAS[i % TAREAS_MATERIAS.length];
            const temas = TAREAS_TEMAS[materia];
            const tipo = TAREAS_PATRON_TIPO[i % TAREAS_PATRON_TIPO.length];
            const apertura = fechaTarea(-((i * 3) % 45));
            const entrega = new Date(apertura);
            entrega.setDate(entrega.getDate() + 2 + (i % 7));

            return {
                id: i + 1,
                materia: materia,
                tipo: tipo,
                titulo: temas[Math.floor(i / TAREAS_MATERIAS.length) % temas.length],
                descripcion: TAREAS_DESCRIPCIONES[tipo],
                fechaApertura: apertura,
                fechaEntrega: entrega
            };
        });

        let tareasPagina = 1;
        let tareasFiltros = { asignatura: 'all', fecha: 'all', tipo: 'all' };

        function getTareasFiltradas() {
            const hoy = fechaTarea(0);
            let desde = null;
            let hasta = null;

            if (tareasFiltros.fecha === 'hoy') {
                desde = hoy;
                hasta = hoy;
            } else if (tareasFiltros.fecha === '7dias') {
                desde = fechaTarea(-6);
                hasta = hoy;
            } else if (tareasFiltros.fecha === 'mes') {
                desde = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
                hasta = hoy;
            } else if (tareasFiltros.fecha === 'mesAnterior') {
                desde = new Date(hoy.getFullYear(), hoy.getMonth() - 1, 1);
                hasta = new Date(hoy.getFullYear(), hoy.getMonth(), 0);
            }

            return tareasData.filter(t => {
                if (tareasFiltros.asignatura !== 'all' && t.materia !== tareasFiltros.asignatura) {
                    return false;
                }
                if (tareasFiltros.tipo !== 'all' && t.tipo !== tareasFiltros.tipo) {
                    return false;
                }
                if (desde) {
                    const enRango = d => d >= desde && d <= hasta;
                    if (!enRango(t.fechaApertura) && !enRango(t.fechaEntrega)) {
                        return false;
                    }
                }
                return true;
            });
        }

        function tieneFiltrosTareas() {
            return tareasFiltros.asignatura !== 'all'
                || tareasFiltros.fecha !== 'all'
                || tareasFiltros.tipo !== 'all';
        }

        function actualizarResumenFiltros() {
            const partes = [];
            if (tareasFiltros.asignatura !== 'all') {
                partes.push(`Asignatura: ${tareasFiltros.asignatura}`);
            }
            if (tareasFiltros.fecha !== 'all') {
                partes.push(`Fecha: ${TAREAS_FECHA_META[tareasFiltros.fecha]}`);
            }
            if (tareasFiltros.tipo !== 'all') {
                partes.push(`Tipo: ${TAREAS_TIPO_META[tareasFiltros.tipo].etiqueta}`);
            }

            document.getElementById('tareas-filtros-activos').textContent = partes.length
                ? `Filtros activos — ${partes.join(' · ')}`
                : 'Sin filtros activos: se muestran todas las tareas.';
        }

        function mostrarTareasVacias(mostrar, porFiltros) {
            const emptyState = document.getElementById('tareas-empty-state');
            const tabla = document.getElementById('tareas-tabla-scroll');
            const paginacion = document.getElementById('tareas-paginacion-barra');

            if (mostrar) {
                tabla.classList.add('hidden');
                paginacion.classList.add('hidden');
                document.getElementById('tareas-empty-title').textContent = porFiltros
                    ? 'Sin resultados para los filtros'
                    : 'No hay tareas registradas';
                document.getElementById('tareas-empty-text').textContent = porFiltros
                    ? 'Prueba con otra asignatura, fecha o tipo, o restablece los filtros para ver todas las tareas.'
                    : 'Cuando tus docentes publiquen tareas, guías o recuperaciones, aparecerán en esta sección.';
                emptyState.classList.remove('hidden');
            } else {
                tabla.classList.remove('hidden');
                paginacion.classList.remove('hidden');
                emptyState.classList.add('hidden');
            }
        }

        function renderPaginacionTareas(totalPaginas) {
            const nav = document.getElementById('tareas-paginacion');

            if (totalPaginas <= 1) {
                nav.innerHTML = '';
                nav.classList.add('hidden');
                return;
            }
            nav.classList.remove('hidden');

            const base = 'min-h-[44px] inline-flex items-center justify-center gap-1 rounded-lg border text-sm font-semibold transition';
            const inactivo = 'bg-white border-slate-300 text-slate-800 hover:bg-slate-100';
            const activo = 'bg-accent-700 border-accent-700 text-white';

            let html = '';
            html += `<button type="button" onclick="irAPaginaTareas(${tareasPagina - 1})" ${tareasPagina === 1 ? 'disabled' : ''} aria-label="Página anterior" class="${base} ${inactivo} min-w-[44px] px-3 disabled:opacity-40 disabled:cursor-not-allowed">
                        <i class="ph ph-caret-left text-base" aria-hidden="true"></i>
                        <span class="hidden sm:inline">Anterior</span>
                    </button>`;

            for (let p = 1; p <= totalPaginas; p++) {
                html += `<button type="button" onclick="irAPaginaTareas(${p})" aria-label="Página ${p}" ${p === tareasPagina ? 'aria-current="page"' : ''} class="${base} ${p === tareasPagina ? activo : inactivo} min-w-[44px] px-2">${p}</button>`;
            }

            html += `<button type="button" onclick="irAPaginaTareas(${tareasPagina + 1})" ${tareasPagina === totalPaginas ? 'disabled' : ''} aria-label="Página siguiente" class="${base} ${inactivo} min-w-[44px] px-3 disabled:opacity-40 disabled:cursor-not-allowed">
                        <span class="hidden sm:inline">Siguiente</span>
                        <i class="ph ph-caret-right text-base" aria-hidden="true"></i>
                    </button>`;

            nav.innerHTML = html;
        }

        function renderTareas() {
            const tbody = document.getElementById('tareas-tbody');
            const lista = getTareasFiltradas();
            const total = lista.length;
            const totalPaginas = Math.max(1, Math.ceil(total / TAREAS_POR_PAGINA));

            if (tareasPagina > totalPaginas) {
                tareasPagina = totalPaginas;
            }

            const inicio = (tareasPagina - 1) * TAREAS_POR_PAGINA;
            const fin = Math.min(inicio + TAREAS_POR_PAGINA, total);
            const pagina = lista.slice(inicio, fin);

            document.getElementById('tareas-contador').textContent = total;
            document.getElementById('tareas-total').textContent = total;
            document.getElementById('tareas-rango').textContent = total === 0 ? '0' : `${inicio + 1}–${fin}`;
            document.getElementById('navTareasCount').textContent = total;

            if (total === 0) {
                tbody.innerHTML = '';
                document.getElementById('tareas-paginacion').innerHTML = '';
                mostrarTareasVacias(true, tieneFiltrosTareas());
                return;
            }

            mostrarTareasVacias(false);

            tbody.innerHTML = pagina.map(t => {
                const meta = TAREAS_TIPO_META[t.tipo];
                return `<tr class="group hover:bg-slate-50">
                    <td class="sticky left-0 z-10 bg-white group-hover:bg-slate-50 px-4 py-3 font-mono text-slate-800 whitespace-nowrap shadow-[1px_0_0_0_#e2e8f0]">${formatoFechaTarea(t.fechaApertura)}</td>
                    <td class="px-3 py-3 whitespace-nowrap">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold ${meta.clase}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current" aria-hidden="true"></span>
                            <span>${meta.etiqueta}</span>
                        </span>
                    </td>
                    <td class="px-3 py-3 font-semibold text-slate-900">${t.materia}</td>
                    <td class="px-3 py-3 text-slate-800">${t.titulo}</td>
                    <td class="px-3 py-3 text-slate-600">
                        <div class="line-clamp-2 max-w-[26rem]">${t.descripcion}</div>
                    </td>
                    <td class="px-4 py-3 text-right font-mono text-slate-800 whitespace-nowrap">${formatoFechaTarea(t.fechaEntrega)}</td>
                </tr>`;
            }).join('');

            renderPaginacionTareas(totalPaginas);
        }

        function irAPaginaTareas(pagina) {
            const totalPaginas = Math.max(1, Math.ceil(getTareasFiltradas().length / TAREAS_POR_PAGINA));
            if (pagina < 1 || pagina > totalPaginas || pagina === tareasPagina) {
                return;
            }

            tareasPagina = pagina;
            renderTareas();

            const scroll = document.getElementById('tareas-tabla-scroll');
            scroll.scrollTop = 0;
            scroll.focus({ preventScroll: true });

            announceFeedback(`Página ${tareasPagina} de ${totalPaginas}`);
        }

        function cambiarFiltroTareas() {
            tareasFiltros = {
                asignatura: document.getElementById('filtroAsignatura').value,
                fecha: document.getElementById('filtroFecha').value,
                tipo: document.getElementById('filtroTipo').value
            };
            tareasPagina = 1;

            actualizarResumenFiltros();

            if (estadoActual !== 'normal') {
                setSystemState('normal');
            } else {
                renderTareas();
            }

            announceFeedback('Filtros de tareas actualizados');
        }

        function limpiarFiltrosTareas() {
            ['filtroAsignatura', 'filtroFecha', 'filtroTipo'].forEach(id => {
                document.getElementById(id).value = 'all';
            });
            tareasFiltros = { asignatura: 'all', fecha: 'all', tipo: 'all' };
            tareasPagina = 1;
            actualizarResumenFiltros();

            if (estadoActual !== 'normal') {
                setSystemState('normal');
            } else {
                renderTareas();
            }

            announceFeedback('Filtros de tareas restablecidos');
        }

        function applyTareasState(state) {
            const errorBanner = document.getElementById('tareas-error-banner');
            const loadingView = document.getElementById('tareas-loading-view');
            const normalView = document.getElementById('tareas-normal-view');

            errorBanner.classList.add('hidden');
            loadingView.classList.add('hidden');
            normalView.classList.add('hidden');

            if (state === 'loading') {
                loadingView.classList.remove('hidden');
                return;
            }
            if (state === 'error') {
                errorBanner.classList.remove('hidden');
                return;
            }

            normalView.classList.remove('hidden');

            if (state === 'empty') {
                document.getElementById('tareas-contador').textContent = '0';
                document.getElementById('tareas-total').textContent = '0';
                document.getElementById('tareas-rango').textContent = '0';
                document.getElementById('navTareasCount').textContent = '0';
                mostrarTareasVacias(true, false);
                return;
            }

            renderTareas();
        }

        function retryTareasLoad() {
            setSystemState('loading');
            setTimeout(() => setSystemState('normal'), 1200);
        }

        // Inicializa contador del menú y contenido de la tabla
        actualizarResumenFiltros();
        renderTareas();

        // ===================== VISTA: INFORME ACADÉMICO =====================
        function fechaInforme(dias) {
            const d = new Date();
            d.setHours(0, 0, 0, 0);
            d.setDate(d.getDate() + dias);
            return d;
        }

        const anotacionesData = [
            {
                id: 1,
                tipo: 'A',
                periodo: 2,
                fecha: fechaInforme(-18),
                titulo: 'Llamado de atención académico',
                falta: 'Leve',
                descripcion: 'Entrega extemporánea del trabajo de investigación sin justificación previa.',
                docente: '[Nombre del docente]',
                firmada: false,
                fechaFirma: null
            },
            {
                id: 2,
                tipo: 'A',
                periodo: 3,
                fecha: fechaInforme(-9),
                titulo: 'Bajo desempeño',
                falta: 'Académica',
                descripcion: 'No alcanzó los desempeños mínimos en la evaluación de comprensión lectora.',
                docente: '[Nombre del docente]',
                firmada: false,
                fechaFirma: null
            },
            {
                id: 3,
                tipo: 'C',
                periodo: 3,
                fecha: fechaInforme(-4),
                titulo: 'Llamado de atención',
                falta: 'Leve',
                descripcion: 'Interrupción reiterada del desarrollo de la clase.',
                docente: '[Nombre del coordinador de convivencia]',
                firmada: false,
                fechaFirma: null
            }
        ];

        const notasData = [
            { materia: 'Matemáticas', p1: 4.5, p2: 4.2, p3: 4.0 },
            { materia: 'Español', p1: 4.8, p2: 4.6, p3: 4.7 },
            { materia: 'Ciencias Naturales', p1: 4.0, p2: 3.8, p3: 4.1 },
            { materia: 'Ciencias Sociales', p1: 4.2, p2: 4.4, p3: 4.3 },
            { materia: 'Inglés', p1: 3.9, p2: 4.1, p3: 3.7 },
            { materia: 'Informática', p1: 4.7, p2: 4.8, p3: 4.9 },
            { materia: 'Educación Física', p1: 4.6, p2: 4.5, p3: 4.6 },
            { materia: 'Artes', p1: 4.9, p2: 4.7, p3: 4.8 }
        ];

        const DESEMPENO_META = {
            superior: { etiqueta: 'Superior', clase: 'bg-emerald-50 border-emerald-600 text-emerald-900' },
            alto: { etiqueta: 'Alto', clase: 'text-accent-700' },
            basico: { etiqueta: 'Básico', clase: 'text-amber-800' },
            bajo: { etiqueta: 'Bajo', clase: 'bg-red-50 border-red-600 text-red-900' }
        };

        function desempenoDe(nota) {
            if (nota >= 4.6) return 'superior';
            if (nota >= 4.0) return 'alto';
            if (nota >= 3.0) return 'basico';
            return 'bajo';
        }

        let firmaAnotacionId = null;
        let ultimoFocoFirma = null;

        function tipoAnotacionMeta(tipo) {
            return tipo === 'A'
                ? { etiqueta: 'Académica', icono: 'ph-book-open', clase: 'text-rose-700' }
                : { etiqueta: 'Convivencia', icono: 'ph-users-three', clase: 'text-amber-800' };
        }

        function renderAnotacionesInforme() {
            const lista = document.getElementById('informe-lista-anotaciones');
            const pendientes = anotacionesData.filter(a => !a.firmada);

            lista.innerHTML = pendientes.map(a => {
                const meta = tipoAnotacionMeta(a.tipo);
                return `<li class="p-4">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div class="min-w-0 flex-1 space-y-1.5">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold ${meta.clase}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current" aria-hidden="true"></span>
                                    <span>${meta.etiqueta}</span>
                                </span>
                                <span class="text-xs font-semibold text-slate-600">Periodo ${a.periodo}</span>
                                <span class="text-xs text-slate-600 font-mono">${formatoFechaTarea(a.fecha)}</span>
                            </div>
                            <p class="font-semibold text-slate-900">${a.titulo} <span class="font-normal text-slate-600">(${a.falta})</span></p>
                            <p class="text-sm text-slate-700">${a.descripcion}</p>
                            <p class="text-xs text-slate-500">Anota: ${a.docente}</p>
                        </div>
                        <button type="button" onclick="abrirFirmaModal(${a.id})" class="min-h-[44px] px-4 py-2 rounded-lg bg-amber-700 hover:bg-amber-800 text-white font-semibold text-sm inline-flex items-center gap-2 shrink-0">
                            <i class="ph ph-signature text-base" aria-hidden="true"></i>
                            <span>Firmar</span>
                        </button>
                    </div>
                </li>`;
            }).join('');

            const academicas = pendientes.filter(a => a.tipo === 'A').length;
            const convivencia = pendientes.filter(a => a.tipo === 'C').length;
            document.getElementById('informe-count-academicas').textContent = academicas;
            document.getElementById('informe-count-convivencia').textContent = convivencia;

            actualizarEstadoInforme();
        }

        function actualizarEstadoInforme() {
            const hayDatos = estadoActual !== 'empty';
            const pendientes = hayDatos ? anotacionesData.filter(a => !a.firmada) : [];
            const total = pendientes.length;

            document.getElementById('informe-pendientes-total').textContent = total;
            document.getElementById('informe-pendientes-total-2').textContent = total;

            document.getElementById('informe-gate-pendiente').classList.toggle('hidden', total === 0);
            document.getElementById('informe-firmas-ok').classList.toggle('hidden', total > 0);
            document.getElementById('informe-estado-bloqueado').classList.toggle('hidden', total === 0);
            document.getElementById('informe-estado-contenido').classList.toggle('hidden', total > 0);

            const chip = document.getElementById('informe-estado-chip');
            const chipTexto = document.getElementById('informe-estado-chip-text');
            const chipDot = document.getElementById('informe-estado-dot');
            if (total > 0) {
                chip.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-amber-800';
                chipTexto.textContent = 'Bloqueado';
                chipDot.className = 'w-1.5 h-1.5 rounded-full bg-amber-500';
            } else {
                chip.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-800';
                chipTexto.textContent = 'Disponible';
                chipDot.className = 'w-1.5 h-1.5 rounded-full bg-emerald-600';
            }

            const bannerTexto = document.getElementById('informe-firmas-ok').querySelector('p');
            bannerTexto.textContent = hayDatos
                ? 'Oficializaste la firma de todas las anotaciones académicas y de convivente. Ya puedes consultar tu estado académico.'
                : 'No tienes anotaciones académicas ni de convivencia registradas en el periodo. Puedes consultar tu estado académico.';

            if (total === 0) {
                renderSabanaNotas();
            }
        }

        function renderSabanaNotas() {
            const tbody = document.getElementById('sabana-notas-tbody');
            let suma = 0;
            let enBasico = 0;

            tbody.innerHTML = notasData.map(n => {
                const promedio = (n.p1 + n.p2 + n.p3) / 3;
                const meta = DESEMPENO_META[desempenoDe(promedio)];
                suma += promedio;
                if (desempenoDe(promedio) === 'basico' || desempenoDe(promedio) === 'bajo') {
                    enBasico++;
                }

                const claseNota = nota => {
                    if (nota < 3.0) return 'text-red-700 font-bold';
                    if (nota < 4.0) return 'text-amber-800 font-semibold';
                    return 'text-slate-900 font-semibold';
                };

                return `<tr class="group hover:bg-slate-50">
                    <td class="sticky left-0 z-10 bg-white group-hover:bg-slate-50 px-4 py-3 font-semibold text-slate-900 whitespace-nowrap">${n.materia}</td>
                    <td class="px-3 py-3 text-center ${claseNota(n.p1)}">${n.p1.toFixed(1)}</td>
                    <td class="px-3 py-3 text-center ${claseNota(n.p2)}">${n.p2.toFixed(1)}</td>
                    <td class="px-3 py-3 text-center ${claseNota(n.p3)}">${n.p3.toFixed(1)}</td>
                    <td class="px-3 py-3 text-center font-bold text-slate-900">${promedio.toFixed(1)}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold ${meta.clase}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current" aria-hidden="true"></span>
                            <span>${meta.etiqueta}</span>
                        </span>
                    </td>
                </tr>`;
            }).join('');

            document.getElementById('sabana-promedio').textContent = (suma / notasData.length).toFixed(1);
            document.getElementById('sabana-materias').textContent = notasData.length;
            document.getElementById('sabana-basico').textContent = enBasico;
        }

        function abrirFirmaModal(id) {
            const anot = anotacionesData.find(a => a.id === id);
            if (!anot) { return; }

            firmaAnotacionId = id;
            ultimoFocoFirma = document.activeElement;

            const meta = tipoAnotacionMeta(anot.tipo);
            document.getElementById('firmaResumen').innerHTML = `
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold ${meta.clase}">
                        <span class="w-1.5 h-1.5 rounded-full bg-current" aria-hidden="true"></span>
                        <span>${meta.etiqueta}</span>
                    </span>
                    <span class="text-xs font-semibold text-slate-600">Periodo ${anot.periodo}</span>
                    <span class="text-xs text-slate-600 font-mono">${formatoFechaTarea(anot.fecha)}</span>
                </div>
                <p class="font-semibold text-slate-900">${anot.titulo} <span class="font-normal text-slate-600">(${anot.falta})</span></p>
                <p class="text-slate-700">${anot.descripcion}</p>
                <p class="text-xs text-slate-500">Anota: ${anot.docente}</p>`;

            document.getElementById('firmaPaso1').classList.remove('hidden');
            document.getElementById('firmaPaso2').classList.add('hidden');
            document.getElementById('firmaCodigo').value = '';
            document.getElementById('firmaCodigoError').classList.add('hidden');

            const modal = document.getElementById('firmaModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.querySelector('#firmaPaso1 button').focus();
        }

        function cerrarFirmaModal() {
            const modal = document.getElementById('firmaModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            firmaAnotacionId = null;

            if (ultimoFocoFirma && document.contains(ultimoFocoFirma)) {
                ultimoFocoFirma.focus();
            } else if (!document.getElementById('informe-gate-pendiente').classList.contains('hidden')) {
                document.getElementById('heading-informe-gate').focus();
            }
            ultimoFocoFirma = null;
        }

        function enviarCodigoFirma() {
            document.getElementById('firmaPaso1').classList.add('hidden');
            document.getElementById('firmaPaso2').classList.remove('hidden');
            document.getElementById('firmaCodigoError').classList.add('hidden');
            document.getElementById('firmaCodigo').value = '';
            document.getElementById('firmaCodigo').focus();
            announceFeedback('Código de confirmación enviado');
        }

        function confirmarFirma() {
            const input = document.getElementById('firmaCodigo');
            const error = document.getElementById('firmaCodigoError');

            if (input.value.trim() !== '1234') {
                error.classList.remove('hidden');
                input.focus();
                return;
            }

            const anot = anotacionesData.find(a => a.id === firmaAnotacionId);
            if (anot) {
                anot.firmada = true;
                anot.fechaFirma = new Date();
            }

            error.classList.add('hidden');
            cerrarFirmaModal();
            renderAnotacionesInforme();

            const todasFirmadas = anotacionesData.every(a => a.firmada);
            announceFeedback(todasFirmadas ? 'Todas las anotaciones fueron firmadas' : 'Anotación firmada correctamente');

            if (todasFirmadas) {
                document.getElementById('informe-firmas-ok').focus();
            } else {
                const siguiente = document.querySelector('#informe-lista-anotaciones button');
                if (siguiente) { siguiente.focus(); }
            }
        }

        function restablecerDemoFirmas() {
            anotacionesData.forEach(a => {
                a.firmada = false;
                a.fechaFirma = null;
            });

            if (estadoActual !== 'normal') {
                setSystemState('normal');
            } else {
                renderAnotacionesInforme();
            }

            announceFeedback('Demo restablecida: firmas pendientes');
        }

        function applyInformeState(state) {
            const errorBanner = document.getElementById('informe-error-banner');
            const loadingView = document.getElementById('informe-loading-view');
            const normalView = document.getElementById('informe-normal-view');

            errorBanner.classList.add('hidden');
            loadingView.classList.add('hidden');
            normalView.classList.add('hidden');

            if (state === 'loading') {
                loadingView.classList.remove('hidden');
                return;
            }
            if (state === 'error') {
                errorBanner.classList.remove('hidden');
                return;
            }

            normalView.classList.remove('hidden');
            renderAnotacionesInforme();
        }

        function retryInformeLoad() {
            setSystemState('loading');
            setTimeout(() => setSystemState('normal'), 1200);
        }

        // ============ VISTA: METAS, LOGROS, ACCIONES E INDICADORES ============
        const LOGROS_INDICADORES = [
            ['Explica los conceptos trabajados con ejemplos propios.', 'Aplica lo aprendido en ejercicios y situaciones nuevas.', 'Entrega las actividades completas y a tiempo.'],
            ['Participa activamente y sustenta sus respuestas.', 'Relaciona el tema con situaciones de su entorno.', 'Trabaja en equipo y respeta los acuerdos.'],
            ['Identifica los elementos principales del tema.', 'Resuelve problemas aplicando los pasos estudiados.', 'Sustenta sus conclusiones con argumentos claros.']
        ];

        const LOGROS_MATERIA = [
            {
                materia: 'Matemáticas',
                profesor: '[Docente: Matemáticas]',
                logros: [
                    'Resuelve operaciones con números enteros y fracciones.',
                    'Interpreta y representa datos en tablas y gráficas.',
                    'Aplica la proporcionalidad en la solución de problemas.',
                    'Reconoce propiedades de figuras y cuerpos geométricos.',
                    'Resuelve ecuaciones sencillas de primer grado.',
                    'Calcula medidas de tendencia central en situaciones cotidianas.'
                ]
            },
            {
                materia: 'Español',
                profesor: '[Docente: Español]',
                logros: [
                    'Comprende textos narrativos identificando sus elementos.',
                    'Produce textos con ortografía y puntuación adecuadas.',
                    'Analiza textos argumentativos y sus intenciones comunicativas.',
                    'Organiza sus ideas con conectores al escribir.',
                    'Interpreta textos líricos y reconoce figuras literarias.',
                    'Sustenta sus opiniones con argumentos y ejemplos.'
                ]
            },
            {
                materia: 'Ciencias Naturales',
                profesor: '[Docente: Ciencias Naturales]',
                logros: [
                    'Explica la función de los sistemas del cuerpo humano.',
                    'Clasifica seres vivos según sus características.',
                    'Analiza mezclas y soluciones en experimentos sencillos.',
                    'Describe el ciclo del agua y su importancia.',
                    'Relaciona la energía con el movimiento y los cambios.',
                    'Aplica normas de cuidado del medio ambiente.'
                ]
            },
            {
                materia: 'Ciencias Sociales',
                profesor: '[Docente: Ciencias Sociales]',
                logros: [
                    'Ubica regiones y relieve de Colombia en mapas.',
                    'Reconoce derechos y deberes en la vida escolar.',
                    'Explica causas y consecuencias de la época colonial.',
                    'Participa en las decisiones democráticas del aula.',
                    'Analiza problemáticas sociales de su entorno.',
                    'Propone acciones de convivencia y participación.'
                ]
            },
            {
                materia: 'Inglés',
                profesor: '[Docente: Inglés]',
                logros: [
                    'Se presenta y describe rutinas diarias en inglés.',
                    'Comprende vocabulario básico de la casa y la familia.',
                    'Usa el presente simple en oraciones cotidianas.',
                    'Lee y comprende textos cortos en inglés.',
                    'Narra experiencias en pasado con apoyo de imágenes.',
                    'Escribe mensajes breves con estructura correcta.'
                ]
            },
            {
                materia: 'Informática',
                profesor: '[Docente: Informática]',
                logros: [
                    'Utiliza la hoja de cálculo para organizar información.',
                    'Sigue instrucciones para resolver algoritmos básicos.',
                    'Diseña presentaciones digitales claras y creativas.',
                    'Aplica normas de ciudadanía digital y seguridad.',
                    'Organiza archivos y carpetas en el computador.',
                    'Resuelve problemas sencillos con secuencias lógicas.'
                ]
            },
            {
                materia: 'Educación Física',
                profesor: '[Docente: Educación Física]',
                logros: [
                    'Ejecuta rutinas de calentamiento y estiramiento.',
                    'Aplica fundamentos básicos del baloncesto.',
                    'Participa en juegos cooperativos respetando reglas.',
                    'Desarrolla capacidades físicas básicas.',
                    'Practica hábitos de higiene postural.',
                    'Muestra autocontrol en actividades competitivas.'
                ]
            },
            {
                materia: 'Artes',
                profesor: '[Docente: Artes]',
                logros: [
                    'Crea composiciones con material reciclado.',
                    'Observa y dibuja formas del entorno.',
                    'Explora el color, la textura y el ritmo en sus obras.',
                    'Expresa emociones a través del lenguaje artístico.',
                    'Elabora maquetas con materiales diversos.',
                    'Valora el trabajo artístico propio y de sus compañeros.'
                ]
            }
        ];

        const PERIODO_CLASES = {
            1: 'inline-flex items-center px-2.5 py-1 rounded-md bg-accent-50 border border-accent-600 text-accent-700 text-xs font-semibold whitespace-nowrap',
            2: 'inline-flex items-center px-2.5 py-1 rounded-md bg-violet-50 border border-violet-600 text-violet-800 text-xs font-semibold whitespace-nowrap',
            3: 'inline-flex items-center px-2.5 py-1 rounded-md bg-amber-50 border border-amber-600 text-amber-900 text-xs font-semibold whitespace-nowrap'
        };

        const logrosData = [];
        LOGROS_MATERIA.forEach((m, mi) => {
            m.logros.forEach((texto, i) => {
                logrosData.push({
                    id: `${mi}-${i}`,
                    materia: m.materia,
                    profesor: m.profesor,
                    periodo: Math.floor(i / 2) + 1,
                    logro: texto,
                    indicadores: LOGROS_INDICADORES[(mi + i) % LOGROS_INDICADORES.length]
                });
            });
        });

        let logrosFiltros = { materia: 'all', periodo: 'all', texto: '' };
        let logrosPagina = 1;
        const LOGROS_POR_PAGINA = 12;

        function getLogrosFiltrados() {
            const texto = logrosFiltros.texto.trim().toLowerCase();
            return logrosData.filter(l => {
                if (logrosFiltros.materia !== 'all' && l.materia !== logrosFiltros.materia) {
                    return false;
                }
                if (logrosFiltros.periodo !== 'all' && String(l.periodo) !== logrosFiltros.periodo) {
                    return false;
                }
                if (texto) {
                    const enLogro = l.logro.toLowerCase().includes(texto);
                    const enIndicadores = l.indicadores.join(' ').toLowerCase().includes(texto);
                    if (!enLogro && !enIndicadores) { return false; }
                }
                return true;
            });
        }

        function actualizarResumenFiltrosLogros() {
            const partes = [];
            if (logrosFiltros.materia !== 'all') { partes.push(`Asignatura: ${logrosFiltros.materia}`); }
            if (logrosFiltros.periodo !== 'all') { partes.push(`Periodo ${logrosFiltros.periodo}`); }
            if (logrosFiltros.texto.trim()) { partes.push(`Búsqueda: "${logrosFiltros.texto.trim()}"`); }

            document.getElementById('logros-filtros-activos').textContent = partes.length
                ? `Filtros activos — ${partes.join(' · ')}`
                : 'Sin filtros activos: se muestran todos los logros.';
        }

        function renderPaginacionLogros(totalPaginas) {
            const nav = document.getElementById('logros-paginacion-botones');
            const info = document.getElementById('logros-pagina-info');

            if (totalPaginas <= 1) {
                nav.classList.add('hidden');
                nav.innerHTML = '';
                if (info) { info.textContent = ''; }
                return;
            }
            nav.classList.remove('hidden');

            const base = 'min-h-[44px] inline-flex items-center justify-center gap-1 rounded-lg border text-sm font-semibold transition';
            const inactivo = 'bg-white border-slate-300 text-slate-800 hover:bg-slate-100';
            const activo = 'bg-accent-700 border-accent-700 text-white';

            let html = '';
            html += `<button type="button" onclick="irAPaginaLogros(${logrosPagina - 1})" ${logrosPagina === 1 ? 'disabled' : ''} aria-label="Página anterior" class="${base} ${inactivo} min-w-[44px] px-3 disabled:opacity-40 disabled:cursor-not-allowed">
                        <i class="ph ph-caret-left text-base" aria-hidden="true"></i>
                        <span class="hidden sm:inline">Anterior</span>
                    </button>`;

            for (let p = 1; p <= totalPaginas; p++) {
                html += `<button type="button" onclick="irAPaginaLogros(${p})" aria-label="Página ${p}" ${p === logrosPagina ? 'aria-current="page"' : ''} class="${base} ${p === logrosPagina ? activo : inactivo} min-w-[44px] px-2">${p}</button>`;
            }

            html += `<button type="button" onclick="irAPaginaLogros(${logrosPagina + 1})" ${logrosPagina === totalPaginas ? 'disabled' : ''} aria-label="Página siguiente" class="${base} ${inactivo} min-w-[44px] px-3 disabled:opacity-40 disabled:cursor-not-allowed">
                        <span class="hidden sm:inline">Siguiente</span>
                        <i class="ph ph-caret-right text-base" aria-hidden="true"></i>
                    </button>`;

            nav.innerHTML = html;
            if (info) { info.textContent = `Página ${logrosPagina} de ${totalPaginas}`; }
        }

        function renderLogrosPaginados() {
            const listado = document.getElementById('logros-listado');
            const filtrados = getLogrosFiltrados();
            const total = filtrados.length;

            // Group by subject to avoid repeating subject names per period
            const materias = [...new Set(filtrados.map(l => l.materia))];
            // 2 subjects per page = 12 logros (6 logros per subject)
            const totalPaginas = Math.max(1, Math.ceil(materias.length / 2));

            if (logrosPagina > totalPaginas) {
                logrosPagina = totalPaginas;
            }

            const start = (logrosPagina - 1) * 2;
            const pageMaterias = materias.slice(start, start + 2);

            // Show all logros for the subjects on this page
            const pagina = filtrados.filter(l => pageMaterias.includes(l.materia));

            document.getElementById('logros-contador').textContent = total;
            document.getElementById('logros-pagina-info').textContent = total === 0 ? '0' : `Página ${logrosPagina} de ${totalPaginas}`;

            if (total === 0) {
                listado.innerHTML = '';
                document.getElementById('logros-empty-state').classList.remove('hidden');
                document.getElementById('logros-paginacion').classList.add('hidden');
                return;
            }

            document.getElementById('logros-empty-state').classList.add('hidden');
            document.getElementById('logros-paginacion').classList.remove('hidden');

            listado.innerHTML = pageMaterias.map(materia => {
                const materiaData = LOGROS_MATERIA.find(m => m.materia === materia);
                const materiaLogros = filtrados.filter(l => l.materia === materia);
                const periodos = [...new Set(materiaLogros.map(l => l.periodo))].sort((a, b) => a - b);

                let html = `
                    <article class="py-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">${materia}</h3>
                                <p class="text-xs text-slate-500">${materiaData ? materiaData.profesor : ''}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-start gap-6">
                `;

                periodos.forEach(periodo => {
                    const periodoLogros = materiaLogros.filter(l => l.periodo === periodo);
                    html += `
                        <div class="flex-1 min-w-[220px]">
                            <h4 class="text-xs font-semibold text-accent-700 uppercase tracking-wide mb-2 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-accent-600 flex-shrink-0"></span>
                                Periodo ${periodo}
                            </h4>
                            <div class="space-y-2">
                                ${periodoLogros.map(l => {
                                    const indicadores = l.indicadores.map(indicador => `
                                        <li class="flex items-start gap-2 text-xs text-slate-600">
                                            <span class="w-1 h-1 rounded-full bg-slate-400 mt-1.5 shrink-0" aria-hidden="true"></span>
                                            <span>${indicador}</span>
                                        </li>`).join('');
                                    return `
                                        <div class="py-1 space-y-1">
                                            <p class="text-sm font-semibold text-slate-900">${l.logro}</p>
                                            <ul class="space-y-0.5">${indicadores}</ul>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    `;
                });

                html += '</div></article>';
                return html;
            }).join('');

            renderPaginacionLogros(totalPaginas);
        }

        // RENDER PRINCIPAL: renderiza el listado de logros y la paginación
        function renderLogros() {
            renderLogrosPaginados();
        }

        function irAPaginaLogros(pagina) {
            const filtrados = getLogrosFiltrados();
            const materias = [...new Set(filtrados.map(l => l.materia))];
            const totalPaginas = Math.max(1, Math.ceil(materias.length / 2));
            if (pagina < 1 || pagina > totalPaginas || pagina === logrosPagina) {
                return;
            }

            logrosPagina = pagina;
            renderLogrosPaginados();

            const scroll = document.getElementById('logros-contenido');
            scroll.scrollTop = 0;

            announceFeedback(`Página ${logrosPagina} de ${totalPaginas}`);
        }



        function cambiarFiltroLogros() {
            logrosFiltros = {
                materia: document.getElementById('filtroLogroMateria').value,
                periodo: document.getElementById('filtroLogroPeriodo').value,
                texto: document.getElementById('filtroLogroTexto').value
            };

            logrosPagina = 1;
            actualizarResumenFiltrosLogros();

            if (estadoActual !== 'normal') {
                setSystemState('normal');
            } else {
                renderLogros();
            }

            announceFeedback('Filtros de logros actualizados');
        }

        function aplicarFiltrosLogros() {
            if (estadoActual === 'empty') {
                document.getElementById('logros-contenido').classList.add('hidden');
                document.getElementById('logros-empty-state').classList.remove('hidden');
                document.getElementById('logros-contador').textContent = '0';
                document.getElementById('logros-paginacion').classList.add('hidden');
                document.getElementById('logros-empty-title').textContent = 'No hay logros registrados';
                document.getElementById('logros-empty-text').textContent = 'Cuando tus docentes publiquen los logros del periodo, aparecerán en esta sección.';
                return;
            }
            renderLogros();
        }

        function limpiarFiltrosLogros() {
            document.getElementById('filtroLogroMateria').value = 'all';
            document.getElementById('filtroLogroPeriodo').value = 'all';
            document.getElementById('filtroLogroTexto').value = '';
            logrosFiltros = { materia: 'all', periodo: 'all', texto: '' };
            logrosPagina = 1;
            actualizarResumenFiltrosLogros();

            if (estadoActual !== 'normal') {
                setSystemState('normal');
            } else {
                renderLogros();
            }

            announceFeedback('Filtros de logros restablecidos');
        }

        function applyLogrosState(state) {
            const errorBanner = document.getElementById('logros-error-banner');
            const loadingView = document.getElementById('logros-loading-view');
            const normalView = document.getElementById('logros-normal-view');

            errorBanner.classList.add('hidden');
            loadingView.classList.add('hidden');
            normalView.classList.add('hidden');

            if (state === 'loading') {
                loadingView.classList.remove('hidden');
                return;
            }
            if (state === 'error') {
                errorBanner.classList.remove('hidden');
                return;
            }

            normalView.classList.remove('hidden');
            aplicarFiltrosLogros();
        }

        function retryLogrosLoad() {
            setSystemState('loading');
            setTimeout(() => setSystemState('normal'), 1200);
        }

        // ===================== VISTA: ESTADO DE CUENTA =====================
        const MESES_CUENTA = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        function fechaCuentaConOffset(offset, dia) {
            const base = new Date();
            return new Date(base.getFullYear(), base.getMonth() + offset, dia);
        }

        function formatoFechaCuenta(fecha) {
            return String(fecha.getDate()).padStart(2, '0') + '/' +
                String(fecha.getMonth() + 1).padStart(2, '0') + '/' +
                fecha.getFullYear();
        }

        function formatoMonedaCuenta(valor) {
            return '$' + new Intl.NumberFormat('es-CO', { maximumFractionDigits: 0 }).format(valor);
        }

        // Datos demo: 9 causaciones de matrícula y pensiones (6 pagadas, 2 vencidas, 1 próxima).
        // Restaurante y transporte viven en la pestaña de servicios complementarios.
        const CUENTA_CAUSACIONES = (function () {
            const definicion = [
                [-10, 'Matrícula', 'Matrícula [AAAA]', 850000, 0, 850000, 'Matrícula del año en curso.'],
                [-9, 'Pensión', 'Pensión [MES]', 480000, 0, 480000, 'Pensión mensual.'],
                [-8, 'Pensión', 'Pensión [MES]', 480000, 24000, 456000, 'Pensión mensual con descuento por pronto pago.'],
                [-6, 'Pensión', 'Pensión [MES]', 480000, 0, 480000, 'Pensión mensual.'],
                [-5, 'Pensión', 'Pensión [MES]', 480000, 0, 480000, 'Pensión mensual.'],
                [-4, 'Pensión', 'Pensión [MES]', 480000, 0, 480000, 'Pensión mensual.'],
                [-2, 'Pensión', 'Pensión [MES]', 480000, 0, 200000, 'Pensión mensual.'],
                [-1, 'Pensión', 'Pensión [MES]', 480000, 0, 0, 'Pensión mensual.'],
                [1, 'Pensión', 'Pensión [MES]', 480000, 0, 0, 'Pensión del próximo periodo.']
            ];

            return definicion.map(function (fila, indice) {
                const offset = fila[0];
                const tipo = fila[1];
                const valor = fila[3];
                const descuento = fila[4];
                const pagado = fila[5];
                const nota = fila[6];
                const vence = fechaCuentaConOffset(offset, 10);
                const mes = MESES_CUENTA[vence.getMonth()];
                const anio = vence.getFullYear();
                const descripcion = fila[2] === 'Matrícula [AAAA]'
                    ? 'Matrícula ' + anio
                    : (fila[2] === 'Pensión [MES]' ? 'Pensión ' + mes.toLowerCase() : fila[2]);

                const pagos = pagado > 0
                    ? [{ fecha: fechaCuentaConOffset(offset, 5), entidad: 'PSE - Banco [Entidad]', valor: pagado }]
                    : [];

                return {
                    id: 'c' + (indice + 1),
                    mes: mes,
                    anio: anio,
                    tipo: tipo,
                    descripcion: descripcion,
                    nota: nota,
                    valor: valor,
                    descuento: descuento,
                    obsDescuento: descuento > 0 ? 'Pronto pago (beca).' : '',
                    vence: vence,
                    pagos: pagos
                };
            });
        })();

        // Datos demo: servicios complementarios de los últimos 8 meses.
        // Restaurante: 5 meses pagados y 3 pendientes. Transporte: 3 pagados, 1 con abono parcial y 4 pendientes.
        const SERVICIOS_CAUSACIONES = (function () {
            const diasRestaurante = [20, 21, 19, 22, 20, 18, 21, 20];
            const valorRestaurante = 95000;
            const valorTransporte = 120000;
            const filas = [];

            for (let i = 0; i < 8; i++) {
                const offset = i - 7;
                const vence = fechaCuentaConOffset(offset, 25);
                const mes = MESES_CUENTA[vence.getMonth()];
                const anio = vence.getFullYear();
                const fechaPago = fechaCuentaConOffset(offset, 5);

                // Restaurante: pagado hasta 5 meses atrás; pendientes los 3 más recientes.
                const pagosRestaurante = offset <= -3
                    ? [{ fecha: fechaPago, entidad: 'PSE - Banco [Entidad]', valor: valorRestaurante }]
                    : [];

                filas.push({
                    id: 's' + (filas.length + 1),
                    clave: 'restaurante',
                    tipo: 'Restaurante',
                    mes: mes,
                    anio: anio,
                    descripcion: 'Restaurante ' + diasRestaurante[i] + ' días',
                    nota: 'Almuerzo escolar facturado por día consumido.',
                    valor: valorRestaurante,
                    descuento: 0,
                    vence: vence,
                    pagos: pagosRestaurante
                });

                // Transporte: pagado completo hasta 4 meses atrás, abono parcial hace 3 meses y pendientes los 4 más recientes.
                let pagosTransporte = [];
                if (offset <= -5) {
                    pagosTransporte = [{ fecha: fechaPago, entidad: 'PSE - Banco [Entidad]', valor: valorTransporte }];
                } else if (offset === -4) {
                    pagosTransporte = [{ fecha: fechaPago, entidad: 'PSE - Banco [Entidad]', valor: 60000 }];
                }

                filas.push({
                    id: 's' + (filas.length + 1),
                    clave: 'transporte',
                    tipo: 'Transporte',
                    mes: mes,
                    anio: anio,
                    descripcion: 'Servicio de transporte',
                    nota: 'Ruta escolar contratada para el periodo.',
                    valor: valorTransporte,
                    descuento: 0,
                    vence: vence,
                    pagos: pagosTransporte
                });
            }

            return filas;
        })();

        const CUENTA_ESTADO_META = {
            pagado: {
                etiqueta: 'Pagado',
                chip: 'text-emerald-800',
                punto: 'bg-emerald-600',
                celda: ''
            },
            pendiente: {
                etiqueta: 'Pendiente',
                chip: 'text-slate-600',
                punto: 'bg-slate-400',
                celda: ''
            },
            proximo: {
                etiqueta: 'Próximo a vencer',
                chip: 'text-amber-800',
                punto: 'bg-amber-500',
                celda: ''
            },
            vencido: {
                etiqueta: 'Vencido',
                chip: 'text-red-700',
                punto: 'bg-red-600',
                celda: ''
            }
        };

        let cuentaFiltros = { texto: '', estado: 'all' };
        let ultimoFocoPago = null;
        let cuentaTabActiva = 'general';
        let serviciosSeleccion = new Set();
        let pagoContexto = 'general';

        function saldoCausacion(c) {
            return c.valor - c.descuento - c.pagos.reduce((suma, pago) => suma + pago.valor, 0);
        }

        function estadoCausacion(c) {
            if (saldoCausacion(c) <= 0) { return 'pagado'; }
            const hoy = new Date();
            hoy.setHours(0, 0, 0, 0);
            const dias = Math.round((c.vence - hoy) / 86400000);
            if (dias < 0) { return 'vencido'; }
            if (dias <= 25) { return 'proximo'; }
            return 'pendiente';
        }

        function getCuentaTodas() {
            return estadoActual === 'empty' ? [] : CUENTA_CAUSACIONES;
        }

        function getCuentaFiltradas() {
            const texto = cuentaFiltros.texto.trim().toLowerCase();
            return getCuentaTodas().filter(function (c) {
                if (cuentaFiltros.estado !== 'all' && estadoCausacion(c) !== cuentaFiltros.estado) {
                    return false;
                }
                if (texto) {
                    const contenido = (c.descripcion + ' ' + c.tipo + ' ' + c.mes + ' ' + c.nota).toLowerCase();
                    if (contenido.indexOf(texto) === -1) { return false; }
                }
                return true;
            });
        }

        // ---- Pestañas: Estado de cuenta / Pagos restaurante y transporte ----
        const CUENTA_TAB_META = {
            general: {
                etiqueta: 'Estado de cuenta',
                panel: 'panel-cuenta-general',
                anuncio: 'Mostrando estado de cuenta'
            },
            servicios: {
                etiqueta: 'Pagos restaurante y transporte',
                panel: 'panel-cuenta-servicios',
                anuncio: 'Mostrando pagos de restaurante y transporte'
            }
        };

        const SERVICIO_TIPO_META = {
            restaurante: {
                icono: 'ph-fork-knife',
                badge: 'bg-emerald-50 border-emerald-600 text-emerald-900'
            },
            transporte: {
                icono: 'ph-bus',
                badge: 'bg-accent-50 border-accent-600/40 text-accent-700'
            }
        };

        function showCuentaPanel(tab) {
            Object.keys(CUENTA_TAB_META).forEach(function (clave) {
                const meta = CUENTA_TAB_META[clave];
                const activo = clave === tab;
                const panel = document.getElementById(meta.panel);
                const boton = document.getElementById('tab-cuenta-' + clave);

                panel.classList.toggle('hidden', !activo);
                boton.setAttribute('aria-selected', activo ? 'true' : 'false');
                boton.tabIndex = activo ? 0 : -1;

                if (activo) {
                    boton.classList.add('text-accent-700', 'font-semibold', 'border-accent-600');
                    boton.classList.remove('text-slate-600', 'font-medium', 'border-transparent');
                } else {
                    boton.classList.remove('text-accent-700', 'font-semibold', 'border-accent-600');
                    boton.classList.add('text-slate-600', 'font-medium', 'border-transparent');
                }
            });
        }

        function selectCuentaTab(tab) {
            if (!CUENTA_TAB_META[tab]) { return; }
            cuentaTabActiva = tab;
            showCuentaPanel(tab);

            if (tab === 'servicios') {
                renderServiciosCuenta();
            }

            if (typeof scheduleScrollHintRefresh === 'function') { scheduleScrollHintRefresh(); }
            announceFeedback(CUENTA_TAB_META[tab].anuncio);
        }

        // Navegación con teclado entre las pestañas de Cuenta y pagos (WCAG)
        (function initCuentaTabs() {
            const lista = document.getElementById('cuentaTabs');
            if (!lista) { return; }
            const tabs = Array.from(lista.querySelectorAll('[role="tab"]'));
            lista.addEventListener('keydown', function (e) {
                const actual = tabs.indexOf(document.activeElement);
                if (actual < 0) { return; }
                let destino = -1;
                if (e.key === 'ArrowRight') { destino = (actual + 1) % tabs.length; }
                else if (e.key === 'ArrowLeft') { destino = (actual - 1 + tabs.length) % tabs.length; }
                else if (e.key === 'Home') { destino = 0; }
                else if (e.key === 'End') { destino = tabs.length - 1; }
                if (destino >= 0) {
                    e.preventDefault();
                    tabs[destino].focus();
                    tabs[destino].click();
                }
            });
        })();

        // ---- Servicios complementarios ----
        function getServiciosTodas() {
            return estadoActual === 'empty' ? [] : SERVICIOS_CAUSACIONES;
        }

        function getServiciosSeleccionados() {
            return getServiciosTodas().filter(function (c) {
                return serviciosSeleccion.has(c.id) && saldoCausacion(c) > 0;
            });
        }

        function toggleServicioSeleccion(id, checked, origenId) {
            const fila = SERVICIOS_CAUSACIONES.find(function (c) { return c.id === id; });
            if (!fila) { return; }

            const mismosPendientes = SERVICIOS_CAUSACIONES.filter(function (c) {
                return c.clave === fila.clave && saldoCausacion(c) > 0;
            });

            if (checked) {
                // Al marcar un mes se habilitan los meses anteriores del mismo servicio.
                mismosPendientes.forEach(function (c) {
                    if (c.vence <= fila.vence) { serviciosSeleccion.add(c.id); }
                });
            } else {
                // Al desmarcar un mes se desmarcan los meses posteriores del mismo servicio.
                mismosPendientes.forEach(function (c) {
                    if (c.vence >= fila.vence) { serviciosSeleccion.delete(c.id); }
                });
            }

            renderServiciosCuenta(origenId);
        }

        function seleccionarTodosServicios() {
            const pendientes = getServiciosTodas().filter(function (c) { return saldoCausacion(c) > 0; });
            if (pendientes.length === 0) { return; }

            const todosMarcados = pendientes.every(function (c) { return serviciosSeleccion.has(c.id); });

            if (todosMarcados) {
                serviciosSeleccion.clear();
            } else {
                pendientes.forEach(function (c) { serviciosSeleccion.add(c.id); });
            }

            renderServiciosCuenta();
        }

        function renderServiciosCuenta(focoId) {
            const todas = getServiciosTodas();

            let facturado = 0;
            let pagosTotal = 0;
            todas.forEach(function (c) {
                facturado += c.valor;
                pagosTotal += c.pagos.reduce(function (suma, pago) { return suma + pago.valor; }, 0);
            });
            const saldo = facturado - pagosTotal;

            document.querySelectorAll('[data-servicios-total="facturado"]').forEach(function (el) { el.textContent = formatoMonedaCuenta(facturado); });
            document.querySelectorAll('[data-servicios-total="pagos"]').forEach(function (el) { el.textContent = formatoMonedaCuenta(pagosTotal); });
            document.querySelectorAll('[data-servicios-total="saldo"]').forEach(function (el) { el.textContent = formatoMonedaCuenta(saldo); });

            // Estado general
            const pendientes = todas.filter(function (c) { return saldoCausacion(c) > 0; });
            let estadoGeneral = 'aldia';
            if (pendientes.some(function (c) { return estadoCausacion(c) === 'vencido'; })) { estadoGeneral = 'vencido'; }
            else if (pendientes.some(function (c) { return estadoCausacion(c) === 'proximo'; })) { estadoGeneral = 'proximo'; }
            else if (pendientes.length > 0) { estadoGeneral = 'pendiente'; }
            else if (todas.length === 0) { estadoGeneral = 'vacio'; }

            const chip = document.getElementById('servicios-estado-chip');
            const chipTexto = document.getElementById('servicios-estado-texto');
            const chipIcono = document.getElementById('servicios-estado-icono');
            const chipBase = 'inline-flex items-center gap-1.5 text-xs font-semibold ';
            if (estadoGeneral === 'aldia') {
                chip.className = chipBase + 'text-emerald-800';
                chipTexto.textContent = 'Al día'; chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-emerald-600';
            } else if (estadoGeneral === 'vencido') {
                chip.className = chipBase + 'text-red-700';
                chipTexto.textContent = 'Pagos vencidos'; chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-red-600';
            } else if (estadoGeneral === 'proximo') {
                chip.className = chipBase + 'text-amber-800';
                chipTexto.textContent = 'Pago próximo a vencer'; chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-amber-500';
            } else if (estadoGeneral === 'vacio') {
                chip.className = chipBase + 'text-slate-600';
                chipTexto.textContent = 'Sin servicios'; chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-slate-400';
            } else {
                chip.className = chipBase + 'text-slate-600';
                chipTexto.textContent = 'Pendiente de pago'; chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-slate-400';
            }

            const contador = document.getElementById('servicios-contador');
            if (contador) { contador.textContent = todas.length; }

            const vacio = todas.length === 0;
            const tablaWrap = document.getElementById('servicios-tabla-wrap');
            const empty = document.getElementById('servicios-empty');
            if (tablaWrap) { tablaWrap.classList.toggle('hidden', vacio); }
            if (empty) { empty.classList.toggle('hidden', !vacio); }

            // Tabla de causaciones
            const tbody = document.getElementById('servicios-tbody');
            if (tbody) {
                tbody.innerHTML = todas.map(function (c) {
                    const totalPagos = c.pagos.reduce(function (suma, pago) { return suma + pago.valor; }, 0);
                    const meta = CUENTA_ESTADO_META[estadoCausacion(c)];
                    const pagosCell = totalPagos > 0
                        ? '<span class="font-semibold text-emerald-800">' + formatoMonedaCuenta(totalPagos) + '</span>'
                        : '<span class="text-slate-400">—</span>';
                    return '<tr class="align-top hover:bg-slate-50/70">' +
                        '<td class="px-4 py-3 text-slate-700">' + c.tipo + '</td>' +
                        '<td class="px-4 py-3 whitespace-nowrap"><p class="font-semibold text-slate-900">' + c.mes + '</p><p class="text-xs text-slate-500">' + c.anio + '</p></td>' +
                        '<td class="px-4 py-3 text-slate-700">' +
                            '<p>' + c.descripcion + '</p>' +
                            '<span class="mt-1 inline-flex items-center gap-1.5 text-[11px] font-semibold ' + meta.chip + '">' +
                                '<span class="w-1.5 h-1.5 rounded-full bg-current" aria-hidden="true"></span>' + meta.etiqueta +
                            '</span>' +
                        '</td>' +
                        '<td class="px-4 py-3 text-right font-semibold text-slate-900">' + formatoMonedaCuenta(c.valor) + '</td>' +
                        '<td class="px-4 py-3 text-right">' + pagosCell + '</td>' +
                    '</tr>';
                }).join('');
            }

            // Historial de pagos realizados
            const pagos = [];
            todas.forEach(function (c) {
                c.pagos.forEach(function (pago) {
                    pagos.push({ fecha: pago.fecha, tipo: c.tipo, mes: c.mes, anio: c.anio, valor: pago.valor });
                });
            });
            pagos.sort(function (a, b) { return b.fecha - a.fecha; });

            const pagosTbody = document.getElementById('servicios-pagos-tbody');
            const pagosEmpty = document.getElementById('servicios-pagos-empty');
            if (pagosTbody) {
                pagosTbody.innerHTML = pagos.map(function (p) {
                    return '<tr class="hover:bg-slate-50/70">' +
                        '<td class="px-4 py-3 whitespace-nowrap text-slate-700">' + formatoFechaCuenta(p.fecha) + '</td>' +
                        '<td class="px-4 py-3 text-slate-900">' + p.tipo + '</td>' +
                        '<td class="px-4 py-3 text-slate-700">' + p.mes + ' ' + p.anio + '</td>' +
                        '<td class="px-4 py-3 text-right font-semibold text-emerald-800">' + formatoMonedaCuenta(p.valor) + '</td>' +
                    '</tr>';
                }).join('');
            }
            if (pagosEmpty) { pagosEmpty.classList.toggle('hidden', pagos.length > 0); }
            if (pagosTbody && pagosTbody.parentElement) { pagosTbody.parentElement.classList.toggle('hidden', pagos.length === 0); }
        }

        function renderServiciosFilas(todas) {
            const tbody = document.getElementById('servicios-tbody');
            const cards = document.getElementById('servicios-cards');
            let filas = '';
            let tarjetas = '';

            todas.forEach(function (c) {
                const saldo = saldoCausacion(c);
                const pagado = c.valor - saldo;
                const estado = estadoCausacion(c);
                const meta = CUENTA_ESTADO_META[estado];
                const tipo = SERVICIO_TIPO_META[c.clave];
                const seleccionable = saldo > 0;
                const marcada = serviciosSeleccion.has(c.id);
                const ariaCheck = 'Seleccionar ' + c.tipo.toLowerCase() + ' de ' + c.mes + ' ' + c.anio;

                const checkTabla = seleccionable
                    ? '<label class="inline-flex items-center justify-center w-11 h-11 -m-3 cursor-pointer">' +
                        '<input type="checkbox" id="chk-servicio-' + c.id + '"' + (marcada ? ' checked' : '') + ' onchange="toggleServicioSeleccion(\'' + c.id + '\', this.checked, this.id)" class="h-5 w-5 rounded border-slate-400 text-accent-700 focus:ring-2 focus:ring-accent-600 cursor-pointer" aria-label="' + ariaCheck + '">' +
                      '</label>'
                    : '<i class="ph-fill ph-check-circle text-emerald-600 text-xl" aria-hidden="true"></i><span class="sr-only">Pagado</span>';

                const checkTarjeta = seleccionable
                    ? '<label class="inline-flex items-center gap-2 min-h-[44px] cursor-pointer">' +
                        '<input type="checkbox" id="chk-servicio-card-' + c.id + '"' + (marcada ? ' checked' : '') + ' onchange="toggleServicioSeleccion(\'' + c.id + '\', this.checked, this.id)" class="h-5 w-5 rounded border-slate-400 text-accent-700 focus:ring-2 focus:ring-accent-600 cursor-pointer" aria-label="' + ariaCheck + '">' +
                        '<span class="text-xs font-semibold text-slate-600">Seleccionar</span>' +
                      '</label>'
                    : '<i class="ph-fill ph-check-circle text-emerald-600 text-xl" aria-hidden="true"></i><span class="sr-only">Pagado</span>';

                const detallePagos = c.pagos.length
                    ? '<details class="mt-1">' +
                        '<summary class="cursor-pointer text-xs font-semibold text-accent-700">' + c.pagos.length + (c.pagos.length === 1 ? ' pago' : ' pagos') + '</summary>' +
                        '<ul class="mt-1 space-y-1 text-xs text-slate-600">' +
                            c.pagos.map(function (pago) {
                                return '<li>' + formatoFechaCuenta(pago.fecha) + ' · ' + pago.entidad + ' · ' + formatoMonedaCuenta(pago.valor) + '</li>';
                            }).join('') +
                        '</ul>' +
                      '</details>'
                    : '';

                filas += '<tr class="align-top ' + (marcada ? 'bg-accent-50/60 ' : '') + 'hover:bg-slate-50/70">' +
                    '<td class="px-4 py-4">' + checkTabla + '</td>' +
                    '<td class="px-5 py-4 whitespace-nowrap">' +
                        '<span class="inline-flex items-center gap-2 font-semibold text-slate-900">' +
                            '<i class="ph ' + tipo.icono + ' text-base" aria-hidden="true"></i>' + c.tipo +
                        '</span>' +
                    '</td>' +
                    '<td class="px-5 py-4 whitespace-nowrap">' +
                        '<p class="font-semibold text-slate-900">' + c.mes + '</p>' +
                        '<p class="text-xs text-slate-500">' + c.anio + '</p>' +
                    '</td>' +
                    '<td class="px-5 py-4 ' + meta.celda + '">' +
                        '<div class="flex items-start gap-2.5">' +
                            '<span class="mt-1.5 h-2.5 w-2.5 rounded-sm border shrink-0 ' + meta.punto + '" aria-hidden="true"></span>' +
                            '<div>' +
                                '<p class="font-semibold text-slate-900">' + c.descripcion + '</p>' +
                                '<span class="mt-1 inline-flex items-center px-2 py-0.5 rounded border text-xs font-semibold ' + meta.chip + '">' + meta.etiqueta + '</span>' +
                            '</div>' +
                        '</div>' +
                    '</td>' +
                    '<td class="px-5 py-4 text-right font-semibold text-slate-900 whitespace-nowrap">' + formatoMonedaCuenta(c.valor) + '</td>' +
                    '<td class="px-5 py-4 text-right text-slate-700">' +
                        '<p class="font-semibold text-emerald-800">' + formatoMonedaCuenta(pagado) + '</p>' +
                        detallePagos +
                    '</td>' +
                    '<td class="px-5 py-4 text-right font-bold whitespace-nowrap ' + (saldo > 0 ? 'text-slate-900' : 'text-emerald-800') + '">' + formatoMonedaCuenta(saldo) + '</td>' +
                '</tr>';

                tarjetas += '<article class="p-5 space-y-4 ' + (marcada ? 'bg-accent-50/40' : '') + '">' +
                    '<div class="flex items-start justify-between gap-3">' +
                        '<div class="min-w-0">' +
                            '<p class="text-xs font-bold uppercase tracking-wider text-slate-500">' + c.mes + ' ' + c.anio + ' · ' + c.tipo + '</p>' +
                            '<p class="font-semibold text-slate-900">' + c.descripcion + '</p>' +
                            '<span class="mt-1 inline-flex items-center px-2 py-0.5 rounded border text-xs font-semibold ' + meta.chip + '">' + meta.etiqueta + '</span>' +
                        '</div>' +
                        '<div class="shrink-0">' + checkTarjeta + '</div>' +
                    '</div>' +
                    '<dl class="grid grid-cols-2 gap-2 text-sm">' +
                        '<div class="p-3 rounded-lg bg-slate-50 border border-slate-200"><dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Valor</dt><dd class="mt-0.5 font-semibold text-slate-900">' + formatoMonedaCuenta(c.valor) + '</dd></div>' +
                        '<div class="p-3 rounded-lg bg-slate-50 border border-slate-200"><dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pagos</dt><dd class="mt-0.5 font-semibold text-emerald-800">' + formatoMonedaCuenta(pagado) + '</dd></div>' +
                        '<div class="col-span-2 p-3 rounded-lg ' + (saldo > 0 ? 'bg-amber-50 border border-amber-300' : 'bg-emerald-50 border border-emerald-300') + '"><dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Saldo</dt><dd class="mt-0.5 font-bold text-slate-900">' + formatoMonedaCuenta(saldo) + '</dd></div>' +
                    '</dl>' +
                    '<div class="flex flex-wrap items-center justify-between gap-2 text-xs text-slate-600">' +
                        '<span>' + (saldo <= 0 && c.pagos.length
                            ? 'Pagado el ' + formatoFechaCuenta(c.pagos[c.pagos.length - 1].fecha)
                            : (estado === 'vencido' ? 'Venció el ' : 'Vence el ') + formatoFechaCuenta(c.vence)) + '</span>' +
                        '<span class="text-slate-500">' + c.nota + '</span>' +
                    '</div>' +
                    (c.pagos.length
                        ? '<details class="pt-1"><summary class="cursor-pointer text-xs font-semibold text-accent-700">Ver ' + c.pagos.length + (c.pagos.length === 1 ? ' pago' : ' pagos') + '</summary><ul class="mt-2 space-y-1 text-xs text-slate-600">' +
                            c.pagos.map(function (pago) {
                                return '<li>' + formatoFechaCuenta(pago.fecha) + ' · ' + pago.entidad + ' · ' + formatoMonedaCuenta(pago.valor) + '</li>';
                            }).join('') +
                          '</ul></details>'
                        : '') +
                '</article>';
            });

            tbody.innerHTML = filas;
            cards.innerHTML = tarjetas;
        }

        function pagarSolicitudServiciosDemo() {
            announceFeedback('[Demo: link de pago vigente abierto para servicios complementarios]');
        }

        function reciboBancoServiciosDemo() {
            announceFeedback('[Demo: recibo para pago presencial en banco generado]');
        }

        function renderEstadoCuenta() {
            const todas = getCuentaTodas();
            const filtradas = getCuentaFiltradas();

            let causado = 0;
            let descuentos = 0;
            let pagosTotal = 0;

            todas.forEach(function (c) {
                causado += c.valor;
                descuentos += c.descuento;
                pagosTotal += c.pagos.reduce(function (suma, pago) { return suma + pago.valor; }, 0);
            });

            const saldo = causado - descuentos - pagosTotal;

            document.querySelectorAll('[data-cuenta-total="causado"]').forEach(function (el) {
                el.textContent = formatoMonedaCuenta(causado);
            });
            document.querySelectorAll('[data-cuenta-total="descuentos"]').forEach(function (el) {
                el.textContent = formatoMonedaCuenta(descuentos);
            });
            document.querySelectorAll('[data-cuenta-total="pagos"]').forEach(function (el) {
                el.textContent = formatoMonedaCuenta(pagosTotal);
            });
            document.querySelectorAll('[data-cuenta-total="saldo"]').forEach(function (el) {
                el.textContent = formatoMonedaCuenta(saldo);
            });

            // Estado general de la cuenta
            const pendientes = todas.filter(function (c) { return saldoCausacion(c) > 0; });
            const estadosPendientes = pendientes.map(estadoCausacion);
            let estadoGeneral = 'aldia';
            if (estadosPendientes.indexOf('vencido') !== -1) {
                estadoGeneral = 'vencido';
            } else if (estadosPendientes.indexOf('proximo') !== -1) {
                estadoGeneral = 'proximo';
            } else if (estadosPendientes.length > 0) {
                estadoGeneral = 'pendiente';
            }

            const chip = document.getElementById('cuenta-estado-chip');
            const chipTexto = document.getElementById('cuenta-estado-texto');
            const chipIcono = document.getElementById('cuenta-estado-icono');

            if (estadoGeneral === 'aldia') {
                chip.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-800';
                chipTexto.textContent = 'Al día';
                chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-emerald-600';
            } else if (estadoGeneral === 'vencido') {
                chip.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-red-700';
                chipTexto.textContent = 'Pagos vencidos';
                chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-red-600';
            } else if (estadoGeneral === 'proximo') {
                chip.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-amber-800';
                chipTexto.textContent = 'Pago próximo a vencer';
                chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-amber-500';
            } else {
                chip.className = 'inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600';
                chipTexto.textContent = 'Pendiente de pago';
                chipIcono.className = 'w-1.5 h-1.5 rounded-full bg-slate-400';
            }

            const proximoVence = pendientes.slice().sort(function (a, b) { return a.vence - b.vence; })[0];
            document.getElementById('cuenta-vencimiento-texto').textContent = !proximoVence
                ? 'Sin fechas pendientes'
                : (estadoGeneral === 'vencido'
                    ? 'El pago más antiguo venció el ' + formatoFechaCuenta(proximoVence.vence)
                    : 'Vence el ' + formatoFechaCuenta(proximoVence.vence));

            // Acciones que dependen del saldo
            const haySaldo = saldo > 0;
            ['btnLinkPago', 'btnPagarPie'].forEach(function (id) {
                const boton = document.getElementById(id);
                if (boton) { boton.disabled = !haySaldo; }
            });
            document.getElementById('cuenta-acciones-ayuda').textContent = haySaldo
                ? 'Genera el recibo o el link de pago para el periodo pendiente más próximo.'
                : 'No tienes saldo pendiente. Puedes descargar tu recibo o consultar periodos anteriores.';

            // Contadores y estado vacío
            document.getElementById('cuenta-contador').textContent = filtradas.length;
            document.getElementById('cuenta-contador-total').textContent = todas.length;

            const vacio = filtradas.length === 0;
            document.getElementById('cuenta-movimientos').classList.toggle('hidden', vacio);
            document.getElementById('cuenta-causaciones-empty').classList.toggle('hidden', !vacio);

            if (vacio) {
                if (todas.length === 0) {
                    document.getElementById('cuenta-empty-titulo').textContent = 'No hay movimientos registrados';
                    document.getElementById('cuenta-empty-texto').textContent = 'Cuando se genere un movimiento para el periodo, aparecerá en esta sección.';
                } else {
                    document.getElementById('cuenta-empty-titulo').textContent = 'No hay movimientos para estos filtros';
                    document.getElementById('cuenta-empty-texto').textContent = 'Prueba con otro estado o restablece los filtros para ver todos los movimientos.';
                }
                document.getElementById('cuenta-empty-accion').classList.toggle('hidden', todas.length === 0);
            }

            renderCausacionesCuenta(filtradas);
            renderPagosCuenta(todas);
        }

        function renderCausacionesCuenta(filtradas) {
            const tbody = document.getElementById('cuenta-tbody');
            const cards = document.getElementById('cuenta-cards');
            let filas = '';
            let tarjetas = '';

            filtradas.forEach(function (c) {
                const saldo = saldoCausacion(c);
                const estado = estadoCausacion(c);
                const meta = CUENTA_ESTADO_META[estado];
                const totalPagos = c.pagos.reduce(function (suma, pago) { return suma + pago.valor; }, 0);

                const detallePagos = c.pagos.length
                    ? '<details class="mt-1">' +
                        '<summary class="cursor-pointer text-xs font-semibold text-accent-700">' + c.pagos.length + (c.pagos.length === 1 ? ' pago' : ' pagos') + '</summary>' +
                        '<ul class="mt-1 space-y-1 text-xs text-slate-600">' +
                            c.pagos.map(function (pago) {
                                return '<li>' + formatoFechaCuenta(pago.fecha) + ' · ' + pago.entidad + ' · ' + formatoMonedaCuenta(pago.valor) + '</li>';
                            }).join('') +
                        '</ul>' +
                      '</details>'
                    : '';

                const detalleDescuento = c.descuento
                    ? formatoMonedaCuenta(c.descuento) +
                      (c.obsDescuento
                        ? '<details class="mt-1"><summary class="cursor-pointer text-xs font-semibold text-accent-700">Motivo</summary><p class="mt-1 text-xs text-slate-600">' + c.obsDescuento + '</p></details>'
                        : '')
                    : '<span class="text-slate-400">—</span>';

                const estadoChip = '<span class="mt-1 inline-flex items-center gap-1.5 text-[11px] font-semibold ' + meta.chip + '">' +
                    '<span class="w-1.5 h-1.5 rounded-full bg-current" aria-hidden="true"></span>' + meta.etiqueta +
                '</span>';

                filas += '<tr class="align-top hover:bg-slate-50/70">' +
                    '<td class="px-4 py-3 whitespace-nowrap">' +
                        '<p class="font-semibold text-slate-900">' + c.mes + '</p>' +
                        '<p class="text-xs text-slate-500">' + c.anio + '</p>' +
                    '</td>' +
                    '<td class="px-4 py-3 text-slate-700">' + c.tipo + '</td>' +
                    '<td class="px-4 py-3">' +
                        '<p class="font-semibold text-slate-900">' + c.descripcion + '</p>' +
                        estadoChip +
                    '</td>' +
                    '<td class="px-4 py-3 text-right font-semibold text-slate-900">' + formatoMonedaCuenta(c.valor) + '</td>' +
                    '<td class="px-4 py-3 text-right text-slate-700">' + detalleDescuento + '</td>' +
                    '<td class="px-4 py-3 text-right text-slate-700">' +
                        '<p class="font-semibold text-emerald-800">' + formatoMonedaCuenta(totalPagos) + '</p>' +
                        detallePagos +
                    '</td>' +
                    '<td class="px-4 py-3 text-right font-bold ' + (saldo > 0 ? 'text-slate-900' : 'text-emerald-800') + '">' + formatoMonedaCuenta(saldo) + '</td>' +
                '</tr>';

                tarjetas += '<article class="py-4 space-y-3">' +
                    '<div class="min-w-0">' +
                        '<p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">' + c.mes + ' ' + c.anio + ' · ' + c.tipo + '</p>' +
                        '<p class="font-semibold text-slate-900">' + c.descripcion + '</p>' +
                        estadoChip +
                    '</div>' +
                    '<dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">' +
                        '<div><dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Valor</dt><dd class="mt-0.5 font-semibold text-slate-900">' + formatoMonedaCuenta(c.valor) + '</dd></div>' +
                        '<div><dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Descuento</dt><dd class="mt-0.5 font-semibold text-slate-900">' + formatoMonedaCuenta(c.descuento) + '</dd></div>' +
                        '<div><dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Pagos</dt><dd class="mt-0.5 font-semibold text-emerald-800">' + formatoMonedaCuenta(totalPagos) + '</dd></div>' +
                        '<div><dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Saldo</dt><dd class="mt-0.5 font-bold text-slate-900">' + formatoMonedaCuenta(saldo) + '</dd></div>' +
                    '</dl>' +
                    '<div class="flex flex-wrap items-center justify-between gap-2 text-xs text-slate-600">' +
                        '<span>' + (estado === 'pagado' && c.pagos.length
                            ? 'Pagado el ' + formatoFechaCuenta(c.pagos[c.pagos.length - 1].fecha)
                            : (estado === 'vencido' ? 'Venció el ' : 'Vence el ') + formatoFechaCuenta(c.vence)) + '</span>' +
                        '<span>' + (c.descuento && c.obsDescuento ? 'Descuento: ' + c.obsDescuento : '') + '</span>' +
                    '</div>' +
                    (c.pagos.length
                        ? '<details class="pt-1"><summary class="cursor-pointer text-xs font-semibold text-accent-700">Ver ' + c.pagos.length + (c.pagos.length === 1 ? ' pago' : ' pagos') + '</summary><ul class="mt-2 space-y-1 text-xs text-slate-600">' +
                            c.pagos.map(function (pago) {
                                return '<li>' + formatoFechaCuenta(pago.fecha) + ' · ' + pago.entidad + ' · ' + formatoMonedaCuenta(pago.valor) + '</li>';
                            }).join('') +
                          '</ul></details>'
                        : '') +
                '</article>';
            });

            tbody.innerHTML = filas;
            cards.innerHTML = tarjetas;
        }

        function renderPagosCuenta(todas) {
            const tbody = document.getElementById('cuenta-pagos-tbody');
            const empty = document.getElementById('cuenta-pagos-empty');
            const pagos = [];

            todas.forEach(function (c) {
                c.pagos.forEach(function (pago) {
                    pagos.push({ fecha: pago.fecha, entidad: pago.entidad, valor: pago.valor, causacion: c.descripcion });
                });
            });

            pagos.sort(function (a, b) { return b.fecha - a.fecha; });

            tbody.innerHTML = pagos.map(function (pago) {
                return '<tr class="hover:bg-slate-50/70">' +
                    '<td class="px-4 py-3 whitespace-nowrap text-slate-700">' + formatoFechaCuenta(pago.fecha) + '</td>' +
                    '<td class="px-4 py-3 text-slate-900">' + pago.entidad + '<span class="block text-xs text-slate-500">' + pago.causacion + '</span></td>' +
                    '<td class="px-4 py-3 text-right font-semibold text-slate-900 whitespace-nowrap">' + formatoMonedaCuenta(pago.valor) + '</td>' +
                '</tr>';
            }).join('');

            const vacio = pagos.length === 0;
            empty.classList.toggle('hidden', !vacio);
            tbody.parentElement.parentElement.classList.toggle('hidden', vacio);
        }

        // Despliega/oculta el resumen de pagos (menú oculto por defecto)
        function toggleResumenPagos() {
            const panel = document.getElementById('resumen-pagos-panel');
            const boton = document.getElementById('btn-toggle-resumen');
            const caret = document.getElementById('resumen-pagos-caret');
            const abierto = !panel.classList.contains('hidden');
            panel.classList.toggle('hidden', abierto);
            boton.setAttribute('aria-expanded', abierto ? 'false' : 'true');
            caret.classList.toggle('rotate-180', !abierto);
            if (!abierto) {
                announceFeedback('Resumen de pagos desplegado');
            }
        }


        function cambiarFiltroCuenta() {
            cuentaFiltros = {
                texto: document.getElementById('filtroCuentaTexto').value,
                estado: document.getElementById('filtroCuentaEstado').value
            };

            renderEstadoCuenta();
        }

        function limpiarFiltrosCuenta() {
            document.getElementById('filtroCuentaTexto').value = '';
            document.getElementById('filtroCuentaEstado').value = 'all';
            cuentaFiltros = { texto: '', estado: 'all' };
            renderEstadoCuenta();
            announceFeedback('Filtros del estado de cuenta restablecidos');
        }

        function abrirModalPago(contexto) {
            pagoContexto = contexto === 'servicios' ? 'servicios' : 'general';

            const subtitulo = document.getElementById('pagoModalSubtitulo');
            const wrapSoloRecibo = document.getElementById('pagoSoloReciboWrap');
            const soloRecibo = document.getElementById('pagoSoloRecibo');

            if (pagoContexto === 'servicios') {
                const seleccionadas = getServiciosSeleccionados();

                if (seleccionadas.length === 0) {
                    announceFeedback('Selecciona al menos un mes de servicios para crear el pago');
                    return;
                }

                const total = seleccionadas.reduce(function (suma, c) { return suma + saldoCausacion(c); }, 0);
                const filas = seleccionadas.map(function (c) {
                    return '<li class="flex items-start justify-between gap-3 py-1.5">' +
                        '<span class="text-slate-700">' + c.tipo + ' · ' + c.mes + ' ' + c.anio + ' · vence ' + formatoFechaCuenta(c.vence) + '</span>' +
                        '<span class="font-semibold text-slate-900 whitespace-nowrap">' + formatoMonedaCuenta(saldoCausacion(c)) + '</span>' +
                    '</li>';
                }).join('');

                document.getElementById('pagoModalResumen').innerHTML =
                    '<p class="text-xs font-bold uppercase tracking-wider text-slate-500">Servicios seleccionados</p>' +
                    '<ul class="mt-2 divide-y divide-slate-200 text-sm">' + filas + '</ul>' +
                    '<p class="mt-3 flex items-center justify-between gap-3 border-t border-slate-300 pt-3 text-sm font-bold text-slate-900">' +
                        '<span>Total a pagar</span><span>' + formatoMonedaCuenta(total) + '</span>' +
                    '</p>';

                subtitulo.textContent = 'Servicios complementarios · Restaurante y transporte';
                wrapSoloRecibo.classList.remove('hidden');
                wrapSoloRecibo.classList.add('flex');
                soloRecibo.checked = false;
            } else {
                const pendientes = getCuentaTodas().filter(function (c) { return saldoCausacion(c) > 0; });

                if (pendientes.length === 0) {
                    announceFeedback('No tienes saldo pendiente para pagar');
                    return;
                }

                const total = pendientes.reduce(function (suma, c) { return suma + saldoCausacion(c); }, 0);
                const filas = pendientes.map(function (c) {
                    return '<li class="flex items-start justify-between gap-3 py-1.5">' +
                        '<span class="text-slate-700">' + c.descripcion + ' · vence ' + formatoFechaCuenta(c.vence) + '</span>' +
                        '<span class="font-semibold text-slate-900 whitespace-nowrap">' + formatoMonedaCuenta(saldoCausacion(c)) + '</span>' +
                    '</li>';
                }).join('');

                document.getElementById('pagoModalResumen').innerHTML =
                    '<p class="text-xs font-bold uppercase tracking-wider text-slate-500">Periodos pendientes</p>' +
                    '<ul class="mt-2 divide-y divide-slate-200 text-sm">' + filas + '</ul>' +
                    '<p class="mt-3 flex items-center justify-between gap-3 border-t border-slate-300 pt-3 text-sm font-bold text-slate-900">' +
                        '<span>Total a pagar</span><span>' + formatoMonedaCuenta(total) + '</span>' +
                    '</p>';

                subtitulo.textContent = 'Pago en línea por PSE · Periodo [AAAA]';
                wrapSoloRecibo.classList.add('hidden');
                wrapSoloRecibo.classList.remove('flex');
                soloRecibo.checked = false;
            }

            actualizarBotonPago();

            ultimoFocoPago = (document.activeElement && document.activeElement !== document.body)
                ? document.activeElement
                : document.getElementById(pagoContexto === 'servicios' ? 'btnPagarServicios' : 'btnLinkPago');
            const modal = document.getElementById('pagoModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.getElementById('pagoDocumento').focus({ preventScroll: true });
        }

        function actualizarBotonPago() {
            const soloRecibo = pagoContexto === 'servicios' && document.getElementById('pagoSoloRecibo').checked;
            document.getElementById('pagoBotonTexto').textContent = soloRecibo ? 'Generar recibo para banco' : 'Continuar al pago';
            document.getElementById('pagoBotonIcono').className = soloRecibo ? 'ph ph-file-pdf text-lg' : 'ph ph-arrow-square-out text-lg';
            document.getElementById('pagoAvisoTexto').textContent = soloRecibo
                ? 'Se generará el recibo para pago presencial. Llévalo al banco para realizar el pago; el abono se verá reflejado hasta 24 horas después.'
                : 'Recuerda que el pago se verá reflejado en el estado de cuenta hasta 24 horas después de ser efectivo. Al continuar serás redirigido a la pasarela PSE.';
        }

        function cerrarModalPago() {
            const modal = document.getElementById('pagoModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            if (ultimoFocoPago && document.contains(ultimoFocoPago)) {
                ultimoFocoPago.focus();
            }
            ultimoFocoPago = null;
        }

        function continuarPagoDemo() {
            const contexto = pagoContexto;
            const soloRecibo = contexto === 'servicios' && document.getElementById('pagoSoloRecibo').checked;

            cerrarModalPago();

            if (soloRecibo) {
                announceFeedback('[Demo: recibo para pago presencial en banco generado]');
            } else if (contexto === 'servicios') {
                announceFeedback('[Demo: link de pago PSE generado para los servicios seleccionados]');
            } else {
                announceFeedback('[Demo: link de pago PSE generado para el periodo pendiente]');
            }
        }

        function descargarReciboDemo() {
            announceFeedback('[Demo: descarga del recibo PDF del periodo pendiente]');
        }

        function periodosAnterioresDemo() {
            announceFeedback('[Demo: consulta de pagos de periodos anteriores]');
        }

        function reciboAnualizadoDemo() {
            announceFeedback('[Demo: descarga del recibo para pago anualizado]');
        }

        function applyEstadoCuentaState(state) {
            const errorBanner = document.getElementById('estadoCuenta-error-banner');
            const loadingView = document.getElementById('estadoCuenta-loading-view');
            const normalView = document.getElementById('estadoCuenta-normal-view');

            errorBanner.classList.add('hidden');
            loadingView.classList.add('hidden');
            normalView.classList.add('hidden');

            if (state === 'loading') {
                loadingView.classList.remove('hidden');
                return;
            }
            if (state === 'error') {
                errorBanner.classList.remove('hidden');
                return;
            }

            normalView.classList.remove('hidden');
            renderEstadoCuenta();
            renderServiciosCuenta();
        }

        function retryEstadoCuentaLoad() {
            setSystemState('loading');
            setTimeout(function () { setSystemState('normal'); }, 1200);
        }

        // Cierre con Escape de los modales
        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') { return; }
            const firma = document.getElementById('firmaModal');
            if (!firma.classList.contains('hidden')) { cerrarFirmaModal(); }
            const carnet = document.getElementById('idCardModal');
            if (!carnet.classList.contains('hidden')) { closeModal(); }
            const pago = document.getElementById('pagoModal');
            if (!pago.classList.contains('hidden')) { cerrarModalPago(); }
        });

        // Inicializa informe, logros y estado de cuenta
        renderAnotacionesInforme();
        renderSabanaNotas();
        renderLogros();
        actualizarResumenFiltrosLogros();
        renderEstadoCuenta();
        renderServiciosCuenta();

        // Filtro de tabla
        function handleFilterChange(val) {
            const listContainer = document.getElementById('activity-list-container');
            const emptyState = document.getElementById('activity-empty-state');
            if (val === 'empty') {
                listContainer.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                listContainer.classList.remove('hidden');
                emptyState.classList.add('hidden');
            }
        }

        function resetFilters() {
            setSystemState('normal');
            announceFeedback('[Filtros restablecidos]');
        }

        // Modal accesible
        function openModal() {
            const modal = document.getElementById('idCardModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('idCardModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Anuncios accesibles (Toast)
        let toastTimer;
        function announceFeedback(text) {
            const region = document.getElementById('liveRegion');
            const label = document.getElementById('liveRegionText');
            label.textContent = text;
            region.classList.remove('hidden');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => {
                region.classList.add('hidden');
            }, 3000);
        }
    
</script>
<script>
// ============ VISTA: RESTAURANTE Y TRANSPORTE ============
const SERVICIOS_MOCK = [
    { id: 1, tipo: 'Restaurante', mes: 'Agosto', descripcion: 'Servicios de restaurante', valor: 215000, pagos: 0, activo: true },
    { id: 2, tipo: 'Transporte', mes: 'Agosto', descripcion: 'Servicios de transporte', valor: 175000, pagos: 0, activo: true },
    { id: 3, tipo: 'Restaurante', mes: 'Julio', descripcion: 'Servicios de restaurante', valor: 215000, pagos: 0, activo: true }
];

let serviciosSeleccionados = [];

function renderServicios() {
            // Alias seguro: delega en el render integrado de servicios.
            renderServiciosCuenta();
        }

function toggleServicioSelection(id) {
    const checkbox = document.getElementById(`servicio-${id}`);
    const isChecked = checkbox.checked;
    const servicio = SERVICIOS_MOCK.find(m => m.id === id);
    if (isChecked && !servicio.activo) {
        servicio.activo = true;
        checkbox.checked = true;
        renderServicios();
        actualizarResumenServicios();
    } else if (!isChecked && servicio.activo) {
        servicio.activo = false;
        checkbox.checked = false;
        const hayActivo = SERVICIOS_MOCK.some(m => m.activo);
        document.getElementById('btnPagarServicios').disabled = !hayActivo;
        renderServicios();
    }
}

function seleccionarServicios() {
    SERVICIOS_MOCK.forEach(m => {
        if (!m.activo) {
            m.activo = true;
            const checkbox = document.getElementById(`servicio-${m.id}`);
            if (checkbox) checkbox.checked = true;
        }
    });
    renderServicios();
    actualizarResumenServicios();
    document.getElementById('btnPagarServicios').disabled = false;
}

function actualizarResumenServicios() {
    const total = SERVICIOS_MOCK.reduce((sum, m) => sum + (m.activo ? m.valor : 0), 0);
    document.getElementById('servicios-seleccion-total').textContent = `$${total.toLocaleString()}`;
    
    const seleccionados = SERVICIOS_MOCK.filter(m => m.activo).length;
    document.getElementById('servicios-seleccion-conteo').textContent = `${seleccionados} ${seleccionados === 1 ? 'mes' : 'meses'} seleccionados`;
}

function pagarLinkServicio() {
    // Simula el pago del link vigente
    const alerta = document.getElementById('servicios-alertas');
    if (alerta) alerta.innerHTML = '<div class="flex items-start gap-3 p-4 rounded-lg bg-emerald-50 border border-emerald-600 text-amber-900"><i class="ph-fill ph-check-circle text-2xl text-emerald-700 shrink-0 mt-0.5"></i><div><h3 class="text-base font-bold text-amber-950">Pago confirmado</h3><p class="text-sm text-amber-900">El link de pago fue procesado correctamente.</p></div></div>';
    renderServicios();
}

function generarReciboBanco() {
    const alerta = document.getElementById('servicios-alertas');
    if (alerta) alerta.innerHTML = '<div class="flex items-start gap-3 p-4 rounded-lg bg-blue-50 border border-blue-600 text-blue-900"><i class="ph-fill ph-print text-2xl text-blue-700 shrink-0 mt-0.5"></i><div><h3 class="text-base font-bold text-blue-950">Recibo para banco</h3><p class="text-sm text-blue-900">Se ha generado un recibo para pago presencial.</p></div></div>';
    renderServicios();
}

function retryServiciosLoad() {
    setSystemState('loading');
    setTimeout(() => {
        setSystemState('normal');
        renderServicios();
    }, 1000);
}

// ============ Función para cambiar de pestaña ============

// ============ Estado de cuenta functions ============
// Ejecutar al cargar
renderServicios();
syncMobileNavForViewport();
initTableScrollHints();
showView('inicio');
</script>
</body>
</html>