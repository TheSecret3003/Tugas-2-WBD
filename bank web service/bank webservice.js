var http = require("http");
var url = require("url");
var mysql = require("mysql");
var crypto = require("crypto");

var mysql_con = mysql.createConnection({host: "localhost", user: "root", password: "", port: 3306});
mysql_con.connect(function(e) {
	if (e) throw e;

	mysql_con.query("USE node_js", function (e, result) {
		if (e) throw e;
	});
});

http.createServer(function(request,response){
	var url_parts = url.parse(request.url,true);
	switch (url_parts.pathname){
		case ("/validate"):
			if (request.method == "POST"){
				console.log("validate POST invoked");
				var validate_from_mysql = function(name, card_number){
					var query = "SELECT * FROM nasabah WHERE name=\"" + name + "\" AND nomor_kartu=\"" + card_number +"\"";

					mysql_con.query(query,function(e,result) {
						if (e) throw e;

						response.writeHead(200,{"Access-Control-Allow-Origin" : "http://localhost"});
						if (result.length > 0){
							console.log("Data available");
							response.end("OK");
						} else {
							console.log("Data unavailable");
							response.end();
						}
					});
				};

				request.on("data", function(result) {
					var data_splitted = result.toString().split("&");
					var name = (data_splitted[0].split("="))[1];
					var card_number = (data_splitted[1].split("="))[1];
					name = name.split("+").join(" ");

					console.log(name);
					console.log(card_number);

					validate_from_mysql(name,card_number);
				});
			} else {
				response.writeHead(403);
				response.end();
			}
			break;
		case ("/transfer"):
			if (request.method == "POST"){
				console.log("transfer post");
				var generate_hotp = function(sender_card_num) {
					const secret_key = crypto.randomBytes(16).toString();
					const hash_sha256 = crypto.createHash('sha256');

					var hashed_secret_key = hash_sha256.update(secret_key,'binary').digest('hex');

					var token = "";
					for (var i = 1; i < 9; i++){
						token += hashed_secret_key.charAt(Math.pow(3,i) % 64);
					}
					var date = new Date();
					date.setSeconds(date.getSeconds() + 180);
					date = date.toISOString().slice(0, 19).replace("T", " ");

					console.log("TOKEN = " + token);

					var query = `DELETE FROM token WHERE nomor_kartu="${sender_card_num}"`;
					mysql_con.query(query,null);
					query = `INSERT INTO token VALUES ("${hashed_secret_key}","${sender_card_num}","${date}")`;
					mysql_con.query(query,null);
				}

				request.on('data', function(data) {
					console.log(data.toString());
					var data_splitted = data.toString().split("&");
					
					var sender_card_num = (data_splitted[0].split("="))[1];
					var receiver_card_num = 1111111111111111;
					var amount = (data_splitted[1].split("="))[1];
					
					var query = "SELECT saldo FROM nasabah WHERE nomor_kartu=\"" + sender_card_num + "\"";
					mysql_con.query(query,function(e, result) {
						if (e) throw e;

						response.writeHead(200);
						if ((result[0].saldo - amount) >= 0){
							console.log("Saldo cukup");
							response.write("OK","utf-8");
							response.end();
							//generate_hotp(sender_card_num);
						} else {
							console.log("Saldo kurang");
							response.end();
						}
					});
				});
			} else {
				response.writeHead(403);
				response.end();
			}
			break;
		default:
			response.writeHead(404);
			response.end();
	}
}).listen(8081);

console.log("Listening on 127.0.0.1:8081");
