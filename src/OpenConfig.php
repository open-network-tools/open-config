<?php
    namespace OpenNetworkTools;

    use OpenNetworkTools\OpenConfig\System;

    class OpenConfig {

        private $interfaces;
        private $system;

        public function __construct(){
            $this->system = new System();
        }

        public function getInterfaces(){
            return $this->interfaces;
        }

        public function getSystem(){
            return $this->system;
        }

    }