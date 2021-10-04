<?php
/**
 * Created by PhpStorm.
 * User: NPTL
 * Date: 1/3/18
 * Time: 5:55 PM
 */
?>
<?php
$create = SM::check_this_method_access('attributetitles', 'create') ? 1 : 0;
$edit = SM::check_this_method_access('attributetitles', 'edit') ? 1 : 0;
$status_update = SM::check_this_method_access('attributetitles', 'status_update') ? 1 : 0;
$delete = SM::check_this_method_access('attributetitles', 'destroy') ? 1 : 0;
$per = $create + $edit + $delete;
if ($all_attributetitle)
{
$sl = 1;
foreach ($all_attributetitle as $attributetitle)
{
?>
<tr id="tr_{{$attributetitle->id}}">
    <td><?php echo $sl; ?></td>
    <td><?php echo $attributetitle->title; ?></td>
    <td>
        <img class="img-blog"
             src="<?php echo SM::sm_get_the_src($attributetitle->image, 45, 45); ?>"
             width="40px" alt="<?php echo $attributetitle->title; ?>"/>
    </td>
    <th>
        @foreach($attributetitle->attributes as $attribute)
            <button type="button" name="view" value="{{ $attribute->id }}"
                    class="btn btn-xs btn-default attribute_data_edit"
                    title="{{ $attribute->title }}">{{ $attribute->title }}
            </button>
            {{--@if (!$loop->last)--}}
            {{--,--}}
            {{--@endif--}}
        @endforeach
        <span id="attribute_value_{{$attributetitle->id}}"></span>

    </th>
    <?php if ($status_update != 0): ?>
    <td class="text-center">
        <select class="form-control change_status"
                route="<?php echo config('constant.smAdminSlug'); ?>/attributetitle_status_update"
                post_id="<?php echo $attributetitle->id; ?>">
            <option value="1" <?php
                if ($attributetitle->status == 1) {
                    echo 'Selected="Selected"';
                }
                ?>>Published
            </option>
            <option value="2" <?php
                if ($attributetitle->status == 2) {
                    echo 'Selected="Selected"';
                }
                ?>>Pending
            </option>
            <option value="3" <?php
                if ($attributetitle->status == 3) {
                    echo 'Selected="Selected"';
                }
                ?>>Canceled
            </option>
        </select>
    </td>
    <?php endif; ?>
    <?php if ($per != 0): ?>
    <td class="text-center">
        <?php if ($create != 0): ?>
        <button type="button" data-attributetitle_id="{{$attributetitle->id}}"
                class="btn btn-xs btn-default addNewAttribute" title="Add Attribute"><i class="fa fa-plus"></i></button>
        <?php endif; ?>

        <?php if ($edit != 0): ?>
        <a href="<?php echo url(config('constant.smAdminSlug') . '/attributetitles'); ?>/<?php echo $attributetitle->id; ?>/edit"
           title="Edit" class="btn btn-xs btn-default" id="">
            <i class="fa fa-pencil"></i>
        </a>
        <?php endif; ?>
        <?php if ($delete != 0): ?>
        <a href="<?php echo url(config('constant.smAdminSlug') . '/attributetitles/destroy'); ?>/<?php echo $attributetitle->id; ?>"
           title="Delete" class="btn btn-xs btn-default delete_data_row"
           delete_message="Are you sure to delete this Category?"
           delete_row="tr_{{$attributetitle->id}}">
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
