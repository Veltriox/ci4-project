<?= $this->include('admin/partials/head') ?>
<div class="main_content_iner">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Student Information Table</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="QA_table mb_30">
                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($students)): ?>
                                            <?php foreach ($students as $student): ?>
                                            <tr>
                                                <th scope="row"> <a href="#" class="question_content"> #<?= $student['id'] ?></a></th>
                                                <td><?= $student['username'] ?? $student['name'] ?></td>
                                                <td><?= $student['email'] ?></td>
                                                <td><a href="#" class="status_btn" style="background-color: #2ecc71;">Active</a></td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                                                        <a href="#" class="action_btn"> <i class="fas fa-trash"></i> </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No students found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('admin/partials/scripts') ?>
