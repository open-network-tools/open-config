<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS;

    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS;

    class XOS5420 extends XOS {

        public function __construct() {
            parent::__construct();
        }

        public function generateConfig(){
            $this->generateVlan();
        }

        private function generateVlan(){
            $this->generateHeader("Module vlan configuration.");
            foreach ($this->getConfig()->getVlans() as $vlan => $v){
                $this->addConfigExportLine("create vlan \"".$v->getName()."\"");
                $this->addConfigExportLine("configure vlan \"".$v->getName()."\" tag ".$v->getId());
            }
        }

        private function generateHeader($title = ""){
            $this->addConfigExportLine("#");
            $this->addConfigExportLine("# ".$title);
            $this->addConfigExportLine("#");
        }

    }