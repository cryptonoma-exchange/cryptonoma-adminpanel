var http = require('http'),
	qs = require('querystring');
var server = http.createServer(function (req, res) {
	if (req.method === 'POST') {
		var body = '';
		req.on('data', function (chunk) {
			body += chunk;
		});
		req.on('end', function () {
			var data = JSON.parse(body);
			var BITBOX = require('bitbox-sdk').BITBOX;
			var bitbox = new BITBOX();
			if (data.method === 'create_address') {
				try {
					var mnemonic = bitbox.Mnemonic.generate();
					var seedBuffer = bitbox.Mnemonic.toSeed(mnemonic);
					var hdNode = bitbox.HDNode.fromSeed(seedBuffer);
					var CashAddress = bitbox.HDNode.toCashAddress(hdNode);
					var LegacyAddress = bitbox.HDNode.toLegacyAddress(hdNode);
					var obj = {
						'CashAddress': CashAddress.toString(),
						'LegacyAddress': LegacyAddress.toString(),
						'mnemonic': mnemonic.toString()
					};
					res.writeHead(200);
					res.end(JSON.stringify(obj));
				}
				catch (err) {
					console.log(err);
				}
			}
			else if (data.method === 'get_transactions') {
				try {
					var transaction = bitbox.Address.transactions(data.addr).then(
						(result) => {
							res.writeHead(200);
							res.end(JSON.stringify(result));
						},
						(err) => {
							res.writeHead(200);
							res.end(JSON.stringify(err));
						}
					);
				}
				catch (err) {
					console.log(err);
				}
			}
			else if (data.method === 'get_balance') {
				bitbox.Address.details(data.address).then(
					(result) => {

						res.writeHead(200);
						res.end(JSON.stringify(result));
					},
					(err) => {
						res.writeHead(200);
						res.end(JSON.stringify(err));
					}
				);
			}
			else if (data.method === 'send_bch') {
				try {
					let mnemonic = data.mnemonic;
					let seedBuffer = bitbox.Mnemonic.toSeed(mnemonic);
					let hdNode = bitbox.HDNode.fromSeed(seedBuffer);
					let CashAddress = bitbox.HDNode.toCashAddress(hdNode);
					let xpriv = bitbox.HDNode.toXPriv(hdNode);

					let transactionBuilder = new bitbox.TransactionBuilder('mainnet');
					let txid = data.txid;
					transactionBuilder.addInput(txid, data.vout);
					let originalAmount = bitbox.BitcoinCash.toSatoshi(data.amount);

					let byteCount = bitbox.BitcoinCash.getByteCount({ P2PKH: 1 }, { P2PKH: 1 });
					let sendAmount = originalAmount - byteCount;
					let toAddress = bitbox.Address.isLegacyAddress(data.toaddress);
					if (toAddress) {
						toAddress = bitbox.Address.toCashAddress(data.toaddress, false);
					}

					transactionBuilder.addOutput(toAddress, sendAmount);
					transactionBuilder.setLockTime(50000)
					let hdnode = bitbox.HDNode.fromXPriv(xpriv);
					let keyPair = bitbox.HDNode.toKeyPair(hdnode);

					let redeemScript;
					transactionBuilder.sign(0, keyPair, redeemScript, transactionBuilder.hashTypes.SIGHASH_ALL, originalAmount, transactionBuilder.signatureAlgorithms.SCHNORR);
					let tx = transactionBuilder.build();
					let hex = tx.toHex();

					bitbox.RawTransactions.sendRawTransaction(hex)
						.then((result) => {
							var obj = { 'txid': result };
							res.writeHead(200);
							res.end(JSON.stringify(obj));
						}, (err) => {
							console.log(err);
						});
				}
				catch (err) {
					console.log(err);
				}
			}


			else if (data.method === 'getprivatekey') {
				(async () => {
					try {
						let mnemonic = data.mnemonic;
						let seedBuffer = bitbox.Mnemonic.toSeed(mnemonic);
						let hdNode = bitbox.HDNode.fromSeed(seedBuffer);
						// let xpriv = bitbox.HDNode.toXPriv(hdNode); 
						let xpriv = bitbox.HDNode.toWIF(hdNode);
						var obj = { 'privatekey': xpriv };
						res.writeHead(200);
						res.end(JSON.stringify(obj));

					} catch (error) {
						console.error(error)
					}
				})()


			}

		});
	} else {
		res.writeHead(404);
		res.end();
	}
});
server.listen(8102, '170.64.130.231'); 
