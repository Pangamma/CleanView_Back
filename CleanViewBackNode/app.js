"use strict"	;
/**
 *	app.js
 * Clean view back sockets
 */
var async = require('async');
var cred = require('./configs.json');
var shapes = {};
var middleware = require('./middleware.js')();
var fs = require('fs');

/**
*	TODO:
*		- logger
*/

/**
 *	restful
 */
var express = require('express');
var app = express();
app.use(express.bodyParser());
app.set("jsonp callback", true);

app.listen(38368);

var http = require('http');
var server = http.createServer(app);

/**
 * sockets
 */
var io = require('socket.io').listen(server);

/**
 * DB connection
 */
var mysql = require('mysql');
var tables = mysql.createConnection(cred);


/**
 *	connectDB
 *	ensure that credentials are correct
 *	@params	{function}	done
 */
function connectDB(done) {

	function collectColumns(table, collected) {
		tables.query('SHOW COLUMNS FROM ' + table.Tables_in_uwb_devdogs, function (err, columns) { //this data comes from tables, unlikely to be injected
			shapes[table.Tables_in_uwb_devdogs] = columns;
			collected();
		});
	}

	try {
		shapes = require('./shapes.json');
		done();
	} catch (e) {
		tables.query('SHOW TABLES', function (err, allTables) {
			console.log(err);
			async.each(allTables, collectColumns, function () {
				fs.writeFile('./shapes.json', JSON.stringify(shapes), function (writeError) {
					console.log(writeError);
					done();
				});
			});
		});
	}
}
	
function startServices(err) {
	if (err) console.log(err);
	require('./streams.js')(io, tables, shapes, middleware);
	require('./RESTful.js')(app, tables, shapes, middleware, io);

	//ports will have to be changed for https
	console.log("************************************************");
	console.log("*       starting service on port 38368         *");
	console.log("************************************************");
}

connectDB(startServices);