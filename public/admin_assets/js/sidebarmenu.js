$((function() {
    "use strict";
    var s = window.location + "",
        i = s.replace(window.location.protocol + "//" + window.location.host + "/", ""),
        a = $("ul#sidebarnav a").filter((function() {
            return this.href === s || this.href === i
        }));
    a.parentsUntil(".sidebar-nav").each((function(s) {
        if($(this).is("li") && 0 !== $(this).children("a").length) {
            if($(this).children("a").addClass("active"), 0 === $(this).parent("ul#sidebarnav").length)  {
                $(this).addClass("active");
            } else {
                 $(this).removeClass("selected");
            }
        } else {
            if($(this).is("ul") || 0 !== $(this).children("a").length) {
                $(this).is("ul") && $(this).addClass("in");
            } else {
                $(this).removeClass("selected");
            }
        }
    })), a.addClass("active"), $("#sidebarnav a").on("click", (function(s) {
        $(this).hasClass("active") ? $(this).hasClass("active") && ($(this).removeClass("active"), $(this).parents("ul:first").removeClass("active"), $(this).next("ul").removeClass("in")) : ($("ul", $(this).parents("ul:first")).removeClass("in"), $("a", $(this).parents("ul:first")).removeClass("active"), $(this).next("ul").addClass("in"), $(this).addClass("active"))
    })), $("#sidebarnav >li >a.has-arrow").on("click", (function(s) {
        s.preventDefault()
    }))
    $(".has-arrow").removeClass("active");
}));