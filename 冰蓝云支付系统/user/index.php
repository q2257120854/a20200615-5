<?php
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title='用户中心';
include './head.php';
?>
<?php
$orders=$DB->query("SELECT count(*) from pay_order WHERE pid={$pid}")->fetchColumn();

$lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
$today=date("Y-m-d").' 00:00:00';
$order_today=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and endtime>='$today'")->fetchColumn();

$order_lastday=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and endtime>='$lastday' and endtime<'$today'")->fetchColumn();

$rs=$DB->query("SELECT * from pay_settle where pid={$pid} and status=1");
$settle_money=0;
$max_settle=0;
$chart='';
$i=0;
while($row = $rs->fetch())
{
	$settle_money+=$row['money'];
	if($row['money']>$max_settle)$max_settle=$row['money'];
	if($i<9)$chart.='['.$i.','.$row['money'].'],';
	$i++;
}
$chart=substr($chart,0,-1);

if($conf['verifytype']==1 && empty($userrow['phone']))$alertinfo='你还没有绑定密保手机，请&nbsp;<a href="userinfo.php" class="btn btn-sm btn-info">尽快绑定</a>';
elseif(empty($userrow['email']))$alertinfo='你还没有绑定密保邮箱，请&nbsp;<a href="userinfo.php" class="btn btn-sm btn-info">尽快绑定</a>';
?>
 <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
		<?php if(($conf['verifytype']==1 && empty($userrow['phone'])) || ($conf['verifytype']==0 && empty($userrow['email']))){?>
		<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
						</button>
						<h4 class="modal-title">提示信息</h4>
					</div>
					<div class="modal-body">
						<?php echo $alertinfo?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>      
        <?php }else{?> <?php }?>

<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">用户中心</h1>
  <small class="text-muted">欢迎使用<?php echo $conf['web_name']?></small>
</div>
<div class="col-md-12">      
<div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <em class="fa fa-bell-o fa-fw"></em>最新公告
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
							<center><iframe width="280" scrolling="no" height="25" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&amp;id=34&amp;icon=1&amp;num=3"></iframe></center>
<div class="list-group-item reed"><marquee scrollamount="8" direction="left" align="Middle" style="font-weight: bold;line-height: 20px;font-size: 20px;color: #FF0000;"><img border="0" width="32" src="http://www.exuanmz.com/images/new.gif">发现网站进行诈骗，虚假发货，直接冻结！如遇到问题可以联系我们的官方客服QQ：570602783，感谢您的使用。</marquee></div>
                                <a class="list-group-item" style="font-weight: bold;color: #FF0000;"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>最新警告，分站以及所有交易网站上面统一留可以联系到的客服联系方式，如果客户联系我们并提供相关截图联系证实客服无人处理，我们将直接退款。</a>
								<a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>禁止接入黄，赌，诈骗，刷Q币，抽奖以及cdk，王者荣耀点券及CDK，发现直接冻结接口，不给于结算，欢迎举报违规用户，核实真实以后有奖励。</a> 
								<a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>提现时间：T+1结算，即今日交易订单将会于明日的下午6点到9点之间进行统一结算。如遇节假日顺延，请留意公告。</a>
								<a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>客服QQ：570602783---有问题请联系我们。</a>
								<a class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>官方结算群：①群：688377185【未满】</a>
								<div class="list-group-item"><span class="pull-right"> </span><em class="fa fa-fw fa-volume-up mr"></em>☆ VIP电影免费看：<a href="http://www.2020web.cn" target="_blank">www.2020web.cn</a> ☆☆☆ 香港永久高防空间：<a href="http://www.5g-yun.com/" target="_blank">www.5g-yun.com</a> ☆ </div>
							
							</div>	
                        </div>
                    </div>
  </div>
<div class="wrapper-md control">
<!-- stats -->
      <div class="row">
        <div class="col-md-5">
          <div class="row row-sm text-center">
            <div class="col-xs-6">
              <div class="panel padder-v item">
                <div class="h1 text-info font-thin h1"><?php echo $orders?>个</div>
                <span class="text-muted text-xs">订单总数</span>
                <div class="top text-right w-full">
                  <i class="fa fa-caret-down text-warning m-r-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="block panel padder-v bg-primary item">
                <span class="text-white font-thin h1 block">￥<?php echo $settle_money?></span>
                <span class="text-muted text-xs">已结算余额</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-caret-down text-muted m-r-sm"></i>
                </span>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="block panel padder-v bg-info item">
                <span class="text-white font-thin h1 block">￥<?php echo $order_today?></span>
                <span class="text-muted text-xs">今日收入</span>
                <span class="top">
                  <i class="fa fa-caret-up text-warning m-l-sm m-r-sm"></i>
                </span>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="panel padder-v item">
                <div class="font-thin h1">￥<?php echo $order_lastday?></div>
                <span class="text-muted text-xs">昨日收入</span>
                <div class="bottom">
                  <i class="fa fa-caret-up text-warning m-l-sm m-r-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-12 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col w-xs v-middle hidden-md">
                  <div ng-init="d3_3=[60,40]" ui-jq="sparkline" ui-options="[60,40], {type:'pie', height:40, sliceColors:['#fad733','#fff']}" class="sparkline inline"></div>
                </div>
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span>￥<?php echo $userrow['money']?></span></div>
                  <span class="text-muted text-xs">商户当前余额</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel wrapper">
            <label class="i-switch bg-warning pull-right" ng-init="showSpline=true">
              <input type="checkbox" ng-model="showSpline">
              <i></i>
            </label>
            <h4 class="font-thin m-t-none m-b text-muted">结算统计表</h4>
            <div ui-jq="plot" ui-refresh="showSpline" ui-options="
              [
                { data: [ <?php echo $chart?> ], label:'结算金额', points: { show: true, radius: 1}, splines: { show: true, tension: 0.4, lineWidth: 1, fill: 0.8 } }
              ], 
              {
                colors: ['#23b7e5', '#7266ba'],
                series: { shadowSize: 3 },
                xaxis:{ font: { color: '#a1a7ac' } },
                yaxis:{ font: { color: '#a1a7ac' }, max:<?php echo ($max_settle+10)?> },
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#dce5ec' },
                tooltip: true,
                tooltipOpts: { content: '结算金额￥%y',  defaultTheme: false, shifts: { x: 10, y: -25 } }
              }
            " style="height:246px" >
            </div>
          </div>
        </div>
      </div>
      <!-- / stats -->
	<div class="panel panel-default">
		<div class="panel-heading font-bold">
			基本资料
		</div>
		<div class="panel-body">
			<form class="form-horizontal devform">
				<div class="form-group">
					<label class="col-sm-2 control-label">商户ID</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" value="<?php echo $pid?>" disabled>
					</div>
				</div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label">商户密钥</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" value="<?php echo $userrow['key']?>" disabled>
					</div>
				</div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label">账号绑定</label>
					<div class="col-sm-9">
					<?php if($conf['quicklogin']==1 && empty($userrow['alipay_uid'])){?>
						<a href="oauth.php?bind=true" class="btn btn-primary btn-sm" target="_blank">绑定支付宝账号 一键登录到本站</a>
					<?php }else if($conf['quicklogin']==1 && !empty($userrow['alipay_uid'])){?>
						已绑定支付宝UID:<?php echo $userrow['alipay_uid']?>&nbsp;<a href="oauth.php?unbind=true" class="btn btn-danger btn-xs" onclick="return confirm('解绑后将无法通过支付宝一键登录，是否确定解绑？');">解绑账号</a>
					<?php }else if($conf['quicklogin']==2 && empty($userrow['qq_uid'])){?>
						<a href="connect.php?bind=true" class="btn btn-primary btn-sm" target="_blank">绑定QQ 一键登录到本站</a>
					<?php }else{?>
						已绑定QQ互联Openid:<?php echo $userrow['qq_uid']?>&nbsp;<a href="connect.php?unbind=true" class="btn btn-danger btn-xs" onclick="return confirm('解绑后将无法通过支付宝一键登录，是否确定解绑？');">解绑账号</a>
					<?php }?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
    </div>
  </div>

<?php include 'foot.php';?>
<script>
$(document).ready(function(){
	<?php if(isset($alertinfo)){?>$('#myModal').modal('show');<?php }?>
});
</script>
