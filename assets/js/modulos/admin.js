const formulario = document.querySelector('#formulario');
const btnAccion = document.querySelector('#btnAccion');


const nit = document.querySelector('#nit');
const nombre = document.querySelector('#nombre');
const telefono = document.querySelector('#telefono');
const correo = document.querySelector('#correo');
const direccion = document.querySelector('#direccion');

const errorNit = document.querySelector('#errorNit');
const errorNombre = document.querySelector('#errorNombre');
const errorTelefono = document.querySelector('#errorTelefono');
const errorCorreo = document.querySelector('#errorCorreo');
const errorDireccion = document.querySelector('#errorDireccion');

document.addEventListener('DOMContentLoaded', function(){
    //Inicializar un Editor
    ClassicEditor
    .create( document.querySelector( '#mensaje' ),{
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
    } )
    .catch( error => {
        console.error( error );
    } );

    //actualizar datos
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        errorNit.textContent = '';
        errorNombre.textContent = '';
        errorTelefono.textContent = '';
        errorCorreo.textContent = '';
        errorDireccion.textContent  = '';

        if (nit.value == '') {
            errorNit.textContent = 'EL NIT ES REQUERIDO'
        } else if(nombre.value == ''){
            errorNombre.textContent = 'EL NOMBRE ES REQUERIDO'
        }else if(telefono.value == ''){
            errorTelefono.textContent = 'EL TELEFONO ES REQUERIDO'
        }else if(correo.value == ''){
            errorCorreo.textContent = 'EL CORREO ES REQUERIDO'
        }else if(direccion.value == ''){
            errorDireccion.textContent = 'LA DIRECCIÓN ES REQUERIDO'
        }else{
            const url = base_url + 'admin/modificar'; 
            insertarRegistros(url,this,null,btnAccion,false);

            //crear formData
            //const data = new FormData(this);
            //hacer una instancia del objeto XMLHttpRequest
            //const http = new XMLHttpRequest();
            //abrir una conexion - POST - GET
            
            //http.open('POST',url,true);
            
            //Enviar datos
            
            //http.send(data);
            
            //verificar estados
            /*
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    Swal.fire({
                        toast: true,
                        position: 'top-center',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                       timer: 2000
                    })

                }
            }*/
        }

        
    })

})
