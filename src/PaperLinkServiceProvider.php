<?php

namespace JonMierke\PaperLink;

use Illuminate\Contracts\Http\Kernel;
use JonMierke\PaperLink\Http\Middleware\AnalyticsDashboardMiddleware;
use JonMierke\PaperLink\Http\Middleware\APIRequestCapture;
use JonMierke\PaperLink\Http\Middleware\WebRequestCapture;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PaperLinkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('paperlink')
            ->hasConfigFile()
            ->hasRoutes(['web', 'api'])
            ->hasAssets()
            ->hasMigrations(['create_paper_links_table', 'create_request_analytics_table', 'create_linkables_table', 'add_indexes_to_request_analytics_table'])
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command
                    ->startWith(function (InstallCommand $command): void {
                        $command->info('Installing Laravel PaperLink...');
                        $command->info('This package will help you track and analyze your application requests.');
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->publishAssets()
                    ->askToRunMigrations()
                    ->endWith(function (InstallCommand $command): void {
                        $command->info('Laravel PaperLink has been installed successfully!');
                        $command->info('You can now visit /analytics to view your dashboard.');
                        $command->info('Check the documentation for configuration options.');
                    });
            });
    }

    public function packageRegistered(): void
    {
        $this->registerMiddlewareAsAliases();
    }

    public function packageBooted(): void
    {
        $this->pushMiddlewareToPipeline();
    }

    private function registerMiddlewareAsAliases(): void
    {
        /* @var \Illuminate\Routing\Router */
        $router = $this->app->make('router');

        $router->aliasMiddleware('paperlink.web', WebRequestCapture::class);
        $router->aliasMiddleware('paperlink.api', APIRequestCapture::class);
        $router->aliasMiddleware('paperlink.access', AnalyticsDashboardMiddleware::class);
    }

    private function pushMiddlewareToPipeline(): void
    {
        if (config('paperlink.capture.web')) {
            $this->app[Kernel::class]->appendMiddlewareToGroup('web', WebRequestCapture::class);
        }

        if (config('paperlink.capture.api')) {
            $this->app[Kernel::class]->appendMiddlewareToGroup('api', APIRequestCapture::class);
        }
    }
}
