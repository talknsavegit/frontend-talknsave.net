function SGPBSubscribers(){}SGPBSubscribers.prototype.init=function(){this.deleteSubscribers(),this.toggleCheckedSubscribers(),this.popupsTableRowColorChange(),this.deleteButtonHideShow(),this.exportSubscribers(),this.modal=new SGPBModals,this.modal.modalInit(),this.subscriberFileUploader(),this.importSubscriber(),this.addSubscribers()},SGPBSubscribers.prototype.deleteSubscribers=function(){var e=[],r=this;jQuery(".sg-subs-delete-button").bind("click",(function(){var s={};s.ajaxNonce=jQuery(this).attr("data-ajaxNonce"),jQuery(".subs-delete-checkbox").each((function(){if(jQuery(this).prop("checked")){var r=jQuery(this).attr("data-delete-id");e.push(r)}})),0===e.length?alert("Please select at least one subscriber."):confirm(SGPB_JS_LOCALIZATION.areYouSure)&&r.deleteSubscribersAjax(e,s)}))},SGPBSubscribers.prototype.subscriberFileUploader=function(){var e,r=jQuery("#js-import-subscriber-button"),s=["text/plain","text/x-csv","text/csv"];if(!r.length)return!1;r.bind("click",(function(r){if(r.preventDefault(),e)return e.open(),!1;(e=wp.media.frames.file_frame=wp.media({titleFF:SGPB_JS_LOCALIZATION.changeSound,button:{text:SGPB_JS_LOCALIZATION.changeSound},library:{type:s},multiple:!1})).on("select",(function(){var r=e.state().get("selection").first().toJSON();-1!==s.indexOf(r.mime)?jQuery("#js-import-subscriber-file-url").val(r.url):alert(SGPB_JS_LOCALIZATION.audioSupportAlertMessage)})),e.open()}))},SGPBSubscribers.prototype.importSubscriber=function(){var e=jQuery(".sgpb-import-subscriber-to-list"),r=this;if(!e.length)return!1;e.bind("click",(function(){jQuery("#pb_validate_csv_import").remove();var s=jQuery(".js-sg-import-list").val(),t=jQuery("#js-import-subscriber-file-url").val();if(t.length){var i={action:"sgpb_import_subscribers",nonce:SGPB_JS_PARAMS.nonce,popupSubscriptionList:s,importListURL:t,beforeSend:function(){e.prop("disabled",!0)}};jQuery.post(ajaxurl,i,(function(s){e.prop("disabled",!1),-1!=s.indexOf("ERROR-")?e.parent().parent().before('<div class="alert alert-danger" id="pb_validate_csv_import"style="padding-bottom:10px;color: red;"><strong>'+s+"</strong></div>"):(r.modal.changeModalContent(jQuery(".sgpb-modal"),jQuery(s),jQuery(".sgpb-modal").data("target")),r.removeAllValuesOnModalDestroy(),r.saveImportValue(),r.disableSelectedValue())}))}}))},SGPBSubscribers.prototype.removeAllValuesOnModalDestroy=function(){jQuery(".sgpb-add-subscriber-input:selected").prop("selected",!1),jQuery(".sgpb-add-subscriber-input").val(""),jQuery("#js-import-subscriber-file-url").val("")},SGPBSubscribers.prototype.disableSelectedValue=function(){var e=jQuery(".sgpb-our-fields-keys");if(!e.length)return!1;e.bind("change",(function(){var e=jQuery(this).val();jQuery('.sgpb-our-fields-keys option[value="'+jQuery(this).attr("data-saved-value")+'"]').removeAttr("disabled"),jQuery(this).attr("data-saved-value",e),jQuery('.sgpb-our-fields-keys option[value="'+e+'"]').not(jQuery(this)).attr("disabled","disabled")}))},SGPBSubscribers.prototype.saveImportValue=function(){jQuery(".sgpb-import-subscriber-to-list");var e={},r={action:"sgpb_save_imported_subscribers",nonce:SGPB_JS_PARAMS.nonce,popupSubscriptionList:jQuery(".sgpb-to-import-popup-id").val(),importListURL:jQuery(".sgpb-imported-file-url").val()};jQuery(".sgpb-save-subscriber").bind("click",(function(){e={},jQuery(".sgpb-our-fields-keys").each((function(){var r=jQuery("option:selected",this).val();r&&(e[r]=jQuery(this).attr("data-index"))})),r.namesMapping=e,r.popupId=jQuery(".sgpb-to-import-popup-id").val(),r.beforeSend=function(){jQuery(".sgpb-save-subscriber").prop("disabled",!0)},jQuery.post(ajaxurl,r,(function(e){window.location.reload(),jQuery(".sgpb-save-subscriber").prop("disabled",!1)}))}))},SGPBSubscribers.prototype.addSubscribers=function(){var e=this;jQuery(".sgpb-add-to-list-js").bind("click",(function(){jQuery(".sgpb-subscription-error").addClass("sg-hide-element"),jQuery(".sgpb-email-error").addClass("sg-hide-element");var r=jQuery(".sgpb-add-subscribers-email").val(),s=jQuery(".sgpb-add-subscribers-first-name").val(),t=jQuery(".sgpb-add-subscribers-last-name").val(),i=[];jQuery(".js-sg-newsletter-forms > option").each((function(){jQuery(this).prop("selected")&&i.push(jQuery(this).val())}));var o=r.search(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);if(!1===jQuery(".js-sg-newsletter-forms > option").is(":checked")&&-1===o)return jQuery(".sgpb-subscription-error").removeClass("sg-hide-element"),void jQuery(".sgpb-email-error").removeClass("sg-hide-element");if(!1!==jQuery(".js-sg-newsletter-forms > option").is(":checked"))if(-1!==o){jQuery(".sgpb-email-error").addClass("sg-hide-element");var u={action:"sgpb_add_subscribers",nonce:SGPB_JS_PARAMS.nonce,firstName:s,lastName:t,email:r,popups:i,beforeSend:function(){jQuery(".js-sgpb-add-spinner").removeClass("sg-hide-element")}};e.addToSubscribersAjax(u)}else jQuery(".sgpb-email-error").removeClass("sg-hide-element");else jQuery(".sgpb-subscription-error").removeClass("sg-hide-element")}))},SGPBSubscribers.prototype.exportSubscribers=function(){var e=this;jQuery("#sgpb-subscription-popup").on("change",(function(){jQuery(".sgpb-subscription-popup-id").val(jQuery(this).val())})),jQuery("#sgpb-subscribers-dates").on("change",(function(){jQuery(".sgpb-subscribers-date").val(jQuery(this).val())})),jQuery(".sgpb-export-subscriber").bind("click",(function(){var r={};for(var s in r["sgpb-subscription-popup-id"]=e.getUrlParameter("sgpb-subscription-popup-id"),r.s=e.getUrlParameter("s"),r["sgpb-subscribers-date"]=e.getUrlParameter("sgpb-subscribers-date"),r.orderby=e.getUrlParameter("orderby"),r.order=e.getUrlParameter("order"),r)void 0!==r[s]&&""!==r[s]&&"&"+s+"="+r[s];window.location.href=SGPB_JS_ADMIN_URL.url+"?action=csv_file"}))},SGPBSubscribers.prototype.getUrlParameter=function(e){for(var r=window.location.search.substring(1).split("&"),s=0;s<r.length;s++){var t=r[s].split("=");if(t[0]==e)return void 0!==t[1]?t[1]:""}},SGPBSubscribers.prototype.addToSubscribersAjax=function(e){jQuery.post(ajaxurl,e,(function(e){"1"!==e?(jQuery(".sgpb-subscriber-adding-error").removeClass("sg-hide-element"),jQuery(".sgpb-subscribers-add-spinner").addClass("sg-hide-element")):location.reload()}))},SGPBSubscribers.prototype.toggleCheckedSubscribers=function(){var e=this;jQuery(".subs-bulk").each((function(){jQuery(this).bind("click",(function(){var r=jQuery(this).prop("checked");e.changeCheckedSubscribers(r)}))}))},SGPBSubscribers.prototype.changeCheckedSubscribers=function(e){jQuery(".subs-delete-checkbox").each((function(){jQuery(this).prop("checked",e),jQuery(".subs-bulk").prop("checked",e),jQuery(".sg-subs-delete-button").removeClass("sgpb-btn-disabled"),e||jQuery(".sg-subs-delete-button").addClass("sgpb-btn-disabled")}))},SGPBSubscribers.prototype.dataImport=function(){var e;jQuery("#js-upload-export-file").click((function(r){r.preventDefault();var s=jQuery(this).attr("data-ajaxNonce");e||(e=wp.media.frames.file_frame=wp.media({titleFF:"Select Export File",button:{text:"Select Export File"},multiple:!1,library:{type:"text/plain"}})).on("select",(function(){var r={action:"import_popups",ajaxNonce:s,attachmentUrl:(attachment=e.state().get("selection").first().toJSON()).url};jQuery(".js-sg-import-gif").removeClass("sg-hide-element"),jQuery.post(ajaxurl,r,(function(e,r){location.reload(),jQuery(".js-sg-import-gif").addClass("sg-hide-element")}))})),e.open()}))},SGPBSubscribers.prototype.deleteSubscribersAjax=function(e){var r={action:"sgpb_subscribers_delete",nonce:SGPB_JS_PARAMS.nonce,subscribersId:e,beforeSend:function(){jQuery(".sgpb-subscribers-remove-spinner").removeClass("sg-hide-element")}};jQuery.post(ajaxurl,r,(function(e){jQuery(".sgpb-subscribers-remove-spinner").addClass("sg-hide-element"),jQuery(".subs-delete-checkbox").prop("checked",""),window.location.reload()}))},SGPBSubscribers.prototype.deleteButtonHideShow=function(){if(!jQuery(".subs-delete-checkbox").length)return!1;jQuery(".subs-delete-checkbox").on("click",(function(){jQuery(".sg-subs-delete-button").removeClass("sgpb-btn-disabled"),jQuery(".subs-delete-checkbox").is(":checked")||jQuery(".sg-subs-delete-button").addClass("sgpb-btn-disabled")}))},SGPBSubscribers.prototype.popupsTableRowColorChange=function(){jQuery("table tr th input").on("change",(function(){this.checked?jQuery(this).parent("th").parent("tr").addClass("sgpb-popups-table-selected-row"):jQuery(this).parent("th").parent("tr").removeClass("sgpb-popups-table-selected-row")})),jQuery("table thead tr td input").on("change",(function(){this.checked?jQuery(this).closest("table").find("tbody tr").addClass("sgpb-popups-table-selected-row"):jQuery(this).closest("table").find("tbody tr").removeClass("sgpb-popups-table-selected-row")}))},jQuery(document).ready((function(){(new SGPBSubscribers).init()}));