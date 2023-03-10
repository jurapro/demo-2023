function addCart(id_product) {
    $.ajax({
        method: "GET",
        url: `/cart/create?id_product=${id_product}`,
    })
        .done(function (msg) {
            $.pjax.reload({
                container: '#cart'
            });
            $('.info').html(msg).fadeIn().animate({opacity: 1.0}, 3000).fadeOut("slow");
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
            $('.info').html(msg).fadeIn().animate({opacity: 1.0}, 3000).fadeOut("slow");
        });
}

function byOrder() {
    const password = $(".password");
    if (!password.val()) {
        $('.info').html("Укажите пароль").fadeIn().animate({opacity: 1.0}, 3000).fadeOut("slow");
        return;
    }
    $.ajax({
        method: "GET",
        url: `/cart/by-order?password=${password.val()}`,
    })
        .done(function (msg) {
            $('.info').html(msg).fadeIn().animate({opacity: 1.0}, 3000).fadeOut("slow");
            $.pjax.reload({
                container: '#cart'
            });
        });
}

function getProduct(id_category) {
    $.pjax.reload({
        url: `/?id_category=${id_category}`,
        container: '#cart'
    });
}
