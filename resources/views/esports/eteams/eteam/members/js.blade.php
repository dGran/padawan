<script>
	$("#request").on('click', function(){

		window.event.preventDefault();
        swal({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas enviar la la solicitud de ingreso?',
            buttons: {
                confirm: {
                    text: "Sí, estoy seguro",
                    value: true,
                    visible: true,
                    className: "bg-blue-500 text-white active:bg-blue-600 focus:bg-blue-600 hover:bg-blue-600 font-medium uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1",
                    closeModal: true
                },
                cancel: {
                    text: "No, cancelar",
                    value: null,
                    visible: true,
                    className: "bg-gray-500 text-white active:bg-gray-600 focus:bg-gray-600 hover:bg-gray-600 font-medium uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1",
                    closeModal: true,
                }
            },
			content: {
				element: "input",
				attributes: {
					placeholder: "Escribe un mensaje a los capitanes",
					className: "px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full",
					type: "text",
				},
			},
            closeOnClickOutside: false,
            closeOnEsc: false,
        })
        .then((value) => {
            if (value) {
		 		console.log(value);
            }
        });

	});
</script>