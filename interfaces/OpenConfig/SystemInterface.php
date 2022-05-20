<?php
    namespace OpenNetworkTools\Interfaces\OpenConfig;

    interface SystemInterface {

        public function __construct();

        public function getDomainName();
        public function setDomainName($domainName);

        public function getHostName();
        public function setHostName($hostName);

        public function addNameServer($nameServer);
        public function getNameServer();
        public function removeNameServer($nameServer);
        public function setNameServer($nameServer);

        public function getNtp();

        public function getTimeZone();
        public function setTimeZone($timeZone);

    }