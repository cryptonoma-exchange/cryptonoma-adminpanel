'use strict';
const RippleAPI = require('ripple-lib').RippleAPI;

const api = new RippleAPI({
  server: 'wss://s1.ripple.com' // Public rippled server
});
api.connect().then(() => {
  /* begin custom code ------------------------------------ */

  return (api.generateAddress());

}).then(info => {
  var myJSON = JSON.stringify(info);
  console.log(myJSON);
  process.exit(0);

  /* end custom code -------------------------------------- */
}).catch(console.error);