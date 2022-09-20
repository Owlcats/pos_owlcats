<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Change Password</h2>
        </div>
        <div class="col-md-12">
        	<div class="member_card_style">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                        	<div class="col-md-12">
                        		<form method="POST" class="form-control" action="<?=base_url('company_setting/process_change_password')?>">
                        			<div class="form-group">
								        <label class="col-md-4 control-label">Username</label>
								        <div class="col-md-12">
								        	<input type="text" name="username" id="username" class="form-control" value="<?=$username?>" placeholder="Username" readonly="">
								       	</div>
								   	</div>
								   	<div class="form-group">
								        <label class="col-md-4 control-label">Old Password</label>
								        <div class="col-md-12">
								        	<input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password" required>
								       	</div>
								   	</div>
								   	<div class="form-group">
								        <label class="col-md-4 control-label">New Password</label>
								        <div class="col-md-12">
								        	<input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
								       	</div>
								   	</div>
								   	<div class="form-group">
								        <label class="col-md-4 control-label">Re-type New Password</label>
								        <div class="col-md-12">
								        	<input type="password" name="re_password" id="re_password" class="form-control" placeholder="Re-type" required>
								       	</div>
								   	</div>
								   	<div>&nbsp;</div>
                                    <div class="col-md-12 d-flex flex-row-reverse border-top">
                                        <button type="submit" class="btn btn-success float-end"><i class="fas fa-hdd"></i> Simpan</button> &nbsp;
                                        <a href="<?=base_url('company_setting/change_password')?>" class="btn btn-secondary float-end"><i class="fas fa-hand-point-left"></i></i> Kembali</a>
                                    </div>
                        		</form>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>