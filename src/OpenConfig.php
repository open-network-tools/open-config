<?php
    namespace OpenNetworkTools;

    use OpenNetworkTools\Interfaces\OpenConfigInterface;
    use OpenNetworkTools\OpenConfig\Interfaces;
    use OpenNetworkTools\OpenConfig\Snmp;
    use OpenNetworkTools\OpenConfig\System;
    use OpenNetworkTools\OpenConfig\Vlans;
    use OpenNetworkTools\Toolbox\Validator;
    use Symfony\Component\Validator\Constraints as Asset;

    class OpenConfig implements OpenConfigInterface {

        private $interfaces;
        private $snmp;
        private $system;
        private $vlans;

        public function __construct() {
            $this->interfaces = new Interfaces();
            $this->snmp = new Snmp();
            $this->system = new System();
        }

        public function getInterfaces(){
            return $this->interfaces;
        }

        public function getSnmp(){
            return $this->snmp;
        }

        public function setSnmp(Snmp $snmp){
            $this->snmp = $snmp;
            return $this;
        }

        public function getSystem() {
            return $this->system;
        }

        public function setSystem(System $system){
            $this->system = $system;
            return $this;
        }

        public function addVlans($vlan) {
            Validator::validate($vlan, [
                new Asset\Type('integer')
            ]);

            $this->vlans[$vlan] = new Vlans($vlan);
        }

        public function getVlans($vlan = null) {
            if(is_numeric($vlan)) return $this->vlans[$vlan];
            else return $this->vlans;
        }

        public function removeVlans($vlan) {
            // TODO: Implement removeVlans() method.
        }

        public function setVlans($vlans) {
            $this->vlans = $vlans;
            return $this;
        }
    }