<?php
require_once '../vendor/autoload.php';
require_once 'PersistanceManager.class.php';
require_once 'Config.class.php';

Flight::register('pm', 'PersistanceManager');

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET /users', function(){
  $users = Flight::pm()->get_all_users();
  Flight::json($users);
});

Flight::route('DELETE /users/@id', function($id){
  Flight::pm()->delete_user($id);
});

Flight::route('POST /users', function(){
  $request = Flight::request();
  $user = [
    'first_name' => $request->data->first_name,
    'last_name' => $request->data->last_name,
    'email' => $request->data->email,
    'amount' => $request->data->amount
  ];
  Flight::pm()->add_user($user);
  Flight::redirect('../index.html');
});

Flight::start();

?>
