<?php
	/*
	 * class key used for creating keys
	 */
	require_once 'connection.php';

	class Keys{
		private $allowedCharacters;
		private $subLength;
		private $separator;
		private $subLengthCount;
		public $key;

		public function __construct(){
			$settings               =(new Connection())->getSettings();
			$this->allowedCharacters=$settings['allowed_characters'];
			$this->subLength        =$settings['sub_length'];
			$this->separator        =$settings['separator'];
			$this->subLengthCount   =$settings['sub_length_count'];
			$this->key              =$this->_generateKey();

			return $this->key;
		}

		function __toString(){
			return $this->key;
		}

		private function _generateKey(){
			$key=[];
			for($i=0;$i<$this->subLengthCount;$i++){
				$key[]=$this->_generateRandomSubString();
			}

			return implode($this->separator,$key);
		}

		private function _generateRandomSubString(){
			$charactersLength=strlen($this->allowedCharacters);
			$randomString    ='';
			for($i=0;$i<$this->subLength;$i++){
				$randomString.=$this->allowedCharacters[ rand(0,$charactersLength-1) ];
			}

			return $randomString;
		}
	}
?>
