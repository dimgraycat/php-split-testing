<?php
namespace Ab\SplitTesting;

use Ab\SplitTesting\PluginBase;

class Pattern extends PluginBase {

    /**
     * @param   mixed $variation
     * @return  mixed
     * e.g.) $variation = [
     *      'pattern'  => [
     *          'a' => '/[1-3]$/',
     *          'b' => '/[4-6]$/',
     *          'c' => '/[7-9]$/',
     *          ...
     *      ],
     *      'list'  => [
     *          'default'   => mixed,   // required
     *          'a'         => mixed,
     *          'b'         => mixed,
     *          'c'         => mixed,
     *      ],
     * ];
     */
    public static function calculate(array $variation, $seed = null) {
        if (!$seed) $seed = self::getSeed();
        $key = self::getKey($seed, $variation['pattern']);
        return $variation['list'][$key];
    }

    private static function getKey($seed, $args) {
        foreach ($args as $key => $pattern) {
            if (preg_match($pattern, $seed)) {
                return $key;
            }
        }
        return 'default';
    }
}
