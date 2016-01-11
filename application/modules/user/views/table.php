<?php if($users) : ?>

<?php echo form_open(); ?>

<!-- table -->
<div class="row">
    <div class="col-xs-12">

        <table class="table firstIsIcon lastIsIcon">
            <thead>
                <tr>
                    <th><i class="check_all ion ion-checkmark"></i></th>
                    <th class="txtUpper"><?php echo lang('name'); ?></th>
                    <th class="txtUpper"><?php echo lang('email'); ?></th>
                    <th class="txtUpper hidden-xs"><?php echo lang('login'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                    foreach($users as $user)
                    {
                        echo '<tr id="item_' . $user->id . '">' . PHP_EOL;
                            echo '<td>' . PHP_EOL;
                                echo '<label class="checkboxIcon">';
                                    // check
                                    $data = array('name' => 'check_item[' . $user->id . ']', 'id' => 'check_item_' . $user->id, 'class' => 'check_item', 'value' => 1);
                                    echo form_checkbox($data);

                                    echo '<i class="ion ion-checkmark"></i>'. PHP_EOL;
                                    echo '<i class="ion ion-person"></i>'. PHP_EOL;
                                echo '</label>' . PHP_EOL;
                            echo '</td>' . PHP_EOL;

                            // name / type
                            echo '<td>' . PHP_EOL;
                                echo '<div class="txtBig">' . $user->name . '</div>' . PHP_EOL;
                                echo $this->config->item($user->type, 'users_types');
                            echo '</td>' . PHP_EOL;

                            // email
                            echo '<td>' . PHP_EOL;
                                echo $user->email . PHP_EOL;
                            echo '</td>' . PHP_EOL;

                            // login
                            echo '<td class="hidden-xs">' . PHP_EOL;
                                echo $user->login . PHP_EOL;
                            echo '</td>' . PHP_EOL;

                            // options
                            echo '<td>' . PHP_EOL;
                                echo anchor($this->config->item('admin_url') . 'user/edit/' . $user->id, '<i class="ion ion-android-create tableActions-edit"></i>') . PHP_EOL;
                                echo anchor($this->config->item('admin_url') . 'user/delete', '<i class="ion ion-android-delete tableActions-delete"></i>', 'rel="' . $user->id . '" class="deleteRecord" data-confirmMsg="' . lang('confirm_delete_user') . '"') . PHP_EOL;
                            echo '</td>' . PHP_EOL;

                        echo '</tr>' . PHP_EOL;
                    }
                ?>

            </tbody>
        </table>

    </div>
</div>

<!-- margin -->
<div class="clearfix baseMargin-mini"></div>

<!-- table bottom -->
<div class="row tableBottom">
    <div class="col-xs-12 col-sm-4">

        <!-- dropdown actions -->
        <span class="txtUpper"><?php echo lang('checked_items'); ?>:</span>
        <span class="btn-group dropup nuDropdown">
            <span data-toggle="dropdown" class="txtBig hoverLine"><?php echo lang('choose'); ?> <i class="fa fa-angle-up"></i></span>
            <ul class="dropdown-menu">
                <li>
                    <button type="submit" name="action" value="delete_checked"><i class="ion ion-android-delete"></i><?php echo lang('delete'); ?></button>
                </li>
            </ul>
        </span>

    </div>
    <div class="col-xs-12 col-sm-8 text-right">

        <!-- pagination -->
        <nav>
            <?php echo $this->pagination->create_links(); ?>
        </nav>

    </div>
</div>

<?php echo form_close(); ?>

<?php else : ?>

<div class="alert alert-info">
    <?php echo lang('no_users_find'); ?>
</div>

<?php endif; ?>