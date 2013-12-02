"use strict";
var uuid = require('node-uuid');

module.exports = function (io, tables, shapes, middleware) {

	/**
	 *	auth
	 */
	io.configure(function () {
		io.set('authorization', function( handshakedata, callback) {
			//check if session is in table
			// global.allowed[] = uuid.v4() + uuid.v4();
		});
	});

	/**
	 * establish connections to rooms
	 */
	io.sockets.on("establish", function (socket) {

		socket.on("subscribe", function (room) {
			console.log("subscribing to channel " + room);
			socket.join(room);
		});

		socket.on("unsubscribe", function (room) {
			console.log("unsubscribing from channel " + room);
			socket.leave(room);
		});
	});
};