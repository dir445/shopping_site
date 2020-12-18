<?php

class ShopApplication extends Application {
    protected $login_action = ['staff','login'];

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
                => ['controller' => 'staff', 'action' => 'list'],
                '/staff'
                => ['controller' => 'staff', 'action' => 'list'],
                '/staff/:action'
                => ['controller' => 'staff']
        ];
    }
}