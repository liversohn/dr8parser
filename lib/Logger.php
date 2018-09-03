<?php

namespace Logger;

abstract class Logger {
    
    const ERROR = 1;
    const WARN = 2;
    const INFO = 3;
    
    public function __construct($filename) {
    }
    
    public function log($message, $severity) {
    }
    
    protected function getLine($message, $severity) {
        $logLines = [
            date('Y-m-d-H:i:s'),
            getmypid(),
            '[' . $this->translateSeverity($severity) . ']',
            $message
        ];
        return implode(' ', $logLines) . PHP_EOL;
    }
    
    protected function translateSeverity($severity) {
        switch ($severity) {
            case self::ERROR:
                return 'E';
            case self::WARN:
                return 'W';                
            case self::INFO:
                return 'I';
        }
    }
    
}
