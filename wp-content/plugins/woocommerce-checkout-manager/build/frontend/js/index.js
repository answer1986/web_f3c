(()=>{"use strict";var e={n:t=>{var o=t&&t.__esModule?()=>t.default:()=>t;return e.d(o,{a:o}),o},d:(t,o)=>{for(var c in o)e.o(o,c)&&!e.o(t,c)&&Object.defineProperty(t,c,{enumerable:!0,get:o[c]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.jQuery;var o=e.n(t);function c(e){return e.prop("type")?e.prop("type"):e.prop("className")&&e.prop("className").includes("checkbox")?"checkbox":e.prop("className")&&e.prop("className").includes("radio")?"radio":void 0}function a(e){const t=c(e);let o=e.val();return"checkbox"===t&&(o=e.attr("name")&&e.attr("name").includes("[]")||e.prop("className")&&e.prop("className").includes("checkbox")?e.closest(".wooccm-field").find("input:checked").map(((e,t)=>t.value)).toArray():e.is(":checked")),"radio"===t&&(o=e.closest(".wooccm-field").find("input:checked").map(((e,t)=>t.value)).toArray()),o}function n(e,t,i){e.each((function(e,s){const r=o()(s),d=r.data("conditional-parent-value"),l=t==d||o().isArray(t)&&t.includes(d),m=i&&l;r.prop("disabled",!m),r.closest(".wooccm-field").attr("style",`display: ${m?"block":"none"} !important`),m&&r.trigger("country_to_state_changed"),i&&r.trigger("change");let p="";const u=c(r);p="radio"===u?r[0].firstChild.name:"checkbox"===u?s.querySelector('input[type="checkbox"]').name.replace("[]",""):r[0].name&&r[0].name.includes("[]")?r[0].name.replace("[]",""):r[0].name;const _=o()(`*[data-conditional-parent=${p}]`);_.length&&n(_,a(r),m)}))}o()(document).ready((function(e){e(document).on("click",".wooccm_delete_attachment",(function(){const t=e(this).closest("tr"),o=e(this).data("attachment_id");t.hide(),e("#wooccm_order_attachment_update").prop("disabled",!1),e("#delete_attachments_ids").val(e("#delete_attachments_ids").val().replace(o,""))})),e(document).on("click","#wooccm_order_attachment_update",(function(){e.ajax({url:window.wooccm_upload.ajax_url,type:"POST",cache:!1,data:{action:"wooccm_order_attachment_update",nonce:window.wooccm_upload.nonce,delete_attachments_ids:e("#delete_attachments_ids").val(),all_attachments_ids:e("#all_attachments_ids").val()},beforeSend(){e(".wooccm_upload_results").html(window.wooccm_upload.message.saving)},success(t){t.success?(e(".wooccm_upload_results").html(window.wooccm_upload.message.deleted),e("#wooccm_order_attachment_update").prop("disabled",!0)):e(".wooccm_upload_results").html(t.data)}})})),e(document).on("change","#wooccm_order_attachment_upload",(function(){let t=!1,o=e(this).data("order_id");window.FormData&&(t=new FormData);let c,a=0,n=this.files.length;for(;a<n;a++)c=this.files[a],t&&t.append("wooccm_order_attachment_upload[]",c);t&&(t.append("action","wooccm_order_attachment_upload"),t.append("nonce",window.wooccm_upload.nonce),t.append("order_id",o),e.ajax({url:window.wooccm_upload.ajax_url,type:"POST",cache:!1,data:t,processData:!1,contentType:!1,beforeSend(){var t;e(".wooccm_upload_results").html(window.wooccm_upload.message.uploading),function(e){return e.is(".processing")||e.parents(".processing").length}(t=e(".wooccm_order_attachments_wrapper"))||t.addClass("processing").block({message:null,overlayCSS:{background:"#fff",opacity:.6}})},success(t){t.success?(e(".wooccm_order_attachments_wrapper").fadeOut(),e(".wooccm_order_attachments_wrapper").replaceWith(e(t.data).fadeIn()),e(".wooccm_upload_results").html(window.wooccm_upload.message.success)):e(".wooccm_upload_results").html(t.data),e(".wooccm_order_attachments_wrapper").removeClass("processing").unblock()}}))}))})),o()(document).ready((function(e){e(document).on("click",".wooccm_delete_attachment",(function(){const t=e(this).closest("tr"),o=e(this).data("attachment_id");t.hide(),e("#wooccm_customer_attachment_update").prop("disabled",!1);const c=e(this).data("input_id");e("#"+c).val(""),e("#delete_attachments_ids").val(e("#delete_attachments_ids").val().replace(o,""))})),e(document).on("click",'[name="save_address"]:not(.wooccm-prevent-upload-process)',(function(){e.ajax({url:window.wooccm_upload.ajax_url,type:"POST",cache:!1,data:{action:"wooccm_customer_attachment_update",nonce:window.wooccm_upload.nonce,delete_attachments_ids:e("#delete_attachments_ids").val(),all_attachments_ids:e("#all_attachments_ids").val()},beforeSend(){e(".wooccm_upload_results").html(window.wooccm_upload.message.saving)},success(t){t.success?(e(".wooccm_upload_results").html(window.wooccm_upload.message.deleted),e("#wooccm_customer_attachment_update").prop("disabled",!0)):e(".wooccm_upload_results").html(t.data)}})}))})),window.window.selectWoo,function(e){const t=function(e){return e.is(".processing")||e.parents(".processing").length},o=function(e){t(e)||e.addClass("processing").block({message:null,overlayCSS:{background:"#fff",opacity:.6}})},c=function(e){e.removeClass("processing").unblock()};e(document).on("country_to_state_changing",(function(t,o,c){let a=c;const n=e.parseJSON(wc_address_i18n_params.locale_fields);e.each(n,(function(e,t){const c=a.find(t),n=c.find("[data-required]").data("required")||c.find(".wooccm-required-field").length;if(!n)return;const i=JSON.parse(wc_address_i18n_params.locale);!0===(void 0===(i[o]&&i[o][e]&&i[o][e].required)||i[o][e].required)&&function(e,t){t?(e.find("label .optional").remove(),e.addClass("validate-required"),0===e.find("label .required").length&&e.find("label").append('<abbr class="required" title="'+wc_address_i18n_params.i18n_required_text+'">*</abbr>'),e.show(),e.find("input[type=hidden]").prop("type","text")):(e.find("label .required").remove(),e.removeClass("validate-required woocommerce-invalid woocommerce-invalid-required-field"),0===e.find("label .optional").length&&e.find("label").append('<span class="optional">('+wc_address_i18n_params.i18n_optional_text+")</span>"))}(c,n)}))}));const i={};if(e(".wooccm-type-file").each((function(t,o){const c=e(o),a=c.find("[type=file]"),n=c.find(".wooccm-file-button"),s=c.find(".wooccm-file-list"),r=c.find(".wooccm-file-field").data("file-limit"),d=c.find(".wooccm-file-field").data("file-types"),l=1024*parseFloat(c.find(".wooccm-file-field").data("file-max-size"));i[c.attr("id")]=[],n.on("click",(function(e){e.preventDefault(),a.trigger("click")})),s.on("click",".wooccm-file-list-delete",(function(t){const o=e(this).closest(".wooccm-file-file"),a=e(this).closest("[data-file_id]").data("file_id");i[c.attr("id")]=e.grep(i[c.attr("id")],(function(e,t){return t!=a})),o.remove(),e("#order_review").trigger("wooccm_upload")})),a.on("change",(function(t){const o=e(this)[0].files;o.length&&window.FileReader&&e.each(o,(function(t,o){if(s.find("span[data-file_id]").length+t>=r)return alert("Exeeds max files limit of "+r),!1;const a=new FileReader;var n;a.onload=(n=o,function(t){setTimeout((function(){if(n.size>l)return alert(n.name+" exeeds max file size of "+l/1024+"kb"),!0;const a=function(e,t){if(!t?.length)return!0;const o=function(e){return e.name.match(/\.([^\.]+)$/)[1]}(e);return t.filter((e=>!!e.includes(o)||!(!e.includes("|")||!e.split("|").includes(o))||void 0)).length>0}(n,d);if(!a)return alert(n.name+" is not valid file type"),!0;!function(t,o,c,a,n){let i,s=e(t);n.match("image.*")?i="image":n.match("application/ms.*")?(c=wooccm_upload.icons.spreadsheet,i="spreadsheet"):n.match("application/x.*")?(c=wooccm_upload.icons.archive,i="application"):n.match("audio.*")?(c=wooccm_upload.icons.audio,i="audio"):n.match("text.*")?(c=wooccm_upload.icons.text,i="text"):n.match("video.*")?(c=wooccm_upload.icons.video,i="video"):(c=wooccm_upload.icons.interactive,i="interactive");const r='<span data-file_id="'+o+'" title="'+a+'" class="wooccm-file-file">\n                <span class="wooccm-file-list-container">\n                <a title="'+a+'" class="wooccm-file-list-delete">×</a>\n                <span class="wooccm-file-list-image-container">\n                <img class="'+i+'" alt="'+a+'" src="'+c+'"/>\n                </span>\n                </span>\n                </span>';s.append(r).fadeIn()}(s,i[c.attr("id")].push(o)-1,t.target.result,n.name,n.type),e("#order_review").trigger("wooccm_upload")}),200)}),a.readAsDataURL(o)}))}))})),e("#order_review").on("ajaxSuccess wooccm_upload",(function(t,o,c){e(t.target);const a=e("#place_order");e(".wooccm-type-file").length?a.addClass("wooccm-upload-process"):a.removeClass("wooccm-upload-process")})),e(document).on("click","#place_order.wooccm-upload-process",(function(a){a.preventDefault();const n=e("form.checkout"),s=e(this);e(".wooccm-type-file").length&&window.FormData&&Object.keys(i).length&&(t(n)||(s.html(wooccm_upload.message.uploading),o(n)),e.each(i,(function(t,o){const c=e("#"+t),a=c.find(".wooccm-file-field").data("file-limit"),n=(c.find(".wooccm-file-field").data("file-types"),1024*parseFloat(c.find(".wooccm-file-field").data("file-max-size"))),i=c.find(".wooccm-file-field"),s=new FormData;e.each(o,(function(e,t){return e>a?(console.log("Exeeds max files limit of "+a),!1):t.size>n?(console.log("Exeeds max file size of "+a),!0):(console.log("We're ready to upload "+t.name),void s.append("wooccm_checkout_attachment_upload[]",t))})),s.append("action","wooccm_checkout_attachment_upload"),s.append("nonce",wooccm_upload.nonce),e.ajax({async:!1,url:wooccm_upload.ajax_url,type:"POST",cache:!1,data:s,processData:!1,contentType:!1,beforeSend(e){},success(t){t.success?i.val(t.data):e("body").trigger("update_checkout")},complete(e){}})})),c(n),s.removeClass("wooccm-upload-process").trigger("click"))})),e(document).on("click",'[name="save_address"]:not(.wooccm-prevent-upload-process)',(function(a){const n=e("form"),s=e(this);e(".wooccm-type-file").length&&window.FormData&&Object.keys(i).length&&(t(n)||(s.html(wooccm_upload.message.uploading),o(n)),e.each(i,(function(t,o){const c=e("#"+t),a=c.find(".wooccm-file-field").data("file-limit"),n=(c.find(".wooccm-file-field").data("file-types"),1024*parseFloat(c.find(".wooccm-file-field").data("file-max-size"))),i=c.find(".wooccm-file-field"),s=new FormData;e.each(o,(function(e,t){return e>a?(console.log("Exeeds max files limit of "+a),!1):t.size>n?(console.log("Exeeds max file size of "+a),!0):(console.log("We're ready to upload "+t.name),console.log("file: ",t),void s.append("wooccm_checkout_attachment_upload[]",t))})),s.append("action","wooccm_checkout_attachment_upload"),s.append("nonce",wooccm_upload.nonce),e.ajax({async:!1,url:wooccm_upload.ajax_url,type:"POST",cache:!1,data:s,processData:!1,contentType:!1,beforeSend(e){},success(t){t.success?i.val(t.data):e("body").trigger("click")},complete(e){}})})),c(n),s.addClass("wooccm-prevent-upload-process").trigger("click"))})),e(document).on("change",".wooccm-add-price",(function(t){e("body").trigger("update_checkout")})),e(".wooccm-field").on("change keyup wooccm_change","input,textarea,select",(function(t){const o=e(t.target),c=o.attr("name").replace("[]",""),i=a(o),s="hidden"!==o.closest(".wooccm-field").css("visibility");n(e(`*[data-conditional-parent=${c}]`),i,s)})),e(".wooccm-conditional-child").each((function(t,o){const c=e(o),a=e("#"+c.find("[data-conditional-parent]").data("conditional-parent")+"_field"),n=c.find("[data-conditional-parent]");n.length&&("billing_state"!==n.attr("id")&&"billing_state_field"!==n.attr("id")&&"shipping_state"!==n.attr("id")&&"shipping_state_field"!==n.attr("id")||(c.attr("data-conditional-parent",n.data("conditional-parent")),c.attr("data-conditional-parent-value",n.data("conditional-parent-value")))),a.find("select:first").trigger("wooccm_change"),a.find("textarea:first").trigger("wooccm_change"),a.find("input[type=button]:first").trigger("wooccm_change"),a.find("input[type=radio]:checked:first").trigger("wooccm_change"),a.find("input[type=checkbox]:checked:first").trigger("wooccm_change"),a.find("input[type=color]:first").trigger("wooccm_change"),a.find("input[type=date]:first").trigger("wooccm_change"),a.find("input[type=datetime-local]:first").trigger("wooccm_change"),a.find("input[type=email]:first").trigger("wooccm_change"),a.find("input[type=file]:first").trigger("wooccm_change"),a.find("input[type=hidden]:first").trigger("wooccm_change"),a.find("input[type=image]:first").trigger("wooccm_change"),a.find("input[type=month]:first").trigger("wooccm_change"),a.find("input[type=number]:first").trigger("wooccm_change"),a.find("input[type=password]:first").trigger("wooccm_change"),a.find("input[type=range]:first").trigger("wooccm_change"),a.find("input[type=reset]:first").trigger("wooccm_change"),a.find("input[type=search]:first").trigger("wooccm_change"),a.find("input[type=submit]:first").trigger("wooccm_change"),a.find("input[type=tel]:first").trigger("wooccm_change"),a.find("input[type=text]:first").trigger("wooccm_change"),a.find("input[type=time]:first").trigger("wooccm_change"),a.find("input[type=url]:first").trigger("wooccm_change"),a.find("input[type=week]:first").trigger("wooccm_change")})),e(".wooccm-enhanced-datepicker").each((function(t,o){const c=e(this),a=c.data("disable")||!1;e.isFunction(e.fn.datepicker)&&c.datepicker({dateFormat:c.data("formatdate")||"mm/dd/yy",minDate:c.data("mindate"),maxDate:c.data("maxdate"),beforeShowDay(t){const o=null!=t.getDay()&&t.getDay().toString();return a?[-1===e.inArray(o,a)]:[!0]}})})),e(".wooccm-enhanced-timepicker").each((function(t,o){const c=e(this);e.isFunction(e.fn.timepicker)&&(console.log(c.data("format-ampm")),c.timepicker({showPeriodLabels:!!c.data("format-ampm"),showPeriod:!!c.data("format-ampm"),showLeadingZero:!0,hours:c.data("hours")||void 0,minutes:c.data("minutes")||void 0}))})),e(".wooccm-colorpicker-farbtastic").each((function(t,o){const c=e(o),a=c.find("input[type=text]"),n=c.find(".wooccmcolorpicker_container");a.hide(),e.isFunction(e.fn.farbtastic)&&(n.farbtastic("#"+a.attr("id")),n.on("click",(function(e){a.fadeIn()})))})),e(".wooccm-colorpicker-iris").each((function(t,o){const c=e(o),a=c.find("input[type=text]");a.css("background",a.val()),a.on("click",(function(e){c.toggleClass("active")})),a.iris({class:a.attr("id"),palettes:!0,color:"",hide:!1,change(e,t){a.css("background",t.color.toString()).fadeIn()}})})),e(document).on("click",(function(t){0===e(t.target).closest(".iris-picker").length&&e(".wooccm-colorpicker-iris").removeClass("active")})),"undefined"==typeof wc_country_select_params)return!1;if(e().selectWoo){const t=function(){return{language:{errorLoading:()=>wc_country_select_params.i18n_searching,inputTooLong(e){const t=e.input.length-e.maximum;return 1===t?wc_country_select_params.i18n_input_too_long_1:wc_country_select_params.i18n_input_too_long_n.replace("%qty%",t)},inputTooShort(e){const t=e.minimum-e.input.length;return 1===t?wc_country_select_params.i18n_input_too_short_1:wc_country_select_params.i18n_input_too_short_n.replace("%qty%",t)},loadingMore:()=>wc_country_select_params.i18n_load_more,maximumSelected:e=>1===e.maximum?wc_country_select_params.i18n_selection_too_long_1:wc_country_select_params.i18n_selection_too_long_n.replace("%qty%",e.maximum),noResults:()=>wc_country_select_params.i18n_no_matches,searching:()=>wc_country_select_params.i18n_searching}}};e("select.wooccm-enhanced-select").each((function(){const o=e.extend({width:"100%",placeholder:e(this).data("placeholder")||"",allowClear:e(this).data("allowclear")||!1,selectOnClose:e(this).data("selectonclose")||!1,closeOnSelect:e(this).data("closeonselect")||!1,minimumResultsForSearch:e(this).data("search")||-1},t());e(this).on("select2:select",(function(){e(this).focus()})).selectWoo(o)}))}}(jQuery)})();