<?php
namespace Ab;
/**
 * A server-side A/B/n testing tool
 *
 * @version     1.0.0
 * @access      public
 * @author      dimgraycat <dimgray.cat@gmail.com>
 * @copyright   dimgraycat All Rights Reserved
 * @category    optimizely ab split testing
 * @package     Splittesting
 */
class SplitTesting {
    /**
     * @param   mixed           $params
     * @seed    int or string   $seed
     *
     */
    public static function get(array $params, $seed = null) {
        $className = ucfirst($params['use']);
        $fullyQualifiedName = '\\Ab\\SplitTesting\\' . $className;
        return $fullyQualifiedName::calculate($params['variation'], $seed);
    }
}
