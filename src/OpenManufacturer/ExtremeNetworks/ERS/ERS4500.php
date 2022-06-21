<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS;

    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\Toolbox\AnalyseInterfaces;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\Toolbox\AnalyseVlans;

    class ERS4500 extends ERS {

        public function __construct() {
            parent::__construct();
            $this->getConfig()->addVlans(1);
        }

        public function analyseConfigFile(){
            foreach ($this->getConfigFile() as $k => $v){
                $this->analyseInterface($k, $v);
                $this->analyseSnmp($k, $v);
                $this->analyseVlan($k, $v);
            }
        }

        private function analyseInterface($key, $line){
            if(preg_match("#^name port ([0-9\/\-\,]+) \"(.*)\"#", $line, $match)){
                $interfaces = AnalyseInterfaces::explode($match[1]);
                foreach ($interfaces as $interface){
                    $i = explode("/", $interface);
                    $this->getConfig()->getInterfaces()->getEthernet($i[0], 1, $i[1])->setName($match[2]);
                }
                $this->addConfigReport($key);
            } elseif(preg_match("#^name port ([0-9\/\-\,]+) (.*)#", $line, $match)){
                    $interfaces = AnalyseInterfaces::explode($match[1]);
                    foreach ($interfaces as $interface){
                        $i = explode("/", $interface);
                        $this->getConfig()->getInterfaces()->getEthernet($i[0], 1, $i[1])->setName($match[2]);
                    }
                    $this->addConfigReport($key);
                }
        }

        private function analyseSnmp($key, $line){
            if(preg_match("#^snmp-server contact \"(.*)\"#", $line, $match)){
                $this->getConfig()->getSnmp()->setContact($match[1]);
                $this->addConfigReport($key);
            } elseif(preg_match("#^snmp-server name \"(.*)\"#", $line, $match)){
                $this->getConfig()->getSystem()->setHostName($match[1]);
                $this->addConfigReport($key);
            } elseif(preg_match("#^snmp-server location \"(.*)\"#", $line, $match)){
                $this->getConfig()->getSnmp()->setLocation($match[1]);
                $this->addConfigReport($key);
            }
        }

        private function analyseVlan($key, $line){
            if(preg_match("#^vlan create ([0-9,-]+)#", $line, $match)){
                $vlans = AnalyseVlans::explode($match[1]);
                foreach ($vlans as $vlan) $this->getConfig()->addVlans($vlan);
                $this->addConfigReport($key);
            } elseif(preg_match("#^vlan name ([0-9]+) \"(.*)\"#", $line, $match)){
                $this->getConfig()->getVlans($match[1])->setDescription($match[2]);
                $this->addConfigReport($key);
            } elseif(preg_match("#^vlan ports ([0-9\/\-\,]+) pvid ([0-9]+)#", $line, $match)){
                $interfaces = AnalyseInterfaces::explode($match[1]);
                foreach ($interfaces as $interface){
                    $i = explode("/", $interface);
                    $this->getConfig()->getInterfaces()->getEthernet((int)$i[0], (int)1, (int)$i[1])->setPvid($match[2]);
                }
                $this->addConfigReport($key);
            } elseif(preg_match("#^vlan ports ([0-9\/\-\,]+) tagging (unTagPvidOnly|tagAll|untagAll|tagPvidOnly)#", $line, $match)){
                $interfaces = AnalyseInterfaces::explode($match[1]);
                foreach ($interfaces as $interface){
                    $i = explode("/", $interface);
                    $this->getConfig()->getInterfaces()->getEthernet((int)$i[0], (int)1, (int)$i[1])->setTagging($match[2]);
                }
                $this->addConfigReport($key);
            } elseif(preg_match("#^vlan members ([0-9]+) ([0-9\/\-\,]+)#", $line, $match)){
                $interfaces = AnalyseInterfaces::explode($match[2]);
                foreach ($interfaces as $interface){
                    $i = explode("/", $interface);
                    $this->getConfig()->getInterfaces()->getEthernet((int)$i[0], (int)1, (int)$i[1])->addVlan($match[1]);
                }
                $this->addConfigReport($key);
            }
        }

        public function generateConfig(){
            //@TODO
        }

    }