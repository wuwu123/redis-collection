<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace SwoftTest\Testing;

use Xin\RedisCollection\HashCollection;

class DemoHashCollection3 extends HashCollection
{
    protected $prefix = 'demohash3:';

    protected $ttl = 3600;

    protected $exist = true;

    protected $redis;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1');
        $this->redis->auth('910123');
    }

    public function reload($parentId)
    {
        return [
            'id' => 1,
            'name' => 'limx',
        ];
    }

    public function redis()
    {
        return $this->redis;
    }
}
