<h2>Админка</h2>

<div class="admin-gallery gray-border">
    <h3>Галерея</h3>
    <?php echo $this->renderPartial('_tag-filter', ['action' => '/?controller=admin&action=get-gallery-ajax']);?>
    <div class="gallery-content gray-border"></div>
</div>

<div class="admin-tags gray-border">
    <h3>Теги</h3>
    <?php echo $this->renderPartial('_tag-filter', ['action' => '/?controller=admin&action=get-tags-ajax']);?>
    <div class="tags-content gray-border"></div>
</div>
