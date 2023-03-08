<?= $this->extend('layouts/admin')?>
<?= $this->section('title')?>
PETUGAS
<?= $this->endSection()?>
<?= $this->section('content')?>

            <div class="col">
                <div class="card-header bg-gradient-info">
                    <a href="#" data-petugas="" class="btn btn-outline-warning" data-target="#modalPetugas" data-toggle="modal"><i class="fas fa-fw fa-solid fa-user-plus"></i>Petugas Baru</a>
                </div>

                <div class="card-body">
                
                    <table class="table table-bordered table-striped" id="petugas">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Telephone</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 0;
                        foreach ($petugas as $row){
                            $no++;
                            $data=$row['nama_petugas'].",".$row['username'].",".$row['telp'].",".$row['level'].",".base_url('petugas/edit/'.$row['id_petugas']);
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama_petugas']?></td>
                            <td><?= $row['username']?></td>
                            <td><?= $row['telp']?></td>
                            <td><?= $row['level']?></td>
                            <td>
                                <a href="" data-petugas="<?=$data?>" data-target="#modalPetugas" data-toggle="modal" class="btn btn-success"><i class="fas fa-edit"></i>Edit</a>
                                <a href="<?= base_url('petugas/delete/'.$row['id_petugas'])?>" onclick="return confirm('yakin mau hapus ?')" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <?php if (!empty(session()->getFlashdata("message"))) : ?>
        <div class="alert-success">
        <?= session()->getFlashdata("message")?>
        </div>
        <?php endif ?>
            </div>
        

<div class="modal fade" id="modalPetugas" tabindex="-1" aria-labelledby="modalPetugasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmPetugas" action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_petugas">Nama Petugas</label>
                        <input type="text" name="nama_petugas" class="form-control" id="nama_petugas">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="telp">Telephone</label>
                        <input type="text" name="telp" class="form-control" id="telp">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select type="text" name="level" class="form-control" id="level" class="form-control" required>
                            <option value="">== Pilih Level ==</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                    <div class="form-group" id="ubahpassword">
                        <label for="harga">Ubah Password</label>
                        <input type="checkbox" name="ubahpassword" aria-label="Mau Ubah Password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->Section("script")?>
        <script>
        $(document).ready(function(){
                $("#modalPetugas").on('show.bs.modal',function(e){
                var button = $(e.relatedTarget);
                var data = button.data('petugas');
                if(data != ""){
                        const barisdata = data.split(",");
                        $('#nama_petugas').val(barisdata[0]);
                        $('#username').val(barisdata[1]);
                        $('#telp').val(barisdata[2]);
                        $('#level').val(barisdata[3]);
                        $('#frmPetugas').attr('action',barisdata[4]);
                        $('ubahpassword').show();
                }else{
                        $('#nama_petugas').val("");
                        $('#username').val("");
                        $('#telp').val("");
                        $('#level').val("");
                        $('#frmPetugas').attr('action','/spetugas');
                        $('ubahpassword').hide();
                }
        });

        $('#petugas').DataTable();
        
        });
        </script>
<?= $this->endSection()?>