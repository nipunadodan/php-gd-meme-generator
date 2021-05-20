<?php

require_once 'config.php';

if(isset($_GET['process']) && $_GET['process'] !== ''){
    if (file_exists(PROCESSES_PATH . $_GET['process'] . '.php')) {
        include_once(PROCESSES_PATH . $_GET['process'] . '.php');
    } else {
        echo '404: File ' . $_GET['process'] . ' not found';
    }
}else{
    echo '404: Process not Found';
}

