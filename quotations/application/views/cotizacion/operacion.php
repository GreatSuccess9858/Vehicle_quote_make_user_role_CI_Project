<?php
if ($cotizacion_id > 0) {
    $is_update = true;
} else {
    $is_update = false;
} ?>
<?php
$status = (int)@$cotizacion_info['status_row'];
if ($status == 0) {
    $editable = true;
} else {
    $editable = false;
}
$_pendiente = false;
$_aprobado = false;
$_denegado = false;
if (isset($status)) {
    switch ($status) {
        case 0:
            $_pendiente = true;
            break;
        case 1:
            $_aprobado = true;
            break;
        case 2:
            $_denegado = true;
            break;
        default:
            # code...
            break;
    }
}
function _set($v, $cotizacion_info)
{

    if (isset($cotizacion_info[$v])) {
        return $cotizacion_info[$v];
    } else {
        return '';
    }
}

?>
<div class="panel">
    <div class="panel-heading">

        <h2 id="title-create" class="<?php if ($cotizacion_id > 0) {
            echo 'hidden';
        } ?>">Create Quote</h2>
        <!--        <h2 id="title-update" class="--><?php //if ($cotizacion_id <= 0) {
        //            echo 'hidden';
        //        } ?><!--">Actualizar Cotización #--><?PHP //echo $cotizacion_id; ?><!--</h2>-->
        <div class="pull-left">
            Currently:
            <?php if ($cotizacion_id <= 0) { ?>
                <label for="" class="label label-warning"> EARRING</label>
            <?PHP } else {
                ?>
                <?php if ((int)$status == 1) {
                    ?>
                    <label for="" class="label label-success">
                        APROBADO
                    </label>
                    <?PHP
                } elseif ((int)$status == 2) {
                    ?>
                    <label for="" class="label label-danger"> DENEGADO</label>
                    <?PHP
                } else {
                    ?>
                    <label for="" class="label label-warning"> PENDIENTE</label>
                    <?PHP
                } ?>
                <?PHP
            } ?>
            <?php if ($is_update): ?>
                <?php if ($editable === false): ?>
                    <label for="" class="label label-info" style="margin-left: 10px;">
                        <?php echo $cotizacion_info['fecha_respuesta']; ?>
                    </label>
                <?php endif ?>
            <?php endif ?>
        </div>
        <?php if ($is_update): ?>
            <div class="pull-right">
                <?php if ((int)$status == 0): ?>
                    <a href="<?php echo site_url("cotizacion/cambiar_status/" . $cotizacion_id . '/2'); ?>"
                       class="btn btn-danger"> <?php _icon('hand-down'); ?> Denegar </a>
                    <a href="<?php echo site_url("cotizacion/cambiar_status/" . $cotizacion_id . '/1'); ?>"
                       class="btn btn-success"> <?php _icon('hand-up'); ?> Aprobar </a>
                <?php else: ?>

                    <a href="<?php echo site_url("cotizacion/cambiar_status/" . $cotizacion_id . '/0'); ?>"
                       class="btn btn-warning"> <?php _icon('hand-up'); ?> Volver a pendiente </a>

                <?php endif ?>

            </div>
        <?php endif ?>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body panel-form-sm">

        <form <?php if ($editable): ?>
            data-trigger="custom__update_form_cotizacion" action="<?php echo site_url("cotizacion/ajax_save"); ?>"
        <?php else: ?>
            action="#"
            onsubmit=""
        <?php endif ?> method="post" class="form-horizontal js-validation-plus">

            <input data-rule-required="true" type="hidden" id="cotizacion_id" name="cotizacion_id"
                   value="<?php echo $cotizacion_id; ?>">
            <div class="row">
                <div class="col-sm-6">
                    <!--  informacion del servicio -->
                    <div class="well well-custom">
                        <div class="form-group">

                            <label for="" class="col-sm-12">Servicio de flete en unidad:</label>
                            <div class="col-sm-12">
                                <?php
                                $vehiculos_id = _set('vehiculos_id', $cotizacion_info)
                                ?>
                                <select data-rule-required="true" name="vehiculos_id" class="form-control input-sm"
                                        id="vehiculos_id" onchange="changeVehiculos(this.value)">
                                    <option value="">Seleccione Vehiculo/tipo</option>
                                    <?php
                                    $vehiculos = $this->db->get("ce_vehiculos")->result_array();
                                    ?>
                                    <?php foreach ($vehiculos as $k => $v): ?>
                                        <option <?php if ($vehiculos_id == $v['vehiculos_id']): ?>
                                            selected
                                        <?php endif ?> value="<?php echo $v['vehiculos_id'] ?>">
                                            <?php echo $v['name']; ?> /
                                            <?php echo $v['tipo_unidad'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-12">Origen:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" value="<?php echo _set('origen', $cotizacion_info) ?>"
                                       type="text" class="form-control input-sm" name="origen">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-12">Destino:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" value="<?php echo _set('destino', $cotizacion_info) ?>"
                                       type="text" class="form-control input-sm" name="destino">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-12">Kilometros:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" type="text" class="form-control input-sm numeric"
                                       value="<?php echo _set('kilometros', $cotizacion_info) ?>" name="kilometros" onkeyup="changeKilometer(this.value)">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="" class="col-sm-12">Descripcion de la carga:</label>
                            <div class="col-sm-12">
                                <textarea name="descripcion" class="form-control" id="descripcion" cols="30"
                                          rows="3"><?php echo _set('descripcion', $cotizacion_info) ?></textarea>
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label for="" class="col-sm-12">Peso por embarque:</label>
                            <div class="col-sm-6">
                                <input data-rule-required="true"
                                       value="<?php echo _set('peso_embarque', $cotizacion_info) ?>" type="text"
                                       class="form-control numeric input-sm" name="peso_embarque">
                            </div>
                            <?php $peso_embarque_dimension = _set('peso_embarque_dimension', $cotizacion_info); ?>
                            <div class="col-sm-6">
                                <select class="form-control input-sm" name="peso_embarque_dimension"
                                        id="peso_embarque_dimension" data-rule-required="true">
                                    <option value=""></option>
                                    <option value="TN" <?php if ($peso_embarque_dimension == 'TN'): ?>
                                        selected
                                    <?php endif ?>>Tn
                                    </option>
                                    <option value="KG" <?php if ($peso_embarque_dimension == 'KG'): ?>
                                        selected
                                    <?php endif ?>>Kg
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-12">Importe del servicio:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" value="<?php echo _set('importe', $cotizacion_info) ?>"
                                       type="text" class="form-control numeric input-sm" name="importe" id="total_service">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <div class="col-sm-6">
                                <input value="0"
                                    <?php
                                    $maniobras_flag = _set('maniobras', $cotizacion_info);
                                    echo (empty($maniobras_flag)) ? '' : 'checked'; ?>
                                       type="checkbox" id="maniobras" name="maniobras">
                                <label>Incluye maniobras:</label></div>
                            <div class="col-sm-6">
                                <input id="maniobras_importe"
                                    <?php if ($is_update): ?>
                                        <?php if (empty($maniobras_flag)): ?>
                                            disabled
                                        <?php endif ?>
                                    <?php else: ?>
                                        disabled
                                    <?php endif ?>
                                       data-rule-required="#maniobras:checked"
                                       value="<?php echo _set('maniobras_importe', $cotizacion_info) ?>" type="text"
                                       class="form-control input-sm numeric" name="maniobras_importe">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <div class="col-sm-6">
                                <label for="" >Fecha del servicio:</label>
                                <div>
                                    <div class='input-group date' id='datetimepicker3'>
                                        <input data-rule-required="true"
                                               value="<?php echo _set('fecha_a', $cotizacion_info) ?>" type="text"
                                               class="form-control"
                                               name="fecha_a" id="mdate1">
                                        <!--                                        <span class="input-group-addon">-->
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Fecha Estimada de Llegada:</label>
                                <div>
                                    <div class='input-group date' id='datetimepicker4'>
                                        <input data-rule-required="true"
                                               value="<?php echo _set('fecha_b', $cotizacion_info) ?>" type="text"
                                               class="form-control" name="fecha_b" id="mdate">
                                        <!--                                        <input type="text" class="form-control" placeholder="2017-06-04" id="mdate">-->
                                        <!--                                        <span class="input-group-addon">-->
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <div class="col-sm-4">
                                <div>
                                    <label for="valor">
                                        <input type="checkbox"
                                            <?php $valor_no_declarado_flag = _set('valor_no_declarado', $cotizacion_info);
                                            echo (empty($valor_no_declarado_flag)) ? '' : 'checked'; ?>
                                               value="0" id="valor_no_declarado">
                                        <lavel>Declared value</lavel>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex" >
                                <div class="col-sm-6">
                                    <input id="declarar_valor_val"
                                            <?php if ($is_update): ?>
                                                <?php if (empty($valor_no_declarado_flag)): ?>
                                                    disabled
                                                <?php endif ?>
                                            <?php else: ?>
                                                disabled
                                            <?php endif ?>
                                           data-rule-required="#valor_no_declarado_val:checked"
                                           value="<?php echo _set('declarar_valor_val', $cotizacion_info) ?>"
                                           type="text"
                                           class="form-control numeric " name="declarar_valor_val"
                                           placeholder="Price">

                                </div>
                                <div class="col-sm-6">
                                    <input id="declarar_valor"
                                        <?php if ($is_update): ?>
                                            <?php if (empty($valor_no_declarado_flag)): ?>
                                                disabled
                                            <?php endif ?>
                                        <?php else: ?>
                                            disabled
                                        <?php endif ?>
                                           data-rule-required="#valor_no_declarado:checked"
                                           value="<?php echo _set('declarar_valor', $cotizacion_info) ?>" type="text"
                                           class="form-control numeric input-sm" name="declarar_valor" placeholder="%">

                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-12">% de la prima de seguro:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="#valor_no_declarado2:checked"
                                       value="<?php echo _set('prima', $cotizacion_info) ?>" type="text"
                                       class="form-control numeric input-sm" name="prima">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- informacion del cliente -->
                    <div class="well well-custom">
                        <div class="form-group">

                            <label for="" class="col-sm-4">Empresa:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" value="<?php echo _set('empresa', $cotizacion_info) ?>"
                                       type="text" class="form-control input-sm" name="empresa">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="" class="col-sm-4">Nombre del cliente:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" value="<?php echo _set('nombre', $cotizacion_info) ?>"
                                       type="text" class="form-control input-sm" name="nombre">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="" class="col-sm-4">Domicilio:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true"
                                       value="<?php echo _set('domicilio', $cotizacion_info) ?>" type="text"
                                       class="form-control input-sm" name="domicilio">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="" class="col-sm-4">Correo:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" data-rule-email="true"
                                       value="<?php echo _set('email', $cotizacion_info) ?>" type="text"
                                       class="form-control input-sm" name="email">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="" class="col-sm-4">Teléfono:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true"
                                       value="<?php echo _set('telefono', $cotizacion_info) ?>" type="text"
                                       class="form-control input-sm" name="telefono">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="" class="col-sm-4">Clave INE:</label>
                            <div class="col-sm-12">
                                <input data-rule-required="true" value="<?php echo _set('INE', $cotizacion_info) ?>"
                                       type="text" class="form-control input-sm" name="INE">
                            </div>
                        </div>
                    </div>
                    <div class="well well-custom">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="vehiculo-image">
                                    <img src="" style="width: 100%;" id="vehiculo_logo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  productos -->
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-primary "
                            type="submit" <?php echo ($editable === false) ? 'disabled' : ''; ?>> Guardar
                    </button>
                    <a href="<?php echo site_url("cotizacion/pdf/" . $cotizacion_id); ?>" target="blank"
                       class="btn btn-primary  " <?PHP if ($cotizacion_id <= 0) {
                        echo "disabled";
                    } ?> type="button"> Previsualizar </a>
                    <a data-toggle="modal" href='#modal-sendemail'
                       class="btn btn-primary   " <?PHP if ($cotizacion_id <= 0) {
                        echo "disabled";
                    } ?> type="button"> Enviar por email</a>
                    <a href="<?php echo site_url("cotizacion/index"); ?>" class="btn btn-primary ">Volver</a>
                </div>
            </div>
            <?php //if ($editable): ?>
        </form>
        <?php //endif?>
    </div>
</div>
<script>

    var cotizacion_id =<?php echo (int)$cotizacion_id; ?>;
    var clientes_id =<?php echo (int)@$cotizacion_info['clientes_id']; ?>;
</script>
<!--<a class="hidden " data-toggle="modal" href='#modal-sendemail'>Trigger modal</a>-->
<form method="post" action="<?php echo site_url("cotizacion/send_email"); ?>"
      class="form-horizontal js-validation-plus">
    <div class="modal fade" id="modal-sendemail">
        <input data-rule-required="true" type="hidden" name="cotizacion_id" id="cotizacion_id"
               value="<?php echo $cotizacion_id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <!--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                    <h4 class="modal-title text-center">Enviar cotización</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label  col-sm-12">Enviar a:</label>
                        <div class="col-sm-12">
                            <input data-rule-required="true" type="text" name="emails" id="emails"
                                   data-rule-required="true" class="form-control   input-sm">
                            <input data-rule-required="true" type="hidden" data-rule-required="true" name="lista-emails"
                                   id="lista-emails">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label  col-sm-12"> Mensaje</label>
                        <div class="col-sm-12">
                            <textarea name="mensaje" class="form-control  " data-rule-required="true" id="mensaje"
                                      cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <!--                    <button type="submit" class="hidden" id="submit"></button>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var vehiculo_price = 0;
    jQuery(function () {
        jQuery("body").on('change', '#valor_no_declarado', function (event) {
            event.preventDefault();
            if (jQuery(this).is(":checked")) {
                jQuery("#valor_no_declarado2").removeProp('checked')
                jQuery("#valor_no_declarado2").removeAttr('checked')
                jQuery("#valor_no_declarado2").prop('checked', false)
            } else {
                jQuery("#valor_no_declarado2").prop('checked', true)
            }
        });
    });
    $(document).ready(function () {
        $("#maniobras").on("click", function () {
            if ($(this).is(":checked")) {
                $("#maniobras_importe").prop("disabled", false);
            } else {
                $("#maniobras_importe").prop("disabled", true);
            }
        });
    });

    $(document).ready(function () {
        $("#valor_no_declarado").on("click", function () {
            if ($(this).is(":checked")) {
                $("#declarar_valor").prop("disabled", false);
                $("#declarar_valor_val").prop("disabled", false);
            } else {
                $("#declarar_valor").prop("disabled", true);
                $("#declarar_valor_val").prop("disabled", true);
            }
        });
    });

    function changeVehiculos(id) {
        var items = <?= json_encode($vehiculos);?>;
        var item = items.find(val => val.vehiculos_id == id) || {};
        if (!!item) {
            var logoUrl = item.logo;
            vehiculo_price = item.price;
            $('#vehiculo_logo').attr('src', `/quotations/uploads/vehiculos/${logoUrl}`);
        } else {
            console.log('not found');
        }
    }

    function changeKilometer(val) {
        $('#total_service').val(val * vehiculo_price);
    }
</script>