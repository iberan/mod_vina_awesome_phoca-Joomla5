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

jQuery.extend(jQuery.easing,{easeInOutSine:function(j,i,b,c,d){return -c/2*(Math.cos(Math.PI*i/d)-1)+b}});function ws_domino(d,b,a){$=jQuery;jQuery.extend(d,{columns:d.columns||5,rows:d.rows||2,centerRow:d.centerRow||2,centerColumn:d.centerColumn||2});var c=$("<div/>").css({position:"absolute",width:"100%",height:"100%",top:"0%",overflow:"hidden",transform:"translate3d(0,0,0)"});c.hide().appendTo(a);var e=a.find("ul");this.go=function(r,q){function s(){c.find("img").stop(1,1);c.hide();c.empty()}s();if(d.fadeOut){e.fadeOut(d.duration)}var h=c.width();var g=c.height();var p=Math.floor(h/d.columns);var n=Math.floor(g/d.rows);var l=h-p*(d.columns-1);var v=g-n*(d.rows-1);function z(j,i){return Math.random()*(i-j+1)+j}var m=[];for(var u=0;u<d.rows;u++){m[u]=[];for(var t=0;t<d.columns;t++){var k=d.duration*(1-Math.abs((d.centerRow*d.centerColumn-u*t)/(2*d.rows*d.columns)));var w=t<d.columns-1?p:l;var f=u<d.rows-1?n:v;m[u][t]=$("<div/>").css({width:w,height:f,position:"absolute",top:u*n,left:t*p,overflow:"hidden"});var y=z(u-2,u+2);var x=z(t-2,t+2);m[u][t].appendTo(c);var A=$(b.get(r)).clone().css({position:"absolute",top:-y*n,left:-x*p,width:h,opacity:0,height:g}).appendTo(m[u][t])}}var o=0;c.show();for(var u=0;u<d.rows;u++){for(var t=0;t<d.columns;t++){m[u][t].find("img").animate({top:-u*n,left:-t*p,opacity:1,deg:d.domino_rotation},{duration:k,easing:"easeInOutSine",complete:function(){o++;if(o==d.rows*d.columns){s();e.stop(1,1);e.css("left",-r*100+"%").show()}}})}}return r}};