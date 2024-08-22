# Acme Widget Basket

This project is a proof of concept for the Acme Widget Co sales system.

## Installation

1. Clone the repository
2. Install dependencies via Composer:

    ```bash
    composer install
    ```

3. Run tests:

    ```bash
    composer test
    ```

## Assumptions

- The product catalog, delivery rules, and offers are injected via the constructor for flexibility.
- The basket class is designed to be extendable, with offers and delivery rules encapsulated in their own strategies.

## Code Structure

- `src/Basket.php`: The main basket class.
- `src/Offer.php`: Interface for applying offers.
- `src/RedWidgetOffer.php`: Implementation of the "buy one red widget, get the second half price" offer.
- `tests/BasketTest.php`: PHPUnit test cases for the basket.

## Design Considerations

- **Dependency Injection**: Product catalog, delivery rules, and offers are injected to allow easy testing and flexibility.
- **Strategy Pattern**: Offers are implemented as strategies, allowing easy addition of new offers without modifying the basket class.
