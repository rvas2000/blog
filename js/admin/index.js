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
                url: '/?controller=rest&action=save-tag',
                method: 'post',
                data: {
                    "id": id,
                    "name": value
                },
                success: function (data) {
                }
            });

        }
    });

    // Обработка удаления тега
    $(document).delegate('div.tag-content span a', 'click', function (evnt) {
        var a = $(evnt.currentTarget);
        var id = a.parent().parent().data('id');

        if (id != '') {
            $.ajax({
                url: '/?controller=rest&action=delete-tag',
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
            url: '/?controller=admin&action=get-empty-tag-ajax',
            success: function (data) {
                $('div.tags-content').prepend(data);
            }
        });

        return false;
    });


    // Обработка редактрования элемента галереи
    $(document).delegate('div.gallery-content-item input[type=text]', 'change', function (evnt) {
        var input = $(evnt.currentTarget);
        var value = input.val();
        var id = input.parent().data('id');

        if (value != '') {
            $.ajax({
                url: '/?controller=rest&action=save-gallery',
                method: 'post',
                dateType: 'ajax',
                data: {
                    "id": id,
                    "description": value
                },
                success: function (data) {
                    input.parent().data('id', data.data);
                }
            });

        }
    });


    // Обработка добавления элемента галереи
    $(document).delegate('a.add-gallery', 'click', function (evnt) {
        $.ajax({
            url: '/?controller=admin&action=get-empty-gallery-ajax',
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
                url: '/?controller=rest&action=delete-gallery',
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

    // Начальная загрузка списка тегов и галереи
    $('div.tag-filter form').trigger('submit');

});