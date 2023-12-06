<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces\Family;

    class EthernetSwitching {

        private $interfaceMode;
        private $vlans = [];

        public function __construct(){
        }

        public function getArray(){
            $data = [];

            if(!is_null($this->getInterfaceMode())) $data['interfacemode'] = $this->getInterfaceMode();

            foreach ($this->vlans as $vlan) {
                $data["vlans"][] = $vlan;
            }

            return $data;
        }

        public function getInterfaceMode(){
            return $this->interfaceMode;
        }

        public function setInterfaceMode($interfaceMode): self {
            $this->interfaceMode = $interfaceMode;
            return $this;
        }

        public function addVlans($vlan){
            $this->vlans[$vlan] = $vlan;
            return $this;
        }

        public function getVlans(){
            return $this->vlans;
        }

    }