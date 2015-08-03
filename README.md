# wssapi
# Simple WebSite Screenshot API

This API is a simple tool to extract and resize webpage screenshots. It uses:

- *PHP* for listening webssite screenshot requests
- [CasperJS](casperjs.org) with [PhantomJS](phantomjs.org) and *Webkit* engine for rendering webpages
- [Sharp](https://github.com/lovell/sharp) with libvips library for resizing screenshots accordingly
- cache feature; screenshots are scraped only once every 100 days by default

## Using [wssapi](http://wssapi.adrianharabula.com)

To fetch a website screenshot use [wssapi.adrianharabula.com](http://wssapi.adrianharabula.com) with these GET parameters:

- `url` specify website URL address  
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com"
```  
or [open example in browser](http://wssapi.adrianharabula.com?url=yahoo.com)
- `vw` specify viewport width (default to 1024px)
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920"
```  
or [open example in browser](http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920)
- `vh` specify viewport height (default to 768px)
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080"
```  
or [open example in browser](http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080)
- `maxHeight` specify max height allowed for the screenshot (defaults to viewport height; use 0 to take a fullpage screenshot)
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080&maxHeight=0"
```  
or [open fullpage screenshot](http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080&maxHeight=0)
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080&maxHeight=200"
```  
or [open 200px height limited screenshot example in browser](http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080&maxHeight=200)
- `r` rezise screenshot to specified width (default 0px; no resize)
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080&r=200"
```  
or [open example in browser](http://wssapi.adrianharabula.com?url=yahoo.com&vw=1920&vh=1080&r=200)
- `paddingTop` add top padding to the screenshot (default 0px)
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com&paddingTop=200"
```   
or [open example in browser](http://wssapi.adrianharabula.com?url=yahoo.com&paddingTop=200)
- `paddingLeft` add left padding to the screenshot (default 0px)
```bash
curl -o ss.jpg "http://wssapi.adrianharabula.com?url=yahoo.com&paddingLeft=200"
```   
or [open example in browser](http://wssapi.adrianharabula.com?url=yahoo.com&paddingLeft=200)
- `download` specify whether to download the screenshot (default is 0; just show the screenshot in the browser)
``` bash
"http://wssapi.adrianharabula.com?url=yahoo.com&download=0"
``` 
[click to just show the screenshot in browser](http://wssapi.adrianharabula.com?url=yahoo.com&download=0)
``` bash
"http://wssapi.adrianharabula.com?url=yahoo.com&download=1"
```  
[click to download screnshot](http://wssapi.adrianharabula.com?url=yahoo.com&download=1)
