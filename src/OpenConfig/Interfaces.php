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
         * @param $unit
         * @param $slot
         * @param $port
         * @return Ethernet
         */
        public function addEthernet($unit, $slot, $port){
            Validator::validate($unit, [
                new Asset\Type('integer')
            ]);
            Validator::validate($slot, [
                new Asset\Type('integer')
            ]);
            Validator::validate($port, [
                new Asset\Type('integer')
            ]);

            $this->ethernet[$unit][$slot][$port] = new Ethernet($this);
            return $this->ethernet[$unit][$slot][$port];
        }

        /**
         * @param null $unit
         * @param null $slot
         * @param null $port
         * @return Ethernet
         */
        public function getEthernet($unit = null, $slot = null, $port = null){
            if(is_numeric($unit) && is_numeric($slot) && is_numeric($port)) return $this->ethernet[$unit][$slot][$port];
            elseif(is_numeric($unit) && is_numeric($slot)) return $this->ethernet[$unit][$slot];
            elseif(is_numeric($unit)) return $this->ethernet[$unit];
            else return $this->ethernet;
        }

    }