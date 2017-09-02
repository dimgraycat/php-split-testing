<?php
namespace Ab\SplitTesting;

use Ab\SplitTesting\PluginBase;

class Rate extends PluginBase
{
    const RAND_MIN = 0;
    const RAND_MAX = 1000;

    /**
     * e.g.) $variation = [
     *      'rate'  => [
     *          // 1 => 0.1%, 50 => 5%, 500 => 50%, 1000 => 100%
     *          'a' => 50,
     *          'b' => 50,
     *          'c' => 50,
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
        $key = self::getKey($variation['rate']);
        return $variation['list'][$key];
    }

    private static function getKey($args)
    {
        $rand = mt_rand(self::RAND_MIN, self::RAND_MAX);
        $sum = 0;
        foreach ($args as $name => $rate) {
            $sum += $rate;
            if ($rand <= $sum) {
                return $name;
            }
        }
        return 'default';
    }
}
