<script>
    //Search focus by press "/"
    $(function() {
        Mousetrap.bind(['/'], function() {
            $('.search-input').focus();
            return false;
        });
    });

    //disable buttons
    function disabledActionsButtons() {
        $('a').addClass('disabled');
        $('button').attr("disabled", "disabled");
    }

    function enabledActionsButtons() {
        $('a').removeClass('disabled');
        $('button').removeAttr("disabled");
    }

    //Table RowSelect
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
            $(".table-wrap").addClass('mb-24');
            $(".selected-regs").addClass('fadeInUp');
            $(".selected-regs").removeClass('fadeOutDown hidden');
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
            $("#allMark").prop("checked", false);
            $(".table-wrap").removeClass('mb-24');
            $(".selected-regs").removeClass('fadeInUp hidden');
            $(".selected-regs").addClass('fadeOutDown');
        }
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
        // $(".hint--").css('visibility', 'visble');
        // $(".hint--").css('opacity', '1');
        $(".mark").prop('checked', false);
        $(".mark").parents('tr').removeClass('selected');
        $("#allMark").prop('checked', false);
        showHideRowOptions();
    }

    //Filters
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
        var route = $(element).parents('tr').attr('url-edit');
        var url = route.replace(':ID', id);
        window.location.href=url;
    }

    //destroy
    function destroy() {
        // window.event.preventDefault();
        disabledActionsButtons();
        swal({
            title: "¿Estás seguro?",
            text: 'Se van a eliminar los registros seleccionados. No se podrán deshacer los cambios!',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "swal-btn danger",
                    closeModal: true
                },
                cancel: {
                    text: "No, cancelar",
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
                var route = $(".mark:checked").parents('tr').attr('url-destroy');
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
        var route = $(".mark:checked").parents('tr').attr('url-duplicate');
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
            title: "Exportar los registros seleccionados",
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

                var route = $(".mark:checked").parents('tr').attr('url-export');
                var ids = [];
                $(".mark:checked").each(function() {
                    ids.push($(this).val());
                });
                var url = route.replace(':IDS', ids);
                url = url.replace(':FORMAT', fileType);
                url = url.replace(':FILENAME', filename);
                window.location.href=url;

                // $(location).attr('href', 'equipos/exportar/' + filename + '/' + type + '/' + filterName + '/' + filterCategory + '/' + order + '/' + ids);
            }
        });
    }
</script>