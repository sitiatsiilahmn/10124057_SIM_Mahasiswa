<?php
return [
    'app_title' => 'Student Data MIS',
    'hello' => 'Hello',
    'nav_data' => 'Student Data',
    'nav_add' => 'Add Data',
    'nav_logout' => 'Logout',

    // Login
    'login_title' => 'Sign In',
    'login_subtitle' => 'Please log in to manage student data.',
    'username' => 'Username',
    'password' => 'Password',
    'btn_login' => 'Sign In',
    'err_login_empty' => 'Username and password are required.',
    'err_login_failed' => 'Incorrect username or password.',
    'logout_success' => 'You have been logged out.',
    'login_required' => 'Please log in first.',

    // General
    'btn_save' => 'Save',
    'btn_update' => 'Update',
    'btn_cancel' => 'Cancel',
    'btn_edit' => 'Edit',
    'btn_delete' => 'Delete',
    'btn_search' => 'Search',
    'btn_reset' => 'Reset',
    'actions' => 'Actions',
    'no' => 'No',
    'err_csrf' => 'Invalid security token. Reload the page and try again.',
    'err_db' => 'A database error occurred. Please try again.',

    // List
    'list_title' => 'Student List',
    'search_placeholder' => 'Search ID / name / major...',
    'total_data' => 'Total records: %d',
    'no_data' => 'No data yet.',
    'confirm_delete' => 'Are you sure you want to delete this record?',

    // Form
    'add_title' => 'Add Student Data',
    'edit_title' => 'Edit Student Data',
    'f_nim' => 'Student ID (NIM)',
    'f_nama' => 'Full Name',
    'f_email' => 'Email',
    'f_jurusan' => 'Major',
    'f_angkatan' => 'Class Year',
    'f_alamat' => 'Address',
    'choose_jurusan' => '-- Select Major --',

    // Messages
    'msg_created' => 'Student data was added successfully.',
    'msg_updated' => 'Student data was updated successfully.',
    'msg_deleted' => 'Student data was deleted successfully.',
    'msg_not_found' => 'Data not found.',

    // Validation
    'err_form_summary' => 'The data is incomplete/invalid. Please check the fields below.',
    'err_nim_required' => 'Student ID is required.',
    'err_nim_format' => 'Student ID must be 8-15 digits.',
    'err_nim_duplicate' => 'Student ID is already registered.',
    'err_nama_required' => 'Name is required.',
    'err_nama_length' => 'Name must be 3-100 characters.',
    'err_nama_format' => 'Name may only contain letters, spaces, dots, apostrophes and hyphens.',
    'err_email_required' => 'Email is required.',
    'err_email_format' => 'Invalid email format.',
    'err_jurusan_required' => 'Major is required.',
    'err_jurusan_invalid' => 'Invalid major.',
    'err_angkatan_required' => 'Class year is required.',
    'err_angkatan_range' => 'Class year must be between 2000 and %d.',
    'err_alamat_length' => 'Address may not exceed 255 characters.',
];
