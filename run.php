<?php

function myAutoloader($className ){
    $classFile = "Class/".$className . '.php'; //Class/Kundedfgfdg.php

    if (file_exists($classFile)) {
        require_once $classFile;
    }
}
spl_autoload_register('myAutoloader');


//var_dump(Kunde::create('test','test','12346','tset','dsgfdgsfsag 45','esvklfglkj'));
$pizza = Pizza::create(true);
$top1 = Topping::findbyID(10);
$top2 = Topping::findbyID(8);
$top3 = Topping::findbyID(7);
$pizza->addTopping($top1,$top2,$top3);
$pizza->topinDb();
var_dump($pizza);

// Die benötigten credentials für die Datenbank----------------
//$servername = "localhost";
//$username = "root";
//$pass = "";
//$dbname = "Pizza";
//----------------------------------------------------------

//------ Erstellen des PDO Objektes -----------------------------------

//$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pass);
//
////---------------- sql-Befehl Insert
//
////$sql = "Insert Into topping (name, preis) VALUES ('Ananas',2.00)";
////----------------------------------------------------------------
//
//
////sql-Befehl Select
//$id = 1;
//$sql = "Select * From topping where id = :platzhalter";
//$stmt = $conn->prepare($sql);
//$stmt->execute(['platzhalter' => $id]);
//$result = $stmt->fetch(2);
//$topping = new Topping($result['id'],$result['name'],$result['preis']);
//
////----- Die Methode exec des PDO Objektes aufgerufen und den sql-Befehl damit ausgeführt
////$conn->exec($sql);
//
//
//print_r($result);



//
//
//$kunde = new Kunde('Manuel','Martinez','55555','Berlin', 'Strasse 4');
//
//$bestellung = $kunde->bestellung();
//
//$salami = new Topping('Salami', 1.00);
//$pilze = new Topping('Pilze', 0.80);
//$ananas = new Topping('Ananas', 20.00);
//
//$pizza1 = new Pizza(true, 8.00);
//$pizza1->addTopping($salami,$salami,$pilze);
//
//$bestellung->addBestellitem($pizza1);
//$pizza2 = new Pizza(false,5.00);
//$pizza2->addTopping($ananas);
//$pizza2->addTopping($pilze);
//$bestellung->addBestellitem($pizza2);
//$cola = new Getraenk('Cola', 3.00);
//$fanta = new Getraenk('Fanta', 2.50);
//$bestellung->addBestellitem($cola);
//$bestellung->addBestellitem($fanta);
//




//print_r($pizza1);
//print_r($pizza2);
//print_r($salami);
//print_r($bestellung);
//print_r($bestellung->rechnungsBetrag());
//echo $bestellung->rechnungHtml();