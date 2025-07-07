<?php 
/**
 * 
 */

// require glob_api('private.php');
class Mysql
{
	public $connection;
	public $servername;
	public $username;
	public $password;
	public $dbname;

	function __construct($servername, $username, $password, $dbname)
	{
		$this->connection = new mysqli($servername, $username, $password, $dbname);
	}

	function status(){
		$conn = $this->connection;
		return $conn; 
	}

	// get all record from one table
	// ** getAll('table_name', ['where_kolom_1'=>$value], 'order by kolom_1, kolom_2')
	// if $debug is true then it return this MYSQL query instead of record
	function getAll($tablename='', $where=[], $order_by='', $debug=false)
	{
		$query = "SELECT * FROM ".$tablename;
		$where_key = 0;
		foreach ($where as $key => $val) {
			if($where_key==0){
				$query .= " WHERE ".$key."='".$val."'";
			}else{
				$query .= " AND ".$key."='".$val."'";
			}
			$where_key++;
		}
		if($order_by!=''){
			$query .= " ORDER BY ".$order_by;
		}
		$data = $this->execute($query, $debug);
		return $data;
	}

	function getOne($tablename='', $where=[], $order_by='', $debug=false)
	{
		$query = "SELECT * FROM ".$tablename;
		$where_key = 0;
		foreach ($where as $key => $val) {
			if($where_key==0){
				$query .= " WHERE ".$key."='".$val."'";
			}else{
				$query .= " AND ".$key."='".$val."'";
			}
			$where_key++;
		}
		if($order_by!=''){
			$query .= " ORDER BY ".$order_by;
		}
		$data = $this->execute($query, $debug);
		if( count($data)>0 ){
			$data=$data[0];
		}
		return $data;
	}

	function getLimit($tablename='', $where=[], $order_by='', $limit = 1, $debug=false)
	{
		$query = "SELECT * FROM ".$tablename;
		$where_key = 0;
		foreach ($where as $key => $val) {
			if($where_key==0){
				$query .= " WHERE ".$key."='".$val."'";
			}else{
				$query .= " AND ".$key."='".$val."'";
			}
			$where_key++;
		}

		if($order_by!=''){
			$query .= " ORDER BY ".$order_by;
		}
		$query .= " LIMIT " . $limit;

		$data = $this->execute($query, $debug);
		return $data;
	}

	// Insert into database
	// ** insert('table_name', ['kolom_1'=>$value_1, 'kolom_2'=>$value_2])
	function insert($tablename='', $setdata=[], $debug=false)
	{
		$query = "INSERT INTO $tablename ";
		$kolom = '';
		$value = '';
		foreach ($setdata as $key => $val) {

			$kolom .= $kolom==''? "$key" : " ,$key";
			$value .= $value==''? "'$val'" : " ,'".addslashes($val)."'";
		}
		$query .= "($kolom) VALUES ($value)";
		$data = $this->execute($query, $debug);
		return $data;
	}


	//Ipdate/Edit Record Database
	// ** update('table_name', ['kolom_1'=>$value_1, 'kolom_2'=>$value_2], ['where_kolom'=>$value_where])
	function update($tablename='', $setdata=[], $where=[], $debug=false)
	{
		$query = "UPDATE $tablename ";
		$set = 'SET';
		foreach ($setdata as $key => $val) {
			if($set=='SET'){
				$set .= " ".$key."='".addslashes($val)."'";
			}else{
				$set .= " ,".$key."='".addslashes($val)."'";
			}
		}
		$query .= $set;
		$where_key = 0;
		foreach ($where as $key => $val) {
			if($where_key==0){
				if($val == "null" || $val == NULL ){
					$query .= " WHERE ".$key." IS NULL";
				}else{
					$query .= " WHERE ".$key."='".addslashes($val)."'";
					// $query .= " WHERE ".$key."='".$val."'";	
				}

			}else{
				if($val == "null" || $val == NULL ){
					$query .= " AND ".$key." IS NULL";
				}else{
					$query .= " AND ".$key."='".$val."'";	
				}
			}

			$where_key++;
		}
		$data = $this->execute($query, $debug);
		return $data;
	}

	// Delete Record From Database
	// ** delete('table_name', ['where_kolom_1'=>$value_1])
	function delete($tablename='', $where=[], $debug=false)
	{
		$query = "DELETE FROM $tablename ";
		$where_key=0;
		foreach ($where as $key => $val) {
			if($where_key==0){
				if($val != "null" || $val != NULL ){
					$query .= " WHERE ".$key."='".$val."'";	
				}else{
					$query .= " WHERE ".$key."='".addslashes($val)."'";
				}
				
			}else{
				if($val != "null" || $val != NULL ){
					$query .= " AND ".$key."='".addslashes($val)."'";	
				}else{
					$query .= " AND ".$key." IS NULL";
				}
			}
			$where_key++;
		}
		
		$data = $this->execute($query, $debug);
		return $data;
	}

	// function execute_api( $query='' , $debug=false){
	// 	$result = execute_query($query);

 //        return $result;
	// }

	function execute( $query='' , $debug=false){
		
		if($debug){
			return $query;
		}
		$queryLower = strtolower($query);
		$conn = $this->connection;
		if(substr($queryLower,0,6)=="select"){
			if($result = $conn->query($query)){
				$name_field = array(); //ini untuk mengisi nama field
				$return_result = array(); //ini yang diparsingkan
				$number = 0; //untuk indexing array pada $data
				$field_count=mysqli_num_fields($result); //ini untuk menghitung jumlah field
				while ($field_name=mysqli_fetch_field($result)){
			    	array_push($name_field,$field_name->name); //untuk mengisi nama field yang di-select
			    }
			    if($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
				    	for($i=0;$i<count($name_field);$i++){
				    		$return_result[$number][$name_field[$i]] = $row[$name_field[$i]]; //mengisi data pada array $data
				    	}
						$number += 1;
				    }
				}
			}else {
			    $return_result = "Error: 
			    " . $query . "
			    " . $conn->error;
			}

		}else{	//insert update delete;

			if ($conn->query($query) === TRUE) { // New record created successfully
				if( substr($queryLower,0,6)=="insert" ){
					$return_result = $conn->insert_id==0? true : $conn->insert_id;
				}else{
					$return_result = true;
				}
				
			} else {
				$return_result = false;
			}
		}
		return $return_result;
	}
}
// if( isset( $_SESSION['login'] ) && $_SESSION['login']['type_login']=='trial' ){
// 	$db = new Mysql($config['mysql_trial']['servername'], $config['mysql_trial']['username'], $config['mysql_trial']['password'], $config['mysql_trial']['dbname']);

// }else{
// 	$db = new Mysql($config['mysql']['servername'], $config['mysql']['username'], $config['mysql']['password'], $config['mysql']['dbname']);
// }
?>