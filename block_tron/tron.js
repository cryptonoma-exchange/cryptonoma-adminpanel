process.env['NODE_TLS_REJECT_UNAUTHORIZED'] = 0;
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

      const TronWeb = require('tronweb');
      const TronGrid = require('trongrid');

// This provider is optional, you can just use a url for the nodes instead
const HttpProvider = TronWeb.providers.HttpProvider;

const fullNode = new HttpProvider('https://api.trongrid.io'); // Full node http endpoint
const solidityNode = new HttpProvider('https://api.trongrid.io'); // Solidity node http endpoint
const eventServer = new HttpProvider('https://api.trongrid.io'); // Contract events http endpoint

//const fullNode = new HttpProvider('https://api.shasta.trongrid.io'); // Full node http endpoint
// const solidityNode = new HttpProvider('https://api.shasta.trongrid.io'); // Solidity node http endpoint
// const eventServer = new HttpProvider('https://api.shasta.trongrid.io'); // Contract events http endpoint

 

var tronWeb = new TronWeb(
  fullNode,
  solidityNode,
  eventServer
  );
  const tronGrid = new TronGrid(tronWeb);

if(data.method === 'create_address'){
  addressCreate();
} 
if(data.method === 'gettransaction'){
  transrelate();
} 
if(data.method === 'getbalance'){
  getBalance();
} 
if(data.method === 'get_admin_balance'){
  getAdminBalance();
}
 if(data.method === 'getTronTransactionId'){
  getTronTransactionId();
} 



if(data.method === 'sendRawTransaction'){
    sendRawTransaction();
}  

if(data.method === 'sendtrc10token'){
  const privateKey = data.pvtk;
  var tronWeb = new TronWeb(
    fullNode,
    solidityNode,
    eventServer,
    privateKey
    );
    SendTRC10Token();
} 

if(data.method === 'sendtrc20token'){  
    SendTRC20Token();
} 

if(data.method === 'sendtransaction'){
  const privateKey = data.pvtk;
  var tronWeb = new TronWeb(
    fullNode,
    solidityNode,
    eventServer,
    privateKey
    );
    sendTransaction();
} 


if(data.method === 'getbase58'){  
  getbase58(); 
} 

if(data.method === 'gettransactions'){  
  getTransactionsdet(); 
} 

async function addressCreate() {
  const account = await tronWeb.createAccount();
  res.writeHead(200);
  res.end(JSON.stringify(account));

}


async function sendTransaction() {
  //token send 
  var toaddress =data.to_address;
  var amount =data.amount;
  var privateKey = data.pvtk;
  tronWeb.trx.sendTransaction(toaddress, amount, privateKey).then(result => { 
    res.writeHead(200);
    res.end(JSON.stringify(result));
  }).catch(err =>{
    console.log(err);
  });
  }

  async function sendRawTransaction() { 
  var fromAddress = data.from_address; //address _from
  var toAddress = data.to_address; //address _to
  var amount = data.amount; //amount
  var privateKey = data.pvtk; //privatekey
  //Creates an unsigned TRX transfer transaction
  tradeobj = await tronWeb.transactionBuilder.sendTrx(
        toAddress,
        amount,
        fromAddress
  );
  const signedtxn = await tronWeb.trx.sign(
        tradeobj,
        privateKey
  ); 
  await tronWeb.trx.sendRawTransaction(signedtxn).then(result => { 
    res.writeHead(200);
    res.end(JSON.stringify(result));
  }).catch(err =>{
    console.log(err);
  }); 
 
  }
 


async function SendTRC10Token() {
//token send 
var toaddress =data.to_address;
var amount =data.amount;
var contract =data.contract;
tronWeb.trx.sendToken(toaddress, amount, contract).then(result => { 
  res.writeHead(200);
  res.end(JSON.stringify(result));
}).catch(err =>{
  console.log(err);
});
} 


async function SendTRC20Token() {
  
 var toAddress = data.to_address; //address _to
 var amount = data.amount; //amount
 var privateKey = data.pvtk; //privatekey

// This example is the TRC20-USDT token, change this with the token you want
const trc20ContractAddress = data.ContractAddress;

// First contstruct a tronWeb object with a private key
// const tronWeb = new TronWeb({
//   privateKey: privateKey,
// }); 

 
var tronWeb = new TronWeb(
  fullNode,
  solidityNode,
  eventServer,
  privateKey
  );

const trc20Contract = await tronWeb.contract().at(trc20ContractAddress);
await trc20Contract
.transfer(
  toAddress, // Address to which to send the tokens
  amount, // Amount of tokens you want to send
)
.send({
  feeLimit: 3000000 // Make sure to set a reasonable feelimit  if problem occurs increase 4000000 and revert
}).then(result => { 
    res.writeHead(200);
    res.end(JSON.stringify(result));
  }).catch(err =>{
    console.log(err);
  });  

}

async function getbase58() { 
  const address = data.address; 
const account = await   tronWeb.address.fromHex(address);
res.writeHead(200);
res.end(JSON.stringify(account));

}


 async function getTronTransaction() {
  // tronWeb.trx.getTransaction("0daa9f2507c4e79e39391ea165bb76ed018c4cd69d7da129edf9e95f0dae99e2").then(result => {console.log(result)});
const transaction = await tronWeb.trx.getTransaction(data.address);
       tronWeb.trx.getTransaction(data.address).then(transaction => {
      res.writeHead(200);
      res.end(JSON.stringify(transaction));
    }).catch(err => console.error(err));
}


async function getBalance() {
  const address = data.address;
  const balance = await tronWeb.trx.getBalance(address);
  tronWeb.trx.getBalance(address).then(balance => {
    res.writeHead(200);
    res.end(JSON.stringify(balance));
  }).catch(err => console.error(err));
}

async function getAdminBalance() {
  const address = data.address;
  tronWeb.trx.getAccount(address).then(accountInfo => {
    res.writeHead(200);
    res.end(JSON.stringify(accountInfo));
  }).catch(err => console.error(err));
}



async function getTransactionsdet() {
 // const address = '';

  // const options = {
  //     only_to: true,
  //     only_confirmed: true,
  //     limit: 100,
  //     order_by: 'timestamp,asc',
  //     min_timestamp: Date.now() - 60000 // from a minute ago to go on
  // }; 
  const options = { 
};
  // awaiting
  const transactions = await tronGrid.account.getTransactions(address, options);
  //console.log({transactions});

  // promise
  tronGrid.account.getTransactions(address, options).then(transactions => {
    //  console.log({transactions});
  }).catch(err => console.error(err));

  // callback
  tronGrid.account.getTransactions(address, options, (err, transactions) => {
      if (err)
          return console.error(err);
          res.writeHead(200);
          res.end(JSON.stringify(transactions));
   //   console.log({transactions});
  });
} 

});
  }

  else {
    res.writeHead(404);
    res.end();
  }
});
server.listen(8090, '206.189.74.156'); 
// server.listen(8080, '127.0.01');