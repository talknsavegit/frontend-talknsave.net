<?php
/**
 * @wordpress-plugin
 * Plugin Name:       TNS signup
 */
function tns_signup_init() {
    function tns_signup($atts = [], $content = null) {
        $content.="<form id=\"rendered-form\">
            <div class=\"rendered-form\">
                <div class=\"\"><h1 id=\"control-8650935\">Service Dates</h1></div>
                <div class=\"\"><p id=\"control-3345810\"><span
                            style=\"color: rgb(51, 51, 51); font-family: Tahoma, Geneva, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\">Please note that the pricing on the previous page is guaranteed only for the set duration&nbsp;</span><br
                            style=\"color: rgb(51, 51, 51); font-family: Tahoma, Geneva, sans-serif; font-size: 12px;\"><span
                            style=\"color: rgb(51, 51, 51); font-family: Tahoma, Geneva, sans-serif; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\">of the group. Please contact us for pricing for extended travel.</span>
                    </p></div>
                <div class=\"fb-date form-group field-date-1515680865622\"><label for=\"date-1515680865622\"
                                                                                class=\"fb-date-label\">Day to Begin
                        Service<span class=\"fb-required\">*</span></label><input type=\"date\" class=\"form-control\"
                                                                                name=\"date-1515680865622\"
                                                                                id=\"date-1515680865622\"
                                                                                required=\"required\"
                                                                                aria-required=\"true\"></div>
                <div class=\"fb-date form-group field-date-1515680860855\"><label for=\"date-1515680860855\"
                                                                                class=\"fb-date-label\">Day to End Service<span
                            class=\"fb-required\">*</span></label><input type=\"date\" class=\"form-control\"
                                                                       name=\"date-1515680860855\" id=\"date-1515680860855\"
                                                                       required=\"required\" aria-required=\"true\"></div>
                <div class=\"\"><p id=\"control-5423239\"><span
                            style=\"color: rgb(102, 102, 102); font-family: Tahoma, Geneva, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;\">Minimum Length of Contract: 7 days.</span>
                    </p></div>
                <div class=\"\"><h1 id=\"control-2173219\">Equipment Type &amp; Quantity</h1></div>
                <div class=\"fb-select form-group field-select-1515681303307\"><label for=\"select-1515681303307\"
                                                                                    class=\"fb-select-label\">Quantity
                        needed<span class=\"fb-required\">*</span></label><select class=\"form-control\"
                                                                                name=\"select-1515681303307\"
                                                                                id=\"select-1515681303307\"
                                                                                required=\"required\"
                                                                                aria-required=\"true\">
                        <option value=\"0\" selected=\"true\" id=\"select-1515681303307-0\">(Please select)</option>
                        <option value=\"1\" id=\"select-1515681303307-1\">1</option>
                        <option value=\"2\" id=\"select-1515681303307-2\">2</option>
                        <option value=\"3\" id=\"select-1515681303307-3\">3</option>
                        <option value=\"4\" id=\"select-1515681303307-4\">4</option>
                        <option value=\"5\" id=\"select-1515681303307-5\">5</option>
                        <option value=\"6\" id=\"select-1515681303307-6\">6</option>
                        <option value=\"7\" id=\"select-1515681303307-7\">7</option>
                        <option value=\"8\" id=\"select-1515681303307-8\">8</option>
                        <option value=\"9\" id=\"select-1515681303307-9\">9</option>
                        <option value=\"10\" id=\"select-1515681303307-10\">10</option>
                    </select></div>
            </div>
        </form>";
        return $content;
    }
    add_shortcode('tns_signup', 'tns_signup');
}
add_action('init', 'tns_signup_init');
?>