<?php
include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">予約確認画面</h1>
<div class="container">
    <table class="table bg-white">
        <tbody>
            <tr>
                <th scope="row">日時</th>
                <td>2023年2月2日（木）12時00分</td>
            </tr>
            <tr>
                <th scope="row">人数</th>
                <td>4名</td>
            </tr>
            <tr>
                <th scope="row">氏名</th>
                <td>西本正吾</td>
            </tr>
            <tr>
                <th scope="row">メールアドレス</th>
                <td>beat.0729.pp1@gmail.com</td>
            </tr>
            <tr>
                <th scope="row">電話番号</th>
                <td>080-3054-8336</td>
            </tr>
            <tr>
                <th scope="row">備考</th>
                <td colspan="2">飲み放題を付けてください</td>
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
