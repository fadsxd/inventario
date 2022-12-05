let tblProveedores;
document.addEventListener('DOMContentLoaded',function () {
    tblProveedores = $('#tblProveedores').DataTable({
        ajax: {
            //manda al controlador categorias funcion "listar"
            url: base_url + 'proveedor/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'nit' },
            { data: 'nombre' },
            { data: 'telefono' },
            { data: 'direccion' },
            { data: 'acciones' },
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'asc']],
    });
})
function restaurarProveedor(idProveedor) {
    const url = base_url + 'proveedor/restaurar/'+idProveedor;
    restaurarRegistro(url,tblProveedores);
}