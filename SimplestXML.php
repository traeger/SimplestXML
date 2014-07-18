<?php

/*
 * Licensed under The MIT License (MIT) (see http://opensource.org/licenses/MIT)
 * https://github.com/traeger/SimplestXML
 * Copyright (c) 2014 Marco Träger <marco.traeger at googlemail.com>
 */

class SimplestXML {
    private function _to_xml(SimpleXMLElement $object, array $data, $listitemname)
    {   
        foreach ($data as $key => $value)
        {   
            if (is_array($value))
            {
                if(is_numeric($key)) {
                    $new_object = $object->addChild($listitemname);
                    $this->_to_xml($new_object, $value, $listitemname);
                }
                else {
                    $new_object = $object->addChild($key);
                    $this->_to_xml($new_object, $value, $listitemname);
                }
            }   
            else
            {
                //http://stackoverflow.com/questions/552957/rationale-behind-simplexmlelements-handling-of-text-values-in-addchild-and-adda
                //$object->addChild($key, $value);
                if(strpos($value,'<') !== false || strpos($value,'>') !== false || strpos($value,'&') !== false) {
                    $value = '<![CDATA['. $value . ']]>';
                }
                $child = $object->addChild($key)->{0} = $value;
            }   
        }   
    } 
    
    public function to_xml($root, $array, $formatOutput = true, $listitemname = "item") {
        $xml = new SimpleXMLElement('<'.$root.'/>');
        $this->_to_xml($xml, $array, $listitemname);
        
        $simpleXml = html_entity_decode($xml->asXML(), ENT_NOQUOTES, 'UTF-8');
        
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = $formatOutput;
        $dom->loadXML($simpleXml);
        $dom->encoding = 'UTF-8';
        
        return $dom->saveXML();
    }
    
    public function makefileheader($filename) {
        header('Content-Type: application/xml; charset=utf-8');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="'.$filename.'.xml"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
    }
    
    public function _from_xml($xml, $listitemname) {
        $arr = array();
 
        foreach ($xml->children() as $r)
        {
            $key = $r->getName();
            if(count($r->children()) == 0)
            {
                $arr[$key] = strval($r);
            }
            else
            {
                if($key == $listitemname) {
                    $arr[] = $this->_from_xml($r, $listitemname);
                }
                else {
                    $arr[$key] = $this->_from_xml($r, $listitemname);
                }
            }
        }
        return $arr;
    }
    
    public function from_xml($data, $listitemname = "item") {
        $data = simplexml_load_string($data);
        return $this->_from_xml($data, $listitemname);
    }
    
    public function from_xmlfile($file, $listitemname = "item") {
        $data = simplexml_load_file($file);
        return $this->_from_xml($data, $listitemname);
    }
}

?>