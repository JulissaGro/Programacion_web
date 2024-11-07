const sFechaHora = document.querySelector('#s-fecha-hora');
const btnGetFechaHora = document.querySelector('#btn-get-fecha-hora');

btnGetFechaHora.addEventListener('click', btnGetFechaHoraAsync_click);

function btnGetFechaHora_click(e){
    btnGetFechaHora.disabled = true;
    //Hacer la llamada AJAX con API de fetch
    fetch('get_fecha_hora.php')
    
    //Usaremos JSON que nos dará una promesa
    .then(res => res.json())
    
    //Con la promesa del JSON, ya podemos trabajar con los datos
    .then(resObj =>{
        btnGetFechaHora.disabled = false;
        sFechaHora.textContent = resObj.fechaHoraStr;
    });

}

//Hay una forma más elegante de hacerlo
async function btnGetFechaHoraAsync_click(e) {
    btnGetFechaHora.disabled = true

    //Objeto que representa una respuesta
    const res = await fetch('get_fecha_hora.php');
    const resObj = await res.json();
    sFechaHora.textContent = resObj.fechaHoraStr;

    btnGetFechaHora.disabled = false;
}   