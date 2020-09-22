<?php 

class MT103Parser
	{
		private $Message;

		public function __construct($Message)
		{
			$this->Message =  trim(preg_replace('/[\x01\x03]/', '',$Message));
		}

		public function processMessage()
		{
			preg_match_all('/\{[^\{\}]+\}/', $this->Message, $matches);
			$matches = $matches[0];
			$output = [];
			foreach($matches as $match)
			{
				$output  = array_merge_recursive ($output, $this->getNestedComponents($match));	
			}
			return (object) $output;
		}
		function getNestedComponents($tagValuePair)
		{
		$label = str_replace(":","",'T'.substr($tagValuePair,1,strpos($tagValuePair,':')));
		$value = trim(str_replace(["\n","/"],["|"," "],str_replace("\r","", substr($tagValuePair,strpos($tagValuePair,':')+1,-1))));
		if($label == 'T4')
		{
				$value = (object) $this->getT4Components($value);
		}
		return [strtoupper($label) => $value];
		}
		function getT4Components($tag4Value)
		{
			$tag4Fields = explode('|:',$tag4Value);
			$tagArray = [];
			foreach($tag4Fields as $tag4Field)
			{
				$tagArray  = array_merge_recursive ($tagArray, $this->getNonNestedComponents($tag4Field));	
			}
			return $tagArray;
		}
		function getNonNestedComponents($tagValuePair)
		{
			$label = 'T'.substr($tagValuePair,0, strpos($tagValuePair,':'));
			$value = trim(str_replace(["|","/"],[" "," "], substr($tagValuePair,strpos($tagValuePair,':')+1)));
			return [strtoupper($label) => trim($value)];
		}
	}