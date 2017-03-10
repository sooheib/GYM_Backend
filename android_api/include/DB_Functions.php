<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt

        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at) VALUES(?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $uuid, $name, $email, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $epassword = $user['epassword'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($epassword == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return $user;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }
    
        public function bookUser($schedule_id, $client_id) {


        $stmt = $this->conn->prepare("INSERT INTO reservation_t(client_id,schedule_id, created) VALUES(?, ?,NOW())");
        $stmt->bind_param("sssss",$client_id, $schedule_id);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful booking
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM reservation_t WHERE client_id = ? and schedule_id= ? ");
            $stmt->bind_param("s", $client_id,$schedule_id);
            $stmt->execute();
            $reservation_t = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $reservation_t;
        } else {
            return false;
        }
    }
    
        public function isUserBooked($client_id,$schedule_id) {
        $stmt = $this->conn->prepare("SELECT client_id from reservation_t WHERE client_id = ? and schedule_id=? ");

        $stmt->bind_param("s", $client_id,$schedule_id);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }
    
    
    public function incrimentSeance($idSeance)
    {
        $stmt = $this->conn->prepare("UPDATE schedule_t 
    SET countMumber = countMumber + 1
    WHERE schedule_id = :id");
        $stmt->bind_param(":id",$idSeance);
        $result = $stmt->execute();
    }



}

?>
