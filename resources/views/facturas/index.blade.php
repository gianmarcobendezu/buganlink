<x-app-layout>
    <x-slot name="header">Portal de Facturación</x-slot>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');
    :root {
        --bg:#f0f2f5; --surface:#fff; --surface2:#f8f9fb; --border:#e2e6ea;
        --primary:#1a56db; --primary-light:#e8f0fe; --primary-dark:#1240b0;
        --success:#0f9d58; --success-light:#e6f4ea;
        --warning:#f59e0b; --warning-light:#fef3c7;
        --danger:#dc3545; --danger-light:#fdecea;
        --text:#1a202c; --text-muted:#6b7280; --text-light:#9ca3af;
        --shadow-sm:0 1px 3px rgba(0,0,0,.08); --shadow-lg:0 8px 32px rgba(0,0,0,.13);
        --radius:12px; --radius-sm:8px;
    }
    *{box-sizing:border-box;}
    body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);}
    .ep-wrapper{max-width:1200px;margin:0 auto;padding:24px 20px 60px;}

    .ep-tabs{display:flex;gap:4px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:5px;margin-bottom:20px;}
    .ep-tab{flex:1;text-align:center;padding:9px 16px;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;border:none;background:transparent;color:var(--text-muted);transition:all .2s;}
    .ep-tab.active{background:var(--primary);color:#fff;box-shadow:0 2px 8px rgba(26,86,219,.3);}
    .ep-tab:hover:not(.active){background:var(--bg);color:var(--text);}

    .ep-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;}
    .ep-header-left h1{font-size:22px;font-weight:700;letter-spacing:-.3px;}
    .ep-header-left p{font-size:13px;color:var(--text-muted);margin-top:2px;}
    .ep-badge{display:inline-flex;align-items:center;gap:6px;background:var(--primary-light);color:var(--primary);font-size:12px;font-weight:600;padding:5px 12px;border-radius:999px;}
    .ep-badge span{width:7px;height:7px;border-radius:50%;background:var(--primary);display:inline-block;}

    .ep-card{background:var(--surface);border-radius:var(--radius);box-shadow:var(--shadow-sm);border:1px solid var(--border);margin-bottom:20px;overflow:hidden;}
    .ep-card-header{display:flex;align-items:center;gap:10px;padding:16px 20px;border-bottom:1px solid var(--border);background:var(--surface2);}
    .ep-card-header .icon{width:32px;height:32px;border-radius:8px;background:var(--primary-light);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
    .ep-card-header h2{font-size:15px;font-weight:600;}
    .ep-card-header p{font-size:12px;color:var(--text-muted);margin-top:1px;}
    .ep-card-body{padding:20px;}

    .ep-filter-grid{display:grid;grid-template-columns:1fr 1fr auto;gap:12px;align-items:end;}
    @media(max-width:600px){.ep-filter-grid{grid-template-columns:1fr;}}
    label.ep-label{font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:6px;}
    .ep-input{width:100%;border:1.5px solid var(--border);border-radius:var(--radius-sm);padding:9px 12px;font-size:14px;font-family:'DM Sans',sans-serif;color:var(--text);background:var(--surface);transition:border-color .15s,box-shadow .15s;outline:none;}
    .ep-input:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(26,86,219,.12);}

    .ep-btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:var(--radius-sm);font-size:13px;font-weight:600;font-family:'DM Sans',sans-serif;border:none;cursor:pointer;transition:all .15s;white-space:nowrap;}
    .ep-btn-primary{background:var(--primary);color:#fff;}
    .ep-btn-primary:hover{background:var(--primary-dark);box-shadow:0 4px 12px rgba(26,86,219,.3);}
    .ep-btn-success{background:var(--success);color:#fff;}
    .ep-btn-success:hover{background:#0b8049;}
    .ep-btn-outline{background:transparent;color:var(--text-muted);border:1.5px solid var(--border);}
    .ep-btn-outline:hover{background:var(--bg);color:var(--text);}
    .ep-btn:disabled{opacity:.5;cursor:not-allowed;}
    .ep-btn-sm{padding:6px 11px;font-size:12px;}

    .ep-estado{display:inline-flex;align-items:center;gap:5px;font-size:11px;font-weight:600;padding:3px 10px;border-radius:999px;text-transform:uppercase;letter-spacing:.4px;}
    .ep-estado.pendiente{background:var(--warning-light);color:#92400e;}
    .ep-estado.completado{background:var(--success-light);color:#065f46;}
    .ep-estado.aprobado{background:#dbeafe;color:#1e40af;}
    .ep-estado.rechazado{background:var(--danger-light);color:#991b1b;}

    .ep-table-wrap{overflow-x:auto;border-radius:var(--radius-sm);border:1px solid var(--border);}
    .ep-table{width:100%;border-collapse:collapse;font-size:13.5px;}
    .ep-table thead th{background:#f1f5f9;color:var(--text-muted);font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;padding:11px 14px;border-bottom:1px solid var(--border);white-space:nowrap;}
    .ep-table tbody tr{border-bottom:1px solid #f1f5f9;transition:background .1s;}
    .ep-table tbody tr:last-child{border-bottom:none;}
    .ep-table tbody tr:hover{background:#f8f9ff;}
    .ep-table tbody tr.fila-sel{background:#eff6ff !important;}
    .ep-table td{padding:10px 14px;vertical-align:middle;}
    .ep-table td.mono{font-family:'DM Mono',monospace;font-size:12.5px;color:var(--text-muted);}

    .td-input{border:1.5px solid var(--border);border-radius:6px;padding:6px 9px;font-size:13px;font-family:'DM Sans',sans-serif;width:100%;outline:none;background:var(--surface2);color:var(--text);transition:border-color .15s,background .15s;}
    .td-input:focus{border-color:var(--primary);background:#fff;box-shadow:0 0 0 3px rgba(26,86,219,.10);}
    .td-input.filled{border-color:var(--success);background:var(--success-light);}
    .td-input:disabled{opacity:.6;cursor:not-allowed;background:#f1f5f9;}

    .ep-summary-bar{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;padding:12px 16px;background:var(--surface2);border:1px solid var(--border);border-radius:var(--radius-sm);margin-bottom:14px;}
    .ep-summary-item{font-size:13px;color:var(--text-muted);}
    .ep-summary-item strong{color:var(--text);font-weight:700;}
    .ep-summary-total{font-size:15px;font-weight:700;color:var(--primary);}

    .ep-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;margin-bottom:16px;}
    .ep-stat{background:var(--surface2);border:1px solid var(--border);border-radius:var(--radius-sm);padding:14px 16px;}
    .ep-stat .stat-label{font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;}
    .ep-stat .stat-val{font-size:22px;font-weight:700;margin-top:4px;}
    .stat-val.blue{color:var(--primary);} .stat-val.green{color:var(--success);} .stat-val.orange{color:var(--warning);}

    .ep-empty{text-align:center;padding:48px 20px;color:var(--text-light);}
    .ep-empty .ep-empty-icon{font-size:40px;margin-bottom:10px;opacity:.5;}
    .ep-empty p{font-size:14px;}
    .ep-loading{text-align:center;padding:36px;color:var(--text-muted);font-size:14px;}
    .ep-spinner{width:28px;height:28px;border:3px solid var(--border);border-top-color:var(--primary);border-radius:50%;animation:spin .7s linear infinite;margin:0 auto 10px;}
    @keyframes spin{to{transform:rotate(360deg);}}

    /* BARRA SELECCION */
    .barra-sel{display:none;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;
        background:var(--primary-light);border:1.5px solid var(--primary);border-radius:var(--radius-sm);
        padding:12px 18px;margin-bottom:12px;}
    .barra-sel .bs-info{font-size:13px;font-weight:600;color:var(--primary);}

    /* PAGO CARD */
    .pago-card{background:var(--success-light);border:1px solid #86efac;border-radius:8px;padding:10px 12px;}
    .pago-card .pm{font-size:15px;font-weight:700;color:var(--success);}
    .pago-card .pd{font-size:11px;color:#065f46;margin-top:2px;}

    .ep-toast{position:fixed;bottom:24px;right:24px;background:#1a202c;color:#fff;padding:12px 20px;border-radius:10px;font-size:14px;font-weight:500;box-shadow:var(--shadow-lg);z-index:9999;display:flex;align-items:center;gap:10px;transform:translateY(80px);opacity:0;transition:all .3s cubic-bezier(.34,1.56,.64,1);max-width:340px;}
    .ep-toast.show{transform:translateY(0);opacity:1;}
    .ep-toast.success{border-left:4px solid var(--success);}
    .ep-toast.error{border-left:4px solid var(--danger);}
    .ep-toast.warning{border-left:4px solid var(--warning);}

    .d-flex{display:flex;} .gap-2{gap:8px;} .flex-wrap{flex-wrap:wrap;}
    .panel{display:none;} .panel.active{display:block;}
</style>

<div class="ep-wrapper">

    <div class="ep-header">
        <div class="ep-header-left">
            <h1>📋 Portal de Facturacion</h1>
            <p>Bienvenido, <strong>{{ Auth::user()->name }}</strong></p>
        </div>
        <div class="ep-badge"><span></span> Proveedor Activo</div>
    </div>

    <div class="ep-tabs">
        <button class="ep-tab active" onclick="switchTab('registrar', this)">Registrar Facturas</button>
        <button class="ep-tab"        onclick="switchTab('historial', this)">Mis Facturas Guardadas</button>
    </div>

    {{-- PANEL 1: REGISTRAR --}}
    <div id="panel-registrar" class="panel active">
        
        <div id="barraSeleccionReg" style="display:none;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;
        background:var(--primary-light);border:1.5px solid var(--primary);border-radius:var(--radius-sm);
        padding:12px 18px;margin-bottom:12px;">
        <div style="font-size:13px;font-weight:600;color:var(--primary);">
            <span id="txtSelReg">0</span> servicio(s) seleccionado(s)
        </div>
        <div class="d-flex gap-2">
            <button class="ep-btn ep-btn-primary" onclick="abrirModalMasivoReg()">📎 Subir archivo masivo</button>
            <button class="ep-btn ep-btn-outline" onclick="deseleccionarReg()">✕ Limpiar</button>
        </div>
    </div>

        <div class="ep-card">
            <div class="ep-card-header">
                <div class="icon">🔍</div>
                <div><h2>Buscar mis servicios</h2><p>Filtra por rango de fechas para ver los servicios asignados</p></div>
            </div>
            <div class="ep-card-body">
                <div class="ep-filter-grid">
                    <div><label class="ep-label">Desde</label><input type="date" id="filtro_desde" class="ep-input"></div>
                    <div><label class="ep-label">Hasta</label><input type="date" id="filtro_hasta" class="ep-input"></div>
                    <div class="d-flex gap-2">
                        <button class="ep-btn ep-btn-primary" onclick="buscarServicios()">Buscar</button>
                        <button class="ep-btn ep-btn-outline" onclick="limpiarFiltroReg()">X</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="ep-card">
            <div class="ep-card-header">
                <div class="icon">🧾</div>
                <div><h2>Mis Servicios</h2><p>Completa tipo de documento, N de factura y monto</p></div>
            </div>
            <div class="ep-card-body" style="padding:16px;">
                <div id="resumenBar" class="ep-summary-bar" style="display:none;">
                    <div class="d-flex gap-2 flex-wrap">
                        <div class="ep-summary-item">Total: <strong id="totalServicios">0</strong></div>
                        <div class="ep-summary-item" style="margin-left:12px;">Pendientes: <strong id="totalPendientes" style="color:var(--warning)">0</strong></div>
                        <div class="ep-summary-item" style="margin-left:12px;">Completados: <strong id="totalCompletados" style="color:var(--success)">0</strong></div>
                    </div>
                    <div class="ep-summary-total">Total: S/ <span id="sumaMonto">0.00</span></div>
                </div>
                <div id="tablaContainer">
                    <div class="ep-empty"><div class="ep-empty-icon">📅</div><p>Selecciona un rango de fechas y haz clic en <strong>Buscar</strong></p></div>
                </div>
                <div id="accionesGuardar" style="display:none;margin-top:16px;text-align:right;">
                    <button class="ep-btn ep-btn-success" onclick="guardarTodo()" id="btnGuardar">Guardar Todo</button>
                </div>
            </div>
        </div>
    </div>

    {{-- PANEL 2: HISTORIAL --}}
    <div id="panel-historial" class="panel">
        <div class="ep-card">
            <div class="ep-card-header">
                <div class="icon">🗂️</div>
                <div><h2>Mis Facturas Guardadas</h2><p>Consulta y gestiona tus facturas registradas</p></div>
            </div>
            <div class="ep-card-body">
                <div class="ep-filter-grid">
                    <div><label class="ep-label">Desde</label><input type="date" id="hist_desde" class="ep-input"></div>
                    <div><label class="ep-label">Hasta</label><input type="date" id="hist_hasta" class="ep-input"></div>
                    <div class="d-flex gap-2">
                        <button class="ep-btn ep-btn-primary" onclick="cargarHistorial()">Buscar</button>
                        <button class="ep-btn ep-btn-outline" onclick="limpiarFiltroHist()">X</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="histStats" style="display:none;">
            <div class="ep-stats">
                <div class="ep-stat"><div class="stat-label">Total registros</div><div class="stat-val blue" id="hst_total">0</div></div>
                <div class="ep-stat"><div class="stat-label">Monto total</div><div class="stat-val green">S/ <span id="hst_monto">0.00</span></div></div>
                <div class="ep-stat"><div class="stat-label">Pendientes</div><div class="stat-val orange" id="hst_pendientes">0</div></div>
                <div class="ep-stat"><div class="stat-label">Aprobados</div><div class="stat-val green" id="hst_aprobados">0</div></div>
                <div class="ep-stat"><div class="stat-label">Deposito recibido</div><div class="stat-val green">S/ <span id="hst_depositado">0.00</span></div></div>
            </div>
        </div>

        {{-- BARRA SELECCION MASIVA --}}
        <div id="barraSeleccion" class="barra-sel">
            <div class="bs-info"><span id="txtSeleccionados">0</span> servicio(s) seleccionado(s)</div>
            <div class="d-flex gap-2">
                <button class="ep-btn ep-btn-primary" onclick="abrirModalMasivo()">Subir archivo para seleccionados</button>
                <button class="ep-btn ep-btn-outline" onclick="deseleccionarTodo()">X Limpiar</button>
            </div>
        </div>

        <div class="ep-card">
            <div class="ep-card-body" style="padding:16px;">
                <div id="histContainer">
                    <div class="ep-empty"><div class="ep-empty-icon">📂</div><p>Selecciona un rango de fechas para ver tus facturas guardadas</p></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="ep-toast" id="epToast"></div>

{{-- MODAL ARCHIVOS CDR (individual) --}}
<div id="modalArchivos" style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,.45);align-items:center;justify-content:center;padding:16px;">
    <div style="background:var(--surface);border-radius:var(--radius);box-shadow:var(--shadow-lg);width:100%;max-width:560px;max-height:90vh;display:flex;flex-direction:column;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border);background:var(--surface2);">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:32px;height:32px;border-radius:8px;background:var(--primary-light);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:16px;">📎</div>
                <div>
                    <div style="font-size:15px;font-weight:700;" id="modalArchivosTitulo">Archivos CDR</div>
                    <div style="font-size:12px;color:var(--text-muted);">PDF, XML, ZIP, RAR, imagenes</div>
                </div>
            </div>
            <button onclick="cerrarModalArchivos()" style="border:none;background:none;font-size:22px;cursor:pointer;color:var(--text-muted);padding:4px 8px;">&times;</button>
        </div>
        <div style="padding:20px;overflow-y:auto;flex:1;display:flex;flex-direction:column;gap:16px;">
            <div id="modalArchivosMensaje" style="font-size:13px;color:var(--warning);font-weight:500;"></div>
            <div id="zonaSubida">
                <label style="font-size:12px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:8px;">Subir nuevo archivo</label>
                <div style="border:2px dashed var(--border);border-radius:10px;padding:20px;text-align:center;background:var(--surface2);">
                    <div style="font-size:28px;margin-bottom:6px;">📁</div>
                    <p style="font-size:13px;color:var(--text-muted);margin-bottom:12px;">PDF, XML, ZIP, RAR, JPG, PNG - max. 10 MB</p>
                    <label style="cursor:pointer;">
                        <input type="file" id="inputArchivoFile" accept=".pdf,.xml,.zip,.rar,.jpg,.jpeg,.png" style="display:none;">
                        <span class="ep-btn ep-btn-outline" style="display:inline-flex;">Seleccionar archivo</span>
                    </label>
                    <div id="archivoNombreSeleccionado" style="margin-top:8px;font-size:13px;font-weight:600;color:var(--primary);"></div>
                </div>
                <div style="text-align:right;margin-top:10px;">
                    <button id="btnSubirArchivo" class="ep-btn ep-btn-success" onclick="subirArchivo()">Subir Archivo</button>
                </div>
            </div>
            <div>
                <label style="font-size:12px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:8px;">Archivos subidos</label>
                <div id="listaArchivos"></div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL SUBIDA MASIVA --}}
<div id="modalSubidaMasiva" style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,.5);align-items:center;justify-content:center;padding:16px;">
    <div style="background:var(--surface);border-radius:var(--radius);box-shadow:var(--shadow-lg);width:100%;max-width:520px;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border);background:var(--surface2);">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:32px;height:32px;border-radius:8px;background:var(--primary-light);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:16px;">📎</div>
                <div>
                    <div style="font-size:15px;font-weight:700;">Subir archivo masivo</div>
                    <div style="font-size:12px;color:var(--text-muted);">El archivo se asociara a todos los seleccionados</div>
                </div>
            </div>
            <button onclick="cerrarModalMasivo()" style="border:none;background:none;font-size:22px;cursor:pointer;color:var(--text-muted);padding:4px 8px;">&times;</button>
        </div>
        <div style="padding:20px;display:flex;flex-direction:column;gap:14px;">
            <div>
                <label style="font-size:12px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:8px;">Servicios seleccionados</label>
                <div id="masiva_ids_lista" style="display:flex;flex-wrap:wrap;gap:6px;background:var(--surface2);border-radius:8px;padding:10px;border:1px solid var(--border);"></div>
            </div>
            <div>
                <label style="font-size:12px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:8px;">Archivo a subir</label>
                <div style="border:2px dashed var(--border);border-radius:10px;padding:20px;text-align:center;background:var(--surface2);">
                    <div style="font-size:28px;margin-bottom:6px;">📁</div>
                    <p style="font-size:13px;color:var(--text-muted);margin-bottom:12px;">PDF, XML, ZIP, RAR, JPG, PNG - max. 10 MB</p>
                    <label style="cursor:pointer;">
                        <input type="file" id="masiva_file" accept=".pdf,.xml,.zip,.rar,.jpg,.jpeg,.png" style="display:none;">
                        <span class="ep-btn ep-btn-outline" style="display:inline-flex;">Seleccionar archivo</span>
                    </label>
                    <div id="masiva_nombre" style="margin-top:8px;font-size:13px;font-weight:600;color:var(--primary);"></div>
                </div>
            </div>
            <div id="masiva_progreso" style="display:none;background:var(--surface2);border-radius:8px;padding:12px;border:1px solid var(--border);">
                <div style="font-size:13px;font-weight:600;color:var(--primary);" id="masiva_progreso_txt"></div>
                <div style="margin-top:8px;height:6px;background:var(--border);border-radius:99px;overflow:hidden;">
                    <div id="masiva_barra" style="height:100%;background:var(--primary);border-radius:99px;width:0%;transition:width .3s;"></div>
                </div>
            </div>
            <div style="display:flex;gap:8px;justify-content:flex-end;">
                <button class="ep-btn ep-btn-outline" onclick="cerrarModalMasivo()">Cancelar</button>
                <button class="ep-btn ep-btn-success" type="button" id="btnSubirMasivo" onclick="subirArchivoMasivo()">Subir Archivo</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL PREVIEW --}}
<div id="filePreviewModal" style="display:none;position:fixed;inset:0;z-index:1100;background:rgba(0,0,0,.6);align-items:center;justify-content:center;padding:16px;">
    <div style="background:var(--surface);border-radius:var(--radius);box-shadow:var(--shadow-lg);width:100%;max-width:780px;max-height:92vh;display:flex;flex-direction:column;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--border);background:var(--surface2);">
            <div style="font-size:15px;font-weight:700;">Vista previa del archivo</div>
            <button onclick="cerrarPreview()" style="border:none;background:none;font-size:22px;cursor:pointer;color:var(--text-muted);padding:4px 8px;">&times;</button>
        </div>
        <div id="filePreviewContainer" style="padding:16px;overflow-y:auto;flex:1;"></div>
    </div>
</div>

<script>
const CSRF = '{{ csrf_token() }}';
let _origenMasivo = 'historial';
/* ── INIT ── */
(function() {
    const hoy = new Date();
    const y = hoy.getFullYear();
    const m = String(hoy.getMonth()+1).padStart(2,'0');
    const d = String(hoy.getDate()).padStart(2,'0');
    const ini = `${y}-${m}-01`, fin = `${y}-${m}-${d}`;
    document.getElementById('filtro_desde').value = ini;
    document.getElementById('filtro_hasta').value  = fin;
    document.getElementById('hist_desde').value    = ini;
    document.getElementById('hist_hasta').value    = fin;

    document.getElementById('inputArchivoFile').addEventListener('change', function() {
        document.getElementById('archivoNombreSeleccionado').textContent = this.files[0]?.name || '';
    });
    document.getElementById('masiva_file').addEventListener('change', function() {
        document.getElementById('masiva_nombre').textContent = this.files[0]?.name || '';
    });
})();

/* ── TABS ── */
function switchTab(tab, el) {
    document.querySelectorAll('.ep-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    el.classList.add('active');
    document.getElementById(`panel-${tab}`).classList.add('active');
    if (tab === 'historial') cargarHistorial();
}

/* ════════════════════════════
   PANEL 1 — REGISTRAR
════════════════════════════ */
function buscarServicios() {
    const desde = document.getElementById('filtro_desde').value;
    const hasta = document.getElementById('filtro_hasta').value;
    if (!desde || !hasta) { showToast('Selecciona ambas fechas','warning'); return; }
    document.getElementById('tablaContainer').innerHTML = loadingHTML();
    document.getElementById('resumenBar').style.display = 'none';
    document.getElementById('accionesGuardar').style.display = 'none';
    const body = new FormData();
    body.append('desde', desde); body.append('hasta', hasta);
    fetch('/api/v1/extranet.listar', { method:'POST', headers:{'X-CSRF-TOKEN':CSRF}, body })
    .then(r => { if(!r.ok) throw new Error(`HTTP ${r.status}`); return r.json(); })
    .then(data => renderTablaRegistrar(data))
    .catch(() => { document.getElementById('tablaContainer').innerHTML = errorHTML(); });
}

function renderTablaRegistrar(data) {
    if (!data || !data.length) {
        document.getElementById('tablaContainer').innerHTML = emptyHTML('🔎','No se encontraron servicios en ese rango.');
        return;
    }
    
    
    let html = `<div class="ep-table-wrap"><table class="ep-table" id="tablaServicios"><thead><tr>
        <th style="text-align:center;width:40px;">
            <input type="checkbox" id="chkTodosReg" onchange="toggleTodosReg(this)"
                style="width:15px;height:15px;cursor:pointer;accent-color:var(--primary);">
        </th>
        <th>#</th><th>Fecha</th><th>Reserva</th><th>Servicio</th>
        <th>PAX</th><th>Hora</th><th>Tipo Doc.</th><th>N Factura</th><th>Monto</th><th>Estado</th><th>Archivos</th>
    </tr></thead><tbody>`;

    data.forEach((s, i) => {
        const aprobado  = s.idestado_factura >= 2;
        const tieneData = s.codigofactura && s.monto && s.tipodocumento;
        html += `<tr id="fila-${s.iddetallereservaoper}" data-id="${s.iddetallereservaoper}" ${aprobado?'class="ya-aprobado"':''}>
            <td style="text-align:center;">
                ${s.idfactura ? `
                <input type="checkbox" class="chk-reg" value="${s.idfactura}"
                    onchange="actualizarSeleccionReg()"
                    style="width:15px;height:15px;cursor:pointer;accent-color:var(--primary);">
                ` : ''}
            </td>
            <td class="mono">${i+1}</td>
            <td class="mono">${formatFecha(s.fecha)}</td>
            <td><div style="font-weight:600;">${s.idreserva||'-'}</div><div style="font-size:11px;color:var(--text-muted);">Fila: ${s.fila||'-'}</div></td>
            <td><div style="font-weight:500;">${s.servicioimpresion||'-'}</div><div style="font-size:11px;color:var(--text-muted);">${s.observacionoper||''}</div></td>
            <td style="text-align:center;font-weight:600;">${s.pax||'-'}</td>
            <td class="mono">${s.hora?s.hora.substring(0,5):'-'}</td>
            <td style="min-width:155px;">
                <select class="td-input ${s.tipodocumento?'filled':''}" id="tipodoc-${s.iddetallereservaoper}" ${aprobado?'disabled':''} onchange="checkFilled(${s.iddetallereservaoper})">
                    <option value="">-- Tipo --</option>
                    <option value="FACTURA" ${s.tipodocumento==='FACTURA'?'selected':''}>Factura</option>
                    <option value="BOLETA"  ${s.tipodocumento==='BOLETA' ?'selected':''}>Boleta</option>
                    <option value="RH"      ${s.tipodocumento==='RH'     ?'selected':''}>Rec. Honorarios</option>
                    <option value="NINGUNO" ${s.tipodocumento==='NINGUNO'?'selected':''}>Sin documento</option>
                </select>
            </td>
            <td style="min-width:140px;">
                <input type="text" class="td-input ${s.codigofactura?'filled':''}" id="factura-${s.iddetallereservaoper}"
                    placeholder="F001-0025" value="${s.codigofactura||''}" ${aprobado?'disabled':''}
                    oninput="checkFilled(${s.iddetallereservaoper});actualizarResumen()">
            </td>
            <td style="min-width:110px;">
                <input type="number" step="0.01" min="0" class="td-input ${s.monto?'filled':''}" id="monto-${s.iddetallereservaoper}"
                    placeholder="0.00" value="${s.monto||''}" ${aprobado?'disabled':''}
                    oninput="checkFilled(${s.iddetallereservaoper});actualizarResumen()">
            </td>
            <td id="estado-${s.iddetallereservaoper}">${estadoBadge(s.idestado_factura, tieneData)}</td>
            <td>
                ${s.idfactura ? `
                <button class="ep-btn ep-btn-outline ep-btn-sm"
                    onclick="abrirModalArchivos(${s.idfactura},'${(s.codigofactura||'').replace(/'/g,"\\'")}',${aprobado})">
                    📎 Archivos
                </button>` : ''}
            </td>
        </tr>`;
        
        
        
    });
    html += `</tbody></table></div>`;
    document.getElementById('tablaContainer').innerHTML = html;
    document.getElementById('accionesGuardar').style.display = 'block';
    actualizarResumen();
}

/* ── SELECCION PANEL 1 ── */
function toggleTodosReg(chk) {
    document.querySelectorAll('.chk-reg').forEach(c => c.checked = chk.checked);
    actualizarSeleccionReg();
}

function actualizarSeleccionReg() {
    const sel   = document.querySelectorAll('.chk-reg:checked');
    const total = document.querySelectorAll('.chk-reg').length;
    const chk   = document.getElementById('chkTodosReg');
    if (chk) {
        chk.indeterminate = sel.length > 0 && sel.length < total;
        chk.checked = sel.length === total && total > 0;
    }
    document.querySelectorAll('.chk-reg').forEach(c => {
        c.closest('tr').classList.toggle('fila-sel', c.checked);
    });
    document.getElementById('txtSelReg').textContent = sel.length;
    document.getElementById('barraSeleccionReg').style.display = sel.length > 0 ? 'flex' : 'none';
}

function deseleccionarReg() {
    document.querySelectorAll('.chk-reg').forEach(c => { c.checked=false; c.closest('tr').classList.remove('fila-sel'); });
    const chk = document.getElementById('chkTodosReg');
    if (chk) { chk.checked=false; chk.indeterminate=false; }
    document.getElementById('barraSeleccionReg').style.display = 'none';
    document.getElementById('txtSelReg').textContent = '0';
}

/* ── MODAL MASIVO PANEL 1 (reutiliza el mismo modal) ── */
function abrirModalMasivoReg() {
    const seleccionados = [...document.querySelectorAll('.chk-reg:checked')].map(c => c.value);
    if (!seleccionados.length) { showToast('Selecciona al menos un servicio','warning'); return; }

    // Marcar de dónde viene para saber qué recargar al terminar
    _origenMasivo = 'registrar';

    document.getElementById('masiva_ids_lista').innerHTML = seleccionados.map(id =>
        `<span style="background:var(--primary-light);color:var(--primary);font-size:11px;font-weight:600;padding:2px 8px;border-radius:999px;">#${id}</span>`
    ).join(' ');
    document.getElementById('masiva_file').value = '';
    document.getElementById('masiva_nombre').textContent = '';
    document.getElementById('masiva_progreso').style.display = 'none';
    document.getElementById('masiva_barra').style.width = '0%';
    document.getElementById('masiva_progreso_txt').textContent = '';
    document.getElementById('modalSubidaMasiva').style.display = 'flex';
}


function checkFilled(id) {
    ['factura','monto','tipodoc'].forEach(campo => {
        const el = document.getElementById(`${campo}-${id}`);
        if (el && !el.disabled) el.classList.toggle('filled', !!el.value.trim());
    });
    const completo = document.getElementById(`factura-${id}`).value.trim()
                  && document.getElementById(`monto-${id}`).value.trim()
                  && document.getElementById(`tipodoc-${id}`).value;
    document.getElementById(`estado-${id}`).innerHTML = completo
        ? '<span class="ep-estado completado">Completo</span>'
        : '<span class="ep-estado pendiente">Pendiente</span>';
    actualizarResumen();
}

function actualizarResumen() {
    const filas = document.querySelectorAll('#tablaServicios tbody tr');
    if (!filas.length) return;
    let total=filas.length, pendientes=0, completados=0, suma=0;
    filas.forEach(fila => {
        const id = fila.dataset.id;
        const f = document.getElementById(`factura-${id}`)?.value.trim();
        const m = document.getElementById(`monto-${id}`)?.value.trim();
        const t = document.getElementById(`tipodoc-${id}`)?.value;
        if (f && m && t) completados++; else pendientes++;
        suma += parseFloat(m||0);
    });
    document.getElementById('totalServicios').textContent   = total;
    document.getElementById('totalPendientes').textContent  = pendientes;
    document.getElementById('totalCompletados').textContent = completados;
    document.getElementById('sumaMonto').textContent        = suma.toFixed(2);
    document.getElementById('resumenBar').style.display     = 'flex';
}

async function guardarTodo() {
    const filas = document.querySelectorAll('#tablaServicios tbody tr');
    if (!filas.length) { showToast('No hay servicios cargados','warning'); return; }
    const servicios = [];
    filas.forEach(fila => {
        const id = fila.dataset.id;
        const tipo    = document.getElementById(`tipodoc-${id}`)?.value||'';
        const factura = document.getElementById(`factura-${id}`)?.value.trim()||'';
        const monto   = document.getElementById(`monto-${id}`)?.value||'';
        if (document.getElementById(`factura-${id}`)?.disabled) return;
        if (!tipo && !factura && !monto) return;
        servicios.push({ iddetallereservaoper:parseInt(id), tipodocumento:tipo, codigofactura:factura, monto:parseFloat(monto)||0 });
    });
    if (!servicios.length) { showToast('Completa al menos un servicio','warning'); return; }
    if (servicios.filter(s => !s.tipodocumento||!s.codigofactura||!s.monto).length) {
        showToast('Hay servicios incompletos', 'warning'); return;
    }
    const btn = document.getElementById('btnGuardar');
    btn.disabled=true; btn.textContent='Guardando...';
    try {
        const res  = await fetch('/api/v1/extranet.factura', {
            method:'POST',
            headers:{'X-CSRF-TOKEN':CSRF,'Content-Type':'application/json','Accept':'application/json'},
            body: JSON.stringify({servicios})
        });
        const data = await res.json();
        if (data.success) { showToast(data.message, 'success'); setTimeout(() => buscarServicios(), 1200); }
        else showToast(data.message||'Error al guardar', 'error');
    } catch(e) { showToast('Error de conexion','error'); }
    finally { btn.disabled=false; btn.textContent='Guardar Todo'; }
}

function limpiarFiltroReg() {
    document.getElementById('filtro_desde').value='';
    document.getElementById('filtro_hasta').value='';
    document.getElementById('tablaContainer').innerHTML = emptyHTML('📅','Selecciona un rango de fechas y haz clic en Buscar');
    document.getElementById('resumenBar').style.display='none';
    document.getElementById('accionesGuardar').style.display='none';
}

/* ════════════════════════════
   PANEL 2 — HISTORIAL
════════════════════════════ */
function cargarHistorial() {
    const desde = document.getElementById('hist_desde').value;
    const hasta = document.getElementById('hist_hasta').value;
    if (!desde || !hasta) { showToast('Selecciona ambas fechas','warning'); return; }
    document.getElementById('histContainer').innerHTML = loadingHTML();
    document.getElementById('histStats').style.display = 'none';
    document.getElementById('barraSeleccion').style.display = 'none';
    const body = new FormData();
    body.append('desde', desde); body.append('hasta', hasta);
    fetch('/api/v1/extranet.listar', { method:'POST', headers:{'X-CSRF-TOKEN':CSRF}, body })
    .then(r => { if(!r.ok) throw new Error(`HTTP ${r.status}`); return r.json(); })
    .then(data => renderHistorial(data))
    .catch(() => { document.getElementById('histContainer').innerHTML = errorHTML(); });
}

function renderHistorial(data) {
    const guardados = (data||[]).filter(s => s.idfactura !== null);
    if (!guardados.length) {
        document.getElementById('histContainer').innerHTML = emptyHTML('📭','No tienes facturas guardadas en ese rango de fechas.');
        document.getElementById('histStats').style.display = 'none';
        return;
    }

    let sumaTotal=0, pendientes=0, aprobados=0, depositado=0;
    guardados.forEach(s => {
        sumaTotal  += parseFloat(s.monto||0);
        depositado += parseFloat(s.montopago||0);
        if (s.idestado_factura >= 2) aprobados++; else pendientes++;
    });
    document.getElementById('hst_total').textContent      = guardados.length;
    document.getElementById('hst_monto').textContent      = sumaTotal.toFixed(2);
    document.getElementById('hst_pendientes').textContent = pendientes;
    document.getElementById('hst_aprobados').textContent  = aprobados;
    document.getElementById('hst_depositado').textContent = depositado.toFixed(2);
    document.getElementById('histStats').style.display    = 'block';

    let html = `<div class="ep-table-wrap"><table class="ep-table" id="tablaHistorial">
    <thead><tr>
        <th style="text-align:center;width:40px;">
            <input type="checkbox" id="chkTodos" onchange="toggleTodos(this)"
                style="width:15px;height:15px;cursor:pointer;accent-color:var(--primary);">
        </th>
        <th>#</th><th>Fecha</th><th>Reserva</th><th>Servicio</th>
        <th>Tipo Doc.</th><th>N Factura</th><th>Monto</th>
<th>Deposito recibido</th><th>Estado</th><th>Acciones</th>
    </tr></thead><tbody>`;

    guardados.forEach((s, i) => {
    const aprobado = s.idestado_factura >= 2;
    const idf = s.idfactura;

    // Deposito
    const depositoHTML = s.montopago
        ? `<div class="pago-card">
            <div class="pm">S/ ${parseFloat(s.montopago).toFixed(2)}</div>
            <div class="pd">${formatFecha(s.fechapago||'')} &bull; ${s.obs_pago||''}</div>
            ${s.ruta_pago ? `<button class="ep-btn ep-btn-outline ep-btn-sm" style="margin-top:6px;font-size:11px;"
                onclick="verArchivoFactura('${s.ruta_pago.replace(/'/g,"\\'")}','${s.ext_pago}')">Ver voucher</button>` : ''}
           </div>`
        : `<span style="color:var(--text-light);font-size:12px;">Pendiente</span>`;

    // Celda Tipo Doc
    const tdTipo = aprobado
        ? `<td style="font-size:12px;">${tipoDocLabel(s.tipodocumento)}</td>`
        : `<td id="td-tipo-${idf}" style="min-width:140px;">
            <span class="hist-val" style="cursor:pointer;" onclick="activarEdicion(${idf},'${(s.tipodocumento||'').replace(/'/g,"\\'")}','${(s.codigofactura||'').replace(/'/g,"\\'")}',${s.monto||0})">${tipoDocLabel(s.tipodocumento)}</span>
            <select class="td-input hist-edit" id="edit-tipo-${idf}" style="display:none;">
                <option value="FACTURA" ${s.tipodocumento==='FACTURA'?'selected':''}>Factura</option>
                <option value="BOLETA"  ${s.tipodocumento==='BOLETA' ?'selected':''}>Boleta</option>
                <option value="RH"      ${s.tipodocumento==='RH'     ?'selected':''}>Rec. Honorarios</option>
                <option value="NINGUNO" ${s.tipodocumento==='NINGUNO'?'selected':''}>Sin documento</option>
            </select></td>`;

    // Celda N° Factura
    const tdFactura = aprobado
        ? `<td class="mono" style="font-weight:600;">${s.codigofactura||'-'}</td>`
        : `<td id="td-factura-${idf}" style="min-width:130px;">
            <span class="hist-val" style="cursor:pointer;font-family:monospace;font-weight:600;" onclick="activarEdicion(${idf},'${(s.tipodocumento||'').replace(/'/g,"\\'")}','${(s.codigofactura||'').replace(/'/g,"\\'")}',${s.monto||0})">${s.codigofactura||'-'}</span>
            <input type="text" class="td-input hist-edit" id="edit-factura-${idf}"
                value="${s.codigofactura||''}" placeholder="F001-0025" style="display:none;"></td>`;

    // Celda Monto
    const tdMonto = aprobado
        ? `<td style="font-weight:700;color:var(--primary);">S/ ${parseFloat(s.monto||0).toFixed(2)}</td>`
        : `<td id="td-monto-${idf}" style="min-width:100px;">
            <span class="hist-val" style="cursor:pointer;font-weight:700;color:var(--primary);" onclick="activarEdicion(${idf},'${(s.tipodocumento||'').replace(/'/g,"\\'")}','${(s.codigofactura||'').replace(/'/g,"\\'")}',${s.monto||0})">S/ ${parseFloat(s.monto||0).toFixed(2)}</span>
            <input type="number" step="0.01" min="0" class="td-input hist-edit" id="edit-monto-${idf}"
                value="${s.monto||''}" placeholder="0.00" style="display:none;"></td>`;

    // Botones acciones
    const acciones = aprobado
        ? `<button class="ep-btn ep-btn-primary ep-btn-sm"
            onclick="abrirModalArchivos(${idf},'${(s.codigofactura||'').replace(/'/g,"\\'")}',true)">Ver archivos</button>`
        : `<div id="btn-normal-${idf}" style="display:flex;gap:6px;flex-wrap:wrap;">
            <button class="ep-btn ep-btn-outline ep-btn-sm" onclick="activarEdicion(${idf},'${(s.tipodocumento||'').replace(/'/g,"\\'")}','${(s.codigofactura||'').replace(/'/g,"\\'")}',${s.monto||0})">Editar</button>
            <button class="ep-btn ep-btn-primary ep-btn-sm" onclick="abrirModalArchivos(${idf},'${(s.codigofactura||'').replace(/'/g,"\\'")}',false)">Ver archivos</button>
           </div>
           <div id="btn-edit-${idf}" style="display:none;gap:6px;flex-wrap:wrap;">
            <button class="ep-btn ep-btn-success ep-btn-sm" onclick="guardarEdicion(${idf})">Guardar</button>
            <button class="ep-btn ep-btn-outline ep-btn-sm" onclick="cancelarEdicion(${idf},'${(s.tipodocumento||'').replace(/'/g,"\\'")}','${(s.codigofactura||'').replace(/'/g,"\\'")}',${s.monto||0})">Cancelar</button>
           </div>`;

    html += `<tr data-id="${idf}" id="fila-hist-${idf}" ${aprobado?'style="background:#f0fdf4;"':''}>
        <td style="text-align:center;">
            <input type="checkbox" class="chk-servicio" value="${idf}" onchange="actualizarSeleccion()"
                style="width:15px;height:15px;cursor:pointer;accent-color:var(--primary);">
        </td>
        <td class="mono">${i+1}</td>
        <td class="mono">${formatFecha(s.fecha)}</td>
        <td>
            <div style="font-weight:600;">${s.idreserva||'-'}</div>
            <div style="font-size:11px;color:var(--text-muted);">Fila: ${s.fila||'-'}</div>
        </td>
        <td style="font-size:12px;max-width:150px;">${s.servicioimpresion||'-'}</td>
        ${tdTipo}
        ${tdFactura}
        ${tdMonto}
        <td>${depositoHTML}</td>
        <td>${estadoBadge(s.idestado_factura, true)}</td>
        <td style="min-width:150px;">${acciones}</td>
    </tr>`;
});

    html += `</tbody></table></div>`;
    document.getElementById('histContainer').innerHTML = html;
}

function limpiarFiltroHist() {
    document.getElementById('hist_desde').value='';
    document.getElementById('hist_hasta').value='';
    document.getElementById('histContainer').innerHTML = emptyHTML('📂','Selecciona un rango de fechas para ver tus facturas guardadas');
    document.getElementById('histStats').style.display='none';
    document.getElementById('barraSeleccion').style.display='none';
}

/* ── SELECCION MASIVA ── */
function toggleTodos(chk) {
    document.querySelectorAll('.chk-servicio').forEach(c => c.checked = chk.checked);
    actualizarSeleccion();
}

function actualizarSeleccion() {
    const sel   = document.querySelectorAll('.chk-servicio:checked');
    const total = document.querySelectorAll('.chk-servicio').length;
    const chkTodos = document.getElementById('chkTodos');
    if (chkTodos) {
        chkTodos.indeterminate = sel.length > 0 && sel.length < total;
        chkTodos.checked = sel.length === total && total > 0;
    }
    // Resaltar filas seleccionadas
    document.querySelectorAll('.chk-servicio').forEach(c => {
        c.closest('tr').classList.toggle('fila-sel', c.checked);
    });
    document.getElementById('txtSeleccionados').textContent = sel.length;
    document.getElementById('barraSeleccion').style.display = sel.length > 0 ? 'flex' : 'none';
}

function deseleccionarTodo() {
    document.querySelectorAll('.chk-servicio').forEach(c => { c.checked=false; c.closest('tr').classList.remove('fila-sel'); });
    const chkTodos = document.getElementById('chkTodos');
    if (chkTodos) { chkTodos.checked=false; chkTodos.indeterminate=false; }
    document.getElementById('barraSeleccion').style.display = 'none';
    document.getElementById('txtSeleccionados').textContent = '0';
}

/* ── MODAL MASIVO ── */
function abrirModalMasivo() {
    _origenMasivo = 'historial';
    const seleccionados = [...document.querySelectorAll('.chk-servicio:checked')].map(c => c.value);
    if (!seleccionados.length) { showToast('Selecciona al menos un servicio','warning'); return; }

    document.getElementById('masiva_ids_lista').innerHTML = seleccionados.map(id =>
        `<span style="background:var(--primary-light);color:var(--primary);font-size:11px;font-weight:600;padding:2px 8px;border-radius:999px;">#${id}</span>`
    ).join(' ');
    document.getElementById('masiva_file').value = '';
    document.getElementById('masiva_nombre').textContent = '';
    document.getElementById('masiva_progreso').style.display = 'none';
    document.getElementById('masiva_barra').style.width = '0%';
    document.getElementById('masiva_progreso_txt').textContent = '';
    document.getElementById('modalSubidaMasiva').style.display = 'flex';
}

function cerrarModalMasivo() {
    document.getElementById('modalSubidaMasiva').style.display = 'none';
}

async function subirArchivoMasivo() {
        const selector = _origenMasivo === 'registrar' ? '.chk-reg:checked' : '.chk-servicio:checked';

    const seleccionados = [...document.querySelectorAll(selector)].map(c => c.value);
    if (!seleccionados.length) { showToast('No hay servicios seleccionados','warning'); return; }
    const fileInput = document.getElementById('masiva_file');
    if (!fileInput.files.length) { showToast('Selecciona un archivo','warning'); return; }

    const btn = document.getElementById('btnSubirMasivo');
    btn.disabled = true; btn.textContent = 'Subiendo...';
    document.getElementById('masiva_progreso').style.display = 'block';

    let ok=0, errores=0;
    for (let i=0; i<seleccionados.length; i++) {
        const pct = Math.round(((i+1)/seleccionados.length)*100);
        document.getElementById('masiva_progreso_txt').textContent = `Subiendo ${i+1} de ${seleccionados.length}...`;
        document.getElementById('masiva_barra').style.width = pct + '%';

        const formData = new FormData();
        formData.append('idfacturaproveedor', seleccionados[i]);
        formData.append('file', fileInput.files[0]);

        try {
            const res  = await fetch('/api/v1/extranet.subirarchivo', {
                method:'POST', headers:{'X-CSRF-TOKEN':CSRF}, body: formData
            });
            const data = await res.json();
            if (data.success) ok++; else errores++;
        } catch(e) { errores++; }
    }

    document.getElementById('masiva_progreso_txt').textContent =
        `Listo: ${ok} archivo(s) subido(s)${errores ? `, ${errores} error(es)` : ''}.`;
    document.getElementById('masiva_barra').style.background = errores ? 'var(--danger)' : 'var(--success)';

    btn.disabled=false; btn.textContent='Subir Archivo';

    if (ok > 0) {
        showToast(`Archivo subido a ${ok} servicio(s)`, 'success');
        //setTimeout(() => { cerrarModalMasivo(); deseleccionarTodo(); cargarHistorial(); }, 1800);
        setTimeout(() => {
            cerrarModalMasivo();
            if (_origenMasivo === 'registrar') {
                deseleccionarReg();
                buscarServicios();
            } else {
                deseleccionarTodo();
                cargarHistorial();
            }
        }, 1800);

    } else {
        showToast('No se pudo subir el archivo', 'error');
    }
}

/* ── MODAL ARCHIVOS INDIVIDUAL ── */
let _modalFacturaId = null, _modalAprobado = false;

function abrirModalArchivos(idfactura, codigofactura, aprobado) {
    _modalFacturaId = idfactura; _modalAprobado = aprobado;
    document.getElementById('modalArchivosTitulo').textContent = 'Archivos - Factura: ' + (codigofactura||'#'+idfactura);
    document.getElementById('zonaSubida').style.display = aprobado ? 'none' : 'block';
    document.getElementById('modalArchivosMensaje').textContent = aprobado ? 'Factura aprobada - no se pueden subir mas archivos.' : '';
    document.getElementById('inputArchivoFile').value='';
    document.getElementById('archivoNombreSeleccionado').textContent='';
    document.getElementById('modalArchivos').style.display='flex';
    cargarArchivos(idfactura);
}

function cerrarModalArchivos() {
    document.getElementById('modalArchivos').style.display='none';
    _modalFacturaId=null;
}

function cargarArchivos(idfactura) {
    document.getElementById('listaArchivos').innerHTML = '<div class="ep-loading" style="padding:20px;"><div class="ep-spinner"></div>Cargando...</div>';
    fetch('/api/v1/extranet.listararchivos/'+idfactura, {
        headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}
    })
    .then(r => r.json())
    .then(archivos => renderListaArchivos(archivos))
    .catch(() => { document.getElementById('listaArchivos').innerHTML = '<p style="color:var(--danger);font-size:13px;">Error al cargar.</p>'; });
}

function renderListaArchivos(archivos) {
    const cont = document.getElementById('listaArchivos');
    // Solo mostrar archivos tipo 1 (CDR del proveedor)
    const cdr = archivos.filter(a => !a.tipo || a.tipo == 1);
    if (!cdr.length) {
        cont.innerHTML = '<p style="color:var(--text-muted);font-size:13px;text-align:center;padding:16px 0;">Sin archivos CDR subidos aun.</p>';
        return;
    }
    const iconos = {pdf:'PDF',xml:'XML',zip:'ZIP',rar:'RAR',jpg:'IMG',jpeg:'IMG',png:'IMG'};
    let html = '<div style="display:flex;flex-direction:column;gap:8px;">';
    cdr.forEach(a => {
        html += `<div style="display:flex;align-items:center;justify-content:space-between;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:10px 14px;gap:10px;">
            <div style="display:flex;align-items:center;gap:10px;overflow:hidden;">
                <span style="font-size:11px;font-weight:700;background:var(--primary-light);color:var(--primary);padding:3px 7px;border-radius:6px;">${iconos[a.extension]||'FILE'}</span>
                <div style="overflow:hidden;">
                    <div style="font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${a.nombreoriginal}</div>
                    <div style="font-size:11px;color:var(--text-muted);">${formatDatetime(a.fecha_registro||a.fecharegistro)}</div>
                </div>
            </div>
            <div style="display:flex;gap:6px;flex-shrink:0;">
                <button class="ep-btn ep-btn-primary ep-btn-sm" onclick="verArchivoFactura('${a.ruta.replace(/'/g,"\\'")}','${a.extension}')">Ver</button>
                ${!_modalAprobado ? `<button class="ep-btn ep-btn-sm" style="background:var(--danger-light);color:var(--danger);border:1px solid #fca5a5;" onclick="eliminarArchivo(${a.id})">Eliminar</button>` : ''}
            </div>
        </div>`;
    });
    html += '</div>';
    cont.innerHTML = html;
}

async function subirArchivo() {
    if (!_modalFacturaId) return;
    const fileInput = document.getElementById('inputArchivoFile');
    if (!fileInput.files.length) { showToast('Selecciona un archivo','warning'); return; }
    const btn = document.getElementById('btnSubirArchivo');
    btn.disabled=true; btn.textContent='Subiendo...';
    const formData = new FormData();
    formData.append('idfacturaproveedor', _modalFacturaId);
    formData.append('file', fileInput.files[0]);
    try {
        const res  = await fetch('/api/v1/extranet.subirarchivo', { method:'POST', headers:{'X-CSRF-TOKEN':CSRF}, body:formData });
        const data = await res.json();
        if (data.success) {
            showToast('Archivo subido correctamente','success');
            fileInput.value=''; document.getElementById('archivoNombreSeleccionado').textContent='';
            cargarArchivos(_modalFacturaId);
        } else showToast(data.message||'Error al subir','error');
    } catch(e) { showToast('Error de conexion','error'); }
    finally { btn.disabled=false; btn.textContent='Subir Archivo'; }
}

async function eliminarArchivo(id) {
    if (!confirm('Eliminar este archivo?')) return;
    try {
        const res  = await fetch('/api/v1/extranet.eliminararchivo/'+id, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
        const data = await res.json();
        if (data.success) { showToast('Archivo eliminado','success'); cargarArchivos(_modalFacturaId); }
        else showToast(data.message,'error');
    } catch(e) { showToast('Error de conexion','error'); }
}

/* ── PREVIEW ARCHIVO ── */
function verArchivoFactura(ruta, extension) {
    const url  = '/admin/archivofacturaproveedor/' + encodeURIComponent(btoa(ruta));
    const cont = document.getElementById('filePreviewContainer');
    cont.innerHTML = '';
    if (extension === 'pdf') {
        cont.innerHTML = `<embed src="${url}" type="application/pdf" style="width:100%;height:500px;border-radius:8px;">`;
    } else if (['jpg','jpeg','png'].includes(extension)) {
        cont.innerHTML = `<img src="${url}" style="width:100%;height:auto;border-radius:8px;">`;
    } else {
        cont.innerHTML = `<div style="text-align:center;padding:32px;color:var(--text-muted);">
            <p style="font-size:14px;">Este tipo de archivo no se puede previsualizar.</p>
            <a href="${url}" class="ep-btn ep-btn-primary" style="margin-top:12px;display:inline-flex;" download>Descargar archivo</a>
        </div>`;
    }
    document.getElementById('filePreviewModal').style.display = 'flex';
}

function cerrarPreview() {
    document.getElementById('filePreviewModal').style.display='none';
    document.getElementById('filePreviewContainer').innerHTML='';
}

/* ── HELPERS ── */
function estadoBadge(idestado, tieneData) {
    if (idestado >= 2) return '<span class="ep-estado aprobado">Aprobado</span>';
    if (idestado == 3) return '<span class="ep-estado rechazado">Rechazado</span>';
    if (tieneData)     return '<span class="ep-estado completado">Enviado</span>';
    return '<span class="ep-estado pendiente">Pendiente</span>';
}
function tipoDocLabel(tipo) {
    const map = {FACTURA:'Factura',BOLETA:'Boleta',RH:'Rec. Honorarios',NINGUNO:'Sin documento'};
    return map[tipo]||tipo||'-';
}
function formatFecha(fecha) {
    if (!fecha) return '-';
    const [y,m,d] = fecha.split('-');
    return `${d}/${m}/${y}`;
}
function formatDatetime(dt) {
    if (!dt) return '-';
    const [fecha, hora] = dt.split(' ');
    return `${formatFecha(fecha)} ${hora?hora.substring(0,5):''}`;
}
function loadingHTML() { return `<div class="ep-loading"><div class="ep-spinner"></div>Cargando...</div>`; }
function errorHTML() { return emptyHTML('', 'Error al cargar. Intenta nuevamente.'); }
function emptyHTML(icon, msg) { return `<div class="ep-empty"><div class="ep-empty-icon">${icon}</div><p>${msg}</p></div>`; }
function showToast(msg, type='success') {
    const t = document.getElementById('epToast');
    t.textContent = msg; t.className = `ep-toast ${type}`; t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3800);
}

function activarEdicion(id, tipo, factura, monto) {
    document.querySelectorAll(`#fila-hist-${id} .hist-val`).forEach(el => el.style.display = 'none');
    document.querySelectorAll(`#fila-hist-${id} .hist-edit`).forEach(el => el.style.display = 'block');
    document.getElementById(`btn-normal-${id}`).style.display = 'none';
    document.getElementById(`btn-edit-${id}`).style.display   = 'flex';
    document.getElementById(`edit-factura-${id}`)?.focus();
}

function cancelarEdicion(id, tipo, factura, monto) {
    const mapTipo = {FACTURA:'Factura',BOLETA:'Boleta',RH:'Rec. Honorarios',NINGUNO:'Sin documento'};
    const sv = document.querySelectorAll(`#fila-hist-${id} .hist-val`);
    if (sv[0]) sv[0].textContent = mapTipo[tipo]||tipo||'-';
    if (sv[1]) sv[1].textContent = factura||'-';
    if (sv[2]) sv[2].textContent = 'S/ ' + parseFloat(monto||0).toFixed(2);
    const sel = document.getElementById(`edit-tipo-${id}`);
    const inf = document.getElementById(`edit-factura-${id}`);
    const inm = document.getElementById(`edit-monto-${id}`);
    if (sel) sel.value = tipo||'';
    if (inf) inf.value = factura||'';
    if (inm) inm.value = monto||'';
    document.querySelectorAll(`#fila-hist-${id} .hist-val`).forEach(el => el.style.display = '');
    document.querySelectorAll(`#fila-hist-${id} .hist-edit`).forEach(el => el.style.display = 'none');
    document.getElementById(`btn-normal-${id}`).style.display = 'flex';
    document.getElementById(`btn-edit-${id}`).style.display   = 'none';
}

async function guardarEdicion(id) {
    const tipo    = document.getElementById(`edit-tipo-${id}`)?.value||'';
    const factura = document.getElementById(`edit-factura-${id}`)?.value.trim()||'';
    const monto   = document.getElementById(`edit-monto-${id}`)?.value||'';
    if (!tipo || !factura || !monto) { showToast('Completa todos los campos', 'warning'); return; }

    const btnGuardar = document.querySelector(`#btn-edit-${id} button`);
    btnGuardar.disabled = true; btnGuardar.textContent = 'Guardando...';
    try {
        const res  = await fetch('/api/v1/extranet.editar', {
            method:'POST',
            headers:{'X-CSRF-TOKEN':CSRF,'Content-Type':'application/json','Accept':'application/json'},
            body: JSON.stringify({ idfacturaproveedor:id, tipodocumento:tipo, codigofactura:factura, monto:parseFloat(monto) })
        });
        const data = await res.json();
        if (data.success) {
            showToast('Factura actualizada correctamente', 'success');
            const mapTipo = {FACTURA:'Factura',BOLETA:'Boleta',RH:'Rec. Honorarios',NINGUNO:'Sin documento'};
            const sv = document.querySelectorAll(`#fila-hist-${id} .hist-val`);
            if (sv[0]) sv[0].textContent = mapTipo[tipo]||tipo;
            if (sv[1]) sv[1].textContent = factura;
            if (sv[2]) sv[2].textContent = 'S/ ' + parseFloat(monto).toFixed(2);
            document.querySelectorAll(`#fila-hist-${id} .hist-val`).forEach(el => el.style.display = '');
            document.querySelectorAll(`#fila-hist-${id} .hist-edit`).forEach(el => el.style.display = 'none');
            document.getElementById(`btn-normal-${id}`).style.display = 'flex';
            document.getElementById(`btn-edit-${id}`).style.display   = 'none';
        } else { showToast(data.message||'Error al guardar', 'error'); }
    } catch(e) { showToast('Error de conexion', 'error'); }
    finally { btnGuardar.disabled=false; btnGuardar.textContent='Guardar'; }
}

</script>

</x-app-layout>