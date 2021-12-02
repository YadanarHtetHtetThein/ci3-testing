<?php $count = 0; ?>
<div>
    <h1>Category List</h1>
    <form action="<?= base_url('categories') ?>">
        <label for="search">Search by name</label>
        <input type="text" name="search_data" id="search_item">
        <button type="Submit">Search</button>
    </form>
    <table border = 1>
        <tr>
            <td>No</td>
            <td>Category name</td>
            <td>Category publish</td>
            <td>Action</td>
        </tr>
        
        <?php if(!empty($data)): ?>
            <?php foreach($data as $item): ?>
                <tr>
                    <td><?= ++$count; ?></td>
                    <td><?= $item->cat_name ?></td>
                    <td>
                        <?php if($item->cat_publish == 1): ?>
                        <a href="<?= base_url('categories/publish/'.$item->cat_id); ?>"><button>Yes</button></a>
                        <?php endif; ?>
                        <?php if($item->cat_publish == 2): ?>
                        <a href="<?= base_url('categories/publish/'.$item->cat_id); ?>"><button>No</button></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('categories/edit/'.$item->cat_id); ?>"><button>Edit</button></a>
                        <a href="<?= base_url('categories/detail/'.$item->cat_id); ?>"><button>Detail</button></a>
                        <a href="<?= base_url('categories/delete/'.$item->cat_id); ?>"><button>Delete</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" align="center">There is no data!</td>
            </tr>
        <?php endif; ?>
    </table>
    <a href="<?= base_url('categories/create/'); ?>"><button>Add New Item</button></a>
</div>