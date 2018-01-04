<?php
require_once __DIR__ . '/../vendor/autoload.php';

$path = readline('Please enter the input file path: ');

try {

    if (!is_file($path)) {
        die('File not found' . PHP_EOL);
    }

    $line = file_get_contents($path);
    $result = (new \Asil\Otus\HomeTask_1_1\SimpleBracketsProcessor($line))->processBracketLine();

    if ($result) {
        echo 'String is valid' . PHP_EOL;
    } else {
        echo 'String is invalid' . PHP_EOL;
    }

} catch (LengthException $e) {
    die('File cannot be empty' . PHP_EOL);
} catch (InvalidArgumentException $e) {
    die($e->getMessage() . PHP_EOL);
} catch (Throwable $e) {
    die('Something went wrong. Please try again' . PHP_EOL);
}