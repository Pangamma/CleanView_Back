"use strict";

var async = require('async');


module.exports = function (app, tables, shapes, middleware) {
	//Blocking but will only run once
	var eventFields = shapes.events.map(function (elm) {
		return "events." + elm.Field;
	}).join(", ");

	var channelFields = shapes.enrollments.map(function (elm) {
		return "enrollments." + elm.Field;
	});

	var eventsQuery = "";
	eventsQuery += "SELECT " + eventFields + " FROM events ";
	eventsQuery += "JOIN enrollments ON events.course_id = enrollments.course_id ";
	eventsQuery += "JOIN users ON enrollments.user_id = users.user_id ";
	eventsQuery += "WHERE users.user_id = ";

	var channelsQuery = "";
	channelsQuery += "SELECT * FROM enrollments ";
	channelsQuery += "WHERE user_id = ";

	function validate(table, shape, callback) {
		if (!shapes[table]) return false; //invalid table name

		var validatedShape = {};

		function pidgen(obj, done) {
			if (shape[obj.Field]) {
				validatedShape[obj.Field] = shape[obj.Field];
			}
			done();
		}

		async.each(shapes[table], pidgen, function (err) {
			if (Object.keys(validatedShape).length < 1) {
				return callback("bad shape");
			}
			callback(err, validatedShape);
		});

	}

	/**
	 * establish
	 *	gathers user events and channels to subsribe to
	 */
	app.get("/:user/establish", middleware.readStack, function (req, res) {
		var user = tables.escape(req.params.user);
		var queryEvents = eventsQuery + user;
		var queryChannels = channelsQuery + user;
		var pings = 0;
		var holdingCells = [];

		function collectionDone(err, results) {
			holdingCells.push(results);
			if (++pings > 1) {
				console.log(holdingCells);
				res.send(holdingCells);
			}
		}

		tables.query(queryEvents, collectionDone);
		tables.query(queryChannels, function (err, channels) {
			collectionDone(err, channels.map(function (elm) {
				return elm.course_id;
			}));
		});


	});
	/**
	 * scan events
	 * /events?since={{time}}
	 */
	app.get("/:user/events", middleware.readStack, function (req, res) {
		var user = tables.escape(req.params.user);
		var query = eventsQuery + user;
		if (req.query.since) {
			query += " AND events.time >= " + tables.escape(req.query.since);
		}
		if (req.query.until) {
			query += " AND events.time <= " + tables.escape(req.query.until);
		}
		tables.query(query, function (err, events) {
			if (err) return res.send(500, err);
			return res.send(200, events);
		});
	});

	/**
	 * generic create route
	 */
	app.post("/:table/create", middleware.createStack, function (req, res) {
		var table = req.params.table;

		if (!(table in shapes)) return res.send(404, "entitiy does not exist"); //table does not exist
		if (!req.body) return res.send(400, "no query");

		validate(table, req.body, function (badShape, entity) {
			if (badShape) return res.send(400, badShape);

			tables.query("INSERT INTO " + table + " SET ?", entity, function (err) {
				if (err) {
					tables.rollback(function () {
						return res.send(500);
					});
				}
				res.send(200);
			});
		});
	});

	/**
	 *	generic read
	 *	does not search, returns exact matches only
	 */
	app.get('/:table/read', middleware.readStack, function (req, res) {
		var table = req.params.table;
		if (!(table in shapes)) return res.send(404, "entitiy does not exist"); //table does not exist
		if (!req.query) return res.send(400, "no query");

		validate(table, req.query, function (badShape, shaped) {
			if (badShape) return res.send(400, badShape);

			tables.query("SELECT * FROM " + table + " WHERE ? ", shaped, function (err, data) {
				if (err) return res.send(err);
				//TODO: validated data going out
				return res.send(data);
			});
		});
	});

};