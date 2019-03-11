<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $h2;?><small></small></h2>
 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>
                    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"> </script>

                    <script type="text/javascript">
                        function validate(evt) {
                          var theEvent = evt || window.event;

                          // Handle paste
                          if (theEvent.type === 'paste') {
                              key = event.clipboardData.getData('text/plain');
                          } else {
                          // Handle key press
                              var key = theEvent.keyCode || theEvent.which;
                              key = String.fromCharCode(key);
                          }
                          var regex = /[0-9]|\./;

                          if( !regex.test(key) ) {
                            theEvent.returnValue = false;
                            if(theEvent.preventDefault) theEvent.preventDefault();
                          }
                        }


                        (function () {
                        var onload = window.onload;

                        window.onload = function () {
                            if (typeof onload == "function") {
                                onload.apply(this, arguments);
                            }

                            var fields = [];
                            var inputs = document.getElementsByTagName("input");
                            var textareas = document.getElementsByTagName("textarea");

                            for (var i = 0; i < inputs.length; i++) {
                                fields.push(inputs[i]);
                            }

                            for (var i = 0; i < textareas.length; i++) {
                                fields.push(textareas[i]);
                            }

                            for (var i = 0; i < fields.length; i++) {
                                var field = fields[i];

                                if (typeof field.onpaste != "function" && !!field.getAttribute("onpaste")) {
                                    field.onpaste = eval("(function () { " + field.getAttribute("onpaste") + " })");
                                }

                                if (typeof field.onpaste == "function") {
                                    var oninput = field.oninput;

                                    field.oninput = function () {
                                        if (typeof oninput == "function") {
                                            oninput.apply(this, arguments);
                                        }

                                        if (typeof this.previousValue == "undefined") {
                                            this.previousValue = this.value;
                                        }

                                        var pasted = (Math.abs(this.previousValue.length - this.value.length) > 1 && this.value != "");

                                        if (pasted && !this.onpaste.apply(this, arguments)) {
                                            this.value = this.previousValue;
                                        }

                                        this.previousValue = this.value;
                                    };

                                    if (field.addEventListener) {
                                        field.addEventListener("input", field.oninput, false);
                                    } else if (field.attachEvent) {
                                        field.attachEvent("oninput", field.oninput);
                                    }
                                }
                            }
                        }
                    })();


                        $(function(){

                            $.ajaxSetup({
                            type:"POST",
                            url: "<?php echo base_url('index.php/select/ambil_data') ?>",
                            cache: false,
                            });

                            $("#npm").change(function(){

                            var value=$(this).val();
                            //if(value>0){
                            $.ajax({
                            data:{modul:'ikhwan',id:value},
                            success: function(respond){
                            //$("#jumlah_pembayaran").val(respond);
                            if(respond>0){
                                    $.post("<?php echo site_url();?>/select/session",{'pembayaran':respond});
                                    var output2= "Rp. " + parseInt(respond).toLocaleString();
                                    $("#jumlah_pembayaran").attr("placeholder", output2);
                                    $("#save").removeAttr("disabled");
                                }
                                else{
                                    var output1="NPM salah!";
                                    $("#jumlah_pembayaran").attr("placeholder", output1);
                                    $("#save").attr("disabled");
                                }

                            }
                            })
                            //}

                            });                            
                        })


                        $( function() {
                            $( "#tgl_pembayaran" ).datepicker({
                                changeMonth: true,
                                changeYear: true,
                                dateFormat: "d MM yy",
                            });
                        } );

                        $(document).ready(function() {
                             $(':input[type="submit"]').prop('disabled', true);                             
                             $('input[type="text"]').keyup(function() {
                                if($(this).val() != '') {
                                   $(':input[type="submit"]').prop('disabled', false);
                                }
                             });
                         });
                     </script>
                     

        <form action="<?php echo $action; ?>" method="post" id="pembayaran" name="pembayaran" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
    	    <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int" id='npm-error'>NPM <?php echo form_error('npm') ?></label>
                    
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="tel" onkeypress='validate(event)' onpaste="return false;" required="required" class="form-control col-md-7 col-xs-12" name="npm" id="npm" placeholder="NPM" value="<?php echo $npm; ?>" data-toggle='tooltip' data-placement='bottom'  title='Min. 9, Max. 9'/>
                    </div>
            </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Jumlah Pembayaran <?php echo form_error('jumlah_pembayaran') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="jumlah_pembayaran" id="jumlah_pembayaran" placeholder="Jumlah Pembayaran" disabled="disabled" value="<?php echo $jumlah_pembayaran; ?>" />
                </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Operator <?php echo form_error('operator') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                        $user=$this->ion_auth->user()->row();
                        $kosong='NULL';
                        echo form_input($kosong,$user->first_name.' '.$user->last_name,"class='form-control' data-toggle='tooltip' data-placement='bottom'  title='Nama ini di isi otomatis' disabled='true'");
                    ?>
                </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Tgl Hari Ini <?php echo form_error('tgl_hari_ini') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="tgl_hari_ini" data-toggle='tooltip' data-placement='bottom'  title='Tanggal ini di isi otomatis' disabled="true" id="tgl_hari_ini" placeholder="<?php echo tgl_indo(date('Y-m-d'));?>" value="<?php echo $tgl_hari_ini; ?>" />
                </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Tgl Pembayaran <?php echo form_error('tgl_pembayaran') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="tgl_pembayaran" id="tgl_pembayaran" placeholder="Tgl Pembayaran" value="<?php echo $tgl_pembayaran; ?>" />
                </div>
        </div>
	    <div class="ln_solid"></div>
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button disabled="disabled" type="submit" class="btn btn-primary" id="save" name="save"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply-all"></i> Cancel</a>
	</div>
                        </div>
        </form>
     </div>
            </div>
        </div>
    </div>
</div>
