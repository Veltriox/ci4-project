<?= view('admin/partials/head') ?>
<?= view('admin/partials/sidebar') ?>
<?= view('admin/partials/header') ?>



<div class="main_content_iner">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Manage Support Tickets</h3>
                                <p class="text-muted small mt-1">Review and update student issues</p>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <div class="QA_section">
                            <div class="QA_table mb_30">
                                <table class="table lms_table_active" id="agentTicketsTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ticket ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Priority</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Date Requested</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($tickets)): foreach($tickets as $t): ?>
                                        <tr>
                                            <td><a href="#" class="question_content">#TKT-<?= $t['id'] ?? '???' ?></a></td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw_600"><?= htmlspecialchars($t['subject'] ?? 'No Title') ?></span>
                                                    <?php if(!empty($t['attachment'])): ?>
                                                        <a href="<?= base_url('uploads/tickets/'.$t['attachment']) ?>" target="_blank" class="text-primary mt-1 fw_700 fs-11">
                                                            <i class="ti-clip me-1"></i><?= htmlspecialchars($t['attachment']) ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($t['category'] ?? 'General') ?></td>
                                            <td>
                                                <?php 
                                                    $priority = strtolower($t['priority'] ?? 'low');
                                                    $bClass = 'bg-info';
                                                    if($priority == 'high') $bClass = 'bg-danger';
                                                    if($priority == 'medium') $bClass = 'bg-warning';
                                                ?>
                                                <span class="badge <?= $bClass ?>"><?= ucfirst(htmlspecialchars($priority)) ?></span>
                                            </td>
                                            <td>
                                                <?php 
                                                    $status = (!empty($t['status'])) ? $t['status'] : 'Open';
                                                    $bg = '#2ecc71'; 
                                                    if($status == 'Open') $bg = '#0c62ff'; 
                                                    if($status == 'In Progress') $bg = '#f39c12';
                                                    if($status == 'Closed') $bg = '#7f8c8d';
                                                ?>
                                                <a href="#" class="status_btn tkt-status-btn" style="background:<?= $bg ?>;"><?= htmlspecialchars($status) ?></a>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle tkt-action-btn" type="button" id="dropdownMenuButton<?= $t['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu shadow border-0 tkt-dropdown" aria-labelledby="dropdownMenuButton<?= $t['id'] ?>">
                                                        <a class="dropdown-item py-2 px-3 fs-13" href="#" data-bs-toggle="modal" data-bs-target="#viewTicketModal<?= $t['id'] ?>">
                                                            <i class="ti-eye text-primary me-2"></i> View
                                                        </a>
                                                        <?php if(strtolower($t['status'] ?? '') != 'closed'): ?>
                                                            <a class="dropdown-item py-2 px-3 fs-13" href="#" data-bs-toggle="modal" data-bs-target="#ticketModal<?= $t['id'] ?>">
                                                                <i class="ti-pencil-alt text-success me-2"></i> Update
                                                            </a>
                                                        <?php endif; ?>
                                                        <a class="dropdown-item py-2 px-3 fs-13" href="#" onclick="loadHistory('<?= $t['id'] ?>')" data-bs-toggle="modal" data-bs-target="#historyModal<?= $t['id'] ?>">
                                                            <i class="ti-time text-info me-2"></i> History
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- Ticket Update Modal -->
                                                <div class="modal fade" id="ticketModal<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                                                            <div class="modal-header tkt-modal-header tkt-border-primary">
                                                                <div class="d-flex justify-content-between align-items-center w-100 mb-2">
                                                                    <h5 class="modal-title dark_text fw_700 fs-5"><i class="ti-ticket text-primary me-2"></i> Update Ticket #<?= $t['id'] ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                            </div>
                                                            <form action="<?= site_url('support/updateStatus/'.$t['id']) ?>" method="POST">
                                                                <div class="modal-body p-4">
                                                                    <div class="mb-4">
                                                                        <div class="mb-3">
                                                                            <label class="tkt-label">Title</label>
                                                                            <span class="dark_text fw_600 d-block"><?= htmlspecialchars($t['subject'] ?? 'No Title') ?></span>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="tkt-label">Description</label>
                                                                            <p class="mb-0 text-dark small"><?= nl2br(htmlspecialchars($t['description'] ?? '')) ?></p>
                                                                        </div>
                                                                        <?php if(!empty($t['attachment'])): ?>
                                                                            <div class="mb-3 border-top pt-2">
                                                                                <label class="tkt-label">Attachment</label>
                                                                                <a href="<?= base_url('uploads/tickets/'.$t['attachment']) ?>" target="_blank" class="text-primary fw_600" style="font-size: 13px;">
                                                                                    <i class="ti-clip me-1"></i><?= htmlspecialchars($t['attachment']) ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    
                                                                    <div class="pt-3 border-top">
                                                                        <div class="mb-3">
                                                                            <label class="dark_text fw_700 mb-2 d-block fs-14">Update Status</label>
                                                                            <select name="status" class="form-select border-light bg-light" style="border-radius: 8px;">
                                                                                <option value="Open" <?= ($t['status'] == 'Open') ? 'selected' : '' ?>>Open</option>
                                                                                <option value="In Progress" <?= ($t['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                                                                                <option value="Resolved" <?= ($t['status'] == 'Resolved') ? 'selected' : '' ?>>Resolved</option>
                                                                                <option value="Closed" <?= ($t['status'] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="tkt-label">Response Remark</label>
                                                                            <textarea name="agent_remark" class="form-control border-light bg-light" rows="3" style="border-radius: 10px;" placeholder="Add resolution details..."><?= htmlspecialchars($t['agent_remark'] ?? '') ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer border-0 p-4 pt-0">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(to right, #7c5cfc, #a88beb); border: none;">Save Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- View Modal -->
                                                <div class="modal fade" id="viewTicketModal<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                                                            <div class="modal-header tkt-modal-header tkt-border-success">
                                                                <div class="d-flex justify-content-between align-items-center w-100 mb-2">
                                                                    <h5 class="modal-title dark_text fw_700 fs-5"><i class="ti-eye text-success me-2"></i> Ticket Detail #<?= $t['id'] ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <span class="badge rounded-pill px-3 py-2" style="background: <?= $bg ?>; font-size: 10px;"><?= strtoupper($status) ?></span>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <div class="mb-4">
                                                                    <div class="mb-3">
                                                                        <label class="text-muted small fw_700 mb-1 d-block text-uppercase" style="font-size: 10px;">Title</label>
                                                                        <span class="dark_text fw_600 d-block"><?= htmlspecialchars($t['subject'] ?? 'No Title') ?></span>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="text-muted small fw_700 mb-1 d-block text-uppercase" style="font-size: 10px;">Category</label>
                                                                        <span class="dark_text fw_500 d-block"><?= htmlspecialchars($t['category'] ?? 'General') ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="p-3 bg-light rounded-3 mb-3">
                                                                    <label class="text-muted small fw_700 mb-2 d-block text-uppercase" style="font-size: 10px;">Description</label>
                                                                    <p class="mb-0 text-dark" style="font-size: 13.5px;"><?= nl2br(htmlspecialchars($t['description'] ?? '')) ?></p>
                                                                </div>
                                                                <?php if(!empty($t['attachment'])): ?>
                                                                    <div class="mb-3 border-top pt-2">
                                                                        <label class="text-muted small fw_700 mb-1 d-block text-uppercase" style="font-size: 10px;">Attachment</label>
                                                                        <a href="<?= base_url('uploads/tickets/'.$t['attachment']) ?>" target="_blank" class="text-primary fw_600" style="font-size: 13px;">
                                                                            <i class="ti-clip me-1"></i><?= htmlspecialchars($t['attachment']) ?>
                                                                        </a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if(!empty($t['agent_remark'])): ?>
                                                                    <div class="pt-3 border-top">
                                                                        <label class="text-success small fw_700 mb-1 d-block text-uppercase" style="font-size: 10px;">Team Response</label>
                                                                        <p class="mb-0 text-dark fw_600" style="font-size: 13px;"><?= nl2br(htmlspecialchars($t['agent_remark'])) ?></p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="modal-footer border-0 p-4 pt-0">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- History Modal -->
                                                <div class="modal fade" id="historyModal<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                                                            <div class="modal-header tkt-modal-header tkt-border-info">
                                                                <div class="d-flex justify-content-between align-items-center w-100 mb-2">
                                                                    <h5 class="modal-title dark_text fw_700 fs-5"><i class="ti-time text-info me-2"></i> Activity History #<?= $t['id'] ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <span class="badge rounded-pill px-3 py-2" style="background: <?= $bg ?>; font-size: 10px;"><?= strtoupper($status) ?></span>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <div id="history-content-<?= $t['id'] ?>" class="history-list">
                                                                    <div class="text-center py-4">
                                                                        <div class="spinner-border text-info shadow-sm"></div>
                                                                        <p class="mt-2 text-muted">Fetching audit logs...</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 p-4 pt-0">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td><?= isset($t['created_at']) ? date('M d, Y', strtotime($t['created_at'])) : 'Unknown' ?></td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No tickets found in queue.</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                
                                <?php if (isset($pager)): ?>
                                <div class="d-flex justify-content-between align-items-center mt-3 mb-3 px-3">
                                    <div class="text-muted small fw_600">
                                        <?php if ($totalTickets > 10): ?>
                                            Showing <?= ($pager->getCurrentPage() * 10) - 9 ?> to <?= min($pager->getCurrentPage() * 10, $totalTickets) ?> of <?= $totalTickets ?> entries
                                        <?php endif; ?>
                                    </div>
                                    <div class="pagination_links">
                                        <?= $pager->links() ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('admin/partials/scripts') ?>
<script>
function loadHistory(ticketId) {
    const content = document.getElementById('history-content-' + ticketId);
    fetch(`<?= site_url('support/getHistory/') ?>${ticketId}`)
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success' && data.logs.length > 0) {
                let html = '<div class="timeline-log" style="position: relative; padding-left: 20px; border-left: 1px solid #e9ecef;">';
                data.logs.forEach(log => {
                    const date = new Date(log.created_at).toLocaleString();
                    let logMsg = log.log_message;
                    // Detect file names and make them links
                    if (log.action_type && log.action_type.includes('attachment') && log.new_value) {
                         const fileUrl = `<?= base_url('uploads/tickets/') ?>${log.new_value}`;
                         logMsg += ` <br><a href="${fileUrl}" target="_blank" class="text-primary fw_700" style="font-size: 12px;"><i class="ti-clip me-1"></i>${log.new_value}</a>`;
                    }
                    html += `
                        <div class="log-item mb-4" style="position: relative;">
                            <div style="position: absolute; left: -26px; top: 0; width: 10px; height: 10px; border-radius: 50%; background: #17a2b8; border: 2px solid #fff;"></div>
                            <div class="small fw_700 text-muted text-uppercase" style="font-size: 10px;">${date}</div>
                            <div class="dark_text fw_600 my-1" style="font-size: 13.5px;">${logMsg}</div>
                        </div>`;
                });
                html += '</div>';
                content.innerHTML = html;
            } else {
                content.innerHTML = '<div class="text-center text-muted py-4">No activity history found.</div>';
            }
        });
}
</script>
