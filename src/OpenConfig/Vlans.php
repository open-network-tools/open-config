<?php
    namespace OpenNetworkTools\OpenConfig;

    class Vlans {

        private $vlanID;
        private $l3interface;

        public function __construct(){
        }

        public function getArray(){
            $data = [];
            if(!is_null($this->getVlanID())) $data['vlanid'] = $this->getVlanID();
            if(!is_null($this->getL3interface())) $data['l3interface'] = "irb.".$this->getL3interface();
            return $data;
        }

        public function getVlanID(){
            return $this->vlanID;
        }

        public function setVlanID($vlanID): self {
            $this->vlanID = $vlanID;
            return $this;
        }

        public function getL3interface(){
            return $this->l3interface;
        }

        public function setL3interface($l3interface): self {
            $this->l3interface = $l3interface;
            return $this;
        }

    }