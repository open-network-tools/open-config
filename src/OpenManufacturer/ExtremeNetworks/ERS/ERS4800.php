<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS;

    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS;

    class ERS4800 extends ERS {

        public function __construct() {
            parent::__construct();
        }

        public function analyseConfigFile(){
            foreach ($this->getConfigFile() as $k => $v){
                // @TODO
            }
        }

        public function generateConfig(){
            //@TODO
        }

    }