let tblProductos;
document.addEventListener('DOMContentLoaded',function () {
    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            //manda al controlador categorias funcion "listar"
            url: base_url + 'productos/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'precio_compra' },
            { data: 'precio_venta' },
            { data: 'cantidad' },
            { data: 'medida' },
            { data: 'nom_categoria' },
            { data: 'imagen' },
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

function restaurarProducto(idProducto){
    const url= base_url + 'productos/restaurar/'+ idProducto;
    restaurarRegistro(url,tblProductos);
}