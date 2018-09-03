<?php

require_once __DIR__.'/vendor/autoload.php';

$dbConfig = [
    'driver'   => 'mysqli',
    'host'     => 'localhost',
    'username' => 'parser',
    'password' => 'abc124D',
    'database' => 'parser',
];

$logFilename = 'log/parser_log.txt';
$schemeFilename = 'data/dr8_CRo_v100_RC2.xsd';

$filename = isset($argv[1]) ? $argv[1] : NULL;

if (empty($filename)) {
    outputError('No file specified.' . PHP_EOL . 'Usage: parse.php <filename>');
}
if (!file_exists($filename)) {
    outputError('Specified file does not exist.');    
}

try {
    $logger = new Logger\FileLogger($logFilename);
    $logger->log('start: ' . $filename, Logger\Logger::INFO);
    
    $validator = new XSDValidator($logger);
    if (!$validator->validate($filename, $schemeFilename)) {
        $logger->log('process stopped due to validation errors', Logger\Logger::ERROR);
        outputError('Parsing stopped due to schema validation errors. For more info see log file: '.$logFilename);
    }
    
    $db = new Dibi\Connection($dbConfig);
    $parser = new XMLParser($filename, $db);
    $parser->save();
    $logger->log('job finished successfuly', Logger\Logger::INFO);
    
} catch (Exception $e) {
    outputError($e->getMessage());
}


function outputError($message) {
    die('DR-8 Parser error: ' . $message . PHP_EOL);
}