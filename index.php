<?php
require 'db.php';

$currentDate = date('Y-m-d');
$stmt = $pdo->prepare('SELECT * FROM posts WHERE DATE_ADD(date, INTERVAL duration DAY) >= ?');
$stmt->execute([$currentDate]);
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Blog UJAP</title>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
        <style>
.accordion {
    background-color: #9eacba; /* Color gris oscuro */
    color: #ffffff; /* Cambiar color del texto a blanco */
    font-weight: bold; /* Añadir negrita para destacar */
    border-radius: 10px; /* Añadir bordes redondeados */
    padding: 10px; /* Añadir padding */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Añadir sombra */
}

.collapse {
    background-color: #ffffff; /* Color blanco para el contenido desplegado */
    color: #000000; /* Cambiar color del texto a negro */
    border-radius: 10px; /* Añadir bordes redondeados */
    padding: 10px; /* Añadir padding */
    margin-top: 10px; /* Añadir margen superior para separar el contenido */
}


    .accordion .btn-link::after {
        content: "\25bc"; /* Flecha hacia abajo */
        float: right;
        transition: transform 0.2s ease-in-out; /* Transición más suave */
        font-size: 0.8em; /* Ajustar el tamaño de la flecha */
    }

    .accordion .btn-link.collapsed::after {
        content: "\25b6"; /* Flecha hacia la derecha */
        transform: rotate(0);
    }

    .accordion .btn-link:not(.collapsed)::after {
        transform: rotate(90deg); /* Flecha hacia abajo */
    }

    .like-btn {
        background-color: transparent;
        color: #007bff; /* Color azul */
        border: none;
        padding: 5px 10px; /* Ajustar padding */
        cursor: pointer;
        font-size: 1.5em;
        transition: color 0.3s, transform 0.3s, box-shadow 0.3s; /* Añadir transición */
    }

    .like-btn .fa-thumbs-up {
        transition: color 0.2s, transform 0.3s, box-shadow 0.3s; /* Añadir transición */
    }

    .like-btn:hover .fa-thumbs-up {
        color: #0056b3; /* Color azul más oscuro */
        transform: scale(1.1); /* Añadir efecto de escala */
        box-shadow: 0 0 10px rgba(0, 86, 179, 0.5); /* Añadir sombra */
    }

    /* Estilos personalizados para el chatbot */
    .chat-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 350px;
        height: 450px;
        background-color: #ffffff;
        border: 1px solid #343a40; /* Borde gris oscuro */
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Añadir sombra */
        transition: all 0.3s ease;
    }

    .chat-container.minimized {
        height: 50px; /* Ajusta la altura para el estado minimizado */
        overflow: hidden; /* Oculta el contenido cuando está minimizado */
    }

    .chat-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        text-align: center;
        font-weight: bold; /* Añadir negrita */
    }

    .chat-body {
        padding: 15px;
        flex: 1;
        overflow-y: auto;
        background-color: #f8f9fa; /* Añadir un fondo claro */
    }

    .chat-footer {
        padding: 15px;
        display: flex;
        align-items: center;
        background-color: #f1f1f1; /* Añadir un fondo claro */
        border-top: 1px solid #343a40; /* Añadir un borde superior */
    }

    .chat-footer input {
        flex: 1;
        padding: 10px;
        border: 1px solid #343a40; /* Borde gris oscuro */
        border-radius: 10px;
        box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.1); /* Añadir sombra interior */
    }

    .chat-footer button {
        margin-left: 10px;
        padding: 10px 15px;
        border: none;
        border-radius: 10px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Añadir sombra */
        transition: background-color 0.3s, transform 0.3s; /* Añadir transición */
    }

    .chat-footer button:hover {
        background-color: #0056b3;
        transform: scale(1.05); /* Añadir efecto de escala */
    }

    .message {
        margin: 10px 0;
        padding: 10px 15px;
        border-radius: 10px;
        max-width: 80%; /* Ajustar el ancho máximo */
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Añadir sombra */
    }

    .message.user {
        background-color: #007bff;
        color: white;
        align-self: flex-end;
    }

    .message.bot {
        background-color: #e0e0e0;
        align-self: flex-start;
    }
    
      .navbar {
            background-color: #343a40; /* Gris oscuro */
            border-bottom: 6px solid #007bff; /* Raya azul más gruesa debajo */
            border-top: 4px solid #007bff; /* Borde superior azul */
        }

        .navbar .navbar-brand, .navbar .nav-link {
            color: #ffffff; /* Color blanco para el texto */
            border: 2px solid #007bff; /* Borde azul oscuro */
            background-color: #007bff; /* Fondo azul oscuro */
            padding: 5px 10px; /* Añadir padding */
            border-radius: 5px; /* Bordes redondeados */
        }

        .navbar .navbar-brand:hover, .navbar .nav-link:hover {
            color: #adb5bd; /* Gris claro para hover */
            background-color: #0056b3; /* Fondo azul más oscuro para hover */
        }

        .navbar .navbar-toggler {
            background-color: #007bff; /* Azul oscuro para el botón toggle */
            border: none;
        }

        .navbar .navbar-toggler-icon {
            color: #ffffff; /* Blanco para el icono del botón toggle */
        }

        .navbar .navbar-collapse {
            border-top: 1px solid #007bff; /* Borde azul oscuro */
        }

        .navbar .nav-item.active .nav-link {
            color: #0056b3; /* Azul más oscuro para el enlace activo */
            font-weight: bold; /* Negrita para destacar el enlace activo */
        }


        .sidebar {
            float: left;
            width: 25%;
            padding-right: 20px;
        }

        .content {
            float: right;
            width: 70%;
        }
        .card-title { color: #ffffff; /* Letras blancas para los títulos de las tarjetas */ 
        }

        .card {
            margin-bottom: 20px;
            border: 2px solid #007bff; /* Borde azul oscuro */
            background-color: #6c757d; /* Fondo gris */
            color: #ffffff; /* Texto blanco */
        }

        .card-body {
            background-color: #6c757d; /* Fondo gris */
        }
       /* Animación CSS para el encabezado */ 
       @keyframes marquee {
        from { transform: translateX(100%);
         } to { transform: translateX(0);
          } } h1.marquee { display: inline-block;
           white-space: nowrap; overflow: hidden; animation: marquee 10s linear infinite; 
       }
       body { background: linear-gradient(135deg, #d3dbe3, #6c757d); /* Gradiente de fondo */ border-radius: 15px; /* Bordes redondeados */ padding: 20px; }
       .container {
    background-color: #ffffff; /* Fondo blanco */
    border-radius: 15px; /* Bordes redondeados */
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Añadir sombra para un efecto elegante */
}
.white-text {
    color: #ffffff;
}
.recuadro {
    background-color: #d1d1d1; /* Fondo gris claro */
    color: #333333; /* Texto gris oscuro */
    font-size: 1.2em; /* Tamaño de fuente moderado */
    font-weight: normal; /* Texto en peso normal */
    padding: 5px; /* Espaciado interior reducido */
    border-radius: 3px; /* Bordes ligeramente redondeados */
    text-align: center; /* Alinear el texto al centro */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Sombra ligera */
}
.tituloMenuI {
    font-family: 'Arial', sans-serif; /* Cambiar la fuente a Arial */
    color: #007bff; /* Color azul */
    font-size: 1em; /* Tamaño de fuente mediana */
    padding: 5px; /* Espaciado interior reducido */
    text-align: center; /* Alinear el texto al centro */
}




</style>

  


  

<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" alt="Logo UJAP">
        UJAP en Linea
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>

    </button>
 
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          
            <li class="nav-item" style="margin: 10px;">
                <a class="nav-link" href="**.php">Estatus de Alumnos</a>
            </li>
            <li class="nav-item" style="margin: 10px;">
                <a class="nav-link" href="**.php">Secciones Cerradas</a>
            </li>
            <li class="nav-item" style="margin: 10px;">
                <a class="nav-link" href="**.php">Solicitud de Ingreso</a>
            </li>
             <li class="nav-item" style="margin: 10px;">
                <a class="nav-link" href="admin.php">Administrar</a>
            </li>
        </ul>
    </div>
</nav>




    
</head>
<body>
      <div class="recuadro"><div class="tituloMenuI">Ingreso</div>

<form id="frmIngreso" action="***.php?mdni='.$mdni.'" enctype="application/x-www-form-urlencoded" method="post" style="margin:0" onsubmit="javascript: return(verificarFORM())">
   
        <input type="text" id="cj_clavezz" name="cj_clavezz"  placeholder="Usuario">
    <input type="HIDDEN" name="Perm" value="Si">
    
        <input type="password" id="cj_contrasena" name="cj_contrasena"  placeholder="Contrase&ntilde;a">  
    
    <input type="submit" value="Ingresar" class="ingresoboton">
  
    <a class="recordar" href="clave.recordar.php" style="color: #ff0000;">Recordar Contrase&ntilde;a</a>

</form>
 </div> 
<div class="separator"></div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Admisión y Registro</h5>
                    <p>Para cualquier información sobre Ingreso a la Universidad escriba al siguiente correo: <a href="mailto:admision.ujap@gmail.com">admision.ujap@gmail.com</a></p>

                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Acropolis</h5>
                    <p class="card-text">Para cualquier información sobre Acropolis escriba al siguiente correo: <a href="mailto:soporteujapvirtual@gmail.com">soporteujapvirtual@gmail.com</a></p>

                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Administraci&oacute;n</h5>
                    <p class="card-text">Para cualquier información o duda sobre Registro Depósito / Transferencia / Pago escriba al siguiente correo:  <a href="mailto:info.admon@ujap.edu">soporteujapvirtual@gmail.com</a></p>
                    <p class="card-text"> </p>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Para cualquier otra inquietud sobre la Universidad escriba al siguiente correo:</p>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Card 5</h5>
                    <p class="card-text">Información adicional aquí.</p>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Card 6</h5>
                    <p class="card-text">Información adicional aquí.</p>
                </div>
            </div>
        </div>

<div class="col-md-9">
    <h1 class="marquee">Noticias UJAP</h1>
    <div class="accordion" id="accordionNoticias">
        <?php foreach ($posts as $index => $post): ?>
            <div class="accordion-flush" style="margin-bottom: 20px;">
                <div class="card-header" id="heading<?= $index ?>">
                    <h2 class="mb-0" style="font-size: 0.9em;">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                            Ver
                        </button>
                        <a class="white-text"><?= htmlspecialchars($post['title']) ?></a>
                    </h2>
                </div>
                <div id="collapse<?= $index ?>" class="collapse" aria-labelledby="heading<?= $index ?>" data-parent="#accordionNoticias">
                    <div>
                        <?php if ($post['image']): ?>
                            <img src="<?= htmlspecialchars($post['image']) ?>" class="img-fluid mb-3" alt="Imagen de noticia">
                        <?php endif; ?>
                        <div style="font-size: 0.9em;">
                            <?= $post['content'] ?>
                            <p class="card-text"><small class="text-muted">Publicado el <?= $post['date'] ?></small></p>
                        </div>
                        <button class="like-btn" onclick="likePost(<?= $post['id'] ?>)">
                            <i class="fas fa-thumbs-up"></i>
                        </button>
                        <span id="like-count-<?= $post['id'] ?>"><?= $post['likes'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


 <div class="chat-container minimized" id="chat-container"> <div class="chat-header"> Chatbot UJAP <button class="close-button" onclick="toggleChat()">×</button> </div> <div class="chat-body" id="chat-body"> <!-- Mensajes --> </div> <div class="chat-footer"> <input type="text" id="user-input" placeholder="Escribe un mensaje..."> <button onclick="sendMessage()">Enviar</button> </div> </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>

    function likePost(postId) {
        $.ajax({
            url: 'like.php',
            type: 'post',
            data: { post_id: postId },
            success: function(response) {
                let likeCount = parseInt(response);
                $('#like-count-' + postId).text(likeCount);
            }
        });
    }

    $(document).ready(function() {
        $('.collapse').on('show.bs.collapse', function () {
            $(this).closest('.card').find('.card-header').addClass('active');
            $(this).closest('.card').find('.btn-link').removeClass('collapsed');
        }).on('hide.bs.collapse', function () {
            $(this).closest('.card').find('.card-header').removeClass('active');
            $(this).closest('.card').find('.btn-link').addClass('collapsed');
        });
    });
   function toggleChat() {
    const chatContainer = document.getElementById('chat-container');
    const minimizeButton = document.getElementById('minimize-button');
    
    if (chatContainer.classList.contains('minimized')) {
        expandChat();
    } else {
        minimizeChat();
    }
}

function expandChat() {
    const chatContainer = document.getElementById('chat-container');
    const minimizeButton = document.getElementById('minimize-button');
    chatContainer.classList.remove('minimized');
    minimizeButton.innerText = "Minimizar";
}

function minimizeChat() {
    const chatContainer = document.getElementById('chat-container');
    const minimizeButton = document.getElementById('minimize-button');
    chatContainer.classList.add('minimized');
    minimizeButton.innerText = "Chat";
}
 function handleKeyPress(event) { 
    if (event.key === 'Enter') { 
        sendMessage(); 
    } 
}

function sendMessage() { 
    const userInput = document.getElementById('user-input'); 
    const chatBody = document.getElementById('chat-body'); 
    
    // Crear el mensaje del usuario 
    const userMessage = document.createElement('div'); 
    userMessage.classList.add('message', 'user'); 
    userMessage.innerText = userInput.value; 
    chatBody.appendChild(userMessage); 
    
    // Simular una respuesta del bot 
    const botMessage = document.createElement('div'); 
    botMessage.classList.add('message', 'bot'); 
    botMessage.innerText = generateResponse(userInput.value); 
    chatBody.appendChild(botMessage); 
    
    // Limpiar el campo de entrada 
    userInput.value = ''; 
    
    // Scroll hacia abajo para ver el último mensaje 
    chatBody.scrollTop = chatBody.scrollHeight; 
}

function generateResponse(userMessage) {
    const responses = Object.freeze({
        "hola": "¡Hola! ¿Cómo puedo ayudarte hoy?",
        "carreras": "Las carreras disponibles en la UJAP son Ingeniería, Derecho, Administración, Contaduría, y muchas más.",
        "horario": "El horario de atención es de lunes a viernes, de 8:00 AM a 5:00 PM.",
        "ubicada": "La Universidad José Antonio Páez (UJAP) está ubicada en Valencia, Carabobo, Venezuela.",
        "pagar": "Para pagar la cuota de UJAP, puedes dirigirte a la sección de pagos en línea en el portal de la universidad o acudir a la oficina de caja en el campus.",
        "inscripción": "Para realizar la inscripción, visita el portal de estudiantes de la UJAP y sigue los pasos indicados en la sección de inscripciones. Asegúrate de tener a mano toda la documentación necesaria.",
        "contraseña": "Para cambiar tu contraseña de UJAP en línea, ingresa al portal de estudiantes, ve a la sección de 'Configuración de cuenta' y sigue las instrucciones para actualizar tu contraseña.",
        "pago web": "Para realizar un pago web en la UJAP, sigue estos pasos: 1. Inicia sesión en el portal de estudiantes. 2. Dirígete a la sección de pagos. 3. Selecciona la cuota o el concepto a pagar. 4. Elige el método de pago (tarjeta de crédito, débito, etc.). 5. Completa los detalles de pago y confirma la transacción. 6. Guarda el comprobante de pago que se genera al finalizar.",
        "se descontó": "Si tu pago web se descontó pero no aparece en el portal, te recomendamos seguir estos pasos: 1. Revisa tu correo electrónico para verificar si recibiste un comprobante de la transacción. 2. Espera unos minutos y verifica nuevamente en el portal de estudiantes. 3. Si el problema persiste, contacta al soporte técnico de la UJAP proporcionando el comprobante de pago y los detalles de la transacción para que puedan asistirte.",
        "adición": "Para realizar una adición de materia en la UJAP, sigue estos pasos: 1. Inicia sesión en el portal de estudiantes. 2. Ve a la sección de 'Ajuste de Inscripción'. 3. Selecciona 'Añadir Materia'. 4. Elige la materia que deseas añadir y confirma tu selección. 5. Verifica que la materia se haya añadido correctamente en tu horario.",
        "cambio": "Para realizar un cambio de materia en la UJAP, sigue estos pasos: 1. Inicia sesión en el portal de estudiantes. 2. Dirígete a la sección de 'Ajuste de Inscripción'. 3. Selecciona 'Cambiar Materia'. 4. Elige la materia que deseas cambiar y la nueva materia que quieres inscribir. 5. Confirma los cambios y verifica que se hayan aplicado correctamente en tu horario.",
        "retiro": "Para realizar un retiro de materia en la UJAP, sigue estos pasos: 1. Inicia sesión en el portal de estudiantes. 2. Ve a la sección de 'Ajuste de Inscripción'. 3. Selecciona 'Retirar Materia'. 4. Elige la materia que deseas retirar y confirma tu decisión. 5. Verifica que la materia se haya eliminado correctamente de tu horario.",
        "carnet": "Para obtener tu carnet de estudiante en la UJAP, sigue estos pasos: 1. Dirígete al departamento de control de estudios en el campus. 2. Presenta tu cédula de identidad y el comprobante de inscripción. 3. Te tomarán una foto para el carnet. 4. Imprime el carnet desde el Portal Web UJAP.",
        "ingreso directo": "Para realizar un ingreso directo en la UJAP, sigue estos pasos: 1. Completa el formulario de solicitud de ingreso directo disponible en el portal de la UJAP. 2. Adjunta los documentos requeridos, como tu cédula de identidad, título de bachiller, y cualquier otro documento solicitado. 3. Paga la cuota de admisión a través de las opciones de pago disponibles en el portal. 4. Envía la solicitud y espera la confirmación por parte de la universidad. 5. Una vez aprobada la solicitud, sigue las instrucciones proporcionadas para completar tu inscripción.",
        "título": "Para realizar la solicitud de título en la UJAP, sigue estos pasos: 1. Verifica que cumplas con todos los requisitos académicos y administrativos. 2. Reúne todos los documentos necesarios, incluyendo tu cédula de identidad, comprobante de notas, y cualquier otro documento requerido. 3. Dirígete a la oficina de control de estudios para entregar tu solicitud. 4. Paga la cuota de solicitud de título a través de las opciones de pago disponibles. 5. Espera la confirmación y sigue las instrucciones adicionales proporcionadas por la universidad.",
        "artículo 9": "El Artículo 9 de la normativa UJAP establece los derechos y deberes de los estudiantes en cuanto a su comportamiento académico y disciplinario.", "ERROR P07": "El ERROR P07 se refiere a un problema específico relacionado con [inserte el contexto del error aquí]. Te recomendamos [proporcionar solución o pasos para solucionar el error].", "constancias": "Para solicitar constancias en la UJAP, sigue estos pasos: 1. Accede al portal de estudiantes de la UJAP. 2. Ve a la sección de 'Solicitudes' y selecciona 'Constancias'. 3. Completa el formulario de solicitud con la información requerida. 4. Paga la cuota correspondiente si aplica. 5. Envía la solicitud y espera la confirmación. 6. Recoge la constancia en la oficina correspondiente o descárgala desde el portal, según sea el proceso indicado.", "formas de pago": "Las formas de pago aceptadas en la UJAP incluyen: 1. Tarjeta de crédito o débito. 2. Transferencias bancarias. 3. Pagos en efectivo en la oficina de caja del campus. 4. Pagos en línea a través del portal de estudiantes. Asegúrate de seguir las instrucciones específicas para cada método en el portal de pagos de la universidad.", "recuperar respuestas preguntas de seguridad": "Para recuperar las respuestas a tus preguntas de seguridad en la UJAP, sigue estos pasos: 1. Ingresa al portal de estudiantes. 2. Ve a la sección de 'Recuperación de cuenta'. 3. Selecciona la opción de 'Preguntas de seguridad'. 4. Ingresa tu identificación y sigue las instrucciones para recuperar tus respuestas. 5. Si tienes problemas, contacta al soporte técnico para asistencia adicional.", "normas": "Las normas de la UJAP incluyen: 1. Cumplir con los requisitos académicos y administrativos establecidos. 2. Mantener una conducta adecuada y respetuosa dentro del campus. 3. Participar activamente en las actividades académicas y extracurriculares. 4. Respetar las instalaciones y recursos de la universidad. 5. Seguir las instrucciones de los profesores y el personal administrativo. Para más detalles, consulta el reglamento estudiantil disponible en el portal de la universidad.", "reglamento": "El reglamento de la UJAP establece las normas y procedimientos que deben seguir los estudiantes, profesores y el personal administrativo para garantizar el buen funcionamiento de la universidad. Incluye aspectos como la disciplina, la evaluación académica, los derechos y deberes de los estudiantes, y las políticas de la institución. Para más detalles, consulta el reglamento completo disponible en el portal de la universidad.", "solicitar correo institucional": "Para solicitar un correo institucional en la UJAP, sigue estos pasos: 1. Ingresa al portal de estudiantes. 2. Ve a la sección de 'Servicios' y selecciona 'Solicitar Correo Institucional'. 3. Completa el formulario de solicitud con tu información personal. 4. Envía la solicitud y espera la confirmación. 5. Una vez aprobado, recibirás las instrucciones para activar tu correo institucional.", "equivalencia": "Para solicitar una equivalencia en la UJAP, sigue estos pasos: 1. Reúne todos los documentos necesarios, como tu certificado de estudios previos y el plan de estudios de tu institución anterior. 2. Ingresa al portal de estudiantes de la UJAP. 3. Ve a la sección de 'Equivalencias' y completa el formulario de solicitud con la información requerida. 4. Adjunta los documentos necesarios. 5. Envía la solicitud y espera la evaluación por parte de la universidad. 6. Una vez aprobada, sigue las instrucciones adicionales proporcionadas por la universidad.", "error nombre": "El error de nombre se refiere a [descripción del error aquí]. Te recomendamos [proporcionar solución o pasos para solucionar el error].",
        "adiós": "¡Adiós! Que tengas un buen día.",
        "gracias": "¡De nada! Estoy aquí para ayudarte."
    });

    const lowerCaseMessage = sanitizeInput(userMessage).toLowerCase();
    
    for (const keyword in responses) {
        if (lowerCaseMessage.includes(keyword)) {
            return responses[keyword];
        }
    }

    return "Lo siento, no entiendo tu mensaje. Por favor, pregunta algo relacionado con la Universidad José Antonio Páez (UJAP).";
}

function sanitizeInput(input) {
    const element = document.createElement('div');
    element.innerText = input;
    return element.innerHTML;
}



</script>
</body>
</html>
