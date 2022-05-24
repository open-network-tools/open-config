<?php
    namespace OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS;

    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\Toolbox\AnalyseInterfaces;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\Toolbox\AnalyseVlans;

    class ERS4500 extends ERS {

        static $model = [
            "ERS4526FX"         => [['slot' => 1, 'port' => 26, 'first_port' => 1]],
            "ERS4526T"          => [['slot' => 1, 'port' => 26, 'first_port' => 1]],
            "ERS4526T-PWR"      => [['slot' => 1, 'port' => 26, 'first_port' => 1]],
            "ERS4550T"          => [['slot' => 1, 'port' => 50, 'first_port' => 1]],
            "ERS4550T-PWR"      => [['slot' => 1, 'port' => 50, 'first_port' => 1]],
            "ERS4524GT"         => [['slot' => 1, 'port' => 24, 'first_port' => 1]],
            "ERS4524GT-PWR"     => [['slot' => 1, 'port' => 24, 'first_port' => 1]],
            "ERS4548GT"         => [['slot' => 1, 'port' => 48, 'first_port' => 1]],
            "ERS4548GT-PWR"     => [['slot' => 1, 'port' => 48, 'first_port' => 1]],
            "ERS4526GTX"        => [['slot' => 1, 'port' => 26, 'first_port' => 1]],
            "ERS4526GTX-PWR"    => [['slot' => 1, 'port' => 26, 'first_port' => 1]]
        ];

        public function __construct($model = "ERS4548GT") {
            parent::__construct();
            $this->getConfig()->addVlans(1);
            $this->addUnit(1, $model);
        }

        public function addUnit($unit, $model){
            foreach ($this::$model[$model] as $m => $c){
                for ($i = $c['first_port']; $i <= $c['port']; $i++) {
                    $this->getConfig()->getInterfaces()->addEthernet($unit,$c['slot'],$i);
                }
            }
        }

        public function analyseConfigFile(){
            foreach ($this->getConfigFile() as $k => $v){
                $this->analyseInterface($k, $v);
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
                    $this->getConfig()->getInterfaces()->getEthernet($i[0], 1, $i[1])->setPvid($match[2]);
                }
                $this->addConfigReport($key);
            }
        }

    }