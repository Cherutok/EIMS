</div>
 </div>
 </div>
 <script>
 	$(document).ready(function () {
 		$('#managerTable').DataTable();
 		$('#employeeTable').DataTable();
 		$('#clientTable').DataTable();
 		$('#projectTable').DataTable();
 	});

 	CKEDITOR.replace('ckeditor');

 	function openNav() {
 		document.getElementById("mySidenav").style.width = "250px";
 		document.getElementById("main").style.marginLeft = "250px";
 	}

 	function closeNav() {
 		document.getElementById("mySidenav").style.width = "0";
 		document.getElementById("main").style.marginLeft = "0";
 	}

 </script>



 <script src="<?php echo base_url(); ?>/public/js/datatables.min.js"></script>
 <script src="<?php echo base_url(); ?>/public/js/jquery-3.2.1.min.js"></script>

 <!-- Bootstrap Core JS -->
 <script src="<?php echo base_url(); ?>/public/js/popper.min.js"></script>
 <script src="<?php echo base_url(); ?>/public/js/bootstrap.min.js"></script>

 <!-- Slimscroll JS -->
 <script src="<?php echo base_url(); ?>/public/js/jquery.slimscroll.min.js"></script>

 <!-- Chart JS -->
 <script src="<?php echo base_url(); ?>/public/plugins/morris/morris.min.js"></script>
 <script src="<?php echo base_url(); ?>/public/plugins/raphael/raphael.min.js"></script>
 <script src="<?php echo base_url(); ?>/public/js/chart.js"></script>

 <!-- Custom JS -->
 <script src="<?php echo base_url(); ?>/public/js/app.js"></script>
 </body>

 </html>
