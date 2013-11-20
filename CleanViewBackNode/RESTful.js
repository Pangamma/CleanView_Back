"use strict";

module.exports = function (app, tables, shapes, middleware, finished) {

	function validate(table, shape) {
		if (!shapes[table]) return false; //invalid table name

		var validatedShape = {};
		shapes[table].forEach(function (elm, ind) {
			validatedShape[elm.Field] = shape[elm.Field];
		});

		return validatedShape
	}

	/**
	 * scan events
	 * /events?since={{time}}
	 */
	app.get("/:user/events", middleware.readStack, function (req, res) {
		var user = tables.escape(req.params.user);
		var since = (req.query.since) ? table.escape(req.query.since) : '';
		var start = (req.query.start) ? table.escape(req.query.start) : '';
		console.log("dd");
		//four joins to query events by users seems a bit much
		tables.query("SELECT * FROM events JOIN courses ON events.Courseid = courses.id JOIN enrollments ON courses.id = enrollments.courseid JOIN users on enrollments.studentid = users.id WHERE user.user_id = " + user, function(err, events){
			if(err) return res.send(500, err);
			return res.send(200, events);
		});
	});

	/**
	 * generic create route
	 */
	app.post("/:table/create", middleware.createStack, function (req, res) {
		var table = req.params.table;
		var entity = validate(table, req.body);
		if (entity) {
			tables.query("INSERT INTO " + table + " SET ?", entity, function (err, data) {
				if (err) {
					tables.rollback(function () {
						return res.send(500);
					});
				}
				res.send(200);
			});
		}
	});

	/**
	 *	generic read
	 *	does not search, returns exact matches only
	 */
	app.get('/:table/read', middleware.readStack, function (req, res) {
		var table = req.params.table;
		if (!(table in shapes)) return res.send(404, "entitiy does not exist") //table does not exist
		if (!req.query) return res.send(400, "no query");
		tables.query("SELECT * FROM " + table + " WHERE ? ", req.query, function (err, data) {
			if (err) return res.send(err);
			//TODO: validated data going out
			return res.send(data);
		})
	});

};