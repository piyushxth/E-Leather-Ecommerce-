$(window).on("load", function () {
    if (!$(".trigger").is(":checked")) {
        $("#ship_different_address_fields").hide();
    } else {
        $("#ship_different_address_fields").show();
    }
    if ($("section").hasClass("payment_success_page")) {
        localStorage.removeItem("current_delivery_location");
    }
});

$(function () {
    if ($("#educational_institution").length > 0) {
        $(this).find("option:selected").val();
        var selected_option_val = $(this).find("option:selected").val();
        enquiry_form(selected_option_val);
        $("#educational_institution").on("change", function () {
            var selected_option_val = $(this).find("option:selected").val();
            enquiry_form(selected_option_val);
        });

        $("#send_Enquires_btn").on("click", function (e) {
            e.preventDefault();
            var baseUrl = $("body").attr("data-siteurl");
            var formaction = $("#enquiry_form").attr("action");
            var formdata = $("#enquiry_form").serialize();
            $.ajax({
                url: formaction,
                method: "POST",
                data: formdata,
                beforeSend: function () {
                    $("#send_Enquires_btn")
                        .html(
                            "<i class='fas fa-spinner fa-pulse fa-1x'></i> Submit<span><img src=" +
                                baseUrl +
                                "/frontend/images/maki_rocket.svg></span>"
                        )
                        .prop("disabled", false);
                },
                success: function (response) {
                    if (response) {
                        if (response.success) {
                            $(".success_message")
                                .show()
                                .delay(3000)
                                .fadeOut(300);
                            $("#enquiry_form")[0].reset();
                            enquiry_form("");
                        } else {
                            $(".error_message").show().delay(3000).fadeOut(300);
                        }
                    }
                    $("#send_Enquires_btn")
                        .html(
                            "Submit <span><img src=" +
                                baseUrl +
                                "/frontend/images/maki_rocket.svg></span>"
                        )
                        .prop("disabled", false);
                    $(".error").remove();
                },
                error: function (response) {
                    if (
                        typeof response.responseJSON.errors !== "" &&
                        response.responseJSON.errors
                    ) {
                        $(".error").remove();
                        $.each(
                            response.responseJSON.errors,
                            function (key, value) {
                                var dy_class = key + "_error";
                                if ($("." + dy_class).length == 0) {
                                    $("#" + key).after(
                                        "<div class='" +
                                            dy_class +
                                            " error'>" +
                                            value +
                                            "</div>"
                                    );
                                }
                            }
                        );
                    }
                    $("#send_Enquires_btn")
                        .html(
                            "Submit <span><img src=" +
                                baseUrl +
                                "/frontend/images/maki_rocket.svg></span>"
                        )
                        .prop("disabled", false);
                },
            }).fail(function (response) {
                $("#send_Enquires_btn")
                    .html(
                        "Submit <span><img src=" +
                            baseUrl +
                            "/frontend/images/maki_rocket.svg></span>"
                    )
                    .prop("disabled", false);
            });
        });
    }

    if ($("#exampleModal").length > 0) {
        $("#exampleModal").on("hide.bs.modal", function () {
            var baseUrl = $("body").attr("data-siteurl");
            $("#send_Enquires_btn")
                .html(
                    "Submit <span><img src=" +
                        baseUrl +
                        "/frontend/images/maki_rocket.svg></span>"
                )
                .prop("disabled", false);
            $("#enquiry_form")[0].reset();
            $(".error").remove();
            enquiry_form("");
        });
    }

    /*--- Video ---*/
    $(".vpop").on("click", function (e) {
        e.preventDefault();
        var srchref = "",
            autoplay = "",
            id = $(this).data("id"),
            video_num = $(this).data("num");
        $("#video-popup-overlay-" + video_num).show();
        $("#video-popup-iframe-container-" + video_num).show();
        $("#video-popup-container-" + video_num).show();
        $("#video-popup-close-" + video_num).show();

        if ($(this).data("type") == "vimeo")
            var srchref = "//player.vimeo.com/video/";
        else if ($(this).data("type") == "youtube")
            var srchref = "https://www.youtube.com/embed/";
        if ($(this).data("autoplay") == true) autoplay = "?autoplay=1";
        $("#video-popup-iframe-" + video_num).attr(
            "src",
            srchref + id + autoplay + "&enable_js=1"
        );
    });

    $(".video-popup-close").on("click", function (e) {
        $(
            ".video-popup-overlay, .video-popup-iframe-container, .video-popup-container, .video-popup-close"
        ).hide();
        $(".video-popup-iframe").attr("src", "");
    });

    $(".gallerycat").click(function (e) {
        e.preventDefault();
        var tabslug = $(this).attr("data-tabslug");
        var baseUrl = $("body").attr("data-siteurl");
        var final_url = baseUrl+"/gallery?gallery="+tabslug;
        window.location.href = final_url;
    });

    if ($(".filter_by_publication").length > 0) {
        $(".filter_by_publication").change(function (e) {
            e.preventDefault();
            var selected_category = $(".filter_by_publication")
                .find(":selected")
                .val();
            if (selected_category != "") {
                var baseUrl = $("body").attr("data-siteurl");
                window.location.href =
                    baseUrl +
                    "/book/filter?type=category&value=" +
                    selected_category;
            }
        });
    }

    $(".vpop1").on("click", function (e) {
        e.preventDefault();
        $("#video-popup-overlay1, #video-popup-iframe-container1, #video-popup-container1, #video-popup-close1").show();
        if($('.owl-lazy').length > 0){
            $('.owl-lazy').trigger('stop.owl.autoplay');
        }

        var srchref = "",
            autoplay = "",
            id = $(this).data("id");
        if ($(this).data("type") == "vimeo")
            var srchref = "//player.vimeo.com/video/";
        else if ($(this).data("type") == "youtube")
            var srchref = "https://www.youtube.com/embed/";

        if ($(this).data("autoplay") == true) autoplay = "?autoplay=1";

        $("#video-popup-iframe1").attr("src", srchref + id + autoplay);
    });

    $("#video-popup-close1, #video-popup-overlay1").on("click", function (e) {
        $(
            "#video-popup-overlay1, #video-popup-iframe-container1, #video-popup-container1, #video-popup-close1"
        ).hide();
        $("#video-popup-iframe1").attr("src", "");
    });

    if ($(".search-book").length > 0) {
        $(".search-book").click(function () {
            $("#search-book").submit();
        });
    }

    $(document).keydown(function (e) {
        if ((e.keyCode || e.which) == 27) {
            if ($("#review_form").length > 0) {
                $("#review_form")[0].reset();
                $("#writeReviewModal").modal("hide");
            }

            if (
                ($(".video-popup-iframe-container").length ||
                    $(".video-popup-container").length ||
                    $(".video-popup-close").length ||
                    $(".video-popup-overlay").length) > 0
            ) {
                $(
                    ".video-popup-iframe-container,.video-popup-container,.video-popup-close,.video-popup-overlay"
                ).hide();
                $(".video-popup-iframe").attr("src", "");
            }
        }
    });

    if (!$(".trigger").is(":checked")) {
        $("#ship_different_address_fields").hide();
        fillShippingInput();
    } else {
        $("#ship_different_address_fields").show();
        clearShippingInput();
    }

    if ($("#checkout_state").length > 0) {
        $("#checkout_state").on("change", function () {
            getDistricts("#checkout_district", $(this).find(":selected").val());
        });
    }

    // if ($("#checkout_district").length > 0) {
    //   $('#checkout_district').on('change', function() {
    //     $("#shipping_district").val($(this).find(":selected").val()).change();
    //   });
    // }

    $("#mode-toggle-btn").change(function (e) {
        if (this.checked == true) {
            var mode = "dark";
        } else {
            var mode = "light";
        }

        setMode(mode);
    });

    $(".write_a_review").click(function () {
        var form_url = $(this).attr("data-formurl");
        $.get(form_url, function (data, status) {
            if (status == "success") {
                $("#writeReviewModal").modal("show");
                $(".writeReviewModalBody").html(data.data.review_form);
            }
        });
    });

    $(".payment_gateway_option").click(function () {
        $(".payment_gateway_option").each(function (index) {
            $(this).attr("checked", false);
        });
        var payment_label =
            $(this).val() == "cod" ? "Cash on Delivery" : $(this).val();

        if (payment_label != "Cash on Delivery")
            var label_payment =
                payment_label.charAt(0).toUpperCase() +
                payment_label.substr(1).toLowerCase();

        $(this).attr("checked", true);
        if (payment_label == "Cash on Delivery") {
            $(".pay_btn_label").text("Pay " + payment_label);
        } else {
            $(".pay_btn_label").text("Pay with " + label_payment);
        }
    });

    $(".pay_btn_label").click(function (e) {
        e.preventDefault();
        // var site_url = $('body').attr('data-siteurl');
        var payment_gateway = $("input[name=radio-group]:checked").val();
        var btn_label =
            $(this).text() == "cod" ? "Cash on Delivery" : $(this).text();
        var formaction = $(".lccigq-checkoutform").attr("action");
        var formdata = $(".lccigq-checkoutform").serialize();
        var form_method = $(".lccigq-checkoutform").attr("method");

        $.ajax({
            url: formaction,
            method: form_method,
            data: formdata,
            beforeSend: function () {
                if (payment_gateway == "khalti") {
                    showMessage("Khalti is not available for payment", "error");
                    return false;
                } else {
                    $(".pay_btn_label")
                        .html(
                            "<i class='fas fa-spinner fa-pulse fa-1x'></i> " +
                                btn_label
                        )
                        .prop("disabled", false);
                }
            },
            success: function (response) {
                if (response) {
                    if (response.success) {
                        showMessage(response.success, "success");
                        if (response.data.redirect_url != "") {
                            window.location.href = response.data.redirect_url;
                        } else {
                            window.location.reload();
                        }
                    } else {
                        showMessage(response.error, "error");
                    }
                }
                $(".pay_btn_label").html(btn_label).prop("disabled", false);
                // $('.lccigq-checkoutform')[0].reset();
            },
            error: function (response) {
                if (
                    typeof response.responseJSON.errors !== "" &&
                    response.responseJSON.errors
                ) {
                    $.each(response.responseJSON.errors, function (key, value) {
                        showMessage(value, "error");
                    });
                }
                $(".pay_btn_label").html(btn_label).prop("disabled", false);
            },
        }).fail(function (response) {
            $(".pay_btn_label").html(btn_label).prop("disabled", false);
        });
    });

    AOS.init({
        delay: 5000,
        offset: 400,
        duration: 700,
    });

    $(".slider-test").slick();
    // Fix slick slider using multitabs
    $('.nav-tabs a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
        e.target;
        e.relatedTarget;
        $(".slider-test").slick("setPosition");
    });

    $(".trigger").change(function () {
        var hiddenId = $(this).attr("data-trigger");
        if ($(this).is(":checked")) {
            $("#" + hiddenId).show();
            clearShippingInput();
            if ($("#shipping_state").length > 0) {
                $("#shipping_state").on("change", function () {
                    var selected_state = $(this).find(":selected").val();
                    getDistricts("#shipping_district", selected_state);
                });
            }
        } else {
            $("#" + hiddenId).hide();
            fillShippingInput();
        }
    });

    // $(window).ready(function () {
    //     setTimeout(function () {
    //         $("#popupModal").modal("show");
    //     }, 1000);
    //     $(".close").click(function () {
    //         $("#popupModal").modal("toggle");
    //     });
    // });

    /* AUTHOR LINK */
    $(".about-me-img").hover(
        function () {
            $(".authorWindowWrapper")
                .stop()
                .fadeIn("fast")
                .find("p")
                .addClass("trans");
        },
        function () {
            $(".authorWindowWrapper")
                .stop()
                .fadeOut("fast")
                .find("p")
                .removeClass("trans");
        }
    );

    let dropdowns = document.querySelectorAll(".drop-menu");
    dropdowns.forEach((dd) => {
        dd.addEventListener("click", function (e) {
            var el = this.nextElementSibling;
            el.style.display = el.style.display === "block" ? "none" : "block";
        });
    });
    /*---- counter ---*/
    $.fn.jQuerySimpleCounter = function (options) {
        var settings = $.extend(
            {
                start: 0,
                end: 100,
                easing: "swing",
                duration: 400,
                complete: "",
            },
            options
        );

        var thisElement = $(this);

        $({
            count: settings.start,
        }).animate(
            {
                count: settings.end,
            },
            {
                duration: settings.duration,
                easing: settings.easing,
                step: function () {
                    var mathCount = Math.ceil(this.count);
                    thisElement.text(mathCount);
                },
                complete: settings.complete,
            }
        );
    };

    $(".number").each(function () {
        var number_id = $(this).attr("id");
        var stat_number = $(this).attr("data-number");
        var stat_symbol = $(this).attr("data-number_symbol");
        $("#" + number_id).jQuerySimpleCounter({
            end: stat_number,
            duration: 3000,
            complete: function () {
                $("#" + number_id).text(stat_number + " " + stat_symbol);
            },
        });
    });

    /*--- hospitality-owl---*/
    var owl = $(".hospitality-owl");
    owl.owlCarousel({
        items: 3,
        loop: false,
        margin: 5,
        autoplay: true,
        dots: true,
        autoplayTimeout: 5000,
        responsive: {
            1400: {
                items: 3,
            },
            1024: {
                items: 2,
            },
            991: {
                items: 1,
            },
            767: {
                dots: false,
            },
        },
    });

    /*--- service-slider ---*/
    $(".owl-lazy").owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        nav: true,
        responsiveClass: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        onDragged: closeVideo,
        onChanged: closeVideo,
        autoplayHoverPause: true,
    });


    /*--- owl-book ---*/
    $(".owl-book").owlCarousel({
        items: 3,
        loop: true,
        margin: 30,
        nav: true,
        responsiveClass: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            1200: {
                items: 3,
            },
            992: {
                items: 2,
            },
            0: {
                items: 1,
            },
        },
    });

    /*--- owl-course ---*/
    $(".owl-course").owlCarousel({
        items: 4,
        loop: true,
        margin: 30,
        nav: true,
        responsiveClass: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            1400: {
                items: 3,
            },
            1200: {
                items: 2,
            },
            0: {
                items: 1,
            },
        },
    });

    /*--- award ---*/
    $(".owl-award").owlCarousel({
        items: 3,
        loop: true,
        margin: 30,
        nav: true,
        responsiveClass: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            1400: {
                items: 3,
            },
            1200: {
                items: 2,
            },
            0: {
                items: 1,
            },
        },
    });

    /*--- client ---*/
    $(".owl-client ").owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        responsiveClass: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            1200: {
                items: 4,
            },
            991: {
                items: 3,
            },
            767: {
                items: 2,
      
            },
            0: {
                items: 1,
            },
        },
    });

    /*--- testimonal ---*/
    $(".owl-test").owlCarousel({
        items: 2,
        loop: true,
        margin: 40,
        nav: true,
        responsiveClass: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            1200: {
                items: 2,
            },
            0: {
                items: 1,
            },
        },
    });

    $("#send_contact_btn").on("click", function (e) {
        e.preventDefault();
        var baseUrl = $("body").attr("data-siteurl");
        var formaction = $("#contact_form").attr("action");
        var formdata = $("#contact_form").serialize();
        $.ajax({
            url: formaction,
            method: "POST",
            data: formdata,
            beforeSend: function () {
                $("#send_contact_btn")
                    .html(
                        "<i class='fas fa-spinner fa-pulse fa-1x'></i> Submit<span><img src=" +
                            baseUrl +
                            "/frontend/images/maki_rocket.svg></span>"
                    )
                    .prop("disabled", false);
            },
            success: function (response) {
                if (response) {
                    if (response.success) {
                        $(".success_message").show();
                        // window.location.reload(true);
                    } else {
                        $(".error_message").show();
                    }
                }
                $("#send_contact_btn")
                    .html(
                        "Submit <span><img src=" +
                            baseUrl +
                            "/frontend/images/maki_rocket.svg></span>"
                    )
                    .prop("disabled", false);
                $("#contact_form")[0].reset();
                $(".error").remove();
            },
            error: function (response) {
                if (
                    typeof response.responseJSON.errors !== "" &&
                    response.responseJSON.errors
                ) {
                    $(".error").remove();
                    $.each(response.responseJSON.errors, function (key, value) {
                        var dy_class = key + "_error";
                        if ($("." + dy_class).length == 0) {
                            if (key != "accept") {
                                $("#" + key).after(
                                    "<div class='" +
                                        dy_class +
                                        " error'>" +
                                        value +
                                        "</div>"
                                );
                            } else {
                                $("#accept_extra_text").after(
                                    "<div class='" +
                                        dy_class +
                                        " error mt-2'>" +
                                        value +
                                        "</div>"
                                );
                            }
                        }
                    });
                }
                $("#send_contact_btn")
                    .html(
                        "Submit <span><img src=" +
                            baseUrl +
                            "/frontend/images/maki_rocket.svg></span>"
                    )
                    .prop("disabled", false);
            },
        }).fail(function (response) {
            $("#send_contact_btn")
                .html(
                    "Submit <span><img src=" +
                        baseUrl +
                        "/frontend/images/maki_rocket.svg></span>"
                )
                .prop("disabled", false);
        });
    });

    $(".number-decrement").click(function (e) {
        e.preventDefault();
        var qty_value = $(".input-number").val();
        qty_value = isNaN(qty_value) ? 1 : qty_value;
        qty_value--;

        if (!(qty_value < 1)) {
            $(".input-number").val(qty_value);
        }
    });

    $(".number-increment").click(function (e) {
        e.preventDefault();

        var qty_value = $(".input-number").val();
        var max_qty_value = $(".input-number").attr("max");
        qty_value = isNaN(qty_value) ? 1 : qty_value;
        qty_value++;

        if (!(qty_value > max_qty_value)) {
            $(".input-number").val(qty_value);
        }
    });

    $(".add_to_cart").click(function (e) {
        e.preventDefault();
        var cart_text = $.trim($('#main-cart-count').text());
        var cart_count = parseInt(cart_text.replace(/[^0-9.]/g, ""));
        
        var baseUrl = $("body").attr("data-siteurl");
        var qty_val = $(".input-number").val();
        var book = $(this).attr("data-book");

        if (typeof qty_val === "undefined") {
            qty_val = 1;
        }

        $.ajax({
            url: baseUrl + "/add-to-cart",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                book_title: $(this).attr("data-book_title"),
                qty_value: qty_val,
                book_price: $(this).attr("data-price"),
                book: book,
            },
            beforeSend: function () {
                $("#book-" + book)
                    .html("<i class='fas fa-spinner fa-pulse fa-1x'></i>")
                    .prop("disabled", false);
            },
            success: function (response) {
                if (response.status == 200) {
                    if (response.result == "exist") {
                        showMessage("Book exists in cart", "error");
                    } else if (response.result == "added") {
                        showMessage("Book added in cart", "success");
                    }
                    $("#book-" + book)
                        .html("Add to cart")
                        .prop("disabled", false);
                    cart_count  = cart_count + 1;

                    var cart_image = baseUrl+"/frontend/images/bag.svg";
                    var cartimage_html = "<img src='"+cart_image+"' alt='Cart'>";
                    var carttext = (cart_count > 1) ? 'Books' : 'Book';


                    $('.buy-now').html(cartimage_html+"Cart ("+cart_count+" "+carttext+")");
                } else {
                    showMessage("Server error occured", "error");
                    $("#book-" + book)
                        .html("Add to cart")
                        .prop("disabled", false);
                }
            },
            error: function (response) {
                console.log(response);
                showMessage("Sorry! Error occurred while adding", "error");
                $(".add_to_cart").html("Add to cart").prop("disabled", false);
            },
        });
    });

    $(".add_to_cart_related").click(function (e) {
        e.preventDefault();
        var baseUrl = $("body").attr("data-siteurl");
        var book = $(this).attr("data-book");

        $.ajax({
            url: baseUrl + "/add-to-cart",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                book_title: $(this).attr("data-book_title"),
                qty_value: 1,
                book_price: $(this).attr("data-price"),
                book: book,
            },
            beforeSend: function () {
                $("#book-" + book)
                    .html("<i class='fas fa-spinner fa-pulse fa-1x'></i>")
                    .prop("disabled", false);
            },
            success: function (response) {
                if (response.status == 200) {
                    if (response.result == "exist") {
                        showMessage("Book exists in cart", "error");
                    } else if (response.result == "added") {
                        showMessage("Book added in cart", "success");
                    }
                    $("#book-" + book)
                        .html("Add to cart")
                        .prop("disabled", false);
                } else {
                    showMessage("Server error occured", "error");
                    $("#book-" + book)
                        .html("Add to cart")
                        .prop("disabled", false);
                }
            },
            error: function (response) {
                console.log(response);
                showMessage("Sorry! Error occurred while adding", "error");
                $(".add_to_cart").html("Add to cart").prop("disabled", false);
            },
        });
    });

    $(".cart_qty").keyup(function () {
        var qty_id = $(this).attr("id");
        var qty = $(this).val();
        var item_key = $(this).attr("data-iteration_index");
        var book_price = $(this).attr("data-bookprice");

        if (qty === "0") {
            $(this).val("1");
        } else if (qty === "") {
            $(this).val("1");
        } else {
            var baseUrl = $("body").attr("data-siteurl");
            $.ajax({
                url: baseUrl + "/update-cart",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    item_qty: $(this).val(),
                    item_price: $(this).attr("data-bookprice"),
                    item_id: $(this).attr("data-cartitem"),
                    delivery_charge: $(".delivery_charge_cost:checked").val(),
                },
                beforeSend: function () {
                    console.log("cart is being updated");
                },
                success: function (response) {
                    $("#cart_" + item_key + "_item_subtotal").text(
                        response.data.itemSubtotal
                    );
                    $(".subtotal-amount").text(response.data.cartSubTotal);
                    $(".total-amount").text(
                        response.data.cart_total_with_delivery_charge
                    );
                    $("#cart_total_amount_value").val(
                        response.data.cart_total_with_delivery_charge_val
                    );
                    performUpdate();
                    showMessage(
                        "Success! Cart item updated successfully",
                        "success"
                    );
                },
                error: function (response) {
                    showMessage("Sorry! Cart item not updated", "error");
                },
            });
        }
    });

    if ($(".cart-delivery-section").length > 0) {
        performUpdate();
    }

    $(".cart_delivery_address").keyup(function () {
        // setTimeOut(updateCartAddress, 1000);
        updateCartAddress();
    });

    if ($(".proceed_to_checkout").length > 0) {
        $(".proceed_to_checkout").click(function (e) {
            e.preventDefault();
            var baseUrl = $("body").attr("data-siteurl");
            var cart_delivery_address = $(".cart_delivery_address").val();
            if (cart_delivery_address == "") {
                showMessage("Delivery address is empty", "error");
            } else {
                var redirect_url = $(this).attr("data-next");
                $.ajax({
                    url: baseUrl + "/update-cart-deliveryaddress",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {
                        cart_delivery_address: cart_delivery_address,
                    },
                    beforeSend: function () {},
                    success: function (response) {
                        if (
                            response.message == "cart_delivery_address_updated"
                        ) {
                            window.location.href = redirect_url;
                        }
                    },
                    error: function (response) {
                        console.log(
                            "Sorry! cart cannot be processed to checkout"
                        );
                    },
                });
            }
        });
    }
});

function updateDeliveryCharge(new_delivery_charge, delivery_charge_id) {
    var baseUrl = $("body").attr("data-siteurl");
    $.ajax({
        url: baseUrl + "/update-cart-deliverycharge",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            cart_subtotal: $(".subtotal-amount").text(),
            new_delivery_charge: new_delivery_charge,
            cart_delivery_address: $(".cart_delivery_address").val(),
        },
        beforeSend: function () {
            $("#loading-spinner").show();
            console.log("cart delivery charge is being updated");
            // $("#"+delivery_charge_id).prop("checked", true);
            // if($('.proceed_to_checkout').length > 0){
            //   if($('.proceed_to_checkout').data('next')) {
            //    var next_url  = $('.proceed_to_checkout').data('next');
            //    var url_params = $.param({selected_shipping_location:delivery_charge_id});
            //    var final_url  = next_url+"?"+url_params;
            //    console.log(final_url);
            //    $('.proceed_to_checkout').attr('data-next',final_url);
            //   }
            // }
        },
        success: function (response) {
            $(".total-amount").text(response.data.formatted_cart_total);
            console.log("Success! Cart item updated successfully");
            $("#loading-spinner").hide();
        },
        error: function (response) {
            console.log("Sorry! Cart item not updated");
            $("#loading-spinner").hide();
        },
    });
}

/*--- side menu ---*/
const pageHeader = document.querySelector(".page-header");
const openMobMenu = document.querySelector(".open-mobile-menu");
const closeMobMenu = document.querySelector(".close-mobile-menu");
const topMenuWrapper = document.querySelector(".top-menu-wrapper");

const isVisible = "is-visible";
const showOffCanvas = "show-offcanvas";
const noTransition = "no-transition";
let resize;

// Opening Mobile Menu
if (openMobMenu !== null) {
    openMobMenu.addEventListener("click", () => {
        topMenuWrapper.classList.add(showOffCanvas);
    });
}

// Closing Mobile Menu
if (closeMobMenu !== null) {
    closeMobMenu.addEventListener("click", () => {
        topMenuWrapper.classList.remove(showOffCanvas);
    });
}

// Resizing Screen
window.addEventListener("resize", () => {
    pageHeader.querySelectorAll("*").forEach(function (el) {
        el.classList.add(noTransition);
    });
    clearTimeout(resize);
    resize = setTimeout(resizingComplete, 300);
});

function resizingComplete() {
    pageHeader.querySelectorAll("*").forEach(function (el) {
        el.classList.remove(noTransition);
    });
}

/*--------------------------------------------------------------
  #Sticky Header
  --------------------------------------------------------------*/
if ($(window).width() > 1) {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1) {
            $(".header").addClass("sticky-header");
            $("body").addClass("sticky");
        } else {
            $(".header").removeClass("sticky-header");
            $("body").removeClass("sticky");
        }
    });
}
/*--------------------------------------------------------------
  #light-box
  --------------------------------------------------------------*/
document.querySelectorAll(".my-lightbox-toggle").forEach((el) =>
    el.addEventListener("click", (e) => {
        e.preventDefault();

        const lightbox = new Lightbox(el, {
            keyboard: true,
            size: "fullscreen",
        });

        //lightbox.show();
    })
);

function showMessage(msg_content, msg_type) {
    if (msg_type == "error") {
        toastr.error(msg_content, "Error", {
            closeButton: true,
            positionClass: "toast-top-right",
            progressBar: true,
            preventDuplicates: 1,
        });
    }
    if (msg_type == "success") {
        toastr.success(msg_content, "Success", {
            closeButton: true,
            positionClass: "toast-top-right",
            progressBar: true,
        });
    }
}

function updateCartAddress() {
    var cart_delivery_address = $(".cart_delivery_address").val();
    var baseUrl = $("body").attr("data-siteurl");
    $.ajax({
        url: baseUrl + "/update-cart-deliveryaddress",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            cart_delivery_address: $(this).val(),
        },
        beforeSend: function () {
            console.log("cart is being updated");
        },
        success: function (response) {
            console.log("Success! Cart item updated successfully", "success");
        },
        error: function (response) {
            showMessage("Sorry! Cart item not updated", "error");
        },
    });
}

function getDistricts(element_select, state_id) {
    var baseUrl = $("body").attr("data-siteurl");
    var getDistrictsUrl = baseUrl + "/getDistricts?state_id=" + state_id;
    $.get(
        getDistrictsUrl,
        function (data) {
            $(element_select).html(data.district_options);
        },
        "json"
    );
}

function setMode(mode) {
    var rootElement = document.getElementById("lcci-root");
    if (mode == "dark") {
        rootElement.classList.replace("light", "dark");
    } else {
        rootElement.classList.replace("dark", "light");
    }
    localStorage.setItem("mode", mode);
}

function fillShippingInput() {
    // $('#shipping_first_name').val($('#checkout_first_name').val());
    // $('#shipping_last_name').val($('#checkout_last_name').val());
    // $('#shipping_company_name').val($('#checkout_company_name').val());
    // $('#shipping_email_address').val($('#checkout_email_address').val());
    // $('#shipping_address').val($('#checkout_address').val());
}

function clearShippingInput() {
    $("#shipping_first_name").val("");
    $("#shipping_last_name").val("");
    $("#shipping_email_address").val("");
    $("#shipping_company_name").val("");
    $("#shipping_state").val("").change();
    $("#shipping_district").val("").change();
}

function performUpdate() {
    var cart_total_amount = parseInt($("#cart_total_amount_value").val());
    if (cart_total_amount > 2000) {
        $("#delivery-inside-kathmandu").prop("disabled", true);
        $("#delivery-outside-kathmandu").prop("disabled", true);
        $("#free-shipping").prop("disabled", false);
        $("#free-shipping").attr("checked", true);
    } else {
        $("#delivery-inside-kathmandu").prop("disabled", false);
        $("#delivery-outside-kathmandu").prop("disabled", false);
        $("#free-shipping").prop("disabled", true);

        if (localStorage.getItem("current_delivery_location") == null) {
            $("#delivery-inside-kathmandu").attr("checked", true);
            updateDeliveryCharge(
                $("#delivery-inside-kathmandu").val(),
                "delivery-inside-kathmandu"
            );
        } else {
            $("#" + localStorage.getItem("current_delivery_location")).attr(
                "checked",
                true
            );
            updateDeliveryCharge(
                $(
                    "#" + localStorage.getItem("current_delivery_location")
                ).val(),
                localStorage.getItem("current_delivery_location")
            );
        }

        $(".delivery_charge_cost").on("change", function () {
            updateDeliveryCharge($(this).val(), $(this).attr("id"));
            localStorage.setItem(
                "current_delivery_location",
                $(this).attr("id")
            );
        });
    }
}

function enquiry_form(selected_option_val) {
    if (selected_option_val == "1") {
        $(".yes-block").show();
        $(".no-block").hide();
        $("#institution_name").prop("disabled", false);
        $("#institution_location").prop("disabled", false);
        $("#current_programmes").prop("disabled", false);
        $("#your_field_of_interest").prop("disabled", true);

        $(".your_field_of_interest_error").remove();
    } else if (selected_option_val == "0") {
        $(".no-block").show();
        $(".yes-block").hide();
        $("#institution_name").prop("disabled", true);
        $("#institution_location").prop("disabled", true);
        $("#current_programmes").prop("disabled", true);
        $("#your_field_of_interest").prop("disabled", false);

        $(
            ".institution_name_error,.institution_location_error,.current_programmes_error"
        ).remove();
    } else {
        $(".yes-block").hide();
        $(".no-block").hide();
        $("#institution_name").prop("disabled", true);
        $("#institution_location").prop("disabled", true);
        $("#current_programmes").prop("disabled", true);
        $("#your_field_of_interest").prop("disabled", true);

        $(
            ".institution_name_error,.institution_location_error,.current_programmes_error,.your_field_of_interest_error"
        ).remove();
    }
}
// $('.modal').on('hide.bs.modal', function (e) {
//     e.stopPropagation();
//     $('body').css('padding-right','');
// });

function closeVideo(event) {
    $('#video-popup-close1').click();
    $('#video-popup-iframe1').attr("src", "");
    $('.owl-lazy').trigger('play.owl.autoplay',[5000]);
}


