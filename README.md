Self-hosted [Meting](https://github.com/metowolf/Meting) API deployed on [Vercel](https://vercel.com/).

1. To deploy php project on vercel you just need a repo being like [this](https://github.com/juicyfx/vercel-examples), vercel automatically rebuilds the project after every update, custom domain will be assigned on the latest version.
2. My replica API (netease only), https://meting.v2beach.cn/api/index?server=netease&type=playlist&id=5001265507 ;origin version, https://api.i-meto.com/meting/api?server=netease&type=playlist&id=5001265507 。
3. vercel的域名都被墙了，但自定义墙内的域名是可以访问的。
4. About Safari: "Fetch API cannot load due to access control checks" or "Failed to load resource: Origin is not allowed by Access-Control-Allow-Origin. Status code: 200" or **CORS relateed error**, check https://vercel.com/guides/how-to-enable-cors#enabling-cors-using-vercel.json .
5. http://localhost/api/index.php?server=netease&type=lyric&id=29567191 只有歌词是直接返回json，音乐和图片需要header跳转。php还是很有趣的。https://www.php.net/manual/zh/

Full error log: access to fetch at 'https://meting.v2beach.cn/api/index?server=netease&type=playlist&id=5001265507' from origin 'https://blog.v2beach.cn' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource. If an opaque response serves your needs, set the request's mode to 'no-cors' to fetch the resource with CORS disabled.