<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Model::preventLazyLoading(!app()->isProduction());
        Schema::defaultStringLength(125);
        Schema::enableForeignKeyConstraints();
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Gate::after(function ($user, $ability) {
            return $user->hasRole('super-admin');
        });

        Blade::directive('excerpt', function ($expression) {
            $expressionParts = explode(',', $expression);
            $text = $expressionParts[0] ?? '';
            $length = $expressionParts[1] ?? 10;

            return "<?php echo Str::limit(strip_tags($text), intval($length)); ?>";
        });

    }
}
