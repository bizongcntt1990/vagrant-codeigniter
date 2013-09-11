<script type="text/javascript">
	$(function() {
		$('#graphic2').highcharts({
			chart : {
				type : 'column'
			},
			title : {
				text : '同じ答えを選ぶ人数'
			},
			
			xAxis : {
				categories : [<?php echo $x;?>]
			},
			yAxis : {
				min : 0,
				title : {
					text : '人数'
				}
			},
			tooltip : {
				headerFormat : '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat : '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
				footerFormat : '</table>',
				shared : true,
				useHTML : true
			},
			plotOptions : {
				column : {
					pointPadding : 0.2,
					borderWidth : 0
				}
			},
			series : [{
				name : '答え１',
				data : [<?php echo $x1; ?>]

			}, {
				name : '答え２',
				data : [<?php echo $x2; ?>]

			}, {
				name : '答え3',
				data : [<?php echo $x3; ?>]

			}, {
				name : '答え4',
				data : [<?php echo $x4; ?>]

			}]
		});
	});

</script>

<script src="<?php echo base_url()?>public/images/exporting.js"></script>
<script src="<?php echo base_url()?>public/images/highcharts.js"></script>
<div id="graphic2" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

