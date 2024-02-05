let BITBOX = require('bitbox-sdk').BITBOX;
let bitbox = new BITBOX();
try {
	let mnemonic = bitbox.Mnemonic.generate();
	//console.log(mnemonic);
	let seedBuffer = bitbox.Mnemonic.toSeed(mnemonic);
	let hdNode = bitbox.HDNode.fromSeed(seedBuffer);
	let CashAddress = bitbox.HDNode.toCashAddress(hdNode);
	let LegacyAddress = bitbox.HDNode.toLegacyAddress(hdNode);
	//var obj = { 'CashAddress' : CashAddress, 'LegacyAddress' : LegacyAddress,'mnemonic': mnemonic };
	var obj = {
		'CashAddress' : CashAddress.toString(),
		'LegacyAddress' : LegacyAddress.toString(),
		'mnemonic' : mnemonic.toString()
	};
}
catch(err) {
	console.log(err);
}
console.log(JSON.stringify(obj));