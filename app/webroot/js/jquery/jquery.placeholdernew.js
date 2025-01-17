/*!
 * 'addPlaceholder' Plugin for jQuery
 *
 * @author Ilia Draznin
 * @link http://iliadraznin.com/2011/02/jquery-placeholder-plugin/
 * @created 19-02-2011
 * @updated 06-04-2011
 * @version 1.0.3
 *
 * Description:
 * jQuery plugin that adds "placeholder" functionality (like in Chrome) to browsers that 
 * don't support it natively (like Firefox 3.6 or lower, or IE naturally)
 * 
 * Usage:
 * $(selector).addPlaceholder(options);
 */ (function (d) {
    var g = document.createElement("input");
    d.extend(d.support, {
        placeholder: !! ("placeholder" in g)
    });
    d.fn.addPlaceholder = function (g) {
        function h(a, c) {
            if (f(a.val()) || a.val() == c) a.val(c), a.addClass(b["class"]);
            a.focusin(function () {
                a.hasClass(b["class"]) && (a.removeClass(b["class"]), a.val(""))
            });
            a.focusout(function () {
                f(a.val()) && (a.val(c), a.addClass(b["class"]))
            })
        }
        function i(a, c) {
            a.addClass(b["class"]);
            var e = d("<span/>", {
                "class": a.attr("class") + " " + b["class"],
                text: c,
                css: {
                    border: "none",
                    cursor: "text",
                    background: "transparent",
                    position: "absolute",
                    top: a.position().top,
                    left: a.position().left,
                    lineHeight: a.height() + 3 + "px",
                    paddingLeft: parseFloat(a.css("paddingLeft")) + 2 + "px"
                }
            }).insertAfter(a);
            a.focusin(function () {
                a.hasClass(b["class"]) && (e.hide(), a.removeClass(b["class"]))
            });
            a.focusout(function () {
                f(a.val()) && (e.show(), a.addClass(b["class"]))
            });
            b.checkafill && function j() {
                !f(a.val()) && a.hasClass(b["class"]) && a.focusin();
                setTimeout(j, 250)
            }()
        }
        function f(a) {
            return b.allowspaces ? a === "" : d.trim(a) === ""
        }
        var b = {
            "class": "placeholder",
            allowspaces: !1,
            dopass: !0,
            dotextarea: !0,
            checkafill: !1
        };
        return this.each(function () {
            if (d.support.placeholder) return !1;
            d.extend(b, g);
            if (!(this.tagName.toLowerCase() == "input" || b.dotextarea && this.tagName.toLowerCase() == "textarea")) return !0;
            var a = d(this),
                c = this.getAttribute("placeholder"),
                e = a.is("input[type=password]");
            if (!c) return !0;
            b.dopass && e ? i(a, c) : e || h(a, c)
        })
    }
})(jQuery);