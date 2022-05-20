<?php
    namespace OpenNetworkTools\Interfaces\OpenConfig\System;

    interface NtpInterface {

        public function __construct();

        public function addServer($server);
        public function getServer($server = null);
        public function removeServer($server);
        public function setServer($server);

    }