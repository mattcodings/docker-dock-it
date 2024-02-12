<?php

namespace wpd_author_publications;

abstract class Singleton
{
    private static $instance;

    abstract protected function __construct();

    private function __clone(){}

    public static function getInstance(){
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}