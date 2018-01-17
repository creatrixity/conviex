<?php
namespace App\Services\Web\Providers;

use Illuminate\Routing\Router;
use Lucid\Foundation\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Read the routes from the "api.php" and "web.php" files of this Service
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $namespace = 'App\Services\Web\Http\Controllers';
        $pathApi = __DIR__.'/../routes/api.php';
        $pathWeb = __DIR__.'/../routes/web.php';

        $this->loadRoutesFile($router, $namespace, $pathWeb);
    }
}
