!function (e) {
    function t(t) {
        for (var o, r, l = t[0], s = t[1], c = t[2], m = 0, u = []; m < l.length; m++) r = l[m], Object.prototype.hasOwnProperty.call(a, r) && a[r] && u.push(a[r][0]), a[r] = 0;
        for (o in s) Object.prototype.hasOwnProperty.call(s, o) && (e[o] = s[o]);
        for (d && d(t); u.length;) u.shift()();
        return i.push.apply(i, c || []), n()
    }

    function n() {
        for (var e, t = 0; t < i.length; t++) {
            for (var n = i[t], o = !0, l = 1; l < n.length; l++) {
                var s = n[l];
                0 !== a[s] && (o = !1)
            }
            o && (i.splice(t--, 1), e = r(r.s = n[0]))
        }
        return e
    }

    var o = {}, a = {0: 0}, i = [];

    function r(t) {
        if (o[t]) return o[t].exports;
        var n = o[t] = {i: t, l: !1, exports: {}};
        return e[t].call(n.exports, n, n.exports, r), n.l = !0, n.exports
    }

    r.m = e, r.c = o, r.d = function (e, t, n) {
        r.o(e, t) || Object.defineProperty(e, t, {enumerable: !0, get: n})
    }, r.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
    }, r.t = function (e, t) {
        if (1 & t && (e = r(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (r.r(n), Object.defineProperty(n, "default", {
            enumerable: !0,
            value: e
        }), 2 & t && "string" != typeof e) for (var o in e) r.d(n, o, function (t) {
            return e[t]
        }.bind(null, o));
        return n
    }, r.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return r.d(t, "a", t), t
    }, r.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, r.p = "/";
    var l = window.webpackJsonp = window.webpackJsonp || [], s = l.push.bind(l);
    l.push = t, l = l.slice();
    for (var c = 0; c < l.length; c++) t(l[c]);
    var d = s;
    i.push([1, 1]), n()
}([, function (e, t, n) {
    "use strict";
    n.r(t);
    n(2), n(3), n(5), n(7)
}, function (e, t) {
    if (document.addEventListener("DOMContentLoaded", (function () {
        var e = document.body, t = document.querySelectorAll(".products__link.drop"),
            n = document.querySelectorAll(".nav__item.drop"), o = document.getElementsByClassName("faq__item"),
            a = window.innerWidth;
        window.addEventListener("resize", (function (n) {
            a = window.innerWidth, u(a >= 768), h(a >= 1250), p(a >= 768);
            for (var o = 0; o < t.length; ++o) t[o].parentElement.classList.remove("visible");
            e.classList.remove("phone-visible"), e.classList.remove("nav-visible"), i.classList.remove("city-select-visible")
        }));
        document.getElementById("headerPhoneBtn").addEventListener("click", (function () {
            e.classList.toggle("phone-visible"), e.classList.remove("nav-visible"), s()
        }));
        document.getElementById("navTgglr").addEventListener("click", (function () {
            e.classList.toggle("nav-visible"), e.classList.remove("phone-visible"), s()
        }));
        var i = document.getElementById("region");
        i.addEventListener("click", (function (t) {
            t.target.closest("#region") && i.classList.toggle("city-select-visible"), e.classList.remove("phone-visible"), e.classList.remove("nav-visible"), s()
        }));
        for (var r = document.querySelectorAll(".region__item"), l = 0; l < r.length; l++) r[l].addEventListener("click", (function (e) {
            var t = e.target.closest(".region__item");
            document.getElementById("regionCity").innerHTML = t.dataset.regionCity ? t.dataset.regionCity : e.target.closest(".region__item").dataset.regionCity, document.querySelector(".region__item.active").classList.remove("active"), t.classList.add("active")
        }));
        var s = function () {
                for (var e = 0; e < t.length; ++e) t[e].parentElement.classList.remove("visible");
                for (var o = 0; o < n.length; ++o) n[o].classList.remove("visible")
            }, c = document.getElementById("cart"), d = document.getElementById("headerBottom"),
            m = document.getElementById("headerTop").firstChild, u = function (e) {
                e ? m.appendChild(c) : d.appendChild(c)
            };
        u(a >= 768);
        var v = document.getElementById("operating"), p = function (t) {
            t ? d.appendChild(v) : e.prepend(v)
        };
        p(a >= 768);
        var f = document.getElementById("headerBottomContainer"), g = document.getElementById("headerTopNav"),
            y = document.getElementById("nav"), b = document.getElementById("prodContainer"),
            L = document.getElementById("navContainer"), h = function (e) {
                e ? (b.appendChild(y), L.appendChild(g)) : (y.appendChild(g), f.prepend(y))
            };
        if (h(a >= 1250), a <= 1250) {
            for (var E = 0; E < t.length; ++E) t[E].addEventListener("click", (function (e) {
                e.preventDefault();
                var t = e.target.parentElement.classList, n = t.contains("visible");
                s(), n ? t.remove("visible") : t.add("visible")
            }));
            for (var k = 0; k < n.length; ++k) n[k].addEventListener("click", (function (e) {
                var t = e.target.classList, n = t.contains("visible");
                s(), n ? t.remove("visible") : t.add("visible")
            }))
        }
        var I = function () {
            for (var e = 0; e < o.length; ++e) o[e].classList.remove("visible")
        };
        if (o.length > 0) for (var C = 0; C < o.length; ++C) o[C].addEventListener("click", (function (e) {
            var t = e.target.closest("li"), n = t.classList.contains("visible");
            I(), n ? t.classList.remove("visible") : t.classList.add("visible")
        }));
        for (var _ = document.querySelectorAll(".label_file input"), S = function (e) {
            var t = _[e].nextElementSibling;
            _[e].addEventListener("change", (function (e) {
                t.innerHTML = e.target.value.split("\\").pop()
            }))
        }, w = 0; w < _.length; w++) S(w);
        for (var B = document.getElementsByClassName("btn-modal"), O = function (t, n) {
            n ? (e.classList.add("modal-open"), t.classList.add("show")) : (e.classList.remove("modal-open"), t.classList.remove("show"))
        }, H = 0; H < B.length; H++) B[H].addEventListener("click", (function (e) {
            e.preventDefault();
            var t = e.target.dataset.modalId, n = document.getElementById(t);
            n && (n.querySelector(".modal__close").addEventListener("click", (function () {
                return O(n, !1)
            })), n.addEventListener("click", (function (e) {
                e.target.id === t && O(n, !1)
            })), O(n, !0))
        }));
        var P = document.querySelector(".description__toggler");
        if (P) {
            var M = P.closest(".description");
            P.addEventListener("click", (function () {
                M.classList.toggle("show"), "Развернуть" === P.innerHTML ? P.innerHTML = "Свернуть" : P.innerHTML = "Развернуть"
            }))
        }
        document.addEventListener("click", (function (e) {
            e.target.parentElement.closest("#region") || i.classList.remove("city-select-visible")
        }));
        for (var q = document.querySelectorAll(".sml-img-slider__item"), j = 0; j < q.length; j++) q[j].addEventListener("click", (function (e) {
            var t = e.target;
            if (t.classList.contains("back")) {
                var n = t.previousElementSibling, o = t.nextElementSibling, a = t.parentElement;
                o ? (n.classList.remove("front"), t.classList.remove("back"), t.classList.add("front"), o.classList.add("back"), a.append(n)) : (n.classList.remove("front"), n.classList.add("back"), t.classList.remove("back"), t.classList.add("front"), a.append(n))
            }
        }));
        for (var z = document.querySelectorAll(".breakstone__accordion-caption"), T = document.querySelectorAll(".breakstone__accordion-content"), x = function () {
            for (var e = 0; e < z.length; e++) z[e].classList.remove("active"), T[e].classList.remove("visible")
        }, A = 0; A < z.length; A++) z[A].addEventListener("click", (function (e) {
            var t = e.target, n = t.dataset.captionMark,
                o = t.parentElement.querySelector('[data-caption-for="'.concat(n, '"]'));
            t.classList.contains("active") || x(), t.classList.toggle("active"), o.classList.toggle("visible")
        }))
    })), Element.prototype.closest || (Element.prototype.closest = function (e) {
        for (var t = this; t;) {
            if (t.matches(e)) return t;
            t = t.parentElement
        }
        return null
    }), Element.prototype.matches || (Element.prototype.matches = Element.prototype.matchesSelector || Element.prototype.webkitMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector), [Element.prototype, Document.prototype, DocumentFragment.prototype].forEach((function (e) {
        e.hasOwnProperty("prepend") || Object.defineProperty(e, "prepend", {
            configurable: !0,
            enumerable: !0,
            writable: !0,
            value: function () {
                var e = Array.prototype.slice.call(arguments), t = document.createDocumentFragment();
                e.forEach((function (e) {
                    var n = e instanceof Node;
                    t.appendChild(n ? e : document.createTextNode(String(e)))
                })), this.insertBefore(t, this.firstChild)
            }
        })
    })), document.getElementById("map")) {
        ymaps.ready((function () {
            var e = new ymaps.Map("map", {center: [55.38046857198313, 41.687034406250014], zoom: 6, controls: []}),
                t = new ymaps.Placemark([56.179510068572036, 44.15730749999993], {
                    balloonContentHeader: "Кстовский филиал",
                    balloonContentBody: "г. Кстово, ул. Магистральная, д. 1"
                }, {
                    iconLayout: "default#image",
                    iconImageHref: "/img/mark.png",
                    iconImageSize: [36, 43],
                    iconImageOffset: [-15, -43]
                }), n = new ymaps.Placemark([52.60358425779388, 39.59623749999995], {
                    balloonContentHeader: "Липецкий филиал",
                    balloonContentBody: "г. Липецк, район Цемзавода, 398027"
                }, {
                    iconLayout: "default#image",
                    iconImageHref: "/img/mark.png",
                    iconImageSize: [36, 43],
                    iconImageOffset: [-15, -43]
                }), o = new ymaps.Placemark([56.00991906873449, 37.436966], {
                    balloonContentHeader: "Гранитстрой",
                    balloonContentBody: "г. Лобня, Краснополянский проезд, д. 5"
                }, {
                    iconLayout: "default#image",
                    iconImageHref: "/img/mark.png",
                    iconImageSize: [36, 43],
                    iconImageOffset: [-15, -43]
                }), a = new ymaps.Placemark([56.86988406782098, 60.59384549999995], {
                    balloonContentHeader: "ООО «СтройРегион-Трейд ЕК»",
                    balloonContentBody: "г. Екатеринбург, ул. Артинская, д. 18"
                }, {
                    iconLayout: "default#image",
                    iconImageHref: "/img/mark.png",
                    iconImageSize: [36, 43],
                    iconImageOffset: [-15, -43]
                }), i = new ymaps.Placemark([55.77380806896347, 37.50681899999997], {
                    balloonContentHeader: "Москва: ЖБИ АО «Евробетон»",
                    balloonContentBody: "г. Москва, 3-й Силикатный проезд, д. 10 , стр. 15"
                }, {
                    iconLayout: "default#image",
                    iconImageHref: "/img/mark.png",
                    iconImageSize: [36, 43],
                    iconImageOffset: [-15, -43]
                }), r = new ymaps.Placemark([55.88525156886214, 37.62130049999999], {
                    balloonContentHeader: "Филиала Медведково АО «ЕВРОБЕТОН»",
                    balloonContentBody: "ул. Чермянская, д.5"
                }, {
                    iconLayout: "default#image",
                    iconImageHref: "/img/mark.png",
                    iconImageSize: [36, 43],
                    iconImageOffset: [-15, -43]
                });
            e.geoObjects.add(t).add(n).add(o).add(i).add(r).add(a), e.controls.add("zoomControl", {size: "small"}), e.behaviors.disable("scrollZoom")
        }))
    }
}, , , , , function (e, t, n) {
    var o = n(8);
    "string" == typeof o && (o = [[e.i, o, ""]]);
    var a = {insert: "head", singleton: !1};
    n(0)(o, a);
    o.locals && (e.exports = o.locals)
}, function (e, t, n) {
}]);