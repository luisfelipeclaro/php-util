<?php
/*
 *	Author: Luis Felipe Claro
 *	Date: 01/12/2014
 *	
 */

class Util {
	var $border_color = "blue";
	var $text_color = "black";

	/* 	FUNCTION TO SHOW DATA DEBUG
	 * 	$data: object to debug
	 * 	$colored: color border and text
	 * 	$die: stops at that point that you use the debug method
	 */
	function d($data, $colored, $die){
		$style = "";
		if($colored === true){
			$style = "style='border:solid ".$this->border_color."; color:".$this->text_color."'";
		}
                print "<div style='
                            position: static;
                            top: 0;
                            left: 0;
                            z-index: 999;
                            width: 100%;
                            font-size: 15px;'>";
		print "<pre $style>";
		print print_r($data, true);
		print "</pre>";
                print "</div>";

		if($die === true){
			die('### End Debug ###');
		}
	}
        
        /* 	FUNCTION TO SHOW DATA DEBUG, HTML COMMENTED
	 * 	$data: object to debug
	 */
	function dc($data){
                print "<!--\n###### [DEBUG] ######\n\n";
                if( !((gettype($data) == 'object') OR (gettype($data) == 'array')) ){
                        print "\t".strtoupper(gettype($data))."\n";
                }
		print print_r($data, true);
                print "\n\n###### [END DEBUG] ######\n-->";

	}

	/*	DIVERSE ARRAY FOR $_FILES object */
	function diverse_array($data){
		$result = array(); 
	    foreach($vector as $key1 => $value1) {
	        foreach($value1 as $key2 => $value2) {
	            $result[$key2][$key1] = $value2; 
	        }
	    }
	    return $result; 
	}

	/*	FUNCTION TO LIMIT TEXT
	 *	$text: the text
	 *	$limit: (number) limit by caracters
	 */
	function limit_text($text, $limit){
		$text = substr($text, 0, strrpos(substr($text, 0, $limit), ' ')) . ' ...';
    return $text;
	}

	/* FUNCTION TO REMOVE SPECIAL CARACTERS */
	function remove_caracter($text, $underline){
            $text = preg_replace('/[áàãâä]/ui', 'a', $text);
	    $text = preg_replace('/[éèêë]/ui', 'e', $text);
	    $text = preg_replace('/[íìîï]/ui', 'i', $text);
	    $text = preg_replace('/[óòõôö]/ui', 'o', $text);
	    $text = preg_replace('/[úùûü]/ui', 'u', $text);
	    $text = preg_replace('/[ç]/ui', 'c', $text);
	    if($underline === true){
	    	$text = preg_replace('/[^a-z0-9]/i', '_', $text);
	    	$text = preg_replace('/_+/', '_', $text); // ideia do Bacco :)
	    	$text = preg_replace("/ /", "_", $text);
	    }
	    return $text;
	}
        /* 
         * FUNCTION MONTAR ENDERECO 
         * $e = endereco (rua, avenida ...)
         * $n = numero
         * $c = complemento
         * $b = bairro
         * $cdd = cidade
         * $uf = estado
         */
	function montaEndereco($e, $n, $c, $b, $cdd, $uf){
		$endereco = "";
		if($e)	{ 
					$endereco = $e; 
					if($n)	{ $endereco .= ", ".$n; }
					if($c)	{ $endereco .= ", ".$c; }
                                        if($b)	{ $endereco .= ", ".$b; }
				}
		if(!empty($endereco) && $cdd){ $endereco .= ", ".$cdd; }else{ $endereco .= $cdd; }
		if(!empty($endereco) && $uf) { $endereco .= " / ".$uf; }else{ $endereco .= $uf; }
		return $endereco;
	}

	function dateToDays($data){
	
		$xplode = explode(" ", $data);
		$dt = $xplode[0];
		$tm = $xplode[1];
	
		$dt = explode("-", $dt);
		$tm = explode(":", $tm);
	
		$days = ($dt[0] * 365) + ($dt[1] * 30) + ($dt[2]);
		// $days += ($tm[0] * 24) + ($dt[1] * 60*24) + ($dt[2] * 100*60*24);
	
		return $days;
	}
        
        
        /*	FUNCTION TO CREATE URL TAGS
	 *	$text: the text
         *      text example: Luís Felipe Claro
         *      return: luis-felipe-claro
	 */
        function url($text){
            $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', '?', '?', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', '?', '?', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', '?', 'Z', 'z', 'Z', 'z', '?', '?', '?', '?', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?'); 
            $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');

            $text = str_replace($a, $b, $text);

            $text = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), $text));

            return $text;
        }
        
        /*	FUNCTION TO CREATE URL TAGS MUCH LIKE REPLACE SPECIAL CHARACTERS
	 *	$text: the text
         *      text example: Luís Felipe Claro
         *      return: luis felipe claro
	 */
        function url2($text){
            $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', '?', '?', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', '?', '?', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', '?', 'Z', 'z', 'Z', 'z', '?', '?', '?', '?', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?'); 
            $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');

            $text = str_replace($a, $b, $text);

            $text = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', ' ', ''), $text));

            return $text;
        }

        /*	FUNCTION TO VALIDATE E-MAIL
        *	$email: the e-mail
        *	return: boolean TRUE / false -> string $msg
        */
        public function validateEmail($email)
        {
        	if( ! ereg( '^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})', $email ) )
        	{
        		$msg = 'E-mail inálido.';
        	}
        	else
        	{
        		$dominio = explode( '@', $email );
        		if( ! checkdnsrr( $dominio[1], 'A' ) )
        		{
        			$msg = 'E-mail inválido.';
        			return $msg;
        		}
        		else
        		{
        			return TRUE;
        		}
        	}
        }


}