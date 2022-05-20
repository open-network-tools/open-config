<?php
    namespace OpenNetworkTools\OpenConfig\Interfaces;

    use OpenNetworkTools\Toolbox\Validator;
    use Symfony\Component\Validator\Constraints as Asset;

    class Ethernet {

        private $name;
        private $pvid;
        private $speed;
        private $tagging;
        private $type;
        private $vlans;

        public function __construct(){
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
            return $this;
        }

        public function getPvid() {
            return $this->pvid;
        }

        public function setPvid($pvid) {
            $this->pvid = $pvid;
            return $this;
        }

        public function getSpeed() {
            return $this->speed;
        }

        public function setSpeed($speed) {
            $this->speed = $speed;
            return $this;
        }

        public function getTagging() {
            return $this->tagging;
        }

        public function setTagging($tagging) {
            $this->tagging = $tagging;
            return $this;
        }

        public function getType() {
            return $this->type;
        }

        public function setType($type) {
            $this->type = $type;
            return $this;
        }


    }