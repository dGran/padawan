<div class="info">
    <div class="selected-regs-count"></div>
    <button id="hideOptions" onclick="cancelSelection()">
        <i class="fas fa-times-circle"></i>
    </button>
</div>
<div class="elements">
    <div class="scroll pt-4">
        @isset($edit)
            <button class="hint--top-right hint--rounded hint--bounce mr-2" type="button" aria-label="Editar" id="edit" onclick="edit()">
                <i class="icon-edit"></i>
            </button>
        @endisset
        @isset($view)
            <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Ver" id="view" onclick="view()">
                <i class="icon-view"></i>
            </button>
        @endisset
        @isset($destroy)
            <button class="hint--top-right hint--error hint--rounded hint--bounce danger-btn mr-2" type="button" aria-label="Eliminar" id="destroy" onclick="destroy()">
                <i class="icon-trash"></i>
            </button>
        @endisset
        @isset($duplicate)
            <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Duplicar" onclick="duplicate()">
                <i class="icon-duplicate"></i>
            </button>
        @endisset
        @isset($bookmarkAdd)
            <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Agregar a tabla de apoyo">
                <i class="icon-bookmark-add"></i>
            </button>
        @endisset
        @isset($export)
            <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xls)" onclick="exportFile('circuits', 'xls')">
                <i class="icon-xls"></i>
            </button>
            <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xlsx)" onclick="exportFile('circuits', 'xlsx')">
                <i class="icon-xlsx"></i>
            </button>
            <button class="hint--top-left hint--rounded hint--bounce" type="button" aria-label="Exportar (.csv)"  onclick="exportFile('circuits', 'csv')">
                <i class="icon-csv"></i>
            </button>
        @endisset
    </div>
</div>