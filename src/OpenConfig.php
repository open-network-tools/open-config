<?php
    namespace OpenNetworkTools;

    use OpenNetworkTools\OpenConfig\System;
    use Symfony\Component\Yaml\Yaml;

    class OpenConfig {

        private $interfaces;
        private $system;

        public function __construct(){
            $this->system = new System();
        }

        public function exportYaml(){
            $data = [];
            $data['system'] = $this->getSystem()->getArray();
            return Yaml::dump($data);
        }

        public function importYaml(array $data){
            if(array_key_exists('system', $data)) $this->getSystem()->setArray($data['system']);
        }

        public function getInterfaces(){
            return $this->interfaces;
        }

        public function getSystem(){
            return $this->system;
        }

    }