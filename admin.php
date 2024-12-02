<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Blog UJAP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
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
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg ">
    <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" alt="Logo UJAP">
        Admin Blog UJAP
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Agregar Noticia</h1>
    <form action="add_post.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="date">Fecha de Publicación</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="duration">Duración (días)</label>
            <input type="number" class="form-control" id="duration" name="duration" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Agregar</button>
    </form>
</div>

<script>
    CKEDITOR.replace('content');
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
