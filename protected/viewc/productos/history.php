<?php $a = $data["productos"]; ?>
<section class="content-header">
    <h1 style="color: #6c9cd9;">
    Name of Product: <?= $a["nombre"];?>,  Quantity in stock : <?= $a["cantidad"]; ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a["id"] == "" ? 'Customers Registration' : 'Update of Clients'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>products/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General Information</legend>



        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Entrys</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                <thead>
                    <tr>
                    <td></td>
                    <td></td>
                    <td>Details</td>
                    <td>price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                    <td>Date</td>
                    </tr>
                </thead>
                  <tbody>
                  
                    <?php foreach($data["movimientos"] as $move){ ?>
                        <?php if($move["tipo"]=='I'){ ?>
                        <tr>
                            <td>
                                <div class="icheckbox_flat-blue" style="position: relative;" aria-checked="false" aria-disabled="false">
                                    <input type="checkbox" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;">
                                    </ins>
                                </div>
                            </td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                            <td class="mailbox-name"><?= $move["details"] ?></td>
                            <td class="mailbox-attachment"><?= $move["precio"] ?></td>
                            <td class="mailbox-date"><?= $move["cantidad"] ?></td>

                            <td class="mailbox-date"><?= $move["precio"]*$move["cantidad"] ?></td>
                            <td class="mailbox-subject"><b><?= $move["update_at"] ?></b> 
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
          </div>
          <!-- /. box -->
        </div>




        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dispatch</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                <thead>
                    <tr>
                    <td></td>
                    <td></td>
                    <td>Details</td>
                    <td>price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                    <td>Date</td>
                    </tr>
                </thead>
                  <tbody>
                  
                    <?php foreach($data["movimientos"] as $move){ ?>
                        <?php if($move["tipo"]=='D'){ ?>
                        <tr>
                            <td>
                                <div class="icheckbox_flat-blue" style="position: relative;" aria-checked="false" aria-disabled="false">
                                    <input type="checkbox" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;">
                                    </ins>
                                </div>
                            </td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                            <td class="mailbox-name"><?= $move["details"] ?></td>
                            <td class="mailbox-attachment"><?= $move["precio"] ?></td>
                            <td class="mailbox-date"><?= $move["cantidad"] ?></td>

                            <td class="mailbox-date"><?= $move["precio"]*$move["cantidad"] ?></td>
                            <td class="mailbox-subject"><b><?= $move["update_at"] ?></b> 
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
          </div>
          <!-- /. box -->
        </div>

            </fieldset>
            <div class="box-footer col-md-4 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                        <i class="fa  fa-arrow-left"></i> Cancel
                    </button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">
                        <i class="fa fa-save "></i> Save
                    </button>
                    
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
