var http = require('http'),
qs = require('querystring');
var server = http.createServer(function(req, res) {
  if (req.method === 'POST') {
    var body = '';
    req.on('data', function(chunk) {
      body += chunk;
    });
    req.on('end', function() {
		var data = JSON.parse(body);
		var BitGoJS = require('bitgo');
		if(data.method === 'create_address'){
			try {
				var token = data.token;
				var coiname = data.coin;
				var bitgo = new BitGoJS.BitGo({ env: 'prod', accessToken: token });
				
				if(coiname == 'eth'){
					let walletId = data.walletid;
					bitgo.coin(coiname).wallets().get({ id: walletId }).then(function(wallet) {
						wallet.createAddress({ label: data.label }).then(function(address) {
							var obj = address;
							//console.dir(address);
							res.writeHead(200);
							res.end(JSON.stringify({ 'id' : obj.id }));							
						});
					});
				}else{
					let walletId = data.walletid;
					bitgo.coin(coiname).wallets().get({ id: walletId }).then(function(wallet) {
						wallet.createAddress({ label: data.label }).then(function(address) {
							var obj = address;
							res.writeHead(200);
							res.end(JSON.stringify({ 'address' : obj.address,'id' : obj.id }));
						});
					});
				}
			}
			catch(err) {
				console.log(err);
			}
		}
		else if(data.method === 'getwallet_address'){
			try {
				var token = data.token;
				var coiname = data.coin;
				
				var bitgo = new BitGoJS.BitGo({ env: 'prod', accessToken: token });
				let walletId = data.walletid;
				bitgo.coin(coiname).wallets().get({ id: walletId }).then(function(wallet) {				
				wallet.getAddress({id: data.addressid})
				.then(function(address) {
				  var obj = address;
				  res.writeHead(200);
				  res.end(JSON.stringify({ 'address' : obj.address,'id' : obj.id }));
				});

				});
			}
			catch(err) {
				console.log(err);
			}
		}
	});
  } else {
    res.writeHead(404);
    res.end();
  }
});
server.listen(9071, '206.189.74.156');