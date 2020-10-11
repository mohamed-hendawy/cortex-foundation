<?php

declare(strict_types=1);

namespace Cortex\Foundation\Http\Middleware;

use Closure;

class DiscoverNavigationRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (app()->bound('request.accessarea')) {
            $accessarea = app('request.accessarea');

            $menuFiles = app('files')->glob(app()->path("*/*/routes/menus/{$accessarea}.php"));
            $breadcrumbFiles = app('files')->glob(app()->path("*/*/routes/breadcrumbs/{$accessarea}.php"));

            // @TODO: Improve regex, or better filter `glob` results itself!
            $enabledModules = collect(app('request.modules'))->filter(fn ($attributes) => $attributes['active'] && $attributes['autoload'])->keys()->toArray();
            $menuFiles = $enabledModules ? preg_grep('/('.str_replace('/', '\/', implode('|', $enabledModules)).')/', $menuFiles) : $menuFiles;
            $breadcrumbFiles = $enabledModules ? preg_grep('/('.str_replace('/', '\/', implode('|', $enabledModules)).')/', $breadcrumbFiles) : $breadcrumbFiles;

            collect($menuFiles)->merge($breadcrumbFiles)
                               ->reject(function ($file) {
                                   return ! is_file($file);
                               })
                               ->each(function ($file) {
                                   require $file;
                               }, []);
        }

        return $next($request);
    }
}
