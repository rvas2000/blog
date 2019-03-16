$(function() {
    $(document).delegate('div.tag-filter form', 'submit', function (evnt) {
        var form = evnt.currentTarget;
        var tag = form.tag.value;
        var action= $(form).attr('action');

        $.ajax({
            url: action,
            method: 'post',
            data: {"tag": tag},
            success: function (data) {
                $('div.tags-content').empty().html(data);
            }
        });

        return false;
    })



    function getItems(tag)
    {
        var parameters = {
            "date_from": dateFrom,
            "date_to": dateTo,
            "header": header,
            "action": "get-news-ajax"
        };


    }

    // getItems();
});