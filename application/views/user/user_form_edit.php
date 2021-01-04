<section class="box">
      <h1>User
        <small>User Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
      </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Users Data</h3>
            <div class="pull-right">
                <a href="<?= site_url('user')?>" class="btn btn-warning btn-flat">
                <i class="fa  fa-rotate-left"> BACK</i>
                </a>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <!-- <?php echo validation_errors('<div class="error">', '</div>'); ?> -->
                    <form action="" method="post">
                        <div class="form-group <?= form_error('name') ? 'has-error' : null ?>">
                            <label>Nama * </label>
                            <input type="hidden" name="user_id" value="<?= $row->user_id?>">
                            <input type="text" name="name" class="form-control" value="<?= $this->input->post('name') ??  $row->name?>">
                            <?= form_error('name')?>
                        </div>

                        <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                            <label>Username * </label>
                            <input type="text" name="username" class="form-control" value="<?= $this->input->post('username')??  $row->username?>">
                            <?= form_error('username')?>  
                        </div>

                        <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                            <label>password * </label> <small>Jika tidak diubah bisa dikosongkan</small>
                            <input type="password" name="password" class="form-control" value="<?= $this->input->post('password')?>">
                            <?= form_error('password')?>
                        </div>

                        <div class="form-group <?= form_error('passconf') ? 'has-error' : null ?>">
                            <label>Password Confirmation * </label>
                            <input type="password" name="passconf" class="form-control" value="<?= $this->input->post('passconf')?>">
                            <?= form_error('passconf')?>
                        </div>

                        <div class="form-group ">
                            <label>Address * </label>
                            <textarea  name="address" class="form-control" ><?= $this->input->post('address')??  $row->address?></textarea>
                        </div>

                        <div class="form-group <?= form_error('level') ? 'has-error' : null ?>">
                            <label>Level * </label>
                            <select  name="level" class="form-control">
                                <?= $level = $this->input->post('level')? $this->input->post('level') : $row->level?>
                                <option value="1">Admin</option>
                                <option value="2" <?= $level == 2 ? 'selected' :null?>>Kasir</option>
                            </select>
                           <?= form_error('level')?> 
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">
                            <i class="fa fa-paper-plane"></i>Save
                            </button>
                            <button type="reset" class="btn btn-warning btn-flat">
                            <i class="fa fa-trash"></i>Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>

    </div>
</section>