<?php

session_start();
require_once(__DIR__ . '/env.php');
require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Reservation.php');
require_once(__DIR__ . '/Utils.php');
require_once(__DIR__ . '/ShopLogic.php');
require_once(__DIR__ . '/Token.php');
require_once(__DIR__ . '/Validation.php');
require_once(__DIR__ . '/functions.php');

const SAME_ID_COUNT = 1;
const ERROR_COUNT = 0;
const WEEK = [
    '日', '月', '火', '水', '木', '金', '土',
];

//* メール送信時文字化け対策
mb_language('japanese');
mb_internal_encoding('UTF-8');
define('ADMIN_EMAIL','beat.0729.pp1@gmail.com');
