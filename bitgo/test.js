const BitGoJS = require('bitgo');
var bitgo = new BitGoJS.BitGo({ env: 'prod', accessToken: 'v2x3ce10d22ee8f87c70abd58e1ce148a2ca1df6c1044e1d0e6b35fc57c35b7cc95' });
var coin = bitgo.coin('eth');
bitgo.coin('eth').wallets().get({ id: '5ea03e1ee460294707c14d2db2737fe2' }).then(function(wallet) {
wallet.createAddress({ label: 'My address' })
.then(function(address) {
  // print new address
  console.dir(address);
  var vid = address.id;
});
}); 


bitgo.coin('eth').wallets().get({ id: '5ea03e1ee460294707c14d2db2737fe2' }).then(function(wallet) {
wallet.getAddress({id: vid})
.then(function(address) {
  // print address
  console.dir(address.address);
});

});