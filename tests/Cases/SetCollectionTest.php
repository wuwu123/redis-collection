<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Cases;

use SwoftTest\Testing\DemoCollection;
use SwoftTest\Testing\DemoSetCollection;

class SetCollectionTest extends AbstractTestCase
{
    protected $pid = 1;

    protected function tearDown()
    {
        $collection = new DemoSetCollection();
        $collection->redis()->delete('demoset:1');

        parent::tearDown();
    }

    public function testAdd()
    {
        $collection = new DemoSetCollection();
        $collection->add($this->pid, [3, 4]);

        $this->assertTrue($collection->redis()->exists('demoset:1') > 0);
        $this->assertTrue($collection->redis()->sCard('demoset:1') == 6);
    }

    public function testIsMember()
    {
        $collection = new DemoSetCollection();
        $res = $collection->isMember($this->pid, 'a');
        $this->assertTrue($res);

        $collection->add($this->pid, 'b');
        $res = $collection->isMember($this->pid, 'b');
        $this->assertTrue($res);
    }

    public function testCountAndRem()
    {
        $collection = new DemoSetCollection();
        $count = $collection->count($this->pid);
        $this->assertEquals(3, $count);

        $collection->add($this->pid, 10);

        $count = $collection->count($this->pid);
        $this->assertEquals(4, $count);

        $collection->rem($this->pid, 3);
        $this->assertEquals(4, $count);

        $collection->rem($this->pid, 1);
        $count = $collection->count($this->pid);
        $this->assertEquals(3, $count);
    }

    public function testAll()
    {
        $collection = new DemoSetCollection();
        $res = $collection->all($this->pid);
        $this->assertEquals([1, 2, 'a'], $res);

        $collection->rem($this->pid, 1);
        $res = $collection->all($this->pid);
        $this->assertEquals([2, 'a'], $res);
    }
}
