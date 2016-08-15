<?php

namespace App;

use Symfony\Component\ClassLoader\ApcClassLoader;

class ClassLoader extends ApcClassLoader
{

    private $prefix;

    public function __construct($prefix, $decorated)
    {
        parent::__construct($prefix, $decorated);
        $this->prefix = $prefix;
        if (!apcu_exists($prefix.'_class_load_total')) {
            apcu_store(['portal_class_load_miss' => 0, 'portal_class_load_total' => 0]);
        }
    }


    public function findFile($class)
    {
        apcu_inc($this->prefix.'_class_load_total');
        $file = apcu_fetch($this->prefix.$class, $success);
        if (!$success) {
            apcu_inc($this->prefix.'_class_load_miss');
            apcu_store($this->prefix.$class, $file = $this->decorated->findFile($class) ?: null);
        }

        return $file;
    }
}