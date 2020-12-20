<!-- footer content -->
<footer>
  <div class="pull-right">
	Designed and Maintained by  <a style="color:#6D5429" href="http://www.design-master.com/">Design Master</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
  </div>
</div>

<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="vendors/Flot/jquery.flot.js"></script>
<script src="vendors/Flot/jquery.flot.pie.js"></script>
<script src="vendors/Flot/jquery.flot.time.js"></script>
<script src="vendors/Flot/jquery.flot.stack.js"></script>
<script src="vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS 
<script src="vendors/DateJS/build/date.js"></script>-->
<!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
<!-- JQVMap -->
<script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>

<!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
	

	<!-- Custom Theme Scripts -->
	<script src="build/js/custom.min.js"></script>

	<!-- /gauge.js -->
	<!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
  $(document).ready(function(){
	var options = {
	  legend: false,
	  responsive: false
	};

	new Chart(document.getElementById("canvas1"), {
	  type: 'doughnut',
	  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
	  data: {
		labels: [		  
		  "Successful Orders",		 
		  "Failed Orders",		  
		],
		datasets: [{
		  data: [<?php echo $ressuc; ?>, <?php echo $faillres; ?>],
		  backgroundColor: [			
			"#9B59B6",
			"#3498DB",			
		  ],
		  hoverBackgroundColor: [			
			"#B370CF",	
			"#49A9EA",				
		  ]
		}]
	  },
	  options: options
	});
  });
</script>
<!-- /Doughnut Chart -->

<!-- Flot -->
<script>
  $(document).ready(function() {
	var data1 = [	
	  <?php
	  $year = date('Y');
	  $month = date(m);
	  $noofdays = date('t');
	  for($days=1;$days<=$noofdays;$days++){
			$startnowdate = date("$year-$month-$days 00:00:00");
			$endnowdate = date("$year-$month-$days 23:59:59");

			$banner_que = "SELECT count(*) as prodcount from code8_cartproducts where status=2 date BETWEEN '$startnowdate' AND '$endnowdate' GROUP BY orderid";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($banner_que);  
			$stmt1->execute();
			$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
			$ressuc = $stmt1->rowCount();			
	  ?>
		[gd(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $days; ?>), <?php echo $ressuc; ?>],
	  <?php } ?> 
	];	
	$("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
	  data1
	], {
	  series: {
		lines: {
		  show: false,
		  fill: true
		},
		splines: {
		  show: true,
		  tension: 0.4,
		  lineWidth: 1,
		  fill: 0.4
		},
		points: {
		  radius: 0,
		  show: true
		},
		shadowSize: 2
	  },
	  grid: {
		verticalLines: true,
		hoverable: true,
		clickable: true,
		tickColor: "#d5d5d5",
		borderWidth: 1,
		color: '#fff'
	  },
	  colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
	  xaxis: {
		tickColor: "rgba(51, 51, 51, 0.06)",
		mode: "time",
		tickSize: [7, "day"],
		//tickLength: 10,
		axisLabel: "Date",
		axisLabelUseCanvas: true,
		axisLabelFontSizePixels: 12,
		axisLabelFontFamily: 'Verdana, Arial',
		axisLabelPadding: 10
	  },
	  yaxis: {
		ticks: 20,
		tickColor: "rgba(51, 51, 51, 0.06)",
	  },
	  tooltip: true
	});

	function gd(year, month, day) {
	  return new Date(year, month - 1, day).getTime();
	}
  });
</script>
<script>
      $(document).ready(function() {
        //random data
        var d1 = [
          
		  <?php
		  $year = date('Y');
		  $month = date('m');
		  $noofdays = date('t');
		  for($days=1;$days<=$noofdays;$days++){
			$startnowdate = date("$year-$month-$days 00:00:00");
			$endnowdate = date("$year-$month-$days 23:59:59");

			$banner_que = "SELECT * from code8_customers where registereddate BETWEEN '$startnowdate' AND '$endnowdate'";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($banner_que);  
			$stmt1->execute();
			$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
			$ressuc = $stmt1->rowCount();			
		 ?>
			[<?php echo $days; ?>, <?php echo $ressuc; ?>],
			<?php } ?>	  
        ];

        //flot options
        var options = {
          series: {
            curvedLines: {
              apply: true,
              active: true,
              monotonicFit: true
            }
          },
          colors: ["#26B99A"],
          grid: {
            borderWidth: {
              top: 0,
              right: 0,
              bottom: 1,
              left: 1
            },
            borderColor: {
              bottom: "#7F8790",
              left: "#7F8790"
            }
          }
        };
        var plot = $.plot($("#placeholder3xx3"), [{
          label: "Registrations",
          data: d1,
          lines: {
            fillColor: "rgba(150, 202, 89, 0.12)"
          }, //#96CA59 rgba(150, 202, 89, 0.42)
          points: {
            fillColor: "#fff"
          }
        }], options);
      });
    </script>
</body>
</html>
