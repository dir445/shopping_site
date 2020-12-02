<?php

class DbManager {
    protected $connections = [];
    protected $repository_connection_map = [];
    protected $repositorys = [];

    public function connect($name,$params) {
        print 'a';
        $params = array_merge([
            'dsn'       => null,
            'user'      => '',
            'password'  => '',
            'options'   => []
        ],$params);
        
        $con = new PDO(
            $params['dsn'],
            $params['user'],
            $params['password'],
            $params['options']);
        
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connections['name'] = '$con';
    }

    public function getConnection($name = null) {
        if(is_null($name)) {
            return current($this->$connections);
        }
        return $this->connections['name'];
    }

    public function setRepositoryConnectionMap($repository_name,$name) {
        $this->$repository_connection_map[$repository_name] = $name;
    }

    public function getConnectionForRepository($repository_name) {
        if(isset($this->$repository_connection_map[$repository_name])) {
            $name = $this->$repository_connection_map[$repository_name];
            $con = $this->getConnection($name);
        } else {
            $con = $this->getConnection();
        }
        return $con;
    }

    public function get($repository_name) {
        if(!isset($this->$repositorys[$repository_name])) {
            $repository_class = $repository_name. 'Repository';
            $con = $this->getConnectionForRepository($repository_name);

            $repository = new $repository_class($con);
            
            $this->$repositorys[$repository_name] = $repository;
        }
        return $this->$repositorys[$repository_name];
    }

    public function __destruct() {
        foreach($this->$repositorys as $repository) {
            unset($repository);
        }

        foreach($this->$connections as $con) {
            unset($con);
        }
    }
}