<?php
    namespace OpenNetworkTools\OpenConfig;

    use OpenNetworkTools\Toolbox\Validator;
    use Symfony\Component\Validator\Constraints as Asset;

    class Vlans {

        private $description;
        private $id;
        private $isid;
        private $name;
        private $type;
        private $typeInstance;

        public function __construct($vlanId, $type = "port", $typeInstance = 0) {
            Validator::validate($vlanId, [
                new Asset\Type('integer')
            ]);
            Validator::validate($type, [
                new Asset\Choice(Validator::$vlanType)
            ]);
            Validator::validate($typeInstance, [
                new Asset\Type('integer')
            ]);

            $this->id = $vlanId;
            $this->name = "VLAN-".$vlanId;
            $this->type = $type;
            $this->typeInstance = $typeInstance;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
            return $this;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            Validator::validate($id, [
                new Asset\Type('integer')
            ]);

            $this->id = $id;
            return $this;
        }

        public function getIsid() {
            return $this->isid;
        }

        public function setIsid($isid) {
            Validator::validate($isid, [
                new Asset\Type('integer')
            ]);

            $this->isid = $isid;
            return $this;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            Validator::validate($name, [
                new Asset\NotBlank(),
                new Asset\Type('string')
            ]);
            $this->name = $name;
            return $this;
        }

        public function getType() {
            return $this->type;
        }

        public function setType($type) {
            Validator::validate($type, [
                new Asset\Choice(Validator::$vlanType)
            ]);

            $this->type = $type;
            return $this;
        }

        public function getTypeInstance() {
            return $this->typeInstance;
        }

        public function setTypeInstance($typeInstance) {
            Validator::validate($typeInstance, [
                new Asset\Type('integer')
            ]);

            $this->typeInstance = $typeInstance;
            return $this;
        }

    }