!function(e){var n={};function t(o){if(n[o])return n[o].exports;var r=n[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,t),r.l=!0,r.exports}t.m=e,t.c=n,t.d=function(e,n,o){t.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:o})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,n){if(1&n&&(e=t(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(t.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var r in e)t.d(o,r,function(n){return e[n]}.bind(null,r));return o},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},t.p="/",t(t.s=41)}({41:function(e,n,t){e.exports=t(42)},42:function(e,n){var t=new Chatkit.TokenProvider({url:"https://us1.pusherplatform.io/services/chatkit_token_provider/v1/fc00521c-4a8e-4d62-a65d-fc0398ca1dac/token"});new Chatkit.ChatManager({instanceLocator:"v1:us1:fc00521c-4a8e-4d62-a65d-fc0398ca1dac",userId:id,tokenProvider:t}).connect().then(function(e){e.subscribeToRoomMultipart({roomId:room_id,hooks:{onMessage:function(e){console.log("Received message:",e);var n=document.getElementById("message-list"),t=document.createElement("p");t.appendChild(document.createTextNode("".concat(e.sender.name,": ").concat(e.parts[0].payload.content),console.log(e.sender.avatarURL))),n.appendChild(t)},onUserStartedTyping:function(e){console.log("User ".concat(e.name," started typing"))},onUserStoppedTyping:function(e){console.log("User ".concat(e.name," stopped typing"))},onPresenceChanged:function(e,n){console.log("User ".concat(n.name," is ").concat(e.current)),document.getElementById("username").innerHTML=otherUser,console.log(e.current),"offline"==e.current?document.getElementById("presence").style.color="red":document.getElementById("presence").style.color="green"}}}),e.isTypingIn({roomId:room_id}).then(function(){console.log("Jah!")}).catch(function(e){console.log("Error sending typing indicator: ".concat(e))}),document.getElementById("message-form").addEventListener("submit",function(n){n.preventDefault();var t=document.getElementById("message-text");e.sendSimpleMessage({text:t.value,roomId:e.rooms[0].id}),t.value=""})}).catch(function(e){console.error("error:",e)})}});