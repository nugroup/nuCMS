<?php $this->load->view('subnav'); ?>

<!-- margin -->
<div class="clearfix baseMargin"></div>

<!-- page list -->
<div class="container">

    <?php $this->load->view('alerts'); ?>

    <?php echo form_open(current_url(), 'id="users-edit-form" class="form-horizontal"'); ?>

        <!-- margin -->
        <div class="clearfix baseMargin"></div>

        <!-- login -->
        <div class="form-group">
            <label for="login" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('login'); ?></label>
            <div class="col-sm-5">
                <?php echo form_input('login', $user->login, array('class' => 'form-control', 'id' => 'login', 'required' => 'required')); ?>
            </div>
        </div>

        <!-- email -->
        <div class="form-group">
            <label for="email" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('email'); ?></label>
            <div class="col-sm-5">
                <?php echo form_input('email', $user->email, array('type' => 'email', 'class' => 'form-control', 'id' => 'email', 'required' => 'required')); ?>
            </div>
        </div>

        <!-- name -->
        <div class="form-group">
            <label for="name" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('name'); ?></label>
            <div class="col-sm-5">
                <?php echo form_input('name', $user->name, array('class' => 'form-control', 'id' => 'name')); ?>
            </div>
        </div>

        <!-- password -->
        <div class="form-group">
            <label for="password" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('password'); ?></label>
            <div class="col-sm-5">
                <?php echo form_password('password', '', array('class' => 'form-control', 'id' => 'password')); ?>
            </div>
        </div>

        <!-- password_repeat -->
        <div class="form-group">
            <label for="password_repeat" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('password_repeat'); ?></label>
            <div class="col-sm-5">
                <?php echo form_password('password_repeat', '', array('class' => 'form-control', 'id' => 'password_repeat')); ?>
            </div>
        </div>

        <!-- margin -->
        <div class="clearfix baseMargin"></div>

        <!-- buttons -->
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 text-center">
                    <button class="btn btn-save" type="submit"><i class="ion ion-checkmark"></i><?php echo lang('save'); ?></button>
                    <?php
                        echo anchor($this->config->item('admin_url') . 'users/delete', '<i class="ion ion-android-delete tableActions-delete"></i>' . lang('delete'), 'rel="' . $user->id . '" class="btn btn-red btn-margin-left btn-margin-right deleteRecord" data-confirmMsg="' . lang('confirm_delete_user') . '" data-redirectUrl="' . config_item('admin_url') . 'users' . '"') . PHP_EOL;
                    ?>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>

</div>