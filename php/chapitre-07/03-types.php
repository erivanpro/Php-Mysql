<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Manipuler les types de données</title>
    <style>
      h1 { font-family: "Courier New",Courier,monospace ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>conversion implicite</h1>
    <?php
    $nombre = 123;
    $chaîne = "456abc";
    echo '$nombre + $chaîne = ';
    var_dump($nombre + $chaîne);
    echo '<br />';
    echo '$nombre . $chaîne = ';
    var_dump($nombre . $chaîne);
    echo '<br />';
    echo '$nombre = ';
    var_dump($nombre);
    echo '<br />';
    echo '$chaîne = ';
    var_dump($chaîne);
    ?>
    
    <h1>(type)valeur</h1>
    <?php
    echo '(float)"1abc" = ',var_dump((float)"1abc"),'<br />';
    echo '(float)"1.5abc" = ',var_dump((float)"1.5abc"),'<br />';
    echo '(float)"abc1" = ',var_dump((float)"abc1"),'<br />';
    echo '(int)1.7 = ',var_dump((int)1.7),'<br />';
    echo '(int)"1.234e5" = ',var_dump((int)"1.234e5"),'<br />'; 
    echo '(int)TRUE = ',var_dump((int)TRUE),'<br />';
    echo '(int)FALSE = ',var_dump((int)FALSE),'<br />';
    echo '(bool)-1 = ',var_dump((bool)-1),'<br />';
    echo '(bool)0 = ',var_dump((bool)0),'<br />';
    echo '(bool)1 = ',var_dump((bool)1),'<br />';
    echo '(bool)"" = ',var_dump((bool)""),'<br />';
    echo '(bool)"0" = ',var_dump((bool)"0"),'<br />';
    echo '(bool)"1" = ',var_dump((bool)"1"),'<br />';
    echo '(bool)"a" = ',var_dump((bool)"a"),'<br />';
    ?>

    <h1>settype()</h1>
    <?php
    $x = '1abc';
    settype($x,'integer');
    echo '\'1abc\' converti en entier = ',var_dump($x),'<br />';
    $x = 1.7;
    settype($x,'integer');
    echo '1.7 converti en entier = ',var_dump($x),'<br />';
    $x = TRUE;
    settype($x,'string');
    echo 'TRUE converti en chaîne = ',var_dump($x),'<br />';
    $x = '0';
    settype($x,'boolean');
    echo '\'0\' converti en booléen = ',var_dump($x),'<br />';
    $x = -1;
    settype($x,'boolean');
    echo '-1 converti en booléen = ',var_dump($x),'<br />';
    ?>
    
    <h1>is_*()</h1>
    <?php
    unset($x);
    if (is_null($x)) {
      echo 'Pour l\'instant, $x est du type NULL.<br />';
    }
    $x = (1 < 2);
    if (is_bool($x)) {
      echo '$x = (1 &lt; 2) est du type booléen.<br />';
    }
    $x = '123abc';
    if (is_string($x)) {
      echo '$x = "123abc" est du type chaîne ...<br />';
    }
    if (! is_numeric($x)) {
      echo '... mais pas du « type » <i>numeric</i>.<br />';
    }
    ?>
    
    <h1>strval()</h1>
    <?php
    $x = TRUE;
    echo var_dump($x),' => ',var_dump(strval($x)),'<br />';
    $x = 1.2345;
    echo var_dump($x),' => ',var_dump(strval($x)),'<br />';
    ?>
    
    <h1>floatval()</h1>
    <?php
    $x = TRUE;
    echo var_dump($x)," => ",var_dump(floatval($x)),'<br />';
    $x = 123;
    echo var_dump($x)," => ",var_dump(floatval($x)),'<br />';
    $x = "1.23e45";
    echo var_dump($x)," => ",var_dump(floatval($x)),'<br />';
    $x = "123abc";
    echo var_dump($x)," => ",var_dump(floatval($x)),'<br />';
    $x = "\n\t\r 123.45abc";
    echo var_dump($x)," => ",var_dump(floatval($x)),'<br />';
    ?>
    
    <h1>intval()</h1>
    <?php
    $x = TRUE;
    echo var_dump($x),' => ',var_dump(intval($x)),'<br />';
    $x = 123.9;
    echo var_dump($x),' => ',var_dump(intval($x)),'<br />';
    $x = "9.99";
    echo var_dump($x),' => ',var_dump(intval($x)),'<br />';
    ?>
    
    <h1>round()</h1>
    <?php
    $x = 123.9;
    echo "round($x) => ";
    var_dump(round($x));
    ?>

    <h1>boolval()</h1>
    <?php
    $x = -1;
    echo var_dump($x),' => ',var_dump(boolval($x)),'<br />';
    $x = 0;
    echo var_dump($x),' => ',var_dump(boolval($x)),'<br />';
    $x = 1;
    echo var_dump($x),' => ',var_dump(boolval($x)),'<br />';
    $x = "";
    echo var_dump($x)," => ",var_dump(boolval($x)),'<br />';
    $x = "0";
    echo var_dump($x)," => ",var_dump(boolval($x)),'<br />';
    $x = "1";
    echo var_dump($x)," => ",var_dump(boolval($x)),'<br />';
    $x = "a";
    echo var_dump($x)," => ",var_dump(boolval($x)),'<br />';
    ?>
    
    </div>
  </body>
</html>