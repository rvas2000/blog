$(function() {
    // обработка формы фильтра по тегам
    $(document).delegate('div.tag-filter form', 'submit', function (evnt) {
        var form = evnt.currentTarget;
        var tag = form.tag.value;
        var action= $(form).attr('action');
        var target = $(form).parent().parent().find('.tag-filter-target');

        $.ajax({
            url: action,
            method: 'post',
            data: {"tag": tag},
            success: function (data) {
                target.empty().html(data);
            }
        });

        return false;
    })

    // Обработка редактрования названия тега
    $(document).delegate('div.tag-content input[type=text]', 'change', function (evnt) {
        var input = $(evnt.currentTarget);
        var value = input.val();
        var id = input.parent().data('id');

        if (value != '') {
            $.ajax({
                url: '?controller=rest&action=save-tag',
                method: 'post',
                data: {
                    "id": id,
                    "name": value
                },
                success: function (data) {
                }
            });

        }
        return false;
    });

    // Обработка удаления тега
    $(document).delegate('div.tag-content span a', 'click', function (evnt) {
        var a = $(evnt.currentTarget);
        var id = a.parent().parent().data('id');

        if (id != '') {
            $.ajax({
                url: '?controller=rest&action=delete-tag',
                method: 'post',
                data: {
                    "id": id,
                },
                success: function (data) {
                    $('div.admin-tags div.tag-filter form').trigger('submit');
                }
            });

        } else {
            a.parent().parent().remove();
        }
        return false;
    });

    // Обработка добавления тега
    $(document).delegate('a.add-tag', 'click', function (evnt) {
        $.ajax({
            url: '?controller=admin&action=get-empty-tag-ajax',
            success: function (data) {
                $('div.tags-content').prepend(data);
            }
        });

        return false;
    });

    // Функция редактирования элемента галереи
    // input - элемент ввода, значение которого необходимо записать в БД
    function editGallery(input)
    {
        var input = $(input);
        var name = input.attr('name');
        var value = input.val();
        var id = input.parent().data('id');


        var data = {};
        data["id"] = id;
        data[name] = value;

        if (value != '') {
            $.ajax({
                url: '?controller=rest&action=save-gallery',
                method: 'post',
                dateType: 'ajax',
                data: data,
                success: function (data) {
                    input.parent().data('id', data.data);
                }
            });

        }
    }


    // Обработка редактрования элемента галереи
    $(document).delegate('div.gallery-content-item input[type=text]', 'change', function (evnt) {
        editGallery(evnt.currentTarget);
        return false;
    });


    // Обработка добавления элемента галереи
    $(document).delegate('a.add-gallery', 'click', function (evnt) {
        $.ajax({
            url: '?controller=admin&action=get-empty-gallery-ajax',
            success: function (data) {
                $('div.gallery-content').prepend(data);
            }
        });

        return false;
    });


    // Обработка удаления элемента галереи
    $(document).delegate('div.gallery-content-item a.gallery-delete', 'click', function (evnt) {
        var a = $(evnt.currentTarget);
        var id = a.parent().parent().data('id');

        if (id != '') {
            $.ajax({
                url: '?controller=rest&action=delete-gallery',
                method: 'post',
                data: {
                    "id": id,
                },
                success: function (data) {
                    $('div.admin-gallery div.tag-filter form').trigger('submit');
                }
            });

        } else {
            a.parent().parent().remove();
        }
        return false;
    });


    var currentImgObject = null;
    var uploadForm = $('form.file-upload-form')[0];

    // Загрузка картинки
    $(document).delegate('div.gallery-content-item-image', 'click', function (evnt) {
        currentImgObject = evnt.currentTarget;
        uploadForm.reset();
        $(uploadForm.fff).trigger('click');
        return false;
    });

    $(document).delegate(uploadForm.fff, 'change', function(evnt) {

        var formData = new FormData(uploadForm);
        $.ajax({
            url: "?controller=rest&action=upload",
            type: 'post',
            dataType: 'json',
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData,
            success: function (data){
                var fileName = data.data;
                $(currentImgObject).find('img').attr('src', 'images/gallery/' + fileName);
                var input = $(currentImgObject).parent().find('input[name=img]').val(fileName);
                editGallery(input);
            }

        });
        return false;
    });

    // // Обработка добавления тега
    // $(document).delegate('div.gallery-content-item-tags input[type=text]', 'input', function (evnt) {
    //     var input = $(evnt.currentTarget);
    //     var container = input.parent().parent();
    //     var selectContainer = container.find('div.select-container');
    //     selectContainer.empty();
    //     var tag = input.val();
    //     if (tag.length > 2) {
    //         $.ajax({
    //             url: "?controller=rest&action=get-tags",
    //             type: 'post',
    //             data: {"tag": tag},
    //             dataType: 'json',
    //             success: function (data){
    //
    //                 if (data.data.length > 0) {
    //
    //                     var sel = '<select>' + $.map(data.data, function (v) {
    //                         return '<option value="' +   v['id'] + '|' + v['name'] + '">' + v['name'] + '</option>';
    //                     }).join('') + '<select>';
    //                     selectContainer.append(sel);
    //                 }
    //             }
    //         });
    //     }
    //
    //     return true;
    // })
    //

    // Обработка добавления тега
    $(document).delegate('div.gallery-content-item-tags input[type=text]', 'input', function (evnt) {
        var input = $(evnt.currentTarget);
        var container = input.parent().parent();
        var selectContainer = container.find('div.select-container');
        selectContainer.empty();
        var tag = input.val();
        if (tag.length > 2) {
            $.ajax({
                url: "?controller=rest&action=get-tags",
                type: 'post',
                data: {"tag": tag},
                dataType: 'json',
                success: function (data){

                    if (data.data.length > 0) {

                        var sel = '<ul>' + $.map(data.data, function (v) {
                            // return '<li><a href="#" data-value="' +   v['id'] + '|' + v['name'] + '">' + v['name'] + '</a></li>';
                            return '<li data-value="' +   v['id'] + '|' + v['name'] + '">' + v['name'] + '</li>';
                        }).join('') + '</ul>';
                        selectContainer.append(sel);
                    }
                }
            });
        }

        return true;
    })


    // Обработка выбора тега из выпдающего списка
    $(document).delegate('div.gallery-content-item-tags div.select-container ul li', 'click', function (evnt) {
        var sel = $(evnt.currentTarget);
        var item = sel.data('value').split('|');
        var container = sel.parent().parent().parent();

        sel.parent().parent().empty();
        container.parent().find('input[type=text]').val('');

        var tagsId = item[0];
        var name = item[1];
        var galleryId = container.parent().data('id');
        container.append('<div class="tag-item" data-id="' + tagsId + '">' + name + '<a href="#" title="Удалить">X</a></div>');


        $.ajax({
            url: "?controller=rest&action=add-gallery-tags",
            type: 'post',
            data: {"gallery_id": galleryId, "tags_id": tagsId},
            dataType: 'json',
            success: function (data){
            }
        });

        return false;
    });

    // Обработка удаления тега из описания картинки
    $(document).delegate('div.gallery-content-item-tags div.tag-item a', 'click', function (evnt) {
        var a = $(evnt.currentTarget);
        var element = a.parent();

        var tagsId = element.data('id');
        var galleryId = element.parent().parent().data('id');

        var data = {
            "gallery_id": galleryId,
            "tags_id": tagsId
        };

        $.ajax({
            url: "?controller=rest&action=delete-gallery-tags",
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data){
                if (data.result == 1) {
                    element.remove();
                }
            }
        });

        return true;
    })

    // Начальная загрузка списка тегов и галереи
    $('div.tag-filter form').trigger('submit');

});
