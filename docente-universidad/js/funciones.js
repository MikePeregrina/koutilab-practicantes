document.addEventListener("DOMContentLoaded", function () {
    $('#tbl').DataTable();
    $(".confirmar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: '¡Cancelar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    })

})



