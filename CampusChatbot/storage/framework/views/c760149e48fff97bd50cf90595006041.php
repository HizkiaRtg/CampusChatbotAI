

<?php $__env->startSection('title', 'Job Applications'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-briefcase me-2"></i>
                    Job Applications
                </h1>
                <p class="text-muted mb-0">Manage and track all job applications</p>
                <h3><?php echo e(Auth::user()->type); ?> </h3>
            </div>
            <div class="col-auto">
                <div class="stat-badge">
                    <div class="stat-badge-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-badge-content">
                        <div class="stat-badge-label">Total Applications</div>
                        <div class="stat-badge-value" id="totalApplications"><?php echo e($total); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Filters -->
    <div class="card filter-card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-filter text-primary me-2"></i>
                <h6 class="mb-0 fw-semibold">Filter & Search</h6>
            </div>
            <form id="filterForm">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">
                            <i class="fas fa-search me-1"></i>Search
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" id="search" name="search"
                                placeholder="Name, email, telegram...">
                            <button type="button" class="btn btn-outline-secondary" id="clearSearch" style="display:none">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="job_filter" class="form-label">
                            <i class="fas fa-briefcase me-1"></i>Position
                        </label>
                        <select class="form-select" id="job_filter" name="job_filter">
                            <option value="">All Positions</option>
                            <?php $__currentLoopData = $jobPositions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($position); ?>"><?php echo e(Str::limit($position, 35)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="status_filter" class="form-label">
                            <i class="fas fa-flag me-1"></i>Status
                        </label>
                        <select class="form-select" id="status_filter" name="status_filter">
                            <option value="">All Statuses</option>
                            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusKey => $statusData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($statusKey); ?>">
                                    <?php echo e($statusData['emoji']); ?> <?php echo e($statusData['label']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Applications DataTable -->
    <div class="card data-card">

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="applicationsTable" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 200px;">Applicant</th>
                            <th style="width: 180px;">Contact</th>
                            <th style="width: 150px;">Position</th>
                            <th style="width: 120px;">Status</th>
                            <th style="width: 100px;">Applied</th>
                            <th style="width: 120px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated by DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Enhanced Status Change Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title mb-1">
                            <i class="fas fa-edit me-2"></i>Change Status
                        </h5>
                        <p class="text-muted small mb-0">Update the application status</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <label class="form-label fw-semibold mb-3">Select New Status:</label>
                    <div class="row g-3">
                        <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusKey => $statusOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="newStatus" id="status<?php echo e($statusKey); ?>"
                                    value="<?php echo e($statusKey); ?>" autocomplete="off">
                                <label class="btn btn-outline-<?php echo e($statusOption['color']); ?> w-100 status-btn-label"
                                    for="status<?php echo e($statusKey); ?>">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2"><?php echo e($statusOption['emoji']); ?></span>
                                        <span><?php echo e($statusOption['label']); ?></span>
                                    </div>
                                </label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="updateStatusBtn"
                        onclick="updateApplicationStatus()">
                        <i class="fas fa-check me-1"></i>Update Status
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header border-0">
                    <div class="text-center w-100">
                        <div class="modal-icon-danger mb-3">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                        <h5 class="modal-title">Delete Application?</h5>
                        <p class="text-muted small mb-0">This action cannot be undone</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center pb-4">
                    <p class="mb-0">Are you sure you want to delete this job application? All associated data including
                        CV will be permanently removed.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast modern-toast" role="alert">
            <div class="toast-header bg-success text-white border-0">
                <i class="fas fa-check-circle me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="successMessage"></div>
        </div>

        <div id="errorToast" class="toast modern-toast" role="alert">
            <div class="toast-header bg-danger text-white border-0">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="errorMessage"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        let dataTable;
        let currentApplicationId = null;

        $(document).ready(function() {
            // Initialize DataTable with responsive
            dataTable = $('#applicationsTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                ajax: {
                    url: "<?php echo e(route('job-applications.data')); ?>",
                    data: function(d) {
                        d.search = $('#search').val();
                        d.job_filter = $('#job_filter').val();
                        d.status_filter = $('#status_filter').val();
                    }
                },
                columns: [{
                        data: 'id',
                        responsivePriority: 1,
                        render: function(data, type, row, meta) {
                            return `<span class="text-muted fw-semibold">${meta.row + meta.settings._iDisplayStart + 1}</span>`;
                        },
                        orderable: false
                    },
                    {
                        data: 'name',
                        responsivePriority: 2,
                        render: function(data, type, row) {
                            return `
                            <div class="d-flex align-items-center">
                                <div class="avatar-modern me-3">
                                    <span>${row.avatar}</span>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">${data}</div>
                                    <small class="text-muted d-block">${row.email}</small>
                                </div>
                            </div>
                        `;
                        }
                    },
                    {
                        data: 'contact',
                        responsivePriority: 5,
                        render: function(data) {
                            let html = '<div class="contact-info">';
                            if (data.telegram) {
                                html += `
                                <a href="https://t.me/${data.telegram}" target="_blank" class="contact-link">
                                    <i class="fab fa-telegram text-info me-1"></i>
                                    <span>${data.telegram.substring(0, 15)}</span>
                                </a>
                            `;
                            }
                            if (data.phone) {
                                html += `
                                <a href="tel:${data.phone}" class="contact-link">
                                    <i class="fas fa-phone text-success me-1"></i>
                                    <span>${data.phone}</span>
                                </a>
                            `;
                            }
                            html += '</div>';
                            return html;
                        }
                    },
                    {
                        data: 'job_available',
                        responsivePriority: 4,
                        render: function(data) {
                            return `<span class="badge-modern badge-info">${data.substring(0, 20)}${data.length > 20 ? '...' : ''}</span>`;
                        }
                    },
                    {
                        data: 'status_badge',
                        responsivePriority: 3,
                        render: function(data, type, row) {
                            return `
                            <button type="button" onclick="openStatusModal(${row.id}, '${row.status}')"
                                class="badge-modern badge-${data.color} status-badge-${row.id}">
                                <span>${data.emoji}</span>
                                <span>${data.label}</span>
                            </button>
                        `;
                        }
                    },
                    {
                        data: 'created_at',
                        responsivePriority: 6,
                        render: function(data) {
                            const date = new Date(data);
                            const dateStr = date.toLocaleDateString('en-US', {
                                month: 'short',
                                day: 'numeric',
                                year: 'numeric'
                            });
                            const timeStr = date.toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            return `
                            <div class="date-info">
                                <div class="date-day">${dateStr}</div>
                                <div class="date-time">${timeStr}</div>
                            </div>
                        `;
                        }
                    },
                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 1,
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = '<div class="action-buttons">';
                            html +=
                                `<a href="${data.view_url}" class="btn-action btn-action-view" title="View Details"><i class="fas fa-eye"></i></a>`;
                            if (data.has_cv) {
                                html +=
                                    `<a href="${data.download_url}" class="btn-action btn-action-download" title="Download CV"><i class="fas fa-download"></i></a>`;
                            }
                            html +=
                                `<button type="button" class="btn-action btn-action-delete" onclick="confirmDelete(${row.id})" title="Delete"><i class="fas fa-trash"></i></button>`;
                            html += '</div>';
                            return html;
                        }
                    }
                ],
                order: [
                    [5, 'desc']
                ],
                pageLength: 10,
                language: {
                    processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                    emptyTable: `
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Applications Found</h5>
                        <p>There are no job applications matching your filters.</p>
                    </div>
                `,
                    search: "",
                    searchPlaceholder: "Search...",
                    lengthMenu: "Show _MENU_",
                    info: "Showing _START_ to _END_ of _TOTAL_",
                    infoEmpty: "No applications",
                    infoFiltered: "(filtered from _MAX_)",
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        previous: '<i class="fas fa-angle-left"></i>'
                    }
                },
                drawCallback: function(settings) {
                    const api = this.api();
                    const info = api.page.info();
                    $('#totalApplications').text(info.recordsFiltered || 0);
                    $('#recordsInfo').text(
                        `${info.recordsTotal > 0 ? info.start + 1 : 0}-${info.end} of ${info.recordsTotal}`
                    );

                    // Add data labels for mobile card view
                    if ($(window).width() <= 575) {
                        const headers = ['#', 'Applicant', 'Contact', 'Position', 'Status', 'Applied',
                            'Actions'
                        ];
                        $('#applicationsTable tbody tr').each(function() {
                            $(this).find('td').each(function(index) {
                                if (headers[index]) {
                                    $(this).attr('data-label', headers[index]);
                                }
                            });
                        });
                    }
                }
            });

            // Filter handlers
            $('#search').on('keyup', debounce(function() {
                const val = $(this).val();
                $('#clearSearch').toggle(val.length > 0);
                dataTable.ajax.reload();
            }, 500));

            $('#clearSearch').on('click', function() {
                $('#search').val('');
                $(this).hide();
                dataTable.ajax.reload();
            });

            $('#job_filter, #status_filter').on('change', function() {
                dataTable.ajax.reload();
            });

            // Redraw on window resize for mobile view
            $(window).on('resize', debounce(function() {
                dataTable.columns.adjust().responsive.recalc();
            }, 250));
        });

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function confirmDelete(applicationId) {
            currentApplicationId = applicationId;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        $('#confirmDeleteBtn').on('click', function() {
            const btn = $(this);
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Deleting...');

            $.ajax({
                url: `/admin/job-applications/${currentApplicationId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                    showToast(response.message, 'success');
                    dataTable.ajax.reload();
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || 'Failed to delete application', 'error');
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="fas fa-trash me-1"></i>Delete');
                }
            });
        });

        function openStatusModal(applicationId, currentStatus) {
            currentApplicationId = applicationId;
            const modal = new bootstrap.Modal(document.getElementById('statusModal'));

            $('input[name="newStatus"]').prop('checked', false);

            const currentRadio = document.getElementById(`status${currentStatus}`);
            if (currentRadio) {
                currentRadio.checked = true;
            }

            modal.show();
        }

        function updateApplicationStatus() {
            const selectedStatus = document.querySelector('input[name="newStatus"]:checked');

            if (!selectedStatus) {
                showToast('Please select a status', 'error');
                return;
            }

            const newStatus = selectedStatus.value;
            const updateBtn = $('#updateStatusBtn');
            const originalText = updateBtn.html();

            updateBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Updating...');

            $.ajax({
                url: `/admin/job-applications/${currentApplicationId}/status`,
                type: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    status: newStatus
                }),
                success: function(data) {
                    $(`.status-badge-${currentApplicationId}`)
                        .removeClass()
                        .addClass(
                            `badge-modern badge-${data.status_color} status-badge-${currentApplicationId}`)
                        .html(`<span>${data.status_emoji}</span><span>${data.status_label}</span>`);

                    bootstrap.Modal.getInstance(document.getElementById('statusModal')).hide();
                    showToast(data.message, 'success');
                    dataTable.ajax.reload(null, false); // Reload without resetting page
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || 'Failed to update status', 'error');
                },
                complete: function() {
                    updateBtn.prop('disabled', false).html(originalText);
                }
            });
        }

        function showToast(message, type = 'success') {
            const toastId = type === 'success' ? 'successToast' : 'errorToast';
            const messageId = type === 'success' ? 'successMessage' : 'errorMessage';

            $(`#${messageId}`).text(message);
            const toast = new bootstrap.Toast(document.getElementById(toastId), {
                autohide: true,
                delay: type === 'error' ? 5000 : 3000
            });
            toast.show();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <style>
        :root {
            --primary-rgb: 0, 125, 190;
            --primary-color: #007DBE;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Page Header */
        .page-header {
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stat-badge {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, #007DBE 0%, #0099E6 100%);
            border-radius: 12px;
            color: white;
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.2);
        }

        .stat-badge-icon {
            font-size: 2rem;
            opacity: 0.9;
        }

        .stat-badge-label {
            font-size: 0.75rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .stat-badge-value {
            font-size: 1.75rem;
            font-weight: 700;
        }

        /* Filter Card */
        .filter-card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
        }

        .filter-card .card-body {
            padding: 1.5rem;
        }

        .input-group-text {
            border-right: 0;
            background: white;
        }

        .form-control {
            border-left: 0;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(var(--primary-rgb), 0.15);
        }

        /* Data Card */
        .data-card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
        }

        .data-card .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
        }

        /* Table Styles - Bootstrap 5 Compatible */
        .table {
            margin-bottom: 0;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.75rem;
            background-color: transparent;
            border-bottom-width: 1px;
        }

        .table thead th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table tbody td {
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background-color: #f8fafc !important;
        }

        /* Avatar Modern */
        .avatar-modern {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #007DBE 0%, #0099E6 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(var(--primary-rgb), 0.2);
        }

        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .contact-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #64748b;
            font-size: 0.8125rem;
            transition: var(--transition);
        }

        .contact-link:hover {
            color: var(--primary-color);
        }

        /* Badge Modern */
        .badge-modern {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 0.875rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.8125rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .badge-modern:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Date Info */
        .date-info {
            text-align: left;
        }

        .date-day {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.8125rem;
        }

        .date-time {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: nowrap;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.875rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .btn-action-view {
            background: #dbeafe;
            color: #1e40af;
        }

        .btn-action-view:hover {
            background: #1e40af;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(30, 64, 175, 0.3);
        }

        .btn-action-download {
            background: #d1fae5;
            color: #065f46;
        }

        .btn-action-download:hover {
            background: #065f46;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(6, 95, 70, 0.3);
        }

        .btn-action-delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-action-delete:hover {
            background: #991b1b;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(153, 27, 27, 0.3);
        }

        /* DataTables Bootstrap 5 Integration */
        div.dataTables_wrapper div.dataTables_length label,
        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_info {
            font-size: 0.875rem;
            color: #64748b;
        }

        div.dataTables_wrapper div.dataTables_length select {
            padding: 0.375rem 2rem 0.375rem 0.75rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            margin-left: 0.5rem;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 0;
            gap: 0.25rem;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item .page-link {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 0.5rem 0.75rem;
            transition: var(--transition);
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item .page-link:hover {
            background: #f8fafc;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        div.dataTables_wrapper div.dataTables_processing {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.95) !important;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: none;
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state h5 {
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #94a3b8;
            font-size: 0.875rem;
        }

        /* Modern Modal */
        .modern-modal {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .modern-modal .modal-header {
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem;
        }

        .modern-modal .modal-body {
            padding: 1.5rem;
        }

        .modern-modal .modal-footer {
            border-top: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
        }

        .modal-icon-danger {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fee2e2;
            color: #991b1b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto;
        }

        .status-btn-label {
            padding: 0.75rem 1rem;
            border-width: 2px;
            border-radius: 10px;
            transition: var(--transition);
        }

        .btn-check:checked+.status-btn-label {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Toast */
        .modern-toast {
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .modern-toast .toast-header {
            border-radius: 12px 12px 0 0;
        }

        .modern-toast .toast-body {
            padding: 1rem;
        }

        /* Responsive Styles */
        @media (max-width: 1199.98px) {
            .page-title {
                font-size: 1.5rem;
            }

            .table> :not(caption)>*>* {
                padding: 0.75rem 0.5rem;
            }
        }

        @media (max-width: 991.98px) {
            .stat-badge {
                padding: 0.75rem 1rem;
                gap: 0.75rem;
            }

            .stat-badge-icon {
                font-size: 1.5rem;
            }

            .stat-badge-value {
                font-size: 1.5rem;
            }

            .avatar-modern {
                width: 36px;
                height: 36px;
                font-size: 0.875rem;
            }

            .table> :not(caption)>*>* {
                padding: 0.75rem 0.5rem;
                font-size: 0.875rem;
            }

            .table thead th {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 767.98px) {
            .page-header {
                margin-bottom: 1rem;
            }

            .page-header .row {
                gap: 1rem;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .stat-badge {
                width: 100%;
                justify-content: center;
            }

            .filter-card .card-body {
                padding: 1rem;
            }

            .data-card .card-header {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }

            /* Mobile Table Adjustments */
            .table> :not(caption)>*>* {
                padding: 0.75rem 0.5rem;
                font-size: 0.8125rem;
            }

            .table thead th {
                padding: 0.5rem 0.5rem;
                font-size: 0.65rem;
            }

            .avatar-modern {
                width: 32px;
                height: 32px;
                font-size: 0.75rem;
            }

            .badge-modern {
                padding: 0.375rem 0.625rem;
                font-size: 0.75rem;
            }

            .btn-action {
                width: 28px;
                height: 28px;
                font-size: 0.75rem;
            }

            .action-buttons {
                gap: 0.25rem;
            }

            .contact-info {
                font-size: 0.75rem;
            }

            .date-day {
                font-size: 0.75rem;
            }

            .date-time {
                font-size: 0.7rem;
            }

            /* DataTables Mobile */
            div.dataTables_wrapper div.dataTables_length,
            div.dataTables_wrapper div.dataTables_filter,
            div.dataTables_wrapper div.dataTables_info,
            div.dataTables_wrapper div.dataTables_paginate {
                text-align: center;
                padding: 0.75rem;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                justify-content: center;
                flex-wrap: wrap;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item .page-link {
                padding: 0.375rem 0.625rem;
                font-size: 0.8125rem;
            }
        }

        @media (max-width: 575.98px) {
            .page-title {
                font-size: 1.125rem;
            }

            .stat-badge-value {
                font-size: 1.25rem;
            }

            .filter-card .card-body {
                padding: 0.75rem;
            }

            .form-label {
                font-size: 0.8125rem;
                margin-bottom: 0.375rem;
            }

            .modal-dialog {
                margin: 0.5rem;
            }

            .modern-modal .modal-header,
            .modern-modal .modal-body,
            .modern-modal .modal-footer {
                padding: 1rem;
            }

            .status-btn-label {
                padding: 0.5rem 0.75rem;
                font-size: 0.8125rem;
            }

            /* Ultra Mobile - Card View for Table */
            .table-responsive {
                border: none;
            }

            /* Hide table header on very small screens */
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                padding: 0.75rem;
                background: white;
            }

            .table tbody td {
                display: block;
                text-align: right;
                padding: 0.5rem 0;
                border: none;
                position: relative;
                padding-left: 50%;
            }

            .table tbody td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-right: 10px;
                text-align: left;
                font-weight: 600;
                color: #64748b;
                font-size: 0.75rem;
                text-transform: uppercase;
            }

            .table tbody td:last-child {
                text-align: center;
                padding-left: 0;
            }

            .table tbody td:last-child:before {
                display: none;
            }

            .action-buttons {
                justify-content: center;
                padding-top: 0.5rem;
                border-top: 1px solid #f1f5f9;
                margin-top: 0.5rem;
            }
        }

        /* Loading Animation */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .spinner-border {
            animation: pulse 1s ease-in-out infinite;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\LARAVEL\COMPANYPROFILE\COMPANYPROFILE3\MyAdmin\resources\views/admin/job-applications/index.blade.php ENDPATH**/ ?>