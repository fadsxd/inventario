let tblCategorias;
const formulario = document.querySelector('#formulario');

const id = document.querySelector('#id_usuario');

const nombre = document.querySelector('#nombre');
const btnAccion = document.querySelector('#btnAccion');

const btnNuevo = document.querySelector('#btnNuevo');

const errorNombre = document.querySelector('#errorNombre');


document.addEventListener('DOMContentLoaded', function () {
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            //manda al controlador categorias funcion "listar"
            url: base_url + 'categorias/listar',
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

    btnNuevo.addEventListener('click',function(){
        id.value = '';
        errorNombre.textContent = '';
        btnAccion.textContent = 'Registrar';
        formulario.reset();
      
       
    })
    //registrar categorias
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        errorNombre.textContent = '';
        if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES REQUERIDO (*)';
        } else {
            const url = base_url + 'categorias/registrar';
            insertarRegistros(url, this, tblCategorias, btnAccion, false);
        }
    });

})

function eliminarCategoria(idCategoria) {
    const url = base_url + 'categorias/eliminar/' + idCategoria;
    eliminarRegistro(url, tblCategorias);
}
function editarCategoria(idCategoria) {
    errorNombre.textContent = '';
    const url = base_url + 'categorias/editar/' + idCategoria;
    //hacer una instancia del objeto XMLHttpRequest
    const http = new XMLHttpRequest();
    //abrir una conexion - POST - GET
    http.open('GET', url, true);
    //Enviar datos
    http.send();
    //verificar estados
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            id_usuario.value = res.id_categoria;
            nombre.value = res.nom_categoria;
            btnAccion.textContent = 'Actualizar';
            firstTab.show()
        }
    }
}

