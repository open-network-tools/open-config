<?php
    namespace OpenNetworkTools\OpenConfig;

    class Snmp {

        private $location;
        private $contact;

        public function getLocation() {
            return $this->location;
        }

        public function setLocation($location) {
            $this->location = $location;
            return $this;
        }

        public function getContact() {
            return $this->contact;
        }

        public function setContact($contact) {
            $this->contact = $contact;
            return $this;
        }

    }