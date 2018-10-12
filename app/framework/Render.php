<?php

declare(strict_types = 1);

namespace Framework;

use Service\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

trait Render
{
    /**
     * @param string $view
     * @param array $parameters
     * @return Response
     */
    private function render(string $view, array $parameters = []): Response
    {
        $rootViewPath = Registry::getDataConfig('view.directory');
        $viewPath = $rootViewPath . $view;

        if (!file_exists($viewPath)) {
            return new Response('There is no view file ' . $view, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $path = function (string $name, array $parameters = []) {
            echo Registry::getRoute($name, $parameters);
        };

        $renderLayout = function (string $view, array $parameters = []) use ($rootViewPath, $path) {
            $parameters['isAuth'] = (new User(new Session()))->isUserLogged();
            extract($parameters, EXTR_SKIP);

            try {
                include_once str_replace('/', DIRECTORY_SEPARATOR, $rootViewPath . $view);
            } catch (\Throwable $e) {
                if (Registry::getDataConfig('environment') === 'dev') {
                    $error = $e->getMessage();
                    $trace = $e->getTraceAsString();
                    include_once str_replace('/', DIRECTORY_SEPARATOR, $rootViewPath . 'error.html.php');
                } else {
                    throw $e;
                }
            }
        };

        ob_start();

        extract($parameters, EXTR_SKIP);
        include_once $viewPath;

        return new Response(ob_get_clean());
    }
}
