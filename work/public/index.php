<?php
require_once(__DIR__ . '/../app/config.php');
use Reserve\Validation\Validation as Vali;

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
    // var_dump($error);
    // exit;
    if (count($error) === ERROR_COUNT) {
        //セッションに保存
        $_SESSION['reserve'] = $_POST;
        // 予約確認画面へ遷移
        header('Location: /confirm.php');
        exit;
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
            <select class="form-select form-control rounded-3 <?php if (isset($error['reserve_date_err']))echo 'is-invalid'; ?>" name="reserve_date" id="validationServer01">
                <option value="0">日付</option>
                <option value="6/23">6/23</option>
                <option value="10/11">10/11</option>
                <option value="8/16">8/16</option>
            </select>
            <div id="validationServer01Feedback" class="invalid-feedback"><?= Utils::h($error['reserve_date_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer02" class="form-label">【2】人数選択</label>
            <select class="form-select form-control rounded-3 <?php if (isset($error['reserve_num_err']))echo 'is-invalid'; ?>" name="reserve_num" id="validationServer02">
                <option value="人数">人数</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <div id="validationServer02Feedback" class="invalid-feedback"><?= Utils::h($error['reserve_num_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer03" class="form-label">【3】予約時間選択</label>
            <select class="form-select form-control rounded-3 <?php if (isset($error['reserve_time_err']))echo 'is-invalid'; ?>" name="reserve_time" id="validationServer03">
                <option value="0">時間</option>
                <option value="12:00">12:00</option>
                <option value="14:00">14:00</option>
                <option value="18:00">18:00</option>
            </select>
            <div id="validationServer03Feedback" class="invalid-feedback"><?= Utils::h($error['reserve_time_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer04">【4】予約者情報入力</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['name_err']))echo 'is-invalid'; ?>" name="name" id="validationServer04" placeholder="氏名">
            <div id="validationServer04Feedback" class="invalid-feedback"><?= Utils::h($error['name_err']); ?></div>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control rounded-3 <?php if (isset($error['email_err']))echo 'is-invalid'; ?>" name="email" placeholder="メールアドレス">
            <div id="validationServer05Feedback" class="invalid-feedback"><?= Utils::h($error['email_err']); ?></div>
        </div>
        <div class="mb-3">
            <input type="tel" class="form-control rounded-3 <?php if (isset($error['tel_err']))echo 'is-invalid'; ?>" name="tel" placeholder="電話番号">
            <div id="validationServer06Feedback" class="invalid-feedback"><?= Utils::h($error['tel_err']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer07" class="form-label">【5】備考欄</label>
            <textarea class="form-control rounded-3 <?php if (isset($error['comment_err']))echo 'is-invalid'; ?>" name="comment" rows="3" id="validationServer07" placeholder="備考欄"></textarea>
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
