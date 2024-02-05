var http = require('http');
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
      var ethers = require("ethers");
      if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
      } else {
        web3 = new Web3(new Web3.providers.HttpProvider(Url));
      }

      if (data.method === 'create_address') {
        try {
          var wallet = ethers.Wallet.createRandom();
          var mnemonic = wallet.mnemonic.phrase;
          var mnemonicWallet = ethers.Wallet.fromMnemonic(mnemonic);
          var obj = {
            "success": true,
            'address': wallet.address,
            'privatekey': mnemonicWallet.privateKey
          };
          res.writeHead(200);
          res.end(JSON.stringify(obj));
        } catch (err) {
          res.writeHead(200);
          res.end({
            "success": false,
            "data": err
          });
        }
      }

      if (data.method === 'create_rawtx') {
        try {
          var EthereumTx = require('ethereumjs-tx').Transaction;
          var privateKey = new Buffer.from(data.pvk, 'hex');
          web3.eth.getTransactionCount(data.formaddr, (err, txCount) => {
            if (err) {
              res.writeHead(200, { 'Content-Type': 'application/json' });
              res.write(JSON.stringify({
                "success": false,
                "data": err
              }));
              res.end();
            } else {
              var txParams = {
                from: data.formaddr,
                nonce: web3.utils.toHex(txCount),
                gasPrice: web3.utils.toHex(data.gasPrice),
                gas: web3.utils.toHex(21000),
                to: data.toddr,
                value: web3.utils.toHex(web3.utils.toWei(data.amount, 'ether')),
                data: "0x",
                chainId: web3.utils.toHex(1)
              };
              var tx = new EthereumTx(txParams);
              tx.sign(privateKey);
              var serializedTx = tx.serialize();
              var raw = '0x' + serializedTx.toString('hex');
              web3.eth.sendSignedTransaction(raw, (err, txHash) => {
                if (err) {
                  res.writeHead(200, { 'Content-Type': 'application/json' });
                  res.write(JSON.stringify({
                    "success": false,
                    "data": err
                  }));
                  res.end();
                } else {
                  var obj = {
                    "success": true,
                    "txid": txHash
                  };
                  res.writeHead(200);
                  res.end(JSON.stringify(obj));
                }
              });
            }
          });
        }
        catch (err) {
          res.writeHead(200, { 'Content-Type': 'application/json' });
          res.write(JSON.stringify({
            "success": false,
            "data": err
          }));
          res.end();
        }
      }
      if (data.method === 'create_rawcustomtx') {
        try {
          var contractAddress = data.contract;
          var EthereumTx = require('ethereumjs-tx').Transaction;
          var privateKey = new Buffer.from(data.pvk, 'hex');
          web3.eth.getTransactionCount(data.formaddr, (err, txCount) => {
            if (err) {
              res.writeHead(200);
              res.end({
                "success": false,
                "data": err
              });
            } else {
              var abiArray = JSON.parse(data.abi);
              var contract = new web3.eth.Contract(abiArray, contractAddress, { from: data.formaddr });
              var txParams = {
                "from": data.formaddr,
                "nonce": web3.utils.toHex(txCount),
                "gasPrice": web3.utils.toHex(data.gasPrice),
                "gasLimit": web3.utils.toHex(data.gasLimit),
                "to": contractAddress,
                "value": web3.utils.toHex(0),
                "data": contract.methods.transfer(data.toddr, data.amount).encodeABI(),
                "chainId": web3.utils.toHex(1)
              };

              var tx = new EthereumTx(txParams, { 'chain': 'mainnet' });
              tx.sign(privateKey);
              var serializedTx = tx.serialize();
              var raw = '0x' + serializedTx.toString('hex');
              web3.eth.sendSignedTransaction(raw, (err, txHash) => {
                if (err) {
                  var obj = { "error": err };
                  res.writeHead(200);
                  res.end({
                    "success": false,
                    "data": err
                  });
                } else {
                  var obj = {
                    "success": true,
                    "txid": txHash
                  };
                  res.writeHead(200);
                  res.end(JSON.stringify(obj));
                }
              });
            }
          });
        }
        catch (err) {
          res.writeHead(200);
          res.end({
            "success": false,
            "data": err
          });
        }
      }
    });
  } else {
    res.writeHead(404);
    res.end();
  }
});
server.listen(8101, '170.64.130.231');
