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
                    $('div.tag-filter form').trigger('submit');
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


    // Начальная загрузка списка тегов
    $('div.tag-filter form').trigger('submit');

});