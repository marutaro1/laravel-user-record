"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_StaffPage_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/StaffPage.vue?vue&type=script&lang=js":
/*!********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/StaffPage.vue?vue&type=script&lang=js ***!
  \********************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    login_user_id: String,
    select_staff_id: String,
    today: String,
    user_department: String
  },
  data: function data() {
    return {
      select_staff_data: {},
      select_staff_daily_works: [],
      select_staff_daily_work_array: [],
      change_work_check: [],
      work_check: [],
      staff_memo: '',
      staff_name: '・',
      complete_work_id: ''
    };
  },
  methods: {
    clickChangeWorkCheck: function clickChangeWorkCheck(key) {
      if (this.change_work_check[key] === 'false' || this.change_work_check[key] === '') {
        this.change_work_check[key] = 'true';
      } else if (this.change_work_check[key] === 'true') {
        this.change_work_check[key] = 'false';
      }
    },
    getSelectStaffDailyWorks: function getSelectStaffDailyWorks() {
      var _this = this;

      axios.get('/api/staff_daily_work/' + this.today + '/' + this.user_department + '/' + this.select_staff_id).then(function (res) {
        _this.select_staff_daily_works = res.data[0];
        var array_data = res.data[0].works.split(',');
        _this.select_staff_daily_work_array = Object.assign({}, array_data);

        for (var n = 0; n < array_data.length; n++) {
          _this.change_work_check.push('');
        }
      }).then(function () {
        _this.getCompleteWorkCheck();

        _this.postCompleteWorkCheck(_this.select_staff_daily_works.staff_name, _this.select_staff_daily_works.phs);
      });
    },
    postCompleteWorkCheck: function postCompleteWorkCheck(name, phs) {
      var _this2 = this;

      console.log(phs);
      console.log(this.staff_memo);
      var array = [];
      var responce_work = '';

      for (var i = 0; i < this.change_work_check.length; i++) {
        array.push('');
      }

      axios.get('/api/complete_works/' + this.today + '/' + this.select_staff_id).then(function (responce) {
        responce_work = responce;
        console.log(responce_work.data);
      }).then(function () {
        console.log(_this2.staff_memo);

        if (responce_work.data.length === 0) {
          console.log('1');
          _this2.staff_memo = '・';
          var add_work_check = {
            staff_id: phs,
            staff_name: _this2.select_staff_id,
            day: _this2.today,
            work_check: String(_this2.change_work_check),
            staff_memo: _this2.staff_memo
          };
          axios.post('/api/complete_works/' + _this2.today, add_work_check).then(function (res) {
            console.log(res.data);
            _this2.staff_memo = res.data.staff_memo;
          });
        } else if (_this2.staff_memo === '' && array !== _this2.change_work_check && responce_work.data.length !== 0) {
          console.log('2');
          console.log(responce_work.data);
          _this2.staff_memo = '・';
          var _add_work_check = {
            staff_id: phs,
            staff_name: _this2.select_staff_id,
            day: _this2.today,
            work_check: String(_this2.change_work_check),
            staff_memo: _this2.staff_memo
          };
          axios.post('/api/complete_works/' + _this2.today + '/' + _this2.select_staff_id, _add_work_check).then(function (res) {
            console.log(res.data);
            _this2.staff_memo = res.data.staff_memo;
          });
        } else {
          console.log('3');
          var _add_work_check2 = {
            staff_id: phs,
            staff_name: _this2.select_staff_id,
            day: _this2.today,
            work_check: String(_this2.change_work_check),
            staff_memo: _this2.staff_memo
          };
          axios.post('/api/complete_works/' + _this2.today + '/' + _this2.select_staff_id, _add_work_check2).then(function (res) {
            console.log(res.data);
            _this2.staff_memo = res.data.staff_memo;
          });
        }
      });
    },
    getCompleteWorkCheck: function getCompleteWorkCheck() {
      var _this3 = this;

      axios.get('/api/complete_works/' + this.today + '/' + this.select_staff_id).then(function (res) {
        if (res.data.length === 0) {
          console.log(res.data);
        } else {
          console.log(res.data);
          _this3.change_work_check = res.data[0].work_check.split(',');
          console.log(_this3.change_work_check);
          _this3.staff_memo = res.data[0].staff_memo;
          console.log('this.staff_memo');
          console.log(_this3.staff_memo);
          _this3.complete_work_id = res.data[0].id;
        }
      });
    }
  },
  created: function created() {
    var _this4 = this;

    axios.get('/api/users/name/' + this.select_staff_id).then(function (responce) {
      _this4.select_staff_data = responce.data[0];
    });
    console.log(this.select_staff_id);
    this.getSelectStaffDailyWorks();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[4]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/StaffPage.vue?vue&type=template&id=4d4d1798":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[4]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/StaffPage.vue?vue&type=template&id=4d4d1798 ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _hoisted_1 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h3", null, "業務編集", -1
/* HOISTED */
);

var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("戻る");

var _hoisted_3 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 未遂 ");

var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 完了 ");

var _hoisted_5 = ["onClick"];
var _hoisted_6 = {
  key: 0
};
var _hoisted_7 = {
  key: 1
};

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "col-2 col-form-label"
}, "メモ:", -1
/* HOISTED */
);

var _hoisted_9 = {
  "class": "col-lg-5 col-8"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", null, [_hoisted_1, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: '/staffdaywork/' + $props.login_user_id + '/' + this.today + '/works',
    "class": "btn btn-primary p-1"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_2];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["to"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, "職員名: " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.select_staff_daily_works.staff_name), 1
  /* TEXT */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, "PHS番号: " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(String($data.select_staff_daily_works.phs).slice(0, 3)), 1
  /* TEXT */
  ), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.select_staff_daily_work_array, function (select_staff_daily_work, key) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
      key: key
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(select_staff_daily_work) + ": ", 1
    /* TEXT */
    ), $data.change_work_check[key] === '' || $data.change_work_check[key] === 'false' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [_hoisted_3], 2112
    /* STABLE_FRAGMENT, DEV_ROOT_FRAGMENT */
    )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [_hoisted_4], 2112
    /* STABLE_FRAGMENT, DEV_ROOT_FRAGMENT */
    )), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      onClick: function onClick($event) {
        return $options.clickChangeWorkCheck(key);
      },
      "class": "btn btn-primary p-1"
    }, [$data.change_work_check[key] === '' || $data.change_work_check[key] === 'false' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_6, "完了")) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_7, "未遂"))], 8
    /* PROPS */
    , _hoisted_5)])]);
  }), 128
  /* KEYED_FRAGMENT */
  ))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.staff_memo = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.staff_memo]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[1] || (_cache[1] = function ($event) {
      return $options.postCompleteWorkCheck($data.select_staff_daily_works.staff_name, $data.select_staff_daily_works.phs.slice(0, 3));
    }),
    "class": "my-2 btn btn-primary"
  }, " 登録 ")])]);
}

/***/ }),

/***/ "./resources/js/components/StaffPage.vue":
/*!***********************************************!*\
  !*** ./resources/js/components/StaffPage.vue ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _StaffPage_vue_vue_type_template_id_4d4d1798__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./StaffPage.vue?vue&type=template&id=4d4d1798 */ "./resources/js/components/StaffPage.vue?vue&type=template&id=4d4d1798");
/* harmony import */ var _StaffPage_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./StaffPage.vue?vue&type=script&lang=js */ "./resources/js/components/StaffPage.vue?vue&type=script&lang=js");
/* harmony import */ var _work_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_work_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_StaffPage_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_StaffPage_vue_vue_type_template_id_4d4d1798__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/StaffPage.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/StaffPage.vue?vue&type=script&lang=js":
/*!***********************************************************************!*\
  !*** ./resources/js/components/StaffPage.vue?vue&type=script&lang=js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_6_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_StaffPage_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_6_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_StaffPage_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./StaffPage.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/StaffPage.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/StaffPage.vue?vue&type=template&id=4d4d1798":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/StaffPage.vue?vue&type=template&id=4d4d1798 ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_6_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_4_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_StaffPage_vue_vue_type_template_id_4d4d1798__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_6_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_4_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_StaffPage_vue_vue_type_template_id_4d4d1798__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[4]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./StaffPage.vue?vue&type=template&id=4d4d1798 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-6.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[4]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/StaffPage.vue?vue&type=template&id=4d4d1798");


/***/ })

}]);