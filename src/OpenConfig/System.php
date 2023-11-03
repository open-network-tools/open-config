<?php
    namespace OpenNetworkTools\OpenConfig;

    class System {

        private $domainName;
        private $hostname;

        public function __construct(){
        }

        public function getDomainName(){
            return $this->domainName;
        }

        public function setDomainName($domainName){
            $this->domainName = $domainName;
        }

        public function getHostname(){
            return $this->hostname;
        }

        public function setHostname($hostname){
            $this->hostname = $hostname;
        }

    }