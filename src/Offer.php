<?php

namespace Acme;

interface Offer
{
    public function apply(array $items, array $products): float;
}
