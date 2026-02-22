<?php
require_once 'rconcfg.php';
class Rcon {
    private $socket;
    private $requestId;

    public function __construct($host, $port, $password, $timeout = 3) {
        $this->socket = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$this->socket) {
            throw new Exception("Nie udało się połączyć z RCON: $errstr ($errno)");
        }
        $this->requestId = 0;
        if (!$this->auth($password)) {
            throw new Exception("Błędne hasło RCON.");
        }
    }

    public function sendCommand($command) {
        $this->writePacket(2, $command);
        return $this->readPacket();
    }

    private function auth($password) {
        $this->writePacket(3, $password);
        $packet = $this->readPacket();
        return $packet['type'] == 2 && $packet['id'] == $this->requestId;
    }

    private function writePacket($type, $payload) {
        $this->requestId++;
        $data = pack("VV", $this->requestId, $type) . $payload . "\x00\x00";
        $data = pack("V", strlen($data)) . $data;
        fwrite($this->socket, $data);
    }

    private function readPacket() {
        $sizeData = fread($this->socket, 4);
        if (strlen($sizeData) < 4) return null;
        $size = unpack("V", $sizeData)[1];
        $packetData = fread($this->socket, $size);
        return unpack("Vid/Vtype/a*body", $packetData);
    }

    public function disconnect() {
        if ($this->socket) fclose($this->socket);
    }
}
?>