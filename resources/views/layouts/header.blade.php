<!doctype html>
<html data-theme="light" dir="rtl" lang="fa-IR" class="
desktop" style="--vh: 3.79px;">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script>
    if (navigator.userAgent.match(/MSIE|Internet Explorer/i) || navigator.userAgent.match(/Trident\/7\..*?rv:11/i)) {
      var href = document.location.href;
      if (!href.match(/[?&]nowprocket/)) {
        if (href.indexOf("?") == -1) {
          if (href.indexOf("#") == -1) {
            document.location.href = href + "?nowprocket=1"
          } else {
            document.location.href = href.replace("#", "?nowprocket=1#")
          }
        } else {
          if (href.indexOf("#") == -1) {
            document.location.href = href + "&nowprocket=1"
          } else {
            document.location.href = href.replace("#", "&nowprocket=1#")
          }
        }
      }
    }
  </script>
  <script>
    (() => {
      class RocketLazyLoadScripts {
        constructor() {
          this.v = "2.0.2", this.userEvents = ["keydown", "keyup", "mousedown", "mouseup", "mousemove", "mouseover",
            "mouseenter", "mouseout", "mouseleave", "touchmove", "touchstart", "touchend", "touchcancel", "wheel",
            "click", "dblclick", "input", "visibilitychange"
          ], this.attributeEvents = ["onblur", "onclick", "oncontextmenu", "ondblclick", "onfocus", "onmousedown",
            "onmouseenter", "onmouseleave", "onmousemove", "onmouseout", "onmouseover", "onmouseup",
            "onmousewheel", "onscroll", "onsubmit"
          ]
        }
        async t() {
          this.i(), this.o(), /iP(ad|hone)/.test(navigator.userAgent) && this.h(), this.u(), this.l(this), this.m(),
            this.k(this), this.p(this), this._(), await Promise.all([this.R(), this.L()]), this.lastBreath = Date
            .now(), this.S(this), this.P(), this.D(), this.O(), this.M(), await this.C(this.delayedScripts.normal),
            await this.C(this.delayedScripts.defer), await this.C(this.delayedScripts.async), this.T("domReady"),
            await this.F(), await this.j(), await this.I(), this.T("windowLoad"), await this.A(), window
            .dispatchEvent(new Event("rocket-allScriptsLoaded")), this.everythingLoaded = !0, this.lastTouchEnd &&
            await new Promise((t => setTimeout(t, 500 - Date.now() + this.lastTouchEnd))), this.H(), this.T("all"),
            this.U(), this.W()
        }
        i() {
          this.CSPIssue = sessionStorage.getItem("rocketCSPIssue"), document.addEventListener(
            "securitypolicyviolation", (t => {
              this.CSPIssue || "script-src-elem" !== t.violatedDirective || "data" !== t.blockedURI || (this
                .CSPIssue = !0, sessionStorage.setItem("rocketCSPIssue", !0))
            }), {
              isRocket: !0
            })
        }
        o() {
          window.addEventListener("pageshow", (t => {
            this.persisted = t.persisted, this.realWindowLoadedFired = !0
          }), {
            isRocket: !0
          }), window.addEventListener("pagehide", (() => {
            this.onFirstUserAction = null
          }), {
            isRocket: !0
          })
        }
        h() {
          let t;

          function e(e) {
            t = e
          }
          window.addEventListener("touchstart", e, {
            isRocket: !0
          }), window.addEventListener("touchend", (function i(o) {
            Math.abs(o.changedTouches[0].pageX - t.changedTouches[0].pageX) < 10 && Math.abs(o.changedTouches[
              0].pageY - t.changedTouches[0].pageY) < 10 && o.timeStamp - t.timeStamp < 200 && (o.target
              .dispatchEvent(new PointerEvent("click", {
                target: o.target,
                bubbles: !0,
                cancelable: !0
              })), event.preventDefault(), window.removeEventListener("touchstart", e, {
                isRocket: !0
              }), window.removeEventListener("touchend", i, {
                isRocket: !0
              }))
          }), {
            isRocket: !0
          })
        }
        q(t) {
          this.userActionTriggered || ("mousemove" !== t.type || this.firstMousemoveIgnored ? "keyup" === t.type ||
              "mouseover" === t.type || "mouseout" === t.type || (this.userActionTriggered = !0, this
                .onFirstUserAction && this.onFirstUserAction()) : this.firstMousemoveIgnored = !0), "click" === t
            .type && t.preventDefault(), this.savedUserEvents.length > 0 && (t.stopPropagation(), t
              .stopImmediatePropagation()), "touchstart" === this.lastEvent && "touchend" === t.type && (this
              .lastTouchEnd = Date.now()), "click" === t.type && (this.lastTouchEnd = 0), this.lastEvent = t.type,
            this.savedUserEvents.push(t)
        }
        u() {
          this.savedUserEvents = [], this.userEventHandler = this.q.bind(this), this.userEvents.forEach((t => window
            .addEventListener(t, this.userEventHandler, {
              passive: !1,
              isRocket: !0
            })))
        }
        U() {
          this.userEvents.forEach((t => window.removeEventListener(t, this.userEventHandler, {
            passive: !1,
            isRocket: !0
          }))), this.savedUserEvents.forEach((t => {
            t.target.dispatchEvent(new window[t.constructor.name](t.type, t))
          }))
        }
        m() {
          this.eventsMutationObserver = new MutationObserver((t => {
            const e = "return false";
            for (const i of t) {
              if ("attributes" === i.type) {
                const t = i.target.getAttribute(i.attributeName);
                t && t !== e && (i.target.setAttribute("data-rocket-" + i.attributeName, t), i.target
                  .setAttribute(i.attributeName, e))
              }
              "childList" === i.type && i.addedNodes.forEach((t => {
                if (t.nodeType === Node.ELEMENT_NODE)
                  for (const i of t.attributes) this.attributeEvents.includes(i.name) && i.value &&
                    "" !== i.value && (t.setAttribute("data-rocket-" + i.name, i.value), t.setAttribute(
                      i.name, e))
              }))
            }
          })), this.eventsMutationObserver.observe(document, {
            subtree: !0,
            childList: !0,
            attributeFilter: this.attributeEvents
          })
        }
        H() {
          this.eventsMutationObserver.disconnect(), this.attributeEvents.forEach((t => {
            document.querySelectorAll("[data-rocket-" + t + "]").forEach((e => {
              e.setAttribute(t, e.getAttribute("data-rocket-" + t)), e.removeAttribute("data-rocket-" +
                t)
            }))
          }))
        }
        k(t) {
          Object.defineProperty(HTMLElement.prototype, "onclick", {
            get() {
              return this.rocketonclick
            },
            set(e) {
              this.rocketonclick = e, this.setAttribute(t.everythingLoaded ? "onclick" :
                "data-rocket-onclick", "this.rocketonclick(event)")
            }
          })
        }
        S(t) {
          function e(e, i) {
            let o = e[i];
            e[i] = null, Object.defineProperty(e, i, {
              get: () => o,
              set(s) {
                t.everythingLoaded ? o = s : e["rocket" + i] = o = s
              }
            })
          }
          e(document, "onreadystatechange"), e(window, "onload"), e(window, "onpageshow");
          try {
            Object.defineProperty(document, "readyState", {
              get: () => t.rocketReadyState,
              set(e) {
                t.rocketReadyState = e
              },
              configurable: !0
            }), document.readyState = "loading"
          } catch (t) {
            console.log("WPRocket DJE readyState conflict, bypassing")
          }
        }
        l(t) {
          this.originalAddEventListener = EventTarget.prototype.addEventListener, this.originalRemoveEventListener =
            EventTarget.prototype.removeEventListener, this.savedEventListeners = [], EventTarget.prototype
            .addEventListener = function (e, i, o) {
              o && o.isRocket || !t.B(e, this) && !t.userEvents.includes(e) || t.B(e, this) && !t
                .userActionTriggered || e.startsWith("rocket-") ? t.originalAddEventListener.call(this, e, i, o) : t
                .savedEventListeners.push({
                  target: this,
                  remove: !1,
                  type: e,
                  func: i,
                  options: o
                })
            }, EventTarget.prototype.removeEventListener = function (e, i, o) {
              o && o.isRocket || !t.B(e, this) && !t.userEvents.includes(e) || t.B(e, this) && !t
                .userActionTriggered || e.startsWith("rocket-") ? t.originalRemoveEventListener.call(this, e, i,
                  o) : t.savedEventListeners.push({
                  target: this,
                  remove: !0,
                  type: e,
                  func: i,
                  options: o
                })
            }
        }
        T(t) {
          "all" === t && (EventTarget.prototype.addEventListener = this.originalAddEventListener, EventTarget
              .prototype.removeEventListener = this.originalRemoveEventListener), this.savedEventListeners = this
            .savedEventListeners.filter((e => {
              let i = e.type,
                o = e.target || window;
              return "domReady" === t && "DOMContentLoaded" !== i && "readystatechange" !== i || (
                "windowLoad" === t && "load" !== i && "readystatechange" !== i && "pageshow" !== i || (this.B(
                    i, o) && (i = "rocket-" + i), e.remove ? o.removeEventListener(i, e.func, e.options) : o
                  .addEventListener(i, e.func, e.options), !1))
            }))
        }
        p(t) {
          let e;

          function i(e) {
            return t.everythingLoaded ? e : e.split(" ").map((t => "load" === t || t.startsWith("load.") ?
              "rocket-jquery-load" : t)).join(" ")
          }

          function o(o) {
            function s(e) {
              const s = o.fn[e];
              o.fn[e] = o.fn.init.prototype[e] = function () {
                return this[0] === window && t.userActionTriggered && ("string" == typeof arguments[0] ||
                  arguments[0] instanceof String ? arguments[0] = i(arguments[0]) : "object" ==
                  typeof arguments[0] && Object.keys(arguments[0]).forEach((t => {
                    const e = arguments[0][t];
                    delete arguments[0][t], arguments[0][i(t)] = e
                  }))), s.apply(this, arguments), this
              }
            }
            if (o && o.fn && !t.allJQueries.includes(o)) {
              const e = {
                DOMContentLoaded: [],
                "rocket-DOMContentLoaded": []
              };
              for (const t in e) document.addEventListener(t, (() => {
                e[t].forEach((t => t()))
              }), {
                isRocket: !0
              });
              o.fn.ready = o.fn.init.prototype.ready = function (i) {
                function s() {
                  parseInt(o.fn.jquery) > 2 ? setTimeout((() => i.bind(document)(o))) : i.bind(document)(o)
                }
                return t.realDomReadyFired ? !t.userActionTriggered || t.fauxDomReadyFired ? s() : e[
                  "rocket-DOMContentLoaded"].push(s) : e.DOMContentLoaded.push(s), o([])
              }, s("on"), s("one"), s("off"), t.allJQueries.push(o)
            }
            e = o
          }
          t.allJQueries = [], o(window.jQuery), Object.defineProperty(window, "jQuery", {
            get: () => e,
            set(t) {
              o(t)
            }
          })
        }
        P() {
          const t = new Map;
          document.write = document.writeln = function (e) {
            const i = document.currentScript,
              o = document.createRange(),
              s = i.parentElement;
            let n = t.get(i);
            void 0 === n && (n = i.nextSibling, t.set(i, n));
            const a = document.createDocumentFragment();
            o.setStart(a, 0), a.appendChild(o.createContextualFragment(e)), s.insertBefore(a, n)
          }
        }
        async R() {
          return new Promise((t => {
            this.userActionTriggered ? t() : this.onFirstUserAction = t
          }))
        }
        async L() {
          return new Promise((t => {
            document.addEventListener("DOMContentLoaded", (() => {
              this.realDomReadyFired = !0, t()
            }), {
              isRocket: !0
            })
          }))
        }
        async I() {
          return this.realWindowLoadedFired ? Promise.resolve() : new Promise((t => {
            window.addEventListener("load", t, {
              isRocket: !0
            })
          }))
        }
        M() {
          this.pendingScripts = [];
          this.scriptsMutationObserver = new MutationObserver((t => {
            for (const e of t) e.addedNodes.forEach((t => {
              "SCRIPT" !== t.tagName || t.noModule || t.isWPRocket || this.pendingScripts.push({
                script: t,
                promise: new Promise((e => {
                  const i = () => {
                    const i = this.pendingScripts.findIndex((e => e.script === t));
                    i >= 0 && this.pendingScripts.splice(i, 1), e()
                  };
                  t.addEventListener("load", i, {
                    isRocket: !0
                  }), t.addEventListener("error", i, {
                    isRocket: !0
                  }), setTimeout(i, 1e3)
                }))
              })
            }))
          })), this.scriptsMutationObserver.observe(document, {
            childList: !0,
            subtree: !0
          })
        }
        async j() {
          await this.J(), this.pendingScripts.length ? (await this.pendingScripts[0].promise, await this.j()) : this
            .scriptsMutationObserver.disconnect()
        }
        D() {
          this.delayedScripts = {
            normal: [],
            async: [],
            defer: []
          }, document.querySelectorAll("script[type$=rocketlazyloadscript]").forEach((t => {
            t.hasAttribute("data-rocket-src") ? t.hasAttribute("async") && !1 !== t.async ? this
              .delayedScripts.async.push(t) : t.hasAttribute("defer") && !1 !== t.defer || "module" === t
              .getAttribute("data-rocket-type") ? this.delayedScripts.defer.push(t) : this.delayedScripts
              .normal.push(t) : this.delayedScripts.normal.push(t)
          }))
        }
        async _() {
          await this.L();
          let t = [];
          document.querySelectorAll("script[type$=rocketlazyloadscript][data-rocket-src]").forEach((e => {
            let i = e.getAttribute("data-rocket-src");
            if (i && !i.startsWith("data:")) {
              i.startsWith("//") && (i = location.protocol + i);
              try {
                const o = new URL(i).origin;
                o !== location.origin && t.push({
                  src: o,
                  crossOrigin: e.crossOrigin || "module" === e.getAttribute("data-rocket-type")
                })
              } catch (t) {}
            }
          })), t = [...new Map(t.map((t => [JSON.stringify(t), t]))).values()], this.N(t, "preconnect")
        }
        async $(t) {
          if (await this.G(), !0 !== t.noModule || !("noModule" in HTMLScriptElement.prototype)) return new Promise(
            (e => {
              let i;

              function o() {
                (i || t).setAttribute("data-rocket-status", "executed"), e()
              }
              try {
                if (navigator.userAgent.includes("Firefox/") || "" === navigator.vendor || this.CSPIssue) i =
                  document.createElement("script"), [...t.attributes].forEach((t => {
                    let e = t.nodeName;
                    "type" !== e && ("data-rocket-type" === e && (e = "type"), "data-rocket-src" === e &&
                      (e = "src"), i.setAttribute(e, t.nodeValue))
                  })), t.text && (i.text = t.text), t.nonce && (i.nonce = t.nonce), i.hasAttribute("src") ? (i
                    .addEventListener("load", o, {
                      isRocket: !0
                    }), i.addEventListener("error", (() => {
                      i.setAttribute("data-rocket-status", "failed-network"), e()
                    }), {
                      isRocket: !0
                    }), setTimeout((() => {
                      i.isConnected || e()
                    }), 1)) : (i.text = t.text, o()), i.isWPRocket = !0, t.parentNode.replaceChild(i, t);
                else {
                  const i = t.getAttribute("data-rocket-type"),
                    s = t.getAttribute("data-rocket-src");
                  i ? (t.type = i, t.removeAttribute("data-rocket-type")) : t.removeAttribute("type"), t
                    .addEventListener("load", o, {
                      isRocket: !0
                    }), t.addEventListener("error", (i => {
                      this.CSPIssue && i.target.src.startsWith("data:") ? (console.log(
                        "WPRocket: CSP fallback activated"), t.removeAttribute("src"), this.$(t).then(
                        e)) : (t.setAttribute("data-rocket-status", "failed-network"), e())
                    }), {
                      isRocket: !0
                    }), s ? (t.fetchPriority = "high", t.removeAttribute("data-rocket-src"), t.src = s) : t
                    .src = "data:text/javascript;base64," + window.btoa(unescape(encodeURIComponent(t.text)))
                }
              } catch (i) {
                t.setAttribute("data-rocket-status", "failed-transform"), e()
              }
            }));
          t.setAttribute("data-rocket-status", "skipped")
        }
        async C(t) {
          const e = t.shift();
          return e ? (e.isConnected && await this.$(e), this.C(t)) : Promise.resolve()
        }
        O() {
          this.N([...this.delayedScripts.normal, ...this.delayedScripts.defer, ...this.delayedScripts.async],
            "preload")
        }
        N(t, e) {
          this.trash = this.trash || [];
          let i = !0;
          var o = document.createDocumentFragment();
          t.forEach((t => {
            const s = t.getAttribute && t.getAttribute("data-rocket-src") || t.src;
            if (s && !s.startsWith("data:")) {
              const n = document.createElement("link");
              n.href = s, n.rel = e, "preconnect" !== e && (n.as = "script", n.fetchPriority = i ? "high" :
                  "low"), t.getAttribute && "module" === t.getAttribute("data-rocket-type") && (n
                  .crossOrigin = !0), t.crossOrigin && (n.crossOrigin = t.crossOrigin), t.integrity && (n
                  .integrity = t.integrity), t.nonce && (n.nonce = t.nonce), o.appendChild(n), this.trash
                .push(n), i = !1
            }
          })), document.head.appendChild(o)
        }
        W() {
          this.trash.forEach((t => t.remove()))
        }
        async F() {
          try {
            document.readyState = "interactive"
          } catch (t) {}
          this.fauxDomReadyFired = !0;
          try {
            await this.G(), document.dispatchEvent(new Event("rocket-readystatechange")), await this.G(), document
              .rocketonreadystatechange && document.rocketonreadystatechange(), await this.G(), document
              .dispatchEvent(new Event("rocket-DOMContentLoaded")), await this.G(), window.dispatchEvent(new Event(
                "rocket-DOMContentLoaded"))
          } catch (t) {
            console.error(t)
          }
        }
        async A() {
          try {
            document.readyState = "complete"
          } catch (t) {}
          try {
            await this.G(), document.dispatchEvent(new Event("rocket-readystatechange")), await this.G(), document
              .rocketonreadystatechange && document.rocketonreadystatechange(), await this.G(), window
              .dispatchEvent(new Event("rocket-load")), await this.G(), window.rocketonload && window
              .rocketonload(), await this.G(), this.allJQueries.forEach((t => t(window).trigger(
                "rocket-jquery-load"))), await this.G();
            const t = new Event("rocket-pageshow");
            t.persisted = this.persisted, window.dispatchEvent(t), await this.G(), window.rocketonpageshow && window
              .rocketonpageshow({
                persisted: this.persisted
              })
          } catch (t) {
            console.error(t)
          }
        }
        async G() {
          Date.now() - this.lastBreath > 45 && (await this.J(), this.lastBreath = Date.now())
        }
        async J() {
          return document.hidden ? new Promise((t => setTimeout(t))) : new Promise((t => requestAnimationFrame(t)))
        }
        B(t, e) {
          return e === document && "readystatechange" === t || (e === document && "DOMContentLoaded" === t || (e ===
            window && "DOMContentLoaded" === t || (e === window && "load" === t || e === window &&
              "pageshow" === t)))
        }
        static run() {
          (new RocketLazyLoadScripts).t()
        }
      }
      RocketLazyLoadScripts.run()
    })();
  </script>


  <meta name="theme-color" content="#050033">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
  <style>
    img:is([sizes="auto"i], [sizes^="auto,"i]) {
      contain-intrinsic-size: 3000px 1500px
    }
  </style>

  <!-- This site is optimized with the Yoast SEO Premium plugin v24.4 (Yoast SEO v24.6) - https://yoast.com/wordpress/plugins/seo/ -->
  <title>رایاپردازان - استودیو کسب‌و‌کار رایاپردازان</title>
  <link rel="preload" as="font" href="https://websima.com/wp-content/themes/websima/assets/fonts/YekanBakh-VF.woff2"
    crossorigin>
  <link rel="preload" data-rocket-preload as="image"
    href="https://websima.com/wp-content/uploads/2024/08/Frame-11-scaled.webp" fetchpriority="high">
  <meta name="description"
    content="به شما کمک می‌کنیم تا فرصت‌های جدیدی را لمس کنید و همگام با دنیا، تجربه رشد، توسعه و شکوفایی را برای کسب‌وکار خود رقم بزنید." />
  <link rel="canonical" href="https://websima.com/" />
  <meta property="og:locale" content="fa_IR" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="رایاپردازان" />
  <meta property="og:description"
    content="به شما کمک می‌کنیم تا فرصت‌های جدیدی را لمس کنید و همگام با دنیا، تجربه رشد، توسعه و شکوفایی را برای کسب‌وکار خود رقم بزنید." />
  <meta property="og:url" content="https://rayapardazan.net/" />
  <meta property="og:site_name" content="استودیو کسب‌و‌کار رایاپردازان" />
  <meta property="article:modified_time" content="2025-06-16T10:52:33+00:00" />
  <script type="application/ld+json" class="yoast-schema-graph">
    {
      "@context": "https://schema.org",
      "@graph": [{
        "@type": "WebPage",
        "@id": "https://websima.com/",
        "url": "https://websima.com/",
        "name": "رایاپردازان - استودیو کسب‌و‌کار رایاپردازان",
        "isPartOf": {
          "@id": "https://websima.com/#website"
        },
        "datePublished": "2024-12-11T06:11:28+00:00",
        "dateModified": "2025-06-16T10:52:33+00:00",
        "description": "به شما کمک می‌کنیم تا فرصت‌های جدیدی را لمس کنید و همگام با دنیا، تجربه رشد، توسعه و شکوفایی را برای کسب‌وکار خود رقم بزنید.",
        "breadcrumb": {
          "@id": "https://websima.com/#breadcrumb"
        },
        "inLanguage": "fa-IR",
        "potentialAction": [{
          "@type": "ReadAction",
          "target": ["https://websima.com/"]
        }]
      }, {
        "@type": "BreadcrumbList",
        "@id": "https://websima.com/#breadcrumb",
        "itemListElement": [{
          "@type": "ListItem",
          "position": 1,
          "name": "صفحه پیشواز"
        }]
      }, {
        "@type": "WebSite",
        "@id": "https://websima.com/#website",
        "url": "https://websima.com/",
        "name": "استودیو کسب‌و‌کار رایاپردازان",
        "description": "نتیجه مهم است",
        "alternateName": "رایاپردازان",
        "potentialAction": [{
          "@type": "SearchAction",
          "target": {
            "@type": "EntryPoint",
            "urlTemplate": "https://websima.com/?s={search_term_string}"
          },
          "query-input": {
            "@type": "PropertyValueSpecification",
            "valueRequired": true,
            "valueName": "search_term_string"
          }
        }],
        "inLanguage": "fa-IR"
      }]
    }
  </script>
  <!-- / Yoast SEO Premium plugin. -->



  <link data-minify="1" rel='stylesheet' id='websima-icons-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/icons.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-general-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/global.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-header-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/header.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-buttons-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/buttons.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-hero-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/sections/section-hero.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-services-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/sections/section-services.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='swiper-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/vendors/swiper.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-portfolio-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/sections/section-portfolio.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-ceo-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/sections/section-ceo.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-team-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/sections/section-team.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-leap-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/sections/section-leap.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-card-portfolio-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/parts/card-portfolio.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-widgets-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/parts/widgets.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-editor-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/editor.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='footer-style-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/footer.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-iland-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/iland.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-hamburger-menu-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/css/global/hamburger-menu.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-lead-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/includes/modules/websima-request/assets/css/style.1.0.1.css?ver=1752242261'
    media='all' />
  <link data-minify="1" rel='stylesheet' id='websima-icta-css'
    href='https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/includes/modules/websima-interactive-cta/assets/css/style.css?ver=1752242261'
    media='all' />
  <script data-minify="1"
    src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/vendors/gsap.js?ver=1752242262"
    id="gsap-js" data-rocket-defer defer></script>
  <script data-minify="1"
    src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/vendors/paper.js?ver=1752242262"
    id="paper-js" data-rocket-defer defer></script>
  <script data-minify="1"
    src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/vendors/ScrollTrigger.js?ver=1752242262"
    id="ScrollTriggr-js" data-rocket-defer defer></script>
  <script id="websima-gloabl-start-js-extra">
    var my_ajax_object = {
      "ajax_url": "https:\/\/websima.com\/wp-admin\/admin-ajax.php"
    };
  </script>
  <script type="rocketlazyloadscript" data-minify="1" defer
    data-rocket-src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/global/global-start.js?ver=1752242262"
    id="websima-gloabl-start-js"></script>
  <script data-minify="1" defer
    src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/parts/waves-config.js?ver=1752242262"
    id="websima-wave-settings-js"></script>
  <script data-minify="1" defer
    src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/sections/section-hero/wave.js?ver=1752242262"
    id="websima-wave-hero-js"></script>
  <script type="rocketlazyloadscript" data-minify="1"
    data-rocket-src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/vendors/swiper.js?ver=1752242262"
    id="swiper-js" data-rocket-defer defer></script>
  <script type="rocketlazyloadscript" data-minify="1" defer
    data-rocket-src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/sections/section-portfolio/section.js?ver=1752242262"
    id="websima-portfolio-js"></script>
  <script type="rocketlazyloadscript" data-minify="1" defer
    data-rocket-src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/sections/section-ceo/section.js?ver=1752242262"
    id="websima-ceo-js"></script>
  <script type="rocketlazyloadscript" data-minify="1" defer
    data-rocket-src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/sections/section-team/section.js?ver=1752242262"
    id="websima-team-js"></script>
  <script type="rocketlazyloadscript" data-minify="1" defer
    data-rocket-src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/sections/section-leap/section.js?ver=1752242262"
    id="websima-leap-js"></script>
  <script data-minify="1" defer
    src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/global/preloader.js?ver=1752242262"
    id="websima-preloader-js"></script>
  <script type="rocketlazyloadscript" data-minify="1" defer
    data-rocket-src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/global/global-end.js?ver=1752242262"
    id="websima-gloabl-end-js"></script>
  <script data-minify="1" defer
    src="https://websima.com/wp-content/cache/min/1/wp-content/themes/websima/assets/js/global/footer-wave.js?ver=1752242262"
    id="websima-footer-wave-js"></script>
  <link rel="icon" href="{{asset('profassets/favicon.png')}}" sizes="32x32" />
  <link rel="icon" href="{{asset('profassets/favicon.png')}}" sizes="192x192" />
  <link rel="apple-touch-icon" href="{{asset('profassets/favicon.png')}}" />
  <meta name="msapplication-TileImage"
    content="{{asset('profassets/favicon.png')}}" />
  <noscript>
    <style id="rocket-lazyload-nojs-css">
      .rll-youtube-player,
      [data-lazy-src] {
        display: none !important;
      }
    </style>
  </noscript>
  <script type="rocketlazyloadscript" data-rocket-type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "qamk9k89pg");
</script>
  <style id="rocket-lazyrender-inline-css">
    [data-wpr-lazyrender] {
      content-visibility: auto;
    }
  </style>
  <meta name="generator" content="WP Rocket 3.18.1.5"
    data-wpr-features="wpr_delay_js wpr_defer_js wpr_minify_js wpr_preload_fonts wpr_lazyload_images wpr_lazyload_iframes wpr_automatic_lazy_rendering wpr_oci wpr_image_dimensions wpr_minify_css wpr_desktop wpr_preload_links" />
</head>


<body
  class="rtl home wp-singular page-template page-template-templates page-template-template-modular page-template-templatestemplate-modular-php page page-id-2574 wp-theme-websima">
  <div id="preloader">
    <div id="preloader__img"></div>
    <div id="preloader__bg"></div>
  </div>
