<?php

namespace Ranium\LaravelAdyen;

use Illuminate\Support\ServiceProvider;
use Adyen\Client as AdyenClient;
use Adyen\Config as AdyenConfig;

class AdyenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/adyen.php' => config_path('adyen.php'),
        ], 'config');

        $this->app->bind(AdyenClient::class, function ($app, $params) {

            $config = $this->buildConfig($params);

            $client = new AdyenClient(new \Adyen\Config($config));
            $client->setEnvironment($config['environment']);
            return $client;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Build the adyen config
     *
     * @param array $runtimeConfig Params/Config passed while making/resolving during runtime
     *
     * @return array Final config array to be used to build adyen client
     */
    private function buildConfig($runtimeConfig = [])
    {
        // If we have don't have an account name in the runtimeConfig, then use the default account.
        if (!isset($runtimeConfig['account'])) {
            $runtimeConfig['account'] = $this->app['config']['adyen']['default'];
        }

        // Get the merchant account specific config
        $accountConfig = $this->app['config']['adyen']['accounts'][$runtimeConfig['account']];
        // Get the default company wide config
        $companyConfig = $this->app['config']['adyen']['settings'];

        // Merge all configs. The precedence is runtime then account then company.
        return array_merge($companyConfig, $accountConfig, $runtimeConfig);
    }
}