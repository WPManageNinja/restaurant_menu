!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:r})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=0)}([function(e,t,n){n(1),n(2),e.exports=n(3)},function(e,t){({addLoader:function(){var e={loader:jQuery("<div/>",{class:"tr_loader"})};jQuery("body").append(e.loader)},removeLoader:function(){jQuery("body").find(".tr_loader").remove()},fetchItem:function(e){var t=this;this.addLoader(),jQuery.get(tr_menu_vars.get_item_url,{item_id:e}).then(function(e){var t=jQuery("<div/>",{class:"res-modal-holder",html:e});jQuery("body").hide().append(t).fadeIn(100)}).fail(function(e){alert("Something is wrong when loading the content. Please try again")}).always(function(){t.removeLoader()})},initModalClick:function(){var e=this;jQuery(".res_item_modal").on("click",function(t){t.preventDefault();var n=jQuery(this).attr("data-res_menu_id");n&&e.fetchItem(n)}),jQuery(document).on("click",".tr_close",function(){jQuery(".res-modal-holder").fadeOut("300",function(){jQuery(this).remove()}),jQuery("body").css("overflow","scroll")})},documentReady:function(){var e=this;jQuery(document).ready(function(){e.initModalClick()})}}).documentReady()},function(e,t){},function(e,t){}]);