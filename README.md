# Gilded Rose PHP

This project is a PHP implementation of the Gilded Rose kata.  
It manages a list of items and updates their `quality` and `sellIn` values according to predefined rules:

- Normal items: quality decreases each day, decreases twice as fast after `sellIn` is below 0.  
- Aged Brie: quality increases each day, doubles after `sellIn` passes 0.  
- Backstage passes: quality increases as the concert approaches, drops to 0 after the concert.  
- Sulfuras: legendary item, quality and sellIn never change.  
- Conjured items: quality degrades twice as fast as normal items.

## Running Tests

All tests are implemented with PHPUnit. Run them with:

```bash
composer tests
