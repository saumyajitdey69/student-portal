function hide_questions() {
    $(".faculty_feedback_div").hide();
    $("#feedback_comments_faculty").hide();
    $("#feedback_comments_course").hide();
    $("#t_submit").hide();
    $(".select-row").closest("tr").hide();
    $("#t1").closest("tr").show();
}
$(".select-row").on("change", function () {
    if ($(this).val() === "") {
        return;
    }
    var a = $(this).closest("tr");
    if (a.is($("#feedback_course tbody tr").last())) {
        $("#feedback_comments_course").show();
        $(".faculty_feedback_div").show();
        $("#t16").closest("tr").show();
        return;
    }
    if (a.is($("#feedback_faculty tbody tr").last())) {
        $("#feedback_comments_faculty").show();
        $("#t_submit").show();
        return;
    }
    
    a.next().show();
    
    //a.next().find("select").focus();
});
var new_course_click = function () {
    var b = $(this).find(":nth-child(2)").html();
    var c = $(this).find(":nth-child(3)").html();
    // if ($(this).data("alloted") === 0) {
    //     return 0;
    // }
    if ($(this).data("status") == "1") {
        return 0;
    }
    $("#tabs tbody tr").removeClass("selected_course");
    $(this).addClass("selected_course");
    var d = $(this).data("cfid");
    var a = $(this).find(":nth-child(4)").html();
    clear_form();
    hide_questions();
    $("#course-id").html(b);
    $("#course-name").html(c);
    $("#faculty-name").html(a);
    $("#tabs").hide();
    $("#t_img").hide();
    $(".breadcrumb").show();
    $("#navigation").show();
    $("#ques_theory").show();
    return 1;
};
$(".course_row").click(new_course_click);
$(".list").click(function () {
    $("#tabs tbody tr").removeClass("selected_course");
    $("#navigation").hide();
    $("#ques_theory").hide();
    $(".breadcrumb").hide();
    $("#tabs").show()
});
$(".next").click(function () {
    var b = $("#tabs tbody");
    var a = b.find(".selected_course");
    while (true) {
        if (a.is(b.find("tr").last())) {
            a.removeClass("selected_course");
            $(".list").triggerHandler("click");
            break;
        }
        var c = a.next();
        if (c.data("status") == "0" && c.data("alloted") == "1") {
            c.triggerHandler("click");
            break
        }
        a = c;
    }
});
$(".previous").click(function () {
    var b = $("#tabs tbody");
    var a = b.find(".selected_course");
    while (true) {
        if (a.is(b.find("tr").first())) {
            a.removeClass("selected_course");
            $(".list").triggerHandler("click");
            break;
        }
        var c = a.prev();
        if (c.data("status") == "0" && c.data("alloted") == "1") {
            c.triggerHandler("click");
            break;
        }
        a = c;
    }
});

function scrollup() {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
}
$("#t_submit").click(function () {
    if (spell_check() == false) {
        show_error("Please check the comments field again.");
        return;
    }
    value = "";
    cfid = $("#tabs .selected_course").data("cfid");
    questions = $("#tabs .table-hover").data("questions");
    comment_size = $("#tabs .table-hover").data("commentsize");
    course_id=$("#course-id").html();
    course_name=$("#course-name").html();
    credits= $("#tabs .selected_course").data("credits");
    type= $("#tabs .selected_course").data("type");
    sec= $("#tabs .selected_course").data("sec");
    faculty_id= $("#tabs .selected_course").data("faculty-id");
    faculty_name=$("#faculty-name").html();
    var a = [];
    for (i = 1; i <= comment_size; i++) {
        if ($("#comment" + i).val() !== "") {
            a.push({
                type: i,
                content: $("#comment" + i).val()
            })
        }
    }
    for (i = 1; i <= questions; i++) {
        if ($("#t" + i + " option:selected").val() === "") {
            show_error("All questions are mandatory.");
            return;
        }
        value = value + $("#t" + i + " option:selected").val();
    }
    $.ajax({
        type: "POST",
        url: "feedback/submit_feedback",
        data: {
            value: value,
            cfid: cfid,
            comment: a,
            status: get_status(),
            course_id:course_id,
            course_name:course_name,
            type:type,
            credits:credits,
            sec:sec,
            faculty_name:faculty_name,
            faculty_id:faculty_id
        },
        beforeSend: function (b) {
            $("#t_submit").hide();
            $("#t_img").show()
        },
        success: function (d, e, c) {
            if(d==2){
                show_error("All questions are mandatory.");
                return;
            }
            if (d == 0) {
                show_error("Feedback not submitted.Please try again later.");
                return;
            }
            show_success("Feedback Recorded Successfully");
            $("#tabs .selected_course").data("status", "1");
            var b = $("#tabs .selected_course :nth-child(5)");
            b.find(":nth-child(1)").removeClass("glyphicon glyphicon-remove");
            b.find(":nth-child(1)").addClass("glyphicon glyphicon-ok");
            b.find(":nth-child(1)").attr("title", "Feedback submitted");
            b.removeClass("text-danger");
            b.addClass("text-success");
            $(".next").trigger("click")
        },
        error: function (b) {}
    });
    $("#t_img").hide();
    $("#t_submit").show();
    scrollup();
});

function clear_form() {
    for (i = 1; i <= 4; i++) {
        $("#comment" + i).val("")
    }
    questions = $("#tabs .table-hover").data("questions");
    for (i = 1; i <= questions; i++) {
        $("#t" + i).prop("selectedIndex", 0)
    }
}

function get_status() {
    listitem = $("#tabs tbody tr");
    i = 0;
    for (; i < listitem.length; i++) {
        if ($("#tabs .selected_course").is(listitem[i])) {
            break
        }
    }
    return i
}
function spell_check() {
    for (i = 1; i < 4; i++) {
        var a = $("#comment" + i).val().split(" ");
        for (j = 0; j < a.length; j++) {
            if (!$Spelling.BinSpellCheck(a[j])) {
                return false;
            }
        }
    }
    return true;
}

function show_error(a) {
    $("#info_div span").html(a);
    $("#info_div").show();
    setTimeout(function(){$("#info_div_success").hide();},3000);
    scrollup();
}
function show_success(a) {
    $("#info_div_success span").html(a);
    $("#info_div_success").show();
    setTimeout(function(){$("#info_div_success").hide();},4000);
    scrollup();
}
$Spelling.SpellCheckAsYouType("comment1");
$Spelling.SpellCheckAsYouType("comment2");
$Spelling.SpellCheckAsYouType("comment3");
$Spelling.SpellCheckAsYouType("comment4");
$(document).ready(function () {
    var inputs = $('input, textarea, select, button');
    inputs.on('keydown', function (e) {
        if (e.keyCode == 9 || e.which == 9) {
            e.preventDefault();
        }
    });
    Object.defineProperty(console, '_commandLineAPI', {
        get: function () {
            throw 'Don\'t run javascript.'
        }
    })
});