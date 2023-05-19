/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app/castom_select.js":
/*!*******************************************!*\
  !*** ./resources/js/app/castom_select.js ***!
  \*******************************************/
/***/ (() => {

var hidden_activ = document.querySelectorAll('.input_block_select');
var select_item = document.querySelectorAll('.select__item');
hidden_activ.forEach(function (i) {
  i.addEventListener('click', selectToggle);
});
select_item.forEach(function (i) {
  i.addEventListener('click', selectText);
});
function selectToggle() {
  var lines = this.querySelector('.line');
  lines.classList.toggle('line_animation');
  this.parentElement.classList.toggle('isActiv');
}
function selectText() {
  var innerText = this.dataset.value;
  var currentText = this.closest('.select__input').querySelector('.info_block_select');
  var delActiv = this.closest('.select__input');
  delActiv.classList.remove('isActiv');
  var lines = this.closest('.select__input').querySelector('.line');
  lines.classList.toggle('line_animation');
  var hiddenInput = this.closest('.select__input').querySelector('.value_select');
  hiddenInput.value = innerText;
  console.log(hiddenInput);
  currentText.innerText = innerText;
}

/***/ }),

/***/ "./resources/js/app/preloader.js":
/*!***************************************!*\
  !*** ./resources/js/app/preloader.js ***!
  \***************************************/
/***/ (() => {

window.onload = function () {
  var preloader = document.getElementById('preloader');
  document.querySelector('.body__index').classList.remove('noscroll');
  preloader.style.opacity = "0";
  setTimeout(function () {
    preloader.style.display = 'none';
  }, 1100);
};

/***/ }),

/***/ "./resources/js/app/script.js":
/*!************************************!*\
  !*** ./resources/js/app/script.js ***!
  \************************************/
/***/ (() => {

var burgerMenu = document.querySelector('.hamb__field');
var popup = document.querySelector('.popup');
var spanBar = burgerMenu.querySelectorAll('.bar');
var mainMenu = document.querySelector('.buttons__account');
burgerMenu.addEventListener('click', clickOnTheBurger);
function clickOnTheBurger() {
  popup.classList.toggle('active');
  spanBar.forEach(function (item) {
    item.classList.toggle('turn');
  });
  popup.append(mainMenu);
}
var bg = document.querySelector('.registration-cssave');
if (bg !== null) {
  console.log(bg);
  window.addEventListener('mousemove', function (e) {
    var x = e.clientX / window.innerWidth;
    var y = e.clientY / window.innerHeight;
    bg.style.transform = 'translate(-' + x * 50 + 'px, -' + y * 50 + 'px)';
  });
}

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
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _app_script_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./app/script.js */ "./resources/js/app/script.js");
/* harmony import */ var _app_script_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_app_script_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _app_castom_select_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./app/castom_select.js */ "./resources/js/app/castom_select.js");
/* harmony import */ var _app_castom_select_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_app_castom_select_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _app_preloader_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./app/preloader.js */ "./resources/js/app/preloader.js");
/* harmony import */ var _app_preloader_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_app_preloader_js__WEBPACK_IMPORTED_MODULE_2__);



})();

/******/ })()
;