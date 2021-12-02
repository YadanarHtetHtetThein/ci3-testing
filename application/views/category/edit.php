<h1>Category Edit Form</h1>
<div class="div">
    <form action="<?php echo base_url('categories/update/'.$data->cat_id); ?>" method="post">
        <div>
            <label for="cat_name">Category name: </label>
            <input type="text" name="cat_name" id="cat_name" value = "<?= $data->cat_name ?>">
            <?php echo form_error('cat_name')? "<small style='color:red'>".form_error('cat_name')."</small>" : ""; ?>
        </div>
        <div>
            <label for="cat_image">Category image: </label>
            <input type="text" name="cat_image" id="cat_image" value="<?= $data->cat_image ?>">
            <?php echo form_error('cat_image')? "<small style='color:red'>".form_error('cat_image')."</small>" : ""; ?>
        </div>
        <div>
            <label for="cat_publish">Category publish: </label>
            <select name="cat_publish" id="cat_publish">
                <option <?= set_select('cat_publish','') ?> value="">Choose option ... </option>
                <option <?= set_select('cat_publish','1') ?> value="1">Publish</option>
                <option <?= set_select('cat_publish','2') ?> value="2">Unpublish</option>
            </select>
            <?php echo form_error('cat_publish')? "<small style='color:red'>".form_error('cat_publish')."</small>" : ""; ?>
        </div>
        <div>
            <button type="submit">Update category</button>
        </div>
    </form>
</div>
<a href="<?= base_url('categories');?>"><button>Back</button></button</a>
