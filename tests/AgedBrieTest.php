<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class AgedBrieTest extends TestCase
{
    public function testQualityIncreasesDaily(): void
    {
        $items = [new Item('Aged Brie', 10, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(3, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(4, $items[0]->quality);
    }

    public function testQualityStopIncreasIn50(): void
    {
        $items = [new Item('Aged Brie', 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
    }

    public function testQualityIncreasesAfterSellInExpired(): void
    {
        $items = [new Item('Aged Brie', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        // "Aged Brie" increases in quality as it gets older.
        // After the sell-by date (sellIn < 0), quality increases twice as fast.
        $this->assertSame(12, $items[0]->quality);
    }

    
}
