<?php

namespace Saver;

class ReportSaver extends Saver {
    
    protected static $tableName = 'reports';
    protected static $allowedFields = [
        'id',
        'station',
        'dateFrom',
        'dateTo',
        'usageType',
        'filename',
        'sender'
    ]; 
    
}
