<?php

declare(strict_types=1);

namespace GildedRose;

/**
 * Class GildedRose
 * Manages the quality and sellIn values of items according to the rules:
 * - Normal items decrease in quality by 1 each day, by 2 after sellIn date
 * - Aged Brie increases in quality, twice as fast after sellIn
 * - Backstage passes increase in quality by 1, 2, or 3 depending on days left, drops to 0 after concert
 * - Conjured items degrade twice as fast as normal items
 * - Sulfuras never changes
 */

final class GildedRose
{
    /**
     * @param Item[] $items
     */

    private const MAX_QUALITY = 50;

    public function __construct(
        private array $items
    ) {
    }

    private function updateNormalItem(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality--;
        }

        $item->sellIn--;

        if ($item->sellIn < 0 && $item->quality > 0) {
            $item->quality--;
        }
    }

    private function updateAgedBrie(Item $item): void
    {
        if ($item->quality < self::MAX_QUALITY) {
            $item->quality++;
        }

        $item->sellIn--;

        if ($item->sellIn < 0 && $item->quality < self::MAX_QUALITY) {
            $item->quality++;
        }
    }

    private function updateBackstagePass(Item $item): void
    {
        if ($item->quality < self::MAX_QUALITY) {
            $item->quality++;
            if ($item->sellIn <= 10 && $item->quality < self::MAX_QUALITY) {
                $item->quality++;
            }
            if ($item->sellIn <= 5 && $item->quality < self::MAX_QUALITY) {
                $item->quality++;
            }
        }

        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }

    private function updateConjuredItem(Item $item): void
    {
        $decrease = 2;

        if ($item->quality > 0) {
            $item->quality = max(0, $item->quality - $decrease);
        }

        $item->sellIn--;

        if ($item->sellIn < 0 && $item->quality > 0) {
            $item->quality = max(0, $item->quality - $decrease);
        }
    }

    public function updateQualityAndSellIn(): void
    {
        foreach ($this->items as $item) {
            if ($item->name === 'Aged Brie') {
                $this->updateAgedBrie($item);
            } elseif ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                $this->updateBackstagePass($item);
            } elseif ($item->name === 'Sulfuras, Hand of Ragnaros') {
                continue; //Sulfuras doesn't changed
            } elseif ($item->name === 'Conjured') {
                $this->updateConjuredItem($item);
            } else {
                $this->updateNormalItem($item);
            }
        }
    }


}
