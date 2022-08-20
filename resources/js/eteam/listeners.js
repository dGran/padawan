window.addEventListener("action-success", event => {
    toastr.success(event.detail.message)
});

window.addEventListener("action-info", event => {
    toastr.info(event.detail.message)
});

window.addEventListener("action-warning", event => {
    toastr.warning(event.detail.message)
});

window.addEventListener("action-error", event => {
    toastr.error(event.detail.message)
});