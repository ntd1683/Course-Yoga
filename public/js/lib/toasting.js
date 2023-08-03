/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/lib/toasting.js":
/*!**************************************!*\
  !*** ./resources/js/lib/toasting.js ***!
  \**************************************/
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
/*! toasting v0.1 | MIT License | https://github.com/tharith-p/toasting */
(function (root, factory) {
  try {
    if (( false ? 0 : _typeof(exports)) === "object") {
      module.exports = factory();
    } else {
      root.toasting = factory();
    }
  } catch (error) {
    console.log("Isomorphic compatibility is not supported at this time for toasting.");
  }
})(this, function () {
  if (document.readyState === "complete") {
    init();
  } else {
    window.addEventListener("DOMContentLoaded", init);
  }
  toasting = {
    create: function create() {
      console.error(["DOM has not finished loading.", "\tInvoke create method when DOMs readyState is complete"].join("\n"));
    }
  };
  var Timer = function Timer(callback, delay) {
    var timerId,
      start,
      remaining = delay;
    this.pause = function () {
      window.clearTimeout(timerId);
      timerId = null;
      remaining -= Date.now() - start;
    };
    this.resume = function () {
      if (timerId) {
        return;
      }
      start = Date.now();
      timerId = window.setTimeout(callback, remaining);
    };
    this.resume();
  };
  var getClassName = function getClassName(name) {
    var prefix = "tg";
    var seperater = "-";
    return prefix + seperater + name;
  };
  var dfIsHoverToPause = true;
  var dfTimeout = 4e3;
  var dfTitle = "Default Title";
  var dfType = "default";
  var dfAutoHide = true;
  var dfHideProgressBar = false;
  var dfProgressBarType = "";
  function init() {
    var container = document.createElement("div");
    container.id = getClassName("container");
    document.body.appendChild(container);
    toasting.create = function (options) {
      var _this$create$previous;
      this.create.previousState = ((_this$create$previous = this.create.previousState) !== null && _this$create$previous !== void 0 ? _this$create$previous : 0) + 1;
      var timer = undefined;
      var isHoverToPause = options.isHoverToPause !== undefined ? options.isHoverToPause : dfIsHoverToPause,
        timeout = options.timeout !== undefined ? options.timeout : dfTimeout,
        title = options.title !== undefined ? options.title : dfTitle,
        type = options.type !== undefined ? options.type : dfType,
        autoHide = options.autoHide !== undefined ? options.autoHide : dfAutoHide,
        hideProgressBar = options.hideProgressBar != undefined ? options.hideProgressBar : dfHideProgressBar,
        progressBarType = options.progressBarType != undefined ? options.progressBarType : dfProgressBarType,
        onHide = new Event("onHide"),
        onHidden = new Event("onHidden");
      var toasting = document.createElement("div");
      toasting.id = "toast-".concat(this.create.previousState);
      toasting.classList.add(getClassName("toast"));
      isHoverToPause && toasting.classList.add("hover:pause");
      var wrapper = document.createElement("div");
      var h4 = document.createElement("h4");
      h4.className = getClassName("title");
      h4.innerHTML = title;
      wrapper.appendChild(h4);
      if (options.text) {
        var p = document.createElement("p");
        p.className = getClassName("text");
        p.innerHTML = options.text;
        wrapper.appendChild(p);
      }
      if (options.icon) {
        wrapper.classList += " img";
        var img = document.createElement("img");
        img.src = options.icon;
        img.className = getClassName("icon");
        wrapper.appendChild(img);
      }
      if (!hideProgressBar) {
        var cssAnimation = document.createElement("style");
        cssAnimation.id = "style-".concat(toasting.id);
        var rules = document.createTextNode("\n                    @keyframes animate-".concat(this.create.previousState, " {\n                        0% {\n                            clip-path: inset(0px 0% 0px 0px);\n                        }\n                        100% {\n                            clip-path: inset(0px 100% 0px 0px);\n                        }\n                    }\n                "));
        cssAnimation.appendChild(rules);
        document.getElementsByTagName("head")[0].appendChild(cssAnimation);
        var progressBar = document.createElement("div");
        progressBar.classList.add("progress-bar");
        progressBar.style.animationName = "animate-".concat(this.create.previousState);
        progressBar.style.animationDuration = "".concat(timeout / 1e3, "s");
        progressBar.style.animationTimingFunction = "linear";
        progressBar.style.animationFillMode = "forwards";
        progressBarType != "" && progressBar.classList.add(progressBarType);
        wrapper.appendChild(progressBar);
      }
      if (typeof options.callback === "function") {
        toasting.addEventListener("click", options.callback);
      }
      if (isHoverToPause) {
        toasting.addEventListener("mouseenter", function (e) {
          timer != undefined && timer.pause();
        });
        toasting.addEventListener("mouseleave", function (e) {
          timer != undefined && timer.resume();
        });
      }
      toasting.isShowing = true;
      toasting.hide = function () {
        toasting.dispatchEvent(onHide);
        toasting.classList.add(getClassName("fadeOut"));
        toasting.addEventListener("animationend", removeToast, false);
        return null;
      };
      if (autoHide) {
        if (isHoverToPause) {
          timer = new Timer(toasting.hide, timeout + 200);
        } else {
          setTimeout(toasting.hide, timeout + 200);
        }
      }
      wrapper.classList.add(getClassName(type));
      toasting.addEventListener("click", toasting.hide);
      function removeToast() {
        document.getElementById(getClassName("container")).removeChild(toasting);
        var style = document.querySelector("#style-".concat(toasting.id));
        if (style) {
          style.remove();
        }
        toasting.dispatchEvent(onHidden);
        toasting.isShowing = false;
      }
      toasting.appendChild(wrapper);
      document.getElementById(getClassName("container")).appendChild(toasting);
      return toasting;
    };
  }
  return toasting;
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/js/lib/toasting.js");
/******/ 	
/******/ })()
;