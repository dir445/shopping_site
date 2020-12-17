<?php

class ShopApplication extends Application {

    function configure(){        
        $this->db_manager->connect('master', [
            'dsn'      => 'mysql:dbname=shop;host=mysql;charset=utf8',
            'user'     => 'root',
            'password' => 'password'
        ]);
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
                // ,

                // '/staff/disp'
                // => ['controller' => 'staff', 'action' => 'disp'],
                // '/staff/add'
                // => ['controller' => 'staff', 'action' => 'add'],
                // '/staff/add_check'
                // => ['controller' => 'staff', 'action' => 'add_check'],
                // '/staff/add_done'
                // => ['controller' => 'staff', 'action' => 'add_done'],
                // '/staff/edit'
                // => ['controller' => 'staff', 'action' => 'edit'] 
        ];
    }
}