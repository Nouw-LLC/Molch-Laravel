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
        console.log("Connected as user ", currentUser);
        currentUser.getJoinableRooms()
            .then(rooms => {

            })
    })
    .catch(error => {
        console.error("error:", error);
    });
