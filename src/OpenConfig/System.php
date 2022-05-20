<?php
    namespace OpenNetworkTools\OpenConfig;

    use OpenNetworkTools\Interfaces\OpenConfig\SystemInterface;
    use OpenNetworkTools\OpenConfig\System\Ntp;
    use OpenNetworkTools\Toolbox\Validator;
    use Symfony\Component\Validator\Constraints as Asset;

    class System implements SystemInterface {

        private $domainName;
        private $hostName;
        private $nameServer = [];
        private $ntp;
        private $timeZone;
        private $vlanConfig;

        public function __construct() {
            $this->ntp = new Ntp();
        }

        public function getDomainName() {
            return $this->domainName;
        }

        public function setDomainName($domainName) {
            Validator::validate($domainName, [
                new Asset\NotBlank(),
                new Asset\Regex(['pattern' => '/[a-z0-9\-\.]+/'])
            ]);

            $this->domainName = $domainName;
            return $this;
        }

        public function getHostName() {
            return $this->hostName;
        }

        public function setHostName($hostName) {
            Validator::validate($hostName, [
                new Asset\NotBlank(),
                new Asset\Length([
                    'min'   => 1,
                    'max'   => 255
                ])
            ]);

            $this->hostName = $hostName;
            return $this;
        }

        public function addNameServer($nameServer) {
            Validator::validate($nameServer, [
                new Asset\Ip()
            ]);

            $this->nameServer[] = $nameServer;
            return $this;
        }

        public function getNameServer() {
            return $this->nameServer;
        }

        public function removeNameServer($nameServer) {
            Validator::validate($nameServer, [
                new Asset\Ip()
            ]);

            foreach ($this->nameServer as $k => $d){
                if($d == $nameServer) unset($this->nameServer[$k]);
            }

            return $this;
        }

        public function setNameServer($nameServer) {
            Validator::validate($nameServer, [
                new Asset\Type('array')
            ]);

            foreach ($nameServer as $d){
                Validator::validate($d, [
                    new Asset\Ip()
                ]);
            }

            $this->nameServer = $nameServer;
            return $this;
        }

        public function getNtp() {
            return $this->ntp;
        }

        public function getTimeZone() {
            return $this->timeZone;
        }

        public function setTimeZone($timeZone) {
            Validator::validate($timeZone, [
                new Asset\NotBlank(),
                new Asset\Choice(Validator::$timeZone)
            ]);

            $this->timeZone = $timeZone;
            return $this;
        }

        public function getVlanConfig() {
            return $this->vlanConfig;
        }

        public function setVlanConfig($vlanConfig) {
            Validator::validate($vlanConfig, [
                new Asset\Choice(Validator::$vlanConfig)
            ]);

            $this->vlanConfig = $vlanConfig;
            return $this;
        }

    }