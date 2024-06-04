import express from "express";
import http from "http";
import { Server } from "socket.io";

// const express = require("express");
// const http = require("http");
// const { Server } = require("socket.io");

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: "*", // Change to your specific domain or "*" to allow all
        methods: ["GET", "POST"],
        allowedHeaders: ["my-custom-header"],
        credentials: true,
    },
});

// Add a route to handle GET requests
app.get("/", (req, res) => {
    const address = server.address();
    const host = address.address === "::" ? "localhost" : address.address;
    const port = address.port;
    res.send(`Socket.IO server is running on http://${host}:${port}`);
});

io.on("connection", (socket) => {
    console.log("A user connected");

    socket.on("send-data", (data) => {
        console.log("Data received:", data);
        // Broadcast data to all connected clients
        io.emit("receive-data", data);
    });

    socket.on("disconnect", () => {
        console.log("User disconnected");
    });
});

const PORT = process.env.PORT || 1234;

server.listen(PORT, () => {
    const address = server.address();
    const host = address.address === "::" ? "localhost" : address.address;
    const port = address.port;
    console.log(`Socket.IO server listening on http://${host}:${port}`);
});
