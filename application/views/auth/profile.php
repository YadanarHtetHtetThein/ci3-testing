<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<div class="container">
    <div class="col-md-6 offset-md-3">
    <div class="card mt-5">
        <div class="m-3">
            <label for="name">Role</label>
            <p><?= $this->session->userdata('user_role') ?></p>
        </div>
    </div>
</div>
</div>