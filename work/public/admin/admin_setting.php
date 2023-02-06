<?php
include('../_header.php');
?>
<header class="navbar bg-dark  p-3">
    <div class="container-fluid">
        <div class="navbar-brand text-white">SAMPEL SHOP</div>
        <form class="d-flex" role="search">
            <a href="admin_reserve_list.php"><i class="bi bi-list-task nav-icon mx-3"></i></a>
            <a href="admin_setting.php"><i class="bi bi-gear nav-icon"></i></a>
        </form>
    </div>
</header>

<h1 class="h2 text-center p-3">店舗設定画面</h1>

<div class="form-background ">
    <form class="m-3 mt-5" action="" method="post">
        <div class="mb-3">
            <label for="floatingInput2">予約可能日</label>
            <select class="form-select form-control" aria-label="Default select example">
                <option selected>0日前</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="floatingInput4">営業時間（予約可能時間）</label>
            <div class="row">
                <div class="col-5">
                    <select class="form-select form-control" aria-label="Default select example">
                        <option selected>00:00</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="text-center pt-2 col-2">〜</div>
                <div class="col-5">
                    <select class="form-select form-control" aria-label="Default select example">
                        <option selected>00:00</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="mb-3">
            <label for="floatingInput4">１時間当たりの予約上限人数</label>
            <select class="form-select form-control" aria-label="Default select example">
                <option selected>1人</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="d-grid gap-2 mx-4 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">登録</button>
        </div>
    </form>
</div>
<?php
    include('../_footer.php');
