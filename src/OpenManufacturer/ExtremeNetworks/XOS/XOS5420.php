<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS;

    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\Toolbox\AnalyseInterfaces;
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
                if($vlan == 1){
                    $this->addConfigExportLine("configure vlan \"Default\" description \"".$v->getDescription()."\"");
                } else {
                    $this->addConfigExportLine("create vlan \"".$v->getName()."\"");
                    $this->addConfigExportLine("configure vlan \"".$v->getName()."\" tag ".$v->getId());
                    $this->addConfigExportLine("configure vlan \"".$v->getName()."\" description \"".$v->getDescription()."\"");
                }
                foreach ($this->getConfig()->getInterfaces()->getEthernet() as $slot => $s){
                    foreach ($s as $unit => $u){
                        foreach ($u as $port => $p){
                            if(array_key_exists($vlan, $p->getVlans())){
                                if($p->getTagging() == "tagAll") $this->addConfigExportLine("configure vlan \"".$v->getName()."\" add ports ".$slot.":".$port." tagged");
                                elseif($p->getTagging() == "unTagPvidOnly"){
                                    if($p->getPvid() == $vlan) $this->addConfigExportLine("configure vlan \"".$v->getName()."\" add ports ".$slot.":".$port." untagged");
                                    else $this->addConfigExportLine("configure vlan \"".$v->getName()."\" add ports ".$slot.":".$port." tagged");
                                } elseif($p->getTagging() == null) $this->addConfigExportLine("configure vlan \"".$v->getName()."\" add ports ".$slot.":".$port." untagged");
                                else {
                                    print_r($p);
                                }
                            }
                        }
                    }
                }
            }
        }

        private function generateHeader($title = ""){
            $this->addConfigExportLine("#");
            $this->addConfigExportLine("# ".$title);
            $this->addConfigExportLine("#");
        }

    }