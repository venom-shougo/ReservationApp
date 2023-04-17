<?php
require_once(__DIR__ . '/../../app/config.php');
use Reservation\Reserve\Reserve;
$reserve = new Reserve();
// var_dump($_SESSION['shop_user']);
//* 年、月プルダウンの構築
$isInvalid = '';
$year_array = [];
$current_year = date('Y');
for ($i = ($current_year - 1); $i <= ($current_year + 3); $i++) {
    $year_array[$i] = $i. '年';
}

$month_array = [];
for ($i = 1; $i <= 12; $i++) {
    $month_array[sprintf('%02d', $i)] = $i. '月';
}

$year = @$_GET['year'];
$month = @$_GET['month'];
if (!$year) {
    $year = date('Y');
}
if (!$month) {
    $month = date('m');
}

include('../_header.php');
?>
<header class="navbar bg-dark  p-3">
    <div class="container-fluid">
        <div class="navbar-brand text-white">SAMPEL SHOP</div>
        <form class="d-flex" role="search">
            <a href="admin_reserve_list.php"><i class="bi bi-list-task nav-icon mx-3"></i></a>
            <a href="admin_setting.php"><i class="bi bi-gear nav-icon"></i></a>
        </form>
        </div>
    </header>

<h1 class="h2 text-center p-3">予約リスト</h1>
<form id="filter-form" method="get">
    <div class="row g-3 m-3">
        <div class="col">
            <?= SelectYearMonthArray('year', $year_array, $year); ?>
        </div>
        <div class="col">
            <?= SelectYearMonthArray('month', $month_array, $month); ?>
        </div>
    </div>
</form>

<div class="container p-0">
    <?php if (!$reserve->getReservationInformation($year, $month)) : ?>
        <div class="alert alert-warning" role="alert">予約データがありません。</div>
    <?php else : ?>
        <table class="table bg-white mt-5">
            <tbody>
                <?php foreach ($reserve->getReservationInformation($year, $month) as $reserveList) : ?>
                <tr>
                    <th scope="row"><?= formatDate($reserveList['reserve_date']); ?>　<?= formatTime($reserveList['reserve_time']); ?></th>
                    <td><?= $reserveList['name']; ?>　<?= $reserveList['reserve_num']; ?>名<br>
                        <?= $reserveList['email']; ?><br>
                        <?= $reserveList['tel']; ?><br>
                        <?= mb_strimwidth($reserveList['comment'], 0, 90, '...'); ?><br>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    $('.form-select').change(function() {
        $('#filter-form').submit()
    })
</script>
<?php
    include('../_footer.php');
