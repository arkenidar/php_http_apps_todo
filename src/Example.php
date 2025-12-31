<?php

namespace App;

/**
 * Example class to demonstrate PSR-4 autoloading
 *
 * This class shows how to use the new autoloading system.
 * Classes in the src/ directory with the App\ namespace
 * will be automatically loaded without requiring manual includes.
 *
 * Usage example:
 *   $example = new \App\Example();
 *   echo $example->greet();
 *
 * You can delete this file once you understand how autoloading works.
 */
class Example
{
    /**
     * Simple greeting method to verify autoloading works
     *
     * @return string A greeting message
     */
    public function greet(): string
    {
        return "Autoloading works! This class was loaded automatically without require_once.";
    }
}
