<?php
class Persons{
  
    // database connection and table name
    private $conn;
    private $table_name = "persons";
  
    // object properties
    public $id;
    public $role;
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $password_hash;
	public $password_salt;
    public $address;
    public $address2;
    public $city;
    public $state;
    public $zip;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // create product
    function create(){
  
        // insert query
		$query = "INSERT INTO " . $this->table_name . "
            SET role=:role, fname=:fname, lname=:lname, email=:email, phone=:phone,
                password_hash=:password_hash, password_salt=:password_salt, address=:address,
                address2=:address2, city=:city, state=:state, zip_code=:zip";
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->fname=htmlspecialchars(strip_tags($this->fname));
        $this->lname=htmlspecialchars(strip_tags($this->lname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        //$this->password_hash=htmlspecialchars(strip_tags($this->password_hash));
        //$this->password_salt=htmlspecialchars(strip_tags($this->password_salt));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->address2=htmlspecialchars(strip_tags($this->address2));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->state=htmlspecialchars(strip_tags($this->state));
        $this->zip=htmlspecialchars(strip_tags($this->zip));
  
  
        // bind values 
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":fname", $this->fname);
        $stmt->bindParam(":lname", $this->lname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":password_hash", $this->password_hash);
        $stmt->bindParam(":password_salt", $this->password_salt);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":address2", $this->address2);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);
		$stmt->bindParam(":zip", $this->zip);
        
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
	
	//function to readAll records in the database to load them
	//into the index table for viewing. Calls $from_record_num, $records_per_page
	//which are set in core.php
	function readAll(){
	
	//string variable to hold the database query to get
	//the prouct records to read
    $query = "SELECT id, fname, lname, email FROM " . $this->table_name . " ORDER BY lname";
  
	//varibale that uses the prepare method from conn to take
	//the query string and put it in the connection method 
    $stmt = $this->conn->prepare( $query );
	
	//uses the execute() function to send the query
	// to the database and get the requested information back
    $stmt->execute();
	
	//return the data requested from the query
    return $stmt;
	}
	
	// used for paging products
	public function countAll(){
  
    $query = "SELECT id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
	}
	
	function readOne(){
  
    $query = "SELECT * FROM " . $this->table_name . "
        WHERE id = ?
        LIMIT 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $this->id = $row['id'];
    $this->role = $row['role'];
    $this->fname = $row['fname'];
    $this->lname = $row['lname'];
    $this->email = $row['email'];
    $this->phone = $row['phone'];
    $this->password_hash = $row['password_hash'];
    $this->password_salt = $row['password_salt'];
    $this->address = $row['address'];
    $this->address2 = $row['address2'];
    $this->city = $row['city'];
    $this->state = $row['state'];
    $this->zip = $row['zip_code'];
	}
	
	function update(){
  
    $query = "UPDATE
                " . $this->table_name . "
            SET
                role = :role,
                fname = :fname,
                lname = :lname,
                email  = :email,
                phone = :phone,
                password_hash = :password_hash,
                password_salt = :password_salt,
                address = :address,
                address2 = :address2, 
                city = :city, 
                state = :state,
                zip_code = :zip
            WHERE
                id = :id";
  
    $stmt = $this->conn->prepare($query);
  
    // posted values
    $this->role=htmlspecialchars(strip_tags($this->role));
    $this->fname=htmlspecialchars(strip_tags($this->fname));
    $this->lname=htmlspecialchars(strip_tags($this->lname));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    //$this->password_hash=htmlspecialchars(strip_tags($this->password_hash));
    //$this->password_salt=htmlspecialchars(strip_tags($this->password_salt));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->address2=htmlspecialchars(strip_tags($this->address2));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->state=htmlspecialchars(strip_tags($this->state));
    $this->zip=htmlspecialchars(strip_tags($this->zip));


    // bind values 
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":role", $this->role);
    $stmt->bindParam(":fname", $this->fname);
    $stmt->bindParam(":lname", $this->lname);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":phone", $this->phone);
    $stmt->bindParam(":password_hash", $this->password_hash);
    $stmt->bindParam(":password_salt", $this->password_salt);
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":address2", $this->address2);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":state", $this->state);
    $stmt->bindParam(":zip", $this->zip);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
		echo 'I am here now';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":id", $this->id);
	
		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>