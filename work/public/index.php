<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POSTパラメータから各種入力値を受け取る
    $reserve_date = $_POST['reserve_date'];
    $reserve_num = $_POST['reserve_num'];
    $reserve_time = $_POST['reserve_time'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $comment = $_POST['comment'];
    //セッションに保存
    $_SESSION['reserve'] = $_POST;
    // 予約確認画面へ遷移
    header('Location: /confirm.php');
    exit;
}

include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">ご来店予約</h1>
<div class="container">
    <form class="m-3" method="post">
        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">【1】予約日選択</label>
            <select class="form-select form-control rounded-3" name="reserve_date" id="exampleFormControlSelect1">
                <option selected>日付</option>
                <option value="6/23">6/23</option>
                <option value="10/11">10/11</option>
                <option value="8/16">8/16</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlSelect2" class="form-label">【2】人数選択</label>
            <select class="form-select form-control rounded-3" name="reserve_num" id="exampleFormControlSelect2">
                <option selected>人数</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlSelect3" class="form-label">【3】予約時間選択</label>
            <select class="form-select form-control rounded-3" name="reserve_time" id="exampleFormControlSelect3">
                <option selected>時間</option>
                <option value="12:00">12:00</option>
                <option value="14:00">14:00</option>
                <option value="18:00">18:00</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="floatingInput">【4】予約者情報入力</label>
            <input type="text" class="form-control rounded-3" name="name" id="floatingInput" placeholder="氏名">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control rounded-3" name="email" placeholder="メールアドレス">
        </div>
        <div class="mb-3">
            <input type="tel" class="form-control rounded-3" name="tel" placeholder="電話番号">
        </div>
        <div class="mb-3">
            <label for="floatingInput2" class="form-label">【5】備考欄</label>
            <textarea class="form-control rounded-3" name="comment" rows="3" id="floatingInput2" placeholder="備考欄"></textarea>
        </div>
        <div class="d-grid gap-2 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">確認画面へ</button>
            <button class="btn btn-secondary rounded-pill" type="submit">戻る</button>
        </div>
    </form>
</div>
<?php
    include('_footer.php');
