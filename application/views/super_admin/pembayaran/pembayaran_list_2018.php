
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $h2;?>
                <small>
					<?php echo anchor($url_create, '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?>
                    <?php echo anchor(site_url('pembayaran/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-sm btn-primary"'); ?>
                    <?php echo anchor(site_url('pembayaran/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-sm btn-primary"'); ?></small></h2>
        
				</small>
				<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?>
			</h2><ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link">Show/Hide<i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th colspan="14">
                            <button title='Lunas' class='btn btn-sm btn-info'>Lunas</i></button>
                            <button title='Start Bulan' class='btn btn-sm btn-succes'>Start Bulan</i></button>
                            <button title='Telat 1 bulan' class='btn btn-sm btn-primary'>Telat 1 bulan</i></button>
                            <button title='Telat 2 bulan' class='btn btn-sm btn-warning'>Telat 2 bulan</i></button>
                            <button title='Telat >=3 bulan' class='btn btn-sm btn-danger'>Telat 3 bulan</i></button>
                        </th>
                    </tr>
                    <tr>
                        <th width="10px">No</th>
                        <th>Nama</th>
					    <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                    </tr>
                </thead>
			    <tbody>
                    <?php
                        //$tgl=date('m')=;
                        $start = 0;
                        $data_mhs   = $this->Daftar_mhs_model->get_all();
                            foreach ($data_mhs as $mhs) {
                                        
                    ?>
                    <tr>
					    <td><?php echo ++$start ?></td>
                        <td><?php echo $mhs->nama ?></td>
                        <td>
                            <?php
                                $warna1='succes';                    
                                echo $this->Pembayaran_model->januari($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna1'><i class='fa fa-times'></i></button>"  
                            ?>
                        </td>
					    <td>
                            <?php 
                                $warna2='primary';
                                if(cari_bulan(2,$mhs->id)=='0'){
                                    if(cari_bulan(2-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna2='warning';

                                    }
                                }
                                echo $this->Pembayaran_model->februari($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna2'><i class='fa fa-times'></i></button>"
                            ?>
                        </td>
                        <td>
                            <?php
                                $warna3='primary';
                                if(cari_bulan(date('m'),$mhs->id)=='0'){
                                    if(cari_bulan(3-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna3='warning';
                                        if(cari_bulan(3-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna3='danger';
                                            if(cari_bulan(3-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna3='danger';
                                            }
                                        }
                                    }
                                } 
                                echo $this->Pembayaran_model->maret($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna3'><i class='fa fa-times'></i></button>"
                            ?>
                        </td>
                        <td>
                            <?php
                                $warna4='primary';
                                if(cari_bulan(4,$mhs->id)=='0'){
                                    if(cari_bulan(4-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna4='warning';
                                        if(cari_bulan(4-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna4='danger';
                                            if(cari_bulan(4-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna4='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->april($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna4'><i class='fa fa-times'></i></button>"
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna5='primary';
                                if(cari_bulan(5,$mhs->id)=='0'){
                                    if(cari_bulan(5-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna5='warning';
                                        if(cari_bulan(5-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna5='danger';
                                            if(cari_bulan(5-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna5='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->mei($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna5'><i class='fa fa-times'></i></button>"
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna6='primary';
                                if(cari_bulan(6,$mhs->id)=='0'){
                                    if(cari_bulan(6-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna6='warning';
                                        if(cari_bulan(6-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna6='danger';
                                            if(cari_bulan(6-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna6='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->juni($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna6'><i class='fa fa-times'></i></button>"
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna7='primary';
                                if(cari_bulan(7,$mhs->id)=='0'){
                                    if(cari_bulan(7-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna7='warning';
                                        if(cari_bulan(7-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna7='danger';
                                            if(cari_bulan(7-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna7='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->juli($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna7'><i class='fa fa-times'></i></button>" 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna8='primary';
                                if(cari_bulan(8,$mhs->id)=='0'){
                                    if(cari_bulan(8-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna8='warning';
                                        if(cari_bulan(8-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna8='danger';
                                            if(cari_bulan(8-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna8='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->agustus($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna8'><i class='fa fa-times'></i></button>" 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna9='primary';
                                if(cari_bulan(9,$mhs->id)=='0'){
                                    if(cari_bulan(9-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna9='warning';
                                        if(cari_bulan(9-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna9='danger';
                                            if(cari_bulan(9-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna9='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->september($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna9'><i class='fa fa-times'></i></button>" 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna10='primary';
                                if(cari_bulan(10,$mhs->id)=='0'){
                                    if(cari_bulan(10-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna10='warning';
                                        if(cari_bulan(10-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna10='danger';
                                            if(cari_bulan(10-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna10='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->oktober($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna10'><i class='fa fa-times'></i></button>" 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna11='primary';
                                if(cari_bulan(11,$mhs->id)=='0'){
                                    if(cari_bulan(11-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna11='warning';
                                        if(cari_bulan(11-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna11='danger';
                                            if(cari_bulan(11-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna11='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->november($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna11'><i class='fa fa-times'></i></button>" 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $warna12='primary';
                                if(cari_bulan(12,$mhs->id)=='0'){
                                    if(cari_bulan(12-1,$mhs->id)=='0'){
                                        //1 bulan
                                        $warna12='warning';
                                        if(cari_bulan(12-2,$mhs->id)=='0'){
                                            //2 bulan
                                            $warna12='danger';
                                            if(cari_bulan(12-3,$mhs->id)=='0'){
                                                //3 bulan
                                                $warna12='danger';
                                            }
                                        }
                                    }
                                }
                                echo $this->Pembayaran_model->desember($mhs->id)=='1'?"<button title='Lunas' class='btn btn-sm btn-info'><i class='fa fa-check-square-o'></i></button>":"<button title='Belum Lunas' class='btn btn-sm btn-$warna12'><i class='fa fa-times'></i></button>" 
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
        </div>
    </div>
</div>
    