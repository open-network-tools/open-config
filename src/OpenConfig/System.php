<?php
    namespace OpenNetworkTools\OpenConfig;

    class System {

        private $domainName;
        private $hostname;
        private $nameserver = [];

        public function __construct(){
        }

        public function getArray(){
            $data = [];
            if(!is_null($this->getDomainName())) $data['domainname'] = $this->getDomainName();
            if(!is_null($this->getHostname())) $data['hostname'] = $this->getHostname();
            if(!is_null($this->getNameServer())) $data['nameserver'] = $this->getNameServer();
            return $data;
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

        public function getNameServer(){
            return $this->nameserver;
        }

        public function addNameServer($nameserver){
            $this->nameserver[] = $nameserver;
            return $this;
        }

        public function removeNameServer($nameserver){
            return $this;
        }

    }