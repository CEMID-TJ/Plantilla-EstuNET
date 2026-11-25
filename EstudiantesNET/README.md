# EstudiantesNET · Plantilla de diseño

Prototipo estático del portal del estudiante, construido con HTML, CSS y JavaScript sin lógica de negocio ni datos reales.

## Cómo abrir

Abre `index.html` en un navegador. No requiere servidor ni base de datos.

La plantilla usa tres dependencias de presentación desde CDN:

- Inter (tipografía)
- Phosphor Icons (iconografía)
- Tailwind CSS Play CDN (utilidades de apoyo)

El sistema visual principal está en `assets/css/styles.css` y las interacciones compartidas en `assets/js/app.js`.

## Vistas incluidas

| Archivo | Vista |
| --- | --- |
| `index.html` | Inicio |
| `alumno.html` | Información del alumno |
| `tareas.html` | Consulta de tareas |
| `informe.html` | Informe académico |
| `logros.html` | Metas y logros |
| `observador.html` | Observador del alumno |
| `circulares.html` | Circulares y comunicados |
| `pqrs.html` | PQRS |
| `bullying.html` | Denunciar bullying |
| `referidos.html` | Programa de referidos |
| `servicio-social.html` | Servicio social |
| `traslados.html` | Traslados de colegio |
| `historia-clinica.html` | Historia clínica |
| `cuenta.html` | Estado de cuenta |
| `matricula.html` | Proceso de matrícula |
| `carnet.html` | Carnet virtual |

### Vistas de componentes

- `modal-carnet.html`
- `modal-firma.html`
- `modal-pago.html`

Son vistas aisladas para revisar el diseño de los modales. En las páginas principales los modales se abren como capas sobre el contenido. El carnet giratorio está disponible de dos formas: en `modal-carnet.html` (vista aislada) y desde `carnet.html`, donde la tarjeta abre la modal interactiva; al pasar el mouse (o al enfocarla con el teclado) se oscurece y muestra «Ver carnet completo». En ambos casos el carnet se gira con un clic (o con `Enter`/`Espacio` si tiene el foco) para ver su reverso; el giro usa transformaciones 3D de CSS y no requiere librerías externas.

## Qué incluye

- Navegación lateral agrupada y adaptable.
- Barra de estados de prototipo: normal, cargando, vacío y error.
- Pestañas, filtros, paginación, modales, avisos y estados vacíos.
- Sistema visual con acentos sutiles: fondo de página ligeramente más frío, botones secundarios con tinte azul, estados en píldoras de color suave, encabezados de tabla tintados, líneas de tabla con mayor definición y barra de acento en los títulos de sección. La paleta sigue siendo contenida para no saturar la interfaz.
- Paginación unificada con barra fija (`position: fixed`) pegada al borde inferior de la pantalla, a todo el ancho del área de contenido y sin separación inferior. El mismo componente de `assets/js/app.js` se usa en todas las vistas con listas, de modo que la barra siempre está accesible, muestra «Mostrando X–Y de Z», permite navegar con anterior/siguiente y números, y vuelve a la página 1 al aplicar un filtro. En las vistas con pestañas (PQRS) la barra aparece al abrir la pestaña que contiene la lista.

  | Vista | Elementos | Por página | Páginas |
  | --- | --- | --- | --- |
  | `tareas.html` | 12 tareas | 4 | 3 |
  | `logros.html` | 6 asignaturas | 2 | 3 |
  | `observador.html` | 6 anotaciones | 5 | 2 |
  | `circulares.html` | 9 circulares | 5 | 2 |
  | `pqrs.html` | 5 solicitudes | 3 | 2 |
  | `cuenta.html` | 12 movimientos | 6 | 2 |
  | `servicio-social.html` | 3 programas | 2 | 2 |
  | `bullying.html` | 2 denuncias | 2 | 1 |
  | `referidos.html` | 4 referidos | 2 | 2 |

  Las vistas de ficha o formulario (`index.html`, `alumno.html`, `informe.html`, `matricula.html`, `traslados.html`, `historia-clinica.html`, `carnet.html`) no paginan porque no son listas de registros. `informe.html` es una sábana de notas que se lee completa y `index.html` es un resumen.

  Para paginar una lista nueva basta con marcar el contenedor y sus ítems; la barra se genera sola:

  ```html
  <section data-paginate data-per-page="5" data-page-label="Paginación de ...">
    <tr data-page-item>...</tr>
  </section>
  ```

  Los filtros deben marcar los ítems con `data-filtered="true"` y llamar a `window.EstuNET.refreshPagination(contenedor)` para reiniciar la página.

  Mientras el diseño está en desarrollo, `app.js` define `BUILD` y las páginas declaran `data-build` en `<html>`; si el navegador conserva una versión anterior, la plantilla se recarga con `?v=BUILD` y reescribe los enlaces internos para evitar caché. Al publicar una nueva versión basta con actualizar el valor de `BUILD` en `assets/js/app.js` y el atributo `data-build` de las páginas.
- Formularios de demostración con `required`, validación con `checkValidity()` y marcadores claros de campo obligatorio.
- Estados de carga con esqueletos (skeleton) específicos por vista. `loadingMarkup()` en `app.js` elige el esqueleto según `data-page` del `<body>`: inicio (hero, métricas y tabla), carnet (foto y datos), tareas, informe, observador y cuenta (tablas con distinto número de filas), logros (secciones con tres periodos), circulares (lista), PQRS, bullying, referidos, servicio social, historia clínica, matrícula y traslados (formularios y tarjetas). Los estilos viven en `styles.css` y se adaptan a una columna en móvil. Incluyen `role="status"`, texto accesible y una animación de brillo que respeta `prefers-reduced-motion`.
- Diseño responsive para escritorio, tableta y móvil: las acciones del encabezado, los filtros, los botones de formulario y la barra fija de paginación se centran en pantallas pequeñas. El carnet se centra y conserva su ancho máximo en tabletas. Las cuadrículas usan `minmax(0, 1fr)` para evitar desbordamientos horizontales.
- Estilos de impresión para el carnet.

## Qué no incluye

- Restaurante y transporte, por decisión de alcance del proyecto.
- Conexión con bases de datos, autenticación, pasarelas de pago o servicios reales.
- Datos personales reales. Los nombres, códigos y valores son ficticios.

## Correspondencia con campos de la base

Los nombres de columnas y encabezados siguen el proyecto funcional original (`C:\wamp64\www\EstudiantesNET`). Solo se muestran campos existentes; los valores son de demostración.

Para evitar duplicados, los datos del colegio se muestran una sola vez en `index.html` y el carnet digital solo en `carnet.html`. La ficha del alumno se limita a datos personales y familiares.

| Vista | Columnas / campos representados |
| --- | --- |
| `index.html` | `NomCole`, `CodCole`, `AnioActual`, `Jornada`, `Grado`, `Aula`, `FMatri`, `Estado`, correo institucional; resumen de actividad, próximos vencimientos y comunicados |
| `alumno.html` | `NomAlum`, `Ape1Alum`, `Ape2Alum`, `Cedula`, `TarjetaI`, `RegistroC`, `FNacio`, `Sexo`, `RH`, `EPS`, `LNacio`, `DeptoNacio`, `DirAlum`, `BarrAlum`, `Estrato`, `Sisben`, `TelAlum`, `Celular`, `Mail`, `NumHermanos`, `HermColeg`; familiares: `NomFami`, `Ape1Fami`, `Ape2Fami`, `Documento`, `FNacio`, `Telefono`, `Celular`, `ProfFami`, `EmpreFami`, `Mail` |
| `tareas.html` | `F.Apertura`, `Tipo` (`TAREA`, `GUIA-M.TRABAJO`, `RECUPERACION`, `REQUERIMIEN_OBS`), `Materia`, `Título`, `Descripción`, `F.Entrega` |
| `informe.html` | Sábana: `N°`, `Materia`, `CM`, `P1`–`P4`; consolidado: `CM1`, `CM2`, `CM3`, `C.D.`, `C.A.`, `Desempeño`; escala `Superior 4,6–5,0`, `Alto 4,0–4,5`, `Básico 3,5–3,9`, `Bajo 1,0–3,4`, `RECUPERACIÓN 9`; `DESCRIPCIÓN DE LA EVALUACIÓN` por periodo |
| `logros.html` | `Cod_Mate`, `Nom_Mate`, `Nom_profe`, `Periodo`, `L1`–`L4`, `I1_L1`–`I5_L4` |
| `observador.html` | `Per`, `Tipo-Descripción`, `Fecha`, `Descargos-Acción`, `Anota`, `Firma Acudiente`, `Firma Estudiante` |
| `circulares.html` | `Fecha`, `Título`, `Asunto` |
| `pqrs.html` | Tabla: `Número`, `Fecha apertura`, `Tipo`, `Queja`, `Estado`, `Acción`; formulario: `Nombre`, `Mail`, `Tipo` (Petición, Queja, Reclamo, Sugerencia, Felicitación, Denuncia), `Queja` (500 caracteres), `archivoInput[]` |
| `bullying.html` | Formulario: `Denuncia`; historial: `Fecha Apertura`, `Denuncia`, `Respuesta` |
| `referidos.html` | Tabla: `Fecha Inscripción`, `Nombre`, `Grado`, `Estado en el proceso de matrícula`, `Formato`; formulario: `Nombre`, `Grado`, `Procede`, `ColegioInteres`, `Papas`, `Telefono` |
| `servicio-social.html` | Programas: `Tipo`, `Nombre`, `Descripción`, `Funciones`, `Horario`, `Contacto`, `Dirección`, `Inicia-Fin`, `Inscritos`; inscripción: `IDSSocialColegio`, `IDInscrito`, `Terminada`, `Evaluo`, `Desempenio`, `ObserEval` |
| `traslados.html` | Solicitud: `ColegioOrigen`, `ColegioDestino`, `FechaTraslado`, `TipoTraslado`, `Observaciones`, `AceptaCondiciones`, `AceptaTratamientoDatos`; decisiones: `AccionCartera`, `AccionColegioOrigen`, `AccionColegioDestino`, `AccionTraslado` |
| `historia-clinica.html` | `Tipo`, `RH`, `EPS`, `OtraEPS`, `NomCotizante`, `DocCotizante`, `NomEmer`, `TelEmer`, `CelularEmer`, `DirEmer`, `Mail`, `MailMama`, `MailPapa`, `Antecedentes`, `Alergias`, `Cirugias`, `TraumasFRecientes`, `Medicamentos`, `FPeso`/`Peso`, `FTalla`/`Talla`, `FAgudezaVisual`/`AgudezaVisual`, `FHigieneOral`/`HigieneOral` |
| `cuenta.html` | `MES`, `TIPO`, `DESCRIPCIÓN`, `VALOR`, `DESCUENTO`, `PAGOS`, `SALDO`, `TOTALES`, `SALDO A LA FECHA`; resumen de pagos: `FECHA`, `ENTIDAD`, `VALOR` |
| `matricula.html` | `imagen`, `PDFDocBaseE`, `FirmaDocumentos`, `AutorizaUsoImagen`, `FMatri`, `FMaxMatri`, `FRevisionDocumentos`; firmas: `TipoFirma` (`M`, `P`, `A`, `E`), `FFirma`, `IPFirma`, `Token` |
| `carnet.html` | `NomAlum`, `Ape1Alum`, `Ape2Alum`, `Codigo`, `Grado`, `Aula`, `Jornada`, `NomCole`, `RH`, `EPS`, `Estado` |

## Archivos PHP conservados

Los cuatro archivos `.php` vacíos que ya estaban en la carpeta se conservaron sin cambios y no hacen parte de esta plantilla:

- `EstuHome.php`
- `EstuInformacion.php`
- `EstuConsultaAcademica.php`
- `EstuProcesoMatricula.php`

## Estructura

```text
EstudiantesNET/
├── assets/
│   ├── css/styles.css
│   └── js/app.js
├── index.html
├── alumno.html
├── tareas.html
├── informe.html
├── logros.html
├── observador.html
├── circulares.html
├── pqrs.html
├── bullying.html
├── referidos.html
├── servicio-social.html
├── traslados.html
├── historia-clinica.html
├── cuenta.html
├── matricula.html
├── carnet.html
├── modal-carnet.html
├── modal-firma.html
├── modal-pago.html
├── EstuHome.php
├── EstuInformacion.php
├── EstuConsultaAcademica.php
├── EstuProcesoMatricula.php
└── README.md
```
