<?php

namespace App\Managers\Navigation;

use App\Models\Acl\Acl;
use App\Managers\Acl\AclManager;
use Auth;

class NavigationManager
{
    /**
     * ACL Manager
     *
     * @var object
     */
    protected $aclManager;

    /**
     * Pages
     *
     * @var array
     */
    protected $pages;

    /**
     * The logged in user
     *
     * @var object User
     */
    protected $user;

    /**
     * Construct - set all arrays and objects
     *
     * @return void
     */
    public function __construct()
    {
        /*ACL Manager*/
        $this->aclManager = new AclManager();

        /*User*/
        $this->user = Auth::User();
    }

    /**
     * Return the navigation array + pages
     *
     * @param $route_name string
     * @param $excludeHiddenFromNavigation bool
     * @param $check_route bool 
     * 
     * @return array
     */
    public function getNavigation($route_name, $check_route = true, $excludeHiddenFromNavigation = false)
    {
        $navigation = array();

        $results = Acl::getByUserGroupId($this->user->group_id, false, $excludeHiddenFromNavigation);

        $allPermissions = $this->aclManager->getAllPermissions($this->user->group_id);

        foreach ($results as $result)
        {
            /*BEGIN CHECK FOR RESOURCES WIN HIDDEN NAVIGATION ACTIVE*/
            if($check_route == true) {
                if( ($result->route == $route_name) AND ($result->hidden_navigation == 1) ) {
                    return $navigation;
                }   
            }
            /*END CHECK FOR RESOURCES WIN HIDDEN NAVIGATION ACTIVE*/
            $active = false;

            if($result->route == $route_name) {
                $active = true;
            }

            $navigation[] = array(
                'icon'  => $result->icon,
                'title' => $result->label,
                'route' => $result->route,
                'active' => $active
            );
        }

        return $navigation;
    }

}