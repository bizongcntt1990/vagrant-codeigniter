
<script type="text/javascript">
	$(function() {
		$('#graphic1').highcharts({
			chart : {
				type : 'line'
			},
			title : {
				text : '正しい答えのパーセント'
			},
			
			xAxis : {
				categories : ['0-10', '10-20', '20-30', '30-40', '40-50', '50-60', '60-70', '70-80', '80-90','90-100',]			    
			},
			yAxis : {
				title : {
					text : '人数'
				}
			},
			tooltip : {
				enabled : false,
				formatter : function() {
					return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y + '人';
				}
			},
			plotOptions : {
				line : {
					dataLabels : {
						enabled : true
					},
					enableMouseTracking : false
				}
			},
			series : [{
				name : '正しい答えのパーセントの人数',
				data : [<?php echo $x; ?>]
			}]
		});
	});

</script>
	<script src="<?php echo base_url()?>public/images/exporting.js"></script>
	<script src="<?php echo base_url()?>public/images/highcharts.js"></script>
	<div id="graphic1" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

