<?php

namespace Logger;

class FileLogger extends Logger {
    
    private $handler;
    
    public function __construct($filename) {
        $this->handler = fopen($filename, 'a+');
        if (!$this->handler) {
            throw new RuntimeException('Cannot open log for write');
        }
    }
    
    public function log($message, $severity) {
        fputs($this->handler, $this->getLine($message, $severity));
    }
   
}
