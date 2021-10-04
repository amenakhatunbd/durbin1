<?php
$edit = SM::check_this_method_access('shippingmethods', 'edit') ? 1 : 0;
$status_update = SM::check_this_method_access('shippingmethods', 'status_update') ? 1 : 0;
$delete = SM::check_this_method_access('shippingmethods', 'destroy') ? 1 : 0;
$per = $edit + $delete;
if ($all_shipping_method)
{
$sl = 1;
foreach ($all_shipping_method as $shipping_method)
{
?>
<tr id="tr_{{$shipping_method->id}}">
    <td><?php echo $sl; ?></td>
    <td><?php echo $shipping_method->title; ?></td>
    <td><?php echo $shipping_method->charge; ?></td>

    <?php if ($status_update != 0): ?>
    <td class="text-center">
        <select class="form-control change_status"
                route="<?php echo config('constant.smAdminSlug'); ?>/shippingmethod_status_update"
                post_id="<?php echo $shipping_method->id; ?>">
            <option value="1" <?php
                if ($shipping_method->status == 1) {
                    echo 'Selected="Selected"';
                }
                ?>>Published
            </option>
            <option value="2" <?php
                if ($shipping_method->status == 2) {
                    echo 'Selected="Selected"';
                }
                ?>>Pending
            </option>
            <option value="3" <?php
                if ($shipping_method->status == 3) {
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
        <a href="<?php echo url(config('constant.smAdminSlug') . '/shippingmethods'); ?>/<?php echo $shipping_method->id; ?>/edit"
           title="Edit" class="btn btn-xs btn-default" id="">
            <i class="fa fa-pencil"></i>
        </a>
        <?php endif; ?>
        <?php if ($delete != 0): ?>
        <a href="<?php echo url(config('constant.smAdminSlug') . '/shippingmethods/destroy'); ?>/<?php echo $shipping_method->id; ?>"
           title="Delete" class="btn btn-xs btn-default delete_data_row"
           delete_message="Are you sure to delete this Payment method?"
           delete_row="tr_{{$shipping_method->id}}">
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
