<?php

namespace Saver;

class SimulcastingSaver extends Saver {
    
    protected static $tableName = 'simulcasting';
    protected static $allowedFields = [
        'id',
        'reportId',
        'from',
        'to',
        'station'
    ]; 
    
}
