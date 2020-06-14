{include file="public/head.tpl" hostname='创建工单'}

<div class="container-fluid u-pt-medium">
    <div class="page-content col-12">
        <div class="c-card u-mb-medium">
            <div class="c-card__head">
                 <h5 class="c-card__title">创建工单<br/>{$tempsz['工单界面公告']}</h5>
            </div>
            
            <style>
                .lo{
                    margin: 15px;
                }
            </style>
            <div style="margin: 15px">
            <form method="post" action="">

            <p><label for="name">用户名/UID:*</label> <input type="text" class="form-control" name="name" id="name" tabindex="1" placeholder="admin"/></p>
            <p><label for="email">{$lang['电子邮件']}:*</label> <input type="text" class="form-control" name="email" id="email" tabindex="2" placeholder="请输入正确邮箱，否则直接不处理"/></p>
            <p><label for="comments">{$lang['主题']}:*</label> <input type="text" class="form-control" name="subject" id="email" tabindex="2" placeholder="例如：服务器或者主机故障"/></p>
            <p><label for="comments">{$lang['内容']}:*</label> <textarea  class="form-control" name="message" id="comments" cols="12" rows="6" tabindex="3"placeholder="请大概说明原因，为了方便快速处理，请尽量说重点。"></textarea></p>
            <p><input name="submit" type="submit" id="submit" class="btn btn-info" value="{$lang['提交']}" tabindex="4" style="margin-top:10px"/></p>

            </form>
            </div>
            
        </div>
    </div>
</div>{include file="public/foot.tpl"}