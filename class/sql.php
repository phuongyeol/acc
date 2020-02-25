<?php
	
	# Class: SQL/PDO
	# *****************************************
	# This class contains handful sql functions that handle
	# basic queries. This also provides the mechanism for
	# handling sql obj (close, rollback, commit, undone).
	
	# We use mysqli connect to work with commit/uncommit.
	
	# Note: The basic different between this class and the file
	# connection.php is that this class using all static methods
	# so that programmers dont have to pass the &$connection
	# variables everytime.

	# Last revised on 04/13/2010.

	
	# No direct access.
	
	class SQL{
		private static $instance=null;
		private static $connection;
		private static $committed;
		private static $disabled=false;
		
		protected static $has_error=false;
		protected static $show_query=false;
		
		
		protected static $counter=0;
		protected static $counter_cached=0;
		
		protected static $query_caches=array();
		
		protected static $start_time=0;
		protected static $started=false;
		
	
		protected static $__readonly=false;
		protected static $__timeout;
		
		function __destruct(){
			// echo "SQL Done";
		}
		
		
		public static function instance(){
			if (static::$instance){
				return static::$instance;
			}
			
			static::$instance=new static;
			return static::$instance;
		}
		
		
		
		/**
		 * @desc Make a connection to SQL server.
		 */
		public static function init() {
			if (self::$disabled) {
				return;
			}

			self::$counter_cached = SQL_QUERY_LOGGED;
			self::$started = true;
			self::$start_time = microtime(true);

			// $msg = "Connection failed. Try again later. " . static::getServerIP() . "\n";

			$port = 3306;
			if (defined("DB_PORT")) {
				$port = DB_PORT;
			}

			try {
				self::$connection = new PDO("mysql:host=" . DB_SERVER . ";port=" . $port . ";dbname=" . DB_DBNAME . ";charset=utf8", DB_USERNAME, DB_PASSWORD, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"]);
			} catch (PDOException $e) {
				// $msg="Connection failed. Try again later. ".static::getServerIP()."\n";
				$msg = "Server is overload with too many connections";
				if (ENV == 0) {
					print_r($e);
				}
				static::timeout($msg);
				exit($msg);
			}
		}
		
		
		/**
		 * @desc Get the SQL connection
		 */
		public static function getConnection(){
			return self::$connection;
		}
		
		
		/**
		 * @desc Setting charset of the current MySQL connection
		 */
		public static function setCharset($charset="utf8"){
			deprecated("SQL::setChartset");
		}
		
		
		/**
		 * @desc Setting the read-only flag
		 * @param boolean $flag (true|false)
		 */
		public static function readOnly($flag=true){
			static::$__readonly=$flag; 
		}
		
		
		/**
		 * @desc Check if the SQL is writable or not
		 * @return boolean
		 */
		public static function writable(){
			return !static::$__readonly;
		}
		
		
		/**
		 * @desc Get the current SQL config
		 */
		public static function getConfig(){
			return (object)["host"=>DB_SERVER, "db"=>DB_DBNAME];
		}
		
		
		/**
		 * @desc Get all called queries
		 */
		public static function getQueries(){
			return self::$query_caches;
		}
		
		
		
		/**
		 * @desc Check if SQL is trying to connect already.
		 */
		public static function started(){
			return self::$started;
		}
		
		
		/**
		 * @desc Check that the connection is fine.
		 */
		public static function ok(){
			if (empty(self::$connection)){
				self::error("Empty connection.\n");
				exit;
			}
		}
		
		
		
		/**
		 * @desc Close the connection.
		 */
		public static function close(){
			self::$connection=null;
		}

		
		
		/**
		 * @desc Roll back the result on error.
		 */
		public static function rollback(){
			// mysqli_rollback(self::$connection);  // if error, roll back transaction
			self::$connection->rollBack();
		}

		
		
		/**
		 * @desc Rollback with error cached.
		 * @param string $message The message error.
		 */
		public static function undone(&$message=""){
			if (!self::$committed){
				return true;
			}
			
			self::$connection->rollBack();
			if (!empty($message)){
				self::error($message);
				return false;
			}
			return true;
		}

		
		
		/**
		 * @desc Start a transaction. Use finish()
		 * to finish the transaction.
		 */
		public static function commit(){
			if (!static::$connection->inTransaction()){
				return true;
			}
			
			
			if (self::$committed){ // No doubly commited
				return true;
			}
			
			//begin transaction
			self::$connection->beginTransaction();
			self::$committed=true;
			return true;
		}

		
		
		/**
		 * @desc Finish the connection.
		 */
		public static function finish(){
			if (!self::$committed){
				return true;
			}
			
			//when finishing, need to commit the transaction
// 			$result = mysqli_commit(self::$connection);
// 			if (!$result) {
// 			   self::rollback(self::$connection, "commit");  // if error, roll back transaction
// 			   return false;
// 			}
// 			return true;

			$result=self::$connection->commit();
			if (!$result){
				self::$connection->rollBack();
				return false;
			}
			
			return true;
		}
		
		
		
		/**
		 * @desc Mark that the table encounters error and and undone
		 * action should be made.
		 * 
		 * @param String $str 
		 */
		public static function markError($str=''){
			self::$has_error=true;
		}
		
		
		/**
		 * @desc Clear database error
		 * 
		 * @param String $str 
		 */
		public static function clearError(){
			self::$has_error=false;
		}
		
		
		/**
		 * @desc Clear database error
		 * 
		 * @param String $str 
		 */
		public static function hasError(){
			return self::$has_error;
		}
		
		
		
		
		/**
		 * @desc Fetch SQL results into array.
		 * @param PDOStatement $result
		 */
		public static function fetch(&$result){
			return $result->fetch(PDO::FETCH_ASSOC);
		}
		
	
		public static function showQuery($flag=true){
			self::$show_query=$flag;
		}
		
		
		/**
		 * @deprecated No use from the third version.
		 * 
		 * @desc Test a query and check if the process of handling the 
		 * query has error or not. This is really handy for insert, update 
		 * delete, create query, as we only care about whether the query is successful.
		 * @param string $query
		 * 
		 * From the third version, this function is deprecated. We have to separate 
		 * read and write query completely.
		 */
		public static function test(&$query){
			exit('This function is deprecated');
			
			$result=self::query($query);
			if (!$result){	
				self::error($query);
				return false;
			}
			return true;
		}
		
		
		
		/**
		 * @desc Make a read query. This doesn't trigger any write or update.
		 * @param string $query
		 */
		public static function read($query, $params=null){
			$result=self::query($query, $params);
			
			if (!$result || self::isEmpty($result)) return NULL;
			return $result;
		}
		
		
		
		/**
		 * @desc Make a write query. This may trigger an action to maintain
		 * the eventually consistant property. Slavery table may not be writed
		 * immediately, but is appended for later use.
		 */
		public static function write($query){
			static::requireReadOnly($query);
			
			$result=self::$connection->exec($query);
			if (!$result){	
				// self::error($query);
				return false;
			}
			return $result;
		}
		
		
		/**
		 * @desc Making update query (a write query).
		 * @param string $query
		 */
		public static function update($query, $params=null){
			static::requireReadOnly($query);
			
			if ($params){
				$stmt=static::$connection->prepare($query);
				
				foreach ($params as $k=>$v){
					$stmt->bindValue($k, $v);
				}
				
				$result=$stmt->execute();
			}else{
				$result=self::$connection->exec($query);
				return $result;
			}
			
			if (!$result){
				self::error($query);
				return false;
			}
			return true;
		}
		
		
		
		/**
		 * @desc Making delete query (a write query).
		 * @param string $query
		 */
		public static function delete($query, $params=null){
			static::requireReadOnly($query);
			
			if ($params){
				$stmt=static::$connection->prepare($query);
		
				foreach ($params as $k=>$v){
					$stmt->bindValue($k, $v);
				}
		
				$result=$stmt->execute();
			}else{
				$result=self::$connection->exec($query);
			}
			
			return true;
		}
		
		
		
		/**
		 * @desc Make a search query.
		 * @param string $query
		 * @alias of read. 
		 */
		public static function get($query){
			return self::read($query);
		}

		
		
		/**
		 * @desc A special case of read, when we only want to get the
		 * first row result. This is very handy if we want to connect
		 * and get result of a single identifier (like, by user_id, get
		 * the user).
		 * @param string $query
		 */
		public static function single($query){
			$result=self::read($query);
			if (!$result || self::isEmpty($result)){
				return NULL;
			}
			$row=$result->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

		
		/**
		 * @desc Make an insert query.
		 * @param string $query
		 * @param int $with_id
		 * @return int The id of the last insertion.
		 */
		public static function insert($query, $params, $with_id=null){
			static::requireReadOnly($query);
			
			if (self::$show_query){
				echo "<pre> $query\n</pre>";
				echo "<pre> ".static::getRawQuery($query, $params)."\n</pre>";
			}
			
			
			$stmt=static::$connection->prepare($query);
			foreach ($params as $k=>$v){
				$stmt->bindValue($k, $v);
			}
			
			$row=$stmt->execute();
			if ($row!==false){
				if ($with_id!==null){
					return $with_id;
				}
				return static::$connection->lastInsertId();
			}else{
				if (self::$show_query){
					print_r($stmt->errorInfo());
				}

				@error_log(json_encode($stmt->errorInfo()));
				error_log(SQL::getPlainQuery($query, $params));
				
				return null;
			}
		}
		
		
		/**
		 * Changing SQL results to array.
		 * @param PDOStatement $result
		 */
		public static function toArray($result){
			$a=array();
			if ($result==null){
				return $a;
			}
			
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			return $rows;

		}	

		
		
		
		
		/**
		 * ERROR HANDLING
		 */
		
		/**
		 * Showing the error.
		 * @param string $error.
		 */
		public static function error($error){
			error($error);
		}
		
		
		/**
		 * Show a fatal error
		 * @param string $error
		 */
		public static function fatal($error){
			fatal($error);
		}
		
		
			
		/**
		 * List of alias function
		 */

		/**
		 * @desc Alias of get()
		 * @param string $query
		 */
		public static function search(&$query){
			return self::get($query);
		}
		
		
		/**
		 * @desc Alias of finish()
		 */
		public static function done(){
			return self::finish();
		}
		

		/**
		 * @desc Alias of ok()
		 */
		public static function connected(){
			return self::ok();
		}
		
		
		
		/**
		 * 
		 * @desc Changing SQL result to an array of objects.
		 * @param PDOStatement $result
		 * @param string $obj_name The name of the object.
		 */
		public static function toObj($result,$obj_name){
			$a=array();
			if ($result==null || count($result)<=0){
				return $a;
			}
			
			$rows=$result->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($rows as $row){
				$obj=new $obj_name();
				$obj->extend($row);
				$a[]=$obj;
			}
			
			return $a;
		}
		
	
		
		/**
		 * @desc Trigger a flag to indicate that we will cache the number of query.
		 * @param Boolean $flag
		 */
		public static function cache($flag=true){
			self::$counter_cached=$flag;
		}
		
		
		/**
		 * @desc Log the number of request to a file.
		 */
		public static function logCounter(){
			if (!self::$counter_cached){
				return;
			}
		}
		
		
		public static function showStats(){
			$second=microtime(true)-self::$start_time;
			return "SQL: ".static::$counter." queries in {$second} seconds\n";
		}
		
		
		
		/**
		 * @desc Handle timeout
		 */
		public static function timeout($msg){
			if (static::$__timeout){
				require_once static::$__timeout;
				exit;
			}
			
			echo $msg; 
			exit;
		}
		
		
		
		/**
		 * @desc Register timeout page
		 * @param string $file
		 */
		public static function registerTimeoutPage($file){
			static::$__timeout=$file;
		}
		
		
		/**
		 * @desc Log a query
		 * @param string $query
		 */
		public static function logQuery($query){
			self::$counter++;
			self::$query_caches[]=$query;
		}
		
		
		
		/**
		 * @desc Function to block write query
		 * @param string $err_msg
		 */
		protected static function requireReadOnly($query, $err_msg="DB.REQUIRE.READONLY"){
			if (static::$__readonly){
				if (ENV==0){
					echo $query."\n";
				}
				exit($err_msg);
			}
		}
		
		
		
		/**
		 * PRIVATE FUNCTIONS 
		 */
		
		
		/**
		 * @desc Check if the result returned by SQL result is empty.
		 * @param PDOStatement $result
		 */
		private static function isEmpty(&$result){
			if (!$result->rowCount()){
				return true;
			}
			return false;
		}
		
		
		
		/**
		* @desc Making the query.
		* @param SQL query $query
		*/
		protected static function query($query, $params=null){
			if (self::$disabled){
				return;
			}
			
			if (self::$show_query){
				print_r($params);
				echo "<pre> $query\n</pre>";
			}
			
			
			static::logQuery($query);

			// return mysqli_query(self::$connection,$query);
			
			if ($params && count($params)){
				$stmt=static::$connection->prepare($query);
				foreach ($params as $k=>$v){
					$stmt->bindValue($k, $v);
				}
				
				$stmt->execute();
				return $stmt;
			}else{
				$stmt=static::$connection->prepare($query);
				$stmt->execute();
				return $stmt;
			}
			
			// return $stmt -> fetch(PDO::FETCH_ASSOC);
			
			// return self::$connection->query($query);
		}
		
		
		/**
		 * @desc Getting a raw query from scheduled query
		 */
		public static function getRawQuery($query, $params=[]){
			$q=preg_replace_callback('/:([a-zA-Z0-9_]+)(\W)/', function($ms)use($params){
				$key=$ms[1];
				if (isset($params[$key])){
					return "'".addslashes($params[$key])."'".$ms[2];
				}
				
				return $ms[0];
			}, $query);
			
			return $q;
		}
		
		
		
		/**
		* @desc Making the query.
		* @param SQL query $query
		*/
		public static function querySafe($query){ 
			return mysqli_multi_query(self::$connection,$query);
		}
		
		
		/**
		 * @desc Return the last insertion of the database.
		 */
		public static function lastInsertion(){
			$query="select Last_Insert_ID() as last_id";
			$result=self::single($query);
			if ($result==NULL) return -1;
			return $result["last_id"];
		}
		
		
		
		public static function disableConnection(){
			self::$disabled=1;
		}
		
		
		/**
		 * @desc Get the server's IP address
		 * @return string
		 */
		public static function getServerIP(){
			return $_SERVER['SERVER_ADDR'];
		}
		
		
		public static function getPlainQuery($query, $params){
			$search=[];
			$replace=[];
			
			foreach ($params as $k=>$v){
				$search[]=":$k";
				$replace[]="'".$v."'";
			}
			
			$q=str_replace($search, $replace, $query);

			return $q;
		}
		
		
	}
	
?>