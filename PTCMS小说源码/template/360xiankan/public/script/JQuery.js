      $(function(){
        var imglist =document.getElementsByTagName("img");  //安卓4.0+等高版本不支持window.screen.width，安卓2.3.3系统支持
        var _width,
            _height;
        doDraw();
        window.onresize = function(){
          doDraw();
        }
        function doDraw(){
          _width = window.innerWidth-50;
          _height = window.innerHeight - 20;
          for( var i = 0, len = imglist.length; i< len; i++){
            DrawImage(imglist[i],_width,_height);
          }
        }
        function DrawImage(ImgD,_width,_height){
          var image=new Image();
          image.src=ImgD.src;
          image.onload = function(){
            if(image.width>30 && image.height>30){
              if(image.width/image.height>= _width/_height){
                if(image.width>_width){
                  ImgD.width=_width;
                  ImgD.height=(image.height*_width)/image.width;
                }else{
                  ImgD.width=image.width;
                  ImgD.height=image.height;
                }
              }else{
                if(image.height>_height){
                  ImgD.height=_height;
                  ImgD.width=(image.width*_height)/image.height;
                }else{
                  ImgD.width=image.width;
                  ImgD.height=image.height;
                }
              }
            }
          }
        }
      })
function(t) {
    function n(o) {
        if (e[o]) return e[o].exports;
        var i = e[o] = {
            exports: {},
            id: o,
            loaded: !1
        };
        return t[o].call(i.exports, i, i.exports, n),
        i.loaded = !0,
        i.exports
    }
    var e = {};
    return n.m = t,
    n.c = e,
    n.p = "",
    n(0)
} ([function(t, n, e) {
    t.exports = e(8)
},
, 
function(t, n, e) {
    function o(t) {
        var n,
        e = [],
        o = encodeURIComponent;
        for (n in t) e.push(o(String(n)) + "=" + o(String(t[n])));
        return e.join("&")
    }
    function i(t) {
        var n = t || location.search.substr(1),
        e = {};
        return n.split("&").forEach(function(t) {
            var n = t.split("=");
            e[n[0]] = decodeURIComponent(n[1])
        }),
        e
    }
    function a(t, n) {
        var n = n || window.location.href.split("#")[0],
        e = "object" == typeof t ? o(t) : t;
        return n += (n.split("?")[1] ? "&": "?") + e
    }
    function r() {
        for (var t, n, e, o = !1, i = ["webkit", "Moz", "O", ""], a = i.length, r = document.documentElement.style; a--;) if (i[a]) {
            if (void 0 !== r[i[a] + "AnimationName"]) {
                switch (t = i[a], a) {
                case 0:
                    n = t.toLowerCase() + "AnimationStart",
                    e = t.toLowerCase() + "AnimationEnd",
                    o = !0;
                    break;
                case 1:
                    n = "animationstart",
                    e = "animationend",
                    o = !0;
                    break;
                case 2:
                    n = t.toLowerCase() + "animationstart",
                    e = t.toLowerCase() + "animationend",
                    o = !0
                }
                break
            }
        } else if (void 0 !== r.animationName) {
            t = i[a],
            n = "animationstart",
            e = "animationend",
            o = !0;
            break
        }
        return {
            supported: o,
            prefix: t,
            start: n,
            end: e
        }
    }
    function s(t, n, e) {
        f.removeClass("msg-on");
        var o = $("#msg-cnt");
        o.length || ($('<div id="msg-cnt" class="msg-cnt"></div>').appendTo(f), o = $("#msg-cnt")),
        n ? o.attr("class", "msg-cnt msg-type-" + n) : o.attr("class", "msg-cnt"),
        o.html("<span>" + t + "</span>").off("animationend"),
        f.addClass("msg-on");
        var e = e;
        window.setTimeout(function() {
            f.removeClass("msg-on"),
            e && e()
        },
        1e3)
    }
    function c(t) {
        window.location = h + "?dest=" + encodeURIComponent(t || location.href)
    }
    function d() {
        if (!window._hmt) {
            var t = m["default"],
            n = "";
            n = window.channelID ? channelID: u.cookie.get("mzl_channel"),
            n && m[n] && (t = m[n]);
            var e = e || []; ! 
            function() {
                var n = document.createElement("script");
                n.src = "//hm.baidu.com/hm.js?" + t;
                var e = document.getElementsByTagName("script")[0];
                e.parentNode.insertBefore(n, e)
            } (),
            window._hmt = e
        }
    }
    function l() {
        var t = $(".verifyimg");
        t.length && t.click()
    }
    var u = {
        showMsg: s,
        goLogin: c,
        supportAnimate: r,
        supportTouch: "ontouchstart" in document.documentElement,
        io: {},
        regs: {},
        ui: {},
        chn: ""
    },
    f = $("body"),
    h = "/login.php";
    u.getChn = function() {
        return u.chn ? u.chn: (u.chn = u.cookie.get("mzl_channel") || "default", u.chn)
    },
    u.isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i)
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i)
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i)
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i)
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i)
        },
        Weixin: function() {
            return navigator.userAgent.match(/MicroMessenger/i)
        },
        QQ: function() {
            return navigator.userAgent.match(/QQ/)
        },
        any: function() {
            return isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows()
        }
    },
    u.regs = {
        mobi: /^(?:13|14|15|16|17|18|19)[\d]{9}$/,
        username: /^[a-zA-Z0-9][\w-]{2,30}$/,
        bankcard: /^[0-9](?:[\d]{21}|[\d]{20}|[\d]{19}|[\d]{18}|[\d]{17}|[\d]{16}|[\d]{15}|[\d]{14}|[\d]{13}|[\d]{12}|[\d]{11}|)$/,
        email: /^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/
    },
    u.ui.cur = function(t, n, e) {
        var t = $(t) || t,
        o = n || "cur";
        t.addClass(o).siblings().removeClass(o)
    },
    u.ui.ena = function(t) {
        var n = "disabled";
        t && t.each(function(t) {
            $(this).removeClass(n).removeAttr(n)
        })
    },
    u.ui.dis = function(t) {
        var n = "disabled";
        t && t.each(function(t) {
            $(this).attr(n, n).addClass(n)
        })
    },
    u.ui.loadimg = function(t, n) {
        var t = $(t),
        e = "imgLoadFlag";
        if (!t.data(e)) {
            var o = t.find("img[data-src],img[data-bg]");
            o.length && (o.each(function() {
                var t = $(this),
                n = t.data("src"),
                e = t.data("bg");
                n && t.attr("src", n).removeAttr("data-src"),
                e && t.css({
                    "background-image": "url(" + e + ")"
                }).removeAttr("data-bg")
            }), t.data(e, 1))
        }
    },
    u.ui.tab = function(t, n, e, o, i) {
        var i = i || "click",
        a = $(t).find(n),
        r = $(e).find(o);
        a.on(i, 
        function(t) {
            var n = $(this),
            e = n.index(),
            i = r.eq(e),
            a = u.ui.cur;
            a(this, "cur"),
            i.show().siblings(o).hide(),
            n.blur(),
            u.ui.loadimg(i),
            t.preventDefault()
        })
    },
    u.io.serialize = o,
    u.io.parseUrl = i,
    u.io.addUrlParam = a,
    u.io.xssEscape = function(t) {
        return t = String(null === t ? "": t),
        t.replace(/&(?!\w+;)|["'<>\\]/g, 
        function(t) {
            switch (t) {
            case "&":
                return "&amp;";
            case "\\":
                return "\\\\";
            case '"':
                return "&quot;";
            case "'":
                return "&#39;";
            case "<":
                return "&lt;";
            case ">":
                return "&gt;";
            default:
                return t
            }
        })
    },
    u.io.parseJson = function(t) {
        try {
            if ("object" == typeof t) return t;
            if ("string" == typeof t) return JSON.parse(t)
        } catch(n) {
            console.log("parseJson error \n org-data: \n " + t)
        }
    };
    r(); ! 
    function(t) {
        function n() {
            var t = {};
            if (document.cookie) {
                var n = document.cookie.split("; ");
                n.forEach(function(n, e, o) {
                    var i = n.split("="),
                    a = i[0],
                    r = i[1];
                    t[a] = r
                })
            }
            return t
        }
        function e(t, n, e) {
            if (t && n) {
                var o = encodeURIComponent(t) + "=" + encodeURIComponent(n);
                return e && (e.maxAge && (o += "; max-age=" + e.maxAge), e.path && (o += "; path=" + e.path), e.domain && (o += "; domain=" + e.domain), e.secure && (o += "; secure")),
                document.cookie = o,
                o
            }
            return ""
        }
        function o(t) {
            return decodeURIComponent(n()[t]) || null
        }
        function i(t) {
            n()[t] && (document.cookie = t + "=; max-age=0")
        }
        function a() {
            var t = n();
            for (var e in t) document.cookie = e + "=; max-age=0"
        }
        function r(t) {
            return n()
        }
        function s(t) {
            return t && "string" == typeof t ? t && window.cookie ? (window[t] = window.cookie, delete window.cookie, window[t]) : void 0: window.cookie
        }
        t.cookie = {
            getCookies: r,
            set: e,
            get: o,
            remove: i,
            clear: a,
            noConflict: s
        }
    } (u);
    var m = {
        "default": "e5883283abd0285c634898e065e21499",
        200001: "93083ac76898fe363cd44a3b9c599716",
        160020: "59ebf7a83435c374ab6f94e9c1f58f5a"
    };
    $(function() {
        $(".verifyimg").on("click", 
        function() {
            var t = $(this),
            n = t.attr("src").split("?");
            t.attr("src", n[0] + "?__t=" + +new Date)
        });
        var t = window.weixinShareImg || "http://stc.zhulang.com/images/zl320v1.png"; (u.isMobile.Weixin() || u.isMobile.QQ()) && (f.addClass("inwx"), f.prepend('<div id="zl-wx-share-img" style=" overflow:hidden; width:0px; height:0; margin:0 auto; position:absolute; top:-800px;"><img src="' + t + '"></div>')),
        $(".js-login,.js-log").on("click", 
        function() {
            c()
        });
        var n = $("#app-link");
        n.length && (u.isMobile.Android() && n.data("android") && n.attr("href", n.data("android")), u.isMobile.iOS() && n.attr("href", n.data("ios")), u.isMobile.Weixin() && n.on("click", 
        function(t) {
            s("请在浏览器中打开下载")
        })),
        d()
    }),
    u.io.refreshChar = l,
    t.exports = u
},
, , , , 
function(t, n, e) { ! 
    function(e, o) {
        "undefined" != typeof t && t.exports && (n = t.exports = o(e, n))
    } (this, 
    function(t, n) {
        "use strict";
        return Array.prototype.indexOf || (Array.prototype.indexOf = function(t) {
            var n = this.length >>> 0,
            e = Number(arguments[1]) || 0;
            for (e = 0 > e ? Math.ceil(e) : Math.floor(e), 0 > e && (e += n); n > e; e++) if (e in this && this[e] === t) return e;
            return - 1
        }),
        n.prefix = "",
        n._getPrefixedKey = function(t, n) {
            return n = n || {},
            n.noPrefix ? t: this.prefix + t
        },
        n.set = function(t, n, e) {
            var o = this._getPrefixedKey(t, e);
            try {
                localStorage.setItem(o, JSON.stringify({
                    data: n
                }))
            } catch(i) {
                console && console.warn("Lockr didn't successfully save the '{" + t + ": " + n + "}' pair, because the localStorage is full.")
            }
        },
        n.get = function(t, n, e) {
            var o,
            i = this._getPrefixedKey(t, e);
            try {
                o = JSON.parse(localStorage.getItem(i))
            } catch(a) {
                o = localStorage[i] ? {
                    data: localStorage.getItem(i)
                }: null
            }
            return null === o ? n: "object" == typeof o && "undefined" != typeof o.data ? o.data: n
        },
        n.sadd = function(t, e, o) {
            var i,
            a = this._getPrefixedKey(t, o),
            r = n.smembers(t);
            if (r.indexOf(e) > -1) return null;
            try {
                r.push(e),
                i = JSON.stringify({
                    data: r
                }),
                localStorage.setItem(a, i)
            } catch(s) {
                console.log(s),
                console && console.warn("Lockr didn't successfully add the " + e + " to " + t + " set, because the localStorage is full.")
            }
        },
        n.smembers = function(t, n) {
            var e,
            o = this._getPrefixedKey(t, n);
            try {
                e = JSON.parse(localStorage.getItem(o))
            } catch(i) {
                e = null
            }
            return null === e ? [] : e.data || []
        },
        n.sismember = function(t, e, o) {
            this._getPrefixedKey(t, o);
            return n.smembers(t).indexOf(e) > -1
        },
        n.getAll = function() {
            var t = Object.keys(localStorage);
            return t = t.filter(function(t) {
                return - 1 !== t.indexOf(n.prefix)
            }),
            t.map(function(t) {
                return n.get(t.substr(n.prefix.length))
            })
        },
        n.srem = function(t, e, o) {
            var i,
            a,
            r = this._getPrefixedKey(t, o),
            s = n.smembers(t, e);
            a = s.indexOf(e),
            a > -1 && s.splice(a, 1),
            i = JSON.stringify({
                data: s
            });
            try {
                localStorage.setItem(r, i)
            } catch(c) {
                console && console.warn("Lockr couldn't remove the " + e + " from the set " + t)
            }
        },
        n.rm = function(t) {
            localStorage.removeItem(t)
        },
        n.flush = function() {
            localStorage.clear()
        },
        n
    })
},
function(t, n, e) {
    var o = e(9),
    i = e(10);
    o.init(),
    i.init()
},
function(t, n, e) {
    function o() {
        setTimeout(function() {
            var t = ["fstep-" + it.cur, V.cur, "page-" + F, "rd-" + X];
            R.set(W, t.join(","), {
                path: "/",
                maxAge: 31104e3
            })
        },
        100)
    }
    function i(t) {
        B.set(U + J.bid, {
            bid: J.bid,
            chid: J.chid,
            url: window.location.href.split("?")[0].split("#")[0],
            pos: t || 0,
            chname: J.chname,
            time: 1 * new Date
        }),
        localStorage.length >= K && r()
    }
    function a() {
        for (var t in localStorage) t.match(U) && B.rm(t)
    }
    function r() {
        a()
    }
    function s(t) {
        $(t).addClass("cur").siblings().removeClass("cur")
    }
    function c() {
        $("#fn-btm").on("click", "li.li-down", 
        function(t) {
            t.preventDefault();
            var n = navigator.userAgent,
            e = "版本开发中，敬请期待",
            o = $(this);
            return /Windows Phone|webOS|BlackBerry/i.test(n) ? void D.showMsg(e) : /MicroMessenger/i.test(n) ? void D.showMsg("请在浏览器中打开本页") : /windows|win32|Android/i.test(n) ? void(window.location = o.data("apk")) : /AppleWebKit.*Mobile/i.test(n) || /macintosh|mac os x/i.test(n) ? void(window.location = o.data("ipa")) : void D.showMsg(e)
        })
    }
    function d() {
        $("#tip-bg").length || nt.append('<div class="tip-bg" id="tip-bg"></div>');
        var t = R.get(at);
        "undefined" == t && (nt.removeClass("tip-off").addClass("tip-on"), G = !0);
        var n = "ontouchstart" in document.documentElement ? "touchstart": "click";
        et.on(n, 
        function(t) {
            if (G) {
                nt.removeClass("tip-on").addClass("tip-off");
                var n = R.get(at),
                e = F;
                e = "undefined" == n ? e: e + n,
                R.set(at, e, {
                    path: "/",
                    maxAge: 31104e3
                }),
                G = !1
            }
        })
    }
    function l() {
        et.on("click", ".fn-div", 
        function(t) {
            G || (t.preventDefault(), nt.toggleClass("fn-on").removeClass("cfg-on").removeClass("idx-on"), H = !1)
        }).on("touchmove", 
        function(t) {
            nt.removeClass("cfg-on").removeClass("fn-on")
        })
    }
    function u() {
        $(".fb-icon").on("click", "li>a, li>div", 
        function() {
            var t = $(this),
            n = t.find(".icon");
            n.addClass("icon-taped"),
            setTimeout(function() {
                n.removeClass("icon-taped")
            },
            500)
        }),
        $("#fn-btm").on("click", "li.li-cfg div", 
        function(t) {
            return t.preventDefault(),
            nt.toggleClass("cfg-on"),
            !1
        }),
        $(window).on("resize orientationchange", 
        function(t) {
            nt.removeClass("cfg-on").removeClass("fn-on"),
            "lr" == F && A(Z)
        })
    }
    function f() {
        $("#idx-hdl").one("click", 
        function() {
            m(),
            y(),
            h()
        }).on("click", 
        function(t) {
            $("#idx-cnt").removeAttr("style"),
            nt.toggleClass("idx-on").removeClass("cfg-on"),
            H = !H,
            !H || st || ct || m(),
            t.stopPropagation()
        }),
        $("#idx-cnt").on("click", "h2 .icon", 
        function() {
            var t = $("#idx-cnt").find(".idx-div");
            t.toggleClass("idx-rvt")
        })
    }
    function h() {
        $("#idx-cnt li a").off("touchstart touchmove touchend").on("touchstart", 
        function(t) {
            dt = $(this).data("href")
        }).on("touchmove", 
        function(t) {
            dt = null
        }).on("touchend", 
        function(t) {
            var n = $(this),
            e = n.data("href");
            return e ? void(e == dt ? window.location = e: dt = null) : void(dt = null)
        })
    }
    function m() {
        if (!st && !ct) {
            ct = !0;
            var t = "/read/getList/book_id/" + window.bookInfo.bid + "/ch_id/" + window.bookInfo.chid + ".html";
            $.ajax({
                url: t,
                type: "GET",
                dataType: "json",
                success: function(t) {
                    v(t),
                    st = !0,
                    ct = !1
                },
                error: function(t) {
                    g(),
                    st = !0,
                    ct = !1
                }
            })
        }
    }
    function v(t) {
        function n(t) {
            return "<li" + (t.ch_id == window.bookInfo.chid ? ' class="cur"': "") + '><a data-href="' + ("/" + window.bookInfo.bid + "/" + t.ch_id + ".html") + '"><span>' + t.ch_name + "</span>" + (1 * t.ch_vip ? '<i class="icon icon-chag">VIP</i>': '<i class="icon icon-free">免费</i>') + "</a></li>"
        }
        t || g();
        for (var e = $("#idx-cnt"), o = e.find("ul.ul-odr"), i = e.find("ul.ul-rvt"), a = [], r = [], s = (window.location.href, 0); s < t.asc.length; s++) a.push(n(t.asc[s]));
        for (var c = 0; c < t.desc.length; c++) r.push(n(t.desc[c]));
        o.prepend(a.join("")),
        i.prepend(r.join("")),
        e.data("idxloaded", !0),
        h()
    }
    function p(t, n) {
        var e = it.range,
        t = 1 * t;
        
        if ("number" == typeof t && (0 > t && (t = 0), t > e && (t = e), 0 == t ? ft.addClass("disabled") : ft.removeClass("disabled"), t == e ? ut.addClass("disabled") : ut.removeClass("disabled"), t == it.dft ? ht.addClass("cur") : ht.removeClass("cur"), it.cur = t, !n)) {
            var o = $("body"),
            i = o.attr("class"),
            a = i.replace(/\s*fstep-\d\s*/g, " fstep-" + t + " ");
            //保存当前字体大小，下次访问直接使用该大小
            localStorage.fontSizeClass = 'fstep-' + t;
            //console.log(localStorage.fontSizeClass);
            o.attr("class", a),
            A(Z)
        }
        //console.log(localStorage.fontSizeClass,it.range);
    }
    function w() {
        lt.on("click", "menuitem", 
        function(t) {
            //恢复默认设置
            localStorage.removeItem('fontSizeClass');
            //localStorage.removeItem('pageDirection');
            //localStorage.removeItem('bgClass');
            //localStorage.removeItem('rdClass');
                        
            t.preventDefault();
            var n = $(this),
            e = it.cur,
            o = it.dft;
            //console.log(e,o);
            n.hasClass("disabled") || n.hasClass("cur") || (n.hasClass("fs-add") && p(e + 1), n.hasClass("fs-rdu") && p(e - 1), n.hasClass("fs-dft") && p(o))
        })
    }
    function b() {
        $("#cfg-mode").on("click", "menuitem", 
        function(t) {
            var n = $(this);
            if (!n.hasClass("cur")) {
                var e = n.hasClass("mode-lr"),
                o = tt;
                s(n),
                nt.removeClass("fn-on cfg-on");
                var i = R.get(at);
                //保存当前网页浏览方向，下次访问直接使用该浏览方向
                localStorage.pageDirection = F;
                
                e ? (F = "lr", nt.addClass("page-lr"), A(), i.indexOf(F) < 0 && (nt.removeClass("tip-off").addClass("tip-on"), G = !0)) : (F = "ud", Y = 1, nt.removeClass("page-lr"), o.removeAttr("style"), i.indexOf(F) < 0 && (nt.removeClass("tip-off").addClass("tip-on"), G = !0))
            }
        })
    }
    function x() {
        var t = $("#cfg-bg");
        t.on("click", "menuitem", 
        function(t) {
            t.preventDefault();
            var n = $(this);
            if (!n.hasClass("cur")) {
                V.cur = n.data("cls");
                var e = " " + V.cur + " ",
                o = $("body"),
                i = o.attr("class"),
                a = i.replace(/\s*bg-\d\s*/g, e);
                //保存当前网页背景样式，下次访问直接使用该背景样式
                localStorage.bgClass = e;
                
                o.attr("class", a),
                n.addClass("cur").siblings("menuitem").removeClass("cur")
            }
        });
        var n = $("#fn-btm");
        n.on("click", "li.night div", 
        function(t) {
            //保存当前网页开关灯状态，下次访问直接使用该开关灯状态
            localStorage.rdClass = 'rd-night';
            
            t.preventDefault(),
            $("body").removeClass("rd-day").addClass("rd-night"),
            X = "night",
            o()
        }).on("click", "li.day div", 
        function(t) {
            //保存当前网页开关灯状态，下次访问直接使用该开关灯状态
            localStorage.rdClass = 'rd-day';

            t.preventDefault(),
            $("body").removeClass("rd-night").addClass("rd-day"),
            X = "day",
            o()
        })
    }
    function C() {
        window.onbeforeunload = function() {
            o()
        },
        $("#cfg-pnl menuitem").on("click", 
        function() {
            o()
        })
    }
    function y() {
        function t(t) {
            var n = D.isMobile.iOS();
            return t ? void(n && j ? $(s).off("transitionend").on("transitionend", 
            function(t) {
                nt.removeClass("idx-on"),
                $(s).removeAttr("style").off("transitionend"),
                H = !1
            }) : setTimeout(function() {
                nt.removeClass("idx-on"),
                $(s).removeAttr("style"),
                H = !1
            },
            i)) : void(n && j ? $(s).off("transitionend").on("transitionend", 
            function(t) {
                nt.addClass("idx-on"),
                $(s).removeAttr("style").off("transitionend"),
                H = !0
            }) : setTimeout(function() {
                nt.addClass("idx-on"),
                $(s).removeAttr("style"),
                H = !0
            },
            i))
        }
        var n = {},
        e = {},
        o = {
            stopPropagation: !0
        },
        i = 200,
        a = !1,
        r = $("#idx-cnt").find(".idx-div").get(0),
        s = document.getElementById("idx-cnt"),
        c = s.getBoundingClientRect().width || s.offsetWidth,
        d = function() {},
        l = function(t) {
            setTimeout(t || d, 0)
        },
        u = {
            handleEvent: function(t) {
                switch (t.type) {
                case "touchstart":
                    this.start(t);
                    break;
                case "touchmove":
                    this.move(t);
                    break;
                case "touchend":
                    l(this.end(t));
                    break;
                case "webkitTransitionEnd":
                case "msTransitionEnd":
                case "oTransitionEnd":
                case "otransitionend":
                case "transitionend":
                    l(this.transitionEnd(t))
                }
                o.stopPropagation && t.stopPropagation()
            },
            start: function(t) {
                if (H) {
                    var o = t.touches[0];
                    n = {
                        x: o.pageX,
                        y: o.pageY,
                        time: +new Date
                    },
                    a = void 0,
                    e = {},
                    r.addEventListener("touchmove", this, !1),
                    r.addEventListener("touchend", this, !1)
                }
            },
            move: function(t) {
                if (! (t.touches.length > 1 || t.scale && 1 !== t.scale)) {
                    o.disableScroll && t.preventDefault();
                    var i = t.touches[0];
                    if (e = {
                        x: i.pageX - n.x,
                        y: i.pageY - n.y
                    },
                    "undefined" == typeof a && (a = !!(a || Math.abs(e.x) < Math.abs(e.y))), !a && H) {
                        if (t.preventDefault(), e.x > 0) {
                            var r = Math.round(100 * Math.min(e.x / c, 0));
                            k(s, 0, r + "%", 0)
                        }
                        if (e.x < 0) {
                            var r = Math.round(100 * Math.max(e.x / c, -.89));
                            k(s, 0, r + "%", 0)
                        }
                    }
                }
            },
            end: function(o) {
                var d = +new Date - n.time,
                l = Number(d) < 250 && Math.abs(e.x) > 20 || Math.abs(e.x) > c / 4,
                f = H && e.x > 0 || !H && e.x < 0;
                if (!a) {
                    if (f) {
                        if (H && e.x > 0) return;
                        return void(!H && e.x < 0)
                    }
                    l ? (e.x > 0 && k(s, 0, 0, 0), e.x < 0 && (k(s, i, "-89%", 0), t(!0))) : (k(s, i, 0, 0), t(!1))
                }
                r.removeEventListener("touchmove", u, !1),
                r.removeEventListener("touchend", u, !1)
            }
        };
        r.addEventListener("touchstart", u, !1)
    }
    function k(t, n, e, o, i) {
        $(t).css("-webkit-transition", "-webkit-transform " + n + "ms ease"),
        $(t).css("-o-transition", "-o-transform " + n + "ms ease"),
        $(t).css("-moz-transition", "-moz-transform " + n + "ms ease"),
        $(t).css("-ms-transition", "-ms-transform " + n + "ms ease"),
        $(t).css("transition", "transform " + n + "ms ease");
        var a = "number" == typeof e ? e + "px": e,
        r = "number" == typeof o ? o + "px": o;
        $(t).css("-webkit-transform", "translate3d(" + a + ", " + r + ",0)"),
        $(t).css("-moz-transform", "translate3d(" + a + ", " + r + ",0)"),
        $(t).css("-o-transform", "translate3d(" + a + ", " + r + ",0)"),
        $(t).css("-ms-transform", "translate3d(" + a + ", " + r + ",0)"),
        $(t).css("transform", "translate3d(" + a + ", " + r + ",0)"),
        "function" == typeof i && setTimeout(i, n)
    }
    function M(t, n) {
        var e = $(window).width(),
        o = "#rd-txt",
        a = t || Y,
        r = n || 0;
        q = -e * (a - 1),
        k(o, r, q, 0),
        i((a / Q).toFixed(2))
    }
    function A(t) {
        if ("lr" == F) {
            var n = tt,
            e = $("#page-nav"),
            o = $(window).width(),
            i = D.isMobile.iOS() ? window.innerHeight: $(window).height();
            n.css({
                height: i,
                width: o
            }),
            Q = Math.ceil(document.getElementById("rd-txt").scrollWidth / o),
            t && (Y = Math.max(Math.floor(t * Q), 1), M(Y, 0)),
            e.html(Y + "/" + Q),
            window.scrollTo(0, 1)
        }
    }
    function S() {
        var t = $("#prev-url");
        if (t.length) {
            var n = t.val();
            n && (n = n.split("#")[0], n = D.io.addUrlParam({
                zref: "prev"
            },
            n), n += "#zrpos=1", window.location.href = n)
        }
    }
    function E() {
        var t = $("#next-url");
        if (t.length) {
            var n = t.val();
            n && (window.location.href = n)
        }
    }
    function I(t) {
        return nt.removeClass("fn-on cfg-on"),
        Y--,
        0 >= Y ? (Y = 1, S()) : (Z = (Y / Q).toFixed(2), M(Y, t || 400), void A())
    }
    function T(t) {
        return nt.removeClass("fn-on cfg-on"),
        Y++,
        Y > Q ? (Y = Q, E()) : (Z = (Y / Q).toFixed(2), M(Y, t || 400), void A())
    }
    function _() {
        var t = nt.hasClass("cfg-on");
        return t && nt.removeClass("cfg-on").removeClass("fn-on"),
        t
    }
    function P() {
        et.on("click", "div", 
        function(t) {
            if (!G) {
                var n = $(this);
                return n.hasClass("pg-lft") && !_() && I(),
                n.hasClass("pg-rit") && !_() && T(),
                !1
            }
        })
    }
    function O(t) {
        var n = nt.scrollTop(),
        e = $(window).height(),
        o = ot.height();
        nt.height();
        n > 0 ? nt.scrollTop(n - (e - o)) : S()
    }
    function L(t) {
        var n = nt.scrollTop(),
        e = $(window).height(),
        o = ot.height(),
        i = nt.height();
        i > n + e ? nt.scrollTop(n + (e - o)) : E()
    }
    function z() {
        et.on("click", ".pg-up", 
        function(t) {
            return ! _() && O(),
            !1
        }).on("click", ".pg-dn", 
        function(t) {
            return ! _() && L(),
            !1
        })
    }
    var D = e(2),
    B = e(7),
    j = D.supportAnimate().supported,
    N = D.io.parseUrl,
    W = (/BlackBerry|Windows Phone/i.test(navigator.userAgent), "__zwReadCfg"),
    R = D.cookie,
    U = "zreadPos_",
    J = window.bookInfo,
    K = 100,
    Q = 1,
    F = "",
    X = "",
    Y = 1,
    Z = 0,
    q = 0,
    G = !1,
    H = !1,
    V = {
        cur: "bg-2"
    },
    tt = (window.location.href.split("?")[0].split("#")[0], $("#rd-txt")),
    nt = $("body"),
    et = $("#tap-hdl"),
    ot = $("#rd-top"),
    it = {
        range: 6,
        cur: 3,
        dft: 3
    },
    at = "__zwTS",
    rt = {
        init: function() {
            this.formatPage(),
            this.reactCtls()
        },
        formatPage: function() {
            var t = "#__zrposed",
            n = window.location.hash,
            e = nt.attr("class"),
            o = N(),
            i = n == t;
            o && "prev" == o.zref;
            if (!i) {
                var a = N(window.location.href.split("#")[1]),
                r = a && a.zrpos;
                1 * r && (r = Math.abs(1 * r), Z = Math.max(Math.min(1, r), 0), history.pushState(null, null, t))
            }
            nt.hasClass("page-lr") ? (F = "lr", A(Z), s($("#cfg-mode").find(".mode-lr"))) : (F = "ud", s($("#cfg-mode").find(".mode-ud")), Z && nt.scrollTop(nt.height() * Z - 32)),
            X = nt.hasClass("rd-night") ? "night": "day";
            var c = e.match(/fstep-\d/);
            p(c ? c[0].split("-")[1] : 3, "noset");
            var d = e.match(/bg-\d/);
            d = d ? d[0].split("-")[1] : 2,
            V.cur = "bg-" + d,
            s($("#cfg-bg").find(".bg-" + d));
            var l = D.cookie,
            u = "mzl_channel",
            f = l.get(u);
            f && $("html").addClass("chn-" + f)
        },
        clearRead: function() {
            nt.removeClass("fn-on").removeClass("cfg-on").removeClass("idx-on"),
            H = !1
        },
        reactCtls: function() {
            d(),
            u(),
            l(),
            f(),
            w(),
            x(),
            b(),
            C(),
            P(),
            z(),
            c()
        }
    },
    st = $("#idx-cnt").data("idxloaded") || !1,
    ct = !1,
    dt = null,
    lt = $("#cfg-font"),
    ut = lt.find(".fs-add"),
    ft = lt.find(".fs-rdu"),
    ht = lt.find(".fs-dft"); (function() {
        var t = {},
        n = {},
        e = {
            stopPropagation: !0

        },
        o = !1,
        i = document.getElementById("tap-hdl"),
        a = document.getElementById("rd-txt"),
        r = i.getBoundingClientRect().width || i.offsetWidth,
        s = $(i).height(),
        c = function() {},
        d = function(t) {
            setTimeout(t || c, 0)
        },
        l = 0,
        u = 0,
        f = {
            handleEvent: function(t) {
                switch (t.type) {
                case "touchstart":
                    this.start(t);
                    break;
                case "touchmove":
                    this.move(t);
                    break;
                case "touchend":
                    d(this.end(t));
                    break;
                case "webkitTransitionEnd":
                case "msTransitionEnd":
                case "oTransitionEnd":
                case "otransitionend":
                case "transitionend":
                    d(this.transitionEnd(t))
                }
                e.stopPropagation && t.stopPropagation()
            },
            start: function(e) {
                if (!H && !G) {
                    var a = e.touches[0];
                    t = {
                        x: a.pageX,
                        y: a.pageY,
                        time: +new Date
                    },
                    o = void 0,
                    n = {},
                    i.addEventListener("touchmove", this, !1),
                    i.addEventListener("touchend", this, !1)
                }
            },
            move: function(i) {
                if (! (i.touches.length > 1 || i.scale && 1 !== i.scale)) {
                    e.disableScroll && i.preventDefault();
                    var r = i.touches[0];
                    if (n = {
                        x: r.pageX - t.x,
                        y: r.pageY - t.y
                    },
                    "undefined" == typeof o && (o = !!(o || Math.abs(n.x) < Math.abs(n.y))), !o && "lr" == F) {
                        if (i.preventDefault(), 1 == Y && n.x > 0) return;
                        if (Y == Q && n.x < 0) return;
                        k(a, 0, q + n.x, 0)
                    }
                }
            },
            end: function(e) {
                var a = +new Date - t.time,
                c = !1;
                if ("lr" == F && (c = Number(a) < 250 && Math.abs(n.x) > 20 || Math.abs(n.x) > r / 4), "ud" == F && (c = Number(a) < 250 && Math.abs(n.y) > 20 || Math.abs(n.y) > s / 4), !o && "lr" == F) {
                    var d = 1 == Y && n.x > 0 || Y == Q && n.x < 0;
                    if (d) return void(1 == Y && n.x > 0 ? S() : Y == Q && n.x < 0 && E());
                    c ? (n.x > 0 && I(200), n.x < 0 && T(200)) : M(Y, 200)
                }
                if (o && "ud" == F) {
                    var h = $(window);
                    n.y < 0 && (u--, u = Math.max(u, 0)),
                    n.y > 0 && (l--, l = Math.max(l, 0)),
                    n.y < 0 && nt.scrollTop() + h.height() >= nt.height() && (l++, l >= 2 && E()),
                    n.y > 0 && nt.scrollTop() <= 0 && (u++, u >= 2 && S())
                }
                i.removeEventListener("touchmove", f, !1),
                i.removeEventListener("touchend", f, !1)
            }
        };
        i.addEventListener("touchstart", f, !1)
    })();
    console.log("readCtl inited @ " + +new Date),
    t.exports = rt
},
function(t, n, e) {
    function o() {
        var t = !1;
        $(r).on("click", "1", 
        function(t) {
            var n = $(this),
            e = n.data("url") || window.location.href;
            return window.userInfo && userInfo.uid ? void(e && (window.location = e)) : i.showMsg("请先登录~", 0, i.goLogin(e))
        }).on("click", ".1", 
        function(n) {
            if (!window.userInfo || !userInfo.uid) return i.showMsg("请先登录~", 0, i.goLogin);
            var e = $(this),
            o = e.data("api");
            e.hasClass("add-fav") ? "已收藏至书架！": "书签已添加";
            t || e.hasClass("added") || (t = !0, $.ajax({
                url: o,
                type: "POST",
                success: function(t) {
                    var n = i.io.parseJson(t);
                    if (0 == n.code) i.showMsg(n.msg || "收藏成功！"),
                    e.addClass("added"),
                    e.hasClass("add-fav") && e.find("span").text("已收藏");
                    else {
                        if ( - 400 == n.code) return i.showMsg("请先登录~", 0, i.goLogin);
                        i.showMsg("添加失败，请稍后再试")
                    }
                },
                error: function(t) {
                    i.showMsg("网络不给力，稍后再试")
                },
                complete: function() {
                    t = !1
                }
            }))
        })
    }
    var i = e(2),
    a = {
        init: o
    },
    r = document;
    t.exports = a
}]);

/*本地存储变量说明*/
/* 字体大小   ： fontSizeClass     样式名称
 * 浏览方向   ： pageDirection     值变化：lr ud
 * 背景样式   ： bgClass           样式名称
 * 开关灯样式 ： rdClass           样式名称
 * 注意：以上样式名称直接应用到body标签上
 * 声明：浏览方向 lr ：上下滑动浏览，body标签移除掉page-lr样式， ud ： 左右滑动浏览，body标签增加page-lr样式
 */
if(localStorage.fontSizeClass){
    var f_o = $("body"),
    f_i = f_o.attr("class"),
    f_a = f_i.replace(/\s*fstep-\d\s*/g, " " + localStorage.fontSizeClass + " ");
    f_o.attr("class", f_a);
    $(".fs-dft").removeClass("cur");
}

if(localStorage.pageDirection){
    if(localStorage.pageDirection == 'lr'){
        $(".mode-ud").click();
    } else if(localStorage.pageDirection == 'ud'){
        $(".mode-lr").click();
    }
}

if(localStorage.bgClass){
    var b_o = $("body"),
    b_i = b_o.attr("class"),
    b_a = b_i.replace(/\s*bg-\d\s*/g, " " + localStorage.bgClass + " ");
    b_o.attr("class", b_a);
    $("#cfg-bg menuitem").removeClass("cur");
    console.log(localStorage.bgClass);
    $("."+$.trim(localStorage.bgClass)).addClass("cur");
}
if(localStorage.rdClass){
    var r_o = $("body");
    r_o.removeClass("rd-day rd-night");
    r_o.addClass(localStorage.rdClass);
}