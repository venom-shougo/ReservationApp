<?php

require_once(__DIR__ . '/../app/config.php');
use Reservation\Reserve\Reserve;

//* 予約確定ボタンが押された場合の処理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //* セッションに入力情報がある場合は取得する
    if (isset($_SESSION['reserve'])) {
        $reserveData = $_SESSION['reserve'];
        //TODO:予約が確定可能かどうか最終チェック
        //* reserve テーブルに INSERT
        $reserve = new Reserve();
        if ($reserve->registerReservation($reserveData)) {
            //* 予約が正常に完了したらセッションデータをクリア
            unset($_SESSION['reserve']);
            //* DB から切断
            unset($reserve->$pdo);
            //* 予約完了画面表示
            header('Location: /complete.php');
            exit;
        } else {
            echo '登録失敗';
        }
    } else {
        //* セッションからデータを取得できない場合はエラー
        //TODO:エラー処理
    }
}

include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">予約確認画面</h1>

<form method="post">
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
        <button class="btn btn-primary rounded-pill mb-1" type="submit">予約確定</button>
        <a class="btn btn-secondary rounded-pill" href="/">戻る</a>
    </div>
</form>

<?php
    include('_footer.php');
