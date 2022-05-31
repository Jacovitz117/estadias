
        
        function Eliminar(id)
        {
            if (confirm("¿Esta seguro que desea eliminar este producto?")) 
            {
                location.href = "productos.php?ideliminar=" + id;
            }
        }
        
        function solonumeros(evt)
        {
            if(window.event){
                keynum = evt.keyCode;
            }
            else{
                keynum = evt.which;
            }
            if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == '-')
            {
                return true;
            }
            else
            {
             swal.fire('Alerta !!!','Por escriba solo números','error',2000)
             //alert("Ingresar Solo Numeros");
             return false;
            }
        }
        
        function sololetras(e)
        {
           key = e.keyCode || e.which;
           teclado = String.fromCharCode(key).toLowerCase();
           letras = "abcdefghiíjklmnñopqrstuvwxyz. ";

           especiales = "8-37-38-46-164";

           teclado_especial= false;

           for(var i in especiales=false){
            if(key==especiales[i]){
              teclado_especial=true;break;
            }
           }

           if(letras.indexOf(teclado)==-1 && !teclado_especial){
             swal.fire('Cuidado !!!','En este campo solo puedes escribir letras','error',2000)
             //alert("Ingresar Solo Letras");
             return false;
           }
 
        }

        //Funcion para notificar
        function notificacion(el,msg){
        // agrega un elemento p con el texto luego del input seleccionado
        if(!$(el).next().is("p")){
        $(el).after(`<p>${msg}</p>`);
        // elimina el mensaje luego de 2 segundos
        setTimeout(function(){ $(el).next().remove();}, 2000)
        }
        }

        function sololetrasas(e)
        {
           key = e.keyCode || e.which;
           teclado = String.fromCharCode(key).toLowerCase();
           letras = "abcdefghijklmnñopqrstuvwxyz ";

           especiales = "8-37-38-46-164";

           teclado_especial= false;

           for(var i in especiales=false){
            if(key==especiales[i]){
              teclado_especial=true;break;
            }
           }

           if(letras.indexOf(teclado)==-1 && !teclado_especial){
             //alert("Ingresar Solo Letras");
             echo (notificacion(input.nombre_cat,"Verifique los datos nuevamente, solo puedes ingresar letras"));
             
             return false;
           }
 
        }

        function select(e)
        {
            var select = document.getElementById('txtPrivilegio');
            if (select == "") {
                swal.fire('Cuidado !!!','Por favor elige una opción','error',2000) 
                // alert("Please select a selection");
                return false;
 
        }

        function fileValidation(e)
        {
            var fileInput = document.getElementById('input-file-now');
            var filePath = fileInput.value;
            var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
            if(!allowedExtensions.exec(filePath))
            {
                swal.fire('Cuidado !!!','Por favor elige una imagen solo los siguientes formatos .jpeg/.jpg/.png/.gif.','error',2000) 
                //alert('Por favor elige una imagen solo los siguientes formatos .jpeg/.jpg/.png/.gif.');
                fileInput.value = '';
                return false;
            }
            else
            {
                //Image preview
                if (fileInput.files && fileInput.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function(e) 
                    {
                        document.getElementById('imagePreview').innerHTML = '<img="'+e.target.result+'"/>';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }}
