<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Simulación Curricular') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="{{ asset('css/simulation.css') }}" rel="stylesheet">

        @stack('styles')
    </head>

    <style>
        @font-face {
            font-family: 'AncizarSans';
            src: url('{{ asset('fonts/AncizarSans-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'AncizarSans';
            src: url('{{ asset('fonts/AncizarSans-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'AncizarSans', sans-serif !important;
        }
    </style>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid px-4">

                <div class="logo">
                    <a href="https://unal.edu.co" target="_blank">
                        <img src="http://localhost:8080/images/logo.png" alt="Escudo UNAL" class="unal-logo" style="width: 180px;">
                    </a>
                </div>

                <!-- IZQUIERDA: BRAND -->
                <a class="navbar-brand me-4" href="{{ route('simulation.index') }}">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Simulación Curricular
                </a>

                <!-- BOTÓN RESPONSIVE -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- CONTENIDO -->
                <div class="collapse navbar-collapse" id="navbarNav">

                    <!-- CENTRO: MENÚ PRINCIPAL -->
                    <ul class="navbar-nav">

                        <!-- Simulación -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('simulation.index') }}">
                                <i class="fas fa-project-diagram me-1"></i>
                                Simulación
                            </a>
                        </li>

                        <!-- Gestión de Mallas -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="mallasDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-th-list me-1"></i>
                                Gestión de Mallas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="mallasDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('convalidation.index') }}">
                                        <i class="fas fa-exchange-alt me-2"></i>
                                        Convalidaciones
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('elective-subjects.index') }}">
                                        <i class="fas fa-book-open me-2"></i>
                                        Materias Optativas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('leveling-subjects.index') }}">
                                        <i class="fas fa-layer-group me-2"></i>
                                        Materias de Nivelación
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('subject-aliases.index') }}">
                                        <i class="fas fa-code-branch me-2"></i>
                                        Alias de Materias
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Importar -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="estudiantesDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-graduate me-1"></i>
                                Importar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="estudiantesDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('academic-history.index') }}">
                                        <i class="fas fa-history me-2"></i>
                                        Historias Académicas
                                    </a>
                                </li>
                                <li>
                                    <h6 class="dropdown-header">Importar Datos</h6>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('import.index') }}">
                                        <i class="fas fa-file-excel me-2"></i>
                                        Importar Malla Curricular
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                    <!-- DERECHA: ACCIONES + USUARIO -->
                    <ul class="navbar-nav ms-auto align-items-center">

                        <!-- Selector de carrera -->
                        @if(session('program_id'))
                        <li class="nav-item me-2">
                            <button class="btn btn-outline-light btn-sm"
                                    onclick="ProgramSelector.requestChange()"
                                    title="Cambiar carrera">
                                <i class="fas fa-university me-1"></i>
                                <span class="d-none d-md-inline">{{ session('program_name', 'Carrera') }}</span>
                                <i class="fas fa-exchange-alt ms-1 small"></i>
                            </button>
                        </li>
                        @endif

                        <!-- Usuario -->
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user me-2"></i>
                                        {{ Auth::user()->email }}
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('password.change') }}">
                                        <i class="fas fa-key me-2"></i>
                                        Cambiar Contraseña
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Cerrar Sesión
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                        @endauth

                    </ul>

                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')

        {{-- Modal selector de programa --}}
        <div class="modal fade" id="programSelectorModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-university me-2"></i>Seleccionar Carrera
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Sede</label>
                                <select class="form-select" id="selectorCampus">
                                    <option value="">Seleccionar sede...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Facultad</label>
                                <select class="form-select" id="selectorFaculty" disabled>
                                    <option value="">Seleccionar facultad...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Carrera</label>
                                <select class="form-select" id="selectorProgram" disabled>
                                    <option value="">Seleccionar carrera...</option>
                                </select>
                            </div>
                        </div>
                        <div id="programSelectorError" class="alert alert-danger mt-3 d-none"></div>
                    </div>
                    <div class="modal-footer">
                        @if(session('program_id'))
                            <button type="button" class="btn btn-outline-secondary" onclick="ProgramSelector.close()">
                                Cancelar
                            </button>
                        @endif
                        <button type="button" class="btn btn-primary" id="btnConfirmProgram" disabled onclick="ProgramSelector.confirm()">
                            <i class="fas fa-check me-1"></i>Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const ProgramSelector = (() => {
                let campusData = [];
                let modal = null;
                let unsavedModal = null;

                async function init() {
                    modal = new bootstrap.Modal(document.getElementById('programSelectorModal'));
                    unsavedModal = new bootstrap.Modal(document.getElementById('unsavedChangesModal'));

                    const res = await fetch('/api/program-selector');
                    campusData = await res.json();

                    const campusEl = document.getElementById('selectorCampus');
                    campusData.forEach(c => {
                        campusEl.insertAdjacentHTML('beforeend', `<option value="${c.id}">${c.name}</option>`);
                    });

                    campusEl.addEventListener('change', onCampusChange);
                    document.getElementById('selectorFaculty').addEventListener('change', onFacultyChange);
                    document.getElementById('selectorProgram').addEventListener('change', () => {
                        document.getElementById('btnConfirmProgram').disabled =
                            !document.getElementById('selectorProgram').value;
                    });
                }

                function onCampusChange() {
                    const campusId = parseInt(this.value);
                    const facultyEl = document.getElementById('selectorFaculty');
                    const programEl = document.getElementById('selectorProgram');

                    facultyEl.innerHTML = '<option value="">Seleccionar facultad...</option>';
                    programEl.innerHTML = '<option value="">Seleccionar carrera...</option>';
                    facultyEl.disabled = !campusId;
                    programEl.disabled = true;
                    document.getElementById('btnConfirmProgram').disabled = true;

                    if (!campusId) return;
                    const campus = campusData.find(c => c.id === campusId);
                    campus?.faculties.forEach(f => {
                        facultyEl.insertAdjacentHTML('beforeend', `<option value="${f.id}">${f.name}</option>`);
                    });
                }

                function onFacultyChange() {
                    const campusId = parseInt(document.getElementById('selectorCampus').value);
                    const facultyId = parseInt(this.value);
                    const programEl = document.getElementById('selectorProgram');

                    programEl.innerHTML = '<option value="">Seleccionar carrera...</option>';
                    programEl.disabled = !facultyId;
                    document.getElementById('btnConfirmProgram').disabled = true;

                    if (!facultyId) return;
                    const campus = campusData.find(c => c.id === campusId);
                    const faculty = campus?.faculties.find(f => f.id === facultyId);
                    faculty?.programs.forEach(p => {
                        programEl.insertAdjacentHTML('beforeend', `<option value="${p.id}">${p.name}</option>`);
                    });
                }

                async function confirm() {
                    const programId = document.getElementById('selectorProgram').value;
                    if (!programId) return;

                    const btn = document.getElementById('btnConfirmProgram');
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Guardando...';

                    const res = await fetch('/api/program-selector', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ program_id: programId })
                    });

                    const data = await res.json();
                    if (data.success) {
                        modal.hide();
                        window.location.reload();
                    } else {
                        document.getElementById('programSelectorError').textContent = 'Error al guardar. Intenta de nuevo.';
                        document.getElementById('programSelectorError').classList.remove('d-none');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-check me-1"></i>Confirmar';
                    }
                }

                /**
                 * Detecta si hay cambios sin guardar en la simulación actual.
                 * Busca el flag window.hasUnsavedChanges que simulation.js debe exponer.
                 */
                function hasUnsavedChanges() {
                    return typeof window.hasUnsavedChanges !== 'undefined' && window.hasUnsavedChanges === true;
                }

                /**
                 * Punto de entrada del botón del navbar.
                 * Si hay cambios sin guardar muestra el modal de advertencia,
                 * si no, abre directamente el selector.
                 */
                function requestChange() {
                    if (hasUnsavedChanges()) {
                        unsavedModal.show();
                    } else {
                        open();
                    }
                }

                /**
                 * El usuario eligió descartar cambios y cambiar de carrera.
                 */
                function discardAndChange() {
                    window.hasUnsavedChanges = false;
                    unsavedModal.hide();
                    open();
                }

                /**
                 * El usuario eligió guardar antes de cambiar.
                 * Llama a saveCurrentCurriculum() si existe (definida en simulation.js),
                 * y cuando termina abre el selector.
                 */
                async function saveAndChange() {
                    unsavedModal.hide();
                    if (typeof window.saveCurrentCurriculum === 'function') {
                        try {
                            await window.saveCurrentCurriculum();
                        } catch (e) {
                            console.error('Error al guardar:', e);
                        }
                    }
                    open();
                }

                function open() { modal.show(); }
                function close() { modal.hide(); }

                return { init, open, close, confirm, requestChange, discardAndChange, saveAndChange };
            })();

            document.addEventListener('DOMContentLoaded', () => ProgramSelector.init());

            @if(!session('program_id') && in_array(request()->route()?->getName(), ['simulation.index', 'curriculum.index']))
                document.addEventListener('DOMContentLoaded', () => ProgramSelector.open());
            @endif
        </script>

        //{{-- Modal confirmación cambio de carrera con cambios pendientes --}}
        <div class="modal fade" id="unsavedChangesModal" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>Cambios sin guardar
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p>Tienes cambios en la malla actual que no han sido guardados.</p>
                        <p class="mb-0">¿Qué deseas hacer antes de cambiar de carrera?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            <i class="fas fa-arrow-left me-1"></i>Volver
                        </button>
                        <button type="button" class="btn btn-danger"
                                onclick="ProgramSelector.discardAndChange()">
                            <i class="fas fa-trash me-1"></i>Descartar y cambiar
                        </button>
                        <button type="button" class="btn btn-primary"
                                onclick="ProgramSelector.saveAndChange()">
                            <i class="fas fa-save me-1"></i>Guardar y cambiar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
