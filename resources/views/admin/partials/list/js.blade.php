<script>
    //Search focus by press "/"
    $(function() {
        Mousetrap.bind(['/'], function() {
            $('.search-input').focus();
            $('.search-input').select();
            return false;
        });
        Mousetrap.bind(['esc'], function() {
            cancelSelection();
            hideGlobalOptions();
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
    });


    // //Filters
    // function showHideFilters() {
    //     window.event.preventDefault();
    //     const element = document.querySelector('#filters');
    //     if ($(element).hasClass('hidden')) {
    //         element.classList.remove('hidden');
    //         element.classList.replace('fadeOutUp', 'fadeInDown');
    //         element.addEventListener('animationend', () => {
    //             element.classList.remove('hidden');
    //         });
    //     } else {
    //         element.classList.replace('fadeInDown', 'fadeOutUp');
    //         element.addEventListener('animationend', () => {
    //             element.classList.add('hidden');
    //         });
    //     }
    // }


    // Modals
    function showHideFilters() {
        const filters = document.querySelector('#filters');
        const backdrop = document.querySelector('#filters-backdrop');
        filters.classList.toggle("hidden");
        filters.classList.toggle("animated");
        filters.classList.toggle("fadeIn");
        backdrop.classList.toggle("hidden");
        filters.classList.toggle("flex");
        backdrop.classList.toggle("flex");
    }

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
    function rowSelect(element) {
        $(element).siblings('.select').find('.mark').trigger('click');
    }

    function showHideRowOptions(element) {
        if ($(element).is(':checked')) {
            $(element).parents('tr').addClass('selected');
        } else {
            $(element).parents('tr').removeClass('selected');
        }

        elements = $(".mark:checked").length;
        if (elements > 0) {
            hideGlobalOptions();
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

    function showRowOptions() {
        $(".table-wrap").addClass('mb-24');
        $(".selected-options").addClass('fadeInUp');
        $(".selected-options").removeClass('fadeOutDown hidden');
    }
    function hideRowOptions() {
        $("#allMark").prop("checked", false);
        $(".table-wrap").removeClass('mb-24');
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
        $(".table-wrap").addClass('mb-24');
        $(".global-options").addClass('fadeInUp');
        $(".global-options").removeClass('fadeOutDown hidden');
    }
    function hideGlobalOptions() {
        $(".table-wrap").removeClass('mb-24');
        $(".global-options").removeClass('fadeInUp');
        $(".global-options").addClass('fadeOutDown');
    }

    function changeSort(field, direction) {
        $("#sortField").val(field);
        if (!direction) {
            $("#sortDirection").val('asc');
        } else if (direction == 'asc') {
            $("#sortDirection").val('desc');
        } else {
            $("#sortDirection").val('asc');
        }
        applyFilters();
    }

    function applyFilters() {
        disabledActionsButtons();
        $("#frmFilter").submit();
    }

    //edit
    function edit() {
        var element = $(".mark:checked");
        var id = $(element).parents('tr').attr('data-id');
        var route = "{{ route('admin.users.edit', ':ID') }}";
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    //destroy
    function destroy() {
        // window.event.preventDefault();
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
                var route = "{{ route('admin.users.destroy', ':IDS') }}"
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

    //destroy
    function duplicate() {
        disabledActionsButtons();
        var route = "{{ route('admin.users.duplicate', ':IDS') }}"
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
                var route = "{{ route('admin.users.export', [':FORMAT', ':IDS', ':FILENAME', $sortField, $sortDirection]) }}";
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
                var route = "{{ route('admin.users.export.global', [':FORMAT', ':FILENAME', $sortField, $sortDirection, $filterName]) }}";
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
</script>