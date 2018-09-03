<?php

namespace Saver;

class ParticipantSaver extends Saver {
    
    protected static $tableName = 'participants';
    protected static $allowedFields = [
        'id',
        'recordId',
        'name',
        'role',
        'IPDN',
        'performance',
        'grossFee',
        'modifier',
        'IPI',
        'birthDate',
    ]; 
    
}
