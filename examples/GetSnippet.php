#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\ApiClient;

$snippet = ApiClient::getSnippet('myAccountID');

var_dump($snippet);

exit(1);
