<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<div class="container">
    <div class="col-md-6 offset-md-3">
        <div class="card mt-5">
            <div class="card-header text-center bg-dark text-white">
                <h5>User Registeration</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('users/store') ?>" method="post">
                    <div class="m-3">
                        <label for="name" class="form-label">Name </label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?= set_value('name') ?>">
                        <?= form_error('name')? "<small class='text-danger' ".form_error('name').'</small>' : ''; ?>
                    </div>
                    <div class="m-3">
                        <label for="email" class="form-label">Email </label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email" value="<?= set_value('email') ?>">
                        <?= form_error('email')? "<small class='text-danger' ".form_error('email').'</small>' : ''; ?>
                    </div>
                    <div class="m-3">
                        <label for="password" class="form-label">Password </label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                        <?= form_error('password')? "<small class='text-danger' ".form_error('password').'</small>' : ''; ?>
                    </div>
                    <div class="m-3">
                        <label for="cpassword" class="form-label">Confirm  Password</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Re-enter your password">
                        <?= form_error('cpassword')? "<small class='text-danger' ".form_error('cpassword').'</small>' : ''; ?>
                    </div>
                    <div class="m-3">
                        <button type="submit" class="btn btn-dark text-white float-right">Register</button>    
                    </div>
                    <div class="m-3">
                        <a href="<?= site_url('login') ?>">You have already account, Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>