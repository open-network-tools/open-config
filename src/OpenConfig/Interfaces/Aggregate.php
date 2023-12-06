<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces;

    use OpenNetworkTools\OpenConfig\Interfaces\Aggregate\AggrEtherOptions;
    use OpenNetworkTools\OpenConfig\Interfaces\InterfaceUnit as Unit;

    class Aggregate {

        private $aggregateEtherOptions;
        private $description;
        private $unit = [];

        public function __construct(){
            $this->aggregateEtherOptions = new AggrEtherOptions();
        }

        public function getArray(){
            $data = [];
            if(sizeof($this->getAggregateEtherOptions()->getArray()) > 0) $data['aggregate-ether-options'] = $this->getAggregateEtherOptions()->getArray();
            if(!is_null($this->getDescription())) $data['description'] = $this->getDescription();

            foreach ($this->unit as $id => $d){
                $data["unit"]["unit.".$id] = $d->getArray();
            }

            return $data;
        }

        public function getAggregateEtherOptions(): AggrEtherOptions {
            return $this->aggregateEtherOptions;
        }

        public function setAggregateEtherOptions(AggrEtherOptions $aggregateEtherOptions): self {
            $this->aggregateEtherOptions = $aggregateEtherOptions;
            return $this;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description): self {
            $this->description = $description;
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