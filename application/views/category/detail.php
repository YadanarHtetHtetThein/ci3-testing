<h1>Category Information</h1>
<ul>
    <li>Category id: <?= $data->cat_id ?> </li>
    <li>Category name: <?= $data->cat_name ?> </li>
    <li>Category image: <img src="<?php echo base_url('images/'.$data->cat_image); ?>" alt="" width="50px" heigth="50px"></li>
    <li>category publish: <?= ($data->cat_publish==1) ? 'Publish' : 'Unpublish'; ?></li>
    <li>Category added date: <?= $data->added_date ?> </li>
</ul>

<a href="<?= base_url('categories')?>"><button>Back</button></a>