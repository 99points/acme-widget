<?php

namespace Acme;

class RedWidgetOffer implements Offer
{
    public function apply(array $items, array $products): float
    {
        $count = array_count_values($items)['R01'] ?? 0;
        $discount = 0.0;

        if ($count >= 2) {
            $discount = $products['R01'] / 2;
        }

        return $discount;
    }
}
