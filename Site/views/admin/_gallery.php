<div class="gallery-content-item gray-border" data-id="<?php echo htmlspecialchars( $item['guid'] );?>">
    <div class="gallery-content-item-image">
        <img src="/images/gallery/<?php echo $item['img'];?>"/>
    </div>
    <span><a href="#" class="gallery-delete">Удалить</a></span>
    <input type="text" value="<?php echo $item['description'];?>" placeholder="Описание картинки"/>
</div>