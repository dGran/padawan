<div class="info">
    <div class="title">Opciones globales de tabla</div>
    <button id="hideOptions" onclick="hideGlobalOptions()">
        <i class="fas fa-times-circle"></i>
    </button>
</div>
<div class="elements">
    <div class="scroll pt-4">
        <button class="hint--top-right hint--rounded hint--bounce mr-2" type="button" aria-label="Generar resto de participantes" id="generate_participants" onclick="generateParticipants()">
            <i class="fas fa-magic"></i>
        </button>

        @isset($import)
            <form id="frmImport" role="form"
                method="POST"
                action="{{ route('admin.participants.import', [$tournament, $season]) }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="fileImport" id="fileImport" class="hidden">
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Importar" onclick="importFile()">
                    <i class="icon-import"></i>
                </button>
            </form>
        @endisset

        @isset($export)
            <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xls)" onclick="exportFileGlobal('participants_global', 'xls')">
                <i class="icon-xls"></i>
            </button>
            <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xlsx)" onclick="exportFileGlobal('participants_global', 'xlsx')">
                <i class="icon-xlsx"></i>
            </button>
            <button class="hint--top-left hint--rounded hint--bounce" type="button" aria-label="Exportar (.csv)"  onclick="exportFileGlobal('participants_global', 'csv')">
                <i class="icon-csv"></i>
            </button>
        @endisset
    </div>
</div>