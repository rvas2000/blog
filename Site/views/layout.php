<html>
    <head>
        <link rel="stylesheet" href="/css/main.css"/>
        <?php echo $this->renderCss();?>
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
        <?php echo $this->renderJs();?>
    </head>
    <body>
        <div class="header">
            <h1>Тестовое задание</h1>
        </div>

        <div class="menu">
            <ul>
                <li><a href="/">Отображение данных</a></li>
                <li><a href="?action=form">Добавление данных</a></li>
            </ul>
        </div>

        <div class="content">
            <?php include $this->getTemplateName(); ?>
        </div>

        <div class="footer">
            Рубцов Василий Викторович, 2019
        </div>

    </body>
</html>