"use strict";

module.exports = function (io, tables, shapes, middleware) {

	/**
	 * establish connections to rooms
	 */
	io.sockets.on("establish", function (socket) {

		socket.on("subscribe", function (room) {
			console.log("subscribing to channel " + room);
			socket.join(room);
		});

		socket.on('unsubscribe', function (room) {
			console.log('unsubscribing from channel ' + room);
			socket.leave(room);
		});
	});
};