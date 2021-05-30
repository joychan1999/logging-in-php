
// class Store
// {

//     private $server = "mysql:host=remotemysql.com:3306;dbname=7zvOC8LbBr";
//     private $user = "7zvOC8LbBr";
//     private $pass = "7Fo3Yd8gWq";
//     private $options = array(
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     );

//     protected $connection;

//     public function openConnection()
//     {

//         try {

//             $this->connection = new PDO(
//                 $this->server,
//                 $this->user,
//                 $this->pass,
//                 $this->options

//             );
//             return $this->connection;
//         } catch (PDOException $error) {

//             echo "Error connection: " . $error->getMessage();
//         } //end trycatch
//     } //end function openConnection

//     public function closeConnection()
//     {
//         $this->connection = null;
//     } //end function closeConnection


//     public function getUsers()
//     {

//         $connection = $this->openConnection();
//         $statement = $connection->prepare("SELECT * FROM users"); //prepare the query
//         $statement->execute(); //built in function to execute
//         $users = $statement->fetchAll();
//         $userCount = $statement->rowCount();

//         if ($userCount > 0) {
//             return $users;
//         } else {
//             return 0;
//         } //end if-else

//     } //end function getUsers


//     public function login()
//     {

//         if (isset($_POST['login'])) {
//             $username = $_POST['username'];
//             $password = $_POST['password'];

//             $connection = $this->openConnection();
//             $statement = $connection->prepare(
//                 "SELECT * FROM users WHERE email = ? AND password = ?"

//             );
//             $statement->execute([$username, $password]); //kung unsay gibutang una sa ? mao sad iuna ug butang
//             $user = $statement->fetch();
//             $total = $statement->rowCount();

//             if ($total > 0 && $user['type'] == "seller") {
//                 $_SESSION['user_id'] = $user['id'];
//                 echo ("<script>window.location.href='./connection/seller.php';</script>");
//             } else if ($total > 0 && $user['type'] == "buyer") {
//                 $_SESSION['user_id'] = $user['id'];
//                 echo ("<script>window.location.href='./connection/buyer.php';</script>");
//             } else {
//                 echo "Login failed";
//             } //end of if-else

//         } //end ifset

//     } //end function login


//     public function signUp()
//     {
//         if (isset($_POST['signup'])) {
//             $firstname = $_POST['first_name'];
//             $lastname = $_POST['last_name'];
//             $email = $_POST['email'];
//             $password = $_POST['password'];

//             if ($this->checkUserIfExist($email) == 0) {
//                 $connection = $this->openConnection();
//                 $statement = $connection->prepare("INSERT INTO users(first_name,last_name,email,password) VALUES (?,?,?,?)");
//                 $statement->execute([$firstname, $lastname, $email, $password]);
//             } else {
//                 echo "user already exists";
//             } //end of if statement




//         } //end if set
//     } //end function addUser

//     public function select($table_name)  
//     {  
//          $array = array();  
//          $connection = $this->openConnection();
//          $query = "SELECT * FROM ".$table_name."";  
//          $result = mysqli_query($this->$connection, $query);  
//          while($row = mysqli_fetch_assoc($result))  
//          {  
//               $array[] = $row;  
//          }  
//          return $array;  
//     } //end of funtion select (fetching the data from the database)


//     // public function userDetail($id)
//     // {
//     //     $connection = $this->openConnection();
//     //     $statement = $connection->prepare("SELECT * FROM users WHERE id = ? ");
//     //     $statement->execute([$id]);
//     // }

//     public function UserDetails($id)
//     {
//         try {
//             $connection = $this->openConnection();
//             $query = $connection->prepare("SELECT * FROM users WHERE id=:id");
//             $query->bindParam("id", $id, PDO::PARAM_STR);
//             $query->execute();
//             if ($query->rowCount() > 0) {
//                 return $query->fetch(PDO::FETCH_OBJ);
//             }
//         } catch (PDOException $e) {
//             exit($e->getMessage());
//         }
//     }

//     public function checkUserIfExist($email)
//     {

//         $connection = $this->openConnection();
//         $statement = $connection->prepare("SELECT * FROM users WHERE email = ? ");

//         $statement->execute([$email]);
//         $total = $statement->rowCount();
//         return $total;
//     } //end function checkuser

// } //end class Store()
