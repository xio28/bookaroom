<?php
    /**
     * This file displays the login
     *
     * The header and footer partials are required, and the header is created with the title "LogIn"
     * Have several modals for insert, update and delete; rooms can be inserted through a modal form as well as updated or deleted and users and reservations can be deleted or updated
     * The page have several tables that displays through loops the database queries of each table: rooms, booking and users
     * The footer is also created
     */
    require_once 'components/header.php';
    require_once 'components/footer.php';
    
    App\Views\Components\createHeader("LogIn");
?>

<section class="h-100 gradient-form bg-blurred position-relative">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="../public/build/media/logo/favicon.png"
                                    style="width: calc(3.5rem + 1vw);" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">We are Book A Room</h4>
                                </div>
                                <form action="" method="POST">
                                    <p>Inicia sesión, por favor.</p>
                                    <div class="form-floating mb-4">
                                        <input type="email" name="emailLogin" class="form-control" placeholder="" required />
                                        <label for="emailLogin">Email</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" name="passLogin" class="form-control" placeholder="" required />
                                        <label for="passLogin">Contraseña</label>
                                    </div>
                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="submitLogin">Login</button>
                                        <a class="text-muted" href="#!">¿Olvidaste la contraseña?</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">¿No tienes cuenta?</p>
                                        <button type="button" class="btn btn-outline-danger signup-link"><a class="text-muted" href="signup">Crea una</a></button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="back text-primary text-underline" href="index">Vuelve al inicio</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                            <h4 class="mb-4 text-center">Bienvenido a nuestro hotel</h4>
                            <p class="small mb-0">Donde nuestro objetivo es hacer que su estancia sea lo más cómoda posible. Inicie sesión para reservar su habitación y disfrutar de nuestros servicios exclusivos. ¡Esperamos darle la bienvenida en persona pronto!</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    App\Views\Components\createFooter();
?>
