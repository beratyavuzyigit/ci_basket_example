$(document).ready(function() {
    $("#add_to_cart").click(function() {
        var urun_id = parseInt($(this).parents(".product_item").attr("data-id"));
        var pruduct_qty = parseInt($(this).siblings("#product_qty").val());
        $.ajax({
            method: "POST",
            url: "ajax/set_or_delete_basket",
            data: { urun_id: urun_id, urun_adet: pruduct_qty },
            success: function(e) {
                alert(e);
            }
        });
    });
});