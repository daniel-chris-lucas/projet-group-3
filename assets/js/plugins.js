// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function noop() {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
/*! Copyright (c) 2010 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.4
 * 
 * Requires: 1.2.2+
 */

/*!
 * jquery.fixedHeaderTable. The jQuery fixedHeaderTable plugin
 *
 * Copyright (c) 2011 Mark Malek
 * http://fixedheadertable.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * http://docs.jquery.com/Plugins/Authoring
 * jQuery authoring guidelines
 *
 * Launch  : October 2009
 * Version : 1.3
 * Released: May 9th, 2011
 *
 * 
 * all CSS sizing (width,height) is done in pixels (px)
 */
(function($){var types=['DOMMouseScroll','mousewheel'];$.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var i=types.length;i;){this.addEventListener(types[--i],handler,false);}}else{this.onmousewheel=handler;}},teardown:function(){if(this.removeEventListener){for(var i=types.length;i;){this.removeEventListener(types[--i],handler,false);}}else{this.onmousewheel=null;}}};$.fn.extend({mousewheel:function(fn){return fn?this.bind("mousewheel",fn):this.trigger("mousewheel");},unmousewheel:function(fn){return this.unbind("mousewheel",fn);}});function handler(event){var orgEvent=event||window.event,args=[].slice.call(arguments,1),delta=0,returnValue=true,deltaX=0,deltaY=0;event=$.event.fix(orgEvent);event.type="mousewheel";if(event.wheelDelta){delta=event.wheelDelta/120;}
if(event.detail){delta=-event.detail/3;}
deltaY=delta;if(orgEvent.axis!==undefined&&orgEvent.axis===orgEvent.HORIZONTAL_AXIS){deltaY=0;deltaX=-1*delta;}
var userAgent=navigator.userAgent.toLowerCase();var wheelDeltaScaleFactor=1;if(jQuery.browser.msie||(jQuery.browser.webkit&&!(/chrome/.test(userAgent)))){wheelDeltaScaleFactor=40;}
if(orgEvent.wheelDeltaY!==undefined){deltaY=orgEvent.wheelDeltaY/120/wheelDeltaScaleFactor;}
if(orgEvent.wheelDeltaX!==undefined){deltaX=-1*orgEvent.wheelDeltaX/120/wheelDeltaScaleFactor;}
args.unshift(event,delta,deltaX,deltaY);return $.event.handle.apply(this,args);}})(jQuery);(function($){$.fn.fixedHeaderTable=function(method){var defaults={width:'100%',height:'100%',themeClass:'fht-default',borderCollapse:true,fixedColumns:0,sortable:false,autoShow:true,footer:false,cloneHeadToFoot:false,autoResize:false,create:null};var settings={};var methods={init:function(options){settings=$.extend({},defaults,options);return this.each(function(){var $self=$(this),self=this;if(helpers._isTable($self)){methods.setup.apply(this,Array.prototype.slice.call(arguments,1));$.isFunction(settings.create)&&settings.create.call(this);}else{$.error('Invalid table mark-up');}});},setup:function(options){var $self=$(this),self=this,$thead=$self.find('thead'),$tfoot=$self.find('tfoot'),$tbody=$self.find('tbody'),$wrapper,$divHead,$divFoot,$divBody,$fixedHeadRow,$temp,tfootHeight=0;settings.includePadding=helpers._isPaddingIncludedWithWidth();settings.scrollbarOffset=helpers._getScrollbarWidth();settings.themeClassName=settings.themeClass;if(settings.width.search('%')>-1){var widthMinusScrollbar=$self.parent().width()-settings.scrollbarOffset;}else{var widthMinusScrollbar=settings.width-settings.scrollbarOffset;}
$self.css({width:widthMinusScrollbar});if(!$self.closest('.fht-table-wrapper').length){$self.addClass('fht-table');$self.wrap('<div class="fht-table-wrapper"></div>');}
$wrapper=$self.closest('.fht-table-wrapper');if(settings.fixedColumns>0&&$wrapper.find('.fht-fixed-column').length==0){$self.wrap('<div class="fht-fixed-body"></div>');var $fixedColumns=$('<div class="fht-fixed-column"></div>').prependTo($wrapper),$fixedBody=$wrapper.find('.fht-fixed-body');}
$wrapper.css({width:settings.width,height:settings.height}).addClass(settings.themeClassName);if(!$self.hasClass('fht-table-init')){$self.wrap('<div class="fht-tbody"></div>');}
$divBody=$self.closest('.fht-tbody');var tableProps=helpers._getTableProps($self);helpers._setupClone($divBody,tableProps.tbody);if(!$self.hasClass('fht-table-init')){if(settings.fixedColumns>0){$divHead=$('<div class="fht-thead"><table class="fht-table"></table></div>').prependTo($fixedBody);}else{$divHead=$('<div class="fht-thead"><table class="fht-table"></table></div>').prependTo($wrapper);}
$thead.clone().appendTo($divHead.find('table'));}else{$divHead=$wrapper.find('div.fht-thead');}
helpers._setupClone($divHead,tableProps.thead);$self.css({'margin-top':-$divHead.outerHeight(true)});if(settings.footer==true){helpers._setupTableFooter($self,self,tableProps);if(!$tfoot.length){$tfoot=$wrapper.find('div.fht-tfoot table');}
tfootHeight=$tfoot.outerHeight(true);}
var tbodyHeight=$wrapper.height()-$thead.outerHeight(true)-tfootHeight-tableProps.border;$divBody.css({'height':tbodyHeight});$self.addClass('fht-table-init');if(typeof(settings.altClass)!=='undefined'){methods.altRows.apply(self);}
if(settings.fixedColumns>0){helpers._setupFixedColumn($self,self,tableProps);}
if(!settings.autoShow){$wrapper.hide();}
helpers._bindScroll($divBody,tableProps);return self;},resize:function(options){var $self=$(this),self=this;return self;},altRows:function(arg1){var $self=$(this),self=this,altClass=(typeof(arg1)!=='undefined')?arg1:settings.altClass;$self.closest('.fht-table-wrapper').find('tbody tr:odd:not(:hidden)').addClass(altClass);},show:function(arg1,arg2,arg3){var $self=$(this),self=this,$wrapper=$self.closest('.fht-table-wrapper');if(typeof(arg1)!=='undefined'&&typeof(arg1)==='number'){$wrapper.show(arg1,function(){$.isFunction(arg2)&&arg2.call(this);});return self;}else if(typeof(arg1)!=='undefined'&&typeof(arg1)==='string'&&typeof(arg2)!=='undefined'&&typeof(arg2)==='number'){$wrapper.show(arg1,arg2,function(){$.isFunction(arg3)&&arg3.call(this);});return self;}
$self.closest('.fht-table-wrapper').show();$.isFunction(arg1)&&arg1.call(this);return self;},hide:function(arg1,arg2,arg3){var $self=$(this),self=this,$wrapper=$self.closest('.fht-table-wrapper');if(typeof(arg1)!=='undefined'&&typeof(arg1)==='number'){$wrapper.hide(arg1,function(){$.isFunction(arg3)&&arg3.call(this);});return self;}else if(typeof(arg1)!=='undefined'&&typeof(arg1)==='string'&&typeof(arg2)!=='undefined'&&typeof(arg2)==='number'){$wrapper.hide(arg1,arg2,function(){$.isFunction(arg3)&&arg3.call(this);});return self;}
$self.closest('.fht-table-wrapper').hide();$.isFunction(arg3)&&arg3.call(this);return self;},destroy:function(){var $self=$(this),self=this,$wrapper=$self.closest('.fht-table-wrapper');$self.insertBefore($wrapper).removeAttr('style').append($wrapper.find('tfoot')).removeClass('fht-table fht-table-init').find('.fht-cell').remove();$wrapper.remove();return self;}}
var helpers={_isTable:function($obj){var $self=$obj,hasTable=$self.is('table'),hasThead=$self.find('thead').length>0,hasTbody=$self.find('tbody').length>0;if(hasTable&&hasThead&&hasTbody){return true;}
return false;},_bindScroll:function($obj,tableProps){var $self=$obj,$wrapper=$self.closest('.fht-table-wrapper'),$thead=$self.siblings('.fht-thead'),$tfoot=$self.siblings('.fht-tfoot');$self.bind('scroll',function(){if(settings.fixedColumns>0){var $fixedColumns=$wrapper.find('.fht-fixed-column');$fixedColumns.find('.fht-tbody table').css({'margin-top':-$self.scrollTop()});}
$thead.find('table').css({'margin-left':-this.scrollLeft});if(settings.cloneHeadToFoot){$tfoot.find('table').css({'margin-left':-this.scrollLeft});}});},_fixHeightWithCss:function($obj,tableProps){if(settings.includePadding){$obj.css({'height':$obj.height()+tableProps.border});}else{$obj.css({'height':$obj.parent().height()+tableProps.border});}},_fixWidthWithCss:function($obj,tableProps,width){if(settings.includePadding){$obj.each(function(index){$(this).css({'width':width==undefined?$(this).width()+tableProps.border:width+tableProps.border});});}else{$obj.each(function(index){$(this).css({'width':width==undefined?$(this).parent().width()+tableProps.border:width+tableProps.border});});}},_setupFixedColumn:function($obj,obj,tableProps){var $self=$obj,self=obj,$wrapper=$self.closest('.fht-table-wrapper'),$fixedBody=$wrapper.find('.fht-fixed-body'),$fixedColumn=$wrapper.find('.fht-fixed-column'),$thead=$('<div class="fht-thead"><table class="fht-table"><thead><tr></tr></thead></table></div>'),$tbody=$('<div class="fht-tbody"><table class="fht-table"><tbody></tbody></table></div>'),$tfoot=$('<div class="fht-tfoot"><table class="fht-table"><thead><tr></tr></thead></table></div>'),$firstThChildren,$firstTdChildren,fixedColumnWidth,fixedBodyWidth=$wrapper.width(),fixedBodyHeight=$fixedBody.find('.fht-tbody').height()-settings.scrollbarOffset,$newRow;$firstThChildren=$fixedBody.find('.fht-thead thead tr th:lt('+settings.fixedColumns+')');fixedColumnWidth=settings.fixedColumns*tableProps.border;$firstThChildren.each(function(index){fixedColumnWidth+=$(this).outerWidth(true);});helpers._fixHeightWithCss($firstThChildren,tableProps);helpers._fixWidthWithCss($firstThChildren,tableProps);var tdWidths=[];$firstThChildren.each(function(index){tdWidths.push($(this).width());});firstTdChildrenSelector='tbody tr td:not(:nth-child(n+'+(settings.fixedColumns+1)+'))';$firstTdChildren=$fixedBody.find(firstTdChildrenSelector).each(function(index){helpers._fixHeightWithCss($(this),tableProps);helpers._fixWidthWithCss($(this),tableProps,tdWidths[index%settings.fixedColumns]);});$thead.appendTo($fixedColumn).find('tr').append($firstThChildren.clone());$tbody.appendTo($fixedColumn).css({'margin-top':-1,'height':fixedBodyHeight+tableProps.border});var $newRow;$firstTdChildren.each(function(index){if(index%settings.fixedColumns==0){$newRow=$('<tr></tr>').appendTo($tbody.find('tbody'));if(settings.altClass&&$(this).parent().hasClass(settings.altClass)){$newRow.addClass(settings.altClass);}}
$(this).clone().appendTo($newRow);});$fixedColumn.css({'height':0,'width':fixedColumnWidth})
var maxTop=$fixedColumn.find('.fht-tbody .fht-table').height()-$fixedColumn.find('.fht-tbody').height();$fixedColumn.find('.fht-table').bind('mousewheel',function(event,delta,deltaX,deltaY){if(deltaY==0)return;var top=parseInt($(this).css('marginTop'),10)+(deltaY>0?120:-120);if(top>0)top=0;if(top<-maxTop)top=-maxTop;$(this).css('marginTop',top);$fixedBody.find('.fht-tbody').scrollTop(-top).scroll();return false;});$fixedBody.css({'width':fixedBodyWidth});if(settings.footer==true||settings.cloneHeadToFoot==true){var $firstTdFootChild=$fixedBody.find('.fht-tfoot thead tr th:lt('+settings.fixedColumns+')');helpers._fixHeightWithCss($firstTdFootChild,tableProps);$tfoot.appendTo($fixedColumn).find('tr').append($firstTdFootChild.clone());$tfoot.css({'top':settings.scrollbarOffset});}},_setupTableFooter:function($obj,obj,tableProps){var $self=$obj,self=obj,$wrapper=$self.closest('.fht-table-wrapper'),$tfoot=$self.find('tfoot'),$divFoot=$wrapper.find('div.fht-tfoot');if(!$divFoot.length){if(settings.fixedColumns>0){$divFoot=$('<div class="fht-tfoot"><table class="fht-table"></table></div>').appendTo($wrapper.find('.fht-fixed-body'));}else{$divFoot=$('<div class="fht-tfoot"><table class="fht-table"></table></div>').appendTo($wrapper);}}
switch(true){case!$tfoot.length&&settings.cloneHeadToFoot==true&&settings.footer==true:var $divHead=$wrapper.find('div.fht-thead');$divFoot.empty();$divHead.find('table').clone().appendTo($divFoot);break;case $tfoot.length&&settings.cloneHeadToFoot==false&&settings.footer==true:$divFoot.find('table').append($tfoot).css({'margin-top':-tableProps.border});helpers._setupClone($divFoot,tableProps.tfoot);break;}},_getTableProps:function($obj){var tableProp={thead:{},tbody:{},tfoot:{},border:0},borderCollapse=1;if(settings.borderCollapse==true){borderCollapse=2;}
tableProp.border=($obj.find('th:first-child').outerWidth()-$obj.find('th:first-child').innerWidth())/borderCollapse;$obj.find('thead tr:first-child th').each(function(index){tableProp.thead[index]=$(this).width()+tableProp.border;});$obj.find('tfoot tr:first-child td').each(function(index){tableProp.tfoot[index]=$(this).width()+tableProp.border;});$obj.find('tbody tr:first-child td').each(function(index){tableProp.tbody[index]=$(this).width()+tableProp.border;});return tableProp;},_setupClone:function($obj,cellArray){var $self=$obj,selector=($self.find('thead').length)?'thead th':($self.find('tfoot').length)?'tfoot td':'tbody td',$cell;$self.find(selector).each(function(index){$cell=($(this).find('div.fht-cell').length)?$(this).find('div.fht-cell'):$('<div class="fht-cell"></div>').appendTo($(this));$cell.css({'width':parseInt(cellArray[index])});if(!$(this).closest('.fht-tbody').length&&$(this).is(':last-child')&&!$(this).closest('.fht-fixed-column').length){var padding=(($(this).innerWidth()-$(this).width())/2)+settings.scrollbarOffset;$(this).css({'padding-right':padding+'px'});}});},_isPaddingIncludedWithWidth:function(){var $obj=$('<table class="fht-table"><tr><td style="padding: 10px; font-size: 10px;">test</td></tr></table>'),defaultHeight,newHeight;$obj.appendTo('body');defaultHeight=$obj.find('td').height();$obj.find('td').css('height',$obj.find('tr').height());newHeight=$obj.find('td').height();$obj.remove();if(defaultHeight!=newHeight){return true;}else{return false;}},_getScrollbarWidth:function(){var scrollbarWidth=0;if(!scrollbarWidth){if($.browser.msie){var $textarea1=$('<textarea cols="10" rows="2"></textarea>').css({position:'absolute',top:-1000,left:-1000}).appendTo('body'),$textarea2=$('<textarea cols="10" rows="2" style="overflow: hidden;"></textarea>').css({position:'absolute',top:-1000,left:-1000}).appendTo('body');scrollbarWidth=$textarea1.width()-$textarea2.width()+2;$textarea1.add($textarea2).remove();}else{var $div=$('<div />').css({width:100,height:100,overflow:'auto',position:'absolute',top:-1000,left:-1000}).prependTo('body').append('<div />').find('div').css({width:'100%',height:200});scrollbarWidth=100-$div.width();$div.parent().remove();}}
return scrollbarWidth;}}
if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}else{$.error('Method "'+method+'" does not exist in fixedHeaderTable plugin!');}};})(jQuery);