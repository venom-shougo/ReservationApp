<?php

require_once(__DIR__ . '/../app/config.php');
use Reservation\Reserve\Reserve;

$reser = new Reserve();

//* 予約確定ボタンが押された場合の処理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //* セッションに入力情報がある場合は取得する
    if (isset($_SESSION['reserve'])) {
        $reserveData = $_SESSION['reserve'];
        $reserve_date = $reserveData['reserve_date'];
        $reserve_num = $reserveData['reserve_num'];
        $reserve_time = $reserveData['reserve_time'];

        //* 予約が確定可能かどうか最終チェック
        //* DBのreservationテーブルからその日時の「予約成立済み人数」を取得
        $shop = $reser->getShopData('1');
        $reserveCount = $reser->getReservationLimit($reserve_date, $reserve_time);
        if ($reserveCount && ($reserveCount + $reserve_num) > $shop['max_reserve_num']) {
            $error['common'] = "この日時はすでに予約が埋まっております。\n予約画面に戻って予約情報を変更して下さい。";
        } else {
            //* reserve テーブルに INSERT
            $reserve = new Reserve();
            $reserveResult = $reserve->registerReservation($reserveData);
        }
        //* 予約者に予約完了メール送信
        if (!empty($reserveResult)) {
            $email = $_SESSION['reserve']['email'];
            $form = 'Form: Web予約システムReserve <'.ADMIN_EMAIL.'>';
            $subject = 'ご予約が確定しました。';
            $viewReserveDate = formatDate($_SESSION['reserve']['reserve_date']);
            $body = <<<EOT
{$_SESSION['reserve']['name']}様

以下の内容でご予約を承りました。

ご予約内容
[日時]{$viewReserveDate}{$_SESSION['reserve']['reserve_time']}
[人数]{$_SESSION['reserve']['reserve_num']}人
[氏名]{$_SESSION['reserve']['name']}様
[メールアドレス]{$_SESSION['reserve']['email']}
[電話番号]{$_SESSION['reserve']['tel']}
[備考]{$_SESSION['reserve']['comment']}
EOT;
            //* 店舗管理者に予約完了メール送信
            $subject = '【Reserve】予約が確定しました。';
            $body = <<<EOT

以下の内容で予約が確定しました。

ご予約内容
[日時]{$viewReserveDate}{$_SESSION['reserve']['reserve_time']}
[人数]{$_SESSION['reserve']['reserve_num']}人
[氏名]{$_SESSION['reserve']['name']}様
[メールアドレス]{$_SESSION['reserve']['email']}
[電話番号]{$_SESSION['reserve']['tel']}
[備考]{$_SESSION['reserve']['comment']}
EOT;
            //TODO:メール送信はサーバー上で実施
            // mb_send_mail($email, $subject, $body, $form);
            // mb_send_mail(ADMIN_EMAIL, $subject, $body, $form);
            //* 予約が正常に完了したらセッションデータをクリア
            unset($_SESSION['reserve']);
            //* 予約完了画面表示
            header('Location: /complete.php');
            exit;
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
    <?php if (isset($error['common'])) : ?>
        <div class="alert alert-danger" role="alert"><?= nl2br(Utils::h($error['common'])); ?></div>
    <?php endif; ?>
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
