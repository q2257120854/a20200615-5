{include file="public/head.tpl" hostname='账户充值'}


<div class="container-fluid u-pt-medium">
    <div class="row">
        <!-- Container for main page display content -->
        <div class="page-content col-12">
            <div class="c-card u-mb-medium">
                <div class="c-card__head">
                     <h5 class="c-card__title">{$lang['账户充值']}</h5>

                </div>
                <div class="u-p-medium">
                    <div class="row">
                        <div class="col-sm-8">
                                <div class="row">
                                    
                                    	
                                    <script>
                                        $(function(){
                                           $("#userpay .form-group").css("width","100%") 
                                        });
                                    </script>
                                    
                                    <div class="form-group col-12 u-mb-medium">
                                        <label for="paymentmethod" class="control-label">付款方式:</label>
                                        <input type="hidden" name="paymentmethod">
                                        <ul class="list-unstyled row" id="userpay">
                                            
                                            {$plug['存款支付网关前端']}
                                            
                                            
                                            
                                        </ul>
                                    </div>
                                    <div class="form-group col-12">
                                        <p class="text-success">* 无特殊情况，所有款项概不以现金方式退还.</p>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-4" style="order:-1">
                            <div class="panel" style="margin-top: 26px;">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="textright"><strong>{$mlang['您的剩余预存款']}</strong>
                                            </td>
                                            <td>{$s['登陆预存款']}{$c['交易币名称']}</td>
                                        </tr>
                                        <tr>
                                            <td class="textright"><strong>充值失败联系客服</strong>
                                            </td>
                                            <td>客服QQ：64433676</td>
                                        </tr>
                                        <tr>
                                            <td class="textright"><strong>当前账号UID</strong>
                                            </td>
                                            <td>{$s['登陆UID']}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
            <div menuitemname="Add Funds" class="panel panel-sidebar panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        账户充值
                        <i class="fa fa-chevron-up panel-minimise pull-right minimised"></i>
                    </h3>
                </div>
                <div class="panel-body" style="display: block;">给您的账户增加预存款,这样可以自动支付您的订单.</div>
            </div>
        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /.main-content -->
        
    </div>
</div>
{include file="public/foot.tpl"}