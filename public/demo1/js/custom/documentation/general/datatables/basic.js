/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/core/js/custom/documentation/general/datatables/basic.js":
/*!***********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/general/datatables/basic.js ***!
  \***********************************************************************************/
/***/ (() => {

eval(" // Class definition\n\nvar KTDatatablesBasic = function () {\n  // Private functions\n  var initZeroConfiguration = function initZeroConfiguration() {\n    $(\"#kt_datatable_zero_configuration\").DataTable();\n  };\n\n  var initVerticalScroll = function initVerticalScroll() {\n    $(\"#kt_datatable_vertical_scroll\").DataTable({\n      \"scrollY\": \"500px\",\n      \"scrollCollapse\": true,\n      \"paging\": false,\n      \"dom\": \"<'table-responsive'tr>\"\n    });\n  };\n\n  var initHorizontalScroll = function initHorizontalScroll() {\n    $(\"#kt_datatable_horizontal_scroll\").DataTable({\n      \"scrollX\": true\n    });\n  };\n\n  var initBothScrolls = function initBothScrolls() {\n    $(\"#kt_datatable_both_scrolls\").DataTable({\n      \"scrollY\": 300,\n      \"scrollX\": true\n    });\n  };\n\n  var initFixedColumns = function initFixedColumns() {\n    $(\"#kt_datatable_fixed_columns\").DataTable({\n      scrollY: \"300px\",\n      scrollX: true,\n      scrollCollapse: true,\n      fixedColumns: {\n        left: 2\n      }\n    });\n  }; // Public methods\n\n\n  return {\n    init: function init() {\n      initZeroConfiguration();\n      initVerticalScroll();\n      initHorizontalScroll();\n      initBothScrolls();\n      initFixedColumns();\n    }\n  };\n}(); // On document ready\n\n\nKTUtil.onDOMContentLoaded(function () {\n  KTDatatablesBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZ2VuZXJhbC9kYXRhdGFibGVzL2Jhc2ljLmpzLmpzIiwibWFwcGluZ3MiOiJDQUVBOztBQUNBLElBQUlBLGlCQUFpQixHQUFHLFlBQVk7RUFDaEM7RUFFQSxJQUFJQyxxQkFBcUIsR0FBRyxTQUF4QkEscUJBQXdCLEdBQVc7SUFDbkNDLENBQUMsQ0FBQyxrQ0FBRCxDQUFELENBQXNDQyxTQUF0QztFQUNILENBRkQ7O0VBSUEsSUFBSUMsa0JBQWtCLEdBQUcsU0FBckJBLGtCQUFxQixHQUFXO0lBQ2hDRixDQUFDLENBQUMsK0JBQUQsQ0FBRCxDQUFtQ0MsU0FBbkMsQ0FBNkM7TUFDekMsV0FBa0IsT0FEdUI7TUFFekMsa0JBQWtCLElBRnVCO01BR3pDLFVBQWtCLEtBSHVCO01BSXpDLE9BQVM7SUFKZ0MsQ0FBN0M7RUFNSCxDQVBEOztFQVNBLElBQUlFLG9CQUFvQixHQUFHLFNBQXZCQSxvQkFBdUIsR0FBVztJQUNsQ0gsQ0FBQyxDQUFDLGlDQUFELENBQUQsQ0FBcUNDLFNBQXJDLENBQStDO01BQzNDLFdBQVc7SUFEZ0MsQ0FBL0M7RUFHSCxDQUpEOztFQU1BLElBQUlHLGVBQWUsR0FBRyxTQUFsQkEsZUFBa0IsR0FBVztJQUM3QkosQ0FBQyxDQUFDLDRCQUFELENBQUQsQ0FBZ0NDLFNBQWhDLENBQTBDO01BQ3RDLFdBQVcsR0FEMkI7TUFFdEMsV0FBVztJQUYyQixDQUExQztFQUlILENBTEQ7O0VBT0EsSUFBSUksZ0JBQWdCLEdBQUcsU0FBbkJBLGdCQUFtQixHQUFXO0lBQzlCTCxDQUFDLENBQUMsNkJBQUQsQ0FBRCxDQUFpQ0MsU0FBakMsQ0FBMkM7TUFDdkNLLE9BQU8sRUFBUyxPQUR1QjtNQUV2Q0MsT0FBTyxFQUFTLElBRnVCO01BR3ZDQyxjQUFjLEVBQUUsSUFIdUI7TUFJdkNDLFlBQVksRUFBSTtRQUNaQyxJQUFJLEVBQUU7TUFETTtJQUp1QixDQUEzQztFQVFILENBVEQsQ0E3QmdDLENBd0NoQzs7O0VBQ0EsT0FBTztJQUNIQyxJQUFJLEVBQUUsZ0JBQVk7TUFDZFoscUJBQXFCO01BQ3JCRyxrQkFBa0I7TUFDbEJDLG9CQUFvQjtNQUNwQkMsZUFBZTtNQUNmQyxnQkFBZ0I7SUFDbkI7RUFQRSxDQUFQO0FBU0gsQ0FsRHVCLEVBQXhCLEMsQ0FvREE7OztBQUNBTyxNQUFNLENBQUNDLGtCQUFQLENBQTBCLFlBQVc7RUFDakNmLGlCQUFpQixDQUFDYSxJQUFsQjtBQUNILENBRkQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZ2VuZXJhbC9kYXRhdGFibGVzL2Jhc2ljLmpzP2MxOWUiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcbnZhciBLVERhdGF0YWJsZXNCYXNpYyA9IGZ1bmN0aW9uICgpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcblxyXG4gICAgdmFyIGluaXRaZXJvQ29uZmlndXJhdGlvbiA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICQoXCIja3RfZGF0YXRhYmxlX3plcm9fY29uZmlndXJhdGlvblwiKS5EYXRhVGFibGUoKTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgaW5pdFZlcnRpY2FsU2Nyb2xsID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgJChcIiNrdF9kYXRhdGFibGVfdmVydGljYWxfc2Nyb2xsXCIpLkRhdGFUYWJsZSh7XHJcbiAgICAgICAgICAgIFwic2Nyb2xsWVwiOiAgICAgICAgXCI1MDBweFwiLFxyXG4gICAgICAgICAgICBcInNjcm9sbENvbGxhcHNlXCI6IHRydWUsXHJcbiAgICAgICAgICAgIFwicGFnaW5nXCI6ICAgICAgICAgZmFsc2UsXHJcbiAgICAgICAgICAgIFwiZG9tXCI6ICAgXCI8J3RhYmxlLXJlc3BvbnNpdmUndHI+XCIgXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgdmFyIGluaXRIb3Jpem9udGFsU2Nyb2xsID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgJChcIiNrdF9kYXRhdGFibGVfaG9yaXpvbnRhbF9zY3JvbGxcIikuRGF0YVRhYmxlKHtcclxuICAgICAgICAgICAgXCJzY3JvbGxYXCI6IHRydWVcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgaW5pdEJvdGhTY3JvbGxzID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgJChcIiNrdF9kYXRhdGFibGVfYm90aF9zY3JvbGxzXCIpLkRhdGFUYWJsZSh7XHJcbiAgICAgICAgICAgIFwic2Nyb2xsWVwiOiAzMDAsXHJcbiAgICAgICAgICAgIFwic2Nyb2xsWFwiOiB0cnVlXHJcbiAgICAgICAgfSk7XHJcbiAgICB9ICBcclxuXHJcbiAgICB2YXIgaW5pdEZpeGVkQ29sdW1ucyA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICQoXCIja3RfZGF0YXRhYmxlX2ZpeGVkX2NvbHVtbnNcIikuRGF0YVRhYmxlKHtcclxuICAgICAgICAgICAgc2Nyb2xsWTogICAgICAgIFwiMzAwcHhcIixcclxuICAgICAgICAgICAgc2Nyb2xsWDogICAgICAgIHRydWUsXHJcbiAgICAgICAgICAgIHNjcm9sbENvbGxhcHNlOiB0cnVlLFxyXG4gICAgICAgICAgICBmaXhlZENvbHVtbnM6ICAge1xyXG4gICAgICAgICAgICAgICAgbGVmdDogMlxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgLy8gUHVibGljIG1ldGhvZHNcclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICBpbml0WmVyb0NvbmZpZ3VyYXRpb24oKTtcclxuICAgICAgICAgICAgaW5pdFZlcnRpY2FsU2Nyb2xsKCk7XHJcbiAgICAgICAgICAgIGluaXRIb3Jpem9udGFsU2Nyb2xsKCk7XHJcbiAgICAgICAgICAgIGluaXRCb3RoU2Nyb2xscygpO1xyXG4gICAgICAgICAgICBpbml0Rml4ZWRDb2x1bW5zKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5LVFV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uKCkge1xyXG4gICAgS1REYXRhdGFibGVzQmFzaWMuaW5pdCgpO1xyXG59KTsiXSwibmFtZXMiOlsiS1REYXRhdGFibGVzQmFzaWMiLCJpbml0WmVyb0NvbmZpZ3VyYXRpb24iLCIkIiwiRGF0YVRhYmxlIiwiaW5pdFZlcnRpY2FsU2Nyb2xsIiwiaW5pdEhvcml6b250YWxTY3JvbGwiLCJpbml0Qm90aFNjcm9sbHMiLCJpbml0Rml4ZWRDb2x1bW5zIiwic2Nyb2xsWSIsInNjcm9sbFgiLCJzY3JvbGxDb2xsYXBzZSIsImZpeGVkQ29sdW1ucyIsImxlZnQiLCJpbml0IiwiS1RVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/general/datatables/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/general/datatables/basic.js"]();
/******/ 	
/******/ })()
;