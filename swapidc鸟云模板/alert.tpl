<!-- OneUi For Swapidc  -->

{if $alert['warning'] != ""}
<link href="{$templatedir}/alert/sweetalert.min.css" rel="stylesheet">
<script src="{$templatedir}/alert/sweetalert.min.js"></script>
<script type="text/javascript">
  swal("注意","{$alert['warning']}","error")
</script>	 
{/if}


{if $alert['error'] != ""}
<link href="{$templatedir}/alert/sweetalert.min.css" rel="stylesheet">
<script src="{$templatedir}/alert/sweetalert.min.js"></script>
<script type="text/javascript">
  swal("警告","{$alert['error']}","error")
</script>	 
{/if}


{if $alert['success'] != ""}
<link href="{$templatedir}/alert/sweetalert.min.css" rel="stylesheet">
<script src="{$templatedir}/alert/sweetalert.min.js"></script>
<script type="text/javascript">
  swal("成功","{$alert['success']}","success")
</script>	 
{/if}


{if $alert['info'] != ""}
<link href="{$templatedir}/alert/sweetalert.min.css" rel="stylesheet">
<script src="{$templatedir}/alert/sweetalert.min.js"></script>
<script type="text/javascript">
  swal("抱歉","{$alert['info']}","info")
</script>	 
{/if}

<!-- OneUi For Swapidc   -->