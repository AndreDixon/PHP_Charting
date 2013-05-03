
<?php
class gxdata {
    private $chart_type;
    private $out_data;
	private $xlsx;

	function __construct($xlfile = "line.xlsx"){   
		include 'simplexlsx.class.php';
		$this->xlsx = new SimpleXLSX($xlfile);
    }  

    public function getChartType() {
        return $this->chart_type;
    }
    public function setChartType($chartType) {
        $this->chart_type = $chartType;
    }


    public function getData1() {
		$xdata = $this->xlsx->rows();
		$this->out_data = "";
		for($xc = 0; $xc < count($xdata[0]); $xc++){	//Looping the columns
			$line = "";
			
			if(!isset($xdata[0][$xc]) || strlen($xdata[0][$xc]) <= 1){
			
			}else{
				$this->out_data .= "\n\n\t[";
				for($xr = 0; $xr < count($xdata); $xr++){	//Looping through rows
						$xcell = (isset($xdata[$xr][$xc])?$xdata[$xr][$xc]:0);
						
						if(strlen($xcell) > 0){
							if(is_numeric($xcell)){
								$line .= $xcell.",";
							}else{
								$line .= "'".$xcell."',";
							}
							
						}else{
							$line .=  "0,";
						}	
				}
				$this->out_data .= substr($line, 0, -1);
				$this->out_data .=  "],";	
			}
		}
		return $this->out_data;
    }
	
	
	//
	public function getData2(){
		foreach($this->xlsx->rows() as $xrow){
			
			$this->out_data .=  "\n\t[";
			$line = "";
			for($x = 0; $x < count($xrow); $x++){
				
				if($x != (count($xrow) - 1)){
					if(strlen($xrow[$x]) > 0){
						if(is_numeric($xrow[$x])){
							$line .= $xrow[$x].",";
						}else{
							$line .= "'".$xrow[$x]."',";
						}
						
					}else{
						$line .=  "0,";
					}		
				}
			}
			$this->out_data .=  substr($line, 0, -1);
			$this->out_data .=  "],";
		}
		return $this->out_data;
	}
}
