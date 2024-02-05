let BITBOX = require('bitbox-sdk').BITBOX;
let bitbox = new BITBOX();
try {
	let mnemonic = bitbox.Mnemonic.generate();
	//console.log(mnemonic);
	let seedBuffer = bitbox.Mnemonic.toSeed(mnemonic);
	let hdNode = bitbox.HDNode.fromSeed(seedBuffer);
	let CashAddress = bitbox.HDNode.toCashAddress(hdNode);
	let LegacyAddress = bitbox.HDNode.toLegacyAddress(hdNode);
	var obj = { 'CashAddress' : CashAddress, 'LegacyAddress' : LegacyAddress,'mnemonic': mnemonic };
	console.log(obj);
}
catch(err) {
	console.log(err);
}