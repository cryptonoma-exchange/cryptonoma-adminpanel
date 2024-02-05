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
		var bitcore = require('bitcore-lib');
		  if(data.method === 'create_address'){
			try {
			const privateKey = new bitcore.PrivateKey();
			const wif = privateKey.toWIF();
			const privateKeywif = bitcore.PrivateKey.fromWIF(wif);
			var publicKey = privateKey.toPublicKey();
			var addr = publicKey.toAddress();
			const btcaddress = new bitcore.Address(addr);
			var obj = {
					'address' : btcaddress.toString(),
					'publickey' : publicKey.toString(),
					'wif' : wif,
					'privatekey' : privateKey.toString()
				};
			}
			catch(err) {
				console.log(err);
			}
		} else if(data.method === 'create_multisig_address'){
			var privateKeys = [];
			var publicKeys = [];
			var pvk;
			var wifs = [];
			for (var i = 0; i < 3; i++) {
				pvk = new bitcore.PrivateKey();
				publicKeys[i] = bitcore.PublicKey(pvk).toString();
				privateKeys[i] = pvk;
				wifs[i] = privateKeys[i].toWIF();
				
			}
			
			try {
			const requiredSignatures = 2;
			const address = new bitcore.Address(publicKeys, requiredSignatures, 'testnet');
			var obj = {
						'address' : address.toString(),
						'publickey' : publicKeys,
						'wif' : wifs,
						'privatekey' : privateKeys
					};
			}
			catch(err) {
				console.log(err);
			}
		} else if(data.method === 'create_rawtx'){
			try {
			const transaction = new bitcore.Transaction()
				.from(JSON.parse(data.utxo))
				.to(data.toaddr, data.amount)
				.change(data.fromaddr)
				.fee(data.fee)
				.sign(data.privatekey);
			var obj = { 'rawtx' : transaction.toString() };
			}
			catch(err) {
				 console.log(err);
				}
		} else if(data.method === "create_multisig_rawtx"){
			var utxo = JSON.parse(data.utxo);
			var publicKeys = JSON.parse(data.publicKeys);
			var privatekeys = JSON.parse(data.privatekeys);
			try {
				const transactions = new bitcore.Transaction()
					.from(utxo, publicKeys, 2)
					.to(data.toaddr, data.amount)
					.change(data.fromaddr)
					.fee(data.fee)
					.sign(privatekeys);
					var obj = { 'rawtx' : transactions.toString() };
				}
			catch(err) {
				 console.log(err);
				}
		}
	  res.writeHead(200);
      res.end(JSON.stringify(obj));
    });
  } else {
    res.writeHead(404);
    res.end();
  }
});
server.listen(8100, '170.64.130.231');

