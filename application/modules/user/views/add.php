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
                <?php echo form_input('login', set_value('login'), array('class' => 'form-control', 'id' => 'login', 'required' => 'required')); ?>
            </div>
        </div>

        <!-- email -->
        <div class="form-group">
            <label for="email" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('email'); ?></label>
            <div class="col-sm-5">
                <?php 
                    $data_email = array('type' => 'email', 'name' => 'email', 'class' => 'form-control', 'id' => 'email', 'required' => 'required', 'value' => set_value('email'));
                    echo form_input($data_email);
                ?>
            </div>
        </div>

        <!-- name -->
        <div class="form-group">
            <label for="name" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('name'); ?></label>
            <div class="col-sm-5">
                <?php echo form_input('name', set_value('name'), array('class' => 'form-control', 'id' => 'name')); ?>
            </div>
        </div>

        <!-- password -->
        <div class="form-group">
            <label for="password" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('password'); ?></label>
            <div class="col-sm-5">
                <?php echo form_password('password', '', array('class' => 'form-control', 'id' => 'password', 'required' => 'required')); ?>
            </div>
        </div>

        <!-- password_repeat -->
        <div class="form-group">
            <label for="password_repeat" class="col-sm-2 col-sm-offset-2 control-label"><?php echo lang('password_repeat'); ?></label>
            <div class="col-sm-5">
                <?php echo form_password('password_repeat', '', array('class' => 'form-control', 'id' => 'password_repeat', 'required' => 'required')); ?>
            </div>
        </div>

        <!-- margin -->
        <div class="clearfix baseMargin"></div>

        <!-- buttons -->
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 text-center">
                    <button class="btn btn-save" type="submit"><i class="ion ion-checkmark"></i><?php echo lang('add'); ?></button>
                </div>
            </div>
        </div>

    <?php echo form_close(); ?>

</div>