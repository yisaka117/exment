<?php

return [    
    'common' => [
        'home' => 'HOME',
        'error' => 'Error',
        'import' => 'Import',
        'reqired' => 'Required',
        'input' => 'Input',
        'available_true' => 'Available',
        'available_false' => 'Not Available',
        'help_code' => "Cannot edit after save. Please enter lowercase letters, numbers, '-' or '_'. Cannot use other data's value.",
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'separate_word' => ',',
        'yes' => 'Yes',
        'no' => 'No',
        'message' => [
            'import_success' => 'Success Import!',
            'import_error' => 'Success Error. Please Check csv file.',
            'notfound' => 'Data Not Found.',
            'wrongdata' => 'Data is wrong. Please check url.',
        ],

        'help' =>[
            'input_available_characters' => 'Please enter %s.',
        ],
    ],

    'system' => [
        'system_header' => 'System Setting',
        'system_description' => 'Change the system settings.',
        'header' => 'Site Basic Information',
        'administrator' => 'Administrator Information',
        'initialize_header' => 'Exment Install',
        'initialize_description' => 'Register the initial setting of Exment from the display and install it.',
        'site_name' => 'Site Name',
        'site_name_short' => 'Site Name (Short)',
        'site_logo' => 'Site Logo',
        'site_logo_mini' => 'Site Logo(Small)',
        'site_skin' => 'Site Skin',
        'site_layout' => 'Site Menu Layout',
        'authority_available' => 'Use Authority Management',
        'organization_available' => 'Use Organization Management',
        'system_mail_from' => 'System Email',
        'template' => 'Install Template',
        
        'site_skin_options' => [
            "skin-blue" => "Header:Blue&nbsp;&nbsp;&nbsp;&nbsp;SideBar:Black",
            "skin-blue-light" => "Header:Blue&nbsp;&nbsp;&nbsp;&nbsp;SideBar:White",
            "skin-yellow" => "Header:Yellow&nbsp;&nbsp;&nbsp;&nbsp;SideBar:Black",
            "skin-yellow-light" => "Header:Yellow&nbsp;&nbsp;&nbsp;&nbsp;SideBar:White",
            "skin-green" => "Header:Green&nbsp;&nbsp;&nbsp;&nbsp;SideBar:Black",
            "skin-green-light" => "Header:Green&nbsp;&nbsp;&nbsp;&nbsp;SideBar:White",
            "skin-purple" => "Header:Purple&nbsp;&nbsp;&nbsp;&nbsp;SideBar:Black",
            "skin-purple-light" => "Header:Purple&nbsp;&nbsp;&nbsp;&nbsp;SideBar:White",
            "skin-red" => "Header:Red&nbsp;&nbsp;&nbsp;&nbsp;SideBar:Black",
            "skin-red-light" => "Header:Red&nbsp;&nbsp;&nbsp;&nbsp;SideBar:White",
            "skin-black" => "Header:White&nbsp;&nbsp;&nbsp;&nbsp;SideBar:Black",
            "skin-black-light" => "Header:White&nbsp;&nbsp;&nbsp;&nbsp;SideBar:White",
        ],
        
        'site_layout_options' => [
            "layout_default" => "Default",
            "layout_mini" => "Small Icon",
        ],
        
        'help' =>[
            'site_name' => 'The site name displayed in the upper left of the page.',
            'site_name_short' => 'An abbreviation for the site name to be displayed when the menu is collapsed.',
            'site_logo' => 'Site logo. Recommended size:200px * 40px',
            'site_logo_mini' => 'Site logo(small size). Recommended size:40px * 40px',
            'site_skin' => 'Select the site theme color. *After saving, it will be reflected in reloading.',
            'site_layout' => 'On the left side of the page, select the layout of the site menu. *After saving, it will be reflected in reloading.',
            'authority_available' => 'If Select YES, management authority using user or organozation.',
            'organization_available' => 'If Select YES, create organizations to which the user belongs.',
            'system_mail_from' => 'the mail address from this system. Using this mail address as "from", this system sends users.',
            'template' => 'If select these templates, install tables, columns and forms.',
        ]
    ],

    'dashboard' => [
        'header' => 'Dashboard',
        'dashboard_name' => 'Dashboard Name',
        'dashboard_view_name' => 'Dashboard View Name',
        'row1' => 'Dashboard Row 1',
        'row2' => 'Dashboard Row 2',
        'description_row1' => 'The number of columns to display on the first row of the dashboard.',
        'description_row2' => 'The number of columns to display on the second row of the dashboard. *If you select "None", the second row is not displayed.',
        'default_dashboard_name' => 'Default Dashboard',
        'not_registered' => 'Not Registered',
        'dashboard_type_options' => [
            'system' => 'System Dashboard',
            'user' => 'User Dashboard',
        ],
        'row_options0' => 'None',
        'row_optionsX' => ' Column',

        'row_no' => 'Row No',
        'column_no' => 'Column No',
        'dashboard_box_type' => 'Box Type',
        'dashboard_box_view_name' => 'Box View Name',
        'dashboard_box_type_options' => [
            'list' => 'Data List',
            'system' => 'System',
        ],
        
        'dashboard_box_options' => [
            'target_table_id' => 'Target Table',
            'target_view_id' => 'Target View',
            'target_system_id' => 'Target Item',
        ],

        'dashboard_box_system_pages' => [
            'guideline' => 'Guideline',
        ],

        'dashboard_menulist' => [
            'current_dashboard_edit' => 'Edit Current Dashboard Setting',
            'create' => 'Create Dashboard',
        ],
    ],

    'plugin' => [
        'header' => 'Plugin Setting',
        'description' => 'Manage installed plugins and upload new plugins.',
        'upload_header' => 'Plugin Upload',
        'extension' => 'File Format:zip',
        'uuid' => 'Plugin ID',
        'plugin_name' => 'Plugin Name',
        'plugin_view_name' => 'Plugin View Name',
        'plugin_type' => 'Plugin Type',
        'author' => 'Author',
        'version' => 'Version',
        'active_flg' => 'Active Flg',
        'select_plugin_file' => 'Select Plugin File',
        'options' => [
            'header' => 'Option Setting',
            'target_tables' => 'target Table',
            'event_triggers' => 'Execute Trigger',
            'label' => 'Label',
            'button_class' => "Button's Class",
            'icon' => "Button's Icon",
            'uri' => 'URL',

            'event_trigger_options' => [
                'saving' => 'Before Saving',
                'saved' => 'After Saving',
                'loading' => 'Before Loading',
                'loaded' => 'After Loading',
                'grid_menubutton' => 'Menu button on List View',
                'form_menubutton_create' => 'Menu button on Form Create View',
                'form_menubutton_edit' => 'Menu button on Form Edit View',
            ]
        ],

        'help' => [
            'target_tables' => 'The target table for executing the plugin.',
            'event_triggers' => 'Sets whether or not to execute the plug-in when what action is taken.',
            'icon' => 'Icon to add to the HTML of the button.',
            'button_class' => 'The class added to the button HTML.',
            'errorMess' => 'Select a plugin file.',
        ],

        'plugin_type_options' => [
            'page' => 'Page',
            'trigger' => 'Trigger',
        ],
    ],

    'user' => [
        'header' => 'Login User Setting',
        'description' => 'Select the user who logins into this system from among the users, and set the password, initialize the password, and so on.',
        'user_code' => 'User Code',
        'user_name' => 'User Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Password(Confirm)',
        'new_password' => 'New Password',
        'new_password_confirmation' => 'New Password(Confirm)',
        'login_user' => 'Login User Setting',
        'login' => 'Login Setting',
        'use_loginuser' => 'Login Authorization Granted',
        'reset_password' => 'Reset Password',
        'create_password_auto' => 'Auto-Create Password',
        'avatar' => 'Avatar',
        'default_table_name' => 'User',
        'help' =>[
            'user_name' => 'The name is displayed on the window.',
            'email' => 'Please enter an email address that can receive system notifications.',
            'password' => 'Please enter an alphabetic number or symbol with at least 8 letters',
            'change_only' => 'Enter only when making changes.',
            
            'use_loginuser' => 'By checking, this user will be able to log in to the system.',
            'reset_password' => 'By checking and saving, the password will be reset.',
            'create_password_auto' => 'By checking and saving, the password is automatically generated.',
        ]
    ],

    'organization' => [
        'default_table_name' => 'Organization',
    ],

    'login' => [
        'email_or_usercode' => 'Email or UserCode',
        'forget_password' => 'I forgot my password',
        'password_reset' => 'Password Reset',
        'back_login_page' => 'Back to Login Page',
    ],

    'change_page_menu' =>[
        'change_page_label' => 'Change Page',
        'custom_table' => 'Table Setting',
        'custom_column' => 'Column Detail Setting',
        'custom_view' => 'View Setting',
        'custom_form' => 'Form Setting',
        'custom_relation' => 'Relation Setting',
        'custom_value' => 'Data List',
        'error_select' => 'Please select only one record.',
    ],

    'custom_table' => [
        'header' => 'Custom Table Setting',
        'description' => 'Define custom table settings that can be changed independently.',
        'table_name' => 'Table Name',
        'table_view_name' => 'Table View Name',
        'field_description' => 'Description',
        'color' => 'Color',
        'icon' => 'Icon',
        'search_enabled' => 'Search Enabled',
        'one_record_flg' => 'Save Only One Record',
        'custom_columns' => 'Column List',
        'help' => [
            'color' => 'Select table color. this color uses for example search.',
            'icon' => 'Select icons. these use for example menu.',
            'search_enabled' => 'If set on, can search from search display.',
            'one_record_flg' => 'Can Save Only One Record. For example, yourself company information.',
        ],
        
        'system_definitions' => [
            'user' => 'User',
            'organization' => 'Organization',
            'document' => 'Document',
            'base_info' => 'Base Info',
        ],
    ],
    
    'custom_column' => [
        'header' => 'Custom Column Detail Setting',
        'description' => 'Setting details with customer list. these define required fields, searchable fields, etc.',
        'column_name' => 'Column Name',
        'column_view_name' => 'Column View Name',
        'column_type' => 'Column Type',
        'options' => [
            'header' => 'Detail Option',
            'search_enabled' => 'Search Index',
            'unique' => 'Unique',
            'placeholder' => 'PlaceHolder',
            'help' => 'Help',
            'string_length' => 'Max Length',
            'available_characters' => 'Available Characters',
            'number_min' => 'Min Number',
            'number_max' => 'Max Number',
            'number_format' => 'Use Number Comma String',
            'updown_button' => '+- Button',
            'select_item' => 'Select Choice',
            "select_valtext" => "Select Choice (Config value and text)",
            'select_target_table' => 'Select Target Table',
            'true_value' => 'Select1 Value',
            'true_label' => 'Select1 Label',
            'true_label_default' => 'Yes',
            'false_value' => 'Select2 Value',
            'false_label' => 'Select2 Label',
            'false_label_default' => 'No',
            'auto_number_length' => 'Auto Number Length',
            'auto_number_type' => 'Auto Number Type',
            'auto_number_type_format' => 'Format',
            'auto_number_type_random25' => 'Random(25-Length)',
            'auto_number_type_random32' => 'Random(UUID)',
            'auto_number_format' => 'Auto Number Format',
            'multiple_enabled' => 'Approval Multiple Select',
            'use_label_flg' => 'Use Label',
            'calc_formula' => 'Calc Formula',
        ],
        'system_columns' => [
            'id' => 'ID',
            'suuid' => 'System ID(20-length)',
            'parent_id' => 'Parent Data ID',
            'parent_type' => 'Parent Data Table Name',
            'created_at' => 'Created Datetime',
            'updated_at' => 'Updated Datetime',  
            'deleted_at' => 'Deleted Datetime',           
        ],
        'column_type_options' => [
            "text" => "One-Line Text",
            "textarea" => "Multiple-Line Text",
            "url" => "URL",
            "email" => "Email",
            "integer" => "Integer",
            "decimal" => "Decimal",
            "calc" => "Calc Result",
            "date" => "Date",
            "time" => "Time",
            "datetime" => "Date and Time",
            "select" => "Select (From Static Value)",
            "select_valtext" => "Select (Save Value and Label)",
            "select_table" => "Select (From Table)",
            "yesno" => "YES/NO",
            "boolean" => "Select 2-value",
            "auto_number" => "Auto Number",
            "image" => "Image",
            "file" => "File",
            "user" => "User",
            "organization" => "Organization",
            'document' => 'Document',
        ],
        'help' => [
            'search_enabled' => 'When set to YES, the search index is added. you can narrow down the conditions in search and view. <br/>*If you set too many this setting on the same table, the performance may decline.',
            'unique' => 'If you do not want to register the same value with other data in duplicate, please set it to YES. * For data with a large number of cases, we recommend setting "Search index" to YES.',
            'help' => 'Help string displayed below the field.',
            'use_label_flg' => 'When this data is selected, it is a column of wording displayed on the screen. When multiple columns are registered, only one column is reflected.',
            'number_format' => 'By turning YES, the text field will be displayed as a comma value.',
            'updown_button' => 'By turning YES, Add "+" and "-" buttons.',
            'select_item' => 'Enter choices by line break separator.',
            'select_item_valtext' => 'Enter choices by line break separator. The word before the comma is the value, the word after the comma is the label.<br/>Ex：「1,Adult<br/>2,Underage」→"1" is the value saving data. "Adult" is the label user selected.',
            'select_target_table' => 'Select the table to be selected.',
            'true_value' => 'Enter the value to be registered when the first choice is saved.',
            'true_label' => 'Enter the character string to be displayed when the first choice is saved.',
            'false_value' => 'Enter the value to be registered when saving the second choice.',
            'false_label' => 'Enter the character string to be displayed when saving the second choice.',
			'available_characters' => 'Please select an inputable character. If you clear all checks, you can enter all the characters.',
            'auto_number_format' => 'Set the numbering rule to be registered. For details of rules, please refer to <a href="%s" target="_blank">here<i class="fa fa-external-link"></i></a>.',
            'calc_formula' => 'Enter the calculation formula using other fields. *It is currently beta version.',
        ],
        'available_characters' => [
            'lower' => 'Lower Letters', 
            'upper' => 'Upper Letters', 
            'number' => 'Numbers', 
            'hyphen_underscore' => '"-" or "_"',
            'symbol' => 'Symbol',
        ],
        
        'calc_formula' => [
             'calc_formula' => 'Calc Formula',
             'dynamic' => 'Column',
             'fixed' => 'Fixed Value',
             'symbol' => 'Symbol',
        ],
        
        'system_definitions' => [
            'file' => 'File',
            'company_name' => 'Company Name',
            'company_kana' => 'Company Kana',
            'zip01' => 'Postal Code1',
            'zip02' => 'Postal Code2',
            'tel01' => 'Tel1',
            'tel02' => 'Tel2',
            'tel03' => 'Tel3',
            'fax01' => 'FAX1',
            'fax02' => 'FAX2',
            'fax03' => 'FAX3',
            'pref' => 'Prefectures',
            'addr01' => 'Address',
            'addr02' => 'Address(After Building)',
            'company_logo' => 'Company Logo',
            'company_stamp' => 'Company Stamp',
            'transfer_bank_name' => 'Bank Account-Bank Name',
            'transfer_bank_office_name' => 'Bank Account-Office Name',
            'transfer_bank_office_no' => 'Bank Account-Office No',
            'transfer_bank_account_type' => 'Bank Account-Account Type',
            'transfer_bank_account_no' => 'Bank Account-Account No',
            'transfer_bank_account_name' => 'Bank Account-Account Name',
            'user_code' => 'User Code',
            'user_name' => 'User Name',
            'email' => 'Email',
            'organization_code' => 'Organization Code',
            'organization_name' => 'Organization Name',
            'parent_organization' => 'Parent Organization',
        ],
    ],

    'custom_form' => [
        'default_form_name' => 'Form',
        'header' => 'Custom Form Setting',
        'description' => 'Define the form display that the user can enter. You can switch between authority and users.',
        'form_view_name' => 'Form View Name',
        'table_default_label' => 'Table',
        'table_one_to_many_label' => 'Child Table - ',
        'table_many_to_many_label' => 'Relation Table - ',
        'suggest_column_label' => 'Table Column',
        'suggest_other_label' => 'Other',
        'form_block_name' => 'Form Block Name',
        'view_only' => 'View Only',
        'hidden' => 'Hidden Field',
        'text' => 'Text',
        'html' => 'HTML',
        'available' => 'Available',
        'header_basic_setting' => 'Form Basic Setting',
        'changedata' => 'Data Linkage Setting',
        'items' => 'Items',
        'add_all_items' => 'Add All Items',
        'changedata_target_column' => 'Select Column',
        'changedata_target_column_when' => 'When select this column,',
        'changedata_column' => 'Select Link Column',
        'changedata_column_then' => 'Copy this column',

        'form_column_type_other_options' => [
            'header' => 'Label',
            'html' => 'HTML',
            'explain' => 'Explain',
        ],
    ],

    'custom_view' => [
        'header' => 'Custom View Setting',
        'description' => 'Define the custom view setting.',
        'view_view_name' => 'View Display Name',
        'custom_view_columns' => 'Select View Columns',
        'view_column_target' => 'View Target Column',
        'order' => 'Order',
        'custom_view_filters' => 'View Filter',
        'view_filter_target' => 'Filter Target Column',
        'view_filter_condition' => 'Filter Condition',
        'view_filter_condition_value_text' => 'Filter Condition Value',
        'default_view_name' => 'Default View',
        'description_custom_view_columns' => 'Select display columns.',
        'description_custom_view_filters' => 'Select filter columns for search.<br/>* In addition to this setting, filter the data so that only the authority data owned by the login user is displayed.',

        'filter_condition_options' => [
            'eq' => 'Equal', 
            'ne' => 'Not Equal', 
            'eq-user' => 'Match Login User', 
            'ne-user' => 'Not Match Login User', 
            'on' => 'Target Date',
            'on-or-after' => 'After Target Date',
            'on-or-before' => 'Before Target Date',
            'today' => 'Today',
            'today-or-after' => 'After Today',
            'today-or-before' => 'Before Today',
            'yesterday' => 'Yesterday',
            'tomorrow' => 'Tomorrow',
            'this-month' => 'This Month',
            'last-month' => 'Last Month',
            'next-month' => 'Next Month',
            'this-year' => 'This Year',
            'last-year' => 'Last Year',
            'next-year' => 'Next Year',
            'last-x-day-after' => 'After the date X days ago', 
            'next-x-day-after' => 'After the date X days later', 
            'last-x-day-or-before' => 'Before the date X days ago', 
            'next-x-day-or-before' => 'Before the date X days later', 
            'not-null' => 'Not Empty',
            'null' => 'Empty',
        ],
        
        'custom_view_menulist' => [
            'current_view_edit' => 'Edit Current View Setting',
            'create' => 'Create View',
        ],
        
        'custom_view_button_label' => 'View',
        'custom_view_type_options' => [
            'system' => 'System View',
            'user' => 'User View',
        ],
    ],

    'authority' => [
        'header' => 'Authority Setting',
        'description' => 'Define Setting authority.',
        'authority_name' => 'Authority Name',
        'authority_view_name' => 'Authority View Name',
        'authority_type' => 'Authority Type',
        'default_flg' => 'Default Authority',
        'default_flg_true' => 'True',
        'default_flg_false' => '',
        'description_field' => 'Explain',
        'permissions' => 'Authority Detail',
        
        'description_form' => [
            'system' => 'Please select users/organizations to whom authority is given for the entire system.',
            'system_disableorg' => 'Please select users to whom authority is given for the entire system.',
            'custom_table' => 'Please select users/organizations to whom authority is given for the entire table.',
            'custom_table_disableorg' => 'Please select users to whom authority is given for the entire system.',
            'custom_value' => 'Please select users/organizations to whom authority is given for this data.',
            'custom_value_disableorg' => 'Please select users to whom authority is given for this data.',
            'plugin' => 'Please select users/organizations to whom authority is given for this plugin.',
            'plugin_disableorg' => 'Please select users to whom authority is given for this plugin.',
        ],

        'authority_type_options' =>[
            'system' => 'System',
            'table' => 'Table',
            'value' => 'Value',
            'plugin' => 'Plugin',
        ],
        
        'authority_type_option_system' => [
            'system' => ['label' => 'System Setting', 'help' => 'Users can edit system setting.'],
            'custom_table' => ['label' => 'Custom Table', 'help' => 'Users can add, edit, delete custom tables.'],
            'custom_form' => ['label' => 'Form', 'help' => 'Users can add, edit, delete custom forms.'],
            'custom_view' => ['label' => 'View', 'help' => 'Users can add, edit, delete custom views.'],
            'custom_value_edit_all' => ['label' => 'All Data', 'help' => 'Users can add, edit, delete all data in custom tables.'],
        ],
        'authority_type_option_table' => [
            'custom_table' => ['label' => 'Custom Table', 'help' => 'Users can edit, delete custom tables.'],
            'custom_form' => ['label' => 'Form', 'help' => 'Users can add, edit, delete custom forms.'],
            'custom_view' => ['label' => 'View', 'help' => 'Users can add, edit, delete custom views.'],
            'custom_value_edit_all' => ['label' => 'All Data', 'help' => 'Users can add, edit, delete all data in custom tables.'],
            'custom_value_edit' => ['label' => 'Edit Personnel Data', 'help' => 'Users can add, edit, delete personnel data in custom tables.'],
            'custom_value_view' => ['label' => 'View Personnel Data', 'help' => 'Users can view personnel data in custom tables.'],
        ], 
        'authority_type_option_value' => [
            'custom_value_edit' => ['label' => 'Editor', 'help' => 'Users can edit personnel data in custom tables.'],
            'custom_value_view' => ['label' => 'Viewer', 'help' => 'Users can view personnel data in custom tables.'],
        ], 
        'authority_type_option_plugin' => [
            'plugin_access' => ['label' => 'Access', 'help' => 'User can use this plugin.'],
            'plugin_setting' => ['label' => 'Manage Setting', 'help' => 'For plugins with configuration changes, user can change the setting of this plugin.'],
        ],
    ],

    'custom_relation' => [
        'header' => 'Custom Relation Setting',
        'description' => 'Define relations with table and table.',
        'relation_type' => 'Relation Type',
        'relation_type_options' => [
            'one_to_many'  => 'One to Many',
            'many_to_many'  => 'Many to Many',
        ],
        'parent_custom_table_name' => 'Parent Table Name',
        'parent_custom_table_view_name' => 'Parent Table View Name',
        'child_custom_table' => 'Child Table',
        'child_custom_table_name' => 'Child Table Name',
        'child_custom_table_view_name' => 'Child Table View Name',
    ],

    'search' => [
        'placeholder' => 'Search Data',
        'header_freeword' => 'Search All Data',
        'description_freeword' => 'A result list of all data search.',
        'header_relation' => 'Search Relation Data',
        'description_relation' => 'A result list of related data search.',
        'no_result' => 'There is no result found',
        'result_label' => 'Search Result for "%s"' ,
        'view_list' => 'List View',
    ],

    'menu' => [
        'menu_type' => 'Menu Type',
        'menu_target' => 'Target',
        'menu_name' => 'Menu Name',
        'title' => 'Menu View Name',
        'menu_type_options' => [
            'system' => 'System Menu',
            'plugin' => 'Plugin',
            'table' => 'Table Data',
            'parent_node' => 'Parent Node',
            'custom' => 'Custom URL',
        ],
        
        'system_definitions' => [
            'home' => 'HOME',
            'system' => 'System Setting',
            'plugin' => 'Plugin',
            'custom_table' => 'Custom Table',
            'authority' => 'Authority',
            'user' => 'User',
            'organization' => 'Organization',
            'menu' => 'Menu',
            'template' => 'Template',
            'loginuser' => 'LoginUser',
            'mail' => 'Mail',
            'notify' => 'Notify',
            'base_info' => 'Base Info',
            'master' => 'Manage Master',
            'admin' => 'Admin Setting',
        ],
    ],

    'mail_template' => [
        'header' => 'Mail Template Setting',
        'description' => 'Define mail subject, body, etc.',
        'mail_name' => 'Mail Key Name',
        'mail_view_name' => 'Mail View Name',
        'mail_subject' => 'Mail Subject',
        'mail_body' => 'Mail Body',
        'mail_template_type' => 'Template Type',
        'help' =>[
            'mail_name' => 'A key name for uniquely identifying a mail template on the system.',
            'mail_view_name' => 'The template name displayed on the list screen.',    
            'mail_subject' => 'Enter the subject of the mail to be sent. Variables can be used.',
            'mail_body' => 'Enter the body of the mail to be sent. Variables can be used.',    
        ],
        
        'mail_template_type_options' => [
            'header' => 'Header',
            'body' => 'Body',
            'footer' => 'Footer',
        ],
    ],
    
    'template' =>[
        'header' => 'Template',
        'header_export' => 'Template - Export',
        'header_import' => 'Template - Import',
        'description' => "Import or export Exmemt's table, column and form.",
        'description_export' => 'Export tables, columns, and form information registered in the system. This template file can be imported on other systems.',
        'description_import' => 'Import the exported Exment template information to this system and install the tables, columns, and form information.',
        'template_name' => 'Template Name',
        'template_view_name' => 'Template View Name',
        'form_description' => 'Template Description',
        'thumbnail' => 'Thumbnail',
        'upload_template' => 'Upload(zip)',
        'upload_template_excel' => 'Upload(Excel)',
        'export_target' => 'Export Target',
        'target_tables' => 'Target Tables',
        
        'help' => [
            'thumbnail' => 'Recommended size:256px*256px',
            'upload_template' => 'Upload the template zip file exported on another system and import the settings into this system.',
            'upload_template_excel' => 'Upload the configuration file created in Excel format and import the settings to the system.',
            'export_target' => 'Select export target.',
            'target_tables' => 'Select export tables. If not select, export all tables.',
        ],

        'export_target_options' => [
            'table' => 'Table',
            'dashboard' => 'Dashboard',
            'menu' => 'Menu',
            'authority' => 'Authority',
            'mail_template' => 'Mail Template',
        ]
    ],

    'custom_value' => [
        'template' => 'Export Template',
        'import_export' => 'Import/Export',
        'import' => [
            'import_file' => 'Import File',
            'import_file_select' => 'Select CSV File',
            'primary_key' => 'Promary Key',
            'error_flow' => 'Error Handling',
            'import_error_message' => 'Error Message',
            'import_error_format' => 'Line %d : %s',
            'help' => [
                'custom_table_file' => 'Select the CSV file that you output the template.',
                'primary_key' => 'Select the field to narrow down the update data.<br />If this field value matches existing data, it will be imported as update data.<br />If matching data does not exist, it will be imported as new data.',
                'error_flow' => 'If an error occurs due to incomplete data , select whether to capture normal data.',
                'import_error_message' => 'If incomplete files are incomplete, line numbers and error messages are displayed in this item.',
            ],
            'key_options' => [
                'id' => 'ID',
                'suuid' => 'SUUID(Inner ID)',
            ],
            'error_options' => [
                'stop' => 'Do not capture all data.',
                'skip' => 'Normal data is captured, but error data is not imported.',
            ],
        ]
    ],

    'notify' => [
        'header' => 'Notify Setting',
        'header_trigger' => 'Notify Trigger Setting',
        'header_action' => 'Notify Action Setting',
        'description' => 'Perform settings for notifying under specific conditions.',
        'notify_view_name' => 'Notify Display Name',
        'custom_table_id' => 'Notify Target Name',
        'notify_trigger' => 'Notify Trigger',
        'trigger_settings' => 'Notify Trigger Setting',
        'notify_target_column' => 'Notify Target Date Column',
        'notify_day' => 'Notification date',
        'notify_beforeafter' => 'Before and After Notification',
        'notify_hour' => 'Notification Date',
        'notify_action' => 'Notify Action',
        'action_settings' => 'Notify Action Setting',
        'notify_action_target' => 'Notify Target',
        'mail_template_id' => 'Notify Mail Template',

        'help' => [
            'notify_day' => 'Please enter the date of the notification. By inputting "0", will notify you on the day.',
            'custom_table_id' => 'Select the table to use as the condition to notify.',
            'notify_trigger' => 'Please select the content to be notified trigger.',
            'trigger_settings' => 'Select the datetime or date field for judging whether to notify.',
            'notify_beforeafter' => 'Choose whether to notify you that you are "before" or "after" of the date you are registering.<br />Ex: If "Notification date" is 7, "before and after notification" is "before", notification is executed 7 days before the date of the specified field.',
            'notify_hour' => 'The time to execute the notification. Enter from 0 to 23. Ex: When entering "6", execute notification at 6:00',
            'notify_action' => 'Please select the notification action to be done when the conditions are met.',
            'notify_action_target' => 'Select the target of notification destination.',
            'mail_template_id' => 'Select the template of the mail to send. When creating a new one, please create a new template in the mail template screen beforehand.',
        ],

        'notify_trigger_options' => [
            'time' => 'The Passage of Time'
        ],
        'notify_beforeafter_options' => [
            'before' => 'Before', 
            'after' => 'After'
        ],
        'notify_action_options' => [
            'email' => 'Email', 
        ],

        'notify_action_target_options' => [
            'has_authorities' => 'Have the Authority User',
        ],
    ],
];
