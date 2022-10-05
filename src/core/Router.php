<?php

namespace vebProjekat\core;

use function Composer\Autoload\includeFile;
class Router {


    public array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve() {
        $path  = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ( $callback === false ) {
            $this->response->setResponse(404);

            return $this->renderView( '_404', $path );
        }

        if ( is_string($callback) ) {
            return $this->renderView($callback, $path);
        }

        if(is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback);
    }


    public function renderView($view, $params = []) {

        $content = $this->getPageContent($view);
        $navbarContent = $this->getLayout('navbar');
        $returnView = $this->getContent("defaultLayout");
        $returnView = str_replace('{{ navbar }}', $navbarContent, $returnView);
        $returnView = str_replace("{{ content }}", $content, $returnView);

        return $returnView;
    }

    public function getContent($name) {
        ob_start();
        include_once (Application::$ROOT_DIR."/vebProjekat/src/view/$name.php");
        return ob_get_clean();
    }
    public function getLayout($name) {
        ob_start();
        include_once (Application::$ROOT_DIR."/vebProjekat/src/view/$name.twig");
        return ob_get_clean();
    }

    public function getPageContent($view) {
        ob_start();
        if($view == "_404") {
            $category = "_404";
        }
        include_once (Application::$ROOT_DIR."/vebProjekat/src/view/$view.twig");
        return ob_get_clean();
    }
}