<html>
    <head>
        <link rel="stylesheet" href="css/main.css"/>
        <?php echo $this->renderCss();?>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <?php echo $this->renderJs();?>
    </head>
    <body>
        <div class="header">
            <h1>Тестовое задание (блог) </h1>
        </div>

        <div class="menu">
            <?php if (! $this->getApp()->getAuth()->isAuthorized()):?>
                <div class="auth-form">
                    <form method="post" action="?controller=auth&action=login">
                        <label>Авторизация<input type="password" name="password" placeholder="Введите пароль"/></label>
                        <input type="submit" value="Ok"/>
                    </form>
                </div>
            <?php else: ?>
                <ul>
                    <li><a href="./">Главная</a></li>
                    <li><a href="./?controller=admin">Админка</a></li>
                </ul>
                <div class="auth-form">
                    <a href="?controller=auth&action=logout">Выйти</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="content">
            <?php include $this->getTemplateName(); ?>
        </div>

        <div class="footer">
            Рубцов Василий Викторович, 2019
        </div>

    </body>
</html>