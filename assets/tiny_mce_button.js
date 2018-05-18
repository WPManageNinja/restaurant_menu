/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(4);


/***/ }),
/* 4 */
/***/ (function(module, exports) {

(function () {
    tinymce.PluginManager.add('res_ninja_shortcodes', function (editor, url) {

        editor.addButton('shortCode', {

            text: 'Restaurant Menu ShortCode',
            icon: false,
            onclick: function onclick() {
                // Open window
                editor.windowManager.open({
                    title: 'Select ShortCode',
                    body: [{
                        type: 'listbox',
                        name: 'display',
                        label: 'Display',
                        values: [{ text: 'Default', value: 'default' }, { text: 'Meal Type Menu', value: 'meal_type' }, { text: 'Dish Type Menu', value: 'dish_type' }, { text: 'Featured Style A', value: 'feat_style_a' }, { text: 'Featured Style B', value: 'feat_style_b' }, { text: 'Featured Style C', value: 'feat_style_c' }],
                        minWidth: 350
                    }, {
                        type: 'checkbox',
                        name: 'breakfast',
                        label: 'Breakfast',
                        classes: 'what'
                    }, {
                        type: 'checkbox',
                        name: 'dessert',
                        label: 'Dessert',
                        classes: 'what'
                    }, {
                        type: 'checkbox',
                        name: 'creeps',
                        label: 'Creeps',
                        classes: 'what'
                    }, {
                        type: 'checkbox',
                        name: 'cup-cakes',
                        label: 'Cup Cakes',
                        classes: 'what'
                    }, {
                        type: 'checkbox',
                        name: 'ice-cakes',
                        label: 'Ice Cream',
                        classes: 'what'
                    }, {
                        type: 'checkbox',
                        name: 'pancakes',
                        label: 'Pancakes',
                        classes: 'what'
                    }, {
                        type: 'checkbox',
                        name: 'sylhet',
                        label: 'Sylhet',
                        classes: 'what'
                    }, {
                        type: 'checkbox',
                        name: 'dhaka',
                        label: 'Dhaka',
                        classes: 'what'
                    }],
                    onsubmit: function onsubmit(e) {
                        // Insert content when the window form is submitted
                        editor.setContent('');
                        // console.log(e.data);
                        editor.insertContent('[restaurant_menu display="' + e.data.display + '" meal_type="' + e.data.meal_type + '" dish_type="' + e.data.dish_type + '" location="' + e.data.location + '"]');
                    }
                });
            }

        });
    });
})();

/***/ })
/******/ ]);