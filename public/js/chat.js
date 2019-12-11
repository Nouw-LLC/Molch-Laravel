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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/Chat-components/chat.js":
/*!**********************************************!*\
  !*** ./resources/js/Chat-components/chat.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var tokenProvider = new Chatkit.TokenProvider({
  url: "https://us1.pusherplatform.io/services/chatkit_token_provider/v1/fc00521c-4a8e-4d62-a65d-fc0398ca1dac/token"
});
var chatManager = new Chatkit.ChatManager({
  instanceLocator: "v1:us1:fc00521c-4a8e-4d62-a65d-fc0398ca1dac",
  userId: id,
  tokenProvider: tokenProvider
});
chatManager.connect().then(function (currentUser) {
  var cursor = currentUser.readCursor({
    roomId: room_id
  });
  console.log("read up to message ID ".concat(cursor.position, " in ").concat(cursor.room.name, "."));
  currentUser.subscribeToRoomMultipart({
    roomId: room_id,
    hooks: {
      onMessage: function onMessage(message) {
        console.log("Received message:", message);
        var ul = document.getElementById("message-list");
        var p = document.createElement("p");
        p.className = "".concat(message.id);
        p.appendChild(document.createTextNode("".concat(message.sender.name, ": ").concat(message.parts[0].payload.content), console.log(message.sender.avatarURL)));
        ul.appendChild(p);
      },
      onUserStartedTyping: function onUserStartedTyping(user) {
        console.log("User ".concat(user.name, " started typing")); //Just add a div to the bottom of the cardbody and make it show when a user is typing.
        // document.getElementById("card-header").innerHTML = `User ${user.name} started typing`
      },
      onUserStoppedTyping: function onUserStoppedTyping(user) {
        console.log("User ".concat(user.name, " stopped typing")); //Just add a div to the bottom of the cardbody and make it hide when the user has stopped typing.
        // document.getElementById("card-header").innerHTML = `User ${user.name} stopped typing`
      },
      onPresenceChanged: function onPresenceChanged(state, user) {
        console.log("User ".concat(user.name, " is ").concat(state.current));
        document.getElementById('username').innerHTML = otherUser;
        console.log(state.current);

        if (state.current == "offline") {
          document.getElementById('presence').style.color = 'red';
        } else {
          document.getElementById('presence').style.color = 'green';
        }
      }
    }
  });
  currentUser.isTypingIn({
    roomId: room_id
  }).then(function () {
    console.log('Jah!');
  })["catch"](function (err) {
    console.log("Error sending typing indicator: ".concat(err));
  });
  var form = document.getElementById("message-form");
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    var input = document.getElementById("message-text");
    currentUser.sendSimpleMessage({
      text: input.value,
      roomId: currentUser.rooms[0].id
    });
    input.value = "";
  });
  return p.offsetParent() === null;
})["catch"](function (error) {
  console.error("error:", error);
});

/***/ }),

/***/ 1:
/*!****************************************************!*\
  !*** multi ./resources/js/Chat-components/chat.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/gebruiker/Sites/Molch/resources/js/Chat-components/chat.js */"./resources/js/Chat-components/chat.js");


/***/ })

/******/ });