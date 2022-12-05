let tblClientes;

const formulario = document.querySelector('#formulario');
const btnAccion = document.querySelector('#btnAccion');

const btnNuevo = document.querySelector('#btnNuevo');

const id = document.querySelector('#id_usuario');
const nombre = document.querySelector('#nombre');
const telefono = document.querySelector('#telefono');
const correo = document.querySelector('#correo');
const direccion = document.querySelector('#direccion');
const documento = document.querySelector('#documento');
const numero = document.querySelector('#numero');



const errorNombre = document.querySelector('#errorNombre');
const errorTelefono = document.querySelector('#errorTelefono');
//const errorCorreo = document.querySelector('#errorCorreo');
const errorDireccion = document.querySelector('#errorDireccion');
const errorDocumento = document.querySelector('#errorDocumento');
const errorNumero = document.querySelector('#errorNumero');



document.addEventListener('DOMContentLoaded', function () {
    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            //manda al controlador categorias funcion "listar"
            url: base_url + 'clientes/listar',
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
        // limpiar campos
    btnNuevo.addEventListener('click',function () {
        id.value = '';
        btnAccion.textContent = 'Registrar';
        formulario.reset();
        limpiarCampos();
    })


    //registrar clientes
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        limpiarCampos();
        if (nombre.value == '') {
            errorNombre.textContent = 'LA NOMBRE ES REQUERIDO (*)';
        } else if (telefono.value == '') {
            errorTelefono.textContent = 'LA TELEFONO ES REQUERIDO (*)';
        } else if (direccion.value == '') {
            errorDireccion.textContent = 'LA DIRECCIÓN ES REQUERIDO (*)';
        } else if (documento.value == '') {
            errorDocumento.textContent = 'EL TIPO DE DOCUMENTO REQUERIDO (*)';
        } else if (numero.value == '') {
            errorNumero.textContent = 'EL N° DE DOCUMENTO ES REQUERIDO (*)';
        } else {
            const url = base_url + 'clientes/registrar';
            insertarRegistros(url, this, tblClientes, btnAccion, false);
        }
    })
})

function eliminarCliente(idCliente) {
    const url = base_url + 'clientes/eliminar/' + idCliente;
    eliminarRegistro(url, tblClientes);
}
function editarCliente(idCliente) {
    limpiarCampos();
    const url = base_url + 'clientes/editar/' + idCliente;
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
            id.value = res.id_cliente;
            nombre.value = res.nombre;
            telefono.value = res.telefono;
            correo.value = res.correo;
            direccion.value = res.direccion;
            documento.value = res.tipo_documento;
            numero.value = res.numero_identidad;

            btnAccion.textContent = 'Actualizar';
            firstTab.show()
        }
    }
}
function limpiarCampos() {
    errorNombre.textContent = '';
    errorTelefono.textContent = '';
    errorCorreo.textContent = '';
    errorDireccion.textContent = '';
    errorDocumento.textContent = '';
    errorNumero.textContent = '';
}