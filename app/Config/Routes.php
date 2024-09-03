<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('/about', 'Home::about', ['as' => 'about']);
$routes->get('/contact', 'Home::contact', ['as' => 'contact']);

$routes->group('props', function($routes){
    $routes->get('prop-type/(:any)', 'Properties\PropertiesController::getByProptype/$1', ['as' => 'get.prop.type']);
    $routes->get('prop-price/(:any)', 'Properties\PropertiesController::getByPropPrice/$1', ['as' => 'get.prop.price']);
    //props detail
    $routes->get('prop-single/(:num)', 'Properties\PropertiesController::propSingle/$1', ['as' => 'prop.single']);
    //request
    $routes->post('send-request/(:num)', 'Properties\PropertiesController::sendRequest/$1', ['as' => 'send.request']);
    $routes->post('save.prop/(:num)', 'Properties\PropertiesController::saveProperty/$1', ['as' => 'save.prop']);
    $routes->get('prop-by-hometype/(:any)', 'Properties\PropertiesController::propsByHomeType/$1', ['as' => 'props.home.type']);

    $routes->post('search', 'Properties\PropertiesController::search', ['as' => 'props.search']);

});
   
$routes->group('users', function($routes){
    //users

    $routes->get('props-requests', 'Users\UsersController::propsRequests', ['as' => 'users.props.request']);
    $routes->get('props-saved', 'Users\UsersController::propsSaved', ['as' => 'users.props.saved']);

});

$routes->group('admins', [ 'filter'=> 'authfilter'], function($routes){

    //admins
    $routes->get('index', 'Admins\AdminsController::index', ['as' => 'admins.index']);
    $routes->get('logout', 'Admins\AdminsController::logout', ['as' => 'admins.logout']);
    $routes->get('all-admins', 'Admins\AdminsController::displayAdmins', ['as' => 'admins.all']);
    $routes->get('create', 'Admins\AdminsController::createAdmin', ['as' => 'admins.create']);
    $routes->post('create', 'Admins\AdminsController::storeAdmin', ['as' => 'admins.store']);
    //hometypes
    $routes->get('all-home-type', 'Admins\AdminsController::displayHomeTypes', ['as' => 'admins.types.all']);
    $routes->get('create-home-type', 'Admins\AdminsController::createHomeTypes', ['as' => 'admins.create.hometype']);
    $routes->post('create-home-type', 'Admins\AdminsController::storeHomeTypes', ['as' => 'admins.store.hometype']);
    $routes->get('delete-home-type/(:num)', 'Admins\AdminsController::deleteHomeTypes/$1', ['as' => 'admins.delete.hometype']);
    $routes->get('update-home-type/(:num)', 'Admins\AdminsController::updateHomeTypes/$1', ['as' => 'admins.update.hometype']);
    $routes->post('update-home-type/(:num)', 'Admins\AdminsController::editHomeTypes/$1', ['as' => 'admins.edit.hometype']);
    //props
    $routes->get('all-props', 'Admins\AdminsController::displayProps', ['as' => 'props.all']);
    $routes->get('create-props', 'Admins\AdminsController::createProps', ['as' => 'props.create']);
    $routes->post('create-props', 'Admins\AdminsController::storeProps', ['as' => 'props.store']);

    //gallery
    $routes->get('create-gallery', 'Admins\AdminsController::createGallery', ['as' => 'gallery.create']);
    $routes->post('create-gallery', 'Admins\AdminsController::storeGallery', ['as' => 'gallery.store']);
    // $routes->get('create-gallery/(:num)', 'Admins\AdminsController::downloadGalleryZip/$1', ['as' => 'gallery.download']);

    $routes->get('delete-props/(:num)', 'Admins\AdminsController::deleteProps/$1', ['as' => 'props.delete']);


    //request 
    $routes->get('all-requests', 'Admins\AdminsController::displayRequests', ['as' => 'requests.all']);

});

$routes->group('admins', [ 'filter'=>'loginfilter'], function($routes){

    $routes->get('login', 'Admins\AdminsController::login', ['as' => 'admins.login']);
    $routes->post('login', 'Admins\AdminsController::checkLogin', ['as' => 'admins.login.check']);
});




service('auth')->routes($routes);
