<?php
    namespace OpenNetworkTools\OpenConfig;

    use OpenNetworkTools\OpenConfig\Interfaces\Ethernet;
    use OpenNetworkTools\Toolbox\Validator;
    use Symfony\Component\Validator\Constraints as Asset;

    class Interfaces {

        private $aggregate;
        private $ethernet;
        private $loopback;
        private $management;

        public function __construct() {
        }

        /**
         * @param $slot
         * @param $port
         * @return Ethernet
         */
        public function addEthernet($slot, $port){
            Validator::validate($slot, [
                new Asset\Type('integer')
            ]);
            Validator::validate($port, [
                new Asset\Type('integer')
            ]);

            $this->ethernet[$slot][$port] = new Ethernet($this);
            return $this->ethernet[$slot][$port];
        }

        public function getEthernet($slot = null, $port = null){
            if(is_numeric($slot) && is_numeric($port)) return $this->ethernet[$slot][$port];
            elseif(is_numeric($slot)) return $this->ethernet[$slot];
            else return $this->ethernet;
        }

    }