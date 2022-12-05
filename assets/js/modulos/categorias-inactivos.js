let tblCategorias;
document.addEventListener('DOMContentLoaded',function (){
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            //manda al controlador categorias funcion "listar"
            url: base_url + 'categorias/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'nom_categoria' },
            { data: 'fecha' },
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
function restaurarCategoria(idCategoria){
    const url = base_url + 'categorias/restaurar/'+idCategoria;
    restaurarRegistro(url,tblCategorias);
}