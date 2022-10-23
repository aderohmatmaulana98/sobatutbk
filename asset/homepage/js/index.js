$(document).ready(function () {
    $("#rr1").click(function () {
        $("#rr1").addClass("kelompok-active");
        $("#rr2").removeClass("kelompok-active");
        $("#rr3").removeClass("kelompok-active");
    });
    $("#rr2").click(function () {
        $("#rr2").addClass("kelompok-active");
        $("#rr1").removeClass("kelompok-active");
        $("#rr3").removeClass("kelompok-active");
    });
    $("#rr3").click(function () {
        $("#rr3").addClass("kelompok-active");
        $("#rr1").removeClass("kelompok-active");
        $("#rr2").removeClass("kelompok-active");
    });
});

if ($(window).width() > 992) {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 55) {
            $('#navbar_top').addClass("fixed-top");
            // add padding top to show content behind navbar
            $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
        } else {
            $('#navbar_top').removeClass("fixed-top");
            // remove padding top from body
            $('body').css('padding-top', '0');
        }
    });
}

$(document).ready(function () {

    $(".CS").click(function () {
        alert("Coming Soon");
    });

    len_fag = $('#jml-fag').attr('name');
    // console.log("aa" + len_fag);

    for (i = 1; i <= len_fag; i++) {
        // console.log('#quest' + i);
        // console.log('#answer' + i);
        // $("#quest" + i).click(function () {
        // $("#answer" + i).slideToggle("slow", "linear");
        // });
    }

    // $("#quest2").click(function () {
    //     $(".answer2").slideToggle("slow", "linear");
    // });

    // $("#quest3").click(function () {
    //     $(".answer3").slideToggle("slow", "linear");
    // });

    // $("#quest4").click(function () {
    //     $(".answer4").slideToggle("slow", "linear");
    // });

    // $("#quest5").click(function () {
    //     $(".answer5").slideToggle("slow", "linear");
    // });

    // $("#quest6").click(function () {
    //     $(".answer6").slideToggle("slow", "linear");
    // });

    // $("#quest7").click(function () {
    //     $(".answer7").slideToggle("slow", "linear");
    // });

    // $("#quest8").click(function () {
    //     $(".answer8").slideToggle("slow", "linear");
    // });

    // $("#quest9").click(function () {
    //     $(".answer9").slideToggle("slow", "linear");
    // });

    // $("#quest10").click(function () {
    //     $(".answer10").slideToggle("slow", "linear");
    // });

    // $("#quest11").click(function () {
    //     $(".answer11").slideToggle("slow", "linear");
    // });

    // $("#quest12").click(function () {
    //     $(".answer12").slideToggle("slow", "linear");
    // });

    // $("#quest13").click(function () {
    //     $(".answer13").slideToggle("slow", "linear");
    // });

    // $("#quest14").click(function () {
    //     $(".answer14").slideToggle("slow", "linear");
    // });

    // $("#quest15").click(function () {
    //     $(".answer15").slideToggle("slow", "linear");
    // });

    // $("#quest16").click(function () {
    //     $(".answer16").slideToggle("slow", "linear");
    // });

});