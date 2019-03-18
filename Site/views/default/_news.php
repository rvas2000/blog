<?php
    $createdAt = new \DateTime($item['created_at']);
?>
<div class="news gray-border" data-new-id="<?php echo $item['id']; ?>">
    <div class="news-left">
        <div class="news-preview">
            <img src="images/gallery/<?php echo $item['preview']; ?>"/>
        </div>
        <div class="news-date"><?php echo $createdAt->format('d.m.Y H:i');?></div>
    </div>
    <div class="news-right">
        <div class="news-header"><h2><?php echo $item['header']; ?></h2></div>
        <div class="news-content"><?php echo $item['content']; ?></div>
    </div>
</div>