<?php

require('Framework/conformityCheck.php');
exec('php -S ' . APP_URL . ':' . APP_PORT . ' -t Public/');