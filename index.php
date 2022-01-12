<!--CHECK FOR MOBILE APP AND BROWSERS-->
<?php

$iPhoneBrowser  = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$iPadBrowser    = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
$AndroidBrowser = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
$AndroidApp = $_SERVER['HTTP_X_REQUESTED_WITH'] == "com.company.app";
$iOSApp = (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false);

?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<button class="enableEthereumButton btn">Enable</button>
<a id="sendLink"><button class="sendEthButton btn">Pay</button></a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js" integrity="sha256-nWBTbvxhJgjslRyuAKJHK+XcZPlCnmIAAMixz6EefVk=" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.0-rc.0/web3.min.js" integrity="sha512-/PTXSvaFzmO4So7Ghyq+DEZOz0sNLU4v1DP4gMOfY3kFu9L/IKoqSHZ6lNl3ZoZ7wT20io3vu/U4IchGcGIhfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let iPhoneBrowser = "<?php echo $iPhoneBrowser ?>";
    let iPadBrowser = "<?php echo $iPadBrowser ?>";
    let AndroidBrowser = "<?php echo $AndroidBrowser ?>";
    let AndroidApp = "<?php echo $AndroidApp ?>";
    let iOSApp = "<?php echo $iOSApp ?>";

    getAccount();
    const ethereumButton = document.querySelector('.enableEthereumButton');
    const sendEthButton = document.querySelector('.sendEthButton');
    const sendLink = document.querySelector('#sendLink');
    // Check if mobile device
    if(iPhoneBrowser || iPadBrowser || AndroidBrowser) {
        sendLink.setAttribute("href", "https://metamask.app.link/dapp/metamask-client.herokuapp.com/index2.html")
    }

    const web3 = new Web3(Web3.givenProvider || "ws://localhost:8545");
    const amount = web3.utils.toWei('1', 'ether');
    const value = web3.utils.toHex(amount);

    let accounts = [];

    //Sending Ethereum to an address
    sendEthButton.addEventListener('click', () => {
        getAccount()
        ethereum
            .request({
                method: 'eth_sendTransaction',
                params: [
                    {
                        from: accounts[0],
                        to: '0x95B4696f2ca5373fC7A7EfC2a9b5E2366c200D36',
                        // value: '0x29a2241af62c0000',
                        value,
                        gasPrice: '0x09184e72a000',
                        gas: '0x2710',
                    },
                ],
            })
            .then((txHash) => console.log(txHash))
            .catch((error) => console.error);
    });

    // ethereumButton.addEventListener('click', () => {
    //     getAccount();
    // });

    async function getAccount() {
        accounts = await ethereum.request({ method: 'eth_requestAccounts' })
            .then((res) => console.log(res));
    }
</script>
</body>
</html>