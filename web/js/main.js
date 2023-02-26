function addCart(id_product) {
    $.ajax({
        method: "GET",
        url: `/cart/create?id_product=${id_product}`,
    })
        .done(function (msg) {
            $.pjax.reload({
                container: '#cart'
            });
            $(".info").text(msg);
            setTimeout(() => {
                $(".info").text('');
            }, 1000);
        });
}

function removeCart(id_product) {
    $.ajax({
        method: "POST",
        url: `/cart/delete?id_product=${id_product}`,
    })
        .done(function (msg) {
            $.pjax.reload({
                container: '#cart'
            });
            $(".info").text(msg);
            setTimeout(() => {
                $(".info").text('');
            }, 1000);
        });
}
