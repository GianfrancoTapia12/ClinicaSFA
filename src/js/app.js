//const { format } = require("sharp");// Eliminar esto

let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); //muestra y oculta las secciones
    tabs()//cambia la seccion cuando se presione los tabs
    botonesPaginador();//Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI();//Consulta la API en el backed de PHP

    idCliente();
    nombreCliente();//Añade el nombre del cliente al objeto cita
    seleccionarFecha();//Añade la fecha de la cita al objeto
    seleccionarHora();//Añade la hora de la cita en el objeto

    mostrarResumen();//Muestra el resumen de la cita

}

function mostrarSeccion() {
    //Ocultar la seccion que tenga la clase mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    //selecionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //Quita la clase actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    //resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPaginador();

            if (paso === 3) {
                mostrarResumen();//puedes eliminar si no funciona
            }

        });
    });
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarResumen();
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function () {
        if (paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {
        if (paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    })
}
//API
//funcion asincrona
async function consultarAPI() {
    try {
        const url = '/api/servicios' //Nuestra API
        const resultado = await fetch(url); //Consumimos el servicio
        const servicios = await resultado.json();//Obtenemos los resultados como json

        mostrarServicios(servicios);
        //mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }

}
function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id, nombre, medico, consultorio, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const medicoServicio = document.createElement('P');
        medicoServicio.classList.add('medico-servicio');
        medicoServicio.textContent = medico;

        const consultorioServicio = document.createElement('P');
        consultorioServicio.classList.add('consultorio-servicio');
        consultorioServicio.textContent = consultorio;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `s/${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        }
        //servicioDiv.addEventListener('click', seleccionarServicio);

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(medicoServicio);
        servicioDiv.appendChild(consultorioServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;//Extraemos el arreglo de servicio

    //Identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    //Comprobar si una especialidad ya fue selecionada
    if (servicios.some(agregado => agregado.id === servicio.id)) {
        //Eliminar
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    } else {
        //Agregarlo
        cita.servicios = [...servicios, servicio];//tomo una copia del servicio y le agrego el nuevo servicio
        divServicio.classList.add('seleccionado');
    }
    //console.log(cita);
}

function idCliente() {
    cita.id = document.querySelector('#id').value;
}


function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function (e) {

        const dia = new Date(e.target.value).getUTCDay();

        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fecha no permitida', 'error', '.formulario');//Muestra la alerta en rojo de fecha
        } else {
            cita.fecha = e.target.value;
        }

    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function (e) {


        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if (hora < 10 || hora > 18) {
            e.target.value = '';
            mostrarAlerta('Hora no valida', 'error', '.formulario');//Muestra la alerta en rojo de hora
        } else {
            cita.hora = e.target.value;

            //console.log(cita);
        }
    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    //No creara mas alertas
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) {
        alertaPrevia.remove();
    }

    //Scripting para crear la lerta 
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece) {
        //Utilizamos seTimeout para que la laerta desaparesca en 3000 = 3 segundos
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}


function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    //Limpiar Contenido y resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }
    //console.log(cita);
    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('Faltan datos de Servivio, Fechas u Hora', 'error', '.contenido-resumen',
            false);

        return;
    }

    //Heading para servicios resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicio';
    resumen.appendChild(headingServicios);

    //Formatear el div de resumen
    const { nombre, fecha, hora, servicios } = cita;


    //Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { id, precio, nombre, medico, consultorio } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> s/${precio}`; //Precio

        const medicoServicio = document.createElement('P');
        medicoServicio.innerHTML = `<span>Medico:</span> ${medico}`; //medico

        const consultorioServicio = document.createElement('P');
        consultorioServicio.innerHTML = `<span>Consultorio:</span> ${consultorio}`; //consultorio

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);
        contenedorServicio.appendChild(medicoServicio);
        contenedorServicio.appendChild(consultorioServicio);

        resumen.appendChild(contenedorServicio);
    });

    //Heading para Cita resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    //Formatear la fecha en español

    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    const fechaFormateada = fechaUTC.toLocaleDateString('es-PE', opciones);


    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora}`;


    //Boton para crear una cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(botonReservar);
}

async function reservarCita() {

    const { nombre, fecha, hora, servicios, id } = cita;

    const idServicio = servicios.map(servicio => servicio.id);
    //console.log(idServicio);


    const datos = new FormData();

    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioID', id);
    datos.append('servicios', idServicio);
    //console.log([...datos]);

    try {
        //Peticion hacia la Api
        const url = '/api/citas'
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        const resultado = await respuesta.json();
        console.log(resultado.resultado);
        if (resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita creada',
                text: 'Tu cita fue creada correctamente',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 3000);               
            })
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error al guardar la cita"
        });
    }



}
