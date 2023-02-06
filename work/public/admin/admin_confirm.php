<?php
include('../_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">店舗登録確認画面</h1>
<div class="form-background mt-5">
    <table class="table bg-white mt-5">
        <tbody>
            <tr>
                <th scope="row">【1】店舗名</th>
                <td>香奈が作るタコライス屋さん</td>
            </tr>
            <tr>
                <th scope="row">【2】店舗ID</th>
                <td>kana910</td>
            </tr>
            <tr>
                <th scope="row">【3】メールアドレス</th>
                <td>xxxxx.xxx@gmail.com</td>
            </tr>
        </tbody>
    </table>
    <div class="d-grid gap-2 p-2">
        <a class="btn btn-primary rounded-pill mb-1" href="admin_complete.php">予約確定</a>
        <a class="btn btn-secondary rounded-pill" href="admin_signup.php">戻る</a>
    </div>
</div>
<?php
    include('../_footer.php');
