<?php class aModule{ 

	var $action = ""; 
	protected $p;
	protected $ID; 

	private $db = null;

 	protected $DBHOST;
 	protected $DBNAME;
 	protected $DBUSER;
 	protected $DBPASS;
 	protected $PREFIX;
 	protected $PCONNECT;
 	protected $dbid;
	protected $mysql;
	protected $output;
	
	function __construct(){



		$this->p = $_REQUEST;
		$this->ID = $this->id();
		
		$this->PREFIX = '';
		$this->PCONNECT = 0;
		$this->dbid = false;
		$this->mysql['sql'] = "";

		$this->DBHOST = DBHOST;
		$this->DBNAME = DBNAME;
		$this->DBUSER = DBUSER;
		$this->DBPASS = DBPASS;

		$this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		$this->db->set_charset('utf8');
		

        
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }


	}
	
    public function __call($storeProcedureName, $params)
    {
        $quotedParams = array ();
        foreach ($params as $param)
        {
            array_push($quotedParams, $param === null?'NULL':'"'.$param.'"');
        }
        $sql = 'CALL '.$storeProcedureName.'('.implode(',', $quotedParams).');';
        $this->db->multi_query($sql);
        $results = array ();
        do
        {
            if ($result = $this->db->store_result())
            {
                $rows = array ();
                while ($row = $result->fetch_assoc())
                {
                    array_push($rows, $row);
                }
                $result->close();
                array_push($results, $rows);
            }
        } while ($this->db->more_results() && $this->db->next_result());
        return ($results);
    }

    public function call_sp($sp_arr)
    {
    	
        //echo "<pre>"; print_r($sp_arr); echo "</pre>"; //die();
        
        $sql="";
		foreach ($sp_arr as $sp => $value)
		{
	        $quotedParams = array ();
			$storeProcedureName = $value['proc'];
            
            //echo $storeProcedureName;
            
	        foreach ($value['p'] as $param)
	        {
	            array_push($quotedParams, $param === null?'NULL':'"'.$param.'"');
	        }
	        $sql .= 'CALL '.$storeProcedureName.'('.implode(',', $quotedParams).');';
		}
		
        //echo $sql; die();/////////////////
        
        $this->db->multi_query($sql);
        $results = array ();
        do
        {
            if ($result = $this->db->store_result())
            {
                $rows = array ();
                while ($row = $result->fetch_assoc())
                {
                    array_push($rows, $row);
                }
                $result->close();
                array_push($results, $rows);
            }
        } while ($this->db->more_results() && $this->db->next_result());
        
        
        //echo "<pre>"; print_r($results); echo "</pre>"; //die();
        
        return ($results);
    }

	function mod_execute($params, $protocol='HTTP'){
		$this->mod_name=$params['mod_name'];
		$this->action=$params['action'];
		$this->prot=$protocol;
		$params['send_params'] = $_REQUEST;
		$this->execute($params);
	}
	
	function mod_display($protocol){
		$tpl_path=$this->mod_name.'/'.$this->mod_name.'.tpl';

		switch($protocol){
			case 'HTTP': $_SESSION['smarty']->display($tpl_path);
			break;

			case 'AJAX':  echo json_encode($this->output); 
			break;
		}
	}

 
    function array_random_assoc($arr) {
	$keys = array_keys($arr);
	shuffle($keys);
       
	$r = array();
	for ($i = 0; $i < count($keys); $i++) {
	    $r[$keys[$i]] = $arr[$keys[$i]];
	}
	return $r;
    }
 
	   
	function id()
	{
		if (isset($this->p['id']) && strlen($this->p['id'])>0)	{return $this->p['id'];}
		//else if(auth::id()) {return auth::id();}
		else {
            $this->p['id']=0;
            //echo " No authentification or ID found "; exit; 
            }
		return $this->p['id'];
	}
	
	function dbconnect() {
		$F = $this->PCONNECT ? 'mysql_pconnect' : 'mysql_connect';
		if (!$this->dbid) $this->dbid = $F($this->DBHOST, $this->DBUSER, $this->DBPASS, true, 199608);
		if (!$this->dbid OR !mysql_select_db($this->DBNAME, $this->dbid)) {
			if (DEBUGMODE) $this->dberror(mysql_error(), mysql_errno());
			exit;
		}
        
		$this->q("set session character_set_server=utf8;");
		$this->q("set session character_set_database=utf8;");
		$this->q("set session character_set_client=utf8;");
		$this->q("set session character_set_connection=utf8;");
		$this->q("set session character_set_results=utf8;");
        
	}
	
	function dbnum($show=false) {
		static $qnum=0;
		if (false !== $show) return $qnum;
		$qnum++;
	}
	
	function q($query) {
		
		$this->mysql['affected_rows'] = null;
		$this->mysql['sql'] .= $query."\n";		
		$this->mysql['err'] = "";
		
		if (!$this->dbid) $this->dbconnect();
		$result = mysql_query($query, $this->dbid);
		
		$this->mysql['affected_rows'] = mysql_affected_rows();
		$this->mysql['insert_id'] = $this->insert_id();
		
		if (!$result)
		{
			$this->mysql['err'] .= "\n" . mysql_errno() . " => " . mysql_error();
			$result = false;
		}
		$this->dbnum();
		return $result;
	}
	
	function numrows($result) {
		return mysql_num_rows($result);
	}
	
	function fetch($q) {
		return mysql_fetch_assoc($q);
	}
	
	function row($query,$mode='assoc') {
		$row = array();
		if ($q = $this->q($query)) {
			$F = 'mysql_fetch_'.$mode;
			$row = $F($q);
			mysql_free_result($q);
		}
		return $row;
	}
	
	function rows($query, $setkey=false, $group=false, $subkeys=false) {
		$rows = array();
		if ($q = $this->q($query)) {
			if (false !== $setkey) {
				if (false !== $group) {
					if (false !== $subkeys)
						while ($row = mysql_fetch_assoc($q)) $rows[$row[$setkey]][$row[$subkeys]] = $row;
					else
						while ($row = mysql_fetch_assoc($q)) $rows[$row[$setkey]][] = $row;
				} else
					while ($row = mysql_fetch_assoc($q)) $rows[$row[$setkey]] = $row;
			} else
				while ($row = mysql_fetch_assoc($q))
					$rows[] = $row;
			mysql_free_result($q);
		}
		return $rows;
	}
	
	function select($table,$what='*',$where='',$limit='') {
		$q = 'SELECT '.$what.' FROM `'.$table.'`'.($where ? ' WHERE '.$where : '');
		return $this->row($q);
	}
	
	function selects($table,$what='*',$where='',$limit='') {
		$q = 'SELECT '.$what.' FROM `'.$table.'`'.($where ? ' WHERE '.$where : '');
		return $this->rows($q);
	}
	
	function sel($input,$one=false) {
		$q = array('SELECT');
		$q[] = !empty($input['what']) ? $input['what'] : '*';
		if (is_array($input['from'])) {
			$from = array();
			foreach ($input['from'] as $v)
				$from[] = $v.' as '.$v[0];
			$q[] = 'FROM '.implode(', ', $from);
		} else {
			$q[] = 'FROM '.$input['from'];
		}
		if (!empty($input['where'])) {
			if (is_array($input['where'])) {
				$z = array();
				foreach ($input['where'] as $k=>$v)
					$z[] = $this->esc(stripslashes($k))."='".$this->esc(stripslashes($v))."'";
				$q[] = 'WHERE '.implode(' AND ',$z);
			} else {
				$q[] = 'WHERE '.$input['where'];
			}
		}
		if (!empty($input['order'])) $q[] = 'ORDER BY '.$input['order'];
		if (!empty($input['limit'])) $q[] = 'LIMIT '.$input['limit'];
		$F = $one ? 'row' : 'rows';
		if (is_array($input['from'])) die(implode(' ',$q));
		return $F(implode(' ',$q));
	}
	
	function insert($table, $values) {
		foreach ($values as $k=>$v)
			$values[$k] = $this->esc(stripslashes(trim($values[$k])));
		$this->q("INSERT INTO `".$this->esc(stripslashes($table))."` (`".implode('`,`',array_keys($values))."`) VALUES ('".implode("','",$values)."')");
		return $this->insert_id();
	}
	
	function update($table, $where, $values) {
		$q = "UPDATE `".$this->esc(stripslashes($table))."` SET ";
		$z = array();
		foreach ($values as $k=>$v)
			$z[] = $this->esc(stripslashes($k))."='".$this->esc(stripslashes(trim($v)))."'";
		$q .= implode(', ',$z);
		$q .= ' WHERE ';
		$z = array();
		foreach ($where as $k=>$v)
			$z[] = $this->esc(stripslashes($k))."='".$this->esc(stripslashes($v))."'";
		$q .= implode(' AND ',$z);
		return $this->q($q);
	}
	
	function sql_delete($table, $where) {
		$q = "DELETE FROM `".$this->esc($table)."` WHERE ";
		$z = array();
		foreach ($where as $k=>$v)
			$z[] = $this->esc(stripslashes($k))."='".$this->esc(stripslashes($v))."'";
		$q .= implode(' AND ',$z);
		return $this->q($q) ? true : false;
	}
	
	function insert_id() {
		return mysql_insert_id($this->dbid);
	}
	
	function freeresult($q) {
		if ($q) mysql_free_result($q);
	}
	
	function get_result_fields($result) {
		$fields = array();
		while ($field = mysql_fetch_field($result))
			$fields[] = $field;
		return $fields;
	}
	
	function fields($table) {
		$names = array();
		$fields = mysql_list_fields($this->DBNAME, $table, $this->dbid);
		$columns = mysql_num_fields($fields);
		for ($i = 0; $i < $columns; $i++)
		    $names[] = mysql_field_name($fields, $i);
		mysql_free_result($fields);
		return $names;
	}
	
	function dbclose() {
		if ($this->dbid) mysql_close($this->dbid);
	}
	
	function dberror($error, $error_num, $query = '') {
		$query = preg_replace('#([0-9a-f]){32}#', '********************************', $query);
		//include 'templates/messages/db_error.html';
		exit;
	}
	
	function esc($str) {
		return mysql_escape_string($str);
	}
	
	function i($str) {
		return intval($str);
	}
	
	function get_data($proc, $p)
	{
		$out[] = array(
			'proc' => $proc,
			'p' => $p
		) ;
		$res = $this->call_sp($out);
		//foreach($res[0] as $k => $rr) $res[0][$k]['total_count'] = $res[1][0]['num_rows'];
		$r = $res[0];
		
		return $r;
	}

	function get_ip()
    {
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))
	    {
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	    {
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
		$ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
    } 



}
?>