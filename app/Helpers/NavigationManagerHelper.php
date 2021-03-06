<?php

namespace App\Helpers;

use App\Managers\Navigation\NavigationManager;

class NavigationManagerHelper
{
    /**
     * Return the navigation array
     *
     * @param $excludeHiddenFromNavigation bool
     * @param $check_route bool
     *
     * @return array
     */
    static function getNavigation($excludeHiddenFromNavigation = false, $check_route = true)
    {
        $request = request();

        $navigationManager = new NavigationManager();

        /*Get route*/
        $route = $request->route();

        $route_array = explode("/", $route->getPath());
        $route_name = $route_array[0];

        return $navigationManager->getNavigation($route_name, $check_route, $excludeHiddenFromNavigation);
        
    }
    
}