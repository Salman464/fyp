<footer class="footer">
	GIFT University Services Department
</footer>
</div>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/dashboard1.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/footable/js/footable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/adminjq.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/tablesaw/dist/tablesaw.jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/tablesaw/dist/tablesaw-init.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

<script>
	$(function() {
		$('#allComplaintsTable').DataTable();
		$('#myTable').DataTable();
		$('#pendingComplaints').DataTable();
		$('#processingComplaints').DataTable();
		$('#productWaitingComplaints').DataTable();
		$('#resolveComplaints').DataTable();
		$('#rejectComplaints').DataTable();
	});

	function validationSignUp() {

		isValid = true;
		let email = document.getElementById('mail').value;
		let mailErr = document.getElementById('mailErr');

		if (!email.endsWith("@gift.edu.pk")) {
			isValid = false;
			mailErr1.style.display = "block";
		}

		return isValid;

	}
</script>
</body>

</html>