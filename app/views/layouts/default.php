<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test - <?=$page_name?></title>
    <link rel="stylesheet" href="/public/css/default.css">
    <?
        foreach ($styles as $style)
        {
            echo $style;
        }
    ?>

</head>
<body>

    <nav>
        <div class="box">
	        <div class="box-fluid menu" id="menu">
                <div class="mi">
                    <a href="" class="mb logo">
                        LOGO
                    </a>
                </div>
                <div class="mi ml-3">
                    <a href="" class="mb">Страница</a>
                </div>
                <div class="mi">
                    <a href="" class="mb">Связаться</a>
                </div>
                <div class="mi">
                    <a href="" class="mb">О нас</a>
                </div>
                <div class="mi ml-a">
                    <a href="" class="mb">Войти</a>
                </div>
                <div class="mi">
                    <a href="" class="mb">Регистрация</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="box">
        <div class="box-fluid mt-3">
            <?=$content?>
        </div>
    </div>


    <script src="/public/js/jQuery.js"></script>
    <script src="/public/js/default.js"></script>

    <?
        foreach ($scripts as $script)
        {
            echo $script;
        }
    ?>

</body>
</html>