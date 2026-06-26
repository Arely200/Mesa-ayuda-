<?php
// src/Config/autoload.php

spl_autoload_register(function ($className) {
    // Mapear namespace a estructura de carpetas
    $baseDir = __DIR__ . '/../';
    
    // Si la clase está en el namespace Core
    if (strpos($className, 'Core\\') === 0) {
        $className = substr($className, 5);
        $file = $baseDir . 'Core/' . $className . '.php';
    } 
    // Si está en Controllers
    elseif (strpos($className, 'Controllers\\') === 0) {
        $className = substr($className, 12);
        $file = $baseDir . 'Controllers/' . $className . '.php';
    }
    // Si está en Models
    elseif (strpos($className, 'Models\\') === 0) {
        $className = substr($className, 7);
        $file = $baseDir . 'Models/' . $className . '.php';
    }
    // Si está en Helpers
    elseif (strpos($className, 'Helpers\\') === 0) {
        $className = substr($className, 8);
        $file = $baseDir . 'Helpers/' . $className . '.php';
    }
    // Si está en Interfaces
    elseif (strpos($className, 'Interfaces\\') === 0) {
        $className = substr($className, 11);
        $file = $baseDir . 'Interfaces/' . $className . '.php';
    }
    // Si está en Middleware
    elseif (strpos($className, 'Middleware\\') === 0) {
        $className = substr($className, 11);
        $file = $baseDir . 'Middleware/' . $className . '.php';
    }
    // Si está en Exceptions
    elseif (strpos($className, 'Exceptions\\') === 0) {
        $className = substr($className, 11);
        $file = $baseDir . 'Exceptions/' . $className . '.php';
    } else {
        // Fallback: buscar en carpetas principales
        $file = $baseDir . $className . '.php';
    }
    
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
});
