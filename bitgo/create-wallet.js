const BitGoJS = require('bitgo');
var bitgo = new BitGoJS.BitGo({ env: 'prod', accessToken: 'v2x3ce10d22ee8f87c70abd58e1ce148a2ca1df6c1044e1d0e6b35fc57c35b7cc95' });
bitgo.coin('eth').wallets()
.generateWallet({ label: 'My Demo ETH Wallet', passphrase: 'dytw2t8jwrylyzzcmr6wyszuks475c', enterprise: '5e36a427c638178563d09241948c875e' })
.then(function(wallet) {
  // print the new wallet
  console.dir(wallet);
});