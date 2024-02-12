<?php

namespace WpdAuthorPublications;

abstract class Singleton
{
//    hold the single instance per class
    /**
     * @var
     */
    protected static $instance;

    /**
     *
     */
    abstract protected function __construct();

// prevent cloning (PHP specific)

    /**
     * @return void
     */
    private function __clone(){}

//    method for creating/returning the existing instance

    /**
     * @return mixed
     */
    public static function getInstance(){
//    self == the class that it is written in
//    static == the class that implements/calls the method
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}