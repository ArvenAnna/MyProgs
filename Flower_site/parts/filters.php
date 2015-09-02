<div class="ss">
<form action=<?php echo $form_action;?> name="filters" >


<input type="text" id="minCost" required pattern="^[ 0-9]+$" name="min_cost" value=<?php if ($_REQUEST['filter']) {echo $_REQUEST['min_cost'];} else echo 20;?>></input>
	<input type="text" id="maxCost" required pattern="^[ 0-9]+$" name="max_cost" value=<?php if ($_REQUEST['filter']) {echo $_REQUEST['max_cost'];} else echo 300;?>></input>
	<div id="slider"></div>
	<input type="submit" name="filter"/>

</form>
</div>
<style>
.ss{margin:10px;}
</style>

<script>

$( "#slider" ).slider({
	range: true,
	min: 20,
	max: 300,
	values: [20,300],
	stop: function(event, ui) {
	        jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
	        jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));
	    },
	    slide: function(event, ui){
	        jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
	        jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));
	    }
});

$(document).ready(function() {
	var value1=jQuery("input#minCost").val();
	var value2=jQuery("input#maxCost").val();
	jQuery("#slider").slider("values",0,value1); 
	jQuery("#slider").slider("values",1,value2); 
});


jQuery("input#minCost").change(function(){
	    var value1=jQuery("input#minCost").val();
	    var value2=jQuery("input#maxCost").val();
		
		if (value1 < 20) { value1 = 20; jQuery("input#minCost").val(20)}
	 
	    if(parseInt(value1) > parseInt(value2)){
	        value1 = value2;
	        jQuery("input#minCost").val(value1);
	    }
	    jQuery("#slider").slider("values",0,value1); 
	});
	
jQuery("input#maxCost").change(function(){
	    var value1=jQuery("input#minCost").val();
	    var value2=jQuery("input#maxCost").val();
	     
	    if (value2 > 300) { value2 = 300; jQuery("input#maxCost").val(300)}
	 
	    if(parseInt(value1) > parseInt(value2)){
	        value2 = value1;
	        jQuery("input#maxCost").val(value2);
	    }
	    jQuery("#slider").slider("values",1,value2);
	});
</script>
