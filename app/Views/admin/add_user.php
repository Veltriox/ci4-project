<?= view('admin/partials/head') ?>
<?= view('admin/partials/sidebar') ?>
<?= view('admin/partials/header') ?>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
        <!-- page title  -->
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left d-flex align-items-center">
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">Add New User</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('home/userList') ?>">Users</a></li>
                            <li class="breadcrumb-item active">Add New</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Add New User</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <!-- Success/Error Alert -->
                        <div id="formAlert" class="alert d-none" role="alert"></div>

                        <form id="addUserForm" class="p-4">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted fw-bold mb-2">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username" class="form-control" style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px;" placeholder="Enter username">
                                    <small class="text-danger d-none" id="username_error"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted fw-bold mb-2">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px;" placeholder="Enter email address">
                                    <small class="text-danger d-none" id="email_error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted fw-bold mb-2">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px;" placeholder="Enter first name">
                                    <small class="text-danger d-none" id="first_name_error"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted fw-bold mb-2">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px;" placeholder="Enter last name">
                                    <small class="text-danger d-none" id="last_name_error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted fw-bold mb-2">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control" style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px;" placeholder="Enter 10-digit phone" maxlength="10">
                                    <small class="text-danger d-none" id="phone_error"></small>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted fw-bold mb-2">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control" style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px;" placeholder="Enter password">
                                    <small class="text-danger d-none" id="password_error"></small>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <button type="submit" id="submitBtn" class="btn text-white fw-bold px-5 py-3" style="background-color: #7c5cfc; border-radius: 8px; border: none; min-width: 200px; font-size: 16px;">
                                        Add New User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?= view('admin/partials/scripts') ?>

<script>
$(document).ready(function() {
    // Clear all previous errors
    function clearErrors() {
        $('.text-danger').addClass('d-none').text('');
        $('input').css('border-color', '');
        $('#formAlert').addClass('d-none').text('');
    }

    // Show error on a specific field
    function showError(field, message) {
        $('#' + field).css('border-color', 'red');
        $('#' + field + '_error').removeClass('d-none').text(message);
    }

    // Show success alert
    function showSuccess(message) {
        $('#formAlert').removeClass('d-none alert-danger').addClass('alert-success').text(message);
    }

    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        clearErrors();

        var formData = {
            username:   $('#username').val().trim(),
            first_name: $('#first_name').val().trim(),
            last_name:  $('#last_name').val().trim(),
            email:      $('#email').val().trim(),
            phone:      $('#phone').val().trim(),
            password:   $('#password').val()
        };

        // Disable button while submitting
        $('#submitBtn').prop('disabled', true).text('Saving...');

        $.ajax({
            url: '<?= site_url("home/saveUser") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'error') {
                    showError(response.field, response.message);
                    $('#submitBtn').prop('disabled', false).text('Add User');
                } else if (response.status === 'success') {
                    showSuccess('User added successfully! Redirecting...');
                    setTimeout(function() {
                        window.location.href = '<?= site_url("home/userList") ?>';
                    }, 1500);
                }
            },
            error: function() {
                $('#formAlert').removeClass('d-none alert-success').addClass('alert-danger').text('Something went wrong. Please try again.');
                $('#submitBtn').prop('disabled', false).text('Add User');
            }
        });
    });
});
</script>
