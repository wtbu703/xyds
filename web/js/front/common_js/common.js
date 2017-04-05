   //左侧高度
    function height_change(){
        var a = $("#content_left").height();
        var m = Math.max(
                $("#content_right").height(),
                $("#content_left").height()
            );
        if ((screen.width <= 1024) && (screen.height <= 768))  {
           $(".content_left").height(a);
        }
        else {
            $(".content_left").height(m);
             $(".content_right").height(m);
        }
        $(window).resize(function(){
            window.location.reload(); 
        }); 
    }

    //时间格式转换为 [12-02]
    function time(d){
        var dateday = new Date(d);
        var out =  "[" + (parseInt(dateday.getMonth()) + 1) +"-"+ ((dateday.getDate() > 9) ? dateday.getDate() : "0" + dateday.getDate())+"]";
        return out;
    }

     //返回时间格式为 2011-11-23
    function daytime(d){
        var date = new Date(d);
        var during = date.getFullYear() + "-" + (parseInt(date.getMonth()) + 1) + "-" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate()); 
        return during;
    }

    //返回时间格式 2011年11月23日
    function yeartime(d){
        var date = new Date(d);
        var outyear = date.getFullYear() + "年" + (parseInt(date.getMonth()) + 1) + "月" + ((date.getDate() > 9) ? date.getDate() : "0" + date.getDate())+'日';
        return outyear;
    }

    //转换为纯文本
    function texthtml(b){
        var btn_text = $(b).html();
        return btn_text;
    }

    //获取json长度
    function length(a){
        var jsonLength = a.length;
        return jsonLength;
    }

    //切割数组 
    function split(x){
        var arr = x.split(',');
        return arr;
    }

   