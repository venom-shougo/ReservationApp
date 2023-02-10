<?php

require_once(__DIR__ . '/../app/config.php');

include('_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">予約完了</h1>
<div class="container">

    <div class="card text-center">
        <div class="card-body">
            <i class="bi bi-check-lg complete-icon"></i>
            <h2 class="card-title">予約が完了しました</h2>
        </div>
        <div class="d-grid gap-2 mx-4 my-3">
            <a class="btn btn-primary rounded-pill mb-1" href="/">TOPに戻る</a>
        </div>
    </div>
</div>
<?php
    include('_footer.php');
