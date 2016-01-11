<!-- subnav -->
<div class="container-fluid nuSubnav">
    <div class="row">
        <div class="col-xs-12">
            <ul>
                <li><?php echo anchor($this->config->item('admin_url') . 'user', lang('users_list'), ($subnav_active['index']) ? 'class="active"' : ''); ?></li>

                <?php if($this->router->fetch_method() == 'add') : ?>

                <li>
                    <span class="active">
                        <?php
                            echo lang('add_new_user');
                            echo anchor($return_link, '<i class="ion ion-android-close"></i>');
                        ?>
                    </span>
                </li>

                <?php elseif($this->router->fetch_method() == 'edit') : ?>

                <li>
                    <span class="active">
                        <?php
                            echo lang('edit_user');
                            echo anchor($return_link, '<i class="ion ion-android-close"></i>');
                        ?>
                    </span>
                </li>

                <?php else : ?>

                <li><?php echo anchor($this->config->item('admin_url') . 'user/add', lang('add_new_user'), ($subnav_active['add']) ? 'class="active"' : ''); ?>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</div>