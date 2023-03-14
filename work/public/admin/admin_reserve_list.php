<?php
require_once(__DIR__ . '/../../app/config.php');
var_dump($_SESSION['shop_user']);
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

<h1 class="h2 text-center p-3">予約リスト</h1>

<div class="row g-3 m-3">
    <div class="col">
        <select class="form-select form-control" aria-label="Default select example">
            <option selected>2022年</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    <div class="col">
        <select class="form-select form-control" aria-label="Default select example">
            <option selected>1月</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
</div>

<div class="container p-0">
    <table class="table bg-white mt-5">
        <tbody>
            <tr>
                <th scope="row">2/2（木）12:00</th>
                <td>西本正吾　4名<br>
                    xxx@xxx.com<br>
                    xxx-xxxx-xxxx<br>
                    備考欄の内容</td>
            </tr>
            <tr>
                <th scope="row">2/3（金）14:00</th>
                <td>西本正吾　4名<br>
                    xxx@xxx.com<br>
                    xxx-xxxx-xxxx<br>
                    備考欄の内容</td>
            </tr>
            <tr>
                <th scope="row">2/4（土）18:00</th>
                <td>西本正吾　4名<br>
                    xxx@xxx.com<br>
                    xxx-xxxx-xxxx<br>
                    備考欄の内容</td>
            </tr>
            <tr>
                <th scope="row">2/5（日）20:00</th>
                <td>西本正吾　4名<br>
                    xxx@xxx.com<br>
                    xxx-xxxx-xxxx<br>
                    備考欄の内容</td>
            </tr>
            <tr>
                <th scope="row">2/6（火）15:00</th>
                <td>西本正吾　4名<br>
                    xxx@xxx.com<br>
                    xxx-xxxx-xxxx<br>
                    備考欄の内容</td>
            </tr>
        </tbody>
    </table>
</div>
<?php
    include('../_footer.php');
