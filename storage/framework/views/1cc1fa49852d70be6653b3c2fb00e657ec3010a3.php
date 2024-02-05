<style>
	.passwordChange {
		display: none;
	}
</style>
<footer class="footer hidden-xs-down">
	<p>Copyright © Cryptonoma Exchange. All rights reserved.</p>
</footer>
</section>
</main>

<script src="<?php echo e(url('adminpanel/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('adminpanel/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('adminpanel/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(url('adminpanel/js/app.min.js')); ?>"></script>
<script src="<?php echo e(url('adminpanel/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(url('adminpanel/js/flatpickr.min.js')); ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script> -->

<script src="<?php echo e(url('adminpanel/js/jquery.scrollbar/jquery.scrollbar.min.js')); ?>"></script>

<script src="<?php echo e(url('adminpanel/js/table2excel.js')); ?>"></script>
<!--
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>!-->
<?php echo $__env->yieldPushContent('child-scripts'); ?>
<script>
	$('#loding').hide();

	$(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^0-9\.]/g, ''));
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	$("#proof_upload1").change(function() {
		var limit_size = 1048576;
		var photo_size = this.files[0].size;
		if (photo_size > limit_size) {
			$("#kyc_btn").attr('disabled', true);
			$('#proof_upload1').val('');
			alert('Image Size Larger than 1MB');
		} else {
			$("#proof_upload1").text(this.files[0].name);
			$("#kyc_btn").attr('disabled', false);

			var file = document.getElementById('proof_upload1').value;
			var ext = file.split('.').pop();
			switch (ext) {
				case 'jpg':
				case 'JPG':
				case 'Jpg':
				case 'jpeg':
				case 'JPEG':
				case 'Jpeg':
				case 'png':
				case 'PNG':
				case 'Png':
					readURL8(this);
					break;
				default:
					alert('Upload your proof like JPG, JPEG, PNG');
					break;
			}
		}
	});

	function readURL8(input) {
		var limit_size = 1048576;
		var photo_size = input.files[0].size;
		if (photo_size > limit_size) {
			alert('Image size larger than 1MB');
		} else {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#blah').attr('src', e.target.result);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
	}
	$('.date-picker-1').datepicker({
		format: 'yy-mm-dd'
	});
	$("#proof_upload2").change(function() {
		var limit_size = 1048576;
		var photo_size = this.files[0].size;
		if (photo_size > limit_size) {
			$("#kyc_btn").attr('disabled', true);
			$('#proof_upload2').val('');
			alert('Image Size Larger than 1MB');
		} else {
			$("#proof_upload2").text(this.files[0].name);
			$("#kyc_btn").attr('disabled', false);

			var file = document.getElementById('proof_upload2').value;
			var ext = file.split('.').pop();
			switch (ext) {
				case 'jpg':
				case 'JPG':
				case 'Jpg':
				case 'jpeg':
				case 'JPEG':
				case 'Jpeg':
				case 'png':
				case 'PNG':
				case 'Png':
					readURL7(this);
					break;
				default:
					alert('Upload your proof like JPG, JPEG, PNG');
					break;
			}
		}
	});

	function readURL7(input) {
		var limit_size = 1048576;
		var photo_size = input.files[0].size;
		if (photo_size > limit_size) {
			alert('Image Size Larger than 1MB');
		} else {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#doc3').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
	}

	$('#accountname').on('keypress', function(event) {
		var regex = new RegExp("^[a-zA-Z0-9]+$");
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		if (!regex.test(key)) {
			event.preventDefault();
			return false;
		}
	});
	$(function() {

		$('.adminaddress').keyup(function() {
			var yourInput = $(this).val();
			re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
			var isSplChar = re.test(yourInput);
			if (isSplChar) {
				var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
				$(this).val(no_spl_char);
			}
		});

	});

	/*$('.datepicker4').each(function(e) {
	  e.datepicker({
	    format: 'yy-mm-dd',
	    autoclose: true
	  });
	  $(this).on("click", function() {
	    e.datepicker("show");
	  });
	});
	*/
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 &&
			(charCode < 48 || charCode > 57))
			return false;

		return true;
	}

	$(document).ready(function() {
		//called when key is pressed in text box
		$("#numberonly").keypress(function(e) {
			//if the letter is not digit then display error and don't type anything
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				//display error message
				$("#errmsg").html("Digits Only").show().fadeOut("slow");
				return false;
			}
		});
	});
	$("#reason").on("keydown", function(e) {
		var c = $("#reason").val().length;
		if (c == 0)
			return e.which !== 32;
	});


	$('.date-picker').datepicker({
		format: 'yy-mm-dd'
	});
</script>

<script>
	function readURL1(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#doc1').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#file-upload1").change(function() {
		$("#file-name1").text(this.files[0].name);
		readURL1(this);
	});

	function readURL2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#doc2').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#file-upload2").change(function() {
		$("#file-name2").text(this.files[0].name);
		readURL2(this);
	});
</script>

<script>
	$(document).ready(function() {
		$("#btn_update").click(function() {
			$('#btn_update').hide();
		});
	});
</script>
<script>
	jQuery(document).ready(function($) {


		var type = $('#coin_type :selected').val();


		if (type == 'token') {
			$('#contract').show();
			$('#abi').show();
		} else {
			$('#contract').hide();
			$('#abi').hide();

		}

		$('#coin_type').on('change', function() {

			if (this.value == 'token') {
				$('#contract').show();
				$('#abi').show();
			} else {
				$('#contract').hide();
				$('#abi').hide();

			}
		});
	});
</script>
<script type="text/javascript">
	$("#btnExport").click(function(e) {
		//getting values of current time for generating the file name
		var dt = new Date();
		var day = dt.getDate();
		var month = dt.getMonth() + 1;
		var year = dt.getFullYear();
		var hour = dt.getHours();
		var mins = dt.getMinutes();
		var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
		//creating a temporary HTML link element (they support setting file names)
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel;charset=utf-8';

		var table_html = $('#dvData')[0].outerHTML;
		//    table_html = table_html.replace(/ /g, '%20');
		table_html = table_html.replace(/<tfoot[\s\S.]*tfoot>/gmi, '');

		var css_html =
			'<style>td {border: 0.5pt solid #c0c0c0} .tRight { text-align:right} .tLeft { text-align:left} </style>';
		//    css_html = css_html.replace(/ /g, '%20');

		a.href = data_type + ',' + encodeURIComponent('<html><head>' + css_html + '</' + 'head><body>' +
			table_html + '</body></html>');

		//setting the file name
		a.download = 'Users' + postfix + '.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		e.preventDefault();
	});

	$(function() {
		$('#theform').submit(function() {
			$("input[type='submit']", this)
				.val("Please Wait...")
				.attr('disabled', 'disabled');
			return true;
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('form').attr('autocomplete', 'off');
	});
</script>

<script>
	$(document).ready(function() {
		$('#confirm-enable').one('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		//called when key is pressed in textbox
		$("#price_decimal,#amount_decimal ").keypress(function(e) {
			//if the letter is not digit then display error and don't type anything
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				//display error message
				$("#errmsg").html("Digits Only").show().fadeOut("slow");
				return false;
			}
		});
	});
</script>

</body>

</html>
<?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/layouts/footer.blade.php ENDPATH**/ ?>