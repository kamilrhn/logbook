<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // get all data from menu.json file
        $verticalMenuJson = file_get_contents(base_path('resources/data/menus/vertical-menu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
        $horizontalMenuJson = file_get_contents(base_path('resources/data/menus/horizontal-menu.json'));
        $horizontalMenuData = json_decode($horizontalMenuJson);
        $adminMenuJson = file_get_contents(base_path('resources/data/menus/menu-admin.json'));
        $adminMenuData = json_decode($adminMenuJson);
        // $verticalOverlayMenu = file_get_contents(base_path('resources/data/menus/vertical-overlay-menu.json'));
        // $verticalOverlayMenuData = json_decode($verticalOverlayMenu);

        // share all menuData to all the views
        \View::share('menuData', [$adminMenuData, $verticalMenuData, $horizontalMenuData]);
    }
}
