<?php
namespace Ab\SplitTesting;

use Ab\SplitTesting\PluginBase;

class Random extends PluginBase
{

    /**
     * e.g.) $variation = [
     *      mixed,
     *      mixed,
     *      mixed,
     *      ...
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
        mt_srand($seed);
        $count = count($variation) - 1;
        $idx = mt_rand(0, $count);
        return $variation[$idx];
    }
}
