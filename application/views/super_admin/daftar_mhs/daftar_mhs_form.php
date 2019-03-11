<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>

<script type="text/javascript">

$(function(){

$.ajaxSetup({
type:"POST",
url: "<?php echo base_url('index.php/select/ambil_data') ?>",
cache: false,
});

$("#provinsi").change(function(){

var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kabupaten',id:value},
success: function(respond){
$("#kab").html(respond);
}
})
}

});


$("#kab").change(function(){
var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kecamatan',id:value},
success: function(respond){
$("#kec").html(respond);
}
})
}
});

$("#kec").change(function(){
var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kelurahan',id:value},
success: function(respond){
$("#desa").html(respond);
}
})
} 
});

$("#fakultas").change(function(){
    var value=$(this).val();
    if(value>0){
        $.ajax({
            data:{modul:'jurusan',id:value},
            success: function(respond){
                $("#jurusan").html(respond);
            }
        })
    }

});

$('[id="j_kI"]').click(function(){
var value=$(this).val();
    //if(value>0){
        $.ajax({
            data:{modul:'kamar_ikhwan'},
            success: function(respond){
                $("#kamar").html(respond);
            }
        })
    //}

});

$('[id="j_kA"]').click(function(){
var value=$(this).val();
    //if(value>0){
        $.ajax({
            data:{modul:'kamar_akhwat'},
            success: function(respond){
                $("#kamar").html(respond);
            }
        })
    //}

});

})

</script>

<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $judul_mhs;?><small></small></h2>
 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <br>
                <?php echo form_open_multipart($action,'method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""')  ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Nama <?php echo form_error('nama') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">NPM <?php echo form_error('npm') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="npm" id="npm" placeholder="NPM" value="<?php echo $npm; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Fakultas <?php echo form_error('fakultas') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo fakultas('fakultas', 'fakultas', 'nama_fakultas', 'id',$fakultas);?>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Jurusan <?php echo form_error('jurusan') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo jurusan('jurusan', 'jurusan', 'nama_jurusan', 'id', $jurusan, $fakultas);?>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Semester <?php echo form_error('semester') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo semester('semester', 'semester', 'semester', 'id', $semester);?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis kelamin <?php echo form_error('j_k')?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                if($j_k=="L"){
                                    echo "Laki-laki <input type='radio' name='j_k' id='j_kI' value='L' checked  />"." ".
                                    "Perempuan <input type='radio'  name='j_k' id='j_kA' value='P'  />";
                                }
                                elseif($j_k=="P"){
                                    echo "Laki-laki <input type='radio'  name='j_k' id='j_kI' value='L'  />"." ".
                                    "Perempuan <input type='radio' name='j_k' id='j_kA' value='P' checked  />";
                                }
                                elseif(empty($j_k)==TRUE || $j_k==""){
                                    echo "Laki-laki <input type='radio'  name='j_k' id='j_kI' value='L'   />"." ".
                                    "Perempuan <input type='radio'  name='j_k' id='j_kA' value='P'    />";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Kamar <?php// echo form_error('kamar') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="kamar" id="kamar" class="form-control">
                                <option value='0'>--Pilih--</pilih>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char" data-toggle='tooltip' data-placement='bottom'  title='This automatic form your acount'>Operator <?php //echo form_error('operator') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            $user=$this->ion_auth->user()->row();
                            $kosong='NULL';
                            echo form_input($kosong,$user->first_name.' '.$user->last_name,"class='form-control' data-toggle='tooltip' data-placement='bottom'  title='Nama ini di isi otomatis' disabled='true'");
                        ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">No. HP <?php echo form_error('noHP') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="noHP" id="noHP" placeholder="No. HP" value="<?php echo $noHP; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Tempat Lahir <?php echo form_error('ttl') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="ttl" id="ttl" placeholder="Tempat Lahir" value="<?php echo $ttl; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Tanggal Lahir <?php echo form_error('tgl_lahir') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="tgl_lahir" name="tgl_lahir" required="required" type="text" class="form-control" value="<?php echo $tgl_lahir;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Bahasa <?php echo form_error('bahasa') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            Arab <input class="flat" type="checkbox" name="bahasa[]" id="bahasaA" value="Arab" <?php echo set_checkbox('bahasa', 'Arab'); ?> />
                            Ingggris <input class="flat" type="checkbox" name="bahasa[]" id="bahasaI" value="Inggris" <?php echo set_checkbox('bahasa', 'Inggris'); ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hobi <?php echo form_error('hobi') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="hobi" type="text" class="tags form-control" name="hobi" value="<?php echo $hobi; ?>"/>
                            <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keahlian <?php echo form_error('keahlian') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="keahlian" type="text" class="tags form-control" name="keahlian" value="<?php echo $keahlian; ?>"/>
                            <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cita-cita <?php echo form_error('cita_cita') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="cita_cita" type="text" class="tags form-control" name="cita_cita" value="<?php echo $cita_cita; ?>"/>
                            <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Sertifikat LDIK<?php echo form_error('sertifikat_ldik') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="sertifikat_ldik" id="sertifikat_ldik">
                            <p>Jika tidak ada kosongkan.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Foto <?php echo form_error('foto'); $msg = $this->session->flashdata('msg'); echo '<div class="text-danger">'.$msg['error'].'</div>';?> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="foto" id="foto" onchange="previewImage();">
                            <div>
                                <ol type="1" class="text-danger">
                                    <li>Ukuran foto max. 2 Mb.</li>
                                    <li>Ekstensi foto hanya .jgp, .png</li>
                                    <li>Tinggi dan lebar foto max. 152cm*152cm</li>
                                </ol>
                            </div>
                            
                            <img id="image-preview" alt="image preview" />
                        </div>
                    </div>
                    <style type="text/css">
                        #image-preview{
                            display:none;
                            width : 100px;
                            height:120px;
                        }
                    </style>
                    <script>
                        function previewImage() {
                            document.getElementById("image-preview").style.display = "block";
                            var oFReader = new FileReader();
                             oFReader.readAsDataURL(document.getElementById("foto").files[0]);
                         
                            oFReader.onload = function(oFREvent) {
                              document.getElementById("image-preview").src = oFREvent.target.result;
                            };
                        };
                    </script>
                    
                    
                    
                    </br><br></br><br>
                    <!--Data orang tua-->
                    <div class="x_title">
                        <h2><?php echo $judul_ortu; ?><small></small></h2>
                            <div class="clearfix"></div>
                    </div>
           
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Nama Ayah <?php echo form_error('nama_Ayah') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="nama_Ayah" id="nama_Ayah" placeholder="Nama Ayah" value="<?php echo $nama_Ayah; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">NoHP Ayah <?php echo form_error('noHP_Ayah') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="noHP_Ayah" id="noHP_Ayah" placeholder="No. HP Ayah" value="<?php echo $noHP_Ayah; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Nama Ibu <?php echo form_error('nama_Ibu') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="nama_Ibu" id="nama_Ibu" placeholder="Nama Ibu" value="<?php echo $nama_Ibu; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">NoHP Ibu <?php echo form_error('noHP_Ibu') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="noHP_Ibu" id="noHP_Ibu" placeholder="No. HP Ibu" value="<?php echo $noHP_Ibu; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Provinsi <?php echo form_error('provinsi') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo provinsi('provinsi', 'provinces', 'name', 'id', $provinsi); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Kab <?php echo form_error('kab') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo kabupaten('kab', 'regencies', 'name', $kab, 'id', $provinsi);?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Kec <?php echo form_error('kec') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo kecamatan('kec', 'districts', 'name', $kec, 'id', $kab) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Desa <?php echo form_error('desa') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo deso('desa', 'villages', 'name', $desa, 'id', $kec); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">RT/RW <?php echo form_error('rt') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="rt" id="rt" placeholder="Rt/rw" value="<?php echo $rt; ?>" />
                        </div>
                    </div>
        <!--END data orang tua-->
        <div class="ln_solid"></div>
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo $cancel ?>" class="btn btn-default"><i class="fa fa-reply-all"></i> Cancel</a>
	</div>
                    </div></form>
     </div>
            </div>
        </div>
    </div>
</div>
<!--END-->