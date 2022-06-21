<?php
    namespace OpenNetworkTools;

    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS\ERS4500;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS\ERS4800;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\ERS\ERS4900;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS\XOS5320;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS\XOS5420;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS\XOS5520;
    use OpenNetworkTools\OpenManufacturer\ExtremeNetworks\XOS\XOS5720;

    class OpenManufacturer {

        private $config;
        private $configExport;
        private $configFile;
        private $configReport = [];

        static $sourceModel = [
            'ERS 45xx'  => 'extremenetworks-ers-45xx',
            'ERS 48xx'  => 'extremenetworks-ers-48xx',
            'ERS 49xx'  => 'extremenetworks-ers-49xx',
            'XOS 5320'  => 'extremenetworks-xos-5320',
            'XOS 5420'  => 'extremenetworks-xos-5420',
            'XOS 5520'  => 'extremenetworks-xos-5520',
            'XOS 5720'  => 'extremenetworks-xos-5720',
        ];
        static $destinationModel = [
            'ERS 45xx'  => 'extremenetworks-ers-45xx',
            'ERS 48xx'  => 'extremenetworks-ers-48xx',
            'ERS 49xx'  => 'extremenetworks-ers-49xx',
            'XOS 5320'  => 'extremenetworks-xos-5320',
            'XOS 5420'  => 'extremenetworks-xos-5420',
            'XOS 5520'  => 'extremenetworks-xos-5520',
            'XOS 5720'  => 'extremenetworks-xos-5720',
        ];

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

        static function modelInit($model){
            if($model == "extremenetworks-ers-45xx") return new ERS4500();
            elseif($model == "extremenetworks-ers-48xx") return new ERS4800();
            elseif($model == "extremenetworks-ers-49xx") return new ERS4900();
            elseif($model == "extremenetworks-ers-49xx") return new ERS4900();
            elseif($model == "extremenetworks-xos-5320") return new XOS5320();
            elseif($model == "extremenetworks-xos-5420") return new XOS5420();
            elseif($model == "extremenetworks-xos-5520") return new XOS5520();
            elseif($model == "extremenetworks-xos-5720") return new XOS5720();
            else throw new \Exception("Model unknown");
        }

        static function modelManufacturer($value = ""){
            if(str_contains($value, "extremenetworks") && str_contains($value, "ers")) return "Extreme Networks - ERS";
            if(str_contains($value, "extremenetworks") && str_contains($value, "voss")) return "Extreme Networks - VOSS";
            if(str_contains($value, "extremenetworks") && str_contains($value, "xos")) return "Extreme Networks - XOS";
            if(str_contains($value, "extremenetworks")) return "Extreme Networks";
            if(str_contains($value, "juniper")) return "Juniper";
            return "Unknown";
        }

    }