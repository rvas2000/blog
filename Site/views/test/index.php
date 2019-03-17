<form class="image-uploader" method="post" enctype="multipart/form-data" target="blank_" action="/?controller=rest&action=upload">
    <label>Выберите файл для загрузки<input type="file" name="img"/></label><br/>
    <input type="submit" value="Отправить"/>
</form>
<div id="iii" style="width: 200px; height: 200px; border: 1px solid #c1c1c1;">
    <img src="/images/gallery/noimage.png" style="width: 100%;"/>
</div>
<script type="text/javascript">
    $(function () {
        $(document).delegate('form.image-uploader', 'submit', function (evnt) {
            var form = evnt.currentTarget;
            var formData = new FormData(form);
            $.ajax({
                url: "/?controller=rest&action=upload",
                type: 'post',
                dataType: 'json',
                contentType: false, // важно - убираем форматирование данных по умолчанию
                processData: false, // важно - убираем преобразование строк по умолчанию
                data: formData,
                success: function (data){
                    var fileName = '/images/gallery/' + data.data;
                    $('#iii img').attr('src', fileName);
                    $(form['img']).empty();
                }

            });
           return false;
        });
    });
</script>