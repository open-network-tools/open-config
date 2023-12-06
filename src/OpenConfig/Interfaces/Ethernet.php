<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces;

    use OpenNetworkTools\OpenConfig\Interfaces\InterfaceUnit as Unit;

    class Ethernet {

        private $aggregate;
        private $description;
        private $disable = false;
        private $speed;
        private $unit = [];

        public function __construct(){
        }

        public function getArray(){
            $data = [];
            if(!is_null($this->getAggregate())) $data['aggregate'] = "ae".$this->getAggregate();
            if(!is_null($this->getDescription())) $data['description'] = $this->getDescription();
            if($this->isDisable()) $data['disable'] = true;
            if(!is_null($this->getSpeed())) $data['speed'] = $this->getSpeed();

            foreach ($this->unit as $id => $d){
                $data["unit"]["unit.".$id] = $d->getArray();
            }

            return $data;
        }

        public function getAggregate(){
            return $this->aggregate;
        }

        public function setAggregate($aggregate): self {
            $this->aggregate = $aggregate;
            return $this;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description): self {
            $this->description = $description;
            return $this;
        }

        public function isDisable(): bool {
            return $this->disable;
        }

        public function setDisable(bool $disable): self {
            $this->disable = $disable;
            return $this;
        }

        public function getSpeed(){
            return $this->speed;
        }

        public function setSpeed($speed): self {
            $this->speed = $speed;
            return $this;
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