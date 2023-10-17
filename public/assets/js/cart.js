// Call the dataTables jQuery plugin
$(document).ready(function () {
    function rupiah(angka) {
        var rupiah = "";
        var angkarev = angka.toString().split("").reverse().join("");
        for (var i = 0; i < angkarev.length; i++) {
            if (i % 3 == 0) {
                rupiah += angkarev.substr(i, 3) + ".";
            }
        }
        return rupiah
            .split("", rupiah.length - 1)
            .reverse()
            .join("");
    }

    function getPrice() {
        let price = 0;
        $(".cart-item-check-input").each(function (index, element) {
            if (element.checked) {
                price += parseInt($(element).attr("data-price"));
            }
        });
        return price;
    }

    $(".cart-item-check-input").change(function () {
        let price = getPrice();
        $("span#price").html(rupiah(price));
        const submitCheckout = $("#submitCheckout");
        if (price > 0) {
            if (submitCheckout.prop("disabled")) {
                submitCheckout.removeAttr("disabled");
            }
        } else {
            if (submitCheckout.attr("disabled") === undefined) {
                submitCheckout.attr("disabled", "disabled");
            }
        }
    });

    // $(".total_beli").on("change", function () {
    //     let price = getPrice();
    //     $("span#price").html(rupiah(price));
    // });

    $("#submitCheckout").click(function () {
        if (
            $("#submitCheckout").attr("disabled") === undefined &&
            getPrice() > 0
        ) {
            $("#formCheckout").submit();
        }
    });
});
