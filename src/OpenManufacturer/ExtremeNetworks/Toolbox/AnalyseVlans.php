<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\Toolbox;

    class AnalyseVlans {

        static function explode($data){
            $vlans = [];
            $data = explode(",", $data);
            foreach ($data as $k => $v){
                if (strpos($v, '-') !== false) {
                    $range = explode("-", $v);
                    for($i=$range[0];$i<=$range[1];$i++) $vlans[] = (int)$i;
                } else {
                    for($i=$v; $i<=$v;$i++) $vlans[] = (int)$i;
                }
            }
            return $vlans;
        }

    }