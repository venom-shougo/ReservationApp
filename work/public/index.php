<?php
include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">ご来店予約</h1>
<div class="container">
    <form class="m-3" action="confirm.php" method="post">
        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">【1】予約日選択</label>
            <select class="form-select form-control rounded-3" name="" id="exampleFormControlSelect1">
                <option selected>日付</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlSelect2" class="form-label">【2】人数選択</label>
            <select class="form-select form-control rounded-3" id="exampleFormControlSelect2">
                <option selected>人数</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlSelect3" class="form-label">【3】予約時間選択</label>
            <select class="form-select form-control rounded-3" id="exampleFormControlSelect3">
                <option selected>時間</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="floatingInput">【4】予約者情報入力</label>
            <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="氏名">
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control rounded-3" placeholder="メールアドレス">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control rounded-3" placeholder="電話番号">
        </div>
        <div class="mb-3">
            <label for="floatingInput2" class="form-label">【5】備考欄</label>
            <textarea class="form-control rounded-3" rows="3" id="floatingInput2" placeholder="備考欄"></textarea>
        </div>
        <div class="d-grid gap-2 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">確認画面へ</button>
            <button class="btn btn-secondary rounded-pill" type="submit">戻る</button>
        </div>
    </form>
</div>
<?php
    include('_footer.php');
