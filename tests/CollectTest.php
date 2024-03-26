<?php

require_once 'C:\Users\nekra\PhpstormProjects\collect\src\Collect.php';
require_once 'C:\Users\nekra\PhpstormProjects\collect\src\helpers.php';

use PHPUnit\Framework\TestCase;

class CollectTest extends TestCase
{
    public function testCount()
    {
        $collect = new Collect\Collect([13,17]);
        $this->assertSame(2, $collect->count());
    }

    public function testKeys()
    {
        $collect = new Collect\Collect(['key1' => 13, 'key2' => 17]);
        $keys = $collect->keys();
        $this->assertSame(['key1', 'key2'], $keys->toArray());
    }

    public function testValues()
    {
        $collect = new Collect\Collect(['0' => 23, '1' => 56]);
        $keys = $collect->values();
        $this->assertSame([23, 56], $keys->toArray());
    }

    public function testGet()
    {
        $collect = new Collect\Collect(['0' => 7, '1' => 34]);

        // Тестирование получения всего массива, если ключ не указан
        $allValues = $collect->get();
        $this->assertSame(['0' => 7, '1' => 34], $allValues);
    }

    public function testExcept()
    {
        $ars = array(0 => ["one" => 1, "five" => 5], 5 => "five");
        $collect = new Collect\Collect($ars);
        $this->assertSame(collection(["one" => 1, "five" => 5]), $collect->except(...$ars));
    }


    public function testOnly()
    {
        $collect = new Collect\Collect(['id' => 1, 'name' => 'John', 'age' => 30]);

        // Тестирование выбора атрибутов из массива
        $result = $collect->only('id', 'age');
        $this->assertSame(['id' => 1, 'age' => 30], $result->toArray());
    }


    public function testFirst()
    {
        $collect = new Collect\Collect([13, 17]);
        $first = $collect->first();
        $this->assertSame(13, $first);
    }

    public function testToArray()
    {
        $collect = new Collect\Collect([13, 17]);
        $this -> assertSame([13, 17], $collect->toArray());
    }

    public function testSearch()
    {
        $collect = new Collect\Collect([
            ['id' => 1, 'name' => 'John'],
            ['id' => 2, 'name' => 'Jane'],
            ['id' => 3, 'name' => 'John']
        ]);

        // Тестирование поиска по значению ключа
        $result = $collect->search('name', 'John');
        $this->assertSame([['id' => 1, 'name' => 'John'], ['id' => 3, 'name' => 'John']], $result->toArray());
    }


    public function testMap()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $result = $collect->map(function($item) {
            return $item * 5;
        });
        $this->assertSame([5, 10, 15], $result->toArray());
    }

    public function testFilter()
    {
        $collect = new Collect\Collect([1, 2, 3, 4, 5]);
        $result = $collect->filter(function($item) {
            return $item % 2 == 0;
        });
        $this->assertSame([1 => 2, 3 => 4], $result->toArray());
    }

    public function testEach()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $result = [];

        // Тестирование выполнения callback-функции для каждого элемента массива
        $collect->each(function($item, $key) use (&$result) {
            $result[$key] = $item * 2;
        });

        $this->assertSame([2, 4, 6], $result);
    }

    public function testPush()
    {
        $collect = new Collect\Collect([1, 2, 3]);

        $collect->push(4);
        $this->assertSame([1, 2, 3, 4], $collect->toArray());

    }

    public function testUnshift()
    {
        $collect = new Collect\Collect([1, 2, 3]);

        $collect->unshift(0);
        $this->assertSame([0, 1, 2, 3], $collect->toArray());
    }

    public function testShift(){
        $collect = new Collect\Collect([1, 2, 3]);
        $collect->shift();
        $this->assertSame( [2, 3], $collect->toArray());
    }

    public function testPop(){
        $collect = new Collect\Collect([1, 2, 3]);
        $collect->pop();
        $this->assertSame( [1, 2], $collect->toArray());
    }

    public function testSplice()
    {
        $ars = array(1, 2, 3, 4);
        $collect = new Collect\Collect($ars);
        $this->assertSame(array(1), array($collect->splice($ars)));
    }


}