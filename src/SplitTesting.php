<?php
namespace Ab;

/**
 * A server-side A/B/n testing tool
 *
 * @version   1.0.1
 * @access    public
 * @author    dimgraycat <dimgray.cat@gmail.com>
 * @copyright 2017 dimgraycat All Rights Reserved
 * @package   SplitTesting
 * @license   MIT
 */
class SplitTesting
{
    /**
     * @param   mixed      $params
     * @param   int|string $seed
     * @return  mixed       result
     */
    public static function get(array $params, $seed = null)
    {
        $className = ucfirst($params['use']);
        $fullyQualifiedName = '\\Ab\\SplitTesting\\' . $className;
        return $fullyQualifiedName::calculate($params['variation'], $seed);
    }
}
