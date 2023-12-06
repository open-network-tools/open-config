<?php
    namespace OpenNetworkTools\OpenConfig;

    use OpenNetworkTools\OpenConfig\Interfaces\Aggregate;
    use OpenNetworkTools\OpenConfig\Interfaces\Ethernet;
    use OpenNetworkTools\OpenConfig\Interfaces\Loopback;
    use OpenNetworkTools\OpenConfig\Interfaces\Routing;

    class Interfaces {

        private $aggregate = [];
        private $ethernet = [];
        private $loopback = [];
        private $routing;

        public function __construct(){
            $this->routing = new Routing();
        }

        public function getArray(){
            $data = [];

            foreach ($this->aggregate as $id => $d){
                $data['aggregate']["ae".$id] = $d->getArray();
            }

            foreach ($this->ethernet as $fpc => $x){
                foreach ($x as $pic => $y){
                    foreach ($y as $port => $d) {
                        $data['ethernet'][$fpc."/".$pic."/".$port] = $d->getArray();
                    }
                }
            }

            foreach ($this->loopback as $id => $d){
                $data['loopback']["lo".$id] = $d->getArray();
            }

            if(sizeof($this->routing->getArray()) > 0) $data['routing'] = $this->routing->getArray();

            return $data;
        }

        public function setArray(){}

        /**
         * @return Aggregate
         */
        public function addAggregate($id){
            $this->aggregate[$id] = new Aggregate();
            return $this->aggregate[$id];
        }

        /**
         * @return Ethernet
         */
        public function addEthernet($fpc, $pic, $port){
            $this->ethernet[$fpc][$pic][$port] = new Ethernet();
            ksort($this->ethernet[$fpc]);
            ksort($this->ethernet[$fpc][$pic]);
            return $this->ethernet[$fpc][$pic][$port];
        }

        /**
         * @return Loopback
         */
        public function addLoopback($id){
            $this->loopback[$id] = new Loopback();
            return $this->loopback[$id];
        }

        /**
         * @return Aggregate
         */
        public function getAggregate($id = null){
            if(is_numeric($id)){
                if(!array_key_exists($id, $this->aggregate)) $this->addAggregate($id);

                return $this->aggregate[$id];
            } else return $this->aggregate;
        }

        /**
         * @return Ethernet
         */
        public function getEthernet($fpc = null, $pic = null, $port = null){
            if(is_numeric($fpc) && is_numeric($pic) && is_numeric($port)){
                if(!array_key_exists($fpc, $this->ethernet)) $this->addEthernet($fpc, $pic, $port);
                if(!array_key_exists($pic, $this->ethernet[$fpc])) $this->addEthernet($fpc, $pic, $port);
                if(!array_key_exists($port, $this->ethernet[$fpc][$pic])) $this->addEthernet($fpc, $pic, $port);

                return $this->ethernet[$fpc][$pic][$port];
            } else return $this->ethernet;
        }

        /**
         * @return Loopback
         */
        public function getLoopback($id = null){
            if(is_numeric($id)){
                if(!array_key_exists($id, $this->loopback)) $this->addLoopback($id);

                return $this->loopback[$id];
            } else return $this->loopback;
        }

        public function getRouting(): Routing {
            return $this->routing;
        }

    }