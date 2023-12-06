<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces\Aggregate;

    class AggrEtherOptions {

        private $lacpType;
        private $lacpPeriodic;

        public function __construct(){
        }

        public function getArray(){
            $data = [];
            if(!is_null($this->getLacpType())) $data['lacp']['type'] = $this->getLacpType();
            if(!is_null($this->getLacpPeriodic())) $data['lacp']['periodic'] = $this->getLacpPeriodic();
            return $data;
        }

        public function getLacpType(){
            return $this->lacpType;
        }

        public function setLacpType($lacpType): self {
            $this->lacpType = $lacpType;
            return $this;
        }

        public function getLacpPeriodic(){
            return $this->lacpPeriodic;
        }

        public function setLacpPeriodic($lacpPeriodic): self {
            $this->lacpPeriodic = $lacpPeriodic;
            return $this;
        }

    }