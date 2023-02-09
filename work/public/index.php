<?php
require_once(__DIR__ . '/../app/config.php');
use Reserve\Validation\Validation as Vali;

// TODO:予約日選択肢配列
$reserveDateArray = [
    '0' => '日時',
    '20230623' => '6/23',
    '20230816' => '8/16',
    '20231011' => '10/11',
];
// TODO:人数選択肢配列
$reserveNumArray = [
    '0' => '人数',
    '1' => '1人',
    '2' => '2人',
    '3' => '3人',
];
// TODO:予約時間選択肢配列
$reserveTimeArray = [
    '0' => '時間',
    '12:00' => '12:00',
    '14:00' => '14:00',
    '16:00' => '16:00',
];
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
    $error = Vali::inputValueCheck($_POST);
    if (count($error) === ERROR_COUNT) {
        //セッションに保存
        $_SESSION['reserve'] = $_POST;
        // 予約確認画面へ遷移
        header('Location: /confirm.php');
        exit;
    }
} else {
    //* セッションに入力情報がある場合は取得する
    if (isset($_SESSION['reserve'])) {
        $reserve_date = $_SESSION['reserve']['reserve_date'];
        $reserve_num = $_SESSION['reserve']['reserve_num'];
        $reserve_time = $_SESSION['reserve']['reserve_time'];
        $reserve_name = $_SESSION['reserve']['name'];
        $reserve_emaile = $_SESSION['reserve']['email'];
        $reserve_tel = $_SESSION['reserve']['tel'];
        $reserve_comment = $_SESSION['reserve']['comment'];
    } else {
        $reserve_date = '';
        $reserve_num = '';
        $reserve_time = '';
        $reserve_name = '';
        $reserve_emaile = '';
        $reserve_tel = '';
        $reserve_comment = '';
    }
}

include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">ご来店予約</h1>
<div class="container">
    <form class="m-3" method="post">
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
            <input type="text" class="form-control rounded-3 <?php if (isset($error['name_err']))echo 'is-invalid'; ?>" name="name" id="validationServer04" placeholder="氏名" value="<?= Utils::h($reserve_name); ?>">
            <div id="validationServer04Feedback" class="invalid-feedback"><?= Utils::h($error['name_err']); ?></div>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control rounded-3 <?php if (isset($error['email_err']))echo 'is-invalid'; ?>" name="email" placeholder="メールアドレス" value="<?= Utils::h($reserve_emaile); ?>">
            <div id="validationServer05Feedback" class="invalid-feedback"><?= Utils::h($error['email_err']); ?></div>
        </div>
        <div class="mb-3">
            <input type="tel" class="form-control rounded-3 <?php if (isset($error['tel_err']))
                echo 'is-invalid'; ?>" name="tel" placeholder="電話番号" value="<?= Utils::h($reserve_tel); ?>">
            <div id="validationServer06Feedback" class="invalid-feedback"><?= Utils::h($error['tel_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer07" class="form-label">【5】備考欄</label>
            <textarea class="form-control rounded-3 <?php if (isset($error['comment_err']))echo 'is-invalid'; ?>" name="comment" rows="3" id="validationServer07" placeholder="備考欄"><?= Utils::h($reserve_comment); ?></textarea>
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
