<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\Toolbox;

    class AnalyseInterfaces {

        static function explode($data){
            $interfaces = array();
            $data = explode(",", $data);
            foreach ($data as $k => $v){
                if(strpos($v, '-') !== false){
                    $subinterface = explode("/", $v);
                    $range = explode("-", $subinterface[1]);
                    for ($i=$range[0];$i<=$range[1];$i++) $interfaces[] = $subinterface[0]."/".$i;
                } else {
                    $interfaces[] = $v;
                }
            }
            return $interfaces;
        }

    }