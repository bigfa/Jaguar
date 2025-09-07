var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var jaguarBase = /** @class */ (function () {
    function jaguarBase() {
        this.is_single = false;
        this.post_id = 0;
        this.is_archive = false;
        this.darkmode = false;
        //@ts-ignore
        this.is_single = obvInit.is_single;
        //@ts-ignore
        this.post_id = obvInit.post_id;
        //@ts-ignore
        this.is_archive = obvInit.is_archive;
        //@ts-ignore
        this.darkmode = obvInit.darkmode;
        //@ts-ignore
        this.VERSION = obvInit.version;
        console.log('version', this.VERSION);
    }
    jaguarBase.prototype.getCookie = function (t) {
        if (0 < document.cookie.length) {
            var e = document.cookie.indexOf(t + '=');
            if (-1 != e) {
                e = e + t.length + 1;
                var n = document.cookie.indexOf(';', e);
                return -1 == n && (n = document.cookie.length), document.cookie.substring(e, n);
            }
        }
        return '';
    };
    jaguarBase.prototype.setCookie = function (t, e, n) {
        var o = new Date();
        o.setTime(o.getTime() + 24 * n * 60 * 60 * 1e3);
        var i = 'expires=' + o.toUTCString();
        document.cookie = t + '=' + e + ';' + i + ';path=/';
    };
    jaguarBase.prototype.showNotice = function (message, type) {
        if (type === void 0) { type = 'success'; }
        var html = "<div class=\"notice--wrapper\">".concat(message, "</div>");
        document.querySelector('body').insertAdjacentHTML('beforeend', html);
        document.querySelector('.notice--wrapper').classList.add('is-active');
        setTimeout(function () {
            document.querySelector('.notice--wrapper').remove();
        }, 3000);
    };
    return jaguarBase;
}());
if (document.querySelector('.nav--clicker')) {
    var footerLogo = document.querySelector('.nav--clicker');
    if (footerLogo) {
        footerLogo.addEventListener('click', function () {
            var body = document.querySelector('body');
            if (body) {
                body.classList.toggle('is-readingMode');
            }
        });
    }
}
if (document.querySelector('.menu--icon')) {
    document.querySelector('.menu--icon').addEventListener('click', function () {
        document.querySelector('.site--nav').classList.add('is-active');
        document.querySelector('body').classList.add('menu--actived');
    });
}
if (document.querySelector('.search--icon')) {
    document.querySelector('.search--icon').addEventListener('click', function () {
        document.querySelector('body').classList.toggle('search--actived');
    });
}
if (document.querySelector('.mask')) {
    document.querySelector('.mask').addEventListener('touchstart', function () {
        document.querySelector('.site--nav').classList.remove('is-active');
        document.querySelector('body').classList.remove('menu--actived');
    });
}
var jaguarAction = /** @class */ (function (_super) {
    __extends(jaguarAction, _super);
    function jaguarAction() {
        var _this = _super.call(this) || this;
        _this.selctor = '.like-btn';
        _this.is_single = false;
        _this.post_id = 0;
        _this.is_archive = false;
        //@ts-ignore
        _this.is_single = obvInit.is_single;
        //@ts-ignore
        _this.post_id = obvInit.post_id;
        //@ts-ignore
        _this.is_archive = obvInit.is_archive;
        _this.like_btn = document.querySelector(_this.selctor);
        if (_this.like_btn) {
            _this.like_btn.addEventListener('click', function () {
                _this.handleLike();
            });
            if (_this.getCookie('like_' + _this.post_id)) {
                _this.like_btn.classList.add('is-active');
            }
        }
        var theme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'auto';
        var html = "<div class=\"fixed--theme\">\n        <span class=\"".concat(theme == 'dark' ? 'is-active' : '', "\" data-action-value=\"dark\">\n            <svg fill=\"none\" height=\"24\" shape-rendering=\"geometricPrecision\" stroke=\"currentColor\" stroke-linecap=\"round\"\n                stroke-linejoin=\"round\" stroke-width=\"1.5\" viewBox=\"0 0 24 24\" width=\"24\"\n                style=\"color: currentcolor; width: 13px; height: 13px;\">\n                <path d=\"M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z\"></path>\n            </svg>\n        </span>\n        <span class=\"").concat(theme == 'light' ? 'is-active' : '', "\" data-action-value=\"light\">\n            <svg fill=\"none\" height=\"24\" shape-rendering=\"geometricPrecision\" stroke=\"currentColor\" stroke-linecap=\"round\"\n                stroke-linejoin=\"round\" stroke-width=\"1.5\" viewBox=\"0 0 24 24\" width=\"24\"\n                style=\"color: currentcolor; width: 13px; height: 13px;\">\n                <circle cx=\"12\" cy=\"12\" r=\"5\"></circle>\n                <path d=\"M12 1v2\"></path>\n                <path d=\"M12 21v2\"></path>\n                <path d=\"M4.22 4.22l1.42 1.42\"></path>\n                <path d=\"M18.36 18.36l1.42 1.42\"></path>\n                <path d=\"M1 12h2\"></path>\n                <path d=\"M21 12h2\"></path>\n                <path d=\"M4.22 19.78l1.42-1.42\"></path>\n                <path d=\"M18.36 5.64l1.42-1.42\"></path>\n            </svg>\n        </span>\n        <span class=\"").concat(theme == 'auto' ? 'is-active' : '', "\"  data-action-value=\"auto\">\n            <svg fill=\"none\" height=\"24\" shape-rendering=\"geometricPrecision\" stroke=\"currentColor\" stroke-linecap=\"round\"\n                stroke-linejoin=\"round\" stroke-width=\"1.5\" viewBox=\"0 0 24 24\" width=\"24\"\n                style=\"color: currentcolor; width: 13px; height: 13px;\">\n                <rect x=\"2\" y=\"3\" width=\"20\" height=\"14\" rx=\"2\" ry=\"2\"></rect>\n                <path d=\"M8 21h8\"></path>\n                <path d=\"M12 17v4\"></path>\n            </svg>\n        </span>\n    </div>");
        if (_this.darkmode) {
            document.querySelector('.jFooter').insertAdjacentHTML('beforeend', html);
        }
        document.querySelectorAll('.fixed--theme span').forEach(function (item) {
            item.addEventListener('click', function () {
                if (item.classList.contains('is-active'))
                    return;
                document.querySelectorAll('.fixed--theme span').forEach(function (item) {
                    item.classList.remove('is-active');
                });
                // @ts-ignore
                if (item.dataset.actionValue == 'dark') {
                    localStorage.setItem('theme', 'dark');
                    document.querySelector('body').classList.remove('auto');
                    document.querySelector('body').classList.add('dark');
                    item.classList.add('is-active');
                    //this.showNotice('夜间模式已开启');
                    // @ts-ignore
                }
                else if (item.dataset.actionValue == 'light') {
                    localStorage.setItem('theme', 'light');
                    document.querySelector('body').classList.remove('auto');
                    document.querySelector('body').classList.remove('dark');
                    item.classList.add('is-active');
                    //this.showNotice('夜间模式已关闭');
                    // @ts-ignore
                }
                else if (item.dataset.actionValue == 'auto') {
                    localStorage.setItem('theme', 'auto');
                    document.querySelector('body').classList.remove('dark');
                    document.querySelector('body').classList.add('auto');
                    item.classList.add('is-active');
                    //this.showNotice('夜间模式已关闭');
                }
            });
        });
        if (document.querySelector('.post--share')) {
            document.querySelector('.post--share').addEventListener('click', function () {
                navigator.clipboard.writeText(document.location.href).then(function () {
                    _this.showNotice('复制成功');
                });
            });
        }
        if (_this.is_single && obvInit.post_views) {
            _this.trackPostView();
        }
        if (_this.is_archive) {
            _this.trackArchiveView();
        }
        console.log("theme version: ".concat(_this.VERSION, " init success!"));
        return _this;
        //     const copyright = `<div class="site--footer__info">
        //     Theme <a href="https://fatesinger.com/101971" target="_blank">jaguar</a> by bigfa / version ${this.VERSION}
        // </div>`;
        //     document.querySelector('.site--footer__content')!.insertAdjacentHTML('afterend', copyright);
        //     document.querySelector('.icon--copryrights')!.addEventListener('click', () => {
        //         document.querySelector('.site--footer__info')!.classList.toggle('active');
        //     });
    }
    jaguarAction.prototype.trackPostView = function () {
        //@ts-ignore
        var id = obvInit.post_id;
        //@ts-ignore
        var url = obvInit.restfulBase + 'jaguar/v1/view?id=' + id;
        fetch(url, {
            headers: {
                // @ts-ignore
                'X-WP-Nonce': obvInit.nonce,
                'Content-Type': 'application/json'
            }
        })
            .then(function (response) {
            return response.json();
        })
            .then(function (data) {
            console.log(data);
        });
    };
    jaguarAction.prototype.trackArchiveView = function () {
        if (document.querySelector('.archive-header')) {
            // @ts-ignore
            var id = obvInit.archive_id;
            // @ts-ignore
            fetch("".concat(obvInit.restfulBase, "jaguar/v1/archive/").concat(id), {
                method: 'POST',
                // body: JSON.stringify({
                //     // @ts-ignore
                //     id: this.post_id,
                // }),
                headers: {
                    // @ts-ignore
                    'X-WP-Nonce': obvInit.nonce,
                    'Content-Type': 'application/json'
                }
            })
                .then(function (response) {
                return response.json();
            })
                .then(function (data) {
                //this.showNotice('Thanks for your like');
                // @ts-ignore
                //this.setCookie('like_' + this.post_id, '1', 1);
            });
        }
    };
    jaguarAction.prototype.handleLike = function () {
        var _this = this;
        // @ts-ignore
        if (this.getCookie('like_' + this.post_id)) {
            return this.showNotice('You have already liked this post');
        }
        // @ts-ignore
        var url = obvInit.restfulBase + 'jaguar/v1/like';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
                // @ts-ignore
                id: this.post_id
            }),
            headers: {
                // @ts-ignore
                'X-WP-Nonce': obvInit.nonce,
                'Content-Type': 'application/json'
            }
        })
            .then(function (response) {
            return response.json();
        })
            .then(function (data) {
            _this.showNotice('Thanks for your like');
            // @ts-ignore
            _this.setCookie('like_' + _this.post_id, '1', 1);
        });
        this.like_btn.classList.add('is-active');
    };
    jaguarAction.prototype.refresh = function () { };
    return jaguarAction;
}(jaguarBase));
new jaguarAction();
var jaguarComment = /** @class */ (function (_super) {
    __extends(jaguarComment, _super);
    function jaguarComment() {
        var _this = _super.call(this) || this;
        _this.loading = false;
        _this.init();
        return _this;
    }
    jaguarComment.prototype.init = function () {
        var _this = this;
        var _a;
        if (document.querySelector('.comment-form')) {
            (_a = document.querySelector('.comment-form')) === null || _a === void 0 ? void 0 : _a.addEventListener('submit', function (e) {
                e.preventDefault();
                if (_this.loading)
                    return;
                var form = document.querySelector('.comment-form');
                // @ts-ignore
                var formData = new FormData(form);
                // @ts-ignore
                var formDataObj = {};
                formData.forEach(function (value, key) { return (formDataObj[key] = value); });
                _this.loading = true;
                // @ts-ignore
                fetch(obvInit.restfulBase + 'jaguar/v1/comment', {
                    method: 'POST',
                    body: JSON.stringify(formDataObj),
                    headers: {
                        // @ts-ignore
                        'X-WP-Nonce': obvInit.nonce,
                        'Content-Type': 'application/json'
                    }
                })
                    .then(function (response) {
                    return response.json();
                })
                    .then(function (data) {
                    var _a, _b, _c, _d, _e;
                    _this.loading = false;
                    if (data.code != 200) {
                        return _this.showNotice(data.message, 'error');
                    }
                    var a = document.getElementById('cancel-comment-reply-link'), i = document.getElementById('respond'), n = document.getElementById('wp-temp-form-div');
                    var comment = data.data;
                    var html = "<li class=\"comment jComment--item\" id=\"comment-".concat(comment.comment_ID, "\">\n                        <div class=\"jComment--body comment-body__fresh\">\n                            <footer class=\"jComment--meta\">\n                                    <img alt=\"\" src=\"").concat(comment.author_avatar_urls, "\" class=\"avatar\" height=\"42\" width=\"42\" />\n                                    <div class=\"jComment--author\">").concat(comment.comment_author, "<span class=\"middotDivider\"></span>\n                                    <time class=\"jComment--time\">\u521A\u521A</time>\n                                </div>\n                            </footer>\n                            <div class=\"jComment--content\">\n                                ").concat(comment.comment_content, "\n                            </div>\n                        </div>\n                    </li>"); // @ts-ignore
                    var parent_id = (_a = document.querySelector('#comment_parent')) === null || _a === void 0 ? void 0 : _a.value;
                    // @ts-ignore
                    (a.style.display = 'none'), // @ts-ignore
                        (a.onclick = null), // @ts-ignore
                        (document.getElementById('comment_parent').value = '0'),
                        n && // @ts-ignore
                            i && // @ts-ignore
                            (n.parentNode.insertBefore(i, n), n.parentNode.removeChild(n));
                    if (document.querySelector('.comment-body__fresh'))
                        (_b = document
                            .querySelector('.comment-body__fresh')) === null || _b === void 0 ? void 0 : _b.classList.remove('comment-body__fresh');
                    // @ts-ignore
                    document.getElementById('comment').value = '';
                    // @ts-ignore
                    if (parent_id != '0') {
                        (_c = document
                            .querySelector(
                        // @ts-ignore
                        '#comment-' + parent_id)) === null || _c === void 0 ? void 0 : _c.insertAdjacentHTML('beforeend', '<ol class="children">' + html + '</ol>');
                        console.log(parent_id);
                    }
                    else {
                        if (document.querySelector('.no--comment')) {
                            (_d = document.querySelector('.no--comment')) === null || _d === void 0 ? void 0 : _d.remove();
                        }
                        (_e = document
                            .querySelector('.jComment--list')) === null || _e === void 0 ? void 0 : _e.insertAdjacentHTML('beforeend', html);
                    }
                    var newComment = document.querySelector("#comment-".concat(comment.comment_ID));
                    if (newComment) {
                        newComment.scrollIntoView({ behavior: 'smooth' });
                    }
                    _this.showNotice('评论成功');
                });
            });
        }
    };
    return jaguarComment;
}(jaguarBase));
new jaguarComment();
var jaguarScroll = /** @class */ (function () {
    function jaguarScroll() {
        this.is_single = false;
        //@ts-ignore
        this.is_single = obvInit.is_single;
        // this.init();
        if (document.querySelector('.backToTop')) {
            var backToTop_1 = document.querySelector('.backToTop');
            window.addEventListener('scroll', function () {
                var t = window.scrollY || window.pageYOffset;
                // console.log(t);
                // const documentHeight = document.body.clientHeight;
                //const windowHeight = window.innerHeight;
                // const percent = Math.ceil((t / (documentHeight - windowHeight)) * 100);
                t > 200
                    ? backToTop_1.classList.add('is-active')
                    : backToTop_1.classList.remove('is-active');
            });
            backToTop_1.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    }
    jaguarScroll.prototype.init = function () {
        this.scroll();
    };
    jaguarScroll.prototype.scroll = function () {
        window.addEventListener('scroll', function () {
            var _a, _b;
            if (window.scrollY > 10) {
                (_a = document.querySelector('.site--header')) === null || _a === void 0 ? void 0 : _a.classList.add('is-active');
            }
            else {
                (_b = document.querySelector('.site--header')) === null || _b === void 0 ? void 0 : _b.classList.remove('is-active');
            }
        });
    };
    return jaguarScroll;
}());
new jaguarScroll();
var scrollTop = 0;
var isScrollingBack = false;
var metabar = document.querySelector('.metabar');
var area = document.querySelector('.surface--content');
window.addEventListener('scroll', function () {
    // Get the current scroll position
    var currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
    // Check if scrolling back
    if (currentScrollTop < scrollTop) {
        isScrollingBack = true;
    }
    else {
        isScrollingBack = false;
    }
    // Set the previous scroll position
    scrollTop = currentScrollTop;
    // Do something if scrolling back
    // if (isScrollingBack && currentScrollTop > 300) {
    //     metabar.classList.add('is-active');
    //     console.log('Scrolling back!');
    //     area.style.paddingTop = '69px';
    // } else {
    //     metabar.classList.remove('is-active');
    //     console.log('Scrolling forward!');
    //     area.style.paddingTop = '0px';
    // }
});
