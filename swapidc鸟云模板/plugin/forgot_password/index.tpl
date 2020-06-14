	<form class="form-horizontal" method="post">

 <!-- Login -->
    <section class="login">

        <div class="row spacing-40">
            <div class="col-sm-12">
                <div class="login-form-panel">
                    <h3 class="badge">{$plang['客户中心 - 找回密码']}</h3>


                    <div class="row">
                        <div class="col-sm-5 center-block">
                            <div class="login-form">
                                <form method="post" action="">
                                    <input type="text" name="username" size="40" placeholder="{$plang['用户名或邮箱']}" />
                                    <input class="btn btn-sm btn-block btn-primary" type="submit" value="{$plang['找回密码']}" />
                               
                            </div>
                        </div>
                    </div> </form>
                    <div class="row">
                            <p class="text-center"><a href="/index.php/plugin/forgot_password/mail/">{$plang['您已经有代码?点击这里输入重置密码']}</a></p>

                       
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- End of Login -->

