<?php
namespace Ab\SplitTesting;

use Ab\SplitTesting\PluginBase;

class Pattern extends PluginBase
{

    /**
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
     *
     * @param  mixed      $variation
     * @param  int|string $seed
     * @return mixed
     */
    public static function calculate(array $variation, $seed = null)
    {
        if (!$seed) {
            $seed = self::getSeed();
        }
        $key = self::getKey($seed, $variation['pattern']);
        return $variation['list'][$key];
    }

    private static function getKey($seed, $args)
    {
        foreach ($args as $key => $pattern) {
            if (preg_match($pattern, $seed)) {
                return $key;
            }
        }
        return 'default';
    }
}
