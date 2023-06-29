<ul class="newnav nav nav-sidebar">
    <?php if ($this->user->loggedin && isset($this->user->info->user_role_id) &&
        ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment || $this->user->info->user_role_id == 10)
    ): ?>


<!--        <li class=" " style="display: none;" id="modulo_1_ge">-->
<!--            <a data-toggle="collapse" data-parent="#modulo_1_ge" href="#modulo_1_ge_c" class="collapsed --><?php
//            if (isset($activeLink['informe_ventas']) || isset($activeLink['informe_produccion']) || isset($activeLink['informe_financiero']) || isset($activeLink['informe_cotizaciones'])) {
//                echo "active";
//            }
//            ?><!--">-->
<!--                <span class="glyphicon glyphicon-lock sidebar-icon"></span> --><?php //echo _l("modulo_informes") ?>
<!--                <span class="plus-sidebar"><span class="glyphicon --><?php
//
//                    if (isset($activeLink['informe_ventas']) || isset($activeLink['informe_produccion']) || isset($activeLink['informe_financiero']) || isset($activeLink['informe_cotizaciones'])): ?><!--glyphicon-menu-down--><?php //else: ?><!--glyphicon-menu-right--><?php //endif; ?><!--"></span></span>-->
<!--            </a>-->
<!--            <div id="modulo_1_ge_c" class="panel-collapse collapse sidebar-links-inner --><?php
//            if (isset($activeLink['informe_ventas']) || isset($activeLink['informe_produccion']) || isset($activeLink['informe_financiero']) || isset($activeLink['informe_cotizaciones'])) {
//                echo "in";
//            }
//            ?><!--">-->
<!--                <ul class="inner-sidebar-links">-->
<!--                    --><?php
//                    _helper_sidebar_link("Informe Cotizaciones", 'informe_cotizaciones/index', 'informe_cotizaciones', 'index', @$activeLink);
//                    ?>
<!--                    --><?php
//                    _helper_sidebar_link("Informe Ventas", 'informe_ventas/index', 'informe_ventas', 'index', @$activeLink);
//                    ?>
<!---->
<!--                    --><?php
//                    _helper_sidebar_link("Informe Producion", 'informe_produccion/index', 'informe_produccion', 'index', @$activeLink);
//                    ?>
<!---->
<!--                    --><?php
//                    _helper_sidebar_link("Informe Financiero", 'informe_financiero/index', 'informe_financiero', 'index', @$activeLink);
//                    ?>
<!---->
<!--                </ul>-->
<!--            </div>-->
<!--        </li>-->


        <!-- opciones para capsa -->


        <!-- Fin opciones para cpasa  -->
        <li id="admin_sb">
            <a data-toggle="collapse" data-parent="#admin_sb" href="#admin_sb_c"
               class="collapsed <?php if (isset($activeLink['admin'])) {
                   echo "active";
               }
               ?>">
                <span
                    class="glyphicon glyphicon-wrench sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_157") ?>
                <span class="plus-sidebar"><span
                        class="glyphicon <?php if (isset($activeLink['admin'])): ?>glyphicon-menu-down<?php else: ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="admin_sb_c"
                 class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['admin'])) {
                     echo "in";
                 }
                 ?>">
                <ul class="inner-sidebar-links">
                    <?php if ($this->user->info->admin || $this->user->info->admin_settings): ?>
                        <li class="hidden <?php if (isset($activeLink['admin']['settings'])) {
                            echo "active";
                        }
                        ?>"><a href="<?php echo site_url("admin/settings") ?>"><?php echo lang("ctn_158") ?></a></li>

                    <?php endif; ?>
                    <?php //echo var_dump(isset($activeLink['sedes']['index'])); ?>


                    <?php if ($this->user->info->admin || $this->user->info->admin_members): ?>


                        <li class="<?php if (isset($activeLink['admin']['members'])) {
                            echo "active";
                        }
                        ?>"><a href="<?php echo site_url("admin/members") ?>"> <?php echo lang("ctn_160") ?></a></li>


                        <li class="<?php if (isset($activeLink['admin']['custom_fields'])) {
                            echo "active";
                        }
                        ?>"><a href="<?php echo site_url("admin/custom_fields") ?>"> <?php echo lang("ctn_346") ?></a>
                        </li>

                        <li class="<?php if (isset($activeLink['admin']['user_logs'])) {
                            echo "active";
                        }
                        ?>"><a href="<?php echo site_url("admin/user_logs") ?>"> <?php echo lang("ctn_471") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin): ?>
                        <li class="<?php if (isset($activeLink['admin']['user_roles'])) {
                            echo "active";
                        }
                        ?>"><a href="<?php echo site_url("admin/user_roles") ?>"> <?php echo lang("ctn_316") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin || $this->user->info->admin_members): ?>
                        <li class="<?php if (isset($activeLink['admin']['user_groups'])) {
                            echo "active";
                        }
                        ?>"><a href="<?php echo site_url("admin/user_groups") ?>"> <?php echo lang("ctn_161") ?></a>
                        </li>
                        <li class="<?php if (isset($activeLink['admin']['ipblock'])) {
                            echo "active";
                        }
                        ?>"><a href="<?php echo site_url("admin/ipblock") ?>"> <?php echo lang("ctn_162") ?></a></li>
                    <?php endif; ?>


                    <!--
                    <?php if (false): //$this->user->info->admin && false): ?>
                                                                        <li class="<?php if (isset($activeLink['admin']['email_templates'])) {
                                    echo "active";
                                }
                                    ?>"><a href="<?php echo site_url("admin/email_templates") ?>"> <?php echo lang("ctn_163") ?></a></li>
                                                                        <?php endif; ?>
                    <?php if ($this->user->info->admin || $this->user->info->admin_members): ?>
                    <li class="<?php if (isset($activeLink['admin']['email_members'])) {
                                    echo "active";
                                }
                                    ?>"><a href="<?php echo site_url("admin/email_members") ?>"> <?php echo lang("ctn_164") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin || $this->user->info->admin_payment): ?>
                    <li class="pay1 <?php if (isset($activeLink['admin']['payment_settings'])) {
                                    echo "active";
                                }
                                    ?>"><a href="<?php echo site_url("admin/payment_settings") ?>"> <?php echo lang("ctn_246") ?></a></li>
                    <li class="pay2 <?php if (isset($activeLink['admin']['payment_plans'])) {
                                        echo "active";
                                    }
                                    ?>"><a href="<?php echo site_url("admin/payment_plans") ?>"> <?php echo lang("ctn_258") ?></a></li>
                    <li class="pay3 <?php if (isset($activeLink['admin']['payment_logs'])) {
                                        echo "active";
                                    }
                                    ?>"><a href="<?php echo site_url("admin/payment_logs") ?>"> <?php echo lang("ctn_288") ?></a></li>
                    <li class="pay4 <?php if (isset($activeLink['admin']['premium_users'])) {
                                        echo "active";
                                    }
                                    ?>"><a href="<?php echo site_url("admin/premium_users") ?>"> <?php echo lang("ctn_325") ?></a></li>
                    <?php endif; ?>
-->


                </ul>
            </div>
        </li>
    <?php endif; ?>


    <li class=" " id="capsa_ge">
        <a data-toggle="collapse" data-parent="#capsa_ge" href="#capsa_ge_c" class="collapsed <?php
        if (isset($activeLink['cotizacion']) || isset($activeLink['productos']) || isset($activeLink['proyectos'])) {
            echo "active";
        }
        ?>">
            <span class="glyphicon glyphicon-lock sidebar-icon"></span> <?php echo _l("Operaciones") ?>
            <span class="plus-sidebar"><span class="glyphicon <?php

                if (isset($activeLink['cotizacion']) || isset($activeLink['productos'])): ?>glyphicon-menu-down<?php else: ?>glyphicon-menu-right<?php endif; ?>"></span></span>
        </a>
        <div id="capsa_ge_c"
             class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['proyectos']) || isset($activeLink['cotizacion']) || isset($activeLink['productos'])) {
                 echo "in";
             }
             ?>">
            <ul class="inner-sidebar-links">
                <?php
                _helper_sidebar_link("Cotizaciones", 'cotizacion/index', 'cotizacion', 'index', @$activeLink);
                ?>
            </ul>
        </div>
    </li>


    <!-- fin  base de datos -->
    <?php if (!_is_tutor()): ?>

    <?php endif ?>
    <?php if (_is_tutor()): ?>

    <?php endif ?>


    <?php if (_is_gestor()): ?>

    <?php endif ?>


    <!--

    <li class=" hidden <?php if (isset($activeLink['settings']['general'])) {
        echo "active";
    }
    ?>"><a href="<?php echo site_url("user_settings") ?>"><span class="glyphicon glyphicon-cog sidebar-icon sidebar-icon-pink"></span> <?php echo lang("ctn_156") ?></a></li>
    <?php if ($this->settings->info->payment_enabled): ?>
    <li class="   <?php if (isset($activeLink['funds']['general'])) {
        echo "active";
    }
        ?>"><a href="<?php echo site_url("funds") ?>"><span class="glyphicon glyphicon-piggy-bank sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_245") ?></a></li>
    <li class="  <?php if (isset($activeLink['funds']['plans'])) {
            echo "active";
        }
        ?>"><a href="<?php echo site_url("funds/plans") ?>"><span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-brown"></span> <?php echo lang("ctn_273") ?></a></li>
    <?php endif; ?>
-->

    <!-- capsa config  -->
    <!--
    <li class="   <?php if (isset($activeLink['test']['general'])) {
        echo "active";
    }
    ?>"><a href="<?php echo site_url("test") ?>"><span class="glyphicon glyphicon-heart sidebar-icon sidebar-icon-grey"></span> <?php echo lang("ctn_165") ?></a></li>
-->

    <?php if (_is_admin()): ?>
        <li class=" " id="capsa_sb">
            <a data-toggle="collapse" data-parent="#capsa_sb" href="#capsa_sb_c"
               class="collapsed <?php if (isset($activeLink['config'])) {
                   echo "active";
               }
               ?>">
                <span class="glyphicon glyphicon-lock sidebar-icon"></span> <?php echo _l("Configuración") ?>
                <span class="plus-sidebar"><span
                        class="glyphicon <?php if (isset($activeLink['config'])): ?>glyphicon-menu-down<?php else: ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="capsa_sb_c"
                 class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['config'])) {
                     echo "in";
                 }
                 ?>">
                <ul class="inner-sidebar-links">
                    <?php
                    _helper_sidebar_link("Vehiculos", 'config/vehiculos', 'config', 'vehiculos', @$activeLink);
                    ?>


                </ul>
            </div>
        </li>
    <?php endif; ?>
    <!-- end capsa config -->
    <!--
    <li class="   <?php if (isset($activeLink['test']['general'])) {
        echo "active";
    }
    ?>"><a href="<?php echo site_url("test") ?>"><span class="glyphicon glyphicon-heart sidebar-icon sidebar-icon-grey"></span> <?php echo lang("ctn_165") ?></a></li>



    <li class=" " id="restricted_sb">
      <a data-toggle="collapse" data-parent="#restricted_sb" href="#restricted_sb_c" class="collapsed <?php if (isset($activeLink['restricted'])) {
        echo "active";
    }
    ?>" >
        <span class="glyphicon glyphicon-lock sidebar-icon"></span> <?php echo lang("ctn_166") ?>
        <span class="plus-sidebar"><span class="glyphicon <?php if (isset($activeLink['restricted'])): ?>glyphicon-menu-down<?php else: ?>glyphicon-menu-right<?php endif; ?>"></span></span>
      </a>
      <div id="restricted_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['restricted'])) {
        echo "in";
    }
    ?>">
        <ul class="inner-sidebar-links">
          <li class="<?php if (isset($activeLink['restricted']['general'])) {
        echo "active";
    }
    ?>"><a href="<?php echo site_url("test/restricted_admin") ?>"><span class="glyphicon glyphicon-wrench"></span> <?php echo lang("ctn_167") ?> <span class="sr-only">(current)</span></a></li>
          <li class="<?php if (isset($activeLink['restricted']['groups'])) {
        echo "active";
    }
    ?>"><a href="<?php echo site_url("test/restricted_group") ?>"> <?php echo lang("ctn_168") ?></a></li>
          <li class="<?php if (isset($activeLink['restricted']['users'])) {
        echo "active";
    }
    ?>"><a href="<?php echo site_url("test/restricted_user") ?>"> <?php echo lang("ctn_169") ?></a></li>
          <li class="<?php if (isset($activeLink['restricted']['premium'])) {
        echo "active";
    }
    ?>"><a href="<?php echo site_url("test/restricted_premium") ?>"> <?php echo lang("ctn_289") ?></a></li>
        </ul>
      </div>
    </li>
    -->
</ul>