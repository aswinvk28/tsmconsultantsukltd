var less = require('less');
var http = require('http');

var parser = new(less.Parser)();

var options = {
	host : 'projects.localhost.com',
	port : 80,
	path : '/TSM-Drupal/public_html/sites/tsm-consultantsuk.com/clientapp/lesscss/styles/main.less',
	method : 'POST'
};

var returnResponse = function(res) {
	var lessString = "";

	res.on('data', function(chunk) {
		lessString += chunk + "\n";
	});

	res.on('end', function() {
		parser.parse(lessString, function(err, tree) {
			if (err) {
				throw err;
			}
				
			console.log(tree.toCSS());
		});
	});
};

var req = http.request(options, returnResponse);

req.end();
