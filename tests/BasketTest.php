<?php

use Acme\Basket;
use Acme\RedWidgetOffer;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testTotalWithoutOffers()
    {
        $products = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ];

        $deliveryRules = [
            50 => 4.95,
            90 => 2.95
        ];

        $offers = [];

        $basket = new Basket($products, $deliveryRules, $offers);
        $basket->add('B01');
        $basket->add('G01');

        $this->assertEquals(37.85, $basket->total());
    }

    public function testTotalWithRedWidgetOffer()
    {
        $products = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ];

        $deliveryRules = [
            50 => 4.95,
            90 => 2.95
        ];

        $offers = [new RedWidgetOffer()];

        $basket = new Basket($products, $deliveryRules, $offers);
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(54.38, $basket->total());
    }

    public function testTotalWithRedandBlueWidget()
    {
        $products = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ];

        $deliveryRules = [
            50 => 4.95,
            90 => 2.95
        ];

        $offers = [];

        $basket = new Basket($products, $deliveryRules, $offers);
        $basket->add('R01');
        $basket->add('G01');

        $this->assertEquals(60.85, $basket->total());
    }

    //B01, B01, R01, R01, R01
    public function testTotalWithRedTwoandRedThree()
    {
        $products = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ];

        $deliveryRules = [
            50 => 4.95,
            90 => 2.95
        ];

        $offers = [];

        $basket = new Basket($products, $deliveryRules, $offers);
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('B01');

        //on running test in terminal, we have error: Failed asserting that 92.7 matches expected 98.27. 
        $this->assertEquals(98.27, $basket->total());
    }
    
}
