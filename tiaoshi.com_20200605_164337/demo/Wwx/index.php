<?php
/* *
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */
?>
<?php
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <head>
    <title>客户收款页面</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
      <link rel="stylesheet" href="https://css.letvcdn.com/lc04_yinyue/201612/19/20/00/bootstrap.min.css">
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <link rel="icon" href="/favicon.ico"  type="image/x-icon">
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script>
	.btn {
    display: inline-block;
    padding: 20px 35px;
    margin-bottom: 5px;
    border: 4px solid #ff0400;
    text-transform: uppercase;
    letter-spacing: 0.015em;
    font-size: 25px;
    font-weight: 700;
    line-height: 1;
    color: #ff0400;
    text-decoration: none;
    -webkit-transition: all 0.4s;
    -moz-transition: all 0.4s;
    -o-transition: all 0.4s;
    transition: all 0.4s;
}
    .p>input{display: inline-block !important;}
        </script>
      <script type="text/javascript"> 
</script> 

</head>
<body>
  <br /> 
<br /> 
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-body">
        <form name=alipayment action=epayapi.php method=post target="_blank">
			<div class="input-group">        
                 <hr>
                 <br/>
            <center><div class="input-group">            
              <span class="input-group-addon"></span>
               <input type="hidden" size="30" name="WIDout_trade_no" value="<?php echo date("YmdHis").mt_rand(100,999); ?>" readonly class="form-control" placeholder="商户订单号" required="required"/>
               </div>
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="hidden" size="30" name="WIDsubject" value="客户补款" readonly class="form-control" placeholder="商品名称" required="required" />               
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon"><span>付款金额：</span></span>
              <input size="30" name="WIDtotal_fee" value="" placeholder="输入金额" class="form-control" placeholder="付款金额" required="required"/>                   
            </div> 
<br/><br/>
</center> 
<center>
<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button type="radio" name="type" value="alipay" class="btn btn-primary">支付宝</button>
  </div>
  <div class="btn-group" role="group">
    <button type="radio" name="type" value="qqpay" class="btn btn-success">QQ</button>
  </div>
  <div class="btn-group" role="group">
    <button type="radio" name="type" value="wxpay" class="btn btn-info">微信</button>
  </div>
  </div>
  </br>
  <hr>
  </div>
</div>
</center> </div>
</div>
          </form>
        </div>
      </div>      
    </div>
  </div>
</body>
</html>