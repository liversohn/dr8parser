<?php

namespace Saver;

class RecordSaver extends Saver {
    
    protected static $tableName = 'records';
    protected static $allowedFields = [
        'id',
        'reportId',
        'title',
        'spins',
        'ISRC',
        'year',
        'producer',
        'label',
        'recordNo',
        'serialNumber',
        'isPremiere',
        'usage',
        'ISWC',
        'AKA',
        'genre',
        'broadcastedFrom',
        'broadcastedTo',
        'runtime',
        'origin',
        'alternativeTitle',
        'recordedFootage'
    ]; 
    
}
