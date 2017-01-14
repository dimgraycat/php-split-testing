<?php
namespace Ab\SplitTesting;

abstract class PluginBase {
    public static function calculate(array $variation, $seed = null) {}

    protected static function getSeed() {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }
}
