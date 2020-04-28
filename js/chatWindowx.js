var t = function (t, e, n, a, c) {
    return (e /= c) < 1 / 2.75 ? a * (7.5625 * e * e) + n : e < 2 / 2.75 ? a * (7.5625 * (e -= 1.5 / 2.75) * e + .75) + n : e < 2.5 / 2.75 ? a * (7.5625 * (e -= 2.25 / 2.75) * e + .9375) + n : a * (7.5625 * (e -= 2.625 / 2.75) * e + .984375) + n
};

function e(e, n, a, c, o) {
    var r = (new Date).getTime(),
        l = setInterval(function () {
            var u = (new Date).getTime(),
                m = 1 - (Math.max(0, r +
                    a - u) / a || 0);
            r + a < u && clearInterval(l);
            var f = t(null, a * m, 0, 1,
                    a),
                i = (o - c) * f + c;
            e.style[n] = i + "px"
        }, 1)
}
var n =
    document.getElementById("contactform"),
    a = !1;
document.getElementById("contact-button").onclick = function () {
    a ? (e(n, "left", 800, 0, -405), a = !1) : (e(n, "left", 800, -405, 0), a = !0)
}
