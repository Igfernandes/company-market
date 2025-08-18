<?php

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;

class ArrayTest extends CIUnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Carrega o helper customizado
        helper('array');
    }

    /** @test */
    public function testRemoveDuplicatesInArray_removes_duplicates_by_property()
    {
        $objects = [
            (object)['id' => 1, 'name' => 'Alice'],
            (object)['id' => 2, 'name' => 'Bob'],
            (object)['id' => 1, 'name' => 'Alice'], // duplicado
            (object)['id' => 3, 'name' => 'Charlie']
        ];

        $result = removeDuplicatesInArray($objects, 'id');

        $this->assertCount(3, $result);
        $this->assertEquals([1, 2, 3], array_map(fn($o) => $o->id, $result));
    }

    /** @test */
    public function testRemoveDuplicatesInArray_skips_objects_without_property()
    {
        $objects = [
            (object)['id' => 1],
            (object)['name' => 'NoID'],
            (object)['id' => 2]
        ];

        $result = removeDuplicatesInArray($objects, 'id');

        $this->assertCount(2, $result);
        $this->assertEquals([1, 2], array_map(fn($o) => $o->id, $result));
    }

    /** @test */
    public function testIsValidIndexInArray_returns_true_for_valid_index()
    {
        $list = ['a' => 'Apple', 'b' => 'Banana'];

        $this->assertTrue(isValidIndexInArray('a', $list));
    }

    /** @test */
    public function testIsValidIndexInArray_returns_false_for_invalid_or_empty_index()
    {
        $list = ['a' => 'Apple', 'b' => ''];

        $this->assertFalse(isValidIndexInArray('b', $list)); // empty
        $this->assertFalse(isValidIndexInArray('c', $list)); // not set
    }

    /** @test */
    public function testGetOnlyNumbers_filters_only_integers()
    {
        $array = [1, '2', 3, 'abc', 0, null, 4.5];

        $result = getOnlyNumbers($array);

        $this->assertEquals([1, 3, 0], $result); // mantém apenas inteiros
    }

    /** @test */
    public function testGetOnlyNumbers_returns_empty_array_if_no_integers()
    {
        $array = ['a', 'b', null, '10', 4.5];

        $result = getOnlyNumbers($array);

        $this->assertEmpty($result);
    }
}
