<?php
namespace App\Foundation;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use App\Data\Contracts\ConversationRepositoryInterface;
use App\Data\Contracts\ConverserRepositoryInterface;
use App\Data\Contracts\MessageRepositoryInterface;

use App\Data\Repositories\EloquentConversationRepository;
use App\Data\Repositories\EloquentConverserRepository;
use App\Data\Repositories\EloquentMessageRepository;


class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        // Register the service providers of your Services here.
        $this->app->register('App\Services\Web\Providers\WebServiceProvider');

        // Bind Contracts to Implementations here.
        $this->app->bind(ConversationRepositoryInterface::class, function () {
            return new EloquentConversationRepository();
        });

        $this->app->bind(ConverserRepositoryInterface::class, function () {
            return new EloquentConverserRepository();
        });

        $this->app->bind(MessageRepositoryInterface::class, function () {
            return new EloquentMessageRepository();
        });

    }
}
