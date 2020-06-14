	<form class="form-horizontal" method="post">
	
	    <section class="login">

        <div class="row spacing-40">
            <div class="col-sm-12">
                <div class="login-form-panel">
                    <h3 class="badge">{$plang['客户中心 - 重置密码']}</h3>


                    <div class="row">
                        <div class="col-sm-5 center-block">
                            <div class="login-form">
                               
								<input id="code" name="code" type="text"  size="50"placeholder="{$plang['验证码']}" />
								<input id="pass" name="pass" type="password"  size="50"placeholder="{$plang['新密码']}" />
								<input id="repass" name="repass" type="password" size="50" placeholder="{$plang['确认密码']}" />
								<input type="submit" value="{$plang['重置密码']}" />
                               
                            </div>
                        </div>
                    </div> 

                </div>

            </div>

        </div>
    </section>
	</form>