let tblClientes;
document.addEventListener('DOMContentLoaded',function () {
    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            //manda al controlador categorias funcion "listar"
            url: base_url + 'clientes/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'tipo_documento' },
            { data: 'numero_identidad' },
            { data: 'nombre' },
            { data: 'telefono' },
            { data: 'correo' },
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

function restaurarCliente(idCliente){
    const url = base_url + 'clientes/restaurar/'+ idCliente;
    restaurarRegistro(url,tblClientes);
}