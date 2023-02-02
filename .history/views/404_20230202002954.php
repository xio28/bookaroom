<?php
/**
 * This file displays the 404 error page for the website.
 *
 * The header and footer components are required, and the header is created with the title "BookARoom".
 * A div with class "page_404" is displayed with the 404 error message, including a cute animated cat gif.
 * The footer is also created.
 */
    require_once 'components/header.php';
    require_once 'components/footer.php';
    
    App\Views\Components\createHeader("BookARoom");
?>

<div class="page_404 d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="display-1 fw-bold">404</h1>
        <p class="fs-3"> <span class="text-danger">¡Upps!</span> Página no encontrada.</p>
        <p class="lead">
            La página que estás buscando igual no existe igual sí, igual existe y no existe, como el gato de Schrödinger.
        </p>
        <img class="d-block mb-4 m-auto" src="../public/build/media/schrodingers_cat.gif" alt="Gato de Schrödingers">
        <a href="index" class="btn btn-info text-light">Mejor vuelve al inicio y te lías menos</a>
    </div>
</div>

<?php
    App\Views\Components\createFooter();
?>
