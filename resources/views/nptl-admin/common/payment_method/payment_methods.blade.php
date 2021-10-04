<?php
$edit = SM::check_this_method_access('paymentmethods', 'edit') ? 1 : 0;
$status_update = SM::check_this_method_access('paymentmethods', 'status_update') ? 1 : 0;
$delete = SM::check_this_method_access('paymentmethods', 'destroy') ? 1 : 0;
$per = $edit + $delete;
if ($all_payment_method)
{
$sl = 1;
foreach ($all_payment_method as $payment_method)
{
?>
<tr id="tr_{{$payment_method->id}}">
    <td><?php echo $payment_method->id; ?></td>
    <td><?php echo $payment_method->title; ?></td>
    <td><?php
        if ($payment_method->type == 2) {
            echo "Online Without Card";
        } else if ($payment_method->type == 3) {
            echo "Online With Card";
        } else {
            echo "Offline";
        }
        ?></td>
    <?php if ($status_update != 0): ?>
    <td class="text-center">
        <select class="form-control change_status"
                route="<?php echo config('constant.smAdminSlug'); ?>/paymentmethod_status_update"
                post_id="<?php echo $payment_method->id; ?>">
            <option value="1" <?php
                if ($payment_method->status == 1) {
                    echo 'Selected="Selected"';
                }
                ?>>Published
            </option>
            <option value="2" <?php
                if ($payment_method->status == 2) {
                    echo 'Selected="Selected"';
                }
                ?>>Pending
            </option>
            <option value="3" <?php
                if ($payment_method->status == 3) {
                    echo 'Selected="Selected"';
                }
                ?>>Canceled
            </option>
        </select>
    </td>
    <?php endif; ?>
    <?php if ($per != 0): ?>
    <td class="text-center">
        <?php if ($edit != 0): ?>
        <a href="<?php echo url(config('constant.smAdminSlug') . '/paymentmethods'); ?>/<?php echo $payment_method->id; ?>/edit"
           title="Edit" class="btn btn-xs btn-default" id="">
            <i class="fa fa-pencil"></i>
        </a>
        <?php endif; ?>
        <?php if ($delete != 0): ?>
        <a href="<?php echo url(config('constant.smAdminSlug') . '/paymentmethods/destroy'); ?>/<?php echo $payment_method->id; ?>"
           title="Delete" class="btn btn-xs btn-default delete_data_row"
           delete_message="Are you sure to delete this Payment method?"
           delete_row="tr_{{$payment_method->id}}">
            <i class="fa fa-times"></i>
        </a>
        <?php endif; ?>
    </td>
    <?php endif; ?>
</tr>
<?php
$sl++;
}
}
?>
