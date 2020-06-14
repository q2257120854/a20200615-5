{include file="public/head.tpl" hostname='修改密码'}
<div class="container-fluid u-pt-medium">
    <div class="row">
        <!-- Container for main page display content -->
        <div class="page-content col-12">
            <div class="c-card u-mb-medium">
                <div class="c-card__head">
                     <h5 class="c-card__title">修改密码</h5>

                </div>
                <div class="u-p-medium">
                    <form class="form-horizontal using-password-strength" method="post" role="form">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-3 control-label">旧密码</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password" id="inputPassword" autocomplete="off">
                            </div>
                        </div>
                        <div id="newPassword1" class="form-group has-feedback">
                            <label for="inputNewpass" class="col-sm-3 control-label">新密码</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="newpassword" id="inputNewpass" autocomplete="off"> <span class="form-control-feedback glyphicon"></span>

                                <br>
                                <div class="progress" style="height: 10px;border-radius: 3px;" id="passwordStrengthBar">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">New Password Rating: 0%</span>

                                    </div>
                                </div>
                                <div class="alert alert-info"> <strong>如何设置一个高强度密码：</strong>
                                    <br>同时使用大小写字符
                                    <br>至少使用括一个符号 (# $ ! % &amp; etc...)
                                    <br>不要用连续性文本</div>
                                <script type="text/javascript">
                                jQuery("#inputNewpass").keyup(function () {
                                    var pwStrengthErrorThreshold = 50;
                                    var pwStrengthWarningThreshold = 75;

                                    var $newPassword1 = jQuery("#newPassword1");
                                    var pw = jQuery("#inputNewpass").val();
                                    var pwlength = (pw.length);
                                    if (pwlength > 5) pwlength = 5;
                                    var numnumeric = pw.replace(/[0-9]/g, "");
                                    var numeric = (pw.length - numnumeric.length);
                                    if (numeric > 3) numeric = 3;
                                    var symbols = pw.replace(/\W/g, "");
                                    var numsymbols = (pw.length - symbols.length);
                                    if (numsymbols > 3) numsymbols = 3;
                                    var numupper = pw.replace(/[A-Z]/g, "");
                                    var upper = (pw.length - numupper.length);
                                    if (upper > 3) upper = 3;
                                    var pwstrength = ((pwlength * 10) - 20) + (numeric * 10) + (numsymbols * 15) + (
                                        upper * 10);
                                    if (pwstrength < 0) pwstrength = 0;
                                    if (pwstrength > 100) pwstrength = 100;

                                    $newPassword1.removeClass('has-error has-warning has-success');
                                    jQuery("#inputNewpass").next('.form-control-feedback').removeClass(
                                        'glyphicon-remove glyphicon-warning-sign glyphicon-ok');
                                    jQuery("#passwordStrengthBar .progress-bar").removeClass(
                                        "progress-bar-danger progress-bar-warning progress-bar-success").css("width",
                                        pwstrength + "%").attr('aria-valuenow', pwstrength);
                                    jQuery("#passwordStrengthBar .progress-bar .sr-only").html('New Password Rating: ' +
                                        pwstrength + '%');
                                    if (pwstrength < pwStrengthErrorThreshold) {
                                        $newPassword1.addClass('has-error');
                                        jQuery("#inputNewpass").next('.form-control-feedback').addClass(
                                            'glyphicon-remove');
                                        jQuery("#passwordStrengthBar .progress-bar").addClass("progress-bar-danger");
                                    } else if (pwstrength < pwStrengthWarningThreshold) {
                                        $newPassword1.addClass('has-warning');
                                        jQuery("#inputNewpass").next('.form-control-feedback').addClass(
                                            'glyphicon-warning-sign');
                                        jQuery("#passwordStrengthBar .progress-bar").addClass("progress-bar-warning");
                                    } else {
                                        $newPassword1.addClass('has-success');
                                        jQuery("#inputNewpass").next('.form-control-feedback').addClass(
                                            'glyphicon-ok');
                                        jQuery("#passwordStrengthBar .progress-bar").addClass("progress-bar-success");
                                    }
                                    validatePassword2();
                                });

                                function validatePassword2() {
                                    var password1 = jQuery("#inputNewpass").val();
                                    var password2 = jQuery("#inputRenewpass").val();
                                    var $newPassword2 = jQuery("#newPassword2");

                                    if (password2 && password1 !== password2) {
                                        $newPassword2.removeClass('has-success').addClass('has-error');
                                        jQuery("#inputRenewpass").next('.form-control-feedback').removeClass(
                                            'glyphicon-ok').addClass('glyphicon-remove');
                                        jQuery("#inputNewPassword2Msg").html('<p class="help-block">密码不匹配</p>');
                                        jQuery('input[type="submit"]').attr('disabled', 'disabled');
                                    } else {
                                        if (password2) {
                                            $newPassword2.removeClass('has-error').addClass('has-success');
                                            jQuery("#inputRenewpass").next('.form-control-feedback').removeClass(
                                                'glyphicon-remove').addClass('glyphicon-ok');
                                            jQuery('.form-group input[type="submit"]').removeAttr('disabled');
                                        } else {
                                            $newPassword2.removeClass('has-error has-success');
                                            jQuery("#inputRenewpass").next('.form-control-feedback').removeClass(
                                                'glyphicon-remove glyphicon-ok');
                                        }
                                        jQuery("#inputNewPassword2Msg").html('');
                                    }
                                }

                                jQuery(document).ready(function () {
                                    jQuery('.form-group input[type="submit"]').attr('disabled', 'disabled');
                                    jQuery("#inputRenewpass").keyup(function () {
                                        validatePassword2();
                                    });
                                });
                                </script>
                            </div>
                        </div>
                        <div id="newPassword2" class="form-group has-feedback">
                            <label for="inputRenewpass" class="col-sm-3 control-label">确认新密码</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="renewpassword" id="inputRenewpass" autocomplete="off"> <span class="form-control-feedback glyphicon"></span>

                                <div id="inputNewPassword2Msg"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <input class="btn btn-primary" type="submit" data-loading-text="{$lang['修改中...']}" value="保存修改" disabled="disabled">
                                <input class="btn btn-default" type="reset" value="取消">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.main-content -->
        <div class="col-3 sidebar" style="display: none">
            <div menuitemname="My Account" class="panel panel-sidebar panel-default panel-actions">
                <div class="panel-heading">
                     <h3 class="panel-title">
                <i class="fa fa-user"></i>&nbsp;                我的账户
                                <i class="fa fa-chevron-up panel-minimise pull-right minimised"></i>
            </h3>

                </div>
                <div class="list-group" style="display: block;"> <a menuitemname="My Details" href="/clientarea.php?action=details" class="list-group-item" id="Primary_Sidebar-My_Account-My_Details">
                                                                                    我的资料
                        </a>
 <a menuitemname="Contacts/Sub-Accounts" href="/clientarea.php?action=contacts" class="list-group-item" id="Primary_Sidebar-My_Account-Contacts_Sub-Accounts">
                                                                                    辅助账户
                        </a>
 <a menuitemname="Change Password" href="/clientarea.php?action=changepw" class="list-group-item active" id="Primary_Sidebar-My_Account-Change_Password">
                                                                                    修改密码
                        </a>
 <a menuitemname="Email History" href="/clientarea.php?action=emails" class="list-group-item" id="Primary_Sidebar-My_Account-Email_History">
                                                                                    邮件存档
                        </a>

                </div>
            </div>
        </div>
    </div>
</div>
{include file="public/foot.tpl"}