<!DOCTYPE html>
<html>
<head>
	<title>Ajax KompiKaleng</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</head>
<body style="margin: 20px;">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<b class="col-md-10">CRUD Ajax Codeigniter KompiKaleng</b>
			<center><button data-toggle="modal" data-target="#addModal" class="btn btn-success">Tambah Data</button></center>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>No.induk</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Hobi</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tbl_data">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

	<!-- Modal Tambah-->
	<div id="addModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Tambah Data</h4>
	      </div>
	      <div class="modal-body">
	        <form>
	        	<div class="form-group">
	        		<label for="noinduk">No.Induk</label>
	        		<input type="text" name="noinduk" class="form-control"></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="nama">Nama</label>
	        		<input type="text" name="nama" class="form-control"></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="alamat">Alamat</label>
	        		<input type="text" name="alamat" class="form-control"></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="hobi">Hobi</label>
	        		<input type="text" name="hobi" class="form-control"></input>
	        	</div>

	        </form>
	      </div>
	      <div class="modal-footer">
	       <button type="button" class="btn btn-success" id="btn_add_data">Simpan</button>
	       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal Edit-->
	<div id="editModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Data</h4>
	      </div>
	      <div class="modal-body">
	        <form>
	        	<div class="form-group">
	        		<label for="noinduk">No.Induk</label>
	        		<input type="text" name="noinduk_edit" class="form-control"></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="nama">Nama</label>
	        		<input type="text" name="nama_edit" class="form-control"></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="alamat">Alamat</label>
	        		<input type="text" name="alamat_edit" class="form-control"></input>
	        	</div>
	        	<div class="form-group">
	        		<label for="hobi">Hobi</label>
	        		<input type="text" name="hobi_edit" class="form-control"></input>
	        	</div>

	        </form>
	      </div>
	      <div class="modal-footer">
	       <button type="button" class="btn btn-success" id="btn_update_data">Update</button>
	       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

</html>
<script type="text/javascript">
	$(document).ready(function(){
		tampil_data();
		//Menampilkan Data di tabel
		function tampil_data(){
			$.ajax({
				url: '<?php echo base_url(); ?>C_Index/ambilData',
				type: 'POST',
				dataType: 'json',
				success: function(response){
					console.log(response);
					var i;
					var no = 0;
					var html = "";
					for(i=0;i < response.length ; i++){
						no++;
						html = html + '<tr>'
									+ '<td>' + no  + '</td>'
									+ '<td>' + response[i].noinduk  + '</td>'
									+ '<td>' + response[i].nama  + '</td>'
									+ '<td>' + response[i].alamat  + '</td>'
									+ '<td>' + response[i].hobi  + '</td>'
									+ '<td style="width: 16.66%;">' + '<span><button data-id="'+response[i].noinduk+'" class="btn btn-primary btn_edit">Edit</button><button style="margin-left: 5px;" data-id="'+response[i].noinduk+'" class="btn btn-danger btn_hapus">Hapus</button></span>'  + '</td>'
									+ '</tr>';
					}
					$("#tbl_data").html(html);
				}

			});
		}
		//Hapus Data dengan konfirmasi
		$("#tbl_data").on('click','.btn_hapus',function(){
			var noinduk = $(this).attr('data-id');
			var status = confirm('Yakin ingin menghapus?');
			if(status){
				$.ajax({
					url: '<?php echo base_url(); ?>C_Index/hapusData',
					type: 'POST',
					data: {noinduk:noinduk},
					success: function(response){
						tampil_data();
					}
				})
			}
		})
		//Menambahkan Data ke database
		$("#btn_add_data").on('click',function(){
			var noinduk = $('input[name="noinduk"]').val();
			var nama = $('input[name="nama"]').val();
			var alamat = $('input[name="alamat"]').val();
			var hobi = $('input[name="hobi"]').val();
			$.ajax({
				url: '<?php echo base_url(); ?>C_Index/tambahData',
				type: 'POST',
				data: {noinduk:noinduk,nama:nama,alamat:alamat,hobi:hobi},
				success: function(response){
					$('input[name="noinduk"]').val("");
					$('input[name="nama"]').val("");
					$('input[name="alamat"]').val("");
					$('input[name="hobi"]').val("");
					$("#addModal").modal('hide');
					tampil_data();
				}
			})

		});
		//Memunculkan modal edit
		$("#tbl_data").on('click','.btn_edit',function(){
			var noinduk = $(this).attr('data-id');
			$.ajax({
				url: '<?php echo base_url(); ?>C_Index/ambilDataByNoinduk',
				type: 'POST',
				data: {noinduk:noinduk},
				dataType: 'json',
				success: function(response){
					console.log(response);
					$("#editModal").modal('show');
					$('input[name="noinduk_edit"]').val(response[0].noinduk);
					$('input[name="nama_edit"]').val(response[0].nama);
					$('input[name="alamat_edit"]').val(response[0].alamat);
					$('input[name="hobi_edit"]').val(response[0].hobi);
				}
			})
		});

		//Meng-Update Data
		$("#btn_update_data").on('click',function(){
			var noinduk = $('input[name="noinduk_edit"]').val();
			var nama = $('input[name="nama_edit"]').val();
			var alamat = $('input[name="alamat_edit"]').val();
			var hobi = $('input[name="hobi_edit"]').val();
			$.ajax({
				url: '<?php echo base_url(); ?>C_Index/perbaruiData',
				type: 'POST',
				data: {noinduk:noinduk,nama:nama,alamat:alamat,hobi:hobi},
				success: function(response){
					$('input[name="noinduk_edit"]').val("");
					$('input[name="nama_edit"]').val("");
					$('input[name="alamat_edit"]').val("");
					$('input[name="hobi_edit"]').val("");
					$("#editModal").modal('hide');
					tampil_data();
				}
			})

		});
	});
</script>