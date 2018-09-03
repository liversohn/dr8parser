<?php

class XSDValidator {

    private $xml;
    private $logger;
    
    public function __construct(Logger\Logger $logger) {
        libxml_use_internal_errors(true);
        $this->xml= new DOMDocument();
        $this->logger = $logger;
    }
    
    public function validate($filename, $scheme) {
        $this->xml->load($filename, LIBXML_NOBLANKS);
        if (!@$this->xml->schemaValidate($scheme)) {
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                $msg = 'validation problem > level: ' . $this->getLevelTranslated($error->level) . ' line: '. $error->line . ' msg: ' .$error->message;
                $this->logger->log($msg, Logger\Logger::WARN);
            }
            libxml_clear_errors();
            return FALSE;
        }
        return TRUE;
    }
    
    public function getLevelTranslated($level) {
        switch ($level) {
            case LIBXML_ERR_WARNING:
                return "warning";
            case LIBXML_ERR_ERROR:
                return "error";
            case LIBXML_ERR_FATAL:
                return "fatal error";
                break;
        }
    }
    
}