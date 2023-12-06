<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces;

    use OpenNetworkTools\OpenConfig\Interfaces\Family\EthernetSwitching;
    use OpenNetworkTools\OpenConfig\Interfaces\Family\Inet;

    class InterfaceUnit {

        private $family = [];

        public function getArray(){
            $data = [];

            foreach ($this->family as $type => $d){
                $data['family'][$type] = $d->getArray();
            }

            return $data;
        }

        /**
         * @return Family\Inet | Family\EthernetSwitching
         */
        public function addFamily($family){
            if($family == "inet") $this->family['inet'] = new Inet();
            elseif($family == "ethernet") $this->family['ethernet'] = new EthernetSwitching();
            else throw new \Exception("Family not exist");

            return $this->family[$family];
        }

        /**
         * @return Family\Inet | Family\EthernetSwitching
         */
        public function getFamily($family = null){
            if(!array_key_exists($family, $this->family)) $this->addFamily($family);

            return $this->family[$family];
        }

    }