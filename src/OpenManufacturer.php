<?php
    namespace OpenNetworkTools;

    class OpenManufacturer {

        private $config;
        private $configExport;
        private $configFile;
        private $configReport = [];

        public function __construct(){
            $this->config = new OpenConfig();
        }

        public function getConfig(){
            return $this->config;
        }

        public function setConfig(OpenConfig $config){
            $this->config = $config;
        }

        public function getConfigExport(){
            return $this->configExport;
        }

        public function addConfigExportLine($line){
            $this->configExport[] = $line;
        }

        public function addConfigFileLine($line){
            $this->configFile[] = $line;
        }

        public function getConfigFile(){
            return $this->configFile;
        }

        public function loadConfigFile($filename, $ignoreComment = false, $ignoreSymbole = array("")){
            try {
                $fh = fopen($filename, "r");
                if(!$fh) throw new \Exception();
                while(!feof($fh)){
                    $line = fgets($fh, 2048);
                    if($ignoreComment == true && @in_array($line[0], $ignoreSymbole));
                    else $this->configFile[] = $line;
                }
            } catch (\Exception $e){
                throw new \Exception();
            }
        }

        public function addConfigReport($k){
            $this->configReport[$k] = true;
        }

        public function getConfigReport(){
            return $this->configReport;
        }

        public function printConfigReport(){
            foreach ($this->configFile as $k => $v){
                $check = "\e[31m✕";
                if(array_key_exists($k, $this->configReport)) $check = "\e[32m✓";
                echo " ".$check."\e[96m  | \e[39m".$v;
            }
        }

    }