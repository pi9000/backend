var config;
var data = { _token: $('meta[name="csrf-token"]').attr("content") };

function ajaxGetTotal(url, id) {
    $.post(url, data, function (d) {
        var comma_separator_number_step =
            $.animateNumber.numberStepFactories.separator(",");
        $(`#${id}`).animateNumber({
            number: d,
            numberStep: comma_separator_number_step,
        });
    });
}

Number.prototype.format = function (n, x) {
    var re = "\\d(?=(\\d{" + (x || 3) + "})+" + (n > 0 ? "\\." : "$") + ")";
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, "g"), "$&,");
};

// function _get_lastest_data() {
//     $.post('/_get_latest', data, function (d) {
//         if (d == "user_session_over") {
//             _detect_multiple_login();
//         } else if (d == 'session_timeout') {
//             location.href = '/';
//         } else {
//             $('.__api_credit_balance').html(d.balance);
//             if (d.promo || d.actions || d.instant) {
//                 $('.notify').html(`<span class="heartbit"></span> <span class="point"></span>`);
//                 if (d.promo || d.instant) {
//                     $('#__notification').addClass("show");
//                     $('.mailbox').addClass("show");
//                 }
//             } else {
//                 $('.notify').html(``);
//                 $('#__notification').removeClass("show");
//                 $('.mailbox').removeClass("show");
//             }

//             $('#__promo').html(d.promo ? d.promo : '');
//             $('#__bonus').html(d.bonus ? d.bonus : '');
//             $('#__action').html(d.actions ? d.actions : '');
//             $('#__instant').html(d.instant ? d.instant : '');
//             $('#__referral_activation').html(d.referral_activation ? d.referral_activation : '');
//             $('#__transalert').html(d.high_trans_count ? d.high_trans_count : '');

//         }
//     });
// }

$.validator.methods.number = function (value, element) {
    return (
        this.optional(element) ||
        /^-?(?:\d+|\d{1,3}(?:[\s\.,]\d{3})+)(?:[\.,]\d+)?$/.test(value)
    );
};

$.validator.addMethod(
    "sum",
    function (value, element, params) {
        var sumOfVals = 0;
        var parent = $(element).parent().parent();
        $(parent)
            .find("select.group")
            .each(function () {
                sumOfVals =
                    sumOfVals + parseInt($("option:selected", this).html());
            });
        if (sumOfVals <= params) return true; //can be 100 or less
        return false;
    },
    jQuery.validator.format("Total of PT must be less or equel than {0} %")
);

$.validator.addMethod(
    "pwcheck",
    function (value) {
        return /((?=.*[a-zA-Z])|(?=.*[~!@#$%^&*()_\-]))((?=.*[0-9])|(?=.*[~!@#$%^&*()_\-]))(.*[ ,.a-zA-Z\d~!@#$%^&*()_+]){8,50}/.test(
            value
        ); // consists of only these
    },
    jQuery.validator.format("Invalid Password requirement")
);

function onKeyUpAddComma(name, e) {
    let val = e.value.replace(/\D/g, ``);
    if (val == undefined || val == NaN || val == "") {
        val = 0;
    }
    $(name).val(val);
    $(name).keydown();
    $(name).keypress();
    $(name).keyup();
    return (e.value = parseInt(val)
        .toFixed(0)
        .replace(/\B(?=(\d{3})+(?!\d))/g, `,`));
}

toastMessage = (title, text, color, icon) => {
    $.toast({
        heading: title,
        text: text,
        position: "top-center",
        loaderBg: color,
        icon: icon,
        hideAfter: 3500,
        stack: 6,
    });
};

let allowPlay = false;

document.addEventListener("click", () => {
    allowPlay = true;
});

function call_get_latest() {
    var pause = false;
    var get_latest = $.post("/_get_latest", data, function (d) {
        $(".__api_credit_balance").html(d.balance);
        if (d.instant_withd || d.actions || d.instant_depo) {
            $(".notify").html(
                `<span class="heartbit"></span> <span class="point"></span>`
            );
            if (allowPlay) {
                const audio = document.getElementById("notifSound");
                audio.currentTime = 0;
                audio.play().catch((err) => console.warn("Blocked:", err));
            }
            $("#__notification").addClass("show");
            $(".mailbox").addClass("show");
        } else {
            $(".notify").html(``);
            $("#__notification").removeClass("show");
            $(".mailbox").removeClass("show");
        }

        $("#__action").html(d.actions ? d.actions : "");
        $("#__instant_depo").html(d.instant_depo ? d.instant_depo : "");
        $("#__instant_withd").html(d.instant_withd ? d.instant_withd : "");

        if (typeof reloadtransaction == "function") {
            reloadtransaction();
        }
    });
    if (!pause) {
        get_latest.done(function (data) {
            setTimeout(call_get_latest, 60000); // recursion
        });
    }
}

$(document).ready(function () {
    $(window).on("load resize", function () {
        let nav_height = $(".topbar").height();
        $(".left-sidebar").css({
            top: "auto",
            "padding-top": nav_height + "px",
        });
    });

    setTimeout(() => {
        call_get_latest();
    }, 1000);

    $(".first-button").on("click", function () {
        $(".animated-icon1").toggleClass("open");
        $(".fix-sidebar").toggleClass("show-sidebar");
    });
    counts = 0;

    // counts = 0;

    // $(window).on('click', function () {
    //     if (counts > 5) {
    //         _get_lastest_data();
    //     }
    //     if (counts > 10) {
    //         _get_lastest_promotion_actionlog_data();
    //     }
    //     counts = 0;
    //     window.pause = false;

    // })
});

var _detect_multiple_login = function () {
    var closeInSeconds = 5,
        displayText = "close in #1 seconds..",
        timer;

    swal({
        title: "Multiple Login Detected!",
        text: displayText.replace(/#1/, closeInSeconds),
        icon: "error",
        allowOutsideClick: false,
        closeOnClickOutside: false,
        button: "Okay",
        timer: closeInSeconds * 1000,
    }).then((willVerify) => {
        if (willVerify) {
            location.reload(true);
        } else {
            location.reload(true);
        }
    });

    timer = setInterval(function () {
        closeInSeconds--;

        if (closeInSeconds < 0) {
            clearInterval(timer);
        }
        $(".swal-modal > .swal-text").text(
            displayText.replace(/#1/, closeInSeconds)
        );
    }, 1000);
};

$("#__notification_close").click(function () {
    // alert('test');
    $("#__notification .dropdown-menu").removeClass("show");
});

// intervallog = setInterval(checklogout, 6000);
// function checklogout() {
//     counts++;
//     console.log(counts, window.pause);

//     if (counts == 5) {
//         window.pause = true;
//     }

function playSound() {
    const audio = document.getElementById("notifSound");
    audio.play();
}
