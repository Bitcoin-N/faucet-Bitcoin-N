<?php
ini_set('max_execution_time', 20);
require_once 'classes/jsonRPCClient.php';
require_once 'classes/recaptcha.php';
require_once 'config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $faucetTitle; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Faucet de Bitcoin nova , Gana monedas gratis">
  <meta name="keywords" content="bitcoin nova, btg, bitcoinn, bitcoin-n, , nova, bitcoin, btc, gratis, free, regalo, monedas, faucet, grifo, premio, cryptocurrency, mining, pool, cpu mining, gpu mining, profitable mining, cloud mining, cryptocurrency">
  
    <meta property="og:image" content="http://pool.bitcoinn.biz/bitcoinn.png" />
    <meta property="og:url" content="http://faucet.bitcoinn.biz/" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Faucet de Bitcoin-N , Gana monedas gratis de la moneda Bitcoin-N." />
    <meta property="og:description" content="Consigue monedas gratis de Bitcoin nova. Bitcoin nova la criptomoneda descentralizada de código fuente abierto que permite participar en el desarrollo de la red. Transacciones imposibles de controlar" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@DevBtn" />
    <meta name="twitter:creator" content="@DevBtn" />
    <meta name="twitter:title" content="Faucet de Bitcoin nova , Gana monedas gratis de la moneda Bitcoin-N." />
    <meta name="twitter:description" content="Consigue monedas gratis de Bitcoin nova. Bitcoin nova la criptomoneda descentralizada de código fuente abierto que permite participar en el desarrollo de la red. Transacciones imposibles de controlar" />
    <meta name="twitter:image" content="http://pool.bitcoinn.biz/bitcoinn.png" />
    <meta name="fragment" content="!" />


  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="icon" type="image/icon" href="images/favicon.ico" >

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

  <script>var isAdBlockActive=true;</script>
  <script src="js/advertisement.js"></script>
  <script>
  if (isAdBlockActive) { 
    window.location = "./adblocker.php"
  }
  </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-493281-2', 'auto');
  ga('send', 'pageview');

</script>

</head>

<body>

  <div class="container">

    <div id="login-form">

	  
	  <h3><a href="./"><img src="<?php echo $logo; ?>" height="256"></a><br /><br /> <?php echo $faucetSubtitle; ?></h3>
	  
	  
      <fieldset>

        <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
<!--        <iframe data-aa='195916' src='https://ad.a-ads.com/195916?size=728x90' scrolling='no' style='width:728px; height:90px; border:0px; padding:0;overflow:hidden' allowtransparency='true' frameborder='0'></iframe> -->
        <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->

        <br />

		

          <?php                  

        $bitcoin = new jsonRPCClient('http://127.0.0.1:18644/json_rpc');

        $balance = $bitcoin->getbalance();
        $balanceDisponible = $balance['available_balance'];
        $lockedBalance = $balance['locked_amount'];
//        $dividirEntre = 1000000000000;
        $dividirEntre = 1000000;
        $totalBCN =  ($balanceDisponible+$lockedBalance)/$dividirEntre;
        

        $recaptcha = new Recaptcha($keys);
        //Available Balance
        $balanceDisponibleFaucet = number_format(round($balanceDisponible/$dividirEntre,12),12,'.', '');
        ?>

        <form action="request.php" method="POST">

          <?php if(isset($_GET['msg'])){
            $mensaje = $_GET['msg']; 

            if($mensaje == "captcha"){?>
            <div  id="alert" class="alert alert-error radius">
              Captcha inválido, ingresa el correcto.
            </div>
            <?php }else if($mensaje == "wallet"){ ?>

            <div id="alert" class="alert alert-error radius">
              Por favor ingrese la dirección correcta del Bitcoin nova.
            </div>
            <?php }else if($mensaje == "success"){ ?>

            <div class="alert alert-success radius">
              Usted ganó <?php echo $_GET['amount']; ?> btn.<br/><br/>
              Obtendrás <?php echo $_GET['amount']-0.0001; ?> btn. (Tarifa de red 0.0001)<br/>
              <a target="_blank" href="http://pool.bitcoinn.biz/?hash=<?php echo $_GET['txid']; ?>#blockchain_transaction">Mirar transacción.</a>
            </div>
            <?php }else if($mensaje == "paymentID"){ ?>

            <div id="alert" class="alert alert-error radius">
              Verifique su identificación de pago. <br>Debe constar de 64 caracteres sin caracteres especiales.
            </div>
            <?php }else if($mensaje == "notYet"){ ?>

            <div id="alert" class="alert alert-warning radius">
              Los Bitcoin nova solo se emiten una vez cada 12 horas. Venga más tarde.
            </div>
            <?php } ?>

            <?php } ?>
            <div class="alert alert-info radius">
              Balance general: <?php echo $balanceDisponibleFaucet ?> btn.<br>
              <?php

              $link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);

              $query = "SELECT SUM(payout_amount) FROM `payouts`;";

              $result = mysqli_query($link, $query);
              $dato = mysqli_fetch_array($result);

              $query2 = "SELECT COUNT(*) FROM `payouts`;";

              $result2 = mysqli_query($link, $query2);
              $dato2 = mysqli_fetch_array($result2);



              mysqli_close($link);
              ?>

              Entregados: <?php echo $dato[0]/$dividirEntre; ?> btn. y <?php echo $dato2[0];?> pagos.
            </div>

            <?php if($balanceDisponibleFaucet<1.0){ ?>
            <div class="alert alert-warning radius">
             El Faucet está vacio o el saldo es menor que la ganancia. <br> Venga más tarde, &ndash; tal vez alguien nos sacrificará unos cuantos Bitcoin nova
           </div>

           <?php } elseif (!$link) {
		   
		  // $link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);

			 
					die('Error al caminar' . mysql_error());
				}  else {  ?>

           <input type="text" name="wallet" required placeholder="Dirección de Bitcoin-N">

           <input type="text" name="paymentid" placeholder="Payment ID (Opcional)" >
           <br/>
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           
<!--		   <iframe scrolling="no" frameborder="0" style="overflow:hidden;width:728px;height:90px;" src="//bee-ads.com/ad.php?id=19427"></iframe> -->
		   
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           <br/>
           <?php 
           echo $recaptcha->render();     
           ?>

           <center><input type="submit" value="¡Quiero Monedas gratis!"></center>
           <br>
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           <!--iframe scrolling="no" frameborder="0" style="overflow:hidden;width:468px;height:60px;" src="//bee-ads.com/ad.php?id=6534"></iframe-->
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           <?php } ?>
           <br>
		     <?php /*
           <div class="table-responsive">
            <table class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th><h6><b>Cleared Sites</b><br> <small>Sites that have their wallets allowed to request more than 1 time but only with a different payment id.</small></h6></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($clearedAddresses as $key => $item) {
                  echo "<tr>
                  <th>".$key."</th>
                  </tr>";

                }?>
              </tbody>
            </table>
          </div>
*/?>

          <div class="table-responsive">
            <h6><b>Últimas 5 donaciones</b></h6>
            <table class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $deposits = ($bitcoin->get_transfers());

                $transfers = array_reverse(($deposits["transfers"]),true);
                $contador = 0;
                foreach($transfers as $deposit){
                  if($deposit["output"] == ""){
                    if($contador < 6){
                      $time = $deposit["time"];
                      echo "<tr>";
                      echo "<th>".gmdate("Y-m-d H:i:s", $time)."</th>";
                      echo "<th>".round($deposit["amount"]/$dividirEntre,8)."</th>";
                      echo "</tr>";
                      $contador++;
                    }
                  }


                }
                ?>
              </tbody>
            </table>
          </div>
          <p style="font-size:10px;">Donaciones de Bitcoin nova para apoyar al Faucet. . <br>Dirección: <?php echo $faucetAddress; ?><br>&#169; 2015 Faucet by Ratnet</p></center>
          <footer class="clearfix">
          </footer>
        </form>

      </fieldset>

    </div> <!-- end login-form -->

  </div>


  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <?php if(isset($_GET['msg'])) { ?>
  <script>
  setTimeout( function(){ 
    $( "#alert" ).fadeOut(3000, function() {
    });
  }  , 10000 );
  </script>
  <?php } ?>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114384209-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114384209-1');
</script>

</body>
</html>