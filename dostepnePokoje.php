<?php

$osoby=$_POST['ileosob'];

$dod=$_POST['dzienod'];
$mod=$_POST['miesiacod'];
$rod=$_POST['rokod'];
$ddo=$_POST['dziendo'];
$mdo=$_POST['miesiacdo'];
$rdo=$_POST['rokdo'];

$od=mktime(0,0,0,$mod, $dod, $rod);
$do=mktime(0,0,0,$mdo, $ddo, $rdo);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.2/css/bulma.css">
  <title>InOP</title>
</head>
<body>
  <div class="container"></div>

    <!-- BOX -->

    <div class="block">
      <div class="columns">
        <div class="column is-2">
        </div>
        <div class="column is-8">
          <div class="block" style="margin-top: 10%;">
            <div class="box has-text-centered" style="height:600px;  border-radius: 5px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.96), 0 0 0 1px rgb(0, 0, 0);">
                <div class="block">
                    <div class="box has-text-centered" style="height:560px;  border-radius: 5px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.96), 0 0 0 1px rgb(0, 0, 0);">
                        <h1 class="title" style="font-size:2em;"><b>Dostępne Pokoje</b></h1>
                        <div style="height:25px;"></div>
<!-- BEGIN -->
<?php
require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
	echo "Error: ".$polaczenie->connect_errno;
}
else
{
	
$z = $polaczenie->query("SELECT * FROM pokoje WHERE ile_osob='$osoby'");



while ($r = $z->fetch_assoc()) {
	
	$x = $polaczenie->query("SELECT * FROM rezerwacje WHERE nr_pokoju = '$r[nr_pokoju]'");
	$a= $x->fetch_assoc();
		$bod=mktime(0,0,0, $a["miesod"], $a["dzienod"], $a["rokod"]);
		$bdo=mktime(0,0,0, $a["miesdo"], $a["dziendo"], $a["rokdo"]);
	if(($od<$bod&&$od<$bdo&&$do>$bod&&$do<$bdo)||($od>$bod&&$od<$bdo&&$do>$bod&&$do<$bdo)||($od>$bod&&$od<$bdo&&$do>$bod&&$do>$bdo))
	{echo '';}
	else
	{
		echo ' <a href="infoOPokoju.html"><div class="block"><div class="columns"><div class="column is-3"><p class="notification">'.$osoby.'-osobowy</p></div><div class="column is-7"><p class="notification">'.$r["opis"].'<p></div><div class="column is-2"><p class="notification">'.$r["cena"].'</p></div></div></div></a>';
	}
}

$z->free();
}

?>

<!-- END -->
 

                    </div>
                  </div>
            </div>
          </div>
        </div>
        <div class="column is-2">

        </div>
      </div>
    </div>

  </div><!-- /. container -->


</body>
</html>