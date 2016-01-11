<!-- table top -->
<div class="row tableTop">

    <div class="col-xs-12 col-sm-6 col-sm-push-3">

        <!-- search input -->
        <?php echo form_open(current_url(), 'method="get"'); ?>

            <div class="input-group bigInput">
                <div class="input-group-addon">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <?php
                    $data = array('name' => 'string', 'class' => 'form-control', 'value' => $this->input->get('string'));
                    echo form_input($data);
                ?>
            </div>

        <?php echo form_close(); ?>

    </div>

    <div class="col-xs-6 col-sm-3 col-sm-pull-6">
        <?php // $this->load->view('themes/' . config_item('admin_theme') . '/components/lang_select'); ?>
    </div>

    <div class="col-xs-6 col-sm-3 text-right">
        <?php $this->load->view('themes/' . config_item('admin_theme') . '/components/per_page'); ?>
    </div>

</div>

<!-- margin -->
<div class="clearfix baseMargin"></div>