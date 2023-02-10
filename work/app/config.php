<?php

session_start();

require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Utils.php');
require_once(__DIR__ . '/UserLogic.php');
require_once(__DIR__ . '/Token.php');
require_once(__DIR__ . '/Validation.php');
require_once(__DIR__ . '/functions.php');

const ERROR_COUNT = 0;
const WEEK = [
    '日', '月', '火', '水', '木', '金', '土',
];
