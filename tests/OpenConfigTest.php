<?php
    class OpenConfigTest extends \PHPUnit\Framework\TestCase {

        public function testOpenConfig_instanceOf(){
            $oc = new \OpenNetworkTools\OpenConfig();
            $this->assertInstanceOf(\OpenNetworkTools\OpenConfig::class, $oc);
        }

    }