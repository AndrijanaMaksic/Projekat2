<?php

namespace vebProjekat\core;

class Controller
{
    public function render( $view, $message )
    {
        echo Application::$app->router->renderView( $view, $message );
    }

}