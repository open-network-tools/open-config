<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces\Family;

    class Inet {

        private $address = [];

        public function __construct(){
        }

        public function getArray(){
            $data = [];

            foreach ($this->address as $address) $data['address'][] = $address;

            return $data;
        }

        public function addAddress($address){
            $this->address[] = $address;
            return $this;
        }

        public function removeAddress($address){
            foreach ($this->address as $k => $v){
                if($v == $address) unset($this->address[$k]);
            }
            return $this;
        }

    }