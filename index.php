<?php
	function isequal($x, $y, $returnstr = "selected"){
		if(isset($_POST["$x"])){
			return ($x==$y?$returnstr:"");
		}else{
			return "";
		}
	}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Chart Demo - With GChart</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/start/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css" />
        <script>
		$(function() {
			$( "#accordion" ).accordion({
				heightStyle: "content",
				collapsible: true
			});
			$( ".spinner" ).spinner();
			$( ".jbtn" ).button();
			$( document ).tooltip();
		});
        </script>
        <style>
body {
    font-family: "Trebuchet MS","Helvetica","Arial","Verdana","sans-serif";
    font-size: 62.5%;
}

#maincont {
    margin: 20px auto;
    max-width: 1200px;
}
dt {
    float: left;
    margin-bottom: 10px;
    width: 150px;
}
dd{
	margin-bottom: 10px;
}
		
		</style>
    </head>
    <body>
    
    	<div id="maincont">
            <div id="accordion">
            
               <?php if(isset($_POST["chart_type"])){ ?>
                <h3>The Chart</h3>
                <div>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              
              <?php
                include("class.gxdata.php");
                $gxdata = new gxdata();
                if(strstr($_POST["chart_type"],"2") != false){
                    echo $gxdata->getData2();
                }else{
                    echo $gxdata->getData1();
                }
                
              ?>
              
            ]);
    
            var options = {
              title: 'Your Graph',
              height:	<?=(isset($_POST["width"])?$_POST["width"]:650)?>,
              width:	<?=(isset($_POST["height"])?$_POST["height"]:1100)?>
            };
    
            var chart = new google.visualization.<?=(strstr($_POST["chart_type"],"bar") != false?"BarChart":"LineChart")?>(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>
        <div id="chart_div" style="width: <?=(isset($_POST["height"])?$_POST["height"]:1100)?>px; height: <?=(isset($_POST["width"])?$_POST["width"]:650)?>px; margin-left:auto; margin-right:auto"></div>
                </div>
                
                <?php } ?>
            
            
                <h3>Chart Options</h3>
                <div>
                    <form method="post">
                        <dl>
                          <dt>Chart Type</dt>
                            <dd>
                                <select name="chart_type" id="chart_type" title="Select the type of graph you wish to see.">
                                    <optgroup label="Line Graph">
                                        <option value="line1" <?=isequal("chart_type","line1")?>>Line Graph 1</option>
                                        <option value="line2" <?=isequal("chart_type","line2")?>>Line Graph 2 (Data Turned)</option>
                                    </optgroup>
                                    <optgroup label="Bar Graph">
                                        <option value="bar1" <?=isequal("chart_type","bar1")?>>Bar Graph 1</option>
                                        <option value="bar2" <?=isequal("chart_type","bar2")?>>Bar Graph 2 (Data Turned)</option>
                                    </optgroup>
                                </select>
                            </dd>
                            
                          <dt>Height</dt>
                            <dd>
                            	<input type="text" name="height" value="<?=(isset($_POST["height"])?$_POST["height"]:1100)?>" class="spinner" title="Height of chart">
                            </dd>
                          <dt>Width</dt>
                            <dd><input type="text" name="width" value="<?=(isset($_POST["width"])?$_POST["width"]:650)?>" class="spinner" title="Width of chart"></dd>  
                          <dt>Print</dt>
                            <dd><input type="checkbox" name="do_print" id="do_print" class="jbtn" value="1" <?=(isset($_POST["do_print"])?"checked":"")?>><label for="do_print" title="Select if you want to print the generated chart">Toggle</label></dd>  
                          
                          <dt></dt>
                            <dd><input type="submit" value="Generate Chart" class="jbtn"></dd>
                        </dl> 
                    </form>
                </div>
                
            </div>
        
        </div>
        <?php if(isset($_POST["do_print"])){ ?>
        <script>
			javascript:window.print()
		</script>
        <?php } ?>
	</body>
</html>