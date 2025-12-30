<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ConjuredItemTest extends TestCase
{
    public function testQualityDecreasesBy2EachDay(): void
    {
        $items = [new Item('Conjured', 10, 4)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQualityAndSellIn();
        $this->assertSame(2, $items[0]->quality);
    }

    public function testQualityNeverBelow0(): void
    {
        $items = [new Item('Conjured', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQualityAndSellIn();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testQualityDecreasesBy4WhenSellInIs0(): void
    {
        $items = [new Item('Conjured', 0, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQualityAndSellIn();
        $this->assertSame(1, $items[0]->quality);
    }

    public function testSellInDecresesBy1(): void
    {
        $items = [new Item('Conjured', 10, 7)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQualityAndSellIn();
        $this->assertSame(9, $items[0]->sellIn);
    }

}
