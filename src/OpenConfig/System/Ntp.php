<?php
    namespace OpenNetworkTools\OpenConfig\System;

    use OpenNetworkTools\Interfaces\OpenConfig\System\NtpInterface;
    use OpenNetworkTools\OpenConfig\System\Ntp\Server;
    use OpenNetworkTools\Toolbox\Validator;
    use Symfony\Component\Validator\Constraints as Asset;

    class Ntp implements NtpInterface {

        private $server;

        public function __construct() {
        }

        public function addServer($server) {
            Validator::validate($server, [
                new Asset\Ip()
            ]);

            $this->server[$server] = new Server();
            return $this;
        }

        public function getServer($server = null) {
            // TODO: Implement getServer() method.
        }

        public function removeServer($server) {
            // TODO: Implement removeServer() method.
        }

        public function setServer($server) {
            // TODO: Implement setServer() method.
        }
    }