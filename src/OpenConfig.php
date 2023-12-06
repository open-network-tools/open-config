<?php
    namespace OpenNetworkTools;

    use OpenNetworkTools\OpenConfig\Interfaces;
    use OpenNetworkTools\OpenConfig\System;
    use OpenNetworkTools\OpenConfig\Vlans;
    use Symfony\Component\Yaml\Yaml;

    class OpenConfig {

        private $interfaces;
        private $system;
        private $vlans = [];

        public function __construct(){
            $this->interfaces = new Interfaces();
            $this->system = new System();
        }

        /**
         * Export & Import Function
         */
        public function exportYaml(){
            $data = [];
            if(sizeof($this->getInterfaces()->getArray()) > 0) $data['interfaces'] = $this->getInterfaces()->getArray();
            if(sizeof($this->getSystem()->getArray()) > 0) $data['system'] = $this->getSystem()->getArray();

            foreach ($this->vlans as $vlan => $d){
                $data['vlans'][$vlan] = $d->getArray();
            }

            return Yaml::dump($data,10, 2);
        }

        public function importYaml(array $data){
            if(array_key_exists('system', $data)) $this->getSystem()->setArray($data['system']);
        }

        /**
         * Class Function
         */
        public function getInterfaces(){
            return $this->interfaces;
        }

        public function getSystem(){
            return $this->system;
        }

        /**
         * @return Vlans
         */
        public function addVlans($vlan){
            $this->vlans[$vlan] = new Vlans();
            return $this->vlans[$vlan];
        }

        /**
         * @return Vlans
         */
        public function getVlans($vlan = null){
            if(!is_null($vlan)){
                if(!array_key_exists($vlan, $this->vlans)) $this->addVlans($vlan);
                return $this->vlans[$vlan];
            } else return $this->vlans;

        }

    }