<?php
require_once '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "Pizza";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
$faker = Faker\Factory::create('de_DE');
$faker->seed(100);


$sql = 'INSERT INTO pizza_topping(pizzaid, toppingid) VALUES (
                                                      :pizzaid, :toppingid
)';
$stmt = $conn->prepare($sql);

for ($i = 1; $i <301 ; $i++) {
    $pizzaid = $i;
    $stmt->bindParam(':pizzaid', $pizzaid);
    $topinganzahl = $faker->numberBetween(1,5);
    for ($j = 0; $j < $topinganzahl; $j++) {
        $topping = $faker->numberBetween(1,30);
        $stmt->bindParam(':toppingid', $topping);
        $stmt->execute();
    }
}

