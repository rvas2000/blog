$(function () {

    $(document).delegate('div.news-filter form', 'submit', function (evnt) {
        var form = evnt.currentTarget;
        var dateFrom = form.date_from.value;
        var dateTo = form.date_to.value;
        var header = form.header.value;
        getItems(dateFrom, dateTo, header);
        return false;
    })



    function getItems(dateFrom, dateTo, header)
    {
        var parameters = {
            "date_from": dateFrom,
            "date_to": dateTo,
            "header": header,
        };

        $.ajax({
            url: '/?action=get-news-ajax',
            methos: 'post',
            data: parameters,
            success: function (data) {
                $('div.all-news').empty().html(data);
            }
        });
    }

    getItems();

});