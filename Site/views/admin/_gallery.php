<div class="gallery-content-item gray-border" data-id="<?php echo htmlspecialchars( $item['guid'] );?>">
    <div class="gallery-content-item-image">
        <img src="images/gallery/<?php echo $item['img'];?>"/>
    </div>
    <span><a href="#" class="gallery-delete">Удалить</a></span>
    <div class="gallery-content-item-tags gray-border">
        <label>Добавить тег<input type="text"/></label>
        <div class="select-container"></div>
        <?php foreach ($item['tags'] as $tag):?>
        <div class="tag-item" data-id="<?php echo $tag['id']; ?>">  <?php echo $tag['name']; ?><a href="#" title="Удалить">X</a></div>
        <?php endforeach;?>
    </div>
    <input type="text" name="description" value="<?php echo $item['description'];?>" placeholder="Описание картинки"/>
    <input type="hidden" name="img"/>
</div>