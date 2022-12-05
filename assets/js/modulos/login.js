const formulario = document.querySelector('#formulario');

const correo = document.querySelector('#correo'); //agarra el id del formulario login.php
const clave = document.querySelector('#clave');

const errorCorreo = document.querySelector('#errorCorreo');
const errorClave = document.querySelector('#errorClave');

document.addEventListener('DOMContentLoaded', function(){
    formulario.addEventListener('submit',function (e) {
        e.preventDefault();
        errorCorreo.textContent = '';
        errorClave.textContent = '';
        
        if (correo.value == '') {
            //cambia el contenido del texto
            errorCorreo.textContent = 'EL CORREO ES REQUERIDO';
        }else if(clave.value == ''){
            errorClave.textContent = 'LA CONTRASEÑA ES REQUERIDA';
        }else{
            const url = base_url + 'home/validar'; 
            //crear formData
            const data = new FormData(this);
            //hacer una instancia del objeto XMLHttpRequest
            const http = new XMLHttpRequest();
            //abrir una conexion - POST - GET
            http.open('POST',url,true);
            //Enviar datos
            http.send(data);
            //verificar estados
            http.onreadystatechange = function(){
                
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    Swal.fire(
                        'Mensaje?',
                        res.msg,
                        res.type
                      )
                    if(res.type == 'success'){
                       setTimeout(() => {
                        let timerInterval
                        Swal.fire({
                        title: res.msg,
                        html: 'Bienvenido al Sistema',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                        }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location = base_url + 'admin';
                        }
                        })
                       }, 2000);
                    }
               
                    //alert(res.msg);
                    //console.log(this.responseText);
                }
            }
        }
    });
})