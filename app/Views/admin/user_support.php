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
                                <h3 class="m-0">Your Support Tickets</h3>
                            </div>
                            <div class="header_more_tool">
                                <a href="<?= site_url('admin/support_create') ?>" class="btn btn-primary" title="Create New Ticket">
                                    <i class="ti-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="QA_section">
                            <div class="QA_table mb_30">
                                <table class="table lms_table_active" id="userSupportTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ticket ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Priority</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($tickets)): foreach($tickets as $t): ?>
                                        <tr>
                                            <td><a href="#" class="question_content">#TKT-<?= $t['id'] ?></a></td>
                                            <td><?= htmlspecialchars($t['subject'] ?? 'No Title') ?></td>
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
                                                    if($status == 'Open') $bg = '#0c62ff'; // Premium visibility blue
                                                    if($status == 'In Progress') $bg = '#f39c12';
                                                    if($status == 'Closed') $bg = '#7f8c8d';
                                                ?>
                                                <a href="#" class="status_btn" style="background:<?= $bg ?>; color:white; min-width:80px; text-align:center; display:inline-block;"><?= htmlspecialchars($status) ?></a>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton<?= $t['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 2px 12px; font-size: 13px; border-radius: 6px;">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu shadow border-0" aria-labelledby="dropdownMenuButton<?= $t['id'] ?>" style="border-radius: 8px; margin-top: 5px; min-width: 150px; padding: 5px 0;">
                                                        <a class="dropdown-item py-2 px-3" href="#" data-bs-toggle="modal" data-bs-target="#viewTicketModal<?= $t['id'] ?>" style="font-size: 13px;">
                                                            <i class="ti-eye text-primary me-2"></i> View
                                                        </a>
                                                        <?php if(strtolower($t['status'] ?? '') != 'closed'): ?>
                                                            <a class="dropdown-item py-2 px-3" href="<?= site_url('admin/support_edit/'.$t['id']) ?>" style="font-size: 13px;">
                                                                <i class="ti-pencil-alt text-success me-2"></i> Edit
                                                            </a>
                                                        <?php endif; ?>
                                                        <a class="dropdown-item py-2 px-3" href="#" onclick="loadHistory('<?= $t['id'] ?>')" data-bs-toggle="modal" data-bs-target="#historyModal<?= $t['id'] ?>" style="font-size: 13px;">
                                                            <i class="ti-time text-info me-2"></i> History
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- Student View Only Modal -->
                                                <div class="modal fade" id="viewTicketModal<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                                                            <div class="modal-header tkt-modal-header tkt-border-success">
                                                                <div class="d-flex justify-content-between align-items-center w-100 mb-2">
                                                                    <h5 class="modal-title dark_text fw_700 fs-5"><i class="ti-eye text-success me-2"></i> My Ticket Detail #<?= $t['id'] ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <span class="badge rounded-pill px-3 py-2" style="background: <?= $bg ?>; font-size: 10px;"><?= strtoupper($status) ?></span>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <div class="mb-4">
                                                                     <div class="mb-3">
                                                                        <label class="tkt-label"><i class="ti-pencil-alt text-primary me-2"></i>Title</label>
                                                                        <span class="dark_text fw_600 d-block"><?= htmlspecialchars($t['subject'] ?? 'No Title') ?></span>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="tkt-label"><i class="ti-folder text-primary me-2"></i>Category</label>
                                                                        <span class="dark_text fw_500 d-block"><?= htmlspecialchars($t['category'] ?? 'General') ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="p-3 bg-light rounded-3 mb-3">
                                                                    <label class="tkt-label">My Description</label>
                                                                    <p class="mb-0 text-dark fs-13"><?= nl2br(htmlspecialchars($t['description'] ?? '')) ?></p>
                                                                </div>
                                                                <?php if(!empty($t['attachment'])): ?>
                                                                <div class="mt-3 border-top pt-3 mb-3">
                                                                    <label class="tkt-label">Attachment</label>
                                                                    <a href="<?= base_url('uploads/tickets/'.$t['attachment']) ?>" target="_blank" class="text-primary fw_600 fs-13">
                                                                        <i class="ti-clip me-1"></i><?= htmlspecialchars($t['attachment']) ?>
                                                                    </a>
                                                                </div>
                                                                <?php endif; ?>
                                                                <?php if(!empty($t['agent_remark'])): ?>
                                                                <div class="pt-3 border-top">
                                                                    <label class="tkt-label text-success">Team Response</label>
                                                                    <p class="mb-0 text-dark fw_600 fs-13"><?= nl2br(htmlspecialchars($t['agent_remark'])) ?></p>
                                                                </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="modal-footer border-0 p-4 pt-0">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Student History Modal -->
                                                <div class="modal fade" id="historyModal<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                                                            <div class="modal-header tkt-modal-header tkt-border-info">
                                                                <div class="d-flex justify-content-between align-items-center w-100 mb-2">
                                                                    <h5 class="modal-title dark_text fw_700 fs-5"><i class="ti-time text-info me-2"></i> History Timeline #<?= $t['id'] ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <span class="badge rounded-pill px-3 py-2" style="background: <?= $bg ?>; font-size: 10px;"><?= strtoupper($status) ?></span>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <div id="history-content-<?= $t['id'] ?>" class="history-list">
                                                                    <div class="text-center py-4">
                                                                        <div class="spinner-border text-info blur_5"></div>
                                                                        <p class="mt-2 text-muted">Loading timeline...</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 p-4 pt-0">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close History</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= isset($t['created_at']) ? date('M d, Y h:i A', strtotime($t['created_at'])) : 'Unknown' ?></td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No tickets found.</td>
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
                let html = '<div class="timeline-log" style="position: relative; padding-left: 20px; border-left: 2px solid #e9ecef;">';
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
                            <div class="dark_text fw_600 my-1 fs-13">${logMsg}</div>
                            ${log.old_value ? `<div class="bg-light p-2 rounded small text-muted" style="border-left: 3px solid #dee2e6;">Was: ${log.old_value}</div>` : ''}
                        </div>
                    `;
                });
                html += '</div>';
                content.innerHTML = html;
            } else {
                content.innerHTML = '<div class="text-center text-muted py-4">No history records found for this ticket.</div>';
            }
        })
        .catch(err => {
            content.innerHTML = '<div class="text-center text-danger py-4">Failed to load history list.</div>';
        });
}
</script>
