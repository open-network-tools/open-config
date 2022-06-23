<?php
    namespace OpenNetworkTools;

    use OpenNetworkTools\OpenConfig\Interfaces\Ethernet;

    class OpenTranslate {

        private $destinationConfig;
        private $mode;
        private $sourceConfig;
        private $translate;

        public function __construct(OpenConfig $sourceConfig, $mode = "dynamic"){
            if($mode == "strict") $this->destinationConfig = new OpenConfig();
            elseif($mode == "dynamic") $this->destinationConfig = $sourceConfig;
            else $this->destinationConfig = new OpenConfig();
            $this->mode = $mode;
            $this->sourceConfig = $sourceConfig;
        }

        public function getDestinationConfig(): OpenConfig {
            if($this->mode == "strict"){
                $this->destinationConfig->setSnmp($this->sourceConfig->getSnmp());
                $this->destinationConfig->setSystem($this->sourceConfig->getSystem());
                $this->destinationConfig->setVlans($this->sourceConfig->getVlans());
            }

            if(is_array($this->translate)){
                if(array_key_exists('interfaces', $this->translate)){
                    if(array_key_exists('ethernet', $this->translate['interfaces'])){
                        foreach ($this->translate['interfaces']['ethernet'] as $d){
                            $this->destinationConfig->getInterfaces()->setEthernet(
                                (int)$d['destination']['unit'],
                                (int)$d['destination']['slot'],
                                (int)$d['destination']['port'],
                                $this->sourceConfig->getInterfaces()->getEthernet($d['source']['unit'], $d['source']['slot'], $d['source']['port']));
                        }
                    }
                }
            }

            return $this->destinationConfig;
        }

        public function getMode(): string {
            return $this->mode;
        }

        public function setMode(string $mode) {
            $this->mode = $mode;
            return $this;
        }

        public function setSourceConfig(OpenConfig $sourceConfig) {
            $this->sourceConfig = $sourceConfig;
            return $this;
        }

        public function addTranslateInterfaceEthernet($source, $destination){
            $source = explode("/", $source);
            $destination = explode("/", $destination);

            $this->translate['interfaces']['ethernet'][] = [
                'source'    => [
                    'unit'      => $source[0],
                    'slot'      => $source[1],
                    'port'      => $source[2],
                ],
                'destination'   => [
                    'unit'      => $destination[0],
                    'slot'      => $destination[1],
                    'port'      => $destination[2],
                ]
            ];

            return $this;
        }

    }