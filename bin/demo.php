<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';


// Construct container
$containerConfig = require 'config/container.php';
$container = new \Ultimaker\Challenge\Infrastructure\Container\Container();

foreach ($containerConfig as $id => $factory)
{
    $container->set($id, $factory);
}

// Get broker service
/** @var \Ultimaker\Challenge\Application\Service\BrokerServiceInterface $brokerService */
$brokerService = $container->get(\Ultimaker\Challenge\Application\Service\BrokerServiceInterface::class);

// Trade some stocks
$brokerService->placeBuyOrder('QCOM', 14.23, 30);
$brokerService->placeBuyOrder('QCOM', 13.77, 10);
$brokerService->placeSellOrder('QCOM', 23.77, 15);
$brokerService->placeBuyOrder('MSFT', 110.23, 20);
$brokerService->placeSellOrder('MSFT', 130.23, 10);
$brokerService->placeBuyOrder('ATVI', 80.65, 55);
$brokerService->placeSellOrder('ATVI', 90.35, 52);
$brokerService->placeSellOrder('ATVI', 96.27, 3);
$brokerService->placeBuyOrder('TSLA', 310.00, 30);
$brokerService->placeSellOrder('TSLA', 320.00, 30);
$brokerService->placeSellOrder('AAPL', 233.20, 75);
$brokerService->placeBuyOrder('AAPL', 200.20, 23);

$statistics = $brokerService->getBrokerStatistics();

// Output:
if(count($statistics->stockStatistics) > 0)
{
    $header = array_keys(get_object_vars($statistics->stockStatistics[0]));
    echo implode(" | ", $header) . PHP_EOL;
    foreach ($statistics->stockStatistics as $stockStatistic)
    {
        echo implode("\t", get_object_vars($stockStatistic)) . PHP_EOL;
    }
}
