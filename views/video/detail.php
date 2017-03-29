<?php
$this->title =  '视频详情';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <?php
                    $sign = $video->sign;
                    if($sign==0){?>
                        <video width = "800" height = "500" controls = "controls"style = "margin:40px 40px;" >
                            <source src = "<?=$video->url?>" >
                        </video >
                    <?}else if($sign==1){?>
                        <embed src="http://player.youku.com/player.php/sid/<?=$video->url?>/v.swf"
                               allowFullScreen="true" quality="high"
                               width="800" height="500" controls="controls" style="margin:40px 40px;"
                               allowScriptAccess="always"
                               type="application/x-shockwave-flash">
                        </embed>
                    <?}?>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('video_detail').close();" />
                </div>
            </div>
    </form>
</div>
