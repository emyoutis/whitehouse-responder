<?php
/**
 * Created by PhpStorm.
 * User: emitis
 * Date: 5/27/19
 * Time: 11:02 PM
 */

namespace EmiTis\WhiteHouseResponder\Laravel;


use Illuminate\Support\ServiceProvider;
use EmiTis\WhiteHouseResponder\ErrorsRepository;
use EmiTis\WhiteHouseResponder\Response;

class WhiteHouseResponderServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerSingletons();
    }



    /**
     * Registers the singleton.
     */
    protected function registerSingletons()
    {
        $this->registerResponse();
        $this->registerErrorsSingleton();
    }



    /**
     * Registers the singleton for the response.
     */
    protected function registerResponse()
    {
        $this->app->singleton('whitehouse.response', function () {
            return app()->make(Response::class);
        });
    }



    /**
     * Registers the singleton for the response.
     */
    protected function registerErrorsSingleton()
    {
        $this->app->singleton('whitehouse.errors', function ($app) {
            return new ErrorsRepository();
        });

        $this
             ->app
             ->when(Response::class)
             ->needs(ErrorsRepository::class)
             ->give(function () {
                 return app('whitehouse.errors');
             })
        ;
    }
}
