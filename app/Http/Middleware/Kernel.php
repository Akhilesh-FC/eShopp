
<?php
namespace App\Http;

use App\Http\Middleware\CheckSession;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // Other middleware...
        'checkSession' => CheckSession::class,  // Add this line to register the middleware
    ];
}
