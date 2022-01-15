!function(e){var t="iCheck",i="checkbox",a="radio",r="checked",s="unchecked",n="disabled",o="determinate",d="indeterminate",c="update",l="click",u="touchbegin.i touchend.i",h="addClass",p="removeClass",f="label",b="cursor",k=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);function y(e,t,i){var s=e[0],l=/er/.test(i)?d:/bl/.test(i)?n:r,u=i==c?{checked:s.checked,disabled:s.disabled,indeterminate:"true"==e.attr(d)||"false"==e.attr(o)}:s[l];if(/^(ch|di|in)/.test(i)&&!u)g(e,l);else if(/^(un|en|de)/.test(i)&&u)v(e,l);else if(i==c)for(var h in u)u[h]?g(e,h,!0):v(e,h,!0);else t&&"toggle"!=i||(t||e.trigger("ifClicked"),u?s.type!==a&&v(e,l):g(e,l))}function g(i,c,l){var u=i[0],f=i.parent(),k=c==r,y=c==d,g=c==n,C=y?o:k?s:"enabled",A=m(i,C+w(u.type)),H=m(i,c+w(u.type));if(!0!==u[c]){if(!l&&c==r&&u.type==a&&u.name){var j=i.closest("form"),D='input[name="'+u.name+'"]';(D=j.length?j.find(D):e(D)).each((function(){this!==u&&e(this).data(t)&&v(e(this),c)}))}y?(u[c]=!0,u.checked&&v(i,r,"force")):(l||(u[c]=!0),k&&u.indeterminate&&v(i,d,!1)),x(i,k,c,l)}u.disabled&&m(i,b,!0)&&f.find(".iCheck-helper").css(b,"default"),f[h](H||m(i,c)||""),f.attr("role")&&!y&&f.attr("aria-"+(g?n:r),"true"),f[p](A||m(i,C)||"")}function v(e,t,i){var a=e[0],c=e.parent(),l=t==r,u=t==d,f=t==n,k=u?o:l?s:"enabled",y=m(e,k+w(a.type)),g=m(e,t+w(a.type));!1!==a[t]&&(!u&&i&&"force"!=i||(a[t]=!1),x(e,l,k,i)),!a.disabled&&m(e,b,!0)&&c.find(".iCheck-helper").css(b,"pointer"),c[p](g||m(e,t)||""),c.attr("role")&&!u&&c.attr("aria-"+(f?n:r),"false"),c[h](y||m(e,k)||"")}function C(i,a){i.data(t)&&(i.parent().html(i.attr("style",i.data(t).s||"")),a&&i.trigger(a),i.off(".i").unwrap(),e('label[for="'+i[0].id+'"]').add(i.closest(f)).off(".i"))}function m(e,i,a){if(e.data(t))return e.data(t).o[i+(a?"":"Class")]}function w(e){return e.charAt(0).toUpperCase()+e.slice(1)}function x(e,t,i,a){a||(t&&e.trigger("ifToggled"),e.trigger("ifChanged").trigger("if"+w(i)))}e.fn.iCheck=function(s,o){var b='input[type="checkbox"], input[type="radio"]',m=e(),w=function(t){t.each((function(){var t=e(this);m=t.is(b)?m.add(t):m.add(t.find(b))}))};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(s))return s=s.toLowerCase(),w(this),m.each((function(){var t=e(this);"destroy"==s?C(t,"ifDestroyed"):y(t,!0,s),e.isFunction(o)&&o()}));if("object"!=typeof s&&s)return this;var x=e.extend({checkedClass:r,disabledClass:n,indeterminateClass:d,labelHover:!0},s),A=x.handle,H=x.hoverClass||"hover",j=x.focusClass||"focus",D=x.activeClass||"active",P=!!x.labelHover,T=x.labelHoverClass||"hover",F=0|(""+x.increaseArea).replace("%","");return A!=i&&A!=a||(b='input[type="'+A+'"]'),F<-50&&(F=-50),w(this),m.each((function(){var s=e(this);C(s);var n,o=this,d=o.id,b=-F+"%",m=100+2*F+"%",w={position:"absolute",top:b,left:b,display:"block",width:m,height:m,margin:0,padding:0,background:"#fff",border:0,opacity:0},A=k?{position:"absolute",visibility:"hidden"}:F?w:{position:"absolute",opacity:0},I=o.type==i?x.checkboxClass||"icheckbox":x.radioClass||"iradio",L=e('label[for="'+d+'"]').add(s.closest(f)),M=!!x.aria,N="iCheck-"+Math.random().toString(36).substr(2,6),Q='<div class="'+I+'" '+(M?'role="'+o.type+'" ':"");M&&L.each((function(){Q+='aria-labelledby="',this.id?Q+=this.id:(this.id=N,Q+=N),Q+='"'})),Q=s.wrap(Q+"/>").trigger("ifCreated").parent().append(x.insert),n=e('<ins class="iCheck-helper"/>').css(w).appendTo(Q),s.data(t,{o:x,s:s.attr("style")}).css(A),x.inheritClass&&Q[h](o.className||""),x.inheritID&&d&&Q.attr("id","iCheck-"+d),"static"==Q.css("position")&&Q.css("position","relative"),y(s,!0,c),L.length&&L.on("click.i mouseover.i mouseout.i "+u,(function(t){var i=t.type,a=e(this);if(!o.disabled){if(i==l){if(e(t.target).is("a"))return;y(s,!1,!0)}else P&&(/ut|nd/.test(i)?(Q[p](H),a[p](T)):(Q[h](H),a[h](T)));if(!k)return!1;t.stopPropagation()}})),s.on("click.i focus.i blur.i keyup.i keydown.i keypress.i",(function(e){var t=e.type,i=e.keyCode;return t!=l&&("keydown"==t&&32==i?(o.type==a&&o.checked||(o.checked?v(s,r):g(s,r)),!1):void("keyup"==t&&o.type==a?!o.checked&&g(s,r):/us|ur/.test(t)&&Q["blur"==t?p:h](j)))})),n.on("click mousedown mouseup mouseover mouseout "+u,(function(e){var t=e.type,i=/wn|up/.test(t)?D:H;if(!o.disabled){if(t==l?y(s,!1,!0):(/wn|er|in/.test(t)?Q[h](i):Q[p](i+" "+D),L.length&&P&&i==H&&L[/ut|nd/.test(t)?p:h](T)),!k)return!1;e.stopPropagation()}}))}))}}(window.jQuery||window.Zepto);
