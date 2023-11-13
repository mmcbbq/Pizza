<?php
require_once '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "Pizza";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
$faker = Faker\Factory::create('de_DE');
$faker->seed(100);


for ($kunde = 1; $kunde <= 100; $kunde++) {
    for ($bestellung = 0; $bestellung < $faker->numberBetween(1,5); $bestellung++) {
        $sql = 'INSERT INTO lieferung (kundenid) VALUES (:kundenid)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':kundenid', $kunde);
        $stmt->execute();
        $bestellnummer = $conn->lastInsertId();

        for ($getraenk = 0; $getraenk < $faker->numberBetween(0,10); $getraenk++) {
            $sql = 'INSERT INTO getraenke_lieferung(bestellnummer, getraenkeid) VALUES (:bestellnummer, :getraenkeid)';
            $stmt = $conn->prepare($sql);
            $getraenkeid = $faker->numberBetween(1,10);
            $stmt->bindParam(':bestellnummer', $bestellnummer);
            $stmt->bindParam(':getraenkeid', $getraenkeid);
            $stmt->execute();
        }

    }
}












//$sql = 'INSERT INTO pizza_lieferung(bestellnummer, pizzaid) VALUES (:bestellnummer, :pizzaid)';


























//$sql = 'INSERT INTO lieferung(kundenid, pizzaid, getraenkeid) VALUES (
//                                 :kundenid, :pizzaid, :getraenkeid)';
//$stmt = $conn->prepare($sql);
//$anzahl_pizza = 0;
//    for ($i = 1; $i < 101; $i++) {
//        $stmt->bindParam(':kundenid', $i);
//        for ($bestellungen = 0; $bestellungen < $faker->numberBetween(1, 5); $bestellungen++) {
//            for ($getraenk = 0; $getraenk <= $faker->numberBetween(0, 10); $getraenk++) {
//                $gid = $faker->numberBetween(1, 10);
//                $pid = null;
//                $stmt->bindParam(':pizzaid', $pid);
//                $stmt->bindParam(':getraenkeid', $gid);
//                $stmt->execute();
//            }
//            $gid = null;
//            $stmt->bindParam(':pizzaid', $gid);
//
//            for ($pizza = 0; $pizza <= $faker->numberBetween(0, 10); $pizza++) {
//                if ($anzahl_pizza == 300){
//                    break;
//                }
//                $pid = $faker->unique()->numberBetween(1, 300);
//                $stmt->bindParam(':pizzaid', $pid);
//                $stmt->execute();
//                $anzahl_pizza++;
//
//            }
//
//
//
//        }
//
//
//}