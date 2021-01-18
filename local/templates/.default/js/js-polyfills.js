(function() {
    // проверяем поддержку
    if (!Element.prototype.closest) {
        // реализуем
        Element.prototype.closest = function(css) {
            let node = this;

            while (node) {
                if (node.matches(css)) return node;
                else node = node.parentElement;
            }
            return null;
        };
    }
})();

(function() {
    // проверяем поддержку
    if (!Element.prototype.matches) {
        // определяем свойство
        Element.prototype.matches = Element.prototype.matchesSelector ||
            Element.prototype.webkitMatchesSelector ||
            Element.prototype.mozMatchesSelector ||
            Element.prototype.msMatchesSelector;
    }
})();

// Source: https://github.com/jserz/js_piece/blob/master/DOM/ParentNode/prepend()/prepend().md
(function (arr) {
    arr.forEach(function (item) {
        if (item.hasOwnProperty('prepend')) {
            return;
        }
        Object.defineProperty(item, 'prepend', {
            configurable: true,
            enumerable: true,
            writable: true,
            value: function prepend() {
                let argArr = Array.prototype.slice.call(arguments),
                    docFrag = document.createDocumentFragment();

                argArr.forEach(function (argItem) {
                    let isNode = argItem instanceof Node;
                    docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
                });

                this.insertBefore(docFrag, this.firstChild);
            }
        });
    });
})([Element.prototype, Document.prototype, DocumentFragment.prototype]);

// Источник: https://github.com/jserz/js_piece/blob/master/DOM/NonDocumentTypeChildNode/nextElementSibling/nextElementSibling.md
(function(arr) {
    arr.forEach(function(item) {
        if (item.hasOwnProperty('nextElementSibling')) {
            return;
        }
        Object.defineProperty(item, 'nextElementSibling', {
            configurable: true,
            enumerable: true,
            get: function() {
                var el = this;
                while (el = el.nextSibling) {
                    if (el.nodeType === 1) {
                        return el;
                    }
                }
                return null;
            },
            set: undefined
        });
    });
})([Element.prototype, CharacterData.prototype]);

// Источник: https://github.com/jserz/js_piece/blob/master/DOM/NonDocumentTypeChildNode/nextElementSibling/nextElementSibling.md
(function(arr) {
    arr.forEach(function(item) {
        if (item.hasOwnProperty('nextElementSibling')) {
            return;
        }
        Object.defineProperty(item, 'nextElementSibling', {
            configurable: true,
            enumerable: true,
            get: function() {
                var el = this;
                while (el = el.nextSibling) {
                    if (el.nodeType === 1) {
                        return el;
                    }
                }
                return null;
            },
            set: undefined
        });
    });
})([Element.prototype, CharacterData.prototype]);

// Источник: https://gist.github.com/k-gun/c2ea7c49edf7b757fe9561ba37cb19ca
;(function() {
    // helpers
    var regExp = function(name) {
        return new RegExp('(^| )'+ name +'( |$)');
    };
    var forEach = function(list, fn, scope) {
        for (var i = 0; i < list.length; i++) {
            fn.call(scope, list[i]);
        }
    };

    // class list object with basic methods
    function ClassList(element) {
        this.element = element;
    }

    ClassList.prototype = {
        add: function() {
            forEach(arguments, function(name) {
                if (!this.contains(name)) {
                    this.element.className += ' '+ name;
                }
            }, this);
        },
        remove: function() {
            forEach(arguments, function(name) {
                this.element.className =
                    this.element.className.replace(regExp(name), '');
            }, this);
        },
        toggle: function(name) {
            return this.contains(name)
                ? (this.remove(name), false) : (this.add(name), true);
        },
        contains: function(name) {
            return regExp(name).test(this.element.className);
        },
        // bonus..
        replace: function(oldName, newName) {
            this.remove(oldName), this.add(newName);
        }
    };

    // IE8/9, Safari
    if (!('classList' in Element.prototype)) {
        Object.defineProperty(Element.prototype, 'classList', {
            get: function() {
                return new ClassList(this);
            }
        });
    }

    // replace() support for others
    if (window.DOMTokenList && DOMTokenList.prototype.replace == null) {
        DOMTokenList.prototype.replace = ClassList.prototype.replace;
    }
})();

if (!Math.trunc) {
    Math.trunc = function(v) {
        v = +v;
        if (!isFinite(v)) return v;

        return (v - v % 1)   ||   (v < 0 ? -0 : v === 0 ? v : 0);

        // returns:
        //  0        ->  0
        // -0        -> -0
        //  0.2      ->  0
        // -0.2      -> -0
        //  0.7      ->  0
        // -0.7      -> -0
        //  Infinity ->  Infinity
        // -Infinity -> -Infinity
        //  NaN      ->  NaN
        //  null     ->  0
    };
}