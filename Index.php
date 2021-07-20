<?php

    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

    if ($url == '/')
    {

        // This is the default home page 
        // Initiates the HomeControllerr
        // and render the home_view

        require_once __DIR__.'/Models/HomeModel.php';
        require_once __DIR__.'/Controllers/HomeController.php';
        require_once __DIR__.'/Views/home_view.php';

        $indexModel = New HomeModel();
        $indexController = New HomeController($indexModel);
        $home_view = New HomeView($indexController, $indexModel);

        print $home_view->index();

    }else{

        // This is not home page
        // Initiate the appropriate controller
        // and render the required view

        //The first argument is a controller
        $controllerName = $url[0];
        $controllerNameTransformUpperCase = ucfirst($controllerName);

        // If a second part is added in the URI, 
        // it should be a method in the controller
        $requestedMethodController = isset($url[1])? $url[1] :'';

        // The remain parts are considered as 
        // arguments of the method
        // The remaining arguments are separated to new variable
        $requestedParams = array_slice($url, 2); 

        // Check if controller exists.
        // You have to do that for the model and the view too
        $controllerExists = __DIR__.'/Controllers/'.$controllerNameTransformUpperCase.'Controller.php';
        $modelExists = __DIR__.'/Models/'.$controllerNameTransformUpperCase.'Model.php';
        $viewExists = __DIR__.'/Views/'.$controllerName.'_view.php';

        if (file_exists($controllerExists) && file_exists($modelExists) && file_exists($viewExists))
        {

            require_once __DIR__.'/Models/'.$controllerNameTransformUpperCase.'Model.php';
            require_once __DIR__.'/Controllers/'.$controllerNameTransformUpperCase.'Controller.php';
            require_once __DIR__.'/Views/'.$controllerName.'_view.php';

            // require_once $controllerExists;
            // require_once $modelExists;
            // require_once $$viewExists;

            // Load the Classes
            $modelName      = $controllerNameTransformUpperCase.'Model';
            $controllerName = $controllerNameTransformUpperCase.'Controller';
            $viewName       = $controllerNameTransformUpperCase.'View';

            $controllerObj  = new $controllerName( new $modelName );
            $viewObj        = new $viewName( $controllerObj, new $modelName );

            // If there is a method - Second parameter
            if ($requestedMethodController != '')
            {
                // then we call the method via the view
                // dynamic call of the view
                print $viewObj->$requestedMethodController($requestedParams);

            }

        }else{

            header('HTTP/1.1 404 Not Found');
            die('404 - The one of the file - '. $controllerExists. ' ' . $modelExists . ' ' . $viewExists .' - does not exist');
            //require the 404 controller and initiate it
            //Display its view
        }
    }