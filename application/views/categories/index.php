<div class="container">
<?php if($this->session->userdata('isUserLoggedIn')): ?>
<a href="<?= base_url('users/logout') ?>"><button>Logout</button></a>
<?php else: ?>
<a href="<?= site_url('login') ?>"><button>Login</button></a>
<a href="<?= site_url('register') ?>"><button>Register</button></a>
<?php endif; ?>
<div>
    <h1>Category List</h1>
    <form action="<?= base_url('categories') ?>">
        <label for="search">Search by name</label>
        <input type="text" name="search_data" id="search_item">
        <button type="Submit">Search</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <td>No</td>
            <td>Category name</td>
            <td>Category publish</td>
            <td>Action</td>
        </tr>
        <?php $count = $this->uri->segment(2) or $count = 0; ?>
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
                        <?php if($this->auth->has_access('edit')): ?>
                        <a href="<?= base_url('categories/edit/'.$item->cat_id); ?>"><button>Edit</button></a>
                        <?php endif; ?>
                        <a href="<?= base_url('categories/detail/'.$item->cat_id); ?>"><button>Detail</button></a>
                        <?php if($this->auth->has_access('edit')): ?>
                        <a href="<?= base_url('categories/delete/'.$item->cat_id); ?>"><button>Delete</button></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" align="center">There is no data!</td>
            </tr>
        <?php endif; ?>
    </table>
    <p><?= $this->pagination->create_links() ?></p>
    <a href="<?= base_url('categories/create/'); ?>"><button>Add New Item</button></a>
</div>
</div>