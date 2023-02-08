<?php
    /**
     * This file displays the signup form
     *
     * The header and footer partials are required, and the header is created with the title "Signup"
     * The page have a single form which is used to get user information in order to log in 
     * The footer is also created
     */
    
    /**
     * Start session if there's no one
     */
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once 'components/header.php';
    require_once 'components/footer.php';

    /**
     * Create a header for the signup
     * 
     * @param string $title The title to display in the header
     */
    App\Views\Components\createHeader("Signup");
?>

<section class="signup__section position-relative text-center d-flex flex-column justify-content-end align-items-center">
    <div class="p-5 h-75 bg-image position-absolute top-0 start-0 w-100" style="background-image: url('../public/build/media/signupBg.jpg'); background-repeat: no-repeat; background-position: center; background-size: cover; height: 300px;"></div>
    <div class="card mx-4 mx-md-5 shadow-5-strong w-75" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8); backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">
                    <h2 class="fw-bold mb-5">Sign up para comenzar</h2>
                    <?php if(isset($_SESSION['alert']) && $_SESSION['alert']['error']) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo implode("<br>" ,$_SESSION['alert']['messages']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="signup" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="text" name="nidSignUp" class="form-control" placeholder="" required/>
                                    <label for="nameSignUp">DNI</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="text" name="nameSignUp" class="form-control" placeholder="" required/>
                                    <label for="nameSignUp">Nombre</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="text" name="surname1SignUp" class="form-control" placeholder="" required/>
                                    <label for="surnameSignUp">Primer apellido</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="text" name="surname2SignUp" class="form-control" placeholder="" required/>
                                    <label for="surnameSignUp">Segundo apellido</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="email" name="emailSignUp" class="form-control" placeholder="" required />
                                    <label for="emailSignUp">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="tel" name="phoneSignUp" class="form-control" placeholder="" required />
                                    <label for="phoneSignUp">Teléfono de contacto</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="password" name="passSignup" class="form-control" placeholder="" required />
                                    <label for="passSignup">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="password" name="repeatPassSignup" class="form-control" placeholder="" required />
                                    <label for="repeatPassSignup">Repite la contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <input class="form-check-input" type="checkbox" name="policy" required>
                                <label class="form-check-label" for="policy">
                                Acepto la <a class="text-underline" href="" target="_blank">política de privacidad.</a>
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="signUpUser" class="gradient-custom-2 btn btn-primary btn-block mb-4">
                            Sign up
                        </button>
                        <div class="d-flex align-items-center justify-content-center pb-4">
                            <p class="mb-0 me-2">¿Ya tienes cuenta?</p>
                            <button type="button" class="btn btn-outline-danger signup-link"><a class="text-muted" href="login">Login</a></button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="back text-primary text-underline" href="index">Vuelve al inicio</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // This line sets a timer for 5000 milliseconds (5 seconds)
    setTimeout(() => {
        let alertModal = document.querySelector('.alert');
        alertModal.style.display = 'none';
    }, 5000);
</script>
<?php
    unset($_SESSION['alert']);
    App\Views\Components\createFooter();
?>
