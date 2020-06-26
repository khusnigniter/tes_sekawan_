<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?=$title;?></title>

	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/style.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/jquery.dataTables.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/dataTables.bootstrap4.css');?>">

</head>
<body>
<div class="container my-5">
	<div class="row">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><a href="javascript:void(0);" data-toggle="modal" data-target="#addEmpModal" class="btn btn-success">Tambah</a>&nbsp;<a href="#" class="btn btn-dark float-right">Refresh</a></div>
			</div>
			<div class="card-body table-responsive">
				<table class="table table-striped" id="employeeListing">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Reg</th>
							<th>Nama Pegawai</th>
							<th>Gaji</th>
							<th>Usia</th>
							<th>Foto</th>
						</tr>
					</thead>
					<tbody id="listRecords">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>


<!-- Modal Add -->
<form>
  <div class="modal fade" id="addEmpModal" tabindex="-1" role="dialog" aria-labelledby="addEmpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="addEmpModalLabel">Add New Employee</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-md-2 col-form-label">Name*</label>
          <div class="col-md-10">
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label">Salary*</label>
          <div class="col-md-10">
            <input type="text" name="salary" id="salary" class="form-control" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label">Age*</label>
          <div class="col-md-10">
            <input type="text" name="age" id="age" class="form-control" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
      </div>
    </div>
    </div>
  </div>
</form>
<!-- End Modal Add -->



<!-- JS Script -->
<script type="text/javascript" src="<?=base_url('assets/js/jquery-3.5.1.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery.dataTables.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/dataTables.bootstrap4.js');?>"></script>

<!-- custom js -->
<script type="text/javascript">
$(document).ready(function(){

  listEmployee();
  var table = $('#employeeListing').dataTable({
    "bPaginate": false,
    "bInfo": false,
    "bFilter": false,
    "bLengthChange": false,
    "pageLength": 5
  });

  function listEmployee(){
    $.ajax({
      type  : 'ajax',
      url   : 'welcome/show',
      async : false,
      dataType : 'json',
      success : function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<tr id="'+data[i].id+'">'+
              '<td>'+data[i].employee_name+'</td>'+
              '<td>'+data[i].employee_salary+'</td>'+
              '<td>'+data[i].employee_age+'</td>'+
              '<td style="text-align:right;">'+
                '<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="'+data[i].id+'" data-name="'+data[i].employee_name+'" data-salary="'+data[i].employee_salary+'" data-age="'+data[i].employee_age+'">Edit</a>'+' '+
                '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="'+data[i].id+'">Delete</a>'+
              '</td>'+
              '</tr>';
        }
        $('#listRecords').html(html);
      }
    });
  }

  // save new employee record
  $('#btn_save').on('click',function(){
    var eName = $('#name').val();
    var eSalary = $('#salary').val();
    var eAge = $('#age').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('welcome/save') ?>",
        dataType : "JSON",
        data : {employee_name:eName, employee_salary:eSalary, employee_age:eAge},
        success: function(data){
          $('[name="name"]').val("");
          $('[name="salary"]').val("");
          $('[name="age"]').val("");
          $('#addEmpModal').modal('hide');
          //reload_table();
          listEmployee();
        }
    });
    return false;
  });

});
</script>
</body>
</html>