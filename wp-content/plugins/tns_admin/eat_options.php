<?php
////add the admin options page
//add_action('admin_menu', 'eat_admin_add_page2');
//
//function eat_admin_add_page2()
//{
//    add_options_page('TNS Edit Any Table Options', 'TNS Edit Any Table', 'manage_options', 'eat_options2', 'eat_options_page2');
//}
//
//function eat_options_page2()
//{
//    ?>
<!---->
<!--    <h2>Edit Any Table Options</h2>-->
<!--    Configure the plugin here <br />-->
<!---->
<!--    <a href="--><?php //echo plugin_dir_url(__FILE__) ?><!--languages/readme.html">Translate into your own language</a>-->
<!--    <form action="options.php" method="post">-->
<!--        --><?php
//        settings_fields('eat_options');
//        do_settings_sections('eat0');
//        do_settings_sections('eat1');
//        do_settings_sections('eat2');
//        do_settings_sections('eat3');
//
//
//        $options = get_option('eat_options');
//        //test connection
//        $eat_db = new wpdb($options['eat_user'], $options['eat_pwd'], $options['eat_db'], $options['eat_host']);
//
//
//        if (!$eat_db->dbh)
//        {
//            echo '<br/><strong>'.__('Unable to connect to your external database','EditAnyTable').'</strong><br/>'.__('Check your Database Settings','EditAnyTable');
//        }
//        else
//        {
//            do_settings_sections('eat4');
//        }
//        //visible in dashboard?
//        if ($options['eat_editor'] != 'yes' && $options['eat_admin'] != 'yes')
//        {
//            echo '<br /><strong>'.__('No one will see this in the Dashboard','EditAnyTable').'</strong><br />'.__('Check the Admin Settings','EditAnyTable');
//        }
//
//            ?>
<!---->
<!--            <br/>-->
<!--            <input name="Submit" type="submit" value="--><?php //esc_attr_e(__('Save Changes','EditAnyTable')); ?><!--"/>-->
<!---->
<!--    </form>-->
<?php
//
//
//}
//
////add the admin settings host, database, user, password
//add_action('admin_init', 'eat_admin_init2');
//function eat_admin_init2()
//{
//    register_setting('eat_options', 'eat_options', 'eat_options_validate');
//    add_settings_section('eat_main', __('Debug Mode','EditAnyTable'),'eat_de_section_text2','eat0');
//    add_settings_field('eat_debug',__('Debug','EditAnyTable'),'display_eat_debug2','eat0','eat_main');
//    add_settings_section('eat_main', __('Database Settings','EditAnyTable'), 'eat_db_section_text2', 'eat1');
//    add_settings_field('eat_host', __('Host','EditAnyTable'), 'display_eat_host2', 'eat1', 'eat_main');
//    add_settings_field('eat_db', __('Database','EditAnyTable'), 'display_eat_db2', 'eat1', 'eat_main');
//    add_settings_field('eat_user', __('Username','EditAnyTable'), 'display_eat_user2', 'eat1', 'eat_main');
//    add_settings_field('eat_pwd', __('Password','EditAnyTable'), 'display_eat_pwd2', 'eat1', 'eat_main');
//    add_settings_section('eat_main', __('Admin Settings','EditAnyTable'), 'eat_ad_section_text2', 'eat2');
//    add_settings_field('eat_admin', __('Admin Access','EditAnyTable'), 'display_eat_admin2', 'eat2', 'eat_main');
//    add_settings_field('eat_editor', __('Editor Access','EditAnyTable'), 'display_eat_editor2', 'eat2', 'eat_main');
//    add_settings_field('eat_editorPrivAdd', __('Allow Editor Add','EditAnyTable'), 'display_eat_editorPrivAdd2', 'eat2', 'eat_main');
//    add_settings_field('eat_editorPrivEdit', __('Allow Editor Edit','EditAnyTable'), 'display_eat_editorPrivEdit2', 'eat2', 'eat_main');
//    add_settings_field('eat_editorPrivDelete', __('Allow Editor Delete','EditAnyTable'), 'display_eat_editorPrivDelete2', 'eat2', 'eat_main');
//    add_settings_section('eat_main', __('Display Settings','EditAnyTable'), 'eat_ds_section_text2', 'eat3');
//    add_settings_field('eat_cols', __('Default number of search results to display at a time','EditAnyTable'), 'display_eat_cols2', 'eat3', 'eat_main');
//    add_settings_field('eat_friendly', __('Enter a friendly name to be displayed for the database (leave blank to display actual name)','EditAnyTable'), 'display_eat_friendly2', 'eat3', 'eat_main');
//    add_settings_field('eat_display', __('Display Edit Any Table as a Dashboard Widget or in its own Admin Page','EditAnyTable'), 'display_eat_display2', 'eat3', 'eat_main');
//    add_settings_section('eat_main',__('Tables','EditAnyTable'),'eat_tb_section_text2','eat4');
//    add_settings_field('eat_tables',__('Select the tables to display in the Dashboard','EditAnyTable'),'display_eat_tables2','eat4','eat_main');
//}
//
//function display_eat_debug2()
//{
//
//    $options = get_option('eat_options');
//    echo "<input id='eat_debug' name='eat_options[eat_debug]'  type='radio' value='ON' " . ($options['eat_debug'] == 'ON' ? 'checked' : '') . "/>ON
//		  <input id='eat_debug' name='eat_options[eat_debug]'  type='radio' value='OFF' " . ($options['eat_debug'] == 'OFF' ? 'checked' : '') . "/>OFF";
//}
//
//function display_eat_tables2()
//{
//    // Display list of tables for selection
//    $options = get_option('eat_options');
//
//
//    $eat_db = new wpdb($options['eat_user'], $options['eat_pwd'], $options['eat_db'], $options['eat_host']);
//    $result = $eat_db->get_col($eat_db->prepare("show tables", null));
//    // Add a checkbox for each table in the database - prefix the table name with eat_table_ so
//    // they can be easily identified in the options array
//    foreach ($result as $table)
//    {
//        echo "<input id='eat_table_".$table."' name='eat_options[eat_table_".$table."]' type='checkbox' value='eat_table_".$table."' ".($options['eat_table_'.$table.''] =='eat_table_'.$table.''?'checked':'')."    />".$table."<br />";
//    }
//
//}
//
//function display_eat_display2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_display' name='eat_options[eat_display]'  type='radio' value='widget' " . ($options['eat_display'] == 'widget' ? 'checked' : '') . "/>".__('Widget','EditAnyTable').
//		  " <input id='eat_display' name='eat_options[eat_display]'  type='radio' value='page' " . ($options['eat_display'] == 'page' ? 'checked' : '') . "/>".__('Separate Admin Page','EditAnyTable');
//}
//
//function display_eat_friendly2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_friendly' name='eat_options[eat_friendly]' size='40' type='text' value='{$options['eat_friendly']}' />";
//}
//
//function display_eat_cols2()
//{
//
//    $options = get_option('eat_options');
//    echo "<input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='1' " . ($options['eat_cols'] == '1' ? 'checked' : '') . "/>1
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='2' " . ($options['eat_cols'] == '2' ? 'checked' : '') . "/>2
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='3' " . ($options['eat_cols'] == '3' ? 'checked' : '') . "/>3
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='4' " . ($options['eat_cols'] == '4' ? 'checked' : '') . "/>4
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='5' " . ($options['eat_cols'] == '5' ? 'checked' : '') . "/>5
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='6' " . ($options['eat_cols'] == '6' ? 'checked' : '') . "/>6
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='7' " . ($options['eat_cols'] == '7' ? 'checked' : '') . "/>7
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='8' " . ($options['eat_cols'] == '8' ? 'checked' : '') . "/>8
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='9' " . ($options['eat_cols'] == '9' ? 'checked' : '') . "/>9
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='10' " . ($options['eat_cols'] == '10' ? 'checked' : '') . "/>10
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='100' " . ($options['eat_cols'] == '100' ? 'checked' : '') . "/>100
//		  <input id='eat_cols' name='eat_options[eat_cols]'  type='radio' value='1000' " . ($options['eat_cols'] == '1000' ? 'checked' : '') . "/>1000";
//}
//
//function display_eat_editor2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_editor' name='eat_options[eat_editor]'  type='checkbox' value='yes' " . ($options['eat_editor'] == 'yes' ? 'checked' : '') . " />";
//}
//
//function display_eat_editorPrivAdd2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_editorPrivAdd' name='eat_options[eat_editorPrivAdd]' type='checkbox' value='yes' " . ($options['eat_editorPrivAdd'] == 'yes' ? 'checked' : '') . " />";
//}
//
//function display_eat_editorPrivEdit2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_editorPrivEdit' name='eat_options[eat_editorPrivEdit]' type='checkbox' value='yes' " . ($options['eat_editorPrivEdit'] == 'yes' ? 'checked' : '') . "  />";
//}
//
//function display_eat_editorPrivDelete2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_editorPrivDelete' name='eat_options[eat_editorPrivDelete]' type='checkbox' value='yes' " . ($options['eat_editorPrivDelete'] == 'yes' ? 'checked' : '') . " />";
//}
//
//function display_eat_admin2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_admin' name='eat_options[eat_admin]'  type='checkbox' value='yes' " . ($options['eat_admin'] == 'yes' ? 'checked' : '') . " />";
//}
//
//
//function display_eat_host2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_host' name='eat_options[eat_host]' size='40' type='text' value='{$options['eat_host']}' />";
//}
//
//function display_eat_db2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_db' name='eat_options[eat_db]' size='40' type='text' value='{$options['eat_db']}' />";
//}
//
//function display_eat_user2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_user' name='eat_options[eat_user]' size='40' type='text' value='{$options['eat_user']}' />";
//}
//
//function display_eat_pwd2()
//{
//    $options = get_option('eat_options');
//    echo "<input id='eat_pwd' name='eat_options[eat_pwd]' size='40' type='password' value='{$options['eat_pwd']}' />";
//}
//
//
//function eat_options_validate2($input)
//{
//
//    $output = $input;
//    return $output;
//}
//
//function eat_db_section_text2()
//{
//    ?>
<!--    <p>--><?php //_e('Enter the values to enable connection to your chosen database','EditAnyTable');?><!--</p>-->
<?php
//}
//
//function eat_ad_section_text2()
//{
//    ?>
<!--    <p>--><?php //_e('Who has access to the Edit Any Table Dashboard Widget?','EditAnyTable');?><!--</p>-->
<?php
//}
//
//function eat_ds_section_text2()
//{
//    ?>
<!--    <p>--><?php //_e('Edit any Table displays best in a one column layout. If you are using more than one column you may want to change how some elements are displayed','EditAnyTable');?><!--</p>-->
<?php
//}
//
//function eat_tb_section_text2()
//{
//    ?>
<!--    <p>--><?php //_e('Once you have saved your database settings correctly you should see a list of tables to select for display','EditAnyTable');?><!--</p>-->
<!--    --><?php
//}
//
//function eat_de_section_text2()
//{
//    ?>
<!--    <p>--><?php //_e('Switch on Debug Mode to view the SQL statements sent to your database','EditAnyTable');?><!--</p>-->
<?php
//}
//
//?>