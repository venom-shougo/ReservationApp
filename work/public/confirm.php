<?php

require_once(__DIR__ . '/../app/config.php');

include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">予約確認画面</h1>
<div class="container">
    <table class="table bg-white">
        <tbody>
            <tr>
                <th scope="row">日時</th>
                <td><?= Utils::h(formatDate($_SESSION['reserve']['reserve_date'])); ?> <?= Utils::h($_SESSION['reserve']['reserve_time']); ?></td>
            </tr>
            <tr>
                <th scope="row">人数</th>
                <td><?= Utils::h($_SESSION['reserve']['reserve_num']); ?>人</td>
            </tr>
            <tr>
                <th scope="row">氏名</th>
                <td><?= Utils::h($_SESSION['reserve']['name']); ?></td>
            </tr>
            <tr>
                <th scope="row">メールアドレス</th>
                <td><?= Utils::h($_SESSION['reserve']['email']); ?></td>
            </tr>
            <tr>
                <th scope="row">電話番号</th>
                <td><?= Utils::h($_SESSION['reserve']['tel']); ?></td>
            </tr>
            <tr>
                <th scope="row">備考</th>
                <td colspan="2"><?= nl2br(Utils::h($_SESSION['reserve']['comment'])); ?></td>
                </tr>
        </tbody>
    </table>
    <div class="d-grid gap-2 mx-3">
        <a class="btn btn-primary rounded-pill mb-1" href="complete.php">予約確定</a>
        <a class="btn btn-secondary rounded-pill" href="/">戻る</a>
    </div>
</div>
<?php
    include('_footer.php');
