<?php

define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);


use App\Services\PostService;
use App\Post;

$postService = new PostService();

echo $postService->importPosts($request);  


//0 * * * * php /var/www/mb_square1/scripts/importPosts.php

?>

