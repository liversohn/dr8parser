<?php

class XMLParser {

    private $xml;
    private $db;
    
    public function __construct($filename, $db) {
        $this->xml = simplexml_load_file($filename);
        $this->db = $db;
    }
    
    public function save() {
        $reportId = $this->saveReport($this->xml);
        foreach ($this->xml->children() as $nodeName => $node) {
            switch($nodeName) {
                case 'Record':
                    $this->saveRecord($node, $reportId);
                    break;
                case 'Simulcasting':
                    $this->saveSimulcasting($node, $reportId);
            }
        }
    }
    
    private function saveReport($node) {
        $saver = new Saver\ReportSaver($this->db);
        $this->saveAttributes($node, $saver);
        return $saver->getSavedId();
    }
    
    private function saveRecord($node, $reportId) {
        $saver = new Saver\RecordSaver($this->db);
        $saver->setValue('reportId', $reportId);
        $this->saveAttributes($node, $saver);
        $recordId = $saver->getSavedId();
        if (!empty($node->Participants)) {
            foreach ($node->Participants->Participant as $subNode) {
                $this->saveParticipant($subNode, $recordId);
            }
        }
    }
    
    private function saveSimulcasting($node, $reportId) {
        $saver = new Saver\SimulcastingSaver($this->db);
        $saver->setValue('reportId', $reportId);
        $this->saveAttributes($node, $saver);        
    } 
    
    private function saveParticipant($node, $recordId) {
        $saver = new Saver\ParticipantSaver($this->db);
        $saver->setValue('recordId', $recordId);
        $this->saveAttributes($node, $saver);
    }
    
    private function saveAttributes($node, $saver) {
        $attributes = $node->attributes();
        foreach ($attributes as $key => $val) {
            $saver->setValue($key, $val);
        }
        $saver->save();
    }
    
}