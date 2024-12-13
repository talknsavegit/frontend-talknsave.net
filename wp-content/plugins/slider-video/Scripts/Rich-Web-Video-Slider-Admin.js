var rw_vs_object = {};
jQuery(document).on("click", ".Rich_Web_VSlider_Upd,.Rich_Web_VSlider_Sav", function(event) {
    event.preventDefault();
    event.stopPropagation();
    var rw_vs_sort_videoes = [];
    jQuery('.Rich_Web_Save_VSlider_Table3 tr').each(function() {
        rw_vs_sort_videoes.push(jQuery(this).attr("data-rwvs-id"));
    });
    if (rw_vs_sort_videoes.length == 0) {
        return false;
    }
    var data = {
        rwvs_nonce: object.rwvs_nonce,
        action: 'Rich_Web_VSlider_Save',
        rw_vs_action: event.target.value,
        rw_vs_id: event.target.value === "Update" ? jQuery("#Rich_Web_VSlider_Update_ID").val() : 0,
        rw_vs_title: jQuery(`input[name="Video_Slider_Title"]`).val(),
        rw_vs_type: jQuery(`select[name="Video_Slider_Type"]`).val(),
        rw_vs_sort_videoes: rw_vs_sort_videoes.toString(),
    };
    for (const [key, value] of Object.entries(rw_vs_object)) {
        for (const [child_key, child_value] of Object.entries(rw_vs_object[`${key}`])) {
            data[`${child_key}_${key}`] = child_value;
        }
    }
    jQuery.post(object.ajaxurl, data, function(response) {
        if (response.success === false) {
            console.log("Not save");
        } else {
            location.reload(true);
        }
    });
});

function RichWeb_Generate_Number() {
    return Math.floor(Math.random() * 10000000);
}

function RichWeb_ReIndex_Table() {
    jQuery('.Rich_Web_Save_VSlider_Table3 tr').each(function(i) {
        jQuery(this).find('td:nth-child(1)').html(i + 1);
    });

}

function RichWeb_Video_Slider_Add(number) {
    jQuery('.Table_Data_VS_Rich_Web1').css('display', 'none');
    jQuery('.RW_Support_btn').css('margin-right', 'auto');
    jQuery('.Rich_Web_VSlider_Add').addClass('Rich_Web_VSlider_AddAnim');
    jQuery('.Table_Data_VS_Rich_Web2').css('display', 'block');
    jQuery('.Rich_Web_VSlider_Sav').addClass('Rich_Web_VSlider_SavAnim');
    jQuery('.Rich_Web_VSlider_Can').addClass('Rich_Web_VSlider_CanAnim');
    jQuery('.Rich_Web_VSlider_ID').html('[Rich_Web_Video id="' + number + '"] <span class="RW_VS_C_TTip" >Copy to clipboard</span>');
    jQuery('.Rich_Web_VSlider_ID_1').html('&lt;?php echo do_shortcode(&apos;[Rich_Web_Video id="' + number + '"]&apos;);?&gt <span class="RW_VS_C_TTip" >Copy to clipboard</span');
    Rich_Web_Video_Slider_Editor();
}

function RichWeb_Video_Slider_Cancel() {
    location.reload();
}

function Rich_Web_Res_VSlider_Vid() {
    jQuery('.Rich_Web_VSlider_Input2').val('');
    jQuery("#Rich_Web_VSlider_ONT").prop("checked", false);
    tinymce.get('Rich_Web_VSlider_Desc').setContent('');
}

function Rich_Web_Upload_Video() {
    var RWIntervId = setInterval(function() {
        var code = jQuery('#Rich_Web_Vid_Src_1').val();
        if (code.indexOf('https://www.youtube.com/') > 0) {
            if (code.indexOf('list') > 0 || code.indexOf('index') > 0) {
                if (code.indexOf('embed') > 0) {
                    var Rich_Web_Codes1 = code.split('[embed]');
                    var Rich_Web_Codes2 = Rich_Web_Codes1[1].split('[/embed]');
                    var Rich_Web_Codes3 = Rich_Web_Codes2[0].split('www.youtube.com/watch?v=');
                    if (Rich_Web_Codes3[1].length != 11) { Rich_Web_Codes3[1] = Rich_Web_Codes3[1].substr(0, 11); }

                    jQuery('#Rich_Web_Vid_Src_2').val('https://www.youtube.com/embed/' + Rich_Web_Codes3[1]);
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Codes3[1] + '/maxresdefault.jpg');
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Codes3[1] + '/hqdefault.jpg');
                    jQuery('#Rich_Web_Vid_Vid_1').val('https://www.youtube.com/watch?v=' + Rich_Web_Codes3[1]);
                    if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                        clearInterval(RWIntervId);
                        jQuery('#Rich_Web_Vid_Src_1').val('');
                    }
                } else {
                    var Rich_Web_Codes1 = code.split('<a href="https://www.youtube.com/');
                    var Rich_Web_Codes2 = Rich_Web_Codes1[1].split("=");
                    var Rich_Web_Code_Src = Rich_Web_Codes2[1].split('&');
                    jQuery('#Rich_Web_Vid_Src_2').val('https://www.youtube.com/embed/' + Rich_Web_Code_Src[0]);
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Code_Src[0] + '/maxresdefault.jpg');
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Code_Src[0] + '/hqdefault.jpg');
                    jQuery('#Rich_Web_Vid_Vid_1').val('https://www.youtube.com/watch?v=' + Rich_Web_Code_Src[0]);
                    if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                        clearInterval(RWIntervId);
                        jQuery('#Rich_Web_Vid_Src_1').val('');
                    }
                }
            } else if (code.indexOf('embed') > 0) {
                var Rich_Web_Codes1 = code.split('[embed]');
                var Rich_Web_Codes2 = Rich_Web_Codes1[1].split('[/embed]');
                if (Rich_Web_Codes2[0].indexOf('watch?') > 0) {
                    var Rich_Web_Codes3 = Rich_Web_Codes2[0].split('=');

                    jQuery('#Rich_Web_Vid_Src_2').val('https://www.youtube.com/embed/' + Rich_Web_Codes3[1]);
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Codes3[1] + '/maxresdefault.jpg');
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Codes3[1] + '/hqdefault.jpg');
                    jQuery('#Rich_Web_Vid_Vid_1').val('https://www.youtube.com/watch?v=' + Rich_Web_Codes3[1]);
                    if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                        clearInterval(RWIntervId);
                        jQuery('#Rich_Web_Vid_Src_1').val('');
                    }
                } else {
                    var Rich_Web_Code_Src = Rich_Web_Codes2[0];
                    var Rich_Web_Im_Src = Rich_Web_Code_Src.split('embed/');

                    jQuery('#Rich_Web_Vid_Src_2').val(Rich_Web_Code_Src);
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Im_Src[1] + '/maxresdefault.jpg');
                    jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Im_Src[1] + '/hqdefault.jpg');
                    jQuery('#Rich_Web_Vid_Vid_1').val('https://www.youtube.com/watch?v=' + Rich_Web_Im_Src[1]);
                    if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                        clearInterval(RWIntervId);
                        jQuery('#Rich_Web_Vid_Src_1').val('');
                    }
                }
            } else {
                var Rich_Web_Codes1 = code.split('<a href="https://www.youtube.com/');
                var Rich_Web_Codes2 = Rich_Web_Codes1[1].split('=');
                if (Rich_Web_Codes2.length >= 5) {
                    var Rich_Web_Code_Src = Rich_Web_Codes2[3].split('&');
                } else {
                    var Rich_Web_Code_Src = Rich_Web_Codes2[1].split('">https://');
                }
                jQuery('#Rich_Web_Vid_Src_2').val('https://www.youtube.com/embed/' + Rich_Web_Code_Src[0]);
                jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Code_Src[0] + '/maxresdefault.jpg');
                jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Code_Src[0] + '/hqdefault.jpg');
                jQuery('#Rich_Web_Vid_Vid_1').val('https://www.youtube.com/watch?v=' + Rich_Web_Code_Src[0]);
                if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                    clearInterval(RWIntervId);
                    jQuery('#Rich_Web_Vid_Src_1').val('');
                }
            }
        } else if (code.indexOf('https://youtu.be/') > 0) {
            if (code.indexOf('embed') > 0) {
                var Rich_Web_Codes1 = code.split('[embed]');
                var Rich_Web_Codes2 = Rich_Web_Codes1[1].split('[/embed]');
                var Rich_Web_Codes3 = Rich_Web_Codes2[0].split('youtu.be/');
                if (Rich_Web_Codes3[1].length != 11) { Rich_Web_Codes3[1] = Rich_Web_Codes3[1].substr(0, 11); }

                jQuery('#Rich_Web_Vid_Src_2').val('https://www.youtube.com/embed/' + Rich_Web_Codes3[1]);
                jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Codes3[1] + '/maxresdefault.jpg');
                jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Codes3[1] + '/hqdefault.jpg');
                jQuery('#Rich_Web_Vid_Vid_1').val('https://www.youtube.com/watch?v=' + Rich_Web_Codes3[1]);
                if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                    clearInterval(RWIntervId);
                    jQuery('#Rich_Web_Vid_Src_1').val('');
                }
            } else {
                var Rich_Web_Codes1 = code.split('<a href="https://youtu.be/');
                var Rich_Web_Code_Src = Rich_Web_Code_Src[1].split('">https://');
                if (Rich_Web_Code_Src[0].length != 11) { Rich_Web_Code_Src[0] = Rich_Web_Code_Src[0].substr(0, 11); }
                jQuery('#Rich_Web_Vid_Src_2').val('https://www.youtube.com/embed/' + Rich_Web_Code_Src[0]);
                jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Code_Src[0] + '/maxresdefault.jpg');
                jQuery('#Rich_Web_Vid_ImSrc_2').val('https://img.youtube.com/vi/' + Rich_Web_Code_Src[0] + '/hqdefault.jpg');
                jQuery('#Rich_Web_Vid_Vid_1').val('https://www.youtube.com/watch?v=' + Rich_Web_Code_Src[0]);
                if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                    clearInterval(RWIntervId);
                    jQuery('#Rich_Web_Vid_Src_1').val('');
                }
            }
        } else if (code.indexOf('https://player.vimeo.com/') > 0) {
            var s1 = code.split('[embed]');
            var src = s1[1].split('[/embed]')[0];
            jQuery('#Rich_Web_Vid_Vid_1').val(src);
            jQuery('#Rich_Web_Vid_Src_2').val(src);
            jQuery.ajax({
                type: 'GET',
                url: 'https://vimeo.com/api/oembed.json?url=' + src,
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function(data) {
                    jQuery('#Rich_Web_Vid_ImSrc_2').val(data.thumbnail_url);
                    if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                        clearInterval(RWIntervId);
                        jQuery('#Rich_Web_Vid_Src_1').val('');
                    }
                }
            });

        } else if (code.indexOf('vimeo.com') > 0) {
            if (code.indexOf('embed') > 0) {
                var Rich_Web_Codes1 = code.split('[embed]https://vimeo.com/');
                var Rich_Web_Code_Src = Rich_Web_Codes1[1].split('[/embed]')[0].split('/');
                jQuery('#Rich_Web_Vid_Vid_1').val('https://vimeo.com/' + Rich_Web_Code_Src[0]);
                if (Rich_Web_Code_Src[0].length > 9) {
                    var Real_Rich_Web_Code_Src = Rich_Web_Code_Src[0].split('/');
                    Rich_Web_Code_Src[0] = Real_Rich_Web_Code_Src[2];
                }
                jQuery('#Rich_Web_Vid_Src_2').val('https://player.vimeo.com/video/' + Rich_Web_Code_Src[0]);

                jQuery.ajax({
                    type: 'GET',
                    url: 'https://vimeo.com/api/oembed.json?url=https://player.vimeo.com/video/' + Rich_Web_Code_Src[0],
                    jsonp: 'callback',
                    dataType: 'jsonp',
                    success: function(data) {
                        jQuery('#Rich_Web_Vid_ImSrc_2').val(data.thumbnail_url);
                        if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                            clearInterval(RWIntervId);
                            jQuery('#Rich_Web_Vid_Src_1').val('');
                        }

                    }
                });


            } else if (code.indexOf('player') > 0) {
                var Rich_Web_Codes1 = code.split('<a href="https://player.vimeo.com/video/');
                var Rich_Web_Code_Src = Rich_Web_Codes1[1].split('">https://');
                jQuery('#Rich_Web_Vid_Vid_1').val('https://vimeo.com/' + Rich_Web_Code_Src[0]);
                if (Rich_Web_Code_Src[0].length > 9) {
                    var Real_Rich_Web_Code_Src = Rich_Web_Code_Src[0].split('/');
                    Rich_Web_Code_Src[0] = Real_Rich_Web_Code_Src[2];
                }
                jQuery('#Rich_Web_Vid_Src_2').val('https://player.vimeo.com/video/' + Rich_Web_Code_Src[0]);

                var data = {
                    rwvs_nonce: object.rwvs_nonce,
                    action: 'Rich_Web_VSlider_Vimeo',
                    foobar: 'https://player.vimeo.com/video/' + Rich_Web_Code_Src[0],
                };
                jQuery.post(object.ajaxurl, data, function(response) {
                    if (response.success === false) {
                        location.reload(true);
                    }

                    jQuery('#Rich_Web_Vid_ImSrc_2').val(response.data);
                    if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                        clearInterval(RWIntervId);
                        jQuery('#Rich_Web_Vid_Src_1').val('');
                    }
                });
            } else {
                var Rich_Web_Codes1 = code.split('<a href="https://vimeo.com/');
                var Rich_Web_Code_Src = Rich_Web_Codes1[1].split('">https://');
                jQuery('#Rich_Web_Vid_Vid_1').val('https://vimeo.com/' + Rich_Web_Code_Src[0]);
                if (Rich_Web_Code_Src[0].length > 9) {
                    var Real_Rich_Web_Code_Src = Rich_Web_Code_Src[0].split('/');
                    Rich_Web_Code_Src[0] = Real_Rich_Web_Code_Src[2];
                }
                jQuery('#Rich_Web_Vid_Src_2').val('https://player.vimeo.com/video/' + Rich_Web_Code_Src[0]);

                var data = {
                    rwvs_nonce: object.rwvs_nonce,
                    action: 'Rich_Web_VSlider_Vimeo',
                    foobar: 'https://player.vimeo.com/video/' + Rich_Web_Code_Src[0],
                };
                jQuery.post(object.ajaxurl, data, function(response) {
                    if (response.success === false) {
                        location.reload(true);
                    }
                    jQuery('#Rich_Web_Vid_ImSrc_2').val(response.data);
                    if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                        clearInterval(RWIntervId);
                        jQuery('#Rich_Web_Vid_Src_1').val('');
                    }
                });
            }
        } else if (code.indexOf('.mp4') > 0) {
            if (code.indexOf('embed') > 0) {
                var Rich_Web_Codes1 = code.split('[embed]');
                var Rich_Web_Code_Src = Rich_Web_Codes1[1].split('[/embed]');
                jQuery('#Rich_Web_Vid_Vid_1').val(Rich_Web_Code_Src[0]);
                jQuery('#Rich_Web_Vid_Src_2').val(Rich_Web_Code_Src[0]);
                if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                    clearInterval(RWIntervId);
                    jQuery('#Rich_Web_Vid_Src_1').val('');
                }
            } else if (code.indexOf('video') > 0) {
                var Rich_Web_Codes1 = code.split('mp4="');
                var Rich_Web_Code_Src = Rich_Web_Codes1[1].split('"]');
                jQuery('#Rich_Web_Vid_Vid_1').val(Rich_Web_Code_Src[0]);
                jQuery('#Rich_Web_Vid_Src_2').val(Rich_Web_Code_Src[0]);
                if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                    clearInterval(RWIntervId);
                    jQuery('#Rich_Web_Vid_Src_1').val('');
                }
            } else {
                var Rich_Web_Codes1 = code.split('<a href="');
                var Rich_Web_Code_Src = Rich_Web_Codes1[1].split('">');
                jQuery('#Rich_Web_Vid_Vid_1').val(Rich_Web_Code_Src[0]);
                jQuery('#Rich_Web_Vid_Src_2').val(Rich_Web_Code_Src[0]);
                if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                    clearInterval(RWIntervId);
                    jQuery('#Rich_Web_Vid_Src_1').val('');
                }
            }
        } else if (code.indexOf('vevo.com') > 0) {
            var Rich_Web_Codes1 = code.split('<a href="');
            var Rich_Web_Code_Src = Rich_Web_Codes1[1].split('">');
            var Rich_Web_Code_Src1 = Rich_Web_Code_Src[0].split('/');
            jQuery('#Rich_Web_Vid_Src_2').val('https://cache.vevo.com/assets/html/embed.html?video=' + Rich_Web_Code_Src1[Rich_Web_Code_Src1.length - 1] + '&autoplay=1');
            jQuery('#Rich_Web_Vid_Vid_1').val('https://cache.vevo.com/assets/html/embed.html?video=' + Rich_Web_Code_Src1[Rich_Web_Code_Src1.length - 1] + '&autoplay=1');
            if (jQuery('#Rich_Web_Vid_Src_2').val().length > 0) {
                clearInterval(RWIntervId);
                jQuery('#Rich_Web_Vid_Src_1').val('');
            }
        }
    }, 100)
}

function Rich_Web_Upload_Image() {
    var RWIntervId = setInterval(function() {
        var code = jQuery('#Rich_Web_Vid_ImSrc_1').val();
        if (code.indexOf('img') > 0) {
            var s = code.split('src="');
            var src = s[1].split('"');
            jQuery('#Rich_Web_Vid_ImSrc_2').val(src[0]);
            if (jQuery('#Rich_Web_Vid_ImSrc_2').val().length > 0) {
                jQuery('#Rich_Web_Vid_ImSrc_1').val('');
                clearInterval(RWIntervId);
            }
        }
    }, 100);
}

function Rich_Web_Sav_VSlider_Vid() {
    if (!jQuery('#Rich_Web_Vid_Src_2').val()) {
        jQuery('#Rich_Web_Vid_Src_2').after('<div class="RW_VS_Name_ErrorAl ">This field is required</div>').addClass('RW_VS_InputError');
        return false;
    } else {
        if (jQuery('.RW_VS_Name_ErrorAl').length) {
            jQuery('.RW_VS_Name_ErrorAl').remove();
            jQuery('#Rich_Web_Vid_Src_2').removeClass('RW_VS_InputError');
        }
    }
    var RW_VS_Random_Number = RichWeb_Generate_Number();
    rw_vs_object[`${RW_VS_Random_Number}`] = {};
    Object.assign(rw_vs_object[`${RW_VS_Random_Number}`], {
        Rich_Web_VSldier_Add_Img: jQuery('#Rich_Web_Vid_ImSrc_2').val(),
        Rich_Web_VSldier_Add_Link: jQuery('#Rich_Web_VSlider_Link').val(),
        Rich_Web_VSldier_Add_ONT: jQuery('#Rich_Web_VSlider_ONT').is(":checked") === true ? "checked" : "false",
        Rich_Web_VSldier_Add_Src: jQuery('#Rich_Web_Vid_Src_2').val(),
        Rich_Web_VSldier_Add_Vid: jQuery('#Rich_Web_Vid_Vid_1').val(),
        Rich_Web_VSlider_Add_Desc: tinymce.get('Rich_Web_VSlider_Desc').getContent(),
        Rich_Web_VSlider_Vid_Title: jQuery('#Rich_Web_VSlider_Video_Title').val().trim()
    });
    jQuery('.Rich_Web_Save_VSlider_Table3').append(`
        <tr id="Rich_Web_VSlider_tr_${RW_VS_Random_Number}" data-rwvs-id="${RW_VS_Random_Number}">
            <td name="Rich_Web_VSlider_NN_${RW_VS_Random_Number}" id="Rich_Web_VSlider_NN_${RW_VS_Random_Number}">${RW_VS_Random_Number}</td>
            <td id="Rich_Web_VSlider_Img_${RW_VS_Random_Number}">
                <img src="${rw_vs_object[`${RW_VS_Random_Number}`]["Rich_Web_VSldier_Add_Img"]}" id="Rich_Web_VSlider_Img_Src_${RW_VS_Random_Number}" name="Rich_Web_VSlider_Img_Src_${RW_VS_Random_Number}" style="height:60px;">
            </td>
            <td id="Rich_Web_VSlider_Vid_Title_${RW_VS_Random_Number}" name="Rich_Web_VSlider_Vid_Title_${RW_VS_Random_Number}">${rw_vs_object[`${RW_VS_Random_Number}`]["Rich_Web_VSlider_Vid_Title"]}</td>
            <td id="Rich_Web_VSlider_tdClone_${RW_VS_Random_Number}"><i class="Rich_Web_VS_Files rich_web rich_web-files-o" onclick="Rich_Web_VSlider_Clone_Video(${RW_VS_Random_Number})"></i></td>
            <td id="Rich_Web_VSlider_tdEdit_${RW_VS_Random_Number}"><i class="Rich_Web_VS_Pencil rich_web rich_web-pencil" onclick="Rich_Web_VSlider_Edit_Video(${RW_VS_Random_Number})"></i></td>
            <td id="Rich_Web_VSlider_tdDelete_${RW_VS_Random_Number}">
                <i class="Rich_Web_VS_Delete rich_web rich_web-trash" onclick="Rich_Web_VSlider_Delete_Video(${RW_VS_Random_Number})"></i>
            </td>
        </tr>
    `);

    jQuery('#Rich_Web_VSlider_Count').val(jQuery('#Rich_Web_VSlider_Count').val() + 1);
    RichWeb_ReIndex_Table();
    Rich_Web_Res_VSlider_Vid();
}

function Rich_Web_Upd_VSlider_Vid() {
    var RichWebElemUpdateNumber = jQuery('#Rich_Web_VSlider_HidUp').val();
    Object.assign(rw_vs_object[`${RichWebElemUpdateNumber}`], {
        Rich_Web_VSldier_Add_Img: jQuery('#Rich_Web_Vid_ImSrc_2').val(),
        Rich_Web_VSldier_Add_Link: jQuery('#Rich_Web_VSlider_Link').val(),
        Rich_Web_VSldier_Add_ONT: jQuery('#Rich_Web_VSlider_ONT').is(":checked") === true ? "checked" : "false",
        Rich_Web_VSldier_Add_Src: jQuery('#Rich_Web_Vid_Src_2').val(),
        Rich_Web_VSldier_Add_Vid: jQuery('#Rich_Web_Vid_Vid_1').val(),
        Rich_Web_VSlider_Add_Desc: tinymce.get('Rich_Web_VSlider_Desc').getContent(),
        Rich_Web_VSlider_Vid_Title: jQuery('#Rich_Web_VSlider_Video_Title').val().trim()
    });
    jQuery(`#Rich_Web_VSlider_Img_Src_${RichWebElemUpdateNumber}`).attr("src", rw_vs_object[`${RichWebElemUpdateNumber}`]["Rich_Web_VSldier_Add_Img"]);
    jQuery(`#Rich_Web_VSlider_Vid_Title_${RichWebElemUpdateNumber}`).text( rw_vs_object[`${RichWebElemUpdateNumber}`]["Rich_Web_VSlider_Vid_Title"]);
    jQuery('.Rich_Web_VSlider_Sav_Video').show();
    jQuery('.Rich_Web_VSlider_Upd_Video').hide();
    Rich_Web_Res_VSlider_Vid();
}

function Rich_Web_VSlider_Clone_Video(cloneNumber) {
    var RW_VS_Random_Number = RichWeb_Generate_Number();
    rw_vs_object[`${RW_VS_Random_Number}`] = {};
    Object.assign(rw_vs_object[`${RW_VS_Random_Number}`], {
        Rich_Web_VSldier_Add_Img: rw_vs_object[`${cloneNumber}`]["Rich_Web_VSldier_Add_Img"],
        Rich_Web_VSldier_Add_Link: rw_vs_object[`${cloneNumber}`]["Rich_Web_VSldier_Add_Link"],
        Rich_Web_VSldier_Add_ONT: rw_vs_object[`${cloneNumber}`]["Rich_Web_VSldier_Add_ONT"],
        Rich_Web_VSldier_Add_Src: rw_vs_object[`${cloneNumber}`]["Rich_Web_VSldier_Add_Src"],
        Rich_Web_VSldier_Add_Vid: rw_vs_object[`${cloneNumber}`]["Rich_Web_VSldier_Add_Vid"],
        Rich_Web_VSlider_Add_Desc: rw_vs_object[`${cloneNumber}`]["Rich_Web_VSlider_Add_Desc"],
        Rich_Web_VSlider_Vid_Title: rw_vs_object[`${cloneNumber}`]["Rich_Web_VSlider_Vid_Title"]
    });
    var Rich_Web_VSlider_Count = jQuery(`#Rich_Web_VSlider_Count`).val();
    var Rich_Web_New_Clone_Number = parseInt(parseInt(Rich_Web_VSlider_Count) + 1);
    jQuery(`#Rich_Web_VSlider_tr_${cloneNumber}`).after(`
        <tr id="Rich_Web_VSlider_tr_${RW_VS_Random_Number}" data-rwvs-id="${RW_VS_Random_Number}">
            <td name="Rich_Web_VSlider_NN_${RW_VS_Random_Number}" id="Rich_Web_VSlider_NN_${RW_VS_Random_Number}">${RW_VS_Random_Number}</td>
            <td id="Rich_Web_VSlider_Img_${RW_VS_Random_Number}">
                <img src="${rw_vs_object[`${RW_VS_Random_Number}`]["Rich_Web_VSldier_Add_Img"]}" id="Rich_Web_VSlider_Img_Src_${RW_VS_Random_Number}" name="Rich_Web_VSlider_Img_Src_${RW_VS_Random_Number}" style="height:60px;">
            </td>
            <td id="Rich_Web_VSlider_Vid_Title_${RW_VS_Random_Number}" name="Rich_Web_VSlider_Vid_Title_${RW_VS_Random_Number}">${rw_vs_object[`${RW_VS_Random_Number}`]["Rich_Web_VSlider_Vid_Title"]}</td>
            <td id="Rich_Web_VSlider_tdClone_${RW_VS_Random_Number}"><i class="Rich_Web_VS_Files rich_web rich_web-files-o" onclick="Rich_Web_VSlider_Clone_Video(${RW_VS_Random_Number})"></i></td>
            <td id="Rich_Web_VSlider_tdEdit_${RW_VS_Random_Number}"><i class="Rich_Web_VS_Pencil rich_web rich_web-pencil" onclick="Rich_Web_VSlider_Edit_Video(${RW_VS_Random_Number})"></i></td>
            <td id="Rich_Web_VSlider_tdDelete_${RW_VS_Random_Number}">
                <i class="Rich_Web_VS_Delete rich_web rich_web-trash" onclick="Rich_Web_VSlider_Delete_Video(${RW_VS_Random_Number})"></i>
            </td>
        </tr>
    `);
    RichWeb_ReIndex_Table();
    jQuery('#Rich_Web_VSlider_Count').val(Rich_Web_New_Clone_Number);
}

function Rich_Web_VSlider_Edit_Video(editNumber) {
    jQuery('#Rich_Web_VSlider_HidUp').val(editNumber);
    jQuery('.Rich_Web_VSlider_Sav_Video').hide();
    jQuery('.Rich_Web_VSlider_Upd_Video').show();
    jQuery('#Rich_Web_VSlider_Video_Title').val(rw_vs_object[`${editNumber}`]["Rich_Web_VSlider_Vid_Title"]);
    tinymce.get('Rich_Web_VSlider_Desc').setContent(rw_vs_object[`${editNumber}`]["Rich_Web_VSlider_Add_Desc"]);
    jQuery('#Rich_Web_Vid_ImSrc_2').val(rw_vs_object[`${editNumber}`]["Rich_Web_VSldier_Add_Img"]);
    jQuery('#Rich_Web_Vid_Vid_1').val(rw_vs_object[`${editNumber}`]["Rich_Web_VSldier_Add_Vid"]);
    jQuery('#Rich_Web_Vid_Src_2').val(rw_vs_object[`${editNumber}`]["Rich_Web_VSldier_Add_Src"]);
    jQuery('#Rich_Web_VSlider_Link').val(rw_vs_object[`${editNumber}`]["Rich_Web_VSldier_Add_Link"]);
    if (rw_vs_object[`${editNumber}`]["Rich_Web_VSldier_Add_ONT"] == 'checked') {
        jQuery('#Rich_Web_VSlider_ONT').prop("checked", true);
    } else {
        jQuery('#Rich_Web_VSlider_ONT').prop("checked", false);
    }
}

function Rich_Web_VSlider_Delete_Video(RW_VS_RemoveNumber) {
    jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeIn();
    jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeIn();
    jQuery('.Rich_Web_SliderVd_Relative_No').click(function() {
        jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeOut();
        jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeOut();
        RW_VS_RemoveNumber = null;
    });
    jQuery('.Rich_Web_SliderVd_Relative_Yes').click(function() {
        if (RW_VS_RemoveNumber != null) {
            delete rw_vs_object[`${RW_VS_RemoveNumber}`];
            jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeOut();
            jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeOut();
            jQuery(`#Rich_Web_VSlider_tr_${RW_VS_RemoveNumber}`).remove();
            jQuery('#Rich_Web_VSlider_Count').val(jQuery('#Rich_Web_VSlider_Count').val() - 1);
            RichWeb_ReIndex_Table();
        }
        RW_VS_RemoveNumber = null;
    });
}


function Rich_Web_VSlider_Sortable() {
    jQuery('.Rich_Web_Save_VSlider_Table3').sortable({
        update: function(event, ui) {
            RichWeb_ReIndex_Table();
        }
    })
}

function Rich_Web_VS_Del(number) {
    var RWSVRS = number;
    jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeIn();
    jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeIn();

    jQuery('.Rich_Web_SliderVd_Relative_No').click(function() {
        jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeOut();
        jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeOut();
        RWSVRS = null;
    })
    jQuery('.Rich_Web_SliderVd_Relative_Yes').click(function() {
        if (RWSVRS != null) {
            jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeOut();
            jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeOut();

            var data = {
                rwvs_nonce: object.rwvs_nonce,
                action: 'Rich_Web_VSlider_Del',
                foobar: number,
            };
            jQuery.post(object.ajaxurl, data, function(response) {
                if (response.success === false) {
                    location.reload(true);
                }
                jQuery('#Rich_Web_VSlider_Table_Tr-' + number).remove();
                jQuery('.Rich_Web_VSlider_Tit_Table_Tr2').each(function(i) {
                    jQuery(this).find('td:nth-child(1)').html((i + 1));
                });
            })
        }
        RWSVRS = null;
    })
}

function Rich_Web_VS_Copy(number) {

    var data = {
        rwvs_nonce: object.rwvs_nonce,
        action: 'Rich_Web_VSlider_Copy',
        foobar: number,
    };
    jQuery.post(object.ajaxurl, data, function(response) {
        if (response.success === false) {
            location.reload(true);
        }
        var responseCopied = response.data;
        jQuery('.Rich_Web_VSlider_Tit_Table_Tr2').last().after('<tr class="Rich_Web_VSlider_Tit_Table_Tr2" id="Rich_Web_VSlider_Table_Tr-' + responseCopied.id + '"><td></td><td>' + responseCopied.Slider_Title + '</td><td>' + responseCopied.Slider_Type + '</td><td>' + responseCopied.Slider_Video_Quantity + '</td><td onclick="Rich_Web_VS_Copy(' + responseCopied.id + ')"><i class="Rich_Web_VS_Files rich_web rich_web-files-o"></i></td><td onclick="Rich_Web_VS_Edit(' + responseCopied.id + ')"><i class="Rich_Web_VS_Pencil rich_web rich_web-pencil"></i></td><td onclick="Rich_Web_VS_Del(' + responseCopied.id + ')"><i class="Rich_Web_VS_Delete rich_web rich_web-trash"></i></td></tr>');
        jQuery('.Rich_Web_VSlider_Tit_Table_Tr2').each(function(i) {
            jQuery(this).find('td:nth-child(1)').html((i + 1));
        });
        var rw_vs_short_id = +responseCopied.id + 1;
        jQuery('.Rich_Web_VSlider_Add').attr('onclick', 'RichWeb_Video_Slider_Add(' + rw_vs_short_id + ')');
    })
}

function Rich_Web_VS_Edit(number) {
    jQuery('.Table_Data_VS_Rich_Web1').css('display', 'none');
    jQuery('.RW_Support_btn').css('margin-right', 'auto');
    jQuery('.Rich_Web_VSlider_Add').addClass('Rich_Web_VSlider_AddAnim');
    jQuery('.Table_Data_VS_Rich_Web2').css('display', 'block');
    jQuery('.Rich_Web_VSlider_Upd').addClass('Rich_Web_VSlider_SavAnim');
    jQuery('.Rich_Web_VSlider_Can').addClass('Rich_Web_VSlider_CanAnim');
    jQuery('#Rich_Web_VSlider_Update_ID').val(number);
    jQuery('.Rich_Web_VSlider_ID').html(`[Rich_Web_Video id="${number}"] <span class="RW_VS_C_TTip" >Copy to clipboard</span>`);
    jQuery('.Rich_Web_VSlider_ID_1').html(`&lt;?php echo do_shortcode(&apos;[Rich_Web_Video id="${number}"]&apos;);?&gt <span class="RW_VS_C_TTip" >Copy to clipboard</span`);
    Rich_Web_Video_Slider_Editor();
    var data = {
        rwvs_nonce: object.rwvs_nonce,
        action: 'Rich_Web_VSlider_Edit_Main',
        foobar: number,
    };
    jQuery.post(object.ajaxurl, data, function(response) {
        jQuery('.Rich_Web_VSlider_Name').val(response.data["Slider_Title"]);
        jQuery('.Rich_Web_VSlider_Type').val(response.data["Slider_Type"]);
        jQuery('#Rich_Web_VSlider_Count').val(response.data["Slider_Video_Quantity"]);
    });
    var data = {
        rwvs_nonce: object.rwvs_nonce,
        action: 'Rich_Web_VSlider_Edit_Videos',
        foobar: number,
    };
    jQuery.post(object.ajaxurl, data, function(response) {
        if (response.success === false) {
            location.reload(true);
        }
        var data = response.data;
        for (i = 0; i < data.length; i++) {
            var number = parseInt(i) + 1;
            rw_vs_object[`${number}`] = data[i];
            jQuery('.Rich_Web_Save_VSlider_Table3').append(`
                <tr id="Rich_Web_VSlider_tr_${number}" data-rwvs-id="${number}">
                    <td name="Rich_Web_VSlider_NN_${number}" id="Rich_Web_VSlider_NN_${number}">
                        ${number}
                    </td>
                    <td id="Rich_Web_VSlider_Img_${number}">    
                        <img src="${data[i]['Rich_Web_VSldier_Add_Img']}" id="Rich_Web_VSlider_Img_Src_${number}" name="Rich_Web_VSlider_Img_Src_${number}" style="height:60px;">
                    </td>
                    <td id="Rich_Web_VSlider_Vid_Title_${number}" name="Rich_Web_VSlider_Vid_Title_${number}">
                        ${data[i]['Rich_Web_VSlider_Vid_Title']}
                    </td>
                    <td id="Rich_Web_VSlider_tdClone_${number}">
                        <i class="Rich_Web_VS_Files rich_web rich_web-files-o" onclick="Rich_Web_VSlider_Clone_Video(${number})"></i>
                    </td>
                    <td id="Rich_Web_VSlider_tdEdit_${number}">
                        <i class="Rich_Web_VS_Pencil rich_web rich_web-pencil" onclick="Rich_Web_VSlider_Edit_Video(${number})"></i>
                    </td>
                    <td id="Rich_Web_VSlider_tdDelete_${number}">
                        <i class="Rich_Web_VS_Delete rich_web rich_web-trash" onclick="Rich_Web_VSlider_Delete_Video(${number})"></i>
                    </td>
                </tr>
            `);
            jQuery('#Rich_Web_VSlider_Add_Description_' + number).val(data[i]['Rich_Web_VSlider_Add_Desc']);
        }
    })
}


function Rich_Web_Video_Slider_Editor() {
    tinymce.init({
        selector: '#Rich_Web_VSlider_Desc',
        menubar: false,
        statusbar: false,
        height: 200,
        plugins: [
            'advlist autolink lists link image charmap print preview hr',
            'searchreplace wordcount code media ',
            'insertdatetime media save table contextmenu directionality',
            'paste textcolor colorpicker textpattern imagetools codesample'
        ],
        toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr | subscript superscript | charmap | print | codesample ",
        fontsize_formats: '8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px',
        font_formats: 'Abadi MT Condensed Light = abadi mt condensed light; Aharoni = aharoni; Aldhabi = aldhabi; Andalus = andalus; Angsana New = angsana new; AngsanaUPC = angsanaupc; Aparajita = aparajita; Arabic Typesetting = arabic typesetting; Arial = arial; Arial Black = arial black; Batang = batang; BatangChe = batangche; Browallia New = browallia new; BrowalliaUPC = browalliaupc; Calibri = calibri; Calibri Light = calibri light; Calisto MT = calisto mt; Cambria = cambria; Candara = candara; Century Gothic = century gothic; Comic Sans MS = comic sans ms; Consolas = consolas; Constantia = constantia; Copperplate Gothic = copperplate gothic; Copperplate Gothic Light = copperplate gothic light; Corbel = corbel; Cordia New = cordia new; CordiaUPC = cordiaupc; Courier New = courier new; DaunPenh = daunpenh; David = david; DFKai-SB = dfkai-sb; DilleniaUPC = dilleniaupc; DokChampa = dokchampa; Dotum = dotum; DotumChe = dotumche; Ebrima = ebrima; Estrangelo Edessa = estrangelo edessa; EucrosiaUPC = eucrosiaupc; Euphemia = euphemia; FangSong = fangsong; Franklin Gothic Medium = franklin gothic medium; FrankRuehl = frankruehl; FreesiaUPC = freesiaupc; Gabriola = gabriola; Gadugi = gadugi; Gautami = gautami; Georgia = georgia; Gisha = gisha; Gulim = gulim; GulimChe = gulimche; Gungsuh = gungsuh; GungsuhChe = gungsuhche; Impact = impact; IrisUPC = irisupc; Iskoola Pota = iskoola pota; JasmineUPC = jasmineupc; KaiTi = kaiti; Kalinga = kalinga; Kartika = kartika; Khmer UI = khmer ui; KodchiangUPC = kodchiangupc; Kokila = kokila; Lao UI = lao ui; Latha = latha; Leelawadee = leelawadee; Levenim MT = levenim mt; LilyUPC = lilyupc; Lucida Console = lucida console; Lucida Handwriting Italic = lucida handwriting italic; Lucida Sans Unicode = lucida sans unicode; Malgun Gothic = malgun gothic; Mangal = mangal; Manny ITC = manny itc; Marlett = marlett; Meiryo = meiryo; Meiryo UI = meiryo ui; Microsoft Himalaya = microsoft himalaya; Microsoft JhengHei = microsoft jhenghei; Microsoft JhengHei UI = microsoft jhenghei ui; Microsoft New Tai Lue = microsoft new tai lue; Microsoft PhagsPa = microsoft phagspa; Microsoft Sans Serif = microsoft sans serif; Microsoft Tai Le = microsoft tai le; Microsoft Uighur = microsoft uighur; Microsoft YaHei = microsoft yahei; Microsoft YaHei UI = microsoft yahei ui; Microsoft Yi Baiti = microsoft yi baiti; MingLiU_HKSCS = mingliu_hkscs; MingLiU_HKSCS-ExtB = mingliu_hkscs-extb; Miriam = miriam; Mongolian Baiti = mongolian baiti; MoolBoran = moolboran; MS UI Gothic = ms ui gothic; MV Boli = mv boli; Myanmar Text = myanmar text; Narkisim = narkisim; Nirmala UI = nirmala ui; News Gothic MT = news gothic mt; NSimSun = nsimsun; Nyala = nyala; Palatino Linotype = palatino linotype; Plantagenet Cherokee = plantagenet cherokee; Raavi = raavi; Rod = rod; Sakkal Majalla = sakkal majalla; Segoe Print = segoe print; Segoe Script = segoe script; Segoe UI Symbol = segoe ui symbol; Shonar Bangla = shonar bangla; Shruti = shruti; SimHei = simhei; SimKai = simkai; Simplified Arabic = simplified arabic; SimSun = simsun; SimSun-ExtB = simsun-extb; Sylfaen = sylfaen; Tahoma = tahoma; Times New Roman = times new roman; Traditional Arabic = traditional arabic; Trebuchet MS = trebuchet ms; Tunga = tunga; Utsaah = utsaah; Vani = vani; Vijaya = vijaya'
    });
}

function rw_vs_copy(elem) {
    var newInputElem = document.createElement("input");
    var rw_vs_c = jQuery(elem).attr('class');
    var CopiedText = jQuery(`.${rw_vs_c}`).text();
    CopiedText = CopiedText.replace('Copy to clipboard', '');
    CopiedText = CopiedText.replace('Copied to clipboard', '');
    CopiedText = CopiedText.replace("&lt;", "<");
    CopiedText = CopiedText.replace("&gt;", ">");
    CopiedText = CopiedText.replace("&#039;", "'");
    CopiedText = CopiedText.replace("&#039;", "'");
    newInputElem.setAttribute("value", CopiedText);
    document.body.appendChild(newInputElem);
    newInputElem.select();
    document.execCommand("copy");
    document.body.removeChild(newInputElem);
    jQuery(`.${rw_vs_c}`).children('span').text('Copied to clipboard');
}

function rw_vs_copied(clicked) {
    var rw_vs_c = jQuery(clicked).attr('class');
    jQuery(`.${rw_vs_c}`).children('span').text('Copy to clipboard');
}

jQuery(document).ready(function() { jQuery('.Rich_Web_VSlider_ID , .Rich_Web_VSlider_ID_1').bind('contextmenu', function() { return false; }); })