<?php

namespace MadeITBelgium\SeoAnalyzer;

use Illuminate\Support\ServiceProvider;
use MadeITBelgium\SeoAnalyzer\Seo;

/**
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (http://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class SeoServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $rules = [
        
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/seo-analyzer.php' => config_path('seo-analyzer.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('seo-analyzer', Seo::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['seo-analyzer'];
    }
}
