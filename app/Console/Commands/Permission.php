<?php

namespace App\Console\Commands;

use App\Models\Permission as ModelsPermission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class Permission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get all the routes from web.php and store into permissions table.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes();
        
        foreach ($routes as $route) {
            // dd($route);
            if ($route->getPrefix() == '/admin') {

                ModelsPermission::updateOrCreate([
                    'name' => str_replace('.', ' ', $route->getName()),
                    'slug' => $route->getName(),
                ]);
            }
        }

        echo "all permission store successfully.";
    }
}
