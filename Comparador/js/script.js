window.onload = function (){

    let botonEnviar = document.getElementById("boton");

    botonEnviar.addEventListener("submit", enviarFormulario);

    function enviarFormulario(){

        let inputs = document.getElementsByTagName("input");

        let done = false;

        //Se pone menos 1 ya que el boton tambien es un input y no queremos leerlo
        for (let i = 0; i < inputs.length-2; i++) {
            if (inputs[i].value.length < 2 || inputs[i].value.length > 100 ){
                done = true;
            }
        }

        if (!done){
            //TODO BIEN

            document.getElementById("formularioRegistro").submit();
        }else{
            console.log("Formulario no valido");
        }
    }
};