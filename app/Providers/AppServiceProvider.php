<?php

namespace App\Providers;

use Auth;
use Illuminate\Database\Connection;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootViewer();
        if (config('app.verbose')) {
            $this->bindDBDebugListener();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bind variable user to view
     */
    protected function bootViewer()
    {
        view()->composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
    }

    /**
     * Bind Listener to dump SQL to log
     */
    private function bindDBDebugListener()
    {
        DB::listen(function (QueryExecuted $event) {
            $message = sprintf(
                '%s Query run: %s; parameter: %s',
                $event->connectionName,
                $event->sql,
                json_encode($event->bindings)
            );

            Log::debug($message);
        });
    }
}
