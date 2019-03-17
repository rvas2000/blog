<?php foreach ($items as $item):?>
    <?php echo $this->renderPartial('_gallery', ['item' => $item])?>
<?php endforeach; ?>