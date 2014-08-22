<?

class FileInfo
{

	public $fileName ; 
	public $path;  

 	public function __construct($path = '') {

		$path_parts = pathinfo($path);

		$this->fileName = $path_parts['basename'] ; 

		$this->path = $path_parts['dirname'] ;    			
		$this->path=  ltrim($this->path,'/'); // remove leading slashes 

  	}



	

}