<?php 

// Define your base directory 
$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the base directory from the request if present
if (strpos($request, $base_dir) === 0) {
    $request = substr($request, strlen($base_dir));
}

// Ensure the request is at least '/'
if ($request == '') {
    $request = '/';
}

$apis = [
    "/signup" => ['controller' => 'User_Controller', "method" => 'signup'],
    "/login"  => ['controller' => 'User_Controller', "method" => 'login'],
    "/add_image_metadata"       => ['controller' => 'image_metadata_Controller', "method" => 'add_image_metadata'],
    "/delete_image_metadata"    => ['controller' => 'image_metadata_Controller', "method" => 'delete_image_metadata'],
    "/update_image_metadata"    => ['controller' => 'image_metadata_Controller', "method" => 'update_image_metadata']
];

if (isset($apis[$request])) {
    $controller_name = $apis[$request]['controller'];
    $method = $apis[$request]['method'];
    require_once "./apis/v1/{$controller_name}.php";
    
    $controller = new $controller_name();
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "Error: Method {$method} not found in {$controller_name}.";
    }
} else {
    echo "404 Not Found";
}