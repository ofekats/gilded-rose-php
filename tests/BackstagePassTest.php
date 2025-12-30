<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class BackstagePassTest extends TestCase
{
    public function testQualityIncreasesBy1WhenSellInGreaterThan10(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 20, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(31, $items[0]->quality);
    }

    public function testQualityIncreasesBy2WhenSellInBetween6And10(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(32, $items[0]->quality);
    }

    public function testQualityIncreasesBy3WhenSellInLeaaThen6(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(33, $items[0]->quality);
    }

    public function testQualityDropsTo0AfterConcert(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

     public function testQualityStopIncreasIn50(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
    }


}
