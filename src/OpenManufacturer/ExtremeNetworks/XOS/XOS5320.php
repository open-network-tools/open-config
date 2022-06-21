<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS;

    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS;

    class XOS5320 extends XOS {

        public function __construct() {
            parent::__construct();
        }

        public function analyseConfigFile(){
            foreach ($this->getConfigFile() as $k => $v){
                // @TODO
            }
        }

        public function generateConfig(){
            // @TODO
        }

    }