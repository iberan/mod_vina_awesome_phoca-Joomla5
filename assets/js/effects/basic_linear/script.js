/*
# ------------------------------------------------------------------------
# Vina Awesome Slider for Phoca Gallery for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum:    http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

function ws_basic_linear(c,a,b){var d=jQuery;var e=d("<div></div>").css({position:"absolute",display:"none","z-index":2,width:"200%",height:"100%",transform:"translate3d(0,0,0)"}).appendTo(b);this.go=function(f,j){e.stop(1,1);var g=(!!((f-j+1)%a.length)^c.revers?"left":"right");d(a[j]).clone().css({position:"absolute",left:"auto",right:"auto",top:0,width:"50%"}).appendTo(e).css(g,0);d(a[f]).clone().css({position:"absolute",left:"auto",right:"auto",top:0,width:"50%"}).appendTo(e).css(g,"50%").show();e.css({left:"auto",right:"auto",top:0}).css(g,0).show();var h=b.find("ul").hide();var i={};i[g]="-100%";e.animate(i,c.duration,"easeInOutExpo",function(){h.css({left:-f+"00%"}).show();d(this).hide().html("")});return f}};