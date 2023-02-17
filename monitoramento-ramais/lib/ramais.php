<?php
header('Content-Type: application/json');

class RamaisStatus {
    private $statusRamais;
    private $infoRamais;
    
    function __construct($ramaisFile, $filasFile) {
        $this->statusRamais = array();
        $this->infoRamais = array();
        
        $ramais = file($ramaisFile);
        $filas = file($filasFile);
        
        foreach ($filas as $linhas) {
            if (strstr($linhas, 'SIP/')) {
                if (strstr($linhas, '(Ring)')) {
                    $linha = explode(' ', trim($linhas));
                    list($tech, $ramal) = explode('/', $linha[0]);
                    $this->statusRamais[$ramal] = array('status' => 'chamando');
                }
                if (strstr($linhas, '(In use)')) {
                    $linha = explode(' ', trim($linhas));
                    list($tech, $ramal) = explode('/', $linha[0]);
                    $this->statusRamais[$ramal] = array('status' => 'ocupado');    
                }
                if (strstr($linhas, '(Not in use)')) {
                    $linha = explode(' ', trim($linhas));
                    list($tech, $ramal)  = explode('/', $linha[0]);
                    $this->statusRamais[$ramal] = array('status' => 'disponivel');    
                }
                if (strstr($linhas, '(Unavailable)')) {
                    $linha = explode(' ', trim($linhas));
                    list($tech, $ramal)  = explode('/', $linha[0]);
                    $this->statusRamais[$ramal] = array('status' => 'indisponivel');    
                }
                if (strstr($linhas, '(paused)')) {
                    $linha = explode(' ', trim($linhas));
                    list($tech, $ramal)  = explode('/', $linha[0]);
                    $this->statusRamais[$ramal] = array('status' => 'pausado');    
                }    
            }
        }
        
        foreach ($ramais as $linhas) {
            $linha = array_filter(explode(' ', $linhas));
            $arr = array_values($linha);
            
            if (trim($arr[1]) == '(Unspecified)' && trim($arr[4]) == 'UNKNOWN') {        
                list($name, $username) = explode('/', $arr[0]);        
                $this->infoRamais[$name] = array(
                    'nome' => $name,
                    'ramal' => $username,
                    'online' => false,
                    'status' => $this->statusRamais[$name]['status']
                );
            }
            if (count($arr) > 5 && trim($arr[5]) == "OK") {        
                list($name, $username) = explode('/', $arr[0]);
                $this->infoRamais[$name] = array(
                    'nome' => $name,
                    'ramal' => $username,
                    'online' => true,
                    'status' => $this->statusRamais[$name]['status']
                );
            }
        }
    }
    
    function getInfoRamais() {
        $ramais = $this->infoRamais;
        foreach ($ramais as &$info) {
            if ($info['ramal'] === '7000') {
                $info['nome'] = 'Chaves';
            }
            if ($info['ramal'] === '7001') {
                $info['nome'] = 'Kiko';
            }
            if ($info['ramal'] === '7002') {
                $info['nome'] = 'Chiquinha';
            }
            if ($info['ramal'] === '7003') {
                $info['nome'] = 'Nhonho';
            }
            if ($info['ramal'] === '7004') {
                $info['nome'] = 'Godines';
            }
        }
        return $ramais;
    }

    function setInfoRamais($info) {
        $this->infoRamais = $info;
    }
    function getStatusRamais() {
        return $this->statusRamais;
    }

    function setStatusRamais($status) {
        $this->statusRamais = $status;
    }
}

$ramaisStatus = new RamaisStatus('ramais', 'filas');
$info_ramais = $ramaisStatus->getInfoRamais();


echo json_encode($info_ramais);