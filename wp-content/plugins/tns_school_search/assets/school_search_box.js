window.schoolsInterval = setInterval(
    function () {

        if (typeof jQuery == 'function') {

            clearInterval(window.schoolsInterval);
//                 $ = jQuery;
                var theInput = $("#tns_student_ajax_search aside.widget.widget_codenegar_ajax_search div.codenegar_ajax_search_wrapper div.ajax_autosuggest_form_wrapper input");
                var titles = $("h3.tns_school_name");
                var elementArr = [];
                for(var count=0;count<titles.length;count++) {

                    elementArr.push($(titles[count]));
                }
                theInput.on("keyup",function(event) {

                    for(var count in elementArr) {

                        if(!elementArr[count].text().toLowerCase().includes(theInput.val().toLowerCase())) {

                            elementArr[count].parent().parent().parent().hide();
                        } else {

                            elementArr[count].parent().parent().parent().show();
                        }
                    }
                    // elementArr[0].parent().parent().parent().parent().isotope({
                    //     // options
                    //     itemSelector: '.box',
                    //     layoutMode: 'masonry',
                    //     masonry: {
                    //         isFitWidth: true
                    //     }
                    // });
                    var ele = document.querySelector(".isotope")
                    console.log(ele, "ele~~~~~~~~")
                    var iso = new Isotope( ele, {
                        // options
                        itemSelector: '.portfolio-item',
                        layoutMode: 'masonry',
                        masonry: {
                            isFitWidth: true
                        }
                    });
                });
        }
    },
    500);

