<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces;

    use OpenNetworkTools\OpenConfig\Interfaces\InterfaceUnit as Unit;

    class Loopback {

        private $unit;

        public function __construct(){
        }

        public function getArray(){
            $data = [];

            foreach ($this->unit as $id => $d){
                $data["unit"]["unit".$id] = $d->getArray();
            }

            return $data;
        }

        /**
         * @return Unit
         */
        public function addUnit($id){
            $this->unit[$id] = new Unit();
            return $this->unit[$id];
        }

        /**
         * @return Unit
         */
        public function getUnit($id = null){
            if(is_numeric($id)){
                if(!array_key_exists($id, $this->unit)) $this->addUnit($id);

                return $this->unit[$id];
            } else return $this->unit;
        }

    }