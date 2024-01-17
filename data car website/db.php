<?php
class Database {
    public $pdo;

    public function __construct($db = "users", $user = "root", $pass = "", $host = "localhost:3307") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function getReservedCarsForToday() {
        $today = date("Y-m-d");
        $stmt = $this->pdo->prepare("SELECT * FROM rentals WHERE rental_date = ?");
        $stmt->execute([$today]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function loginUser($identifier, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE name = :identifier OR email = :identifier");
        $stmt->execute(['identifier' => $identifier]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function getAllCustomers() {
        $stmt = $this->pdo->query("SELECT * FROM user WHERE role = 'customer'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllReservations() {
        $stmt = $this->pdo->query("SELECT user.name, rentals.rental_date 
                                  FROM user 
                                  INNER JOIN rentals ON user.id = rentals.ID");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getAllCars() {
        $stmt = $this->pdo->query("SELECT * FROM rentals");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNewCar($model, $price) {
        $stmt = $this->pdo->prepare("INSERT INTO rentals (model, price) VALUES (?, ?)");
        $stmt->execute([$model, $price]);
    }

    public function addNewCustomer($name, $password) {
        $role = 'customer';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt = $this->pdo->prepare("INSERT INTO user (name, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$name, $hashedPassword, $role]);
    }
    

    public function addNewReservation($customerId, $carModel, $rentalDate) {
        $stmt = $this->pdo->prepare("INSERT INTO rentals (ID, model, rental_date) VALUES (?, ?, ?)");
        $stmt->execute([$customerId, $carModel, $rentalDate]);
    }
}
?>
