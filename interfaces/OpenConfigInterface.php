<?php
    namespace OpenNetworkTools\Interfaces;

    interface OpenConfigInterface {

        public function __construct();

        public function getSystem();

        public function addVlans($vlan);
        public function getVlans($vlan = null);
        public function removeVlans($vlan);
        public function setVlans($vlan);

    }