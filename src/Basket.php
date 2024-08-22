<?php

namespace Acme;

class Basket
{
    private $products;
    private $deliveryRules;
    private $offers;
    private $items = [];

    public function __construct(array $products, array $deliveryRules, array $offers)
    {
        $this->products = $products;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add(string $productCode): void
    {
        if (!isset($this->products[$productCode])) {
            throw new \InvalidArgumentException("Invalid product code: $productCode");
        }
        $this->items[] = $productCode;
    }

    public function total(): float
    {
        $subtotal = $this->calculateSubtotal();
        $discount = $this->applyOffers($subtotal);
        $delivery = $this->calculateDelivery($subtotal - $discount);

        return round($subtotal - $discount + $delivery, 2);
    }

    private function calculateSubtotal(): float
    {
        $subtotal = 0.0;
        foreach ($this->items as $item) {
            $subtotal += $this->products[$item];
        }

        return $subtotal;
    }

    private function applyOffers(float $subtotal): float
    {
        $discount = 0.0;
        foreach ($this->offers as $offer) {
            $discount += $offer->apply($this->items, $this->products);
        }
        
        return $discount;
    }

    private function calculateDelivery(float $total): float
    {
        foreach ($this->deliveryRules as $threshold => $cost) {
            if ($total < $threshold) {
                return $cost;
            }
        }
        return 0.0;
    }
}
