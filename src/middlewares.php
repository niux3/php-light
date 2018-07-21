<?php

    if (true === $container->settings['session']['enable']) {
        // session must be initialized (by another middleware)
        // before adding this Twig extension
        $app->add(function (
            Psr\Http\Message\RequestInterface $request,
            Psr\Http\Message\ResponseInterface $response,
            callable $next
        ) use ($container) {
            if ($container->view instanceof Slim\Views\Twig) {
                $container->view->addExtension(new App\Libs\TwigExtensions\FlashMessages(
                    $container->flash
                ));
            }

            return $next($request, $response);
        });



        $app->add($container->csrf);
        /*
        $app->add(function(Slim\Http\Request $request, Slim\Http\Response $response, callable $next) use ($container){
            //404 - 500 etc.
            if(is_null($request->getAttribute('route'))){
                throw new \Slim\Exception\NotFoundException($request, $response);
                exit();
            }

            $divizeCallable = explode(':', $request->getAttribute('route')->getCallable());
            $method = end($divizeCallable);

            if(strpos($method, 'logged_') === 0){
                if(isset($_SESSION['rid']) && $_SESSION['rid'] > 0){
                    return $next($request, $response);
                }else{
                    header('location:/', 200);
                    exit();
                }
            }
            return $next($request, $response);
        });
        */

        $app->add(new RKA\SessionMiddleware($container->settings['session']));
    }
