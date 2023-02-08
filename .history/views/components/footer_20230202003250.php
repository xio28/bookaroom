<?php
/**
 * This is a PHP script defining a namespace "App\Views\Components" and a function "createFooter". 
 * The function simply echoes a string with the HTML for a footer that includes several JavaScript files,
 */
namespace App\Views\Components;

function createFooter() : void {
    echo <<<FOOTER
                <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
                <script src="../public/build/js/sidebar.js" type="module"></script>
            </body>
        </html>
        FOOTER;
}

?>
