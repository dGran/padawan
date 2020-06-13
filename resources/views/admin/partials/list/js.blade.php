<script>
    $(function() {
        Mousetrap.bind(['/'], function() {
            $('.search-input').focus();
            $('.search-input').select();
            return false;
        });
        Mousetrap.bind(['esc'], function() {
            cancelSelection();
            hideGlobalOptions();
            hideFilters();
            return false;
        });
        Mousetrap.bind(['alt+f'], function() {
            showHideFilters()
            return false;
        });
        Mousetrap.bind(['alt+t'], function() {
            showHideGlobalOptions();
            return false;
        });
        Mousetrap.bind(['alt+n'], function() {
            add();
            return false;
        });
        checkRowSelected();
    });

    //disable buttons - REVIEW CLASSES
    function disabledActionsButtons() {
        $('a').addClass('disabled');
        $('button').attr("disabled", "disabled");
    }

    function enabledActionsButtons() {
        $('a').removeClass('disabled');
        $('button').removeAttr("disabled");
    }

    //Selected regs
    function checkRowSelected() {
        elements = $(".mark:checked").length;
        if (elements > 0) {
            hideGlobalOptions();
            hideFilters();
            showRowOptions();
            if (elements == 1) {
                $(".selected-regs-count").text($(".mark:checked").parents('tr').attr('data-name'));
                $("#edit").show();
                $("#view").show();
                $("#destroy").removeClass('hint--top-right');
                $("#destroy").addClass('hint--top');
            } else {
                $(".selected-regs-count").text(elements + ' registros seleccionados');
                $("#edit").hide();
                $("#view").hide();
                $("#destroy").removeClass('hint--top');
                $("#destroy").addClass('hint--top-right');
            }
        } else {
            hideRowOptions();
        }
    }

    function rowSelect(element) {
        $(element).siblings('.select').find('.mark').trigger('click');
    }

    function showHideRowOptions(element) {
        if ($(element).is(':checked')) {
            $(element).parents('tr').addClass('selected');
        } else {
            $(element).parents('tr').removeClass('selected');
        }
        checkRowSelected();
    }

    function showRowOptions() {
        $(".table-wrap").addClass('mb-32');
        $(".selected-options").addClass('fadeInUp');
        $(".selected-options").removeClass('fadeOutDown hidden');
    }
    function hideRowOptions() {
        $("#allMark").prop("checked", false);
        $(".table-wrap").removeClass('mb-32');
        $(".selected-options").removeClass('fadeInUp');
        $(".selected-options").addClass('fadeOutDown');
    }

    function showHideAllRowOptions() {
        if ($("#allMark").is(':checked')) {
            $(".mark").prop('checked', true);
            $(".mark").parents('tr').addClass('selected');
        } else {
            $(".mark").prop('checked', false);
            $(".mark").parents('tr').removeClass('selected');
        }
        showHideRowOptions();
    }

    function cancelSelection() {
        $(".mark").prop('checked', false);
        $(".mark").parents('tr').removeClass('selected');
        $("#allMark").prop('checked', false);
        showHideRowOptions();
    }

    //Global Options
    function showHideGlobalOptions() {
        window.event.preventDefault();
        cancelSelection();
        if ($('.global-options').hasClass('hidden') || $('.global-options').hasClass('fadeOutDown')) {
            showGlobalOptions();
        } else {
            hideGlobalOptions();
        }
    }
    function showGlobalOptions() {
        cancelSelection();
        hideFilters();
        $(".table-wrap").addClass('mb-32');
        $(".global-options").addClass('fadeInUp');
        $(".global-options").removeClass('fadeOutDown hidden');
    }
    function hideGlobalOptions() {
        $(".table-wrap").removeClass('mb-32');
        $(".global-options").removeClass('fadeInUp');
        $(".global-options").addClass('fadeOutDown');
    }

    //Filters
    function showHideFilters() {
        if ($('#filters').hasClass('hidden')) {
            showFilters();
        } else {
            hideFilters();
        }
    }
    function showFilters() {
        cancelSelection();
        hideGlobalOptions();
        const filters = document.querySelector('#filters');
        const backdrop = document.querySelector('#filters-backdrop');
        filters.classList.remove("hidden");
        filters.classList.add("animated", "fadeIn", "flex");
        backdrop.classList.remove("hidden");
        backdrop.classList.add("flex");
    }
    function hideFilters() {
        const filters = document.querySelector('#filters');
        const backdrop = document.querySelector('#filters-backdrop');
        filters.classList.add("hidden");
        filters.classList.remove("animated", "fadeIn", "flex");
        backdrop.classList.add("hidden");
        backdrop.classList.remove("flex");
    }

    function cancelFilterName() {
        $("#filterName").val('');
        applyFilters();
    }

    function applyFilters() {
        disabledActionsButtons();
        $("#frmFilter").submit();
    }

    //add
    function add() {
        window.location.href=routeAdd;
    }

    //edit
    function edit() {
        var element = $(".mark:checked");
        var id = $(element).parents('tr').attr('data-id');
        var route = routeEdit;
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    //view
    function view() {
        var element = $(".mark:checked");
        var id = $(element).parents('tr').attr('data-id');
        var route = routeView;
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    //destroy
    function destroy() {
        disabledActionsButtons();
        swal({
            title: "Confirmación de borrado",
            text: 'Se van a eliminar los registros seleccionados. No se podrán deshacer los cambios!',
            buttons: {
                confirm: {
                    text: "Eliminar",
                    value: true,
                    visible: true,
                    className: "swal-btn danger",
                    closeModal: true
                },
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "swal-btn default",
                    closeModal: true,
                }
            },
            closeOnClickOutside: false,
        })
        .then((value) => {
            if (value) {
                var route = routeDestroy;
                var ids = [];
                $(".mark:checked").each(function() {
                    ids.push($(this).val());
                });
                var url = route.replace(':IDS', ids);
                window.location.href=url;
            } else {
                enabledActionsButtons();
            }
        });
    }

    //duplicate
    function duplicate() {
        disabledActionsButtons();
        var route = routeDuplicate;
        var ids = [];
        $(".mark:checked").each(function() {
            ids.push($(this).val());
        });
        var url = route.replace(':IDS', ids);
        window.location.href=url;
    }

    //export
    function exportFile(default_name, fileType) {
        var ids = [];
        $(".mark:checked").each(function() {
            ids.push($(this).val());
        });

        swal({
            title: "Exportar registros seleccionados (." + fileType + ")",
            text: 'Introduce nombre del archivo (opcional)',
            content: "input",
            buttons: {
                confirm: {
                    text: "Continuar",
                    value: true,
                    visible: true,
                    className: "swal-btn success",
                    closeModal: true
                },
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "swal-btn default",
                    closeModal: true,
                }
            },
        })
        .then((value) => {
            if (value != null) {
                var filename = `${value}`;
                if (!filename ) {
                    var time = Math.floor(new Date().getTime() / 1000);
                    var filename = default_name + time;
                }
                var route = routeExport;
                var ids = [];
                $(".mark:checked").each(function() {
                    ids.push($(this).val());
                });
                var url = route.replace(':IDS', ids);
                url = url.replace(':FORMAT', fileType);
                url = url.replace(':FILENAME', filename);
                window.location.href=url;
            }
        });
    }

    function exportFileGlobal(default_name, fileType) {
        swal({
            title: "Exportar tabla completa (." + fileType + ")",
            text: 'Introduce nombre del archivo (opcional)',
            content: "input",
            buttons: {
                confirm: {
                    text: "Continuar",
                    value: true,
                    visible: true,
                    className: "swal-btn success",
                    closeModal: true
                },
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "swal-btn default",
                    closeModal: true,
                }
            },
        })
        .then((value) => {
            if (value != null) {
                var filename = `${value}`;
                if (!filename ) {
                    var time = Math.floor(new Date().getTime() / 1000);
                    var filename = default_name + time;
                }
                var route = routeExportGlobal;
                var url = route.replace(':FORMAT', fileType);
                url = url.replace(':FILENAME', filename);
                window.location.href=url;
            }
        });
    }

    //import
    function importFile() {
        swal({
            title: "Importar datos",
            text: 'Se van a importar los datos del archivo seleccionado, pulsa continuar y selecciona el archivo que contiene los datos (.xls, .xlsx, .csv).',
            buttons: {
                confirm: {
                    text: "Continuar",
                    value: true,
                    visible: true,
                    className: "swal-btn success",
                    closeModal: true
                },
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "swal-btn default",
                    closeModal: true,
                }
            },
            closeOnClickOutside: false,
        })
        .then((value) => {
            if (value) {
                $("#fileImport").trigger('click');
            }
        });
    }

    $('#fileImport').change(function(){
        $("#frmImport").submit();
    });

    $("#frmImport").submit(function(event) {
        swal("Importando datos, por favor espere...", {
            button: false,
        });
    });

    function changeSort(order) {
        $("#order").val(order);
        applyFilters();
    }
</script>