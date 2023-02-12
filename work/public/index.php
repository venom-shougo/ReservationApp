<?php
require_once(__DIR__ . '/../app/config.php');
use Reservation\Validation\Validation as Vali;
use Reservation\DB\Database;

$shop = Database::getShopData('1');
//* 予約日選択肢配列
$reserveDateArray = [];
for ($i = 0; $i <= $shop['reservable_date']; $i++) {
    //* 対象日を取得
    $targetDate = strtoTime("+{$i} day");
    //* 配列に設定
    $reserveDateArray[date('Ymd', $targetDate)] = date('n/j', $targetDate);
}

//* 人数選択肢配列
$reserveNumArray = [];
for ($i = 1; $i <= $shop['max_reserve_num']; $i++) {
    //* 配列に設定
    $reserveNumArray[$i] = $i;
}

//* 予約時間選択肢配列
$reserveTimeArray = [];
for ($i = date('G', strtotime($shop['start_time'])); $i <= date('G', strtotime($shop['end_time'])); $i++) {
    $reserveTimeArray[sprintf('%02d', $i).':00'] = sprintf('%02d', $i).':00';
}

$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //* POSTパラメータから各種入力値を受け取る
    $reserve_date = $_POST['reserve_date'];
    $reserve_num = $_POST['reserve_num'];
    $reserve_time = $_POST['reserve_time'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $comment = $_POST['comment'];
    //* 入力値バリデーション
    if (empty(Vali::inputValueCheck($_POST))) {
        //* DBのreservationテーブルからその日時の「予約成立済み人数」を取得
        $reserveCount = Database::getReservationLimit($reserve_date, $reserve_time);
        if ($reserveCount && ($reserveCount + $reserve_num) > $shop['max_reserve_num']) {
            $error['common'] = 'この日時はすでに予約が埋まっております。';
        } else {
            //* セッションに保存
            $_SESSION['reserve'] = $_POST;
            //* 予約確認画面へ遷移
            header('Location: /confirm.php');
            exit;
        }
    } else {
        $error = Vali::inputValueCheck($_POST);
    }
} else {
    //* 戻るボタンでセッションに入力情報がある場合は取得する
    if (isset($_SESSION['reserve'])) {
        $reserve_date = $_SESSION['reserve']['reserve_date'];
        $reserve_num = $_SESSION['reserve']['reserve_num'];
        $reserve_time = $_SESSION['reserve']['reserve_time'];
        $name = $_SESSION['reserve']['name'];
        $email = $_SESSION['reserve']['email'];
        $tel = $_SESSION['reserve']['tel'];
        $comment = $_SESSION['reserve']['comment'];
    } else {
        $reserve_date = '';
        $reserve_num = '';
        $reserve_time = '';
        $name = '';
        $email = '';
        $tel = '';
        $comment = '';
    }
}

include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">ご来店予約</h1>
<div class="container">
    <form class="m-3" method="post">
        <?php if (isset($error['common'])) : ?>
            <div class="alert alert-danger" role="alert"><?= Utils::h($error['common']); ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="validationServer01" class="form-label">【1】予約日選択</label>
                <?php if (isset($error['reserve_date_err'])) : ?>
                    <?php $isInvalid = ' is-invalid'; ?>
                <?php else : $isInvalid = '';?>
                <?php endif; ?>
            <?= arrayToSelect('reserve_date', $isInvalid, $reserveDateArray, $reserve_date); ?>
            <div id="validationServer01Feedback" class="invalid-feedback"><?= Utils::h($error['reserve_date_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer02" class="form-label">【2】人数選択</label>
                <?php if (isset($error['reserve_num_err'])) : ?>
                    <?php $isInvalid = ' is-invalid'; ?>
                <?php else : $isInvalid = '';?>
                <?php endif; ?>
            <?= arrayToSelect('reserve_num', $isInvalid, $reserveNumArray, $reserve_num); ?>
            <div id="validationServer02Feedback" class="invalid-feedback"><?= Utils::h($error['reserve_num_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer03" class="form-label">【3】予約時間選択</label>
                <?php if (isset($error['reserve_time_err'])) : ?>
                    <?php $isInvalid = ' is-invalid'; ?>
                <?php else : $isInvalid = '';?>
                <?php endif; ?>
            <?= arrayToSelect('reserve_time', $isInvalid, $reserveTimeArray, $reserve_time); ?>
            <div id="validationServer03Feedback" class="invalid-feedback"><?= Utils::h($error['reserve_time_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer04">【4】予約者情報入力</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['name_err']))echo 'is-invalid'; ?>" name="name" id="validationServer04" placeholder="氏名" value="<?= Utils::h($name); ?>">
            <div id="validationServer04Feedback" class="invalid-feedback"><?= Utils::h($error['name_err']); ?></div>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control rounded-3 <?php if (isset($error['email_err']))echo 'is-invalid'; ?>" name="email" placeholder="メールアドレス" value="<?= Utils::h($email); ?>">
            <div id="validationServer05Feedback" class="invalid-feedback"><?= Utils::h($error['email_err']); ?></div>
        </div>
        <div class="mb-3">
            <input type="tel" class="form-control rounded-3 <?php if (isset($error['tel_err']))
                echo 'is-invalid'; ?>" name="tel" placeholder="電話番号" value="<?= Utils::h($tel); ?>">
            <div id="validationServer06Feedback" class="invalid-feedback"><?= Utils::h($error['tel_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer07" class="form-label">【5】備考欄</label>
            <textarea class="form-control rounded-3 <?php if (isset($error['comment_err']))echo 'is-invalid'; ?>" name="comment" rows="3" id="validationServer07" placeholder="備考欄"><?= Utils::h($comment); ?></textarea>
            <div id="validationServer07Feedback" class="invalid-feedback"><?= Utils::h($error['comment_err']); ?></div>
        </div>
        <div class="d-grid gap-2 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">確認画面へ</button>
            <button class="btn btn-secondary rounded-pill" type="submit">戻る</button>
        </div>
    </form>
</div>
<?php
    include('_footer.php');
