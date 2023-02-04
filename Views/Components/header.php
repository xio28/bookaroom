<?php
/**
 * In this PHP file is defined a namespace "App\Views\Components" and a function "createHeader". 
 * The function have a string argument which is the title of the page and echoes a string with the HTML head that includes several Bootstrap, icons, fonts, favicon links, and also a local main css
 */
namespace App\Views\Components;

/**
 * Function to create the header of a page
 * @param string $title The title of the page
 * La hoja de estilos https://bookaroom-daw.herokuapp.com/app/public/build/css/main.css no se ha cargado porque su tipo MIME, "text/html", no es "text/css".
 * @return void
 */
function createHeader(string $title) : void {
    $css = 'https://bookaroom-daw.herokuapp.com/app/public/build/css/main.css';
    echo <<<HEADER
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&family=Roboto+Mono:wght@200;300;400&display=swap" rel="stylesheet"> 
                <link rel="icon" type="image/png" href="/public/build/media/logo/favicon.png">
                <link rel="stylesheet" href="{$css}">
                <title>{$title}</title>
            </head>
            <body>
        HEADER;
}

?>
