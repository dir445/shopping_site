<?php

class ShopApplication extends Application {
    protected $login_action = ['account','login'];

    function configure(){        
        $this->db_manager->connect('master', [
            'dsn'      => 'mysql:dbname=shop;host=mysql;charset=utf8',
            'user'     => 'root',
            'password' => 'password'
        ]);
    }

    function initialize() {
        parent::initialize();
        header('Expires:-1');
        header('Cache-Control:');
        header('Pragma:');        
    }

    function getRootDir() {
        return dirname(__FILE__);
    }

    function registerRoutes() {
        return [
                '/'
                => ['controller' => 'account', 'action' => 'top'],
                '/account/:action'
                => ['controller' => 'account'],
                '/staff'
                => ['controller' => 'staff', 'action' => 'list'],
                '/staff/'
                => ['controller' => 'staff', 'action' => 'list'],
                '/staff/:action'
                => ['controller' => 'staff'],
                '/product'
                => ['controller' => 'product', 'action' =>'list'],
                '/product/'
                => ['controller' => 'product', 'action' =>'list'],
                '/product/:action'
                => ['controller' => 'product']
        ];
    }
}