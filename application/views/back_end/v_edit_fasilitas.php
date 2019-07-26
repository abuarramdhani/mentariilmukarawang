<?php 
    foreach ($data_fasilitas->result() as $_fasilitas) {
        $id_fasilitas = $_fasilitas->id_fasilitas;
        $nama_fasilitas = $_fasilitas->nama_fasilitas;
        $id_sekolah = $_fasilitas->id_sekolah;
        $gambar_lama = $_fasilitas->value;
    }
?>
 <div class="row">
                    <!-- Left sidebar -->
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
                                    <form enctype="multipart/form-data" action="<?php echo base_url() ?>Fasilitas/edit" method="post" class="form-horizontal row-fluid">
                                        <h3 class="box-title">Edit Fasilitas</h3>
                                        <div class="form-group">                                            
                                            <label for="exampleInputEmail1">Sekolah</label>
                                            <select class="form-control" name="id_sekolah">
                                    <?php                                     
                                    foreach ($data_sekolah->result() as $_sekolah) { ?>
                                                <option value="<?php echo $_sekolah->id_sekolah ?>" <?php if($_sekolah->id_sekolah == $id_sekolah){echo" selected";} ?>><?php echo $_sekolah->nama ?></option>
                                    <?php 
                                    } 
                                    ?> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Fasilitas</label>
                                            <input class="form-control" name="nama_fasilitas" value="<?php echo $nama_fasilitas ?>" required oninvalid="this.setCustomValidity('Judul tidak boleh kosong')" oninput="setCustomValidity('')"> 
                                        </div>
                                        <div class="form-group">                     
                                            <label for="exampleInputEmail1">Gambar</label>
                                            <div class="fallback">
                                                <input class="form-control" value="<?php echo $id_fasilitas ?>" type="text" name="id_fasilitas" >
                                                <input class="form-control" value="<?php echo $gambar_lama ?>" type="text" name="gambar_lama" >
                                                <input name="userfile" type="file" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"/> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                                            
                                            
                                        </div>                                        
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>