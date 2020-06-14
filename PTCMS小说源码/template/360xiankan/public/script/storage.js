function LastRead() {this.bookList="bookList"};
//a 书号, b 章节号, c 书名, d 章节名, e 作者, f 类别
LastRead.prototype = {
	set:function(a,b,c,d,e,f)
	{
		if(!(a&&b&&c&&d&&e&&f)) return;
		var v = a + '#' + b + '#' + c + '#' + d + '#' + e + '#' + f;
		this.setItem(a,v);
		this.setBook(a);
	},

	setItem:function(a,b)
	{
		if(!!window.localStorage){
			localStorage.setItem(a,b);
		} else
		{
			var expireDate=new Date();
		  	var EXPIR_MONTH=30*24*3600*1000;
		  	expireDate.setTime(expireDate.getTime()+12*EXPIR_MONTH)
		  	document.cookie = a+"="+encodeURIComponent(b)+";expires="+expireDate.toGMTString()+"; path=/";
		}
	},
	setBook:function(v){
		var reg=new RegExp("(^|#)"+v);
		var books =	this.getItem(this.bookList);
		if(books==""){
			books=v
			}
		 else{
			 if(books.search(reg)==-1){
				 books+="#"+v
				 }
			 else{
				  books.replace(reg,"#"+v)
				 }
			 }
		this.setItem(this.bookList,books)
	},
	getBook:function(){
		var v=this.getItem(this.bookList)?this.getItem(this.bookList).split("#"):Array();
		var books=Array();
		if(v.length){
			for(var i=0;i<v.length;i++){
				var tem=this.getItem(v[i]).split('#');
				if (tem.length>3)books.push(tem);
				}
			}
		return books
	},
	getItem:function(k){
		var value=""
		var result=""
		if(!!window.localStorage){
			result=window.localStorage.getItem(k);
			 value=result||"";
		}
		else{
			var reg=new RegExp("(^| )"+k+"=([^;]*)(;|\x24)");
			var result=reg.exec(document.cookie);
			if(result){
				value=decodeURIComponent(result[2])||""}
		}
		return value
	},
	remove:function(k){
		this.removeItem(k);
		this.removeBook(k)
	},
	removeBook:function(v){
	    var reg=new RegExp("(^|#)"+v);
		var books=this.getItem(this.bookList);
		if(!books){
			books=""
			}
		 else{
			 if(books.search(reg)!=-1){
			      books=books.replace(reg,"")
				 }
			 }
		this.setItem(this.bookList,books)
	},
	removeItem:function(k){
		if(!!window.localStorage){
		 window.localStorage.removeItem(k);
		}
		else{
			var expireDate=new Date();
			expireDate.setTime(expireDate.getTime()-1000)
			document.cookie=k+"= "+";expires="+expireDate.toGMTString()
		}
	},
};

function loadbooker()
{
	var bookhtml='';
	var lastread = new LastRead;
	var books=lastread.getBook();
	var books=books.reverse();
	html(books);
}

function html(list)
{
	var listhtml = '';
	if(list.length) {
		list.forEach(function(a,b){
			listhtml += '<li class="book-li"><div class="book-layout"><div class="rel"><a href="/info/' + a[0] + '/" class="mybook-to-detail">\
					    <img src="/files/article/image/' + parseInt(a[0]/1000) + '/' + a[0] +'/' + a[0] + 's.jpg" class="book-cover" alt="' + a[2] + '"></a>\
						<a href="/info/' + a[0] + '/" class="book-title-x"> <h4 class="book-title">' + a[2] + '</h4></a></div><div class="mybook-to-goon"><div class="book-title-x"><div class="book-title-r" onclick="case_del('+ a[0] +')">\
					    <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="30"><path d="M731.918024 180.533726 293.285433 180.533726c-40.383364 0-73.105944 32.720216-73.105944 73.102948l0 24.367991 584.843455 0 0-24.367991C805.023968 213.253942 772.302411 180.533726 731.918024 180.533726M604.221575 131.798768l10.756412 76.909647L410.22547 208.708416l10.755389-76.909647L604.221575 131.798768M610.076149 83.063811l-194.947818 0c-20.108791 0-38.813548 16.276708-41.621615 36.217876l-14.254216 101.968369c-2.78453 19.916609 11.399075 36.19434 31.507865 36.19434l243.684773 0c20.107767 0 34.292396-16.276708 31.484328-36.217876l-14.255239-101.968369C648.887651 99.340519 630.183917 83.063811 610.076149 83.063811M744.102007 326.738599 281.100427 326.738599c-26.795347 0-46.761893 21.845541-44.334511 48.544623L276.699007 814.278511c2.402821 26.700105 26.344051 48.544623 53.139398 48.544623l365.527671 0c26.795347 0 50.735553-21.845541 53.139398-48.544623l39.932067-438.995289C790.8639 348.58414 770.897354 326.738599 744.102007 326.738599M415.128331 765.353219l-73.105944 0-24.368989-341.144704 97.473909 0L415.127308 765.353219zM561.339195 765.353219l-97.473909 0L463.865286 424.208515l97.473909 0L561.339195 765.353219zM683.18107 765.353219l-73.105944 0L610.075126 424.208515l97.473909 0L683.18107 765.353219z"></path></svg>\
					    </div> </div><div class="book-meta"><p class="ell"><svg class="icon icon-human" role="img" title="作者"><use xlink:href="#icon-human">\
					    <svg id="icon-human" viewBox="0 0 10 12" width="100%" height="100%"><path d="M6.375 6.683C7.053 5.873 7.5 4.649 7.5 3.6 7.5 2.023 6.462 1 5 1S2.5 2.023 2.5 3.6c0 1.05.447 2.274 1.125 3.083a1 1 0 0 1-.463 1.595C1.79 8.715 1 9.537 1 10.5c0-.106-.036-.165-.012-.147.136.1.39.21.743.308C2.52 10.88 3.675 11 5 11c1.325 0 2.48-.12 3.27-.339.352-.097.606-.208.742-.308.024-.018-.012.04-.012.147 0-.963-.789-1.785-2.162-2.222a1 1 0 0 1-.463-1.595zm1.18.071a5.23 5.23 0 0 1-.414.571c.226.072.444.155.653.25l.306.15C9.222 8.32 10 9.268 10 10.5c0 1-2.239 1.5-5 1.5s-5-.5-5-1.5c0-1.232.778-2.179 1.9-2.775l.306-.15c-.306.15.427-.178.653-.25a5.23 5.23 0 0 1-.414-.57l-.17-.287C1.79 5.59 1.5 4.55 1.5 3.6 1.5 1.39 3.067 0 5 0s3.5 1.39 3.5 3.6c0 .951-.29 1.991-.775 2.868l-.17.286z"></path></svg>\
					    </use></svg> ' + a[4] +' | ' + a[5] +'</p></div></div>\
					    <div class="rel"><a href="/info/'+ a[0] +'/' + a[1] +'.shtml" class="mybook-to-new"><div class="book-meta"><time class="book-meta-r"></time><p class="ell"><i class="dot red"></i>读至：' + a[3] +'</p></div>\
					    </a></div></div></li>';
			
		});
	} else {
		listhtml = '<div class="null">\
						<svg t="1532781563942" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="500" height="500">\
							<path d="M512 0.064C229.184 0.064 0 229.184 0 512 0 794.752 229.184 1024 512 1024s512-229.248 512-512C1024 229.184 794.752 0.064 512 0.064zM512 941.888c-237.376 0-429.76-192.512-429.76-429.824C82.176 274.624 274.56 82.176 512 82.176c237.312 0 429.824 192.448 429.824 429.824C941.824 749.376 749.248 941.888 512 941.888zM308.544 440.832m-94.464 0a1.476 1.476 0 1 0 188.928 0 1.476 1.476 0 1 0-188.928 0ZM715.456 440.832m-94.464 0a1.476 1.476 0 1 0 188.928 0 1.476 1.476 0 1 0-188.928 0ZM364.032 785.856c41.664-30.72 92.416-49.088 147.968-49.088s106.368 18.304 147.968 49.088c17.344 12.992 41.984 9.28 54.912-8.128 12.992-17.472 9.344-42.048-8.064-55.04C652.608 682.24 585.024 657.856 512 657.856c-73.024 0-140.608 24.384-194.88 64.832-17.408 12.992-21.056 37.568-8.128 55.04C321.984 795.136 346.624 798.784 364.032 785.856z" fill="#ed424b"></path>\
						</svg>\
                        阅读记录是空的\
                    </div>';
	}
	document.getElementsByClassName('list-split-1')[0].innerHTML = listhtml;
}
function case_del(a) 
{
	var lastread = new LastRead;
	lastread.remove(a);
	loadbooker();

}