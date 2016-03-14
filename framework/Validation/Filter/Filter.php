<?php
namespace Framework\Validation\Filter;
/**    
 * ValidationFilterInterface.php
 */

class Filter implements ValidationFilterInterface {
	public function isValid($value){
		return true;
	}
} 
