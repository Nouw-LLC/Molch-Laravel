const tokenProvider = new Chatkit.TokenProvider({
    url: "https://us1.pusherplatform.io/services/chatkit_token_provider/v1/fc00521c-4a8e-4d62-a65d-fc0398ca1dac/token"
});

const chatManager = new Chatkit.ChatManager({
    instanceLocator: "v1:us1:fc00521c-4a8e-4d62-a65d-fc0398ca1dac",
    userId: id,
    tokenProvider: tokenProvider
});

chatManager
    .connect()
    .then(currentUser => {
        currentUser.subscribeToRoomMultipart({
            roomId: room_id,
            hooks: {
                onMessage: message => {
                    console.log("Received message:", message);
                    const ul = document.getElementById("message-list");
                    const p = document.createElement("p");
                    p.appendChild(
                        document.createTextNode(`${message.sender.name}: ${
                            
                            message.parts[0].payload.content
                            }`)
                    );
                    ul.appendChild(p);

                },
                onUserStartedTyping: user => {
                    console.log(`User ${user.name} started typing`);
                    //Just add a div to the bottom of the cardbody and make it show when a user is typing.
                    // document.getElementById("card-header").innerHTML = `User ${user.name} started typing`
                },
                onUserStoppedTyping: user => {
                    console.log(`User ${user.name} stopped typing`);
                    //Just add a div to the bottom of the cardbody and make it hide when the user has stopped typing.
                    // document.getElementById("card-header").innerHTML = `User ${user.name} stopped typing`
                },
                onPresenceChanged: (state, user) => {
                    console.log(`User ${user.name} is ${state.current}`)
                }
            }
        });
        currentUser.isTypingIn({ roomId: room_id })
            .then(() => {
                console.log('Jah!');
            })
            .catch(err => {
                console.log(`Error sending typing indicator: ${err}`)
            });
        const form = document.getElementById("message-form");
        form.addEventListener("submit", e => {
            e.preventDefault();
            const input = document.getElementById("message-text");
            currentUser.sendSimpleMessage({
                text: input.value,
                roomId: currentUser.rooms[0].id
            });
            input.value = "";
        })
    })


    .catch(error => {
        console.error("error:", error);
    });
