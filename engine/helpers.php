<?php
/**
 * Clase Helpers. Métodos de ayuda.
 * @author Luismi
 *
 */
class Helpers {
	/**
		Conversión del metadata de datos a un array convencional para facilitarnos el trabajo.
	**/
	public static function fetcharray($result)
	{   
		$array = array();
	   
		if($result instanceof mysqli_stmt)
		{
			$result->store_result();
		   
			$variables = array();
			$data = array();
			$meta = $result->result_metadata();
		   
			while($field = $meta->fetch_field())
				$variables[] = &$data[$field->name];
		   
			call_user_func_array(array($result, 'bind_result'), $variables);
		   
			$i=0;
			while($result->fetch())
			{
				$array[$i] = array();
				foreach($data as $k=>$v)
					$array[$i][$k] =  $v;	
				$i++;
			}
		}
		elseif($result instanceof mysqli_result)
		{
			while($row = $result->fetch_assoc())
				$array[] = $row;
		}
	   
		return $array;
	}
}
?>