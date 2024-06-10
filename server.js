import express from "express";
import http from "http";
import { Server } from "socket.io";

const app = express();

const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"],
        allowedHeaders: ["my-custom-header"],
        credentials: true,
    },
});

// Global variables to store the received data and connected users
let receivedData = null;
let connectedUsers = [];

// Add a route to handle GET requests
app.get("/", (req, res) => {
    const address = server.address();
    const host = address.address === "::" ? "localhost" : address.address;
    const port = address.port;
    res.send(`
        <h1>Socket.IO server is running on http://${host}:${port}</h1>
        <h2>Connected Users:</h2>
        <pre>${JSON.stringify(connectedUsers, null, 2)}</pre>
        <h2>Received Data:</h2>
        <pre>${
            receivedData
                ? JSON.stringify(receivedData, null, 2)
                : "No data received yet"
        }</pre>
        <form action="/reset" method="POST">
            <button type="submit">Reset Data</button>
        </form>
    `);
});

app.post("/reset", (req, res) => {
    receivedData = null;
    connectedUsers = [];
    res.redirect("/");
});

io.on("connection", (socket) => {
    console.log("A user connected:", socket.id);
    connectedUsers.push(socket.id);

    io.emit("user-connected", socket.id);

    socket.on("send-data", (data) => {
        console.log("Data received:", data);
        receivedData = data;
        io.emit("receive-data", data);
    });

    socket.on("disconnect", () => {
        console.log("User disconnected:", socket.id);
        connectedUsers = connectedUsers.filter((id) => id !== socket.id);
        io.emit("user-disconnected", socket.id);
    });
});

const PORT = process.env.PORT || 3000;

server.listen(PORT, () => {
    const address = server.address();
    const host = address.address === "::" ? "localhost" : address.address;
    const port = address.port;
    console.log(`Socket.IO server listening on http://${host}:${port}`);
});
