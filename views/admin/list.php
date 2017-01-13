<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
    $(function(){
        if(window.top.$("#current_pos").data('clicknum')==1 || window.top.$("#current_pos").data('clicknum')==null) {
            parent.document.getElementById('display_center_id').style.display='';
            parent.document.getElementById('center_frame').src = '<?= Yii::$app->urlManager->createUrl('admin/tree')?>';
            window.top.$("#current_pos").data('clicknum',0);
        }
    });
</script>
