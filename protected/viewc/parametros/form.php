<?php $parametro = $data["parametros"]; ?>
<section class="content-header">
    <h1>
        Parameter Modification
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Parameter Modification</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>parametros/save" method="post" name="form1" enctype="multipart/form-data">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Information</legend>
                <input type="hidden"  value="<?php echo $parametro->id ?>"  id="id" name="id">
                
                <div class="col-lg-4">
                    <label id="l_resolucion_hab">Resolution of authorization</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo $parametro->resolucion_hab ?>"  id="resolucion_hab" name="resolucion_hab" maxlength="4">
                    </div><!-- /.input group -->
                </div>
                

                <div class="col-lg-4">
                    <label id="l_cons_cliente">Consecutive client</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="cons_cliente" name="cons_cliente"  value="<?php echo $parametro->cons_cliente ?>" min="1" max="9999" maxlength="4" oninput="maxLengthCheck(this)" />
                    </div>  
                </div>

                

                <div class="clearfix"></div><br/>

                <div class="col-lg-4">
                    <label id="l_cons_ruta">Route consecutive</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="cons_ruta" name="cons_ruta"  value="<?php echo $parametro->cons_ruta ?>"  min="1" max="99999" maxlength="5" oninput="maxLengthCheck(this)"/>
                    </div>  
                </div>

                <div class="col-lg-4">
                    <label id="l_cons_factura">Consecutive invoice</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="cons_factura" name="cons_factura"  value="<?php echo $parametro->cons_factura ?>"  min="1" max="9999" maxlength="4" oninput="maxLengthCheck(this)" />
                    </div>  
                </div>

                <div class="col-lg-4">
                    <label id="l_iva">Iva</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="iva" name="iva"  value="<?php echo $parametro->iva ?>"  min="1" max="100" maxlength="3" oninput="maxLengthCheck(this)" />
                    </div>  
                </div>

                <div class="clearfix"></div><br/>

                <!-- <div class="col-lg-4">
                    <label id="l_valor_residuos">Valor de residuos</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="valor_residuos" name="valor_residuos"  value="<?php echo $parametro->valor_residuos ?>" maxlength="4" />
                    </div>  
                </div> -->
                <hr/>
                <div class="col-lg-4">
                    <label id="l_host">Host</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="host" name="host"  value="<?php echo $parametro->host ?>" maxlength="40" />
                    </div>  
                </div>

                <div class="col-lg-4">
                    <label id="l_port">Port</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="port" name="port"  value="<?php echo $parametro->port ?>" />
                    </div>  
                </div>

                <div class="clearfix"></div><br/>

                <div class="col-lg-4">
                    <label id="l_smtpsecure">Smtpsecure</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="smtpsecure" name="smtpsecure"  value="<?php echo $parametro->smtpsecure ?>" maxlength="5" />
                    </div>  
                </div>

                <div class="col-lg-4">
                    <label id="l_username">Username</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="username" name="username"  value="<?php echo $parametro->username ?>" maxlength="40" />
                    </div>  
                </div>

                <div class="col-lg-4">
                    <label id="l_password">Password</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-unlock-alt"></i>
                        </div>
                        <input type="password" class="form-control pull-right" id="password" name="password"  value="<?php echo $parametro->password ?>" maxlength="40" />
                    </div>  
                </div>
                
                
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="submit" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?php echo $parametro->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="0" />
                </div>

        </div>
    </form>
</div>


<script>
  // This is an old version, for a more recent version look at
  // https://jsfiddle.net/DRSDavidSoft/zb4ft1qq/2/
  function maxLengthCheck(object)
  {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }
</script>