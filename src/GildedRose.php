<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
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
        if ($item->quality < 50) {
            $item->quality++;
        }

        $item->sellIn--;

        if ($item->sellIn < 0 && $item->quality < 50) {
            $item->quality++;
        }
    }

    private function updateBackstagePass(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality++;
            if ($item->sellIn <= 10 && $item->quality < 50) {
                $item->quality++;
            }
            if ($item->sellIn <= 5 && $item->quality < 50) {
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

    public function updateQuality(): void
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
