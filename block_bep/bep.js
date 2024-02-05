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
			var Url = data.url;
			var Web3 = require('web3');
			web3 = new Web3(new Web3.providers.HttpProvider(Url));
			if (data.method === 'create_beptx') {
				try {
					let contractAddress = data.contract;
					let myAddress = data.formaddr;
					let toAddress = data.toddr;
					let privatekey = data.pvk;
					//	var amount = web3.toHex(web3.toWei(data.amount));
					var amount = data.amount;

					var v = web3.eth.getTransactionCount(myAddress);
					count = v;
					var privateKey = new Buffer.from(privatekey, 'hex');
					let abiArray = JSON.parse(data.abiarray);
					//	var contract = new web3.eth.Contract(abiArray, contractAddress, {from: myAddress})
					var contract = web3.eth.contract(abiArray).at(contractAddress);
					const EthereumTx = require('ethereumjs-tx');
					const Common = require('ethereumjs-common');
					const customCommon = Common.default.forCustomChain('mainnet', {
						name: 'bnb',
						chainId: 56,
						networkId: 56,
						url: Url
					}, 'petersburg');

					var txParams = {
						"from": myAddress,
						"gasPrice": 5e9, //don't change this 18e9
						"gasLimit": 57000, //don't change this  5000000
						"to": contractAddress,
						"value": web3.toHex(0),
						//"data": contract.methods.transfer(toAddress, amount).encodeABI(),
						"data": contract.transfer.getData(data.toddr, data.amount, { from: data.formaddr }),
						"nonce": web3.toHex(count),
						"chainId": web3.toHex(56)
					};


					var tx = new EthereumTx(txParams, { common: customCommon });
					tx.sign(privateKey);
					var serializedTx = tx.serialize();
					var raw = '0x' + serializedTx.toString('hex');
					web3.eth.sendRawTransaction(raw, function (error, txid) {
						if (error) {
							var obj = { "error": error };
							console.log(obj);
						} else {
							var obj = {
								"txid": txid
							};
							console.log(obj);
							res.writeHead(200);
							res.end(JSON.stringify(obj));
						}

					});


				}
				catch (err) {
					console.log(err);
				}
			}

			if (data.method === 'create_bnbtx') {
				try {
					let myAddress = data.formaddr;
					let toAddress = data.toddr;
					let privatekey = data.pvk;
					var amount = data.amount;

					web3.eth.getTransactionCount(myAddress).then(function (v) {
						count = v;
						var privateKey = Buffer.from(privatekey, 'hex');
						const EthereumTx = require('ethereumjs-tx').Transaction;
						const Common = require('ethereumjs-common');

						const customCommon = Common.default.forCustomChain('mainnet', {
							name: 'bnb',
							chainId: 56,
							networkId: 56,
							url: Url
						}, 'petersburg');

						var txParams = {
							"from": myAddress,
							"gasPrice": 5e9,
							"gasLimit": 21004,
							"to": toAddress,
							"value": web3.utils.toHex(web3.utils.toWei(amount.toString(), 'ether')),
							"data": web3.utils.toHex(0),
							"nonce": web3.utils.toHex(count),
							"chainId": web3.utils.toHex(56)
						};

						var tx = new EthereumTx(txParams, { common: customCommon });
						tx.sign(privateKey);
						var serializedTx = tx.serialize();
						var raw = '0x' + serializedTx.toString('hex');
						web3.eth.sendSignedTransaction(raw, (err, txHash) => {
							if (err) {
								var obj = { "error": err };
								console.log(obj);
							} else {
								var obj = {
									"txid": txHash
								};
								res.writeHead(200);
								res.end(JSON.stringify(obj));
							}
						});

					});
				}
				catch (err) {
					console.log(err);
				}
			}

			if (data.method === 'create_bnsssbtxsss') {
				try {
					let myAddress = data.formaddr;
					let toAddress = data.toddr;
					let privatekey = data.pvk;
					var amount = data.amount;

					var v = web3.eth.getTransactionCount(myAddress);
					count = v;
					var privateKey = Buffer.from(privatekey, 'hex');
					const EthereumTx = require('ethereumjs-tx');
					const Common = require('ethereumjs-common');

					const customCommon = Common.default.forCustomChain('mainnet', {
						name: 'bnb',
						chainId: 56,
						networkId: 56,
						url: Url
					}, 'petersburg');

					var txParams = {
						"from": myAddress,
						"gasPrice": 5e9,
						"gasLimit": 21004,
						"to": toAddress,
						"value": web3.toHex(web3.toWei(amount.toString(), 'ether')),
						"data": web3.toHex(0),
						"nonce": web3.toHex(count),
						"chainId": web3.toHex(56)
					};

					var tx = new EthereumTx(txParams, { common: customCommon });
					tx.sign(privateKey);
					var serializedTx = tx.serialize();
					var raw = '0x' + serializedTx.toString('hex');
					web3.eth.sendRawTransaction(raw, (err, txHash) => {
						if (err) {
							var obj = { "error": err };
							console.log(obj);
						} else {
							var obj = {
								"txid": txHash
							};
							res.writeHead(200);
							res.end(JSON.stringify(obj));
						}
					});


				}
				catch (err) {
					console.log(err);
				}
			}
		});
	} else {
		res.writeHead(404);
		res.end();
	}
});
server.listen(8104, '170.64.130.231');