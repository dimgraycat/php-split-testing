<?php

namespace Ab\Tests;

use Ab\SplitTesting;

class SplitTestingTest extends \PHPUnit_Framework_TestCase {

    public function testRandam() {
        $params = array(
            'use'       => 'random',
            'variation' => array(
                'hoge', 'moge', 'uga'
            )
        );
        $result = SplitTesting::get($params, 1234);
        $this->assertEquals('uga', $result);

        $result = SplitTesting::get($params);
        $bool = (!empty($result)) ? true : false;
        $this->assertTrue($bool);
    }

    public function testRate() {
        $params = array(
            'use'       => 'rate',
            'variation' => array(
                'rate'  => array(
                    'a'     => 50,
                    'hoge'  => 20,
                    'moge'  => 500,
                ),
                'list'  => array(
                    'default'   => array('hoge'),
                    'a'         => '5%',
                    'hoge'      => 1234567890,
                    'moge'      => '123456789',
                ),
            ),
        );

        $result = SplitTesting::get($params);
        $bool = (!empty($result)) ? true : false;
        $this->assertTrue($bool);
    }

    public function testPattern() {
        $params = array(
            'use'       => 'pattern',
            'variation' => array(
                'pattern'   => array(
                    'a' => '/[0-9]$/',
                    'b' => '/z$/',
                ),
                'list'      => array(
                    'default'   => 'default',
                    'a'         => 'hit 1!',
                    'b'         => 'hit 2!'
                ),
            ),
        );
        $result = SplitTesting::get($params, 1234);
        $this->assertEquals('hit 1!', $result);
        $result = SplitTesting::get($params, 'abcde');
        $this->assertEquals('default', $result);
        $result = SplitTesting::get($params, 'xwz');
        $this->assertEquals('hit 2!', $result);
    }
}
