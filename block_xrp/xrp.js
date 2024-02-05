var http = require('http'),
	qs = require('querystring');
var server = http.createServer(function (req, res) {
	if (req.method === 'POST') {
		var body = '';
		req.on('data', function (chunk) {
			body += chunk;
		});
		req.on('end', async function () {
			var data = JSON.parse(body);
			'use strict';
			const RippleAPI = require('ripple-lib').RippleAPI;
			const api = new RippleAPI({
				  // server: 'wss://s.altnet.rippletest.net:51233' // Public rippled server
				server: 'wss://s1.ripple.com' // Public rippled server
			});
			if (data.method === 'create_address') {
				api.connect().then(() => {
					/* begin custom code ------------------------------------ */
					return api.generateAddress();
				}).then(info => {
					var myJSON = JSON.stringify(info);
					console.log(myJSON);
					process.exit(0);

					/* end custom code -------------------------------------- */
				}).catch(console.error);

			} else if (data.method === 'account_balance') {
				api.connect().then(() => {
					console.log('getting account info for', data.address);
					return api.getAccountInfo(data.address);
				}).then(info => {
					console.log(info);
					console.log('getAccountInfo done');
					/* end custom code -------------------------------------- */
				}).then(() => {
					return api.disconnect();
				}).then(() => {
					console.log('done and disconnected.');
				}).catch(console.error);

			} else if (data.method === 'send_xrp') {
				try {
					await api.connect();
					const address = data.fromaddress;
					// payment with destination tag --------------
					if (data.xrptag != '') {
						var payment = {
							"source": {
								"address": address,
								"maxAmount": {
									"value": data.amount,
									"currency": "XRP"
								}
							},
							"destination": {
								"address": data.to_address,
								"tag": Number(data.xrptag),
								"amount": {
									"value": data.amount,
									"currency": "XRP"
								}
							}
						};
					} else { // payment with out destination tag --------------
						var payment = {
							"source": {
								"address": address,
								"maxAmount": {
									"value": data.amount,
									"currency": "XRP"
								}
							},
							"destination": {
								"address": data.to_address,
								"amount": {
									"value": data.amount,
									"currency": "XRP"
								}
							}
						};
					}
					let preparePayment = await api.preparePayment(address, payment);
					let txJSON = preparePayment.txJSON;
					let signer = await api.sign(txJSON, data.secret);
					let signedTransaction = signer.signedTransaction;
					let submitPayment = await api.submit(signedTransaction);
					var obj = { 'tx_result': submitPayment };
					res.writeHead(200);
					res.end(JSON.stringify(obj));
				} catch (error) {
					res.writeHead(200);
					res.end(JSON.stringify({ error: error }));
				}
			}
		});
	} else {
		res.writeHead(404);
		res.end();
	}
});
server.listen(8105, '170.64.130.231');
