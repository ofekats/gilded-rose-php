<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class NormalItemsTest extends TestCase
{
    public function testQualityDecreasesBy1(): void
    {
        $items = [new Item('item1', 10, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(1, $items[0]->quality);
    }

    public function testSellInDecreasesBy1(): void
    {
        $items = [new Item('item1', 10, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->sellIn);
    }

    public function testQualityDontDecreasesBelow0(): void
    {
        $items = [new Item('item1', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }
    
    public function testQualityDecreasesTwiceAfterSellInPassed(): void
    {
        $items = [new Item('item1', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }
}
