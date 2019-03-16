<?php foreach ($items as $item):?>
    <?php echo $this->renderPartial('_tag', ['item' => $item])?>
<?php endforeach; ?>