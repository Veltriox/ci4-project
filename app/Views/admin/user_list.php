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
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">User Management</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                    </div>
                    <div class="page_title_right">
                        <a href="<?= site_url('home/addUser') ?>" class="btn_1">+ Add New User</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30 pt-4">
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>User List</h4>
                            </div>

                            <div class="QA_table mb_30">
                                <!-- table-responsive -->
                                <table class="table lms_table_active3" id="userTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($users)): ?>
                                            <?php $i = 1; foreach ($users as $user): ?>
                                            <tr>
                                                <th scope="row"><?= $i++ ?></th>
                                                <td><?= esc($user['username']) ?></td>
                                                <td><?= esc($user['first_name'] ?? '-') ?></td>
                                                <td><?= esc($user['last_name'] ?? '-') ?></td>
                                                <td><?= esc($user['email']) ?></td>
                                                <td><?= esc($user['phone'] ?? '-') ?></td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="<?= site_url('home/edit/' . $user['id']) ?>" class="action_btn mr_10" title="Edit">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="<?= site_url('home/delete_user/' . $user['id']) ?>" class="action_btn" title="Delete" onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No users found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <?php if (isset($pager)): ?>
                            <div class="d-flex justify-content-center">
                                <?= $pager->links() ?>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?= view('admin/partials/scripts') ?>
