# Coding Challenge
#### Ultimaker Software Engineer (PHP) coding challenge

For this challenge I decided to build a simple stock broker to give this project a little bit of context and to 
demonstrate the required components for this challenge.

The stock broker can buy and sell stocks at a given price. The broker collects orders in a orderbook and returns some
basic statistics about the placed orders. 

Due to the limited amount of time for this challenge i did not implement any storage for the broker.  

#### Installation
Make sure you have PHP 7.2 and composer installed, then run:
 
``composer install``

#### Running tests
``php vendor/bin/phpunit``

#### Demo
Check the code in bin/demo.php, to run it:

``php bin/demo.php``