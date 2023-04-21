<?php

//used to include the config.php file, which contains the database configuration parameters
require_once 'config.php';

class Person {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function createPerson($firstName, $surname, $dateOfBirth, $emailAddress, $age) {
        $stmt = $this->conn->prepare("INSERT INTO Person (FirstName, Surname, DateOfBirth, EmailAddress, Age) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $firstName, $surname, $dateOfBirth, $emailAddress, $age);
        $stmt->execute();
        $stmt->close();
    }

    public function loadPerson($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Person WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $person = $result->fetch_assoc();
        $stmt->close();

        return $person;
    }

    public function savePerson($id, $firstName, $surname, $dateOfBirth, $emailAddress, $age) {
        $stmt = $this->conn->prepare("UPDATE Person SET FirstName = ?, Surname = ?, DateOfBirth = ?, EmailAddress = ?, Age = ? WHERE id = ?");
        $stmt->bind_param("sssisi", $firstName, $surname, $dateOfBirth, $emailAddress, $age, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deletePerson($id) {
        $stmt = $this->conn->prepare("DELETE FROM Person WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function loadAllPeople() {
        $result = $this->conn->query("SELECT * FROM Person");
        $people = [];

        while ($row = $result->fetch_assoc()) {
            $people[] = $row;
        }

        return $people;
    }

    public function deleteAllPeople() {
        $this->conn->query("TRUNCATE TABLE Person");
    }

    public function generateRandomData() {
        $firstNames = ['Johan', 'Lisa', 'Frikkie', 'Dawid', 'Leandra', 'Sharne', 'Roelof', 'Peet', 'Willie', 'Herman', 'Dominique'];
        $lastNames = ['Visser', 'Oliver', 'Boltman', 'Steenkamp', 'Joubert', 'Swanepoel', 'Janse van Vuuren', 'Hoffman', 'Jooste', 'Riley'];

        return [
            'FirstName' => $firstNames[array_rand($firstNames)],
            'Surname' => $lastNames[array_rand($lastNames)],
            'DateOfBirth' => date('Y-m-d', strtotime('-' . mt_rand(1, 365 * 70) . ' days')),
            'EmailAddress' => strtolower($firstNames[array_rand($firstNames)]) . '.' . strtolower($lastNames[array_rand($lastNames)]) . '@example.com',
            'Age' => mt_rand(1, 100)
        ];
    }

}

$personObj = new Person();

// Start script execution timer and log
$startTime = microtime(true);
error_log("Script started: " . date('Y-m-d H:i:s') . PHP_EOL);

// Create 10 new people using random data
for ($i = 0; $i < 10; $i++) {
    $data = $personObj->generateRandomData();
    $personObj->createPerson($data['FirstName'], $data['Surname'], $data['DateOfBirth'], $data['EmailAddress'], $data['Age']);
}

// Load all people from the database
$allPeople = $personObj->loadAllPeople();

// Print each person's information to the screen
foreach ($allPeople as $person) {
    echo "ID: {$person['id']}, Name: {$person['FirstName']} {$person['Surname']}, Date of Birth: {$person['DateOfBirth']}, Email: {$person['EmailAddress']}, Age: {$person['Age']}<br>";
}

// End script execution timer and log
$endTime = microtime(true);
$executionTime = round($endTime - $startTime, 2);
error_log("Script ended: " . date('Y-m-d H:i:s') . ", Execution time: {$executionTime} seconds" . PHP_EOL);

// Display execution time on the screen
echo "<br>Execution time: {$executionTime} seconds" . PHP_EOL;

?>
