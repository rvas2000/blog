<h2>Админка</h2>

<div class="admin-gallery gray-border">
    <h3>Галерея</h3>
    <?php echo $this->renderPartial('_tag-filter', ['action' => '?controller=admin&action=get-gallery-ajax']);?>
    <form class="file-upload-form" enctype="multipart/form-data" style="display: none;">
        <input type="file" name="fff"/>
    </form>
    <div><a class="add-gallery" href=""#>Добавить</a></div>
    <div class="gallery-content tag-filter-target gray-border"></div>
</div>

<div class="admin-tags gray-border">
    <h3>Теги</h3>
    <?php echo $this->renderPartial('_tag-filter', ['action' => '?controller=admin&action=get-tags-ajax']);?>
    <div><a class="add-tag" href=""#>Добавить</a></div>
    <div class="tags-content tag-filter-target gray-border"></div>
</div>
