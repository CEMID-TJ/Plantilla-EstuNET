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

Son vistas aisladas para revisar el diseño de los modales. En las páginas principales los modales se abren como capas sobre el contenido.

## Qué incluye

- Navegación lateral agrupada y adaptable.
- Barra de estados de prototipo: normal, cargando, vacío y error.
- Pestañas, filtros, paginación, modales, avisos y estados vacíos.
- Formularios de demostración con `required`, validación con `checkValidity()` y marcadores claros de campo obligatorio.
- Diseño responsive para escritorio, tableta y móvil.
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
