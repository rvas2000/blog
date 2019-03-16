<?php foreach ($news as $item):?>
    <?php echo $this->renderPartial('_news', ['item' => $item])?>
<?php endforeach; ?>